<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preinscripcion extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->config->load('parameters',true);
		$this->parameters = $this->config->item('parameters');
		$this->load->model('persona');
		$this->load->model('tutor');
		$this->load->model('usuario');
		$this->load->model('alumno');
		$this->load->model('pagos');
		if(isset($_SESSION['usuario'])){
			$u = $_SESSION['usuario'];
			//dumpvar($u);
			if($u['id_rol'] != 1 && $u['id_rol'] != 2){
				header('Location: '.base_url());
			}
		}else{
			header('Location: '.base_url('admin'));
		}
	}

	public function index(){
		if(!$this->session->userdata('usuario'))
			header('Location: '.base_url('admin'));
		$data['parameters'] = $this->parameters;
		//$data['personas'] = $this->persona->getAllPersona();
		$data['personas'] = $this->alumno->getAlumnosPre();
		//dumpvar($data['personas']);
		$data['content'] = $this->load->view('admin/preinscripcion/index',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Inscripción';
		$this->load->view('body',$data);
	}

	public function registroAula(){
		if(!$this->input->post()){
			header('Location: '.base_url());
		}else{
			$alumno = $this->alumno->getAlumno($this->input->post('id_alumno'));
			//dumpvar($alumno);
			$pagos = $this->pagos->getPago($this->input->post('id_alumno'));
			$p = explode('-',$pagos->Fecha_Pago_Inicial);
			$this->load->library('aula');
			$this->aula->cargarCursos(strtolower($alumno->area));
			//$resp = $this->aula->consultAlumno($p[0].$alumno->codigo);
			/*$resp = $this->aula->registrarAlumno([
				'username'				=> $p[0].$alumno->codigo,
				'nombres'				=> $alumno->nombres,
				'apellidos'				=> $alumno->apellidos,
				'email'					=> $alumno->email
			]);*/
			echo json_encode($resp);
			exit();
		}
	}

	public function nuevo(){
		if($this->input->post()){
			$usuario = $this->session->userdata('usuario');
			$persona_alumno = [		
				'nombres'			=> $this->input->post('nombres') ? $this->input->post('nombres') : '',
				'apellidos'			=> $this->input->post('apellidos') ? $this->input->post('apellidos') : '',
				'direccion'			=> $this->input->post('direccion'),
				'email'				=> $this->input->post('email') ? $this->input->post('email') : 'email@email.com',
				'fch_nac'			=> date('Y-m-d',strtotime(date($this->input->post('fch_nac')))),
				'telefono'			=> $this->input->post('telefono') ? $this->input->post('telefono') : '',
				'estado'			=> 1
			];
			$id_persona_alumno = $this->persona->newPersona($persona_alumno);

			$identificacion = [
				'persona_id'				=> $id_persona_alumno,
				'tipo_identificacion_id'	=> 2,
				'nroidentificacion'			=> $this->input->post('dni') ? $this->input->post('dni') : ''
			];
			$this->persona->newIdentificacion($identificacion);

			//Llenado de tabla persona, tutor e identificacion con la preinscripcion del tutor
			$persona_tutor = [
				'nombres'			=> $this->input->post('nombres2') ? $this->input->post('nombres2') : '',
				'apellidos'			=> $this->input->post('apellidos2') ? $this->input->post('apellidos2') : '',
				'direccion'			=> '',
				'email'				=> $this->input->post('email2') ? $this->input->post('email2') : '',
				'fch_nac'			=> '',
				'telefono'			=> $this->input->post('telefono2') ? $this->input->post('telefono2') : '',
				'estado'			=> 1
			];
			$id_persona_tutor = $this->persona->newPersona($persona_tutor);

			$tutor = [
				'persona_id'		=> $id_persona_tutor
			];
			$id_tutor = $this->tutor->newTutor($tutor);

			$identificacion = [
				'persona_id'				=> $id_persona_tutor,
				'tipo_identificacion_id'	=> 2,
				'nroidentificacion'			=> $this->input->post('dni2') ? $this->input->post('dni2') : ''
			];
			$this->persona->newIdentificacion($identificacion);
			$alumno = [
				'persona_id'		=> $id_persona_alumno,
				'colegio'			=> $this->input->post('colegio'),
				'grupo'				=> date('Y-m-d',strtotime(date($this->input->post('grupo')))),
				'grupo_fin'			=> date('Y-m-d',strtotime(date($this->input->post('grupo_fin')))),
				'tutor_id'			=> $id_tutor,	
				'area_id'			=> $this->input->post('area') ? $this->input->post('area') : '',
				'ciclo_id'			=> $this->input->post('ciclo'),
				'turno_id'			=> $this->input->post('turno') ? $this->input->post('turno') : '',
				'estado'			=> 1,
				'sede_id'			=> $usuario['sede_id']				
			];
			$id_alumno = $this->persona->newAlumno($alumno);
			if($this->input->post('area') <= 300 || $this->input->post('area') >= 304)	
				$this->alumno->generaCodigo($id_alumno, $this->input->post('area'));
			$inscrito = $this->alumno->getAlumno($id_alumno);
			if($this->input->post('tipo_pago') == 1){
				$pagos = [
					'monto'					=> $this->input->post('monto') ? $this->input->post('monto') : '',
					'inicial'				=> 0,
					'fecha_pago_inicial'	=> date('Y-m-d',strtotime(date($this->input->post('fch_pago')))),
					'boleta_inicial'		=> '-',
					'alumno_id'				=> $id_alumno,
					'tipo_pago'				=> $this->input->post('tipo_pago'),
					'estado'				=> 1,
					'observacion'			=> $this->input->post('observacion') ? $this->input->post('observacion') : '',
					'material'				=> $this->input->post('material') ? $this->input->post('material') : ''
				];
				$id_pagos = $this->pagos->newPagos($pagos);		
			}			
			else{
				$pagos = [
					'monto'					=> $this->input->post('monto') ? $this->input->post('monto') : '',
					'inicial'				=> $this->input->post('inicial') ? $this->input->post('inicial') : '',
					'fecha_pago_inicial'	=> date('Y-m-d',strtotime(date($this->input->post('fch_pago')))),
					'boleta_inicial'		=> '-',
					'alumno_id'				=> $id_alumno,
					'tipo_pago'				=> $this->input->post('tipo_pago'),
					'estado'				=> 0,
					'observacion'			=> $this->input->post('observacion') ? $this->input->post('observacion') : '',
					'material'				=> $this->input->post('material') ? $this->input->post('material') : ''

				];
				$id_pagos = $this->pagos->newPagos($pagos);
				for($i=1; $i<=$this->input->post('lcuotas'); $i++){
					$cuota = [
						'monto'					=> $this->input->post('monto_'.$i),
						'fecha_pago'			=> '',
						'fecha_expiracion'		=> date('Y-m-d',strtotime(date($this->input->post('fecha_'.$i)))),
						'boleta'				=> '',
						'estado'				=> 0,
						'pagos_id'				=> $id_pagos
					];
					$this->pagos->newCuota($cuota);				
				}
			}
			$matricula = [];
			//registrando al alumna en el aula virtual
			/*if($this->input->post('ciclo') >= 9){
				//$alumno = $this->alumno->getAlumno($this->input->post('id_alumno'));
				//dumpvar($alumno);
				//$pagos = $this->pagos->getPago($this->input->post('id_alumno'));
				//$p = explode('-',$pagos->Fecha_Pago_Inicial);
				$this->load->library('aula');
				$this->aula->cargarCursos(strtolower($inscrito->area));
				//$resp = $this->aula->consultAlumno($p[0].$alumno->codigo);
				$resp = $this->aula->registrarAlumno([
					'username'				=> date('Y').$inscrito->codigo,
					'nombres'				=> $inscrito->nombres,
					'apellidos'				=> $inscrito->apellidos,
					'email'					=> $inscrito->email
				]);
				if($resp['status']==200){
					$matricula = $resp['data']['cursos'];
				}
			}*/
			echo json_encode(['status'=>200,'data'=>[
				'persona_id'			=> $id_persona_alumno,
				'alumno_id'				=> $id_alumno,
				'pago_id'				=> $id_pagos,
				'codigo'  				=> $inscrito->codigo,
				'matricula'				=> $matricula
			],'message'=>'Registro satisfactorio']);
			exit();
		}
		$data['parameters'] = $this->parameters;
		$areas = $this->persona->getArea();
		$data['areas'] = $areas;
		$usuario = $this->session->userdata('usuario');
		$ciclos = $this->persona->getCiclos($usuario['sede_id']);
		$data['ciclos'] = $ciclos;
		$turnos = $this->persona->getTurno();
		$data['turnos'] = $turnos;
		//dumpvar($data['alumno']);
		$data['content'] = $this->load->view('admin/preinscripcion/inscripcion',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Inscripción';
		$this->load->view('body',$data);
	}

	public function inscribir($id_alumno){
		if($this->input->post()){
			/*echo json_encode(['status'=>200,'data'=>[],'message'=>'Registro satisfactorio']);
			exit();*/
			//dumpvar($this->input->post(null,true));
			$usuario = $this->session->userdata('usuario');
			$personas = $this->alumno->getPersonaId($id_alumno);
			if(!is_numeric($personas)) foreach ($personas as $key => $value) {
				$id_persona = $value->persona_id;
			}
			$persona_alumno = [
				'nombres'			=> $this->input->post('nombres') ? $this->input->post('nombres') : '',
				'apellidos'			=> $this->input->post('apellidos') ? $this->input->post('apellidos') : '',
				'direccion'			=> $this->input->post('direccion'),
				'email'				=> $this->input->post('email') ? $this->input->post('email') : 'email@email.com',
				'fch_nac'			=> date('Y-m-d',strtotime(date($this->input->post('fch_nac')))),
				'telefono'			=> $this->input->post('telefono') ? $this->input->post('telefono') : '',
				'estado'			=> 1
			];
			$this->persona->updatePersona($persona_alumno,$id_persona);		
			$ident = $this->persona->getIdentificacion($id_persona);
			if(!is_numeric($ident)){
				$identificacion = [
					'persona_id'				=> $id_persona,
					'nroidentificacion'			=> $this->input->post('dni') ? $this->input->post('dni') : ''
				];
				$this->persona->updateIdentificacion($identificacion,$id_persona);	
			}else{
				$identificacion = [
					'persona_id'				=> $id_persona,
					'tipo_identificacion_id'	=> 2,
					'nroidentificacion'			=> $this->input->post('dni') ? $this->input->post('dni') : ''
				];
				$this->persona->newIdentificacion($identificacion);
			}
			$alumno = [
				'colegio'			=> $this->input->post('colegio'),
				'grupo'				=> date('Y-m-d',strtotime(date($this->input->post('grupo')))),
				'grupo_fin'			=> date('Y-m-d',strtotime(date($this->input->post('grupo_fin')))),
				'estado'			=> 1,
				'estadia'			=> 1,
				'area_id'			=> $this->input->post('area'),
				'ciclo_id'			=> $this->input->post('ciclo'),
				'turno_id'			=> $this->input->post('turno') ? $this->input->post('turno') : '',
				'sede_id'			=> $usuario['sede_id']
			];
			$this->alumno->updateAlumno($alumno,$id_alumno);
			if($this->input->post('area') <= 300 || $this->input->post('area') >= 303)
				$this->alumno->generaCodigo($id_alumno, $this->input->post('area'));
			$inscrito = $this->alumno->getAlumno($id_alumno);

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

			if($this->input->post('tipo_pago') == 1){
				$pagos = [
					'monto'					=> $this->input->post('monto') ? $this->input->post('monto') : '',
					'inicial'				=> 0,
					'fecha_pago_inicial'	=> date('Y-m-d',strtotime(date($this->input->post('fch_pago')))),
					'boleta_inicial'		=> '-',
					'alumno_id'				=> $id_alumno,
					'tipo_pago'				=> $this->input->post('tipo_pago'),
					'estado'				=> 1,
					'observacion'			=> $this->input->post('observacion') ? $this->input->post('observacion') : '',
					'material'				=> $this->input->post('material') ? $this->input->post('material') : ''
				];
				$id_pagos = $this->pagos->newPagos($pagos);		
			}				
			else{
				$pagos = [
					'monto'					=> $this->input->post('monto') ? $this->input->post('monto') : '',
					'inicial'				=> $this->input->post('inicial') ? $this->input->post('inicial') : '',
					'fecha_pago_inicial'	=> date('Y-m-d',strtotime(date($this->input->post('fch_pago')))),
					'boleta_inicial'		=> '-',
					'alumno_id'				=> $id_alumno,
					'tipo_pago'				=> $this->input->post('tipo_pago'),
					'estado'				=> 0,
					'observacion'			=> $this->input->post('observacion') ? $this->input->post('observacion') : '',
					'material'				=> $this->input->post('material') ? $this->input->post('material') : ''
				];
				$id_pagos = $this->pagos->newPagos($pagos);
				for($i=1; $i<=$this->input->post('lcuotas'); $i++){
					$cuota = [
						'monto'					=> $this->input->post('monto_'.$i),
						'fecha_pago'			=> '',
						'fecha_expiracion'		=> date('Y-m-d',strtotime(date($this->input->post('fecha_'.$i)))),
						'boleta'				=> '',
						'estado'				=> 0,
						'pagos_id'				=> $id_pagos
					];
					$this->pagos->newCuota($cuota);
				}
			}
			$matricula = [];
			//registrando al alumna en el aula virtual
			/*if($this->input->post('ciclo') >= 8){
				//$alumno = $this->alumno->getAlumno($this->input->post('id_alumno'));
				//dumpvar($alumno);
				//$pagos = $this->pagos->getPago($this->input->post('id_alumno'));
				//$p = explode('-',$pagos->Fecha_Pago_Inicial);
				$this->load->library('aula');
				$this->aula->cargarCursos(strtolower($inscrito->area));
				//$resp = $this->aula->consultAlumno($p[0].$alumno->codigo);
				$resp = $this->aula->registrarAlumno([
					'username'				=> date('Y').$inscrito->codigo,
					'nombres'				=> $inscrito->nombres,
					'apellidos'				=> $inscrito->apellidos,
					'email'					=> $inscrito->email
				]);
				if($resp['status']==200){
					$matricula = $resp['data']['cursos'];
				}
			}*/
			echo json_encode(['status'=>200,'data'=>[
				'persona_id'			=> $id_persona,
				'alumno_id'				=> $id_alumno,
				'pago_id'				=> $id_pagos,
				'codigo'  				=> $inscrito->codigo,
				'matricula'				=> $matricula
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
		$data['imagenes'] = $this->alumno->getImagenesInscripcion($id_alumno);
		//dumpvar($data['imagenes']);
		$data['content'] = $this->load->view('admin/preinscripcion/inscripcion',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Inscripción';
		$this->load->view('body',$data);
	}	
}