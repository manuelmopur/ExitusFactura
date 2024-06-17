<?php 
class feedSoap extends SoapClient{
    public $XMLStr = "";
    public function setXMLStr($value){
        $this->XMLStr = $value;
    }
    public function getXMLStr(){
        return $this->XMLStr;
    }
    public function __doRequest($request, $location, $action, $version, $one_way = 0){
        $request = $this->XMLStr;
        $dom = new DOMDocument('1.0');
        try{
            $dom->loadXML($request);
        } catch (DOMException $e) {
            die($e->code);
        }
        $request = $dom->saveXML();
        //Solicitud
        return parent::__doRequest($request, $location, $action, $version, $one_way = 0);
    }
    public function SoapClientCall($SOAPXML){
        return $this->setXMLStr($SOAPXML);
    }
}
function soapCall($wsdlURL, $callFunction = "", $XMLString){
    $client = new feedSoap($wsdlURL, array(
    	'cache_wsdl'	=> WSDL_CACHE_NONE,
    	'trace' => true,
    	'soap_servicion'=> SOAP_1_1
    ));
    $reply  = $client->SoapClientCall($XMLString);
    /*print_r("REQUEST:".PHP_EOL );
    var_dump($client->__getFunctions());
    exit();*/
    $client->__call("$callFunction", array(), array());
    //$request = prettyXml($client->__getLastRequest());
    //echo highlight_string($request, true) . "<br/>\n";
    return $client->__getLastResponse();
    //print_r($client);
}
	/*class CustomHeaders extends SoapHeader { 
		private $wss_ns = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'; 

		function __construct($user,$pass, $ns = null) { 

			if ($ns) { 
				$this->wss_ns = $ns; 
			} 

			$auth = new stdClass(); 
			$auth->Username = new SoapVar($user, XSD_STRING, NULL, $this->wss_ns, NULL, $this->wss_ns); 
			$auth->Password = new SoapVar($pass, XSD_STRING, NULL, $this->wss_ns, NULL, $this->wss_ns); 
			$username_token = new stdClass(); 
			$username_token->UsernameToken = new SoapVar($auth, SOAP_ENC_OBJECT, NULL, $this->wss_ns, 'UsernameToken', $this->wss_ns); 
			$security_sv = new SoapVar( new SoapVar($username_token, SOAP_ENC_OBJECT, NULL, $this->wss_ns, 'UsernameToken', $this->wss_ns), SOAP_ENC_OBJECT, NULL, $this->wss_ns, 'Security', $this->wss_ns); 
			try{
				parent::__construct($this->wss_ns, 'Security', $security_sv, true); 
			}catch(Exception $e){
				echo 'Error en llegar';
				exit();
			}
		} 
	}
*/