<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends CI_Controller {

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
			if($u['id_rol'] != 1 && $u['id_rol'] != 4){
				header('Location: '.base_url());
			}
		}else{
			header('Location: '.base_url('admin'));
		}
	}

	public function index(){
		$data['parameters'] = $this->parameters;
		$data['noticias'] = [];
		$data['content'] = $this->load->view('admin/noticias/index',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Alumnos';
		$this->load->view('body',$data);
	}

}