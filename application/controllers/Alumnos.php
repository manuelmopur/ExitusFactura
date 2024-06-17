<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumnos extends CI_Controller {

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
			if($u['id_rol'] != 1 && $u['id_rol'] != 2 && $u['id_rol'] != 5 && $u['id_rol'] != 7){
				header('Location: '.base_url());
			}
		}else{
			header('Location: '.base_url('admin'));
		}
	}

	public function index($id_alumno = 0){
		$data['parameters'] = $this->parameters;
		$data['sedes'] = $this->utils->getSedes();
		$usuario = $this->session->userdata('usuario');
		//dumpvar($data['alumnos']);		
		$data['alumnos'] = $this->alumno->getAlumnosSede($usuario['sede_id']);
		$data['rol'] = $usuario['id_rol'];
		//$data['alumnos'] = $this->alumno->getAlumnosSede(1);
		$data['areas'] = $this->persona->getArea();
		$data['ciclos'] = $this->persona->getCiclos($usuario['sede_id']);
		$data['id_alumno'] = $id_alumno;
		$data['content'] = $this->load->view('admin/alumnos/index',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Alumnos';
		$this->load->view('body',$data);
	}

	public function buscardatos(){
		if(!$this->input->post()){
			header('Location: '.base_url());
		}
		$alumnos = $this->alumno->getAlumnoWhere([
			'a.Area_id'			=> $this->input->post('area'),
			'a.sede_id'			=> $this->input->post('sede'),
			'a.ciclo_id'		=> $this->input->post('ciclo')
		]);
		if(!is_numeric($alumnos))
		foreach ($alumnos as $key => $alumno) {
			$ruta = '';
			$pers = trim($alumno->apellidos).' '.trim($alumno->nombres);
			$file = str_replace(' ', '_', strtoupper($pers));
	        if(file_exists(BASEPATH."../fotos/".strtoupper($alumno->area).'/'.$file.'.jpg'))
	            $ruta = "fotos/".strtoupper($alumno->area).'/'.$file.'.jpg';
	        if(file_exists(BASEPATH."../fotos/".strtoupper($alumno->area).'/'.$file.'.jpeg'))
	            $ruta = "fotos/".strtoupper($alumno->area).'/'.$file.'.jprg';
	        if(file_exists(BASEPATH."../fotos/".strtoupper($alumno->area).'/'.$file.'.png'))
	            $ruta = "fotos/".strtoupper($alumno->area).'/'.$file.'.png';
	        if(file_exists(BASEPATH."../fotos/".strtoupper($alumno->area).'/'.$file.'.gif'))
	            $ruta = "fotos/".strtoupper($alumno->area).'/'.$file.'.gif';
	        if($ruta != '')
	        	$alumno->tienefoto = 'SI';
	        else
	        	$alumno->tienefoto = 'NO';
		}
		if(is_numeric($alumnos))
			echo json_encode(['status'=>202,'data'=>[],'message'=>'No se encontraron resultados']);
		else
			echo json_encode(['status'=>200,'data'=>$alumnos,'message'=>'Busqueda satisfactoria']);
	}

	public function buscarCarnets(){
		if(!$this->input->post()){
			header('Location: '.base_url());
		}
		$data = [
			'sede_id'			=> $this->input->post('sede'),
			'Area_id'			=> $this->input->post('area'),
			'ciclo_id'			=> $this->input->post('ciclo'),
			'carnet_impreso'	=> $this->input->post('impresos')
		];
		$alumnos = $this->alumno->getAlumnoWhereFoto($data);
		if(is_numeric($alumnos))
			echo json_encode(['status'=>202,'data'=>[],'message'=>'No se encontraron resultados']);
		else
			echo json_encode(['status'=>200,'data'=>$alumnos,'message'=>'Busqueda satisfactoria']);
	}

	public function buscarTodosCarnets(){
		if(!$this->input->post()){
			header('Location: '.base_url());
		}
		$data = [];
		$alumnos = $this->alumno->getAlumnoWhereFoto($data);
		if(is_numeric($alumnos))
			echo json_encode(['status'=>202,'data'=>[],'message'=>'No se encontraron resultados']);
		else
			echo json_encode(['status'=>200,'data'=>$alumnos,'message'=>'Busqueda satisfactoria']);
	}

	public function buscardatostodos(){
		if(!$this->input->post()){
			header('Location: '.base_url());
		}
		$usuario = $this->session->userdata('usuario');
		if($usuario['id_rol'] == 1){
			$alumnos = $this->alumno->getAlumnosSede(0);
		}
		else{
			$alumnos = $this->alumno->getAlumnosSede($usuario['sede_id']);
		}

		foreach ($alumnos as $key => $alumno) {
			$ruta = '';
			$pers = trim($alumno->apellidos).' '.trim($alumno->nombres);
			$file = str_replace(' ', '_', strtoupper($pers));
	        if(file_exists(BASEPATH."../fotos/".strtoupper($alumno->area).'/'.$file.'.jpg'))
	            $ruta = "fotos/".strtoupper($alumno->area).'/'.$file.'.jpg';
	        if(file_exists(BASEPATH."../fotos/".strtoupper($alumno->area).'/'.$file.'.jpeg'))
	            $ruta = "fotos/".strtoupper($alumno->area).'/'.$file.'.jprg';
	        if(file_exists(BASEPATH."../fotos/".strtoupper($alumno->area).'/'.$file.'.png'))
	            $ruta = "fotos/".strtoupper($alumno->area).'/'.$file.'.png';
	        if(file_exists(BASEPATH."../fotos/".strtoupper($alumno->area).'/'.$file.'.gif'))
	            $ruta = "fotos/".strtoupper($alumno->area).'/'.$file.'.gif';
	        if($ruta != '')
	        	$alumno->tienefoto = 'SI';
	        else
	        	$alumno->tienefoto = 'NO';
		}

		if(is_numeric($alumnos))
			echo json_encode(['status'=>202,'data'=>[],'message'=>'No se encontraron resultados']);
		else
			echo json_encode(['status'=>200,'data'=>$alumnos,'message'=>'Busqueda satisfactoria']);
	}
	public function buscardatosreporte(){
		if(!$this->input->post()){
			header('Location: '.base_url());
		}
		set_time_limit(0);
		$alumnos = $this->alumno->getAlumnoWhere([
			'a.Area_id'			=> $this->input->post('area'),
			'a.sede_id'			=> $this->input->post('sede'),
			'a.ciclo_id'		=> $this->input->post('ciclo')
		]);
		foreach ($alumnos as $key => $value) {
			$pagos = $this->pagos->getPago($value->id_alumno);
			if(is_numeric($pagos)){
				$monto_pagado = 0;
				$monto_deuda = 0;
				$cuota = '-';
				$material = '-';
			}
			else{
				//SI ES PROVISIONAL
				$prov = explode('.', $_SERVER['HTTP_HOST']);
        		if($prov[0] == 'provi'){
        			//INICIO ALGORITMO MATERIAL
        			if($pagos->Material == 20 || $pagos->Material == 26){
						$material = 'PAGADO: '.$pagos->Material;
					}
					else{
						if($pagos->Material == 0){
							if(!is_numeric($this->pagos->getMaterial($value->persona_id,20))){
								$material = 'PAGADO: 20';
							}
							else{
								if(!is_numeric($this->pagos->getMaterial($value->persona_id,26))){
									$material = 'PAGADO: 26';
								}
								else{
									if(!is_numeric($this->pagos->getMaterialProvisional($value->persona_id,20))){
										$material = 'PAGADO: 20';
									}
									else{
										if(!is_numeric($this->pagos->getMaterialProvisional($value->persona_id,26))){
											$material = 'PAGADO: 26';
										}
										else{
											$material = 'NO PAGADO';
										}
									}
								}
							}
						}
						else{						
							if(!is_numeric($this->pagos->getMaterial($value->persona_id,20-$pagos->Material))){
								$material = 'PAGADO: 20';
							}
							else{
								if(!is_numeric($this->pagos->getMaterial($value->persona_id,26-$pagos->Material))){
									$material = 'PAGADO: 26';
								}
								else{
									if(!is_numeric($this->pagos->getMaterialProvisional($value->persona_id,20-$pagos->Material))){
										$material = 'PAGADO: 20';
									}
									else{
										if(!is_numeric($this->pagos->getMaterialProvisional($value->persona_id,26-$pagos->Material))){
											$material = 'PAGADO: 26';
										}
										else{
											$material = 'PAGO PARCIAL: '.$pagos->Material;
										}
									}
								}
							}
						}
					}
					//FIN ALGORITMO MATERIAL

					//INICIO ALGORITMO MONTOS Y CUOTA
					if($pagos->Tipo_Pago == 1){				
						$monto_pagado = $pagos->Monto;
						$monto_deuda = 0;
						$cuota = '-';
						$cuota2 = '-';
					}
					else{
						$monto_pagado = $pagos->Inicial;
						$monto_deuda = 0;
						$cuotas = $this->pagos->getCuota($pagos->id);
						$c = 0;
						$cuota = '-';
						$cuota2 = '-';
						if(!is_numeric($cuotas)) {
							foreach ($cuotas as $key1 => $value1){
								if($value1->Estado == 1){
									$monto_pagado += $value1->Monto;
								}
								else{
									$monto_deuda += $value1->Monto;
									$c += 1;
									if($c == 1)
										$cuota = date('d-m-Y',strtotime($value1->Fecha_Expiracion)).': '.$value1->Monto;
									if($c == 2)
										$cuota2 = date('d-m-Y',strtotime($value1->Fecha_Expiracion)).': '.$value1->Monto;
								}
							}
						}
					}
					//FIN ALGORITMO MONTOS Y CUOTA
        		}
        		//SI NO ES PROVISIONAL
        		else{
				// ALGORITMO MATERIAL
					if($pagos->Material == 20 || $pagos->Material == 26){
						$material = 'PAGADO: '.$pagos->Material;
					}
					else{
						if($pagos->Material == 0){
							if(!is_numeric($this->pagos->getMaterial($value->persona_id,20))){
								$material = 'PAGADO: 20';
							}
							else{
								if(!is_numeric($this->pagos->getMaterial($value->persona_id,26))){
									$material = 'PAGADO: 26';
								}
								else{
									$material = 'NO PAGADO';
								}
							}
						}
						else{						
							if(!is_numeric($this->pagos->getMaterial($value->persona_id,20-$pagos->Material))){
								$material = 'PAGADO: 20';
							}
							else{
								if(!is_numeric($this->pagos->getMaterial($value->persona_id,26-$pagos->Material))){
									$material = 'PAGADO: 26';
								}
								else{
									$material = 'PAGO PARCIAL: '.$pagos->Material;
								}
							}
						}
					}
					//FIN ALGORITMO MATERIAL

					//INICIO ALGORITMO MONTOS Y CUOTA
					if($pagos->Tipo_Pago == 1){				
						$monto_pagado = $pagos->Monto;
						$monto_deuda = 0;
						$cuota = '-';
						$cuota2 = '-';
					}
					else{
						$monto_pagado = $pagos->Inicial;
						$monto_deuda = 0;
						$cuotas = $this->pagos->getCuota($pagos->id);
						$c = 0;
						$cuota = '-';
						$cuota2 = '-';
						if(!is_numeric($cuotas)) {
							foreach ($cuotas as $key1 => $value1){
								if($value1->Estado == 1 && $value1->Boleta != ''){
									$monto_pagado += $value1->Monto;
								}
								else{
									$monto_deuda += $value1->Monto;
									$c += 1;
									if($c == 1)
										$cuota = date('d-m-Y',strtotime($value1->Fecha_Expiracion)).': '.$value1->Monto;
									if($c == 2)
										$cuota2 = date('d-m-Y',strtotime($value1->Fecha_Expiracion)).': '.$value1->Monto;
								}
							}
						}
					}
					//FIN ALGORITMO MONTOS Y CUOTA
				}				
			}			
			$alumnos[$key]->pagos = $monto_pagado;
			$alumnos[$key]->deudas = $monto_deuda;
			$alumnos[$key]->cuota = $cuota;
			$alumnos[$key]->cuota2 = $cuota2;
			$alumnos[$key]->material = $material;
		}
		
		if(is_numeric($alumnos))
			echo json_encode(['status'=>202,'data'=>[],'message'=>'No se encontraron resultados']);
		else
			echo json_encode(['status'=>200,'data'=>$alumnos,'message'=>'Busqueda satisfactoria']);
	}
	public function buscardatosreportetodos(){
		if(!$this->input->post()){
			header('Location: '.base_url());
		}
		set_time_limit(0);
		$usuario = $this->session->userdata('usuario');
		if($usuario['id_rol'] == 1){
			$alumnos = $this->alumno->getAlumnosSede(0);
		}
		else{
			$alumnos = $this->alumno->getAlumnosSede($usuario['sede_id']);
		}

		foreach ($alumnos as $key => $value) {
			$pagos = $this->pagos->getPago($value->id_alumno);
			if(is_numeric($pagos)){
				$monto_pagado = 0;
				$monto_deuda = 0;
				$cuota = '-';
				$material = '-';
			}
			else{
				//SI ES PROVISIONAL
				$prov = explode('.', $_SERVER['HTTP_HOST']);
        		if($prov[0] == 'provi'){
        			//INICIO ALGORITMO MATERIAL
        			if($pagos->Material == 20 || $pagos->Material == 26){
						$material = 'PAGADO: '.$pagos->Material;
					}
					else{
						if($pagos->Material == 0){
							if(!is_numeric($this->pagos->getMaterial($value->persona_id,20))){
								$material = 'PAGADO: 20';
							}
							else{
								if(!is_numeric($this->pagos->getMaterial($value->persona_id,26))){
									$material = 'PAGADO: 26';
								}
								else{
									if(!is_numeric($this->pagos->getMaterialProvisional($value->persona_id,20))){
										$material = 'PAGADO: 20';
									}
									else{
										if(!is_numeric($this->pagos->getMaterialProvisional($value->persona_id,26))){
											$material = 'PAGADO: 26';
										}
										else{
											$material = 'NO PAGADO';
										}
									}
								}
							}
						}
						else{						
							if(!is_numeric($this->pagos->getMaterial($value->persona_id,20-$pagos->Material))){
								$material = 'PAGADO: 20';
							}
							else{
								if(!is_numeric($this->pagos->getMaterial($value->persona_id,26-$pagos->Material))){
									$material = 'PAGADO: 26';
								}
								else{
									if(!is_numeric($this->pagos->getMaterialProvisional($value->persona_id,20-$pagos->Material))){
										$material = 'PAGADO: 20';
									}
									else{
										if(!is_numeric($this->pagos->getMaterialProvisional($value->persona_id,26-$pagos->Material))){
											$material = 'PAGADO: 26';
										}
										else{
											$material = 'PAGO PARCIAL: '.$pagos->Material;
										}
									}
								}
							}
						}
					}
					//FIN ALGORITMO MATERIAL

					//INICIO ALGORITMO MONTOS Y CUOTA
					if($pagos->Tipo_Pago == 1){				
						$monto_pagado = $pagos->Monto;
						$monto_deuda = 0;
						$cuota = '-';
						$cuota2 = '-';
					}
					else{
						$monto_pagado = $pagos->Inicial;
						$monto_deuda = 0;
						$cuotas = $this->pagos->getCuota($pagos->id);
						$c = 0;
						$cuota = '-';
						$cuota2 = '-';
						if(!is_numeric($cuotas)) {
							foreach ($cuotas as $key1 => $value1){
								if($value1->Estado == 1){
									$monto_pagado += $value1->Monto;
								}
								else{
									$monto_deuda += $value1->Monto;
									$c += 1;
									if($c == 1)
										$cuota = date('d-m-Y',strtotime($value1->Fecha_Expiracion)).': '.$value1->Monto;
									if($c == 2)
										$cuota2 = date('d-m-Y',strtotime($value1->Fecha_Expiracion)).': '.$value1->Monto;
								}
							}
						}
					}
					//FIN ALGORITMO MONTOS Y CUOTA
        		}
        		//SI NO ES PROVISIONAL
        		else{
				// ALGORITMO MATERIAL
					if($pagos->Material == 20 || $pagos->Material == 26){
						$material = 'PAGADO: '.$pagos->Material;
					}
					else{
						if($pagos->Material == 0){
							if(!is_numeric($this->pagos->getMaterial($value->persona_id,20))){
								$material = 'PAGADO: 20';
							}
							else{
								if(!is_numeric($this->pagos->getMaterial($value->persona_id,26))){
									$material = 'PAGADO: 26';
								}
								else{
									$material = 'NO PAGADO';
								}
							}
						}
						else{						
							if(!is_numeric($this->pagos->getMaterial($value->persona_id,20-$pagos->Material))){
								$material = 'PAGADO: 20';
							}
							else{
								if(!is_numeric($this->pagos->getMaterial($value->persona_id,26-$pagos->Material))){
									$material = 'PAGADO: 26';
								}
								else{
									$material = 'PAGO PARCIAL: '.$pagos->Material;
								}
							}
						}
					}
					//FIN ALGORITMO MATERIAL

					//INICIO ALGORITMO MONTOS Y CUOTA
					if($pagos->Tipo_Pago == 1){				
						$monto_pagado = $pagos->Monto;
						$monto_deuda = 0;
						$cuota = '-';
						$cuota2 = '-';
					}
					else{
						$monto_pagado = $pagos->Inicial;
						$monto_deuda = 0;
						$cuotas = $this->pagos->getCuota($pagos->id);
						$c = 0;
						$cuota = '-';
						$cuota2 = '-';
						if(!is_numeric($cuotas)) {
							foreach ($cuotas as $key1 => $value1){
								if($value1->Estado == 1 && $value1->Boleta != ''){
									$monto_pagado += $value1->Monto;
								}
								else{
									$monto_deuda += $value1->Monto;
									$c += 1;
									if($c == 1)
										$cuota = date('d-m-Y',strtotime($value1->Fecha_Expiracion)).': '.$value1->Monto;
									if($c == 2)
										$cuota2 = date('d-m-Y',strtotime($value1->Fecha_Expiracion)).': '.$value1->Monto;
								}
							}
						}
					}
					//FIN ALGORITMO MONTOS Y CUOTA
				}				
			}			
			$alumnos[$key]->pagos = $monto_pagado;
			$alumnos[$key]->deudas = $monto_deuda;
			$alumnos[$key]->cuota = $cuota;
			$alumnos[$key]->cuota2 = $cuota2;
			$alumnos[$key]->material = $material;
		}
		
		if(is_numeric($alumnos))
			echo json_encode(['status'=>202,'data'=>[],'message'=>'No se encontraron resultados']);
		else
			echo json_encode(['status'=>200,'data'=>$alumnos,'message'=>'Busqueda satisfactoria']);
	}

	public function getAlumno(){
		if(!$this->input->post())
            header('Location: '.base_url());

		$pagos = $this->pagos->getPago($this->input->post('id_alumno'));
		$id_pagos = $pagos->id;
		$cuotas = $this->pagos->getCuota($id_pagos);
		if(!is_numeric($cuotas))
			foreach ($cuotas as $key => $value) {
				/*
				$prov = $this->pagos->getProvisionalWhere(['cuota_id'=>$value->id]);
				if(!is_numeric($prov))
					$cuotas[$key]->Boleta = $prov->num_serie.'-'.$prov->num_documento;*/
			}

		$personas = $this->alumno->getPersonaId($this->input->post('id_alumno'));
		if(!is_numeric($personas)) foreach ($personas as $key => $value) {
			$id_persona = $value->persona_id;
		}
		$where = "tv.persona_id = ".$id_persona;
		$prov = explode('.', $_SERVER['HTTP_HOST']);
        if($prov[0] == 'provi'){
        	$provisional = $this->pagos->getComprobanteProvisionalUsuario(0,$where);
			if(!is_numeric($provisional)) foreach ($provisional as $key => $value) {
				$al = $this->persona->getPersonaForId2($value->persona_id);
				if(!is_numeric($al)){
					$provisional[$key]->cliente = $al->persona;
					$provisional[$key]->area = '';
				}else{
					$provisional[$key]->cliente = ' ';
					dumpvar($al);
				}
				$u = $this->usuario->getUsuarioForId($value->usuario_id);
				if(!is_numeric($u))
					$provisional[$key]->usuario = $u->usuario;
			}
			$boletas = $this->pagos->getComprobanteBoletasUsuario(0,$where);
			$boletas = array_merge(is_numeric($boletas) ? [] : $boletas, is_numeric($provisional) ? [] : $provisional);    	
        }
        else
			$boletas = $this->pagos->getComprobanteBoletasUsuario(0,$where);
		$facturas = $this->pagos->getComprobanteFacturasUsuario(0,$where);
		$comprobantes = array_merge(is_numeric($boletas) ? [] : $boletas,is_numeric($facturas) ? [] : $facturas);

	    $alumno = $this->alumno->getAlumno($this->input->post('id_alumno'));
	    $alumno->pagos = $pagos;
		$alumno->cuotas = $cuotas;
		
		$tutor = $this->alumno->getTutor($alumno->id);
		$alumno->tutor = $tutor; 
	    $alumno->comprobantes = $comprobantes;

	    $alumno->imagen = is_null($alumno->Foto) ? '' : "/fotos/".strtoupper($alumno->area).'/'.$alumno->Foto;
	    
        if(is_numeric($alumno))
        	echo json_encode(['status'=>202,'data'=>[],'message'=>'Error en la consulta de datos']);
        else
        	echo json_encode(['status'=>200,'data'=>$alumno,'message'=>'Datos encontrados']);
	}

	public function getAlumnoAutocomplete(){
		if(!$this->input->post())
            header('Location: '.base_url());
        if(is_numeric($this->input->post('data')))
            $alumnos = $this->alumno->getAlumnosForCodigo($this->input->post('data'));
        else
            $alumnos = $this->alumno->getAlumnosNombreorApellidos($this->input->post('data'));
        $a = array();
        if(!is_numeric($alumnos))
            foreach ($alumnos as $key => $value) 
                array_push($a, array('value'=>$value->codigo .' - '. $value->apellidos.' '.$value->nombres,'data'=>json_encode($value)));
        print json_encode(array('suggestions'=>$a));
	}

	public function editar($id_alumno){
		if($this->input->post()){
			$areaOLD = $this->alumno->getAreaForAlumnoId($id_alumno);
			if(!is_numeric($areaOLD)) foreach ($areaOLD as $key => $value) {
				$id_area = $value->area;
			}
			$cicloOLD = $this->alumno->getCicloForAlumnoId($id_alumno);
			if(!is_numeric($cicloOLD)) foreach ($cicloOLD as $key => $value) {
				$id_ciclo = $value->ciclo;
			}
			
			$usuario = $this->session->userdata('usuario');
			$personas = $this->alumno->getPersonaId($id_alumno);
			if(!is_numeric($personas)) foreach ($personas as $key => $value) {
				$id_persona = $value->persona_id;
			}
			$persona_alumno = [
				'nombres'			=> $this->input->post('nombres') ? $this->input->post('nombres') : '',
				'apellidos'			=> $this->input->post('apellidos') ? $this->input->post('apellidos') : '',
				'direccion'			=> $this->input->post('direccion'),
				'email'				=> $this->input->post('email') ? $this->input->post('email') : '',
				'fch_nac'			=> date('Y-m-d',strtotime(date($this->input->post('fch_nac')))),
				'telefono'			=> $this->input->post('telefono') ? $this->input->post('telefono') : '',
				'estado'			=> 1
			];
			$this->persona->updatePersona($persona_alumno, $id_persona);			
			$alumno = [
				'colegio'			=> $this->input->post('colegio'),
				'grupo'				=> date('Y-m-d',strtotime(date($this->input->post('grupo')))),
				'grupo_fin'			=> date('Y-m-d',strtotime(date($this->input->post('grupo_fin')))),
				'estado'			=> 1,
				'area_id'			=> $this->input->post('area'),
				'ciclo_id'			=> $this->input->post('ciclo'),
				'turno_id'			=> $this->input->post('turno') ? $this->input->post('turno') : 1
			];
			if($id_area == $this->input->post('area') and $id_ciclo == $this->input->post('ciclo')){
				$this->alumno->updateAlumno($alumno,$id_alumno);
			}
			else{
				$c = [
				'codigo'			=> $this->input->post('0000000')
				];
				$this->alumno->updateAlumno($c,$id_alumno);
				$this->alumno->updateAlumno($alumno,$id_alumno);
				$this->alumno->generaCodigo($id_alumno, $this->input->post('area'));
			}
			$tutores = $this->alumno->getPersonaTutorId($id_alumno);
			if(!is_numeric($tutores)) foreach ($tutores as $key => $value) {
				$id_persona_tutor = $value->persona_id;
			}
			$persona_tutor = [
				'nombres'			=> $this->input->post('nombres2') ? $this->input->post('nombres2') : '',
				'apellidos'			=> $this->input->post('apellidos2') ? $this->input->post('apellidos2') : '',
				'direccion'			=> '',
				'email'				=> $this->input->post('email2') ? $this->input->post('email2') : '',
				'fch_nac'			=> '',
				'telefono'			=> $this->input->post('telefono2') ? $this->input->post('telefono2') : '',
				'estado'			=> 1
			];	
			$this->persona->updatePersona($persona_tutor,$id_persona_tutor);	

			echo json_encode(['status'=>200,'data'=>[
				'persona_id'			=> $id_persona,
				'alumno_id'				=> $id_alumno,
			],'message'=>'Registro satisfactorio']);
			exit();
		}
		$data['parameters'] = $this->parameters;
		$data['alumno'] = $this->alumno->getAlumnoPre($id_alumno);
		$data['tutor'] = $this->alumno->getTutor($id_alumno);
		$areas = $this->persona->getArea();
		$data['areas'] = $areas;
		$usuario = $this->session->userdata('usuario');
		$ciclos = $this->persona->getCiclos($usuario['sede_id']);
		$data['ciclos'] = $ciclos;
		$turnos = $this->persona->getTurno();
		$data['turnos'] = $turnos;
		//dumpvar($data['alumno']);
		$data['content'] = $this->load->view('admin/alumnos/editar_alumnos',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Alumnos';
		$this->load->view('body',$data);
	}	

	public function subirImagen(){
		if(!$this->input->post())
			header('Location: '.base_url());
		$alumno = $this->alumno->getAlumno($this->input->post('id_alumno'));
		$mi_imagen = $_FILES['archivo']['tmp_name'];
		$_FILES['archivo']['name'] = trim(strtolower($_FILES['archivo']['name']));
		//$_FILES['archivo']['tmp_name'] = strtolower($_FILES['archivo']['tmp_name']);
		//dumpvar($_FILES);
		if(!file_exists(BASEPATH."../fotos/"))
			mkdir(BASEPATH."../fotos/");
		if(!file_exists(BASEPATH."../fotos/".strtoupper($alumno->area).'/'))
			mkdir(BASEPATH."../fotos/".strtoupper($alumno->area).'/');
	    $config['upload_path'] = BASEPATH."../fotos/".strtoupper($alumno->area).'/';
	    $config['file_name'] = uniqid($this->input->post('id_alumno').'_');
	    $config['allowed_types'] = "gif|jpg|jpeg|png";
	    $config['max_size'] = "50000";
	    $config['max_width'] = "3000";
	    $config['max_height'] = "5000";

	    $this->load->library('upload', $config);

	    if (!$this->upload->do_upload('archivo')) {
	        //*** ocurrio un error
	        $data['uploadError'] = $this->upload->display_errors();
	        echo json_encode(['status'=>202,'data'=>[],'message'=>$this->upload->display_errors()]);
	        return;
	        echo $this->upload->display_errors();
	        return;
	    }
	    $data['uploadSuccess'] = $this->upload->data();
	    $this->alumno->updateAlumno([
	    	'Foto'			=> $data['uploadSuccess']['file_name']
	    ],$this->input->post('id_alumno'));

	    $response = [
	    	'status'		=> 200,
	    	'data'			=> [
	    		'ruta'				=> 'fotos/'.strtoupper($alumno->area),
	    		'archivo'			=> $data['uploadSuccess']['file_name']
	    	],
	    	'message'		=> 'Carga de foto satisfactoria'
	    ];
	    echo json_encode($response);
	    exit();
	}

	public function dividircuota($id = 0,$id_pagos = 0, $id_alumno = 0){
		if($this->input->post()){
			$cuota_nueva = [
				'monto'					=> $this->input->post('cuota_2'),
				'fecha_pago'			=> '',
				'fecha_expiracion'		=> date('Y-m-d',strtotime(date($this->input->post('fecha_expiracion')))),
				'boleta'				=> '',
				'estado'				=> 0,
				'pagos_id'				=> $id_pagos
			];
			$this->pagos->newCuota($cuota_nueva);	
			
			$monto_nuevo = 	$this->input->post('cuota_1') - $this->input->post('cuota_2');
			$this->pagos->updateCuota([
				'id'				=> $id,
				'Monto'				=> $monto_nuevo
			],[
				'id'			=> $id
			]);

			echo json_encode(['status'=>200,'data'=>[],'message'=>'Registro satisfactorio']);
			exit();
		}
		$data['parameters'] = $this->parameters;
		$cuota = $this->pagos->getCuotaDetalle($id);
		$data['cuota'] = $cuota;
		$data['id_alumno'] = $id_alumno;
		//dumpvar($data['cuota']);
		$data['content'] = $this->load->view('admin/alumnos/dividir_cuota',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Alumnos';
		$this->load->view('body',$data);
	}

	public function editarcuota($id = 0,$id_pagos = 0, $id_alumno = 0){
		$u = $_SESSION['usuario'];
		if($u['id_rol'] != 1){
				header('Location: '.base_url());
		}
		else{
			if($this->input->post()){
				
				$monto_nuevo = 	$this->input->post('cuota');
				$this->pagos->updateCuota([
					'Monto'				=> $monto_nuevo,
					'fecha_expiracion'	=> date('Y-m-d',strtotime(date($this->input->post('fecha_expiracion'))))
				],[
					'id'			=> $id
				]);
				$cuota_anterior = $this->input->post('cuota_1');
				$cuota_nueva = $this->input->post('cuota');
				$pago_anterior = $this->pagos->getPagoDetalle($id_pagos);
				if($cuota_nueva>$cuota_anterior)
					$pago_nuevo = $pago_anterior->Monto+($cuota_nueva - $cuota_anterior);
				else
					$pago_nuevo = $pago_anterior->Monto-($cuota_anterior - $cuota_nueva);
				$this->pagos->updatePago([
					'Monto'				=> $pago_nuevo
				],[
					'id'			=> $id_pagos
				]);
				echo json_encode(['status'=>200,'data'=>[],'message'=>'Registro satisfactorio']);
				exit();
			}
			$data['parameters'] = $this->parameters;
			$cuota = $this->pagos->getCuotaDetalle($id);
			$data['cuota'] = $cuota;			
			$data['id_alumno'] = $id_alumno;
			//dumpvar($data['cuota']);
			$data['content'] = $this->load->view('admin/alumnos/editar_cuota',$data,true);
			$data['usuario'] = $this->session->userdata('usuario');
			$data['module'] = 'Alumnos';
			$this->load->view('body',$data);
		}
	}

	public function eliminarcuota(){
		$u = $_SESSION['usuario'];
		if($u['id_rol'] != 1){
				header('Location: '.base_url());
		}
		else{
			if($this->input->post()){
				$id = $this->input->post('id');
				$id_pagos = $this->input->post('id_pagos');
				$cuota = $this->pagos->getCuotaDetalle($id);
				$pago_anterior = $this->pagos->getPagoDetalle($id_pagos);
				$pago_nuevo = $pago_anterior->Monto - $cuota->Monto;

				$this->pagos->updatePago([
					'Monto'			=> $pago_nuevo
				],[
					'id'			=> $id_pagos
				]);

				$this->pagos->updateCuota([
					'Pagos_id'		=> 0
				],[
					'id'			=> $id
				]);
				
				echo json_encode(['status'=>200,'data'=>[],'message'=>'Registro satisfactorio']);
				exit();
			}
		}
	}

	public function ficha($id = 0){
		if($id == 0)
			header('Location: '.base_url());
		$alumno = $this->alumno->getAlumnoForFichaId($id);
		if(is_numeric($alumno))
			header('Location: '.base_url());
		//dumpvar($alumno);
		$param = $this->parameters;
		$this->load->library('pdf');
		$this->pdf = new Pdf();
        $this->pdf->AddPage('P','A4');        
        $this->pdf->SetMargins(4,0,5);
        $this->pdf->AliasNbPages();
        $this->pdf->SetTitle('Alumno: '.($alumno->codigo == '' ? '' : $alumno->codigo).' - '.$alumno->nombres.' '.$alumno->apellidos);
        $this->pdf->Image(BASEPATH.'../assets/assets/img/'.$param['logo-impreso'],6,8,60);//logo del documento
        $this->pdf->SetFont('Arial','B',6);
        $this->pdf->SetXY(4,4);
        $this->pdf->MultiCell(202,144,'',1);
        $this->pdf->SetXY(70,16);
        $this->pdf->SetFont('Courier','B',30);
        $title = iconv('UTF-8', 'windows-1252', 'FICHA DE INSCRIPCIÓN');
        $this->pdf->Cell(0,2,$title,0,0,'C');

            /*$this->pdf->SetFillColor(1);
            $this->pdf->RoundedRect(152, 22, 45.5, 1, 2, 'DF');*/
            $this->pdf->SetTextColor(255,0,0);
            $this->pdf->SetXY(152,27);
            $text = iconv('UTF-8', 'windows-1252', ($alumno->codigo == '' ? '' : $alumno->codigo));
            $this->pdf->SetFont('Courier','B',25);
            $this->pdf->Cell(50.5,0,$text,0,0,'L');
            $this->pdf->SetXY(2,15);
            $this->pdf->SetTextColor(0,0,0);


        $this->pdf->Ln(14);
        $this->pdf->SetFont('Courier','BU',12);
        $this->pdf->Cell(0,0,'DATOS PERSONALES DEL ALUMNO',0,0,'C');
        $this->pdf->Ln(7);
        $this->pdf->SetFont('Courier','',9);
        $this->pdf->Cell(40,0,'APELLIDOS Y NOMBRES: ',0,0,'I');
        $title = iconv('UTF-8', 'windows-1252', $alumno->apellidos.' '.$alumno->nombres);
        $this->pdf->SetFont('Courier','BU',9);
        $this->pdf->Cell(110,0,$title,0,0,'I');
        $this->pdf->SetFont('Courier','',9);
        $title = iconv('UTF-8', 'windows-1252', 'DNI N°: ');
        $this->pdf->Cell(20,0,$title,0,0,'I');
        $dn = $this->persona->getIdentificacion($alumno->persona_id);
        if(is_numeric($dn))
        	$title = iconv('UTF-8', 'windows-1252', '-');
        else
        	$title = iconv('UTF-8', 'windows-1252', $dn->dni);
        $this->pdf->SetFont('Courier','BU',9);
        $this->pdf->Cell(50,0,$title,0,0,'I');
        $this->pdf->Ln(7);
        $this->pdf->SetFont('Courier','',9);
        $this->pdf->Cell(40,0,'I.E. DE PROCEDENCIA: ',0,0,'I');
        $title = iconv('UTF-8', 'windows-1252', $alumno->Colegio != '' ? $alumno->Colegio : '');
        $this->pdf->SetFont('Courier','BU',9);
        $this->pdf->Cell(80,0,$title,0,0,'I');
        $this->pdf->SetFont('Courier','',9);
        $title = iconv('UTF-8', 'windows-1252', 'EMAIL: ');
        $this->pdf->Cell(20,0,$title,0,0,'I');
        $title = iconv('UTF-8', 'windows-1252', $alumno->email != 'email@email.com' ? $alumno->email : '');
        $this->pdf->SetFont('Courier','BU',9);
        $this->pdf->Cell(50,0,$title,0,0,'I');
        $this->pdf->Ln(7);
        $this->pdf->SetFont('Courier','',9);
        $this->pdf->Cell(20,0,'DOMICILIO: ',0,0,'I');
        $title = iconv('UTF-8', 'windows-1252', $alumno->direccion != '' ? $alumno->direccion : '');
        $this->pdf->SetFont('Courier','BU',9);
        $this->pdf->Cell(100,0,$title,0,0,'I');
        $this->pdf->SetFont('Courier','',9);
        $title = iconv('UTF-8', 'windows-1252', 'TELEFONO: ');
        $this->pdf->Cell(20,0,$title,0,0,'I');
        $title = iconv('UTF-8', 'windows-1252', $alumno->telefono != '' ? $alumno->telefono : '');
        $this->pdf->SetFont('Courier','BU',9);
        $this->pdf->Cell(50,0,$title,0,0,'I');

        $usuario = $this->session->userdata('usuario');
        $area = $this->alumno->getAreaForId($alumno->Area_id);
        $this->pdf->Ln(7);
        $this->pdf->SetFont('Courier','',9);
        $title = iconv('UTF-8', 'windows-1252', 'ÁREA: ');
        $this->pdf->Cell(11,0,$title,0,0,'I');
        $title = iconv('UTF-8', 'windows-1252', strtoupper($area->Descripcion));
        $this->pdf->SetFont('Courier','BU',9);
        $this->pdf->Cell(25,0,$title,0,0,'I');

        $turno = $this->alumno->getTurnoForId($alumno->Turno_id);
        $this->pdf->SetFont('Courier','',9);
        $title = iconv('UTF-8', 'windows-1252', 'TURNO: ');
        $this->pdf->Cell(13,0,$title,0,0,'I');
        $title = iconv('UTF-8', 'windows-1252', strtoupper($turno->descripcion));
        $this->pdf->SetFont('Courier','BU',9);
        $this->pdf->Cell(25,0,$title,0,0,'I');

        $ciclo = $this->alumno->getCicloForId($alumno->ciclo_id);
        //dumpvar($ciclo);
        $this->pdf->SetFont('Courier','',9);
        $title = iconv('UTF-8', 'windows-1252', 'Ciclo: ');
        $this->pdf->Cell(13,0,$title,0,0,'I');
        $title = iconv('UTF-8', 'windows-1252', strtoupper($ciclo->Descripcion));
        $this->pdf->SetFont('Courier','BU',9);
        $this->pdf->Cell(23,0,$title,0,0,'I');

        $this->pdf->Ln(5);

        $matricula = $this->pagos->getLastMatricula($alumno->id_alumno);
        //dumpvar($alumno);
        if($matricula->Fecha_Pago_Inicial != ''){
	        $this->pdf->SetFont('Courier','',9);
	        $title = iconv('UTF-8', 'windows-1252', 'Fch. matricula: ');
	        $this->pdf->Cell(30,0,$title,0,0,'I');
	        $title = iconv('UTF-8', 'windows-1252', strtoupper($matricula->Fecha_Pago_Inicial));
	        $this->pdf->SetFont('Courier','BU',9);
	        $this->pdf->Cell(28,0,$title,0,0,'I');
	    }

	    if($alumno->Grupo != ''){
	        $this->pdf->SetFont('Courier','',9);
	        $title = iconv('UTF-8', 'windows-1252', 'Fch. inicio: ');
	        $this->pdf->Cell(25,0,$title,0,0,'I');
	        $title = iconv('UTF-8', 'windows-1252', strtoupper($alumno->Grupo));
	        $this->pdf->SetFont('Courier','BU',9);
	        $this->pdf->Cell(28,0,$title,0,0,'I');
	    }

	    if($alumno->Grupo_fin != ''){
	        $this->pdf->SetFont('Courier','',9);
	        $title = iconv('UTF-8', 'windows-1252', 'Fch. fin: ');
	        $this->pdf->Cell(42,0,$title,0,0,'I');
	        $title = iconv('UTF-8', 'windows-1252', strtoupper($alumno->Grupo_fin));
	        $this->pdf->SetFont('Courier','BU',9);
	        $this->pdf->Cell(23,0,$title,0,0,'I');
	    }

        $this->pdf->Ln(5);
        $this->pdf->SetFont('Courier','BU',12);
        $this->pdf->Cell(0,0,'DATOS DEL APODERADO(A)',0,0,'C');

        $tutor = $this->alumno->getTutor($alumno->id);

        $this->pdf->Ln(5);

        $this->pdf->SetFont('Courier','',9);
        $title = iconv('UTF-8', 'windows-1252', 'Apellidos y Nombres: ');
        $this->pdf->Cell(40,0,$title,0,0,'I');
        $title = iconv('UTF-8', 'windows-1252', strtoupper($tutor->apellidos.' '.$tutor->nombres));
        $this->pdf->SetFont('Courier','BU',9);
        $this->pdf->Cell(110,0,$title,0,0,'I');

        $this->pdf->SetFont('Courier','',9);
        $title = iconv('UTF-8', 'windows-1252', 'DNI N°: ');
        $this->pdf->Cell(20,0,$title,0,0,'I');
        $title = iconv('UTF-8', 'windows-1252', strtoupper($tutor->nroidentificacion));
        $this->pdf->SetFont('Courier','BU',9);
        $this->pdf->Cell(23,0,$title,0,0,'I');

        $this->pdf->Ln(5);

        $this->pdf->SetFont('Courier','',9);
        $title = iconv('UTF-8', 'windows-1252', 'Teléfonos: ');
        $this->pdf->Cell(23,0,$title,0,0,'I');
        $title = iconv('UTF-8', 'windows-1252', strtoupper($tutor->telefono));
        $this->pdf->SetFont('Courier','BU',9);
        $this->pdf->Cell(85,0,$title,0,0,'I');

        if($tutor->email != ''){
	        $this->pdf->SetFont('Courier','',9);
	        $title = iconv('UTF-8', 'windows-1252', 'EMAIL: ');
	        $this->pdf->Cell(20,0,$title,0,0,'I');
	        $title = iconv('UTF-8', 'windows-1252', strtoupper($tutor->email));
	        $this->pdf->SetFont('Courier','BU',9);
	        $this->pdf->Cell(23,0,$title,0,0,'I');
	    }

        $this->pdf->Ln(5);
        $this->pdf->SetFont('Courier','BU',12);
        $this->pdf->Cell(0,0,'DATOS DE PAGOS',0,0,'C');

        $pago = $this->pagos->getPago($alumno->id);
        if(!is_numeric($pago)){
        	$p = $pago;
	        //dumpvar($pago);

	        $this->pdf->Ln(5);
	        
	        $this->pdf->SetFont('Courier','',9);
	        $title = iconv('UTF-8', 'windows-1252', 'Tipo de pago: ');
	        $this->pdf->Cell(25,0,$title,0,0,'I');
	        $title = iconv('UTF-8', 'windows-1252', $p->Tipo_Pago == 1 ? 'Contado' : 'Crédito');
	        $this->pdf->SetFont('Courier','BU',9);
	        $this->pdf->Cell(20,0,$title,0,0,'I');

	        $this->pdf->SetFont('Courier','',9);
	        $title = iconv('UTF-8', 'windows-1252', 'Monto: ');
	        $this->pdf->Cell(12,0,$title,0,0,'I');
	        $title = iconv('UTF-8', 'windows-1252', strtoupper('S/ '.($p->Monto)));
	        $this->pdf->SetFont('Courier','BU',9);
	        $this->pdf->Cell(23,0,$title,0,0,'I');

		        $this->pdf->SetFont('Courier','',9);
		        $title = iconv('UTF-8', 'windows-1252', 'Material: ');
		        $this->pdf->Cell(17,0,$title,0,0,'I');
		        $title = iconv('UTF-8', 'windows-1252', strtoupper('S/ '.((int)$p->Material)));
		        $this->pdf->SetFont('Courier','BU',9);
		        $this->pdf->Cell(18,0,$title,0,0,'I');
		    

	        if($p->Tipo_Pago == 0){
	        	$this->pdf->SetFont('Courier','',9);
		        $title = iconv('UTF-8', 'windows-1252', 'Inicial: ');
		        $this->pdf->Cell(15,0,$title,0,0,'I');
		        $title = iconv('UTF-8', 'windows-1252', strtoupper('S/ '.$p->Inicial));
		        $this->pdf->SetFont('Courier','BU',9);
		        $this->pdf->Cell(20,0,$title,0,0,'I');

		        $this->pdf->SetFont('Courier','',9);
		        $title = iconv('UTF-8', 'windows-1252', 'Comprobante: ');
		        $this->pdf->Cell(23,0,$title,0,0,'I');
		        $title = iconv('UTF-8', 'windows-1252', strtoupper($p->Boleta_Inicial));
		        $this->pdf->SetFont('Courier','BU',9);
		        $this->pdf->Cell(23,0,$title,0,0,'I');

				$cuotas = $this->pagos->getCuota($p->id);
				//dumpvar($cuotas);

		        foreach ($cuotas as $key => $value) {

			        if(($key)%2 == 0 )
		        		$this->pdf->Ln(5);

		        	$this->pdf->SetFont('Courier','',9);
			        $title = iconv('UTF-8', 'windows-1252', ($key+1).'ª Cuota : ');
			        $this->pdf->Cell(20,0,$title,0,0,'I');
			        $title = iconv('UTF-8', 'windows-1252', $value->Fecha_Expiracion);
			        $this->pdf->SetFont('Courier','BU',9);
			        $this->pdf->Cell(22,0,$title,0,0,'I');

			        $this->pdf->SetFont('Courier','',9);
			        $title = iconv('UTF-8', 'windows-1252', 'Monto: ');
			        $this->pdf->Cell(12,0,$title,0,0,'I');
			        $title = iconv('UTF-8', 'windows-1252', strtoupper('S/ '.$value->Monto));
			        $this->pdf->SetFont('Courier','BU',9);
			        $this->pdf->Cell(20,0,$title,0,0,'I');

			        $title = iconv('UTF-8', 'windows-1252', strtoupper($value->Estado == 1 ? 'Pagado' : 'Deuda'));
			        $this->pdf->SetFont('Courier','',9);
					$this->pdf->Cell(17,0,$title,0,0,'I');
					if($value->Estado == 1 && $value->Boleta == ''){
						$prov = $this->pagos->getProvisionalWhere(['cuota_id'=>$value->id]);
						if(!is_numeric($prov)){
							$this->pdf->SetFont('Courier','',9);
							$title = iconv('UTF-8', 'windows-1252', 'Comprobante: ');
							$this->pdf->Cell(25,0,$title,0,0,'I');
							$title = iconv('UTF-8', 'windows-1252', strtoupper($prov->num_serie.'-'.$prov->num_documento));
							$this->pdf->SetFont('Courier','BU',9);
							$this->pdf->Cell(20,0,$title,0,0,'I');
							$this->pdf->Ln(5);
						}
						//dumpvar($prov);
					}

			        if($value->Estado == 1 && $value->Boleta != ''){

				        $this->pdf->SetFont('Courier','',9);
				        $title = iconv('UTF-8', 'windows-1252', 'Comprobante: ');
				        $this->pdf->Cell(25,0,$title,0,0,'I');
				        $title = iconv('UTF-8', 'windows-1252', strtoupper($value->Boleta == '' ? '-' : $value->Boleta));
				        $this->pdf->SetFont('Courier','BU',9);
				        $this->pdf->Cell(20,0,$title,0,0,'I');
			        }
		        }
	        }else{
	        	$this->pdf->SetFont('Courier','',9);
		        $title = iconv('UTF-8', 'windows-1252', 'Comprobante: ');
		        $this->pdf->Cell(25,0,$title,0,0,'I');
		        $title = iconv('UTF-8', 'windows-1252', strtoupper($p->Boleta_Inicial));
		        $this->pdf->SetFont('Courier','BU',9);
		        $this->pdf->Cell(23,0,$title,0,0,'I');
	        }	        
		}
		
		if($p->Observacion != ''){
			$obs = $this->partir_string($p->Observacion, 100);
			foreach($obs as $k => $ob){
				$this->pdf->SetXY(7,125-(count($obs)*4)+($k*4));
				if($k == 0){
					$this->pdf->SetFont('Courier','B',10);
					$title = iconv('UTF-8', 'windows-1252', 'Observación: ');
					$this->pdf->Cell(27,0,$title,0,0,'I');
				}else{
					$this->pdf->Cell(27,0," ",0,0,'I');
				}
				$this->pdf->SetFont('Courier','I',9);
				$this->pdf->Cell(100,0,$ob,0,0,'I');
			}
			//dumpvar($p->Observacion);
		}

	    $this->pdf->SetXY(7,127);
        $title = iconv('UTF-8', 'windows-1252', 'La academia Preuniversitaria "EXITUS" se reserva el DERECHO DE PUBLICITAR la imagen del alumno en caso');
        $this->pdf->SetFont('Courier','BI',9);
        $this->pdf->Cell(123,0,$title,0,0,'I');
        $this->pdf->SetXY(7,130);
        $title = iconv('UTF-8', 'windows-1252', 'obtenga vacante en la universidad a la que postula para lo cual se autoriza el uso debido de su imagen.');
        $this->pdf->SetFont('Courier','BI',9);
        $this->pdf->Cell(123,0,$title,0,0,'I');
        $this->pdf->Line(20,144,80,144);
        $this->pdf->Text(22,147,'Firma del padre y/o apoderado');
        $this->pdf->Line(130,144,190,144);
        $this->pdf->Text(145,147,'Firma del alumno');


        $this->pdf->Close();
        //$this->pdf->Output(BASEPATH."../pdfs/".$comprobante->num_serie.'-'.$comprobante->num_documento."-A7.pdf", 'F');
        $this->pdf->Output(base_url()."tmp/".'Alumno: '.($alumno->codigo == '' ? '' : $alumno->codigo).' - '.$alumno->nombres.' '.$alumno->apellidos.".pdf", 'I');
		//dumpvar($alumno);
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