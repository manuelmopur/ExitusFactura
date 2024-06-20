<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'/third_party/tc-lib-barcode/vendor/autoload.php';

/**
* Clase nueva para el barcode a probar
*/
class Barcode2
{
	private $objBarcode;
	private $objCodec;
	
	function __construct()
	{
		# code...
		$this->objBarcode = new \Com\Tecnick\Barcode\Barcode();
		$this->objCodec = null;
	}

	public function setData($data = ''){
		$o = $this->objBarcode->getBarcodeObj(
			'PDF417',                     // barcode type and additional comma-separated parameters
		    $data,					        // data string to encode
		    -4,                             // bar height (use absolute or negative value as multiplication factor)
		    -4,                             // bar width (use absolute or negative value as multiplication factor)
		    'black',                        // foreground color
		    array(-2, -2, -2, -2)
			)->setBackgroundColor('white');
		$this->objCodec = $o;
	}

	public function qrBarcode($data = ''){
		$o = $this->objBarcode->getBarcodeObj(
			'QRCODE',                     // barcode type and additional comma-separated parameters
		    $data,					        // data string to encode
		    -4,                             // bar height (use absolute or negative value as multiplication factor)
		    -4,                             // bar width (use absolute or negative value as multiplication factor)
		    'black',                        // foreground color
		    array(-2, -2, -2, -2)
			)->setBackgroundColor('white');
		$this->objCodec = $o;
	}

	public function barcode($data = ''){
		$o = $this->objBarcode->getBarcodeObj(
			'C128C',                     // barcode type and additional comma-separated parameters
		    $data,					        // data string to encode
		    370,                             // bar height (use absolute or negative value as multiplication factor)
		    14,                             // bar width (use absolute or negative value as multiplication factor)
		    'black',                        // foreground color
		    array(-2, -2, -2, -2)
			)->setBackgroundColor('white');
		$this->objCodec = $o;
	}

	public function getgd(){
		return $this->objCodec->getPngData();
	}
}