<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Clinica.php';
//require_once APPPATH.'/third_party/xmlseclibs/xmlseclibs.php';
require_once APPPATH.'/third_party/xmlseclibs/vendor/autoload.php';
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;
//require_once APPPATH.'/third_party/xmlseclibs/vendor/autoload.php';
//require_once APPPATH.'/third_party/xmlseclibs/src/XmlDigitalSignature.php';

//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class Bajaxml{

	public $xml;
	public $raiz;
	public $clinica;
	public $ci;

	public function __construct(){
		$this->ci =& get_instance();
		$this->clinica = new Clinica();
		//inicio del xml
		$this->xml = new DomDocument('1.0', 'UTF-8');
		$this->xml->xmlStandalone = false;
		$this->xml->preserveWhiteSpace = false;
		//cabecera raiz
		$this->raiz = $this->xml->createElement('VoidedDocuments');
		//propiedades de la cabecera raiz
		$xmlns = $this->xml->createAttribute('xmlns');
		$xmlns->value = 'urn:sunat:names:specification:ubl:peru:schema:xsd:VoidedDocuments-1';

		$xmlnscac = $this->xml->createAttribute('xmlns:cac');
		$xmlnscac->value = 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2';
		$xmlnscbc = $this->xml->createAttribute('xmlns:cbc');
		$xmlnscbc->value = 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2';
		/*$xmlnsccts = $this->xml->createAttribute('xmlns:ccts');
		$xmlnsccts->value = 'urn:un:unece:uncefact:documentation:2';*/
		$xmlnsds = $this->xml->createAttribute('xmlns:ds');
		$xmlnsds->value = 'http://www.w3.org/2000/09/xmldsig#';
		$xmlnsext = $this->xml->createAttribute('xmlns:ext');
		$xmlnsext->value = 'urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2';
		/*$xmlnsqdt = $this->xml->createAttribute('xmlns:qdt');
		$xmlnsqdt->value = 'urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2';*/
		$xmlnssac = $this->xml->createAttribute('xmlns:sac');
		$xmlnssac->value = 'urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1';
		/*$xmlnsudt = $this->xml->createAttribute('xmlns:udt');
		$xmlnsudt->value = 'urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2';*/
		$xmlnsxsi = $this->xml->createAttribute('xmlns:xsi');
		$xmlnsxsi->value = 'http://www.w3.org/2001/XMLSchema-instance';

		$this->raiz->appendChild($xmlns);
		$this->raiz->appendChild($xmlnscac);
		$this->raiz->appendChild($xmlnscbc);
		//$this->raiz->appendChild($xmlnsccts);
		$this->raiz->appendChild($xmlnsds);
		$this->raiz->appendChild($xmlnsext);
		//$this->raiz->appendChild($xmlnsqdt);
		$this->raiz->appendChild($xmlnssac);
		//$this->raiz->appendChild($xmlnsudt);
		$this->raiz->appendChild($xmlnsxsi);

	}

	public function generarArchivo($tipo = '',$date = '',$file = ''){
		$this->xml->formatOutput = true;
		$this->xml->saveXML();
		if(!file_exists('./archivos/'.$tipo))
			mkdir('./archivos/'.$tipo);
		if(!file_exists('./archivos/'.$tipo.'/'.$date))
			mkdir('./archivos/'.$tipo.'/'.$date);
		$this->xml->save('./archivos/'.$tipo.'/'.$date.'/'.$file.'.xml');
	}

	public function agregaRaiz(){
		$this->xml->appendChild($this->raiz);
	}

	public function firmar($tipo,$date,$file = '',$param){
		$ReferenceNodeName = 'ExtensionContent';
		if (!$almacén_cert = file_get_contents("./keys/".$param['dir_cert_priv'])) {
		    echo "Error: No se puede leer el fichero del certificado\n";
		    exit;
		}
		if (openssl_pkcs12_read($almacén_cert, $info_cert, $param['pin'])) {
			openssl_x509_export($info_cert['extracerts'][0],$cert);
		    $privateKey = openssl_get_privatekey($info_cert['pkey']);
		    $publicKey = $info_cert['cert'];
		} else {
		    echo "Error: No se puede leer el almacén de certificados.\n";
		    exit;
		}
		//$publicKey = substr($publicKey, 28, -27);
		$domDocument = new \DOMDocument();
		$domDocument->load('./archivos/'.$tipo.'/'.$date.'/'.$file.'.xml');

		// Create a new Security object 
		$objDSig = new XMLSecurityDSig('ds','SignatureEXITUS');
		// Use the c14n exclusive canonicalization
		$objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
		// Sign using SHA-256
		$objDSig->addReference(
		    $domDocument, 
		    XMLSecurityDSig::SHA1, 
		    array('http://www.w3.org/2000/09/xmldsig#enveloped-signature'),
		    [
		    	'force_uri'	=> true
		    ]
		);

		// Create a new (private) Security key
		$objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type'=>'private'));
		// Load the private key
		//$objKey->passphrase = 'txKA3GFCwV9zeqRG';
		//$objKey->loadKey($privateKey);
		$objKey->loadKey($privateKey);

		// Sign the XML file
		$objDSig->sign($objKey);

		//var_dump($objDSig->verify($objKey,$nodeSign));
		// Add the associated public key to the signature
		$objDSig->add509Cert(file_get_contents('./keys/'.$param['dir_cert_pub']),true,false, array('subjectName'=>true));
		//$objDSig->add509Cert($cert);

		// Append the signature to the XML
		$el = $domDocument->getElementsByTagName('UBLExtension');
		$co = $el->item(0)->getElementsByTagName('ExtensionContent');
		$objDSig->appendSignature($domDocument->getElementsByTagName('ExtensionContent')->item(0));
		unlink('./archivos/'.$tipo.'/'.$date.'/'.$file.'.xml');
		$domDocument->save('./archivos/'.$tipo.'/'.$date.'/'.$file.'.xml');
		chmod('./archivos/'.$tipo.'/'.$date.'/'.$file.'.xml',0777);
		$a = $domDocument->getElementsByTagName('DigestValue');
		$b = $domDocument->getElementsByTagName('SignatureValue');
		$datos = array();
		foreach ($a as $key => $value) {
			$datos['DigestValue'] = $value->nodeValue;
		}
		foreach ($b as $key => $value) {
			$datos['SignatureValue'] = $value->nodeValue;
		}

		$zip = new ZipArchive();
		$filename = './archivos/'.$tipo.'/'.$date.'/'.$file.'.zip';
		$zip->open($filename,ZIPARCHIVE::CREATE);
		if(file_exists('./archivos/'.$tipo.'/'.$date.'/'.$file.'.xml'))
		$zip->addFile('./archivos/'.$tipo.'/'.$date.'/'.$file.'.xml',$file.'.xml');
		$zip->close();
		chmod($filename,0700);
		return $datos;
	}

	public function cargaDocumento($data,$bajas,$motivo = '',$parametros = array()){
		//echo "preparando archivo";
		$extens = $this->xml->createElement('ext:UBLExtensions');
		$this->raiz->appendChild($extens);

		$exten2 = $this->xml->createElement('ext:UBLExtension');
		$content2 = $this->xml->createElement('ext:ExtensionContent');
		$exten2->appendChild($content2);
		$extens->appendChild($exten2);
		$this->raiz->appendChild($extens);
		//otros agregados a la raiz
		$this->raiz->appendChild($this->xml->createElement('cbc:UBLVersionID','2.0'));
		$this->raiz->appendChild($this->xml->createElement('cbc:CustomizationID','1.0'));

		//venta
		$fecha = '';
		if(isset($data->fecha))
			$fecha = $data->fecha;
		else
			$fecha = $data->cancelado;
		$this->raiz->appendChild($this->xml->createElement('cbc:ID','RA-'.date('Ymd',strtotime(date('Y-m-d',strtotime(date($fecha))))).'-'.$bajas));
		$this->raiz->appendChild($this->xml->createElement('cbc:ReferenceDate',date('Y-m-d',strtotime(date($fecha)))));
		$this->raiz->appendChild($this->xml->createElement('cbc:IssueDate',date('Y-m-d',strtotime(date($fecha)))));
		$signature = $this->xml->createElement('cac:Signature');
		$signature->appendChild($this->xml->createElement('cbc:ID','IDSignEXITUS'));
		$signatoreparty = $this->xml->createElement('cac:SignatoryParty');
		$partyidentification = $this->xml->createElement('cac:PartyIdentification');
		$partyidentification->appendChild($this->xml->createElement('cbc:ID',$parametros['ruc']));
		$signatoreparty->appendChild($partyidentification);
		$partyname = $this->xml->createElement('cac:PartyName');
		$name = $this->xml->createElement('cbc:Name');
		$name->appendChild($this->xml->createCDATASection($parametros['razon_social']));
		$partyname->appendChild($name);
		$signatoreparty->appendChild($partyname);
		$signature->appendChild($signatoreparty);

		$digitasig = $this->xml->createElement('cac:DigitalSignatureAttachment');
		$external = $this->xml->createElement('cac:ExternalReference');
		$external->appendChild($this->xml->createElement('cbc:URI','#SignatureEXITUS'));
		$digitasig->appendChild($external);
		$signature->appendChild($digitasig);
		$this->raiz->appendChild($signature);

		//acountingsupplierparty
		$acountingsupplierparty = $this->xml->createElement('cac:AccountingSupplierParty');
		$customeraconid = $this->xml->createElement('cbc:CustomerAssignedAccountID',$parametros['ruc']);
		$acountingsupplierparty->appendChild($customeraconid);
		$aditionalaconid = $this->xml->createElement('cbc:AdditionalAccountID',6);
		$acountingsupplierparty->appendChild($aditionalaconid);
		$party = $this->xml->createElement('cac:Party');
		$partylegal = $this->xml->createElement('cac:PartyLegalEntity');
		$registraname = $this->xml->createElement('cbc:RegistrationName');
		$registraname->appendChild($this->xml->createCDATASection($parametros['razon_social']));
		$partylegal->appendChild($registraname);
		$party->appendChild($partylegal);
		$acountingsupplierparty->appendChild($party);
		$this->raiz->appendChild($acountingsupplierparty);

		//documento a dar de baja
		$voideddocument = $this->xml->createElement('sac:VoidedDocumentsLine');
		$voideddocument->appendChild($this->xml->createElement('cbc:LineID',1));
		$voideddocument->appendChild($this->xml->createElement('cbc:DocumentTypeCode',$data->cod_doc));
		$voideddocument->appendChild($this->xml->createElement('sac:DocumentSerialID',$data->num_serie));
		$voideddocument->appendChild($this->xml->createElement('sac:DocumentNumberID',$data->num_documento));
		$m = $this->xml->createElement('sac:VoidReasonDescription');
		$m->appendChild($this->xml->createCDATASection(strtoupper($motivo)));
		$voideddocument->appendChild($m);
		$this->raiz->appendChild($voideddocument);
		$this->agregaRaiz();
	}
}