<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asistencia extends CI_Controller {

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
			if($u['id_rol'] != 1 && $u['id_rol'] != 2 && $u['id_rol'] != 7){
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
		if($this->session->userdata('areas_activas')){
			$data['areas_activas'] = $this->session->userdata('areas_activas');
		}
		//dumpvar($data['alumnos']);		
		$data['alumnos'] = $this->alumno->getAlumnosSede($usuario['sede_id']);
		$data['rol'] = $usuario['id_rol'];
		//$data['alumnos'] = $this->alumno->getAlumnosSede(1);
		$data['areas'] = $this->persona->getArea();
		$data['ciclos'] = $this->persona->getCiclos($usuario['sede_id']);
		$data['id_alumno'] = $id_alumno;
		$data['id_usuario'] = $usuario['id_usuario'];
		$data['content'] = $this->load->view('admin/asistencia/index',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Asistencia';
		$this->load->view('body',$data);
	}

	public function preparaAreas(){
		if(!$this->input->post())
			header('Location: '.base_url());
		$areas = $this->persona->getArea();
		if(is_numeric($areas))
			echo json_encode(['status'=>202,'data'=>[],'message'=>'No se encontraron resultados.']);
		else
			echo json_encode(['status'=>200,'data'=>$areas,'message'=>'Resultados encontrados']);
		exit();
	}

	public function guardaAreas(){
		if(!$this->input->post())
			header('Location: '.base_url());
		//dumpvar($this->input->post(null,true));
		$areas = array_flip($this->input->post('areas'));
		foreach ($areas as $key => $value) {
			$areas[$key] = $this->persona->getAreaForId($key)->Descripcion;
		}
		$this->session->set_userdata('areas_activas',$areas);
		echo json_encode(['status'=>200,'data'=>[],'message'=>'Se guardo satisfactoriamente.']);
	}

	public function controlasistencia(){
		$data['parameters'] = $this->parameters;
		$data['content'] = $this->load->view('priv/content',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Asistencia';
		$this->load->view('priv/asistencia',$data);
	}


	public function getAlumnoActualAutocomplete(){
		if(!$this->input->post())
            header('Location: '.base_url());
        if(is_numeric($this->input->post('data')))
            $alumnos = $this->alumno->getAlumnosActualForCodigo($this->input->post('data'));
        else
            $alumnos = $this->alumno->getAlumnosActualNombreorApellidos($this->input->post('data'));
        $a = array();
        if(!is_numeric($alumnos))
            foreach ($alumnos as $key => $value) 
                array_push($a, array('value'=>$value->codigo .' - '. $value->apellidos.' '.$value->nombres,'data'=>json_encode($value)));
        print json_encode(array('suggestions'=>$a));
	}

	public function getAlumno(){
		if(!$this->input->post())
            header('Location: '.base_url());

		$alumno = $this->alumno->getAlumno($this->input->post('id_alumno'));

		$faltas = $this->alumno->getFaltas($this->input->post('id_alumno'));
	    $alumno->faltas = $faltas;
		
		$tutor = $this->alumno->getTutor($alumno->id);
		$alumno->tutor = $tutor; 

	    $alumno->imagen = "/fotos/".strtoupper($alumno->area).'/'.$alumno->foto;
	    
        if(is_numeric($alumno))
        	echo json_encode(['status'=>202,'data'=>[],'message'=>'Error en la consulta de datos']);
        else
        	echo json_encode(['status'=>200,'data'=>$alumno,'message'=>'Datos encontrados']);
	}	

	public function editar($id_asistencia = 0, $id_alumno = 0, $estado = 0, $id_usuario = 0){
		$u = $_SESSION['usuario'];
		if($u['id_rol'] != 1 && $u['id_rol'] != 2 && $u['id_rol'] != 7){
				header('Location: '.base_url('admin'));
		}
		else{
			if($id_usuario == 0 || $u['id_usuario']==$id_usuario){
				if($this->input->post()){		
					$this->alumno->updateAsistencia([
						'estado'				=> $estado == 0 || $estado == 2 ? $estado+1 : $estado,
						'justificacion'			=> $this->input->post('justificacion') ? $this->input->post('justificacion') : '',
						'usuario_id'			=> $u['id_usuario']
					],[
						'id'			=> $id_asistencia
					]);				
					echo json_encode(['status'=>200,'data'=>[],'message'=>'Registro satisfactorio']);
					exit();
				}
				$data['parameters'] = $this->parameters;
				$faltas = $this->alumno->getFaltasDetalle($id_asistencia);
				$data['faltas'] = $faltas;
				$data['id_falta'] = $id_asistencia;
				$data['id_alumno'] = $id_alumno;
				$data['estado'] = $estado;
				$data['id_usuario'] = $id_usuario;
				//dumpvar($data['cuota']);
				$data['content'] = $this->load->view('admin/asistencia/editar_asistencia',$data,true);
				$data['usuario'] = $this->session->userdata('usuario');
				$data['module'] = 'Asistencia';
				$this->load->view('body',$data);
			}
			else{
				header('Location: '.base_url('asistencia/index/'));
			}
		}
	}

	public function reporte(){
		if(!$this->input->post())
			header('Location: '.base_url());
		set_time_limit(0);
		$d = date('Y-m-d',strtotime(date($this->input->post('desde'))));
		$h = date('Y-m-d', strtotime(date($this->input->post('hasta'))));

		if($d <= date('Y-m-d') && $h <= date('Y-m-d')){
			// Buscamos todos los alumnos de dicha area
			$where = [
				//'a.Area_id'			=> $this->input->post('area'),
				'a.sede_id'			=> $this->input->post('sede')
			];

			$alumnos = $this->alumno->getAlumnosInfoWhere($where,$this->input->post('area'));
			//Buscamos todas las faltas
			foreach ($alumnos as $key => $value) {
				$tutor = $this->alumno->getTutor($value->id);
				$alumnos[$key]->tutor = $tutor->telefono;

				$whereF = "estado = 0 and id_alumno = ".$value->id." and fecha BETWEEN '".$d."' and '".$h."'";
				$regF = $this->alumno->getCountFalta($whereF);
				$alumnos[$key]->falta = $regF;

				$whereT = "estado = 2 and id_alumno = ".$value->id." and fecha BETWEEN '".$d."' and '".$h."'";
				$regT = $this->alumno->getCountFalta($whereT);
				$alumnos[$key]->tardanza = $regT;				
			}
		}
		else{
			$alumnos = 0;
		}
		
		if(is_numeric($alumnos))
			echo json_encode(['status'=>202,'data'=>[],'message'=>'No se encontraron registros']);
		else
			echo json_encode(['status'=>200,'data'=>['alumnos'=>$alumnos],'message'=>'Consulta satisfactoria']);
		exit();
	}
}