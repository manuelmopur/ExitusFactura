<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->config->load('parameters',true);
		$this->parameters = $this->config->item('parameters');
		$this->load->model('usuario');
		$this->load->model('pagos');
		$this->load->model('persona');
		$this->load->model('alumno');
		$this->load->model('utils');
	}

	public function controlasistencia(){
		$areas = $this->persona->getArea();
		$sedes = $this->utils->getSedes();
		$turnos = $this->utils->getTurnos();
		//dumpvar($turnos);
		$fecha = date('Y-m-d');
		if(!file_exists(BASEPATH.'../archivos/logs/asistencia/'))
			mkdir(BASEPATH.'../archivos/logs/asistencia/');
		$log = fopen(BASEPATH."../archivos/logs/asistencia/".$fecha.".log", 'w+');
		foreach ($sedes as $key => $value_sede) {
			foreach ($areas as $key_area => $value_area) 
				foreach($turnos as $key_turno => $value_turno){
					echo 'Sede '.$value_sede->Descripcion.' - Area '.$value_area->Descripcion.' - Turno '.$value_turno->descripcion.PHP_EOL;
					//$alumnos_total = $this->alumno->getAlumnosWhereAsistencia(['sede_id'=>$value_sede->id,'Area_id'=>$value_area->id]);
					$asistidos = $this->alumno->getAlumnosWhereAsistencia(['estado_asistencia'=>1,'estado'=>1,'sede_id'=>$value_sede->id,'Area_id'=>$value_area->id,'estadia'=>1,'Turno_id'=>$value_turno->id]);
					fwrite($log, 'Sede '.$value_sede->Descripcion.' - Area '.$value_area->Descripcion.' - Turno '.$value_turno->descripcion.PHP_EOL.'Asistencia: '.$asistidos.PHP_EOL);
					if($asistidos > 2){
						$alumnos = $this->alumno->getAlumnosWhere(['estado_asistencia'=>0,'estado'=>1,'sede_id'=>$value_sede->id,'Area_id'=>$value_area->id,'estadia'=>1,'Turno_id'=>$value_turno->id]);
						fwrite($log, "Faltos: ".count($alumnos).PHP_EOL);
						foreach($alumnos as $alumno){
							//echo $alumno->codigo.', ';
							$data = [
								'id_alumno'			=> $alumno->id,
								'fecha'				=> $fecha
							];
							$this->alumno->newFalta($data);
						}
					}
				}
		}
		$this->alumno->updateAlumnoWithoutWhere(['estado_asistencia'=>0]);
		fclose($log);
	}

	public function index(){
		$hoy = date('Y-m-d');
		$atras = date('Y-m-d',strtotime($hoy.' - 7 days'));
		$where = "tv.fecha BETWEEN '".$atras."' and '".$hoy."'";
		$comprobantes = $this->pagos->getComprobantesEnvia($where);
		$this->load->library('sunat',$this->parameters);
		if(!file_exists(BASEPATH.'../archivos/logs/'))
			mkdir(BASEPATH.'../archivos/logs/');
		if(!file_exists(BASEPATH.'../archivos/logs/'))
			mkdir(BASEPATH.'../archivos/logs/');
		$log = fopen(BASEPATH."../archivos/logs/".date('Y-m-d'), 'w+');
		if(!is_numeric($comprobantes)){
			foreach ($comprobantes as $key => $value) {
				echo ($key+1).'.-'.$value->num_serie.'-'.$value->num_documento.' -> '.$value->fecha.PHP_EOL;
				$r = '';
				if($value->cod_doc == '01')
					$r = 'facturas';
				if($value->cod_doc == '03')
					$r = 'boletas';
				$fecha = substr($value->fecha, 0, 10);
				$filename = $this->parameters['ruc'].'-'.$value->cod_doc.'-'.$value->num_serie.'-'.$value->num_documento;
				$dir = BASEPATH.'../archivos/'.$r.'/'.substr($fecha,0,10).'/';
				$status = $this->sunat->envia($filename,$dir);
				if($status['status'] == 200){
					echo $status['data'].PHP_EOL;
					$this->pagos->updateVenta(['estado'=>2],['num_serie'=>$value->num_serie,'num_documento'=>$value->num_documento]);
				}
				else
					echo 'Error '.$status['data'].PHP_EOL;
					fwrite($log, $value->num_serie.'-'.$value->num_documento.' -> '.$value->fecha.' -> '.$status['data'].PHP_EOL);
			}
		}else
			fwrite($log, 'No hay comprobantes para enviar hoy '.date('Y-m-d'));
		fclose($log);
		//echo $hoy.PHP_EOL.$atras.PHP_EOL;
	}

	public function preparayenviaresumen(){
		$hoy = date('Y-m-d');
		$atras = date('Y-m-d',strtotime($hoy.' - 7 days'));
		$where = "tv.fecha BETWEEN '".$atras."' and '".$hoy."'";
		$comprobantes = $this->pagos->getComprobantesEnvia($where);
		$cur = $atras;
		if(!file_exists(BASEPATH.'../archivos/logs/'))
			mkdir(BASEPATH.'../archivos/logs/');
		$file = fopen(BASEPATH.'../archivos/logs/'.$hoy.'.log', 'w+');
		fwrite($file,  'Se encontraron '.count($comprobantes).' comprobantes'.PHP_EOL.$cur.PHP_EOL);
		$this->load->library('greenter',$this->parameters);
		$this->load->library('sunat',$this->parameters);
		$this->sunat->setMethodSumary();
		$cor = 1;
		for($i = 1; $i <= 7; $i++){
			fwrite($file, 'Enviando comprobantes'.PHP_EOL);
			$boletas = [];
			foreach ($comprobantes as $key => $value) 
				if($value->cod_doc == '03') {
					if($cur == substr($value->fecha, 0, 10)) {
						fwrite($file,$value->num_serie.'-'.$value->num_documento.' -> '.substr($value->fecha, 0, 10).PHP_EOL);
						$detalles = $this->pagos->getDetallesComprobante($value->num_serie,$value->num_documento);
						///data_comprobante
						$data_comprobante = [
							'cod_doc'				=> $value->cod_doc,
							'comprobante'			=> $value->num_serie.'-'.$value->num_documento,
							'estado'				=> 1,
							'tipo_cliente'			=> 1,
							'nrodocumento'			=> '00000000',
							'totaligv_afecto'		=> 0,
							'totalsafecto'			=> 0,
							'totalsinafecto'		=> 0,
							'totalsexonerado'		=> 0,
							'total'					=> 0
						];
						if(!is_numeric($detalles))
						foreach ($detalles as $k => $v) {
							switch ($v->tipo_igv) {
								case 1:
									$data_comprobante['totaligv_afecto'] += $v->precio - $v->precio/1.18;
									$data_comprobante['totalsafecto'] += $v->precio/1.18;
									break;
								case 2:
									$data_comprobante['totalsinafecto'] += $v->precio;
									break;
								case 3:
									$data_comprobante['totalsexonerado'] += $v->precio;
									break;
							}
							$data_comprobante['total'] = $v->precio;
						}
						array_push($boletas, $data_comprobante);
						$this->pagos->updateVenta(['estado'=>2],['num_serie'=>$value->num_serie,'num_documento'=>$value->num_documento]);
						if(count($boletas) == 100){
							$this->greenter->preparaResumen([
								'fecha_generacion'			=> $cur,
								'fecha'						=> date('Y-m-d'),
								'correlativo'				=> str_repeat('0', 3-strlen($cor)).$cor
							],$boletas,'resumendiario',date('Y-m-d'));
							$filename = $this->parameters['ruc'].'-RC-'.date('Ymd').'-'.str_repeat('0', 3-strlen($cor)).$cor;
							$dir = BASEPATH.'../archivos/resumendiario/'.date('Y-m-d').'/';
							echo 'Enviando resumen '.$filename.PHP_EOL;
							$this->sunat->envia($filename,$dir);
							$ticket = $this->sunat->loadStatus('R-'.$filename,$dir);
							$respuesta = $this->sunat->getStatus($ticket,'R-'.$filename,$dir);
							fwrite($file, 'Respuesta del resumen '.$filename.' '.$respuesta['status'].' '.$respuesta['data'].PHP_EOL);
							$cor++;
							$boletas = [];
						}
					}
				}
			$cur = date('Y-m-d',strtotime($cur.' + 1 days'));
			fwrite($file,''.PHP_EOL.$cur.PHP_EOL);
		}
		if(count($boletas) != 0){
			$cur = date('Y-m-d',strtotime($cur.' - 1 days'));
			$this->greenter->preparaResumen([
				'fecha_generacion'			=> $cur,
				'fecha'						=> date('Y-m-d'),
				'correlativo'				=> str_repeat('0', 3-strlen($cor)).$cor
			],$boletas,'resumendiario',date('Y-m-d'));
			$filename = $this->parameters['ruc'].'-RC-'.date('Ymd').'-'.str_repeat('0', 3-strlen($cor)).$cor;
			$dir = BASEPATH.'../archivos/resumendiario/'.date('Y-m-d').'/';
			echo 'Enviando resumen '.$filename.PHP_EOL;
			$this->sunat->envia($filename,$dir);
			$ticket = $this->sunat->loadStatus('R-'.$filename,$dir);
			$respuesta = $this->sunat->getStatus($ticket,'R-'.$filename,$dir);
			fwrite($file, 'Respuesta del resumen '.$filename.' '.$respuesta['status'].' '.$respuesta['data'].PHP_EOL);
		}
		fclose($file);
	}

	public function fecha($numb){
		dumpvar(str_repeat('0', 5-strlen($numb)).$numb);
	}

	public function actualizafotos(){
		$alumnos = $this->alumno->getAlumnoWhere("a.codigo != ''");
		foreach($alumnos as $key => $alumno){
			$pers = trim($alumno->apellidos).' '.trim($alumno->nombres);
			$file = str_replace(' ', '_', strtoupper($pers));
			$ruta = '';
			$box = [
				'path'		=> '',
				'file'		=> '',
				'format'	=> ''
			];
	        if(file_exists(BASEPATH."../fotos/".strtoupper($alumno->area).'/'.$file.'.jpg')){
				$ruta = "fotos/".strtoupper($alumno->area).'/'.$file.'.jpg';
				$box['path'] = BASEPATH."../fotos/".strtoupper($alumno->area).'/';
				$box['file'] = $file.'.jpg';
				$box['format'] = '.jpg';
			}
	        if(file_exists(BASEPATH."../fotos/".strtoupper($alumno->area).'/'.$file.'.jpeg')){
				$ruta = "fotos/".strtoupper($alumno->area).'/'.$file.'.jpeg';
				$box['path'] = BASEPATH."../fotos/".strtoupper($alumno->area).'/';
				$box['file'] = $file.'.jpeg';
				$box['format'] = '.jpeg';
			}
	        if(file_exists(BASEPATH."../fotos/".strtoupper($alumno->area).'/'.$file.'.png')){
				$ruta = "fotos/".strtoupper($alumno->area).'/'.$file.'.png';
				$box['path'] = BASEPATH."../fotos/".strtoupper($alumno->area).'/';
				$box['file'] = $file.'.png';
				$box['format'] = '.png';
			}
	        if(file_exists(BASEPATH."../fotos/".strtoupper($alumno->area).'/'.$file.'.gif')){
				$ruta = "fotos/".strtoupper($alumno->area).'/'.$file.'.gif';
				$box['path'] = BASEPATH."../fotos/".strtoupper($alumno->area).'/';
				$box['file'] = $file.'.gif';
				$box['format'] = '.gif';
			}
			if($ruta != ''){
				$newName = uniqid($alumno->id_alumno.'_');
				rename($box['path'].$box['file'],$box['path'].$newName.$box['format']);
				$this->alumno->updateAlumno(['Foto'=>$newName.$box['format']],$alumno->id_alumno);
				echo $ruta.' => '.$newName.$box['format'].PHP_EOL;
			}
		}
	}
}
