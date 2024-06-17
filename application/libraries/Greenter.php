<?php 
require_once 'Clinica.php';
require dirname(__FILE__) . '/../../vendor/autoload.php';
/**
 * 
 */
use Greenter\Ws\Services\SunatEndpoints;
use Greenter\See;
use Greenter\Model\Client\Client;
use Greenter\Model\Company\Company;
use Greenter\Model\Company\Address;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\Note;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;
use Greenter\XMLSecLibs\Certificate\X509Certificate;
use Greenter\XMLSecLibs\Certificate\X509ContentType;
use Greenter\Model\Sale\Document;
use Greenter\Model\Summary\Summary;
use Greenter\Model\Summary\SummaryDetail;
use Greenter\Model\Summary\SummaryPerception;

class Greenter 
{
	private $portador = null;
    private $params  = null;
    private $clinica = null;
    private $comprobante = null;
    private $company = null;

	public function __construct($parameters)
	{
        $this->params = $parameters;
        $this->clinica = new Clinica();
            /*$pfx = file_get_contents(dirname(__FILE__).'/../../keys/'.$this->params['dir_cert_priv']);
            $password = $this->params['pin'];

            $certificate = new X509Certificate($pfx, $password);
            $pem = $certificate->export(X509ContentType::PEM);
                
            file_put_contents(dirname(__FILE__).'/../../keys/certificate_prueba.pem', $pem);
            exit();*/
		$this->portador = new See(); 
        $this->portador->setService(SunatEndpoints::FE_BETA);
        $this->portador->setCertificate(file_get_contents(dirname(__FILE__).'/../../keys/'.$this->params['dir_cert_pub']));
        $this->portador->setCredentials($this->params['ruc'].$this->params['usuario_sunat'], $this->params['password_sunat']);
        // Emisor
        $address = new Address();
        $address->setUbigueo($this->params['ubigeo'])
            ->setDepartamento($this->params['departamento'])
            ->setProvincia($this->params['provincia'])
            ->setDistrito($this->params['distrito'])
            //->setUrbanizacion('NONE')
            ->setDireccion($this->params['direccion']);

        $this->company = new Company();
        $this->company->setRuc($this->params['ruc'])
            ->setRazonSocial($this->params['razon_social'])
            ->setNombreComercial($this->params['nombre_comercial'])
            ->setAddress($address);
    }

    public function preparaResumen($data,$boletas,$ruta,$fecha){
        $sum = new Summary();
        $sum->setFecGeneracion(new \DateTime(date($data['fecha_generacion'])))
            ->setFecResumen(new \DateTime(date($data['fecha'])))
            ->setCorrelativo($data['correlativo'])
            ->setCompany($this->company);
        $details = [];
        foreach ($boletas as $key => $value) {
            $detiail = new SummaryDetail();
            $detiail->setTipoDoc($value['cod_doc'])
                ->setSerieNro($value['comprobante'])
                ->setEstado($value['estado'])
                ->setClienteTipo($value['tipo_cliente'])
                ->setClienteNro($value['nrodocumento'])
                ->setTotal($value['total'])
                ->setMtoOperGravadas($value['totalsafecto'])
                //->setMtoOperInafectas(24.4)
                ->setMtoOperExoneradas($value['totalsexonerado'])
                //->setMtoOperExportacion(10)
                //->setMtoOtrosCargos(21)
                ->setMtoIGV($value['totaligv_afecto']);
            array_push($details, $detiail);
        }
        $sum->setDetails($details);

        //para armar el xml
        if(!file_exists('./archivos/'.$ruta))
            mkdir('./archivos/'.$ruta);
        if(!file_exists('./archivos/'.$ruta.'/'.$fecha))
            mkdir('./archivos/'.$ruta.'/'.$fecha);
        $this->portador->getXmlSigned($sum);
        file_put_contents('./archivos/'.$ruta.'/'.$fecha.'/'.$sum->getName().'.xml',
                        $this->portador->getFactory()->getLastXml());
        $domDocument = new \DOMDocument();
        $domDocument->load('./archivos/'.$ruta.'/'.$fecha.'/'.$sum->getName().'.xml');
        $a = $domDocument->getElementsByTagName('DigestValue');
        $b = $domDocument->getElementsByTagName('SignatureValue');
        $datos = array();
        foreach ($a as $key => $value) {
            $datos['DigestValue'] = $value->nodeValue;
        }
        foreach ($b as $key => $value) {
            $datos['SignatureValue'] = $value->nodeValue;
        }
        //Añadir en el zip
        $zip = new ZipArchive();
        $filename = './archivos/'.$ruta.'/'.$fecha.'/'.$sum->getName().'.zip';
        $zip->open($filename,ZIPARCHIVE::CREATE);
        if(file_exists('./archivos/'.$ruta.'/'.$fecha.'/'.$sum->getName().'.xml'))
            $zip->addFile('./archivos/'.$ruta.'/'.$fecha.'/'.$sum->getName().'.xml',$sum->getName().'.xml');
        $zip->close();
        //chmod($filename,0700);
        return $datos;
    }

    public function setData($data){
        $client = new Client();
        /*echo '<pre>';
        print_r($data);
        echo '</pre>';
        exit();*/
        if(isset($data['comprobante']) && $data['comprobante'] == 'nota'){
            $this->comprobante = (new Note())
                            ->setUblVersion('2.1')
                            ->setTipDocAfectado($data['c_doc'])
                            ->setNumDocfectado($data['nu_se'].'-'.$data['nu_doc'])
                            ->setCodMotivo($data['cod_tipo'])
                            ->setDesMotivo($this->getDescripcionMotivo($data['cod_tipo']))
                            ->setTipoDoc($data['cod_doc'])
                            ->setSerie($data['num_serie'])
                            ->setFechaEmision(new DateTime($data['cancelado']))
                            ->setCorrelativo($data['num_documento'])
                            ->setTipoMoneda($data['moneda'])
                            ->setMtoOperGravadas(number_format($data['totalsafecto'],2,'.',''))
                            ->setMtoIGV(number_format($data['totaligv_afecto'],2,'.',''))
                            ->setTotalImpuestos(number_format($data['totaligv_afecto'],2,'.',''))
                            ->setMtoImpVenta(number_format($data['afecto'],2,'.',''));
        }
        else{
            $this->comprobante = (new Invoice())
                        ->setUblVersion('2.1')
                        ->setTipoOperacion('0101') // Catalog. 51
                        ->setSerie($data['num_serie'])
                        ->setCorrelativo($data['num_documento'])
                        ->setFechaEmision(new DateTime($data['fecha']))
                        ->setTipoMoneda($data['moneda'])
                        //->setMtoOperGravadas(number_format($data['totalsafecto'],2,'.',''))
                        //->setMtoOperExoneradas(number_format($data['totalsexonerado'],2,'.',''))
                        ->setMtoIGV(number_format($data['totaligv_afecto'],2,'.',''))
                        //->setTotalImpuestos(18.00)
                        ->setValorVenta(number_format($data['totalsafecto'],2,'.',''))
                        ->setMtoImpVenta(number_format($data['total'],2,'.',''));
                    }
        switch ($data['cod_doc']) {
            case '01':
                {
                    $client->setTipoDoc('6')
                        ->setNumDoc($data['nroidentificacion'])
                        ->setRznSocial($data['nombrecliente']);
                    $cliente = $data['cliente'];
                    $address = new Address();
                    $address->setUbigueo($cliente->ubigeo)
                        ->setDepartamento($cliente->departamento)
                        ->setProvincia($cliente->provincia)
                        ->setDistrito($cliente->distrito)
                        //->setUrbanizacion('NONE')
                        ->setDireccion($cliente->direccion);
                    $this->comprobante->setTipoDoc($data['cod_doc']);
                    $this->comprobante->setCompany($this->company);
                    $this->comprobante->setTipoOperacion('0101');
                    $this->comprobante->setClient($client);
                    $this->comprobante->setMtoOperGravadas(number_format($data['totalsafecto'],2,'.',''));
                    $this->comprobante->setMtoOperExoneradas(number_format($data['totalsexonerado'],2,'.',''));
                    $this->comprobante->setTotalImpuestos(0.0);
                }
                break;

            case '03':
                {
                    $client->setTipoDoc('1')
                        ->setNumDoc($data['nroidentificacion'])
                        ->setRznSocial($data['nombrecliente']);
                    $this->comprobante->setTipoDoc($data['cod_doc']);
                    $this->comprobante->setCompany($this->company);
                    $this->comprobante->setTipoOperacion('0101');
                    $this->comprobante->setClient($client);
                    $this->comprobante->setMtoOperGravadas(number_format($data['totalsafecto'],2,'.',''));
                    $this->comprobante->setMtoOperExoneradas(number_format($data['totalsexonerado'],2,'.',''));
                    $this->comprobante->setTotalImpuestos(number_format($data['totaligv_afecto'],2,'.',''));
                }
                break;

            case '07':{
                $tipo_doc = '6';
                if($data['c_doc'] == '03')
                    $tipo_doc = '1';
                if($data['c_doc'] == '14')
                    $tipo_doc = '0';
                $client->setTipoDoc($tipo_doc)
                    ->setNumDoc($data['nroidentificacion'])
                    ->setRznSocial($data['nombrecliente']);
                $this->comprobante->setCompany($this->company);
                //$this->comprobante->setTipoOperacion('0101');
                $this->comprobante->setClient($client);
            }
                break;

            case '14':
                {
                    $client->setTipoDoc('0')
                        ->setNumDoc('-')
                        ->setRznSocial($data['nombrecliente']);
                    $this->comprobante->setTipoDoc('01');
                    $this->comprobante->setCompany($this->company);
                    $this->comprobante->setTipoOperacion('0200');
                    $this->comprobante->setClient($client);
                    $this->comprobante->setMtoOperExportacion(number_format($data['total'],2,'.',''));
                    $this->comprobante->setTotalImpuestos(0.0);
                }
                break;
            
            default:
                # code...
                break;
        }
    }

    public function setItems($items){
        $its = [];
        /*echo '<pre>';
        print_r($items);
        echo '</pre>';
        exit();*/
        foreach ($items as $key => $value) {
            $tipo_igv = '10';
            switch ($value['tipo_igv']) {
                case 1:
                    $tipo_igv = '10';
                    break;

                case 2:
                    $tipo_igv = '30';
                    break;

                case 3:
                    $tipo_igv = '40';
                    break;
                
                default:
                    # code...
                    break;
            }
            $monto = number_format($value['cantidad']*$value['precioventa']*(1-$value['descuento']/100),2,'.','');
            $item = (new SaleDetail())
                ->setCodProducto($value['id_item'])
                ->setUnidad($value['codigo'])
                ->setCantidad($value['cantidad'])
                ->setDescripcion($value['nombre'])
                ->setMtoBaseIgv($monto)
                ->setPorcentajeIgv(18.00) // 18%
                ->setIgv(number_format($value['igv'],2,'.',''))
                ->setTipAfeIgv($tipo_igv)
                ->setTotalImpuestos(number_format($value['igv'],2,'.',''))
                ->setMtoValorVenta($monto)
                ->setMtoValorUnitario(number_format($tipo_igv == '10' ? $value['precioventa']/1.18 : $value['precioventa'],2,'.',''))
                ->setMtoPrecioUnitario(number_format($value['precioventa'],2,'.',''))
                ->setCodProdSunat($value['cod_catalogo']);
            array_push($its, $item);
        }
        $this->comprobante->setDetails($its);
    }

    public function legenda($data){
        if(isset($data['total']))
            $t = $data['total'];
        else
            $t = $data['afecto'];
        $tota = explode('.',number_format($t,2));
        $this->comprobante->setLegends([(new Legend())->setCode('1000')->setValue($this->clinica->leterNumber($t.' Y '.(isset($tota[1]) ? $tota[1] : '00').'/100 '))]);
    }

    public function preparaXML($ruta,$fecha){
        if(!file_exists('./archivos/'.$ruta))
            mkdir('./archivos/'.$ruta);
        if(!file_exists('./archivos/'.$ruta.'/'.$fecha))
            mkdir('./archivos/'.$ruta.'/'.$fecha);
        $this->portador->getXmlSigned($this->comprobante);
        file_put_contents('./archivos/'.$ruta.'/'.$fecha.'/'.$this->comprobante->getName().'.xml',
                        $this->portador->getFactory()->getLastXml());
        $domDocument = new \DOMDocument();
        $domDocument->load('./archivos/'.$ruta.'/'.$fecha.'/'.$this->comprobante->getName().'.xml');
        $a = $domDocument->getElementsByTagName('DigestValue');
        $b = $domDocument->getElementsByTagName('SignatureValue');
        $datos = array();
        foreach ($a as $key => $value) {
            $datos['DigestValue'] = $value->nodeValue;
        }
        foreach ($b as $key => $value) {
            $datos['SignatureValue'] = $value->nodeValue;
        }
        //Añadir en el zip
        $zip = new ZipArchive();
        $filename = './archivos/'.$ruta.'/'.$fecha.'/'.$this->comprobante->getName().'.zip';
        $zip->open($filename,ZIPARCHIVE::CREATE);
        if(file_exists('./archivos/'.$ruta.'/'.$fecha.'/'.$this->comprobante->getName().'.xml'))
            $zip->addFile('./archivos/'.$ruta.'/'.$fecha.'/'.$this->comprobante->getName().'.xml',$this->comprobante->getName().'.xml');
        $zip->close();
        //chmod($filename,0700);
        return $datos;
        echo '<pre>';
        print_r($datos);
        echo '</pre>';
        exit();
        $result = $this->portador->send($this->comprobante);
        if (!$result->isSuccess()) {
            var_dump($result->getError());
            exit();
        }

        echo $result->getCdrResponse()->getDescription();
        // Guardar CDR
        file_put_contents('./archivos/'.$ruta.'/'.$fecha.'/R-'.$this->comprobante->getName().'.zip', $result->getCdrZip());
                echo $this->comprobante->getName().'   ---->>   Guardo';
                exit();
    }

    /**
     * @return mixed
     */
    public function getPortador()
    {
        return $this->portador;
    }

    /**
     * @param mixed $portador
     *
     * @return self
     */
    public function setPortador($portador)
    {
        $this->portador = $portador;

        return $this;
    }

    public function getDescripcionMotivo($cod){
        $des = [
            '01'                => 'Anulación de la operación',
            '02'                => 'Anulación por error en el RUC',
            '03'                => 'Corrección por error en la descripción',
            '04'                => 'Descuento global',
            '05'                => 'Descuento por ítem',
            '06'                => 'Devolución total',
            '07'                => 'Devolución por ítem',
            '08'                => 'Bonificación',
            '09'                => 'Disminución en el valor',
            '10'                => 'Otros Conceptos'
        ];
        return isset($des[$cod]) ? $des[$cod] : '';
    }
}
?>