<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imagen extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->config->load('parameters',true);
		$this->parameters = $this->config->item('parameters');
		$this->load->model('usuario');
		$this->load->model('alumno');
		$this->load->model('persona');
		$this->load->model('pagos');
		$this->load->model('utils');
		$this->load->model('front');
		if(isset($_SESSION['usuario'])){
			$u = $_SESSION['usuario'];
			//dumpvar($u);.
			if($u['id_rol'] != 5){
				header('Location: '.base_url());
			}
		}else{
			header('Location: '.base_url('admin'));
		}
	}

	public function index(){

		$data['portadas'] = $this->front->getPortadas();
		$data['video_post'] = $this->front->getVideoWhere(['tipo'=>1]);
		$data['video_manual'] = $this->front->getVideoWhere(['tipo'=>2]);

		$data['parameters'] = $this->parameters;
		$data['content'] = $this->load->view('admin/imagen/index',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Imagen';
		$this->load->view('body',$data);
	}

	public function nuevaPortada(){
		if(!$this->input->post())
			header('Location: '.base_url());
		$name_file = uniqid(date('Y-m-d').'_');
		if(!file_exists(BASEPATH."../assets/"))
			mkdir(BASEPATH."../assets/");
		if(!file_exists(BASEPATH."../assets/assets/"))
			mkdir(BASEPATH."../assets/assets/");
		if(!file_exists(BASEPATH."../assets/assets/img/"))
			mkdir(BASEPATH."../assets/assets/img/");
	    $config['upload_path'] = BASEPATH."../assets/assets/img/";
	    $config['file_name'] = $name_file;
	    $config['allowed_types'] = "gif|jpg|jpeg|png";
	    $config['max_size'] = "50000";
	    $config['max_width'] = "3000";
	    $config['max_height'] = "5000";

	    $this->load->library('upload', $config);

	    if (!$this->upload->do_upload('imagen')) {
	        //*** ocurrio un error
	        $data['uploadError'] = $this->upload->display_errors();
	        echo json_encode(['status'=>202,'data'=>[],'message'=>$this->upload->display_errors()]);
	        return;
	    }
	    $data['uploadSuccess'] = $this->upload->data();

	    $this->front->newPortada([
	    	'imagen'			=> $data['uploadSuccess']['file_name'],
	    	'titulo'			=> $this->input->post('titulo'),
	    	'descripcion'		=> $this->input->post('contenido'),
	    	'estado'			=> 1
	    ]);

	    echo json_encode(['status'=>200,'data'=>[],'message'=>'Registro satisfactorio']);
	    return;
	}

	public function bajaPortada(){
		if(!$this->input->post())
			header('Location: '.base_url());
		$this->front->updatePortada([
			'estado'			=> $this->input->post('valor')
		],$this->input->post('id'));
		echo json_encode(['status'=>200,'data'=>[],'message'=>$this->input->post('valor') ? 'Activado satisfactoriamente' : 'Dado de baja satisfactoriamente']);
	    return;
	}

	public function guardarVideo(){
		if(!$this->input->post())
			header('Location: '.base_url());
		if($this->input->post('idvideopost') == 0){
			$this->front->newVideo([
				'video'		=> $this->input->post('videopost'),
				'tipo'		=> 1
			]);
		}else{
			$this->front->updateVideoPortada([
				'video'		=> $this->input->post('videopost')
			],$this->input->post('idvideopost'));
		}
		if($this->input->post('idvideomanual') == 0){
			$this->front->newVideo([
				'video'		=> $this->input->post('videomanual'),
				'tipo'		=> 2
			]);
		}else{
			$this->front->updateVideoPortada([
				'video'		=> $this->input->post('videomanual')
			],$this->input->post('idvideomanual'));
		}
		echo json_encode(['status'=>200,'data'=>[],'message'=>'Registro de videos satisfactorios']);
	    return;
	}

	public function eliminarPortada(){
		if(!$this->input->post())
			header('Location: '.base_url());
		$this->front->deletePortada($this->input->post('id'));
		echo json_encode(['status'=>200,'data'=>[],'message'=>'Registro de videos satisfactorios']);
	    return;
	}

	public function nuevAgenda(){
		$data['parameters'] = $this->parameters;
		$data['content'] = $this->load->view('admin/imagen/nueva_agenda',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Imagen';
		$this->load->view('body',$data);
	}
}