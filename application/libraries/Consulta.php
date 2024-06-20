<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'/third_party/sunat/cURL.php';
require_once APPPATH.'/third_party/sunat/sunat.php';

//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class Consulta{

	private $cu = null;
	private $url_base = null;

	public function __construct($parameters){
		$this->cu = new cURL();
		$this->url_base = $parameters['url_api'];
		$this->cu->setHttpHeader($parameters['header_api']);
	}

	public function buscaRuc($ruc = ''){
		$cliente = new Sunat();
		return $cliente->getDataRUC($ruc);
	}

	public function llamada_api($llamada,$datos = array()){
		return $this->cu->send($this->url_base.$llamada,$datos);
	}

	public function buscaDni($dni = '12345678'){
		try{
			$data = file_get_contents('http://aplicaciones007.jne.gob.pe/srop_publico/Consulta/Afiliado/GetNombresCiudadano?DNI='.$dni);
		}catch(Exception $e){
			return 0;
		}
		$permitidos = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ| ";
	    for ($i=0; $i<strlen($data); $i++){
	        if (strpos($permitidos, substr($data,$i,1))===false){
	         	return false;
	      	}
	   	} 
		return explode('|', $data);
	}
}