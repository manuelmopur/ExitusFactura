<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//include_once APPPATH.'/third_party/pclzip.lib.php';
include_once 'custom.php';

//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class Sunat{
	private $servicio;
	private $user;
	private $pass;
	private $client;
	private $headers;
	private $method;

	public function __construct($dat = array()){
		//$this->user = '20530336281';
		$this->user = $dat['ruc'].''.$dat['usuario_sunat'];
		//$this->pass = 'pctazAU9K8';
		$this->pass = $dat['password_sunat'];
		$this->method = 'sendBill';
	}

	public function setMethodSumary($m = ''){
		$this->method = 'sendSummary';
	}

	public function envia($fileName = '',$dir = ''){
		$wsdlURL = 'https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService?wsdl';
		//$wsdlURL = 'https://ose-gw1.efact.pe/ol-ti-itcpe/billService?wsdl';
		$wsdlURL = APPPATH.'/libraries/billService_1.wsdl';
		//$wsdlURL = 'https://ose.efact.pe/ol-ti-itcpe/billService?wsdl';
		//Estructura del XML para la conexión
		/*if(!file_exists($dir.$fileName.'.zip'))
			return ['status'=>202,'data'=>'Arhcivo no existe'];*/
		$XMLString = '<?xml version="1.0" encoding="UTF-8"?>
		<soapenv:Envelope 
		xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
		xmlns:ser="http://service.sunat.gob.pe" 
		xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
		<soapenv:Header>
		<wsse:Security>
		<wsse:UsernameToken>
		<wsse:Username>'.$this->user.'</wsse:Username>
		<wsse:Password>'.$this->pass.'</wsse:Password>
		</wsse:UsernameToken>
		</wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
		<ser:'.$this->method.'>
		<fileName>'.$fileName.'.zip</fileName>
		<contentFile>' . base64_encode(file_get_contents($dir.$fileName.'.zip')) . '</contentFile>
		</ser:'.$this->method.'>
		</soapenv:Body>
		</soapenv:Envelope>';
		//echo $XMLString;
		//Realizamos la llamada a nuestra función
		try{
			$result = soapCall($wsdlURL, $callFunction = $this->method, $XMLString);
			$archivoxml = fopen($dir.'C'.$fileName.'.xml','w+');
			fputs($archivoxml,$result);
			fclose($archivoxml);
			//LEEMOS EL ARCHIVO XML
			$xml = simplexml_load_file($dir.'C'.$fileName.'.xml');
			//$zip = new ZipArchive();
			if($this->method == 'sendSummary'){
				$archivo = fopen($dir.'R-'.$fileName.'.xml','w+');
				fputs($archivo,$xml->asXML());
				fclose($archivo);
				chmod($dir.'R-'.$fileName.'.xml', 0777);
				unlink($dir.'C'.$fileName.'.xml');
				return ['status'=>200,'data'=>'Aceptado'];
			}
			foreach ($xml->xpath('//applicationResponse') as $response){ }
			//AQUI DESCARGAMOS EL ARCHIVO CDR(CONSTANCIA DE RECEPCIÓN)
			$cdr=base64_decode($response);
			//$zip->open($dir.'R-'.$fileName.'zip',ZIPARCHIVE::CREATE);
			$archivo = fopen($dir.'R-'.$fileName.'.zip','w+');
			fputs($archivo,$cdr);
			fclose($archivo);
			chmod($dir.'R-'.$fileName.'.zip', 0777);
			unlink($dir.'C'.$fileName.'.xml');
			return ['status'=>200,'data'=>'Aceptado'];
			//$archive = new PclZip('R-'.$fileName.'.zip');
			//Eliminamos el Archivo Response
		}catch(SoapFault $e){
			return ['status'=>202,'data'=>$e->faultstring];
		}catch(Exception $e){
			return ['status'=>202,'data'=>$e->getMesagge()];
		}
	}

	public function loadStatus($fileName = '',$dir = ''){
		$domDocument = new \DOMDocument();
		$domDocument->load($dir.$fileName.'.xml');
		$ticket = $domDocument->getElementsByTagName('ticket');
		$t = 0;
		foreach ($ticket as $key => $value) {
			$t = $value->nodeValue;
		}
		return $t;
	}

	public function getStatus($ticket,$fileName = '',$dir = ''){
		$wsdlURL = 'https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService?wsdl';
		//$wsdlURL = APPPATH.'/libraries/billService_1.wsdl';
		//Estructura del XML para la conexión
		$XMLString = '<?xml version="1.0" encoding="UTF-8"?>
			<soapenv:Envelope 
			xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
			xmlns:ser="http://service.sunat.gob.pe" 
			xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
			<soapenv:Header>
			<wsse:Security>
			<wsse:UsernameToken>
			<wsse:Username>'.$this->user.'</wsse:Username>
			<wsse:Password>'.$this->pass.'</wsse:Password>
			</wsse:UsernameToken>
			</wsse:Security>
			</soapenv:Header>
			<soapenv:Body>
			<ser:getStatus>
			<ticket>'.$ticket.'</ticket>
			</ser:getStatus>
			</soapenv:Body>
		</soapenv:Envelope>';
		//echo $XMLString;
		//Realizamos la llamada a nuestra función
		try{
			$result = soapCall($wsdlURL, $callFunction = "getStatus", $XMLString);
			$archivoxml = fopen($dir.'C'.$fileName.'.xml','w+');
			fputs($archivoxml,$result);
			fclose($archivoxml);
			//LEEMOS EL ARCHIVO XML
			$domDocument = new \DOMDocument();
			$domDocument->load($dir.'C'.$fileName.'.xml');
			//$xml = simplexml_load_file($dir.'C'.$fileName.'.xml');
			$content = $domDocument->getElementsByTagName('content');
			$r = '';
			foreach ($content as $response){
				$r = $response->nodeValue;
			 }
			//AQUI DESCARGAMOS EL ARCHIVO CDR(CONSTANCIA DE RECEPCIÓN)
			$cdr=base64_decode($r);
			$zip = new ZipArchive();
			if(file_exists($dir.$fileName.'.xml'))
				unlink($dir.$fileName.'.xml');
			$archivo = fopen($dir.$fileName.'.zip','w+');
			fputs($archivo,$cdr);
			fclose($archivo);
			chmod($dir.$fileName.'.zip', 0777);
			unlink($dir.'C'.$fileName.'.xml');
			return ['status'=>200,'data'=>'Aceptado','ruta'=>$dir.$fileName];
		}catch(SoapFault $e){
			return ['status'=>202,'data'=>$e->faultstring];
		}catch(Exception $e){
			return ['status'=>202,'data'=>$e->getMesagge()];
		}
	}
}
