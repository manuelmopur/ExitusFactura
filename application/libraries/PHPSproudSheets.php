<?php

require_once APPPATH. '/../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class PHPSproudSheets extends SpreadSheet{

	public function __construct(){
		parent::__construct();
	}
}