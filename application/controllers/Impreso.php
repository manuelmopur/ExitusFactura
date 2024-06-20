<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Impreso extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->config->load('parameters',true);
		$this->parameters = $this->config->item('parameters');
		$this->load->model('usuario');
		$this->load->model('alumno');
		$this->load->model('persona');
		$this->load->model('pagos');
        $this->load->model('utils');
		if(isset($_SESSION['usuario'])){
			$u = $_SESSION['usuario'];
			//dumpvar($u);
			/*if($u['id_rol'] != 1 && $u['id_rol'] != 2 && $u['id_rol'] != 5){
				header('Location: '.base_url());
			}*/
		}else{
			header('Location: '.base_url('admin'));
		}
	}

    public function carnetsalumno(){
        if(!$this->input->post()){
            header('Location: '.base_url());
        }
        //dumpvar($this->input->post(null,true));
        $alumnos = $this->input->post('codigos');
        $this->alumno->updateCarnetsImpreso($alumnos);
        $param = $this->parameters;
        $this->load->library('pdf');
        $this->pdf = new Pdf();

        $this->pdf->AddPage('P','LEGAL');
        $this->pdf->SetMargins(5,5);
        $this->pdf->AliasNbPages();
        $this->pdf->SetTitle('carnets alumnos ');
        $this->pdf->SetFont('Arial','I',8);

        $x = 5;
        $y = 5;

        /*
        $this->pdf->SetXY($x,$y);
        $this->pdf->MultiCell(205,330,'',0);
        */

        foreach ($alumnos as $key => $value) {
            
            $alumno = $this->alumno->getAlumno($value);
            //dumpvar($alumno);
            $this->pdf->SetXY($x,$y);
            $this->pdf->SetDrawColor(150,150,150);
            $this->pdf->MultiCell(95,60,'',1);//ancho y alto de los carnet parte frontal 93.5, 55

            //logo
            $this->pdf->Image(BASEPATH.'../assets/assets/img/'.$param['logo-impreso'],$x+1,$y+2,59.5,17);//logo del documento 16,0

            $this->pdf->SetXY($x+62,$y+2);
            $this->pdf->SetDrawColor(255,0,0);
            $this->pdf->SetLineWidth(1);
            $this->pdf->MultiCell(32,47,'',1);//ancho y alto del marco de la foto 23 y 30
            
            if(file_exists(BASEPATH."../fotos/".strtoupper($alumno->area).'/'.$alumno->foto)){
                $photo = BASEPATH."../fotos/".strtoupper($alumno->area).'/'.$alumno->foto;
                $this->pdf->Image($photo,$x+62.7,$y+2.7,30.7,45.6);//tamaño de la foto
            }

            $this->pdf->SetLineWidth(0);
            $this->pdf->SetFont('Arial','B',15);
            $this->pdf->SetXY($x+1,$y+22);
            $this->pdf->SetFillColor(255,0,0);
            $this->pdf->RoundedRect($x+1, $y+19, 59, 8, 3.5, 'F');
            $text = iconv('UTF-8', 'windows-1252', 'CARNÉ DE ESTUDIOS');
            $this->pdf->SetTextColor(255,255,255);
            $this->pdf->SetXY($x+1,$y+23);
            $this->pdf->Cell(60.5,0,$text,0,0,'L');

            $this->pdf->SetFont('Arial','',10);
            $this->pdf->SetTextColor(0,0,0);
            $this->pdf->SetXY($x+1,$y+30);
            $text = iconv('UTF-8', 'windows-1252', 'Apellidos: ');
            $this->pdf->Cell(17,0,$text,0,0,'L');
            $this->pdf->SetFont('Arial','B',11);
            $this->pdf->SetXY($x+1,$y+35);
            $text = iconv('UTF-8', 'windows-1252', strtoupper($alumno->apellidos));
            $this->pdf->Cell(40,0,$text,0,0,'L');

            $this->pdf->SetFont('Arial','',10);
            $this->pdf->SetXY($x+1,$y+40);
            $text = iconv('UTF-8', 'windows-1252', 'Nombres: ');
            $this->pdf->Cell(17,0,$text,0,0,'L');
            $this->pdf->SetFont('Arial','B',11);
            $this->pdf->SetXY($x+1,$y+45);
            $text = iconv('UTF-8', 'windows-1252', strtoupper($alumno->nombres));
            $this->pdf->Cell(40,0,$text,0,0,'L');

            $this->pdf->SetFont('Arial','',10);
            $this->pdf->SetXY($x+1,$y+50);
            $text = iconv('UTF-8', 'windows-1252', 'Área: ');
            $this->pdf->Cell(10,0,$text,0,0,'L');
            $this->pdf->SetFont('Arial','B',11);
            $text = iconv('UTF-8', 'windows-1252', $alumno->area);
            $this->pdf->Cell(16,0,$text,0,0,'L');

            $this->pdf->SetFont('Arial','',10);
            $this->pdf->SetXY($x+33,$y+50);
            $text = iconv('UTF-8', 'windows-1252', 'Turno: ');
            $this->pdf->Cell(11,0,$text,0,0,'L');
            $this->pdf->SetFont('Arial','B',11);
            $text = iconv('UTF-8', 'windows-1252', $alumno->turno);
            $this->pdf->Cell(16,0,$text,0,0,'L');

            $this->pdf->SetXY($x+51,$y+55);
            $this->pdf->SetFont('Arial','',10);
            $text = iconv('UTF-8', 'windows-1252', 'Aula: ');
            $this->pdf->Cell(9,0,$text,0,0,'L');
            $this->pdf->SetXY($x+62,$y+51);
            $this->pdf->SetDrawColor(0,0,0);
            $this->pdf->Cell(6.4,7,'',1,0,'L');
            $this->pdf->Cell(6.4,7,'',1,0,'L');
            $this->pdf->Cell(6.4,7,'',1,0,'L');
            $this->pdf->Cell(6.4,7,'',1,0,'L');
            $this->pdf->Cell(6.4,7,'',1,0,'L');
            $this->pdf->SetDrawColor(0,0,0);

            $this->pdf->SetXY($x+3,$y+52.5);
            $this->pdf->SetFont('Arial','B',14);
            $this->pdf->SetFillColor(255,0,0);
            $text = iconv('UTF-8', 'windows-1252', $alumno->codigo);
            $this->pdf->Cell(22,6,$text,1,1,'L');
            $this->pdf->SetFillColor(0,0,0);


            //al siguiente
            if($key != 0 && ($key+1)%2 == 0){
                $x = 5;
                $y += 65;
            }else{
                $x += 110;//posicion de los carnet de la derecha
            }
            
            if($key != 0 && ($key+1) %10 == 0 && isset($alumnos[$key+1])){
                $this->pdf->AddPage('P','LEGAL');
                $this->pdf->SetMargins(5,5);
                $this->pdf->AliasNbPages();
                $this->pdf->SetTitle('carnets alumnos ');
                $this->pdf->SetFont('Arial','I',8);
                $this->pdf->MultiCell(205,330,'',0);
                $x = $y = 5;
            }
            //$y += 76;
        }

            $this->pdf->AddPage('P','LEGAL');
            $this->pdf->SetMargins(5,5);
            $this->pdf->AliasNbPages();
            $this->pdf->SetTitle('carnets alumnos ');
            $this->pdf->SetFont('Arial','I',8);
            $this->pdf->MultiCell(205,330,'',0);


        $x = 115; //ubicacion del primer carnet
        $y = 5;

        //para la parte reversa del carnet
        foreach ($alumnos as $key => $value) {
            $alumno = $this->alumno->getAlumno($value);

            $ciclo = $this->utils->getCiclo($alumno->ciclo_id);
            $this->pdf->SetXY($x,$y);
            $this->pdf->SetDrawColor(150,150,150);
            $this->pdf->MultiCell(95,60,'',1); //tamaño de los carnet

            $this->pdf->SetXY($x+7,$y+3);
            $this->pdf->SetFont('Arial','B',12);
            $text = iconv('UTF-8', 'windows-1252', strtoupper($ciclo->Descripcion));
            $this->pdf->Cell(85,0,$text,0,0,'C');


            $this->pdf->SetXY($x+10,$y+7);
            $this->pdf->SetFont('Arial','',10);
            $text = iconv('UTF-8', 'windows-1252', 'Inicio: '.$alumno->fch_inicio);
            $this->pdf->Cell(50,0,$text,0,0,'L');
            $text = iconv('UTF-8', 'windows-1252', 'Fin: '.($alumno->fch_fin == '0001-01-01' ? '-' : $alumno->fch_fin));
            $this->pdf->Cell(50,0,$text,0,0,'L');

            $pago = $this->pagos->getPago($value);
            if(!is_numeric($pago) && $pago->Tipo_Pago == 1){
                $this->pdf->SetXY($x+7,$y+8);
                $this->pdf->SetFont('Arial','B',10);
                $this->pdf->SetDrawColor(255,255,0);
                $text = iconv('UTF-8', 'windows-1252', 'CONTADO');
                $this->pdf->Cell(85,5.5,$text,0,0,'C');
                $this->pdf->SetFillColor(0,0,0);
                $this->pdf->SetDrawColor(0,0,0);
                //Pago
                $this->pdf->SetFont('Arial','B',8);
                $this->pdf->SetDrawColor(0,0,0);
                $this->pdf->SetXY($x+25,$y+15);
                $this->pdf->Cell(12,10,'PAGO',1,1,'C');
                $this->pdf->SetXY($x+37,$y+15);
                $this->pdf->Cell(15,5,date('d/m/Y',strtotime($pago->Fecha_Pago_Inicial)),1,0,'C');
                $this->pdf->SetXY($x+37,$y+20);
                $this->pdf->Cell(15,5,$pago->Monto,1,0,'C');

                //Material
                $this->pdf->SetFont('Arial','B',8);
                $this->pdf->SetDrawColor(0,0,0);
                $this->pdf->SetXY($x+57,$y+15);
                $this->pdf->Cell(15,5,'MATERIAL',1,1,'C');
                $this->pdf->SetXY($x+57,$y+20);
                $this->pdf->Cell(15,5,$pago->Material,1,0,'C');
            }else{
                //Incial
                $this->pdf->SetFont('Arial','B',8);
                $this->pdf->SetDrawColor(0,0,0);
                $this->pdf->SetXY($x+2,$y+9);
                $this->pdf->Cell(12,10,'INICIAL',1,1,'C');
                $this->pdf->SetXY($x+14,$y+9);
                $this->pdf->Cell(15,5,date('d/m/Y',strtotime($pago->Fecha_Pago_Inicial)),1,0,'C');
                $this->pdf->SetXY($x+14,$y+14);
                $this->pdf->Cell(15,5,$pago->Inicial,1,0,'C');

                //Material
                $this->pdf->SetFont('Arial','B',8);
                $this->pdf->SetDrawColor(0,0,0);
                $this->pdf->SetXY($x+2,$y+20);
                $this->pdf->Cell(15,5,'MATERIAL',1,1,'C');
                $this->pdf->SetXY($x+2,$y+25);
                $this->pdf->Cell(15,5,$pago->Material,1,0,'C');

                $cuotas = $this->pagos->getCuota($pago->id);
                //dumpvar($pago);
                $xx = 30;
                $yy = 0;
                if(!is_numeric($cuotas))
                    foreach ($cuotas as $ky => $value) if($ky < 6) {
                        if($ky == 3){
                            $xx = 18;
                            $yy *= 0;
                            $yy += 11;
                        }
                        $this->pdf->SetFont('Arial','B',8);
                        $this->pdf->SetDrawColor(0,0,0);
                        $this->pdf->SetXY($x+2+$xx,$y+9+$yy);
                        $text = iconv('UTF-8', 'windows-1252', ($ky+1).'°');
                        $this->pdf->Cell(5,10,$text,1,1,'C');
                        $this->pdf->SetXY($x+7+$xx,$y+9+$yy);
                        $this->pdf->Cell(15,5,date('d/m/Y',strtotime($value->Fecha_Expiracion)),1,0,'C');
                        $this->pdf->SetXY($x+7+$xx,$y+14+$yy);
                        $this->pdf->Cell(15,5,$value->Monto,1,0,'C');
                        $xx += 21;
                    }
            }

            //codigo de QR
            $this->pdf->SetXY($x+9,$y+32);
            if(!file_exists(BASEPATH.'../barcodes/'.substr($ciclo->Fecha_Inicio,0,10).$alumno->codigo.'-qr.png')){
                $this->load->library('barcode2');
                $this->barcode2->qrBarcode($alumno->id.'|'.$alumno->codigo.'|'.$alumno->nombres.'|'.$alumno->apellidos.'|'.$alumno->area.'|'.$ciclo->Fecha_Inicio);
                $a = $this->barcode2->getgd();
                file_put_contents('./barcodes/'.substr($ciclo->Fecha_Inicio,0,10).$alumno->codigo.'-qr.png', $a);
            }
            $this->pdf->Image(BASEPATH.'../barcodes/'.substr($ciclo->Fecha_Inicio,0,10).$alumno->codigo.'-qr.png',null,null,18,18);//logo del documento

            //codigo de Barras
            $this->pdf->SetXY($x+29,$y+30);
            if(!file_exists(BASEPATH.'../barcodes/'.substr($ciclo->Fecha_Inicio,0,10).$alumno->codigo.'-pdf.png')){
                $this->load->library('barcode2');
                $this->barcode2->setData($alumno->id.'|'.$alumno->codigo.'|'.$alumno->nombres.'|'.$alumno->apellidos.'|'.$alumno->area.'|'.$ciclo->Fecha_Inicio);
                $a = $this->barcode2->getgd();
                file_put_contents('./barcodes/'.substr($ciclo->Fecha_Inicio,0,10).$alumno->codigo.'-pdf.png', $a);
            }
            $this->pdf->Image(BASEPATH.'../barcodes/'.substr($ciclo->Fecha_Inicio,0,10).$alumno->codigo.'-pdf.png',null,null,62,22);//logo del documento

            $this->pdf->SetXY($x+10,$y+52);
            $this->pdf->SetFont('Arial','',7);
            $text = iconv('UTF-8', 'windows-1252', 'Calle Arequipa # 304, Piura 073-331669 | 073-323644, #AcademiaExitus');
            $this->pdf->Cell(75,0,$text,0,0,'C');

            $this->pdf->SetXY($x+10,$y+55);
            $this->pdf->SetFont('Arial','B',7);
            $text = iconv('UTF-8', 'windows-1252', 'Este carné será presentado por el titular, cada vez que sea requerido');
            $this->pdf->Cell(75,0,$text,0,0,'C');

            $this->pdf->SetXY($x+10,$y+58);
            $this->pdf->SetFont('Arial','B',7);
            $text = iconv('UTF-8', 'windows-1252', 'como único documento de identidad');
            $this->pdf->Cell(75,0,$text,0,0,'C');
            
            //al siguiente
            if($key != 0 && ($key+1)%2 == 0){
                $x = 115;
                $y += 65;
            }else{
                $x -= 110;
            }
            if($key != 0 && ($key+1)%10 == 0 && isset($alumnos[$key+1])){
                $this->pdf->AddPage('P','LEGAL');
                $this->pdf->SetMargins(5,5);
                $this->pdf->AliasNbPages();
                $this->pdf->SetTitle('carnets alumnos ');
                $this->pdf->SetFont('Arial','I',8);
                $this->pdf->MultiCell(205,330,'',0);
                $x = 115; //posicion del carnet de la segunda hoja
                $y = 5;
            }
        }

        $this->pdf->Close();
        //$this->pdf->Output(BASEPATH."../pdfs/".$data_venta->num_serie.'-'.$data_venta->num_documento."-A4.pdf", 'F');
        $this->pdf->Output(base_url()."tmp/".'carnet: '.$alumno->nombres.".pdf", 'I');
    }

    public function carnetalumno($id_alumno= 0){
        if($id_alumno == 0)
            header('Location: '.base_url());
        $alumno = $this->alumno->getAlumno($id_alumno);
        if(is_numeric($alumno))
            header('Location: '.base_url());
        $ciclo = $this->utils->getCiclo($alumno->ciclo_id);
        /*echo '<pre>';
        print_r($ciclo);
        echo '</pre>';
        exit();*/
        $param = $this->parameters;
        $this->load->library('pdf');

        $this->pdf = new Pdf();
        $this->pdf->AddPage('P','CARNET');
        $this->pdf->SetMargins(0,0,0);
        $this->pdf->AliasNbPages();
        $this->pdf->SetTitle('carnet: '.$alumno->nombres);
        $this->pdf->SetFont('Arial','I',8);
        $this->pdf->SetXY(1,1);
        $this->pdf->MultiCell(107,70,'',1);

        //logo
        $this->pdf->Image(BASEPATH.'../assets/assets/img/'.$param['logo'],2,2,20);//logo del documento
        $this->pdf->SetFont('Arial','I',9);
        $this->pdf->SetTextColor(0,0,255);
        $this->pdf->SetXY(32,4);
        $this->pdf->Cell(22.5,2,'Academia Pre-Universitaria',0,0,'C');
        $this->pdf->SetFont('Arial','IB',34);
        $this->pdf->SetTextColor(0,0,255);
        $this->pdf->SetXY(31,11);
        $this->pdf->Cell(22.5,2,'EXITUS',0,0,'C');
        $this->pdf->SetFont('Arial','I',9);
        $this->pdf->SetTextColor(0,0,255);
        $this->pdf->SetXY(31,17);
        $text = iconv('UTF-8', 'windows-1252', 'La Pre de la nueva generación');
        $this->pdf->Cell(22.5,2,$text,0,0,'C');

        $this->pdf->SetXY(75,2);
        $this->pdf->MultiCell(28,37,'',1);
        $this->pdf->Image(BASEPATH."../fotos/".strtoupper($alumno->area).'/'.$alumno->foto,76,3,26,35);

        $this->pdf->SetFont('Arial','B',17);
        $this->pdf->SetXY(4,25);
        $this->pdf->SetFillColor(255,0,0);
        $this->pdf->RoundedRect(4, 22, 66.5, 10, 3.5, 'DF');
        $this->pdf->SetTextColor(255,255,0);
        $this->pdf->SetXY(4,27);
        $text = iconv('UTF-8', 'windows-1252', 'CARNÉ DE ESTUDIOS');
        $this->pdf->Cell(66.5,0,$text,0,0,'L');

        $this->pdf->SetFont('Arial','',10);
        $this->pdf->SetTextColor(0,0,0);
        $this->pdf->SetXY(4,38);
        $text = iconv('UTF-8', 'windows-1252', 'Apellidos: ');
        $this->pdf->Cell(17,0,$text,0,0,'L');
        $this->pdf->SetFont('Arial','B',10);
        $text = iconv('UTF-8', 'windows-1252', $alumno->apellidos);
        $this->pdf->Cell(40,0,$text,0,0,'L');
$this->pdf->SetFont('Arial','',10);
        $this->pdf->SetXY(4,44);
        $text = iconv('UTF-8', 'windows-1252', 'Nombres: ');
        $this->pdf->Cell(17,0,$text,0,0,'L');
$this->pdf->SetFont('Arial','B',10);
        $text = iconv('UTF-8', 'windows-1252', $alumno->nombres);
        $this->pdf->Cell(40,0,$text,0,0,'L');
$this->pdf->SetFont('Arial','',10);
        $this->pdf->SetXY(4,50);
        $text = iconv('UTF-8', 'windows-1252', 'Área: ');
        $this->pdf->Cell(12,0,$text,0,0,'L');
$this->pdf->SetFont('Arial','B',10);
        $text = iconv('UTF-8', 'windows-1252', $alumno->area);
        $this->pdf->Cell(20,0,$text,0,0,'L');
$this->pdf->SetFont('Arial','',10);
        $text = iconv('UTF-8', 'windows-1252', 'Turno: ');
        $this->pdf->Cell(13,0,$text,0,0,'L');
$this->pdf->SetFont('Arial','B',10);
        $text = iconv('UTF-8', 'windows-1252', $alumno->turno);
        $this->pdf->Cell(20,0,$text,0,0,'L');
$this->pdf->SetFont('Arial','',10);
        $text = iconv('UTF-8', 'windows-1252', 'Aula: ');
        $this->pdf->Cell(13,0,$text,0,0,'L');
        $this->pdf->SetXY(80,47);
        $this->pdf->Cell(5,5,'',1,0,'L');
        $this->pdf->Cell(5,5,'',1,0,'L');
        $this->pdf->Cell(5,5,'',1,0,'L');
        $this->pdf->Cell(5,5,'',1,0,'L');
        $this->pdf->Cell(5,5,'',1,0,'L');

        $this->pdf->SetXY(4,50);
        $this->pdf->AddPage('P','CARNET');
        $this->pdf->SetMargins(0,0,0);
        $this->pdf->AliasNbPages();
        $this->pdf->SetXY(1,1);
        $this->pdf->MultiCell(107,70,'',1);

        $this->pdf->SetXY(4,4);
$this->pdf->SetFont('Arial','B',12);
        $text = iconv('UTF-8', 'windows-1252', $ciclo->Descripcion);
        $this->pdf->Cell(0,0,$text,0,0,'C');


        $this->pdf->SetXY(4,10);
$this->pdf->SetFont('Arial','',10);
        $text = iconv('UTF-8', 'windows-1252', 'Inicio: '.$ciclo->Fecha_Inicio);
        $this->pdf->Cell(50,0,$text,0,0,'L');
        $text = iconv('UTF-8', 'windows-1252', 'Fin: '.$ciclo->Fecha_Fin);
        $this->pdf->Cell(50,0,$text,0,0,'L');

        //codigo de barras
        $this->pdf->SetXY(4,15);
        if(!file_exists(BASEPATH.'../barcodes/'.substr($ciclo->Fecha_Inicio,0,10).$alumno->codigo.'-qr.png')){
            $this->load->library('barcode2');
            $this->barcode2->qrBarcode($alumno->id.'|'.$alumno->codigo.'|'.$alumno->nombres.'|'.$alumno->apellidos.'|'.$alumno->area.'|'.$ciclo->Fecha_Inicio);
            $a = $this->barcode2->getgd();
            file_put_contents('./barcodes/'.substr($ciclo->Fecha_Inicio,0,10).$alumno->codigo.'-qr.png', $a);
        }
        $this->pdf->Image(BASEPATH.'../barcodes/'.substr($ciclo->Fecha_Inicio,0,10).$alumno->codigo.'-qr.png',null,null,30,30);//logo del documento

        $this->pdf->SetXY(35,15);
        if(!file_exists(BASEPATH.'../barcodes/'.substr($ciclo->Fecha_Inicio,0,10).$alumno->codigo.'.png')){
            $this->load->library('barcode2');
            $this->barcode2->setData($alumno->id.'|'.$alumno->codigo.'|'.$alumno->nombres.'|'.$alumno->apellidos.'|'.$alumno->area.'|'.$ciclo->Fecha_Inicio);
            $a = $this->barcode2->getgd();
            file_put_contents('./barcodes/'.substr($ciclo->Fecha_Inicio,0,10).$alumno->codigo.'.png', $a);
        }
        $this->pdf->Image(BASEPATH.'../barcodes/'.substr($ciclo->Fecha_Inicio,0,10).$alumno->codigo.'.png',null,null,70,30);//logo del documento

        $this->pdf->SetXY(4,63);
$this->pdf->SetFont('Arial','',7);
        $text = iconv('UTF-8', 'windows-1252', 'Calle Arequipa # 304, Piura 073-331669 | 073-323644, #AcademiaExitus');
        $this->pdf->Cell(0,0,$text,0,0,'C');

        $this->pdf->SetXY(4,66);
$this->pdf->SetFont('Arial','B',7);
        $text = iconv('UTF-8', 'windows-1252', 'Este carné será presentado por el titular, cada vez que sea requerido como único');
        $this->pdf->Cell(0,0,$text,0,0,'C');
        $this->pdf->SetXY(4,69);
$this->pdf->SetFont('Arial','B',7);
        $text = iconv('UTF-8', 'windows-1252', 'documento de identidad');
        $this->pdf->Cell(0,0,$text,0,0,'C');

        $this->pdf->Close();
        //$this->pdf->Output(BASEPATH."../pdfs/".$data_venta->num_serie.'-'.$data_venta->num_documento."-A4.pdf", 'F');
        $this->pdf->Output(base_url()."tmp/".'carnet: '.$alumno->nombres.".pdf", 'I');
    }

	public function comprobanteA4($documento = ''){
		if($documento == ''){
			header('Location: '.base_url());
		}
		if(file_exists(BASEPATH."../pdfs/".$documento.'-A4.pdf')){
			header("Content-type: application/pdf");
			header("Content-Disposition: inline; filename=filename.pdf");
			@readfile(BASEPATH."../pdfs/".$documento.'-A4.pdf');
			exit();
		}
		$comp = explode('-', $documento);
		if(count($comp) != 2){
			header('Location: '.base_url());
		}
		$comprobante = $this->pagos->getComprobante($comp[0],$comp[1]);
		if(is_numeric($comprobante)){
			header('Location: '.base_url());
		}
        $usuario = $this->session->userdata('usuario');
		$param = $this->parameters;
		$this->load->library('pdf');
		$this->pdf = new Pdf();
		$this->pdf->AddPage('P','A4');
		$this->pdf->SetMargins(10,0,0);
		$this->pdf->AliasNbPages();
		$this->pdf->SetTitle(($comprobante->cod_doc == '03' ? 'Boleta' : 'Factura').': '.$comprobante->num_serie.'-'.$comprobante->num_documento);
		$this->pdf->Image(BASEPATH.'../assets/assets/img/'.$param['logo'],12,16,22);//logo del documento
        $this->pdf->Ln(2);
        $this->pdf->SetFont('Arial','B',8);

        $this->pdf->SetXY(10,13);
        $this->pdf->Cell(90,38,'',1,1,'R');
        $this->pdf->SetXY(55,21);
        $rz = $this->partir_string($param['razon_social']);
        $this->pdf->Cell(22.5,2,$rz[0],0,0,'C');
        if(count($rz) > 1){
        	$this->pdf->Ln(3);
	        $this->pdf->SetXY(55,25);
        	$this->pdf->Cell(22.5,2,$rz[1],0,0,'C');
        	$this->pdf->SetXY(55,29);
        }
        $this->pdf->Cell(22.5,2,$param['ruc'],0,0,'c');
        //$this->pdf->Write(-47,'R.U.C. '.$param['ruc']);
        $this->pdf->SetFont('Arial','',8);
        //$this->pdf->Ln(1);
        $this->pdf->SetXY(55,34);
        //$title = iconv('UTF-8', 'windows-1252', $param['direccion']);
        $dirs = $this->partir_string($param['direccion'],40);
        foreach ($dirs as $key => $value) {
        	$this->pdf->Cell(22.5,2,$value,0,0,'C');
        	$this->pdf->Ln(3);
        	$this->pdf->Cell(45,2,'',0,0,'C');
        }
        $this->pdf->Cell(22.5,2,$param['locacion'],0,0,'C');
        //$this->pdf->Ln(2);
        $this->pdf->SetXY(55,42);
        $title = iconv('UTF-8', 'windows-1252', 'Teléfono: '.$param['telefono']);
        $this->pdf->Cell(22.5,2,$title,0,0,'C');
        $this->pdf->Ln(4);
        $this->pdf->SetXY(105,13);
        $this->pdf->Cell(95,38,'',1,1,'R');
        //$this->pdf->Ln(4);
        $this->pdf->SetFont('Arial','B',14);
        $title = iconv('UTF-8', 'windows-1252', ($comprobante->cod_doc == '03' ? 'BOLETA' : 'FACTURA').' ELECTRÓNICA');
        $this->pdf->SetXY(128,22);
        $this->pdf->Write(0,'R.U.C. '.$param['ruc']);
        $this->pdf->SetFont('Arial','B',18);
        $this->pdf->SetXY($comprobante->cod_doc == '01' ? 122 : 112,32);
        $this->pdf->Write(0,$title);
        $this->pdf->Ln(1);
        $this->pdf->SetFont('Arial','B',14);
        $this->pdf->SetXY(133,42);
        $this->pdf->Write(0,$comprobante->num_serie.'-'.$comprobante->num_documento);
        $this->pdf->Ln(13);
        $this->pdf->SetFont('Arial','',8);
	        $this->pdf->SetXY(10,53);
	        $this->pdf->Cell(190,20,'',1,1,'R');
	        $this->pdf->SetXY(10,58);

        $cliente = $comprobante->cod_doc == '03' ? $this->persona->getPersonaForId($comprobante->persona_id) : $this->pagos->getCliente($comprobante->empresa_id);
        //para el comprobante y el paciente
        $this->pdf->Cell(16,0,'Sr.(es)',0,0,'I');
        $this->pdf->SetFont('Arial','B',8);
        $cl = $this->partir_string($comprobante->cod_doc == '03' ? $cliente->persona: $cliente->razon_social);
        foreach ($cl as $key => $value) {
        	$this->pdf->Cell(0,0,($key == 0 ? ' :': '').$value,0,0,'I');
        }
        $this->pdf->SetFont('Arial','',8);
        //$title = iconv('UTF-8', 'windows-1252', $trama_venta['nombrecliente']);
        //$this->pdf->Cell(0,0,' : '.strtoupper($title),0,'I');
        $this->pdf->Ln(3);
        $this->pdf->Cell(16,0,(strlen($cliente->nroidentificacion) > 8) ? 'R.U.C' : 'D.N.I.',0,0,'I');
        $this->pdf->Cell(0,0,' : '.$cliente->nroidentificacion,0,0,'I');
        $this->pdf->Ln(3);
        $title = iconv('UTF-8', 'windows-1252', 'Dirección');
        $this->pdf->Cell(16,0,$title,0,0,'I');
        $direccion = iconv('UTF-8', 'windows-1252', isset($cliente->direccion) ? $cliente->direccion : '');
        $this->pdf->Cell(0,0,' : '.substr($direccion,0,100),0,0,'I');
        if(strlen($direccion) > 100){
        	$this->pdf->Ln(3);
        	$this->pdf->Cell(18,0,'',0,0,'I');
        	$this->pdf->Cell(0,0,''.substr($direccion,100),0,0,'I');
        }
        $this->pdf->Ln(3);
        $this->pdf->Cell(16,0,'Fecha',0,0,'I');
        $f = explode('-',substr($comprobante->fecha,0,10));
        $this->pdf->Cell(0,0,' : '.implode('-',array_reverse($f)),0,0,'I');
        if(strlen($direccion) > 100)
        	$this->pdf->Ln(5);
        else
        	$this->pdf->Ln(8);
        $this->pdf->MultiCell(190,142,'',1,'C');
        $this->pdf->SetXY(10,75);
        $this->pdf->Cell(15,6,'CANTIDAD',1,0,'C');
        $this->pdf->Cell(18,6,'UNIDAD',1,0,'C');
	    $this->pdf->Cell(125,6,'DESCRIPCION',1,0,'C');
        $this->pdf->Cell(16,6,'PRECIO',1,0,'C');
        $this->pdf->Cell(16,6,'TOTAL',1,0,'C');
        $this->pdf->SetXY(10,81);
        $this->pdf->Cell(15,136,'',1,0,'C');
        $this->pdf->Cell(18,136,'',1,0,'C');
	    $this->pdf->Cell(125,136,'',1,0,'C');
        $this->pdf->Cell(16,136,'',1,0,'C');
        $this->pdf->Cell(16,136,'',1,0,'C');
        $this->pdf->SetXY(10,83);

        $total = 0;

        //DETALLES DEL COMPROBANTE
        $detalles = $this->pagos->getDetallesComprobante($comprobante->num_serie,$comprobante->num_documento);
	    foreach ($detalles as $key => $value) {
	    	$this->pdf->Cell(15,0,$value->cantidad,0,0,'I');
	    	$this->pdf->Cell(18,0,' ',0,0,'I');
	    	$descrip = $this->partir_string($value->descripcion,100);
	    	//$title = iconv('UTF-8', 'windows-1252', $descrip[0]);
	    	$this->pdf->Cell(125,0,$descrip[0],0,0,'I');
	    	$this->pdf->Cell(16,0,number_format($value->precio,2,'.',''),0,0,'I');
	    	$this->pdf->Cell(16,0,number_format($value->precio*$value->cantidad,2,'.',''),0,0,'I');
	    	$total = number_format($value->precio * $value->cantidad,2,'.','');
        	$this->pdf->Ln(4);
	    	foreach ($descrip as $k => $val) if($k != 0){
	    		$this->pdf->Cell(15,0,' ',0,0,'I');
	    		$this->pdf->Cell(18,0,' ',0,0,'I');
	    		$this->pdf->Cell(58,0,$val,0,0,'I');
	    		$this->pdf->Cell(12,0,' ',0,0,'I');
	    		$this->pdf->Cell(10,0,' ',0,0,'I');
	    		$this->pdf->Ln(4);
	    	}
	    }

	    $this->pdf->SetXY(10,215);
        $this->pdf->Ln(4);
        $this->load->library('clinica');
        $tota = explode('.',number_format($total,2));
        $this->pdf->SetFont('Arial','B',10);
        $m = ['PEN'=>'SOLES','USD'=>'DOLARES AMERICANOS','EUR'=>'EUROS'];
        $moneda = $m[$comprobante->moneda];
        $this->pdf->Cell(0,0,'SON: '.$this->clinica->leterNumber($comprobante->total).' Y '.(isset($tota[1]) ? $tota[1] : '00').'/100 '.$moneda,0,0,'I');
        $this->pdf->SetXY(10,223);
        $this->pdf->SetFont('Arial','',8);
        $f = new DateTime($comprobante->fecha);
        //$f = substr(date($trama_venta['fecha']), 0,10);
		$a = explode('-', $f->format('Y-m-d'));

		$this->pdf->Close();
		//$this->pdf->Output(BASEPATH."../pdfs/".$data_venta->num_serie.'-'.$data_venta->num_documento."-A4.pdf", 'F');
		$this->pdf->Output(base_url()."tmp/".$comprobante->num_serie.'-'.$comprobante->num_documento.".pdf", 'I');
	}

    public function provisional($documento = ''){
        if($documento == ''){
            header('Location: '.base_url());
        }
        if(file_exists(BASEPATH."../pdfs/".$documento.'-A7.pdf')){
            header("Content-type: application/pdf");
            header("Content-Disposition: inline; filename=filename.pdf");
            @readfile(BASEPATH."../pdfs/".$documento.'-A7.pdf');
            exit();
        }
        $comp = explode('-', $documento);
        if(count($comp) != 2){
            header('Location: '.base_url());
        }
        $comprobante = $this->pagos->getProvisional($comp[0],$comp[1]);
        //dumpvar($comprobante);
        if(is_numeric($comprobante)){
            header('Location: '.base_url());
        }

        $usuario = $this->session->userdata('usuario');
        $param = $this->parameters;
        $this->load->library('pdf');
        $this->pdf = new Pdf();
        $this->pdf->AddPage('P','A7');
        $this->pdf->SetMargins(4,0,5);
        $this->pdf->AliasNbPages();
        $this->pdf->SetTitle('Provisional: '.$comprobante->num_serie.'-'.$comprobante->num_documento);
        $this->pdf->Image(BASEPATH.'../assets/assets/img/'.$param['logo'],4,8,15);//logo del documento
        $this->pdf->SetFont('Arial','B',6);

        $razon_social = $this->partir_string($param['razon_social'],40);
        foreach ($razon_social as $key => $value) {
            $this->pdf->Cell(0,0,$value,0,0,'C');
            $this->pdf->Ln(4);
        }

        //$this->pdf->Ln(3);
        $this->pdf->SetFont('Arial','',6);
        //$this->pdf->Cell(22);
        $this->pdf->Cell(0,0,'R.U.C. '.$param['ruc'],0,0,'C');
        $this->pdf->Ln(4);
        $title = iconv('UTF-8', 'windows-1252', $param['direccion']);
        $this->pdf->Cell(0,0,$title,0,0,'C');
        $this->pdf->Ln(3);
        $title = iconv('UTF-8', 'windows-1252', $param['locacion']);
        $this->pdf->Cell(0,0,$title,0,0,'C');
        $this->pdf->Ln(3);

        if($usuario['sede_id'] != 1){
            $this->load->model('utils');
            $sede = $this->utils->getSede($usuario['sede_id']);
            $sucursal = $this->partir_string(strtoupper($sede->Descripcion.' - '.$sede->direccion),50);
            $this->pdf->Ln(3);
            $this->pdf->Cell(0,0,'SUCURSAL',0,0,'C');
            $this->pdf->Ln(3);
            foreach ($sucursal as $key => $value) {
                $this->pdf->Cell(0,0,$value,0,0,'C');
                $this->pdf->Ln(3);
            }
        }
        $title = iconv('UTF-8', 'windows-1252', 'Teléfono: '.$param['telefono']);
        $this->pdf->Cell(0,0,$title,0,0,'C');
        $this->load->database();
        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial','B',9);
        $title = iconv('UTF-8', 'windows-1252', 'COMPROBANTE PROVISIONAL');
        $this->pdf->Cell(0,0,$title,0,0,'C');
        $this->pdf->Ln(4);
        $this->pdf->SetFont('Arial','',9);
        $this->pdf->Cell(0,0,$comprobante->num_serie.'-'.$comprobante->num_documento,0,0,'C');
        $this->pdf->Ln(4);
        $this->pdf->SetFont('Arial','',6);
        $title = iconv('UTF-8', 'windows-1252', 'Fecha de Emisión: '.date('d/m/Y',strtotime(date($comprobante->fecha))));
        $this->pdf->Cell(60,0,$title,0,0,'I');
        $this->pdf->Cell(30,0,date('H:i'),0,0,'I');
        $this->pdf->Ln(2);
        $this->pdf->Cell(0,0,'----------------------------------------------------------------------------------------------------------------------',0,0,'C');
        $this->pdf->Ln(2);
        $cliente = $this->persona->getPersonaForId($comprobante->persona_id);
        /*echo '<pre>';
        print_r($cliente);
        echo '</pre>';
        exit();*/
        $this->pdf->Cell(10,0,'Sr.(es)',0,0,'I');
        $cl = $this->partir_string($cliente->nombres.' '.$cliente->apellidos,40);
        foreach ($cl as $key => $value) {
            $this->pdf->Cell(0,0,($key == 0 ? ' :': '').$value,0,0,'I');
            $this->pdf->Ln(3);
            $this->pdf->Cell(18,0,'',0,0,'I');
        }
        $this->pdf->Ln(1);
        $this->pdf->Cell(10,0,(strlen($cliente->nroidentificacion) > 8) ? 'R.U.C' : 'D.N.I.',0,0,'I');
        $this->pdf->Cell(0,0,' : '.$cliente->nroidentificacion,0,0,'I');
        $this->pdf->Ln(2);
        $this->pdf->Cell(0,0,'----------------------------------------------------------------------------------------------------------------------',0,0,'C');
        $this->pdf->Ln(2);
        $this->pdf->Cell(50,0,'Ctd.     Descripcion',0,0,'I');
        $this->pdf->Cell(20,0,'Pr. Un.     Total',0,0,'I');
        $this->pdf->Ln(2);
        $this->pdf->Cell(0,0,'----------------------------------------------------------------------------------------------------------------------',0,0,'C');
        $this->pdf->Ln(2);

        $detalles = $this->pagos->getDetallesProvisional($comprobante->num_serie,$comprobante->num_documento);
        foreach ($detalles as $key => $value) {
            $this->pdf->Cell(10,0,$value->cantidad,0,0,'I');
            $descrip = $this->partir_string($value->descripcion,30);
            //$title = iconv('UTF-8', 'windows-1252', $descrip[0]);
            $this->pdf->Cell(40,0,$descrip[0],0,0,'I');
            $this->pdf->Cell(10,0,number_format($value->precio,2,'.',''),0,0,'I');
            $this->pdf->Cell(10,0,number_format($value->precio*$value->cantidad,2,'.',''),0,0,'I');
            $this->pdf->Ln(4);
            foreach ($descrip as $k => $val) if($k != 0){
                $this->pdf->Cell(10,0,' ',0,0,'I');
                $this->pdf->Cell(58,0,$val,0,0,'I');
                $this->pdf->Cell(10,0,' ',0,0,'I');
                $this->pdf->Cell(10,0,' ',0,0,'I');
                $this->pdf->Ln(4);
            }
        }
        $this->pdf->Cell(0,0,'----------------------------------------------------------------------------------------------------------------------',0,0,'C');
        $this->pdf->Ln(4);
        $mon = ['PEN'=>'S/','USD'=>'$','EUR'=>'€'];
        $this->pdf->Cell(0,0,'Total        '.$mon[$comprobante->moneda].'. '.number_format(str_replace(',','',$comprobante->total),2),0,0,'C');
        $this->pdf->Ln(4);
        $this->load->library('clinica');
        $tota = explode('.',number_format($comprobante->total,2));
        $tipomon = ['PEN'=>'SOLES','USD'=>'DOLARES AMERICANOS','EUR'=>'EUROS'];
        $this->pdf->Cell(0,0,'SON: '.$this->clinica->leterNumber($comprobante->total).' Y '.(isset($tota[1]) ? $tota[1] : '00').'/100 '.$tipomon[$comprobante->moneda],0,0,'C');

        $this->pdf->Ln(3);
        $this->pdf->Cell(50,0,'Subtotal',0,0,'I');
        $this->pdf->Cell(5,0,$mon[$comprobante->moneda],0,0,'I');
        $this->pdf->Cell(0,0,number_format($comprobante->total,2),0,0,'I');
            $this->pdf->Ln(3);
            $this->pdf->Cell(50,0,'I.G.V.',0,0,'I');
            $this->pdf->Cell(5,0,$mon[$comprobante->moneda],0,0,'I');
            $this->pdf->Cell(0,0,number_format(0,2),0,0,'I');

        $this->pdf->Ln(3);
        $this->pdf->Cell(50,0,'Importe total',0,0,'I');
        $this->pdf->Cell(5,0,$mon[$comprobante->moneda],0,0,'I');
        $this->pdf->Cell(0,0,number_format($comprobante->total,2),0,0,'I');
        $this->pdf->Ln(5);
        $u = $this->usuario->getUsuarioForId($comprobante->usuario_id);
        $this->pdf->SetFont('Arial','',6);
        $title = iconv('UTF-8', 'windows-1252', 'Nombres : '.$u->nombres.' '.$u->apellidos);
        $this->pdf->Cell(12,0,$title,0,0,'I');
        $this->pdf->Ln(5);
        $title = iconv('UTF-8', 'windows-1252', 'Observación');
        $this->pdf->Cell(50,0,$title,0,0,'I');
        $this->pdf->Ln(3);
        $obs = $this->partir_string($comprobante->observacion);
        foreach ($obs as $key => $value) {
            $this->pdf->Cell(50,0,$value,0,0,'I');
            $this->pdf->Ln(3);
        }
        $this->pdf->Ln(5);
        $importante = $this->partir_string('SI EL ALUMNO SE RETIRARÁ EN FORMA VOLUNTARIA, LA INSTITUCIÓN NO SE HACE RESPONSABLE DE CAMBIOS NI DEVOLUCIONES.');
        $this->pdf->SetFont('Arial','B',8);
        $this->pdf->Cell(0,0,'AVISO IMPORTANTE',0,0,'C');
        $this->pdf->Ln(5);
        foreach ($importante as $key => $value) {
            $this->pdf->Cell(0,0,$value,0,0,'C');
            $this->pdf->Ln(3);
        }
        $title = iconv('UTF-8', 'windows-1252', 'LA DIRECCIÓN');
        $this->pdf->Cell(0,0,$title,0,0,'C');


        $this->pdf->Close();
        //$this->pdf->Output(BASEPATH."../pdfs/".$comprobante->num_serie.'-'.$comprobante->num_documento."-A7.pdf", 'F');
        $this->pdf->Output(base_url()."tmp/".$comprobante->num_serie.'-'.$comprobante->num_documento.".pdf", 'I');
    }

    public function nota($documento = ''){
        if($documento == ''){
            header('Location: '.base_url());
        }
        if(file_exists(BASEPATH."../pdfs/".$documento.'-A7.pdf')){
            header("Content-type: application/pdf");
            header("Content-Disposition: inline; filename=filename.pdf");
            @readfile(BASEPATH."../pdfs/".$documento.'-A7.pdf');
            exit();
        }
        $comp = explode('-', $documento);
        if(count($comp) != 2){
            header('Location: '.base_url());
        }
        $comprobante = $this->pagos->getNota($comp[0],$comp[1]);
        if(is_numeric($comprobante)){
            header('Location: '.base_url());
        }
        if($comprobante->cod_doc == "99"){
            header('Location: '.base_url().'impreso/provisional/'.$documento);
            exit();
        }

        //$obser = $this->pagos->getPagoWhere(['Boleta_Inicial'=>$documento]);
        $usuario = $this->session->userdata('usuario');
        $param = $this->parameters;
        $this->load->library('pdf');
        $this->pdf = new Pdf();
        $this->pdf->AddPage('P','A7');
        $this->pdf->SetMargins(4,0,5);
        $this->pdf->AliasNbPages();
        $this->pdf->SetTitle(($comprobante->cod_doc == '07' ? 'Nota Credito' : 'Nota Debito').': '.$comprobante->num_serie.'-'.$comprobante->num_documento);
        $this->pdf->Image(BASEPATH.'../assets/assets/img/'.$param['logo'],4,8,15);//logo del documento
        $this->pdf->SetFont('Arial','B',6);

        $razon_social = $this->partir_string($param['razon_social'],40);
        foreach ($razon_social as $key => $value) {
            $this->pdf->Cell(0,0,$value,0,0,'C');
            $this->pdf->Ln(4);
        }

        //$this->pdf->Ln(3);
        $this->pdf->SetFont('Arial','',6);
        //$this->pdf->Cell(22);
        $this->pdf->Cell(0,0,'R.U.C. '.$param['ruc'],0,0,'C');
        $this->pdf->Ln(4);
        $title = iconv('UTF-8', 'windows-1252', $param['direccion']);
        $this->pdf->Cell(0,0,$title,0,0,'C');
        $this->pdf->Ln(3);
        $title = iconv('UTF-8', 'windows-1252', $param['locacion']);
        $this->pdf->Cell(0,0,$title,0,0,'C');
        $this->pdf->Ln(3);

        if($usuario['sede_id'] != 1){
            $this->load->model('utils');
            $sede = $this->utils->getSede($usuario['sede_id']);
            $sucursal = $this->partir_string(strtoupper($sede->Descripcion.' - '.$sede->direccion),50);
            $this->pdf->Ln(3);
            $this->pdf->Cell(0,0,'SUCURSAL',0,0,'C');
            $this->pdf->Ln(3);
            foreach ($sucursal as $key => $value) {
                $this->pdf->Cell(0,0,$value,0,0,'C');
                $this->pdf->Ln(3);
            }
        }

        $title = iconv('UTF-8', 'windows-1252', 'Teléfono: '.$param['telefono']);
        $this->pdf->Cell(0,0,$title,0,0,'C');
        $this->load->database();
        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial','B',9);
        $title = iconv('UTF-8', 'windows-1252', ($comprobante->cod_doc == '07' ? 'NOTA DE CREDITO' : 'NOTA DE DEBITO').' ELECTRÓNICA');
        $this->pdf->Cell(0,0,$title,0,0,'C');
        $this->pdf->Ln(6);
        $this->pdf->SetFont('Arial','',9);
        $this->pdf->Cell(0,0,$comprobante->num_serie.'-'.$comprobante->num_documento,0,0,'C');
        $this->pdf->Ln(3);
        $this->pdf->SetFont('Arial','',6);
        $title = iconv('UTF-8', 'windows-1252', 'Fecha de Emisión: '.date('d/m/Y',strtotime(date($comprobante->cancelado))));
        $this->pdf->Cell(10,0,$title,0,0,'I');
        $this->pdf->Ln(2);
        $this->pdf->Cell(0,0,'----------------------------------------------------------------------------------------------------------------------',0,0,'C');
        $this->pdf->Ln(2);
        $cliente = $comprobante->c_doc == '03' ? $this->persona->getPersonaForId($comprobante->id_persona) : $this->pagos->getCliente($comprobante->id_empresa);
        $this->pdf->Cell(10,0,'Sr.(es)',0,0,'I');
        $this->pdf->SetFont('Arial','B',8);
        $cl = $this->partir_string($comprobante->c_doc == '03' ? $cliente->nombres.' '.$cliente->apellidos : $cliente->razon_social,60);
        foreach ($cl as $key => $value) {
            $this->pdf->Cell(0,0,($key == 0 ? ' :': '').$value,0,0,'I');
            $this->pdf->Ln(3);
            $this->pdf->Cell(18,0,'',0,0,'I');
        }
        $this->pdf->SetFont('Arial','',6);
        $this->pdf->Ln(1);
        $this->pdf->Cell(10,0,(strlen($cliente->nroidentificacion) > 8) ? 'R.U.C' : 'D.N.I.',0,0,'I');
        $this->pdf->Cell(0,0,' : '.$cliente->nroidentificacion,0,0,'I');
        $this->pdf->Ln(2);
        $this->pdf->Cell(0,0,'----------------------------------------------------------------------------------------------------------------------',0,0,'C');
        $this->pdf->Ln(2);
        $this->pdf->Cell(50,0,'Ctd.     Descripcion',0,0,'I');
        $this->pdf->Cell(20,0,'Pr. Un.     Total',0,0,'I');
        
        $this->pdf->Ln(2);
        $this->pdf->Cell(0,0,'----------------------------------------------------------------------------------------------------------------------',0,0,'C');
        $this->pdf->Ln(2);
        $data_comprobante = (array)$comprobante;
        $data_comprobante['totaligv_afecto'] = 0;
        $data_comprobante['totalsafecto'] = 0;
        $data_comprobante['totalsinafecto'] = 0;
        $data_comprobante['totalsexonerado'] = 0.00;

        $detalles = $this->pagos->getDetallesNota($comprobante->num_serie,$comprobante->num_documento);
        $items = [];
        //dumpvar($detalles);
        foreach ($detalles as $key => $value) {
            $this->pdf->Cell(7,0,$value->cantidad,0,0,'I');
            $descrip = $this->partir_string($value->descripcion,42);
            //$title = iconv('UTF-8', 'windows-1252', $descrip[0]);
            $this->pdf->Cell(43,0,$descrip[0],0,0,'I');
            $this->pdf->Cell(10,0,number_format($value->precio,2,'.',''),0,0,'I');
            $this->pdf->Cell(10,0,number_format($value->precio*$value->cantidad,2,'.',''),0,0,'I');
            $this->pdf->Ln(2);
            foreach ($descrip as $k => $val) if($k != 0){
                $this->pdf->Cell(7,0,' ',0,0,'I');
                $this->pdf->Cell(43,0,$val,0,0,'I');
                $this->pdf->Cell(12,0,' ',0,0,'I');
                $this->pdf->Cell(10,0,' ',0,0,'I');
                $this->pdf->Ln(2);
            }
            //para cargar los datos 
            $t = ($value->cantidad*$value->precio)-$value->cantidad*$value->precio*$value->precio/100;
            switch ($value->tipo_igv) {
                case 1:
                    $data_comprobante['totaligv_afecto'] += $t - $t/1.18;
                    $data_comprobante['totalsafecto'] += $t/1.18;
                    break;

                case 2:
                    $data_comprobante['totalsinafecto'] += $t;
                    break;

                case 3:
                    $data_comprobante['totalsexonerado'] += $t;
                    break;
                
                default:
                    # code...
                    break;
            }
            $d = (array)$value;
            $d['precioventa'] = number_format($value->precio,4,'.','');
            $d['igv'] = number_format(0,4,'.','');
            $med = $this->utils->getMedida($d['id_medida']);
            $d['codigo'] = $med->codigo;
            $d['nombre'] = $value->descripcion;
            $d['tipo_igv'] = $value->tipo_igv;
            $d['medida'] = $value->medida;
            array_push($items, $d);
        }
        $this->pdf->Cell(0,0,'----------------------------------------------------------------------------------------------------------------------',0,0,'C');
        $this->pdf->Ln(2);
        $mon = ['PEN'=>'S/','USD'=>'$','EUR'=>'€'];
        $this->pdf->Cell(0,0,'Total        '.$mon[$comprobante->moneda].'. '.number_format(str_replace(',','',$comprobante->afecto),2),0,0,'C');
        $this->pdf->Ln(4);
        $this->load->library('clinica');
        $tota = explode('.',number_format($comprobante->afecto,2));
        $tipomon = ['PEN'=>'SOLES','USD'=>'DOLARES AMERICANOS','EUR'=>'EUROS'];
        $this->pdf->Cell(0,0,'SON: '.$this->clinica->leterNumber($comprobante->afecto).' Y '.(isset($tota[1]) ? $tota[1] : '00').'/100 '.$tipomon[$comprobante->moneda],0,0,'C');

        $this->pdf->Ln(3);
        $this->pdf->Cell(53,0,'Subtotal',0,0,'I');
        $this->pdf->Cell(5,0,$mon[$comprobante->moneda],0,0,'I');
        $this->pdf->Cell(0,0,number_format($comprobante->afecto,2),0,0,'I');
        //if($datos_venta1['tipo-atencion'] == '1'){
            $this->pdf->Ln(3);
            $this->pdf->Cell(53,0,'Inafecto I.G.V.',0,0,'I');
            $this->pdf->Cell(5,0,$mon[$comprobante->moneda],0,0,'I');
            $this->pdf->Cell(0,0,number_format(0,2),0,0,'I');
        //}
        $this->pdf->Ln(3);
        $this->pdf->Cell(53,0,'Importe Total',0,0,'I');
        $this->pdf->Cell(5,0,$mon[$comprobante->moneda],0,0,'I');
        $this->pdf->Cell(0,0,number_format(str_replace(',','',$comprobante->afecto),2),0,0,'I');
        $this->pdf->Ln(4);

        /*$this->pdf->Cell(12,0,'Usuario : ',0,0,'I');
        $this->pdf->SetFont('Arial','B',6);
        $this->pdf->Cell(10,0,$usuario['usuario'],0,0,'I');*/
        $u = $this->usuario->getUsuarioForId($comprobante->id_usuario);
        $this->pdf->SetFont('Arial','',6);
        $title = iconv('UTF-8', 'windows-1252', 'Nombres : '.$u->nombres.' '.$u->apellidos);
        $this->pdf->Cell(12,0,$title,0,0,'I');
        $this->pdf->Ln(4);
            $ob = $this->partir_string($comprobante->detalle,40);
    /*if(!is_numeric($obser)){
            $ob = $this->partir_string($obser->Observacion,40);
        }else{
        }*/
            $title = iconv('UTF-8', 'windows-1252', 'Observación : ');
            $this->pdf->Cell(12,0,$title,0,0,'I');
            $this->pdf->Ln(4);
            foreach ($ob as $key => $value) {
                $this->pdf->Cell(0,0,$value,0,0,'I');
                $this->pdf->Ln(4);
            }
        //$this->pdf->Cell(0,0,number_format(str_replace(',','',$comprobante->total),2),0,0,'R');
        //$this->pdf->Ln(4);
        /*if(!file_exists(BASEPATH.'../barcodes/'.substr($comprobante->fecha,0,10).$comprobante->num_serie.'-'.$comprobante->num_documento.'.png')){
            $data_comprobante['nroidentificacion'] = $cliente->nroidentificacion;
            $data_comprobante['nombrecliente'] = $comprobante->cod_doc == '03' ? $cliente->nombres.' '.$cliente->apellidos : $cliente->razon_social;
            //dumpvar((array)$comprobante);
            $this->load->library('greenter',$this->parameters);
            $this->greenter->setData($data_comprobante);
            $this->greenter->setItems($items);
            $this->greenter->legenda(['total'=>$comprobante->total]);
            $datos = $this->greenter->preparaXML('boletas',substr($data_comprobante['fecha'],0,10));
            $this->load->library('barcode2');
            $this->barcode2->setData($this->parameters['ruc'].'|'.$data_comprobante['cod_doc'].'|'.$comprobante->num_serie.'|'.$comprobante->num_documento.'|'.number_format(0,2).'|'.number_format($data_comprobante['total'],2).'|'.date('d/m/Y').'|06||'.$datos['DigestValue'].'|'.$datos['SignatureValue']);
            $a = $this->barcode2->getgd();
            file_put_contents('./barcodes/'.substr($data_comprobante['fecha'],0,10).$comprobante->num_serie.'-'.$comprobante->num_documento.'.png', $a);
        }*/
        $this->pdf->Image(BASEPATH.'../barcodes/'.substr($comprobante->cancelado,0,10).$comprobante->num_serie.'-'.$comprobante->num_documento.'.png',null,null,60,20);//logo del documento
        $this->pdf->Ln(5);
        $importante = $this->partir_string('SI EL ALUMNO SE RETIRARÁ EN FORMA VOLUNTARIA, LA INSTITUCIÓN NO SE HACE RESPONSABLE DE CAMBIOS NI DEVOLUCIONES.');
        $this->pdf->SetFont('Arial','B',8);
        $this->pdf->Cell(0,0,'AVISO IMPORTANTE',0,0,'C');
        $this->pdf->Ln(5);
        foreach ($importante as $key => $value) {
            $this->pdf->Cell(0,0,$value,0,0,'C');
            $this->pdf->Ln(3);
        }
        $title = iconv('UTF-8', 'windows-1252', 'LA DIRECCIÓN');
        $this->pdf->Cell(0,0,$title,0,0,'C');

        $this->pdf->Close();
        //$this->pdf->Output(BASEPATH."../pdfs/".$comprobante->num_serie.'-'.$comprobante->num_documento."-A7.pdf", 'F');
        $this->pdf->Output(base_url()."tmp/".$comprobante->num_serie.'-'.$comprobante->num_documento.".pdf", 'I');
    }

	public function comprobante($documento = ''){
		if($documento == ''){
			header('Location: '.base_url());
		}
		if(file_exists(BASEPATH."../pdfs/".$documento.'-A7.pdf')){
			header("Content-type: application/pdf");
			header("Content-Disposition: inline; filename=filename.pdf");
			@readfile(BASEPATH."../pdfs/".$documento.'-A7.pdf');
			exit();
		}
		$comp = explode('-', $documento);
		if(count($comp) != 2){
			header('Location: '.base_url());
		}
        if(substr($comp[0], 0, 1) == 'X'){
            header('Location: '.base_url().'impreso/provisional/'.$documento);
            exit();
        }
		$comprobante = $this->pagos->getComprobante($comp[0],$comp[1]);
		if(is_numeric($comprobante)){
			header('Location: '.base_url());
		}
        $obser = $this->pagos->getPagoWhere(['Boleta_Inicial'=>$documento]);
        $usuario = $this->session->userdata('usuario');
		$param = $this->parameters;
		$this->load->library('pdf');
        $this->pdf = new Pdf();
        $this->pdf->AddPage('P','A7');
        $this->pdf->SetMargins(4,0,5);
        $this->pdf->AliasNbPages();
        $this->pdf->SetTitle('Provisional: '.$comprobante->num_serie.'-'.$comprobante->num_documento);
        $this->pdf->Image(BASEPATH.'../assets/assets/img/'.$param['logo'],4,8,15);//logo del documento
        $this->pdf->SetFont('Arial','B',6);

        $razon_social = $this->partir_string($param['razon_social'],40);
        foreach ($razon_social as $key => $value) {
            $this->pdf->Cell(0,0,$value,0,0,'C');
            $this->pdf->Ln(4);
        }

        //$this->pdf->Ln(3);
        $this->pdf->SetFont('Arial','',6);
        //$this->pdf->Cell(22);
        $this->pdf->Cell(0,0,'R.U.C. '.$param['ruc'],0,0,'C');
        $this->pdf->Ln(4);
        $title = iconv('UTF-8', 'windows-1252', $param['direccion']);
        $this->pdf->Cell(0,0,$title,0,0,'C');
        $this->pdf->Ln(3);
        $title = iconv('UTF-8', 'windows-1252', $param['locacion']);
        $this->pdf->Cell(0,0,$title,0,0,'C');
        $this->pdf->Ln(3);

        if($usuario['sede_id'] != 1){
            $this->load->model('utils');
            $sede = $this->utils->getSede($usuario['sede_id']);
            $sucursal = $this->partir_string(strtoupper($sede->Descripcion.' - '.$sede->direccion),50);
            $this->pdf->Ln(3);
            $this->pdf->Cell(0,0,'SUCURSAL',0,0,'C');
            $this->pdf->Ln(3);
            foreach ($sucursal as $key => $value) {
                $this->pdf->Cell(0,0,$value,0,0,'C');
                $this->pdf->Ln(3);
            }
        }
        $title = iconv('UTF-8', 'windows-1252', 'Teléfono: '.$param['telefono']);
        $this->pdf->Cell(0,0,$title,0,0,'C');
        $this->load->database();
        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial','B',9);
        $title = iconv('UTF-8', 'windows-1252', ($comprobante->cod_doc == '03' ? 'BOLETA' : 'FACTURA').' ELECTRÓNICA');
        $this->pdf->Cell(0,0,$title,0,0,'C');
        $this->pdf->Ln(6);
        $this->pdf->SetFont('Arial','',9);
        $this->pdf->Cell(0,0,$comprobante->num_serie.'-'.$comprobante->num_documento,0,0,'C');
        $this->pdf->Ln(3);
        $this->pdf->SetFont('Arial','',6);
        $title = iconv('UTF-8', 'windows-1252', 'Fecha de Emisión: '.date('d/m/Y',strtotime(date($comprobante->fecha))));
        $this->pdf->Cell(10,0,$title,0,0,'I');
        $this->pdf->Ln(2);
        $this->pdf->Cell(0,0,'----------------------------------------------------------------------------------------------------------------------',0,0,'C');
        $this->pdf->Ln(2);
        $cliente = $comprobante->cod_doc == '03' ? $this->persona->getPersonaForId($comprobante->persona_id) : $this->pagos->getCliente($comprobante->empresa_id);
        $this->pdf->Cell(10,0,'Sr.(es)',0,0,'I');
        $this->pdf->SetFont('Arial','B',8);
        $cl = $this->partir_string($comprobante->cod_doc == '03' ? $cliente->nombres.' '.$cliente->apellidos : $cliente->razon_social,60);
        foreach ($cl as $key => $value) {
        	$this->pdf->Cell(0,0,($key == 0 ? ' :': '').$value,0,0,'I');
            $this->pdf->Ln(3);
            $this->pdf->Cell(18,0,'',0,0,'I');
        }
        $this->pdf->SetFont('Arial','',6);
        $this->pdf->Ln(1);
        $this->pdf->Cell(10,0,(strlen($cliente->nroidentificacion) > 8) ? 'R.U.C' : 'D.N.I.',0,0,'I');
        $this->pdf->Cell(0,0,' : '.$cliente->nroidentificacion,0,0,'I');
        $this->pdf->Ln(2);
	    $this->pdf->Cell(0,0,'----------------------------------------------------------------------------------------------------------------------',0,0,'C');
	    $this->pdf->Ln(2);
	    $this->pdf->Cell(50,0,'Ctd.     Descripcion',0,0,'I');
	    $this->pdf->Cell(20,0,'Pr. Un.     Total',0,0,'I');
	    
        $this->pdf->Ln(2);
        $this->pdf->Cell(0,0,'----------------------------------------------------------------------------------------------------------------------',0,0,'C');
        $this->pdf->Ln(2);
        $data_comprobante = (array)$comprobante;
        $data_comprobante['totaligv_afecto'] = 0;
        $data_comprobante['totalsafecto'] = 0;
        $data_comprobante['totalsinafecto'] = 0;
        $data_comprobante['totalsexonerado'] = 0.00;

	    $detalles = $this->pagos->getDetallesComprobante($comprobante->num_serie,$comprobante->num_documento);
        $items = [];
        //dumpvar($detalles);
	    foreach ($detalles as $key => $value) {
	    	$this->pdf->Cell(7,0,$value->cantidad,0,0,'I');
	    	$descrip = $this->partir_string($value->descripcion,42);
	    	//$title = iconv('UTF-8', 'windows-1252', $descrip[0]);
	    	$this->pdf->Cell(43,0,$descrip[0],0,0,'I');
	    	$this->pdf->Cell(10,0,number_format($value->precio,2,'.',''),0,0,'I');
	    	$this->pdf->Cell(10,0,number_format($value->precio*$value->cantidad,2,'.',''),0,0,'I');
        	$this->pdf->Ln(2);
	    	foreach ($descrip as $k => $val) if($k != 0){
	    		$this->pdf->Cell(7,0,' ',0,0,'I');
	    		$this->pdf->Cell(43,0,$val,0,0,'I');
	    		$this->pdf->Cell(12,0,' ',0,0,'I');
	    		$this->pdf->Cell(10,0,' ',0,0,'I');
	    		$this->pdf->Ln(2);
	    	}
            //para cargar los datos 
            $t = ($value->cantidad*$value->precio)-$value->cantidad*$value->precio*$value->precio/100;
            switch ($value->tipo_igv) {
                case 1:
                    $data_comprobante['totaligv_afecto'] += $t - $t/1.18;
                    $data_comprobante['totalsafecto'] += $t/1.18;
                    break;

                case 2:
                    $data_comprobante['totalsinafecto'] += $t;
                    break;

                case 3:
                    $data_comprobante['totalsexonerado'] += $t;
                    break;
                
                default:
                    # code...
                    break;
            }
            $d = (array)$value;
            $d['precioventa'] = number_format($value->precio,4,'.','');
            $d['igv'] = number_format(0,4,'.','');
            $med = $this->utils->getMedida($d['id_medida']);
            $d['codigo'] = $med->codigo;
            $d['nombre'] = $value->descripcion;
            $d['tipo_igv'] = $value->tipo_igv;
            $d['medida'] = $value->medida;
            array_push($items, $d);
	    }
	    $this->pdf->Cell(0,0,'----------------------------------------------------------------------------------------------------------------------',0,0,'C');
        $this->pdf->Ln(2);
        $mon = ['PEN'=>'S/','USD'=>'$','EUR'=>'€'];
        $this->pdf->Cell(0,0,'Total        '.$mon[$comprobante->moneda].'. '.number_format(str_replace(',','',$comprobante->total),2),0,0,'C');
        $this->pdf->Ln(4);
        $this->load->library('clinica');
        $tota = explode('.',number_format($comprobante->total,2));
        $tipomon = ['PEN'=>'SOLES','USD'=>'DOLARES AMERICANOS','EUR'=>'EUROS'];
        $this->pdf->Cell(0,0,'SON: '.$this->clinica->leterNumber($comprobante->total).' Y '.(isset($tota[1]) ? $tota[1] : '00').'/100 '.$tipomon[$comprobante->moneda],0,0,'C');

        $this->pdf->Ln(3);
        $this->pdf->Cell(53,0,'Subtotal',0,0,'I');
        $this->pdf->Cell(5,0,$mon[$comprobante->moneda],0,0,'I');
        $this->pdf->Cell(0,0,number_format($comprobante->total,2),0,0,'I');
        //if($datos_venta1['tipo-atencion'] == '1'){
	        $this->pdf->Ln(3);
	        $this->pdf->Cell(53,0,'Inafecto I.G.V.',0,0,'I');
	        $this->pdf->Cell(5,0,$mon[$comprobante->moneda],0,0,'I');
	        $this->pdf->Cell(0,0,number_format(0,2),0,0,'I');
	    //}
        $this->pdf->Ln(3);
        $this->pdf->Cell(53,0,'Importe Total',0,0,'I');
        $this->pdf->Cell(5,0,$mon[$comprobante->moneda],0,0,'I');
        $this->pdf->Cell(0,0,number_format(str_replace(',','',$comprobante->total),2),0,0,'I');
		$this->pdf->Ln(4);

        /*$this->pdf->Cell(12,0,'Usuario : ',0,0,'I');
        $this->pdf->SetFont('Arial','B',6);
        $this->pdf->Cell(10,0,$usuario['usuario'],0,0,'I');*/
        $u = $this->usuario->getUsuarioForId($comprobante->usuario_id);
        $this->pdf->SetFont('Arial','',6);
        $title = iconv('UTF-8', 'windows-1252', 'Nombres : '.$u->nombres.' '.$u->apellidos);
        $this->pdf->Cell(12,0,$title,0,0,'I');
        $this->pdf->Ln(4);
        if(!is_numeric($obser)){
            $ob = $this->partir_string($obser->Observacion,40);
        }else{
            $ob = $this->partir_string($comprobante->observacion,40);
        }
            $title = iconv('UTF-8', 'windows-1252', 'Observación : ');
            $this->pdf->Cell(12,0,$title,0,0,'I');
            $this->pdf->Ln(4);
            foreach ($ob as $key => $value) {
                $this->pdf->Cell(0,0,$value,0,0,'I');
                $this->pdf->Ln(4);
            }
        //$this->pdf->Cell(0,0,number_format(str_replace(',','',$comprobante->total),2),0,0,'R');
        //$this->pdf->Ln(4);
        if(!file_exists(BASEPATH.'../barcodes/'.substr($comprobante->fecha,0,10).$comprobante->num_serie.'-'.$comprobante->num_documento.'.png')){
            $data_comprobante['nroidentificacion'] = $cliente->nroidentificacion;
            $data_comprobante['nombrecliente'] = $comprobante->cod_doc == '03' ? $cliente->nombres.' '.$cliente->apellidos : $cliente->razon_social;
            $data_comprobante['cliente'] = $cliente;
            //dumpvar((array)$comprobante);
            $this->load->library('greenter',$this->parameters);
            $this->greenter->setData($data_comprobante);
            $this->greenter->setItems($items);
            $this->greenter->legenda(['total'=>$comprobante->total]);
            $datos = $this->greenter->preparaXML( $comprobante->cod_doc == '03' ? 'boletas' : 'facturas',substr($data_comprobante['fecha'],0,10));
            $this->load->library('barcode2');
            $this->barcode2->setData($this->parameters['ruc'].'|'.$data_comprobante['cod_doc'].'|'.$comprobante->num_serie.'|'.$comprobante->num_documento.'|'.number_format(0,2).'|'.number_format($data_comprobante['total'],2).'|'.date('d/m/Y').'|06||'.$datos['DigestValue'].'|'.$datos['SignatureValue']);
            $a = $this->barcode2->getgd();
            file_put_contents('./barcodes/'.substr($data_comprobante['fecha'],0,10).$comprobante->num_serie.'-'.$comprobante->num_documento.'.png', $a);
        }
		$this->pdf->Image(BASEPATH.'../barcodes/'.substr($comprobante->fecha,0,10).$comprobante->num_serie.'-'.$comprobante->num_documento.'.png',null,null,60,20);//logo del documento
		$this->pdf->Ln(5);
        $importante = $this->partir_string('SI EL ALUMNO SE RETIRARÁ EN FORMA VOLUNTARIA, LA INSTITUCIÓN NO SE HACE RESPONSABLE DE CAMBIOS NI DEVOLUCIONES.');
        $this->pdf->SetFont('Arial','B',8);
        $this->pdf->Cell(0,0,'AVISO IMPORTANTE',0,0,'C');
        $this->pdf->Ln(5);
        foreach ($importante as $key => $value) {
            $this->pdf->Cell(0,0,$value,0,0,'C');
            $this->pdf->Ln(3);
        }
        $title = iconv('UTF-8', 'windows-1252', 'LA DIRECCIÓN');
        $this->pdf->Cell(0,0,$title,0,0,'C');

		$this->pdf->Close();
		//$this->pdf->Output(BASEPATH."../pdfs/".$comprobante->num_serie.'-'.$comprobante->num_documento."-A7.pdf", 'F');
		$this->pdf->Output(base_url()."tmp/".$comprobante->num_serie.'-'.$comprobante->num_documento.".pdf", 'I');
	}

	public function partir_string($cadena,$length=30){
        $cads = explode(' ',$cadena);
        $cadenas = [];
        $string = '';
        foreach ($cads as $value) {
            if(strlen($string.' '.$value) >= $length){
                array_push($cadenas, iconv('UTF-8', 'windows-1252', $string));
                $string = $value;
            }else{
                $string = $string.' '.$value;
            }
        }
        if($string != '')
            array_push($cadenas,iconv('UTF-8', 'windows-1252', $string));
        return $cadenas;
    }
}