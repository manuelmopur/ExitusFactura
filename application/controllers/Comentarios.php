<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comentarios extends CI_Controller {

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
			if($u['id_rol'] != 1 && $u['id_rol'] != 6 && $u['id_rol'] != 2){
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
		$data['content'] = $this->load->view('admin/comentarios/index',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Comentarios';
		$this->load->view('body',$data);
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

		$comentarios = $this->alumno->getComentarios($this->input->post('id_alumno'));
	    $alumno->comentarios = $comentarios;
		
		$tutor = $this->alumno->getTutor($alumno->id);
		$alumno->tutor = $tutor; 

	    $alumno->imagen = "/fotos/".strtoupper($alumno->area).'/'.$alumno->foto;
	    
        if(is_numeric($alumno))
        	echo json_encode(['status'=>202,'data'=>[],'message'=>'Error en la consulta de datos']);
        else
        	echo json_encode(['status'=>200,'data'=>$alumno,'message'=>'Datos encontrados']);
	}
	public function nuevo($id_alumno = 0){
		$u = $_SESSION['usuario'];
		if($u['id_rol'] != 1 && $u['id_rol'] != 6){
				header('Location: '.base_url('admin'));
		}
		else{
			if($this->input->post()){				
				$comentario = 
				[
					'usuario_id'	=> ($u['id_usuario']),
					'alumno_id'		=> $id_alumno,					
					'fecha'			=> date('Y-m-d H:i:s'),
					'comentario'	=> $this->input->post('comentario') ? $this->input->post('comentario') : ''
				];	
				$this->alumno->newComentario($comentario);			
				echo json_encode(['status'=>200,'data'=>[],'message'=>'Registro satisfactorio']);
				exit();
			}
			$data['parameters'] = $this->parameters;
			$data['id_alumno'] = $id_alumno;
				//dumpvar($data['cuota']);
			$data['content'] = $this->load->view('admin/comentarios/nuevo',$data,true);
			$data['usuario'] = $this->session->userdata('usuario');
			$data['module'] = 'Comentarios';
			$this->load->view('body',$data);
		}		
	}
	public function editar($id_comentario = 0, $id_usuario = 0, $id_alumno = 0){
		$u = $_SESSION['usuario'];
		if($u['id_rol'] != 1 && $u['id_rol'] != 6){
				header('Location: '.base_url('admin'));
		}
		else{
			if($u['id_usuario']==$id_usuario){
				if($this->input->post()){				
					$comentario = 	$this->input->post('comentario');
					$this->alumno->updateComentario([
						'comentario'				=> $comentario
					],[
						'id'			=> $id_comentario
					]);				
					echo json_encode(['status'=>200,'data'=>[],'message'=>'Registro satisfactorio']);
					exit();
				}
				$data['parameters'] = $this->parameters;
				$comentario = $this->alumno->getComentarioDetalle($id_comentario);
				$data['comentario'] = $comentario;
				$data['id_comentario'] = $id_comentario;
				$data['id_usuario'] = $id_usuario;
				$data['id_alumno'] = $id_alumno;
				//dumpvar($data['cuota']);
				$data['content'] = $this->load->view('admin/comentarios/editar_comentario',$data,true);
				$data['usuario'] = $this->session->userdata('usuario');
				$data['module'] = 'Comentarios';
				$this->load->view('body',$data);
			}
			else{
				header('Location: '.base_url('admin'));
			}
		}
	}
}