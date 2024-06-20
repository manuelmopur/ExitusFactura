<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->config->load('parameters',true);
		$this->parameters = $this->config->item('parameters');
		$this->load->model('usuario');
		$this->load->model('persona');
		if(isset($_SESSION['usuario'])){
			$u = $_SESSION['usuario'];
			if($u['id_rol'] != 1){
				header('Location: '.base_url());
			}
		}else{
			header('Location: '.base_url('admin'));
		}
	}

	public function index(){
		$data['parameters'] = $this->parameters;
		$data['usuarios'] = $this->usuario->getUsuarios();
		//dumpvar($data['usuarios']);
		$data['content'] = $this->load->view('admin/usuario/usuarios',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Usuarios';
		$this->load->view('body',$data);
	}

	public function nuevo(){
		if($this->input->post()){
			//dumpvar($this->input->post(null,true));
			$persona = [
				'nombres'			=> $this->input->post('nombres'),
				'apellidos'			=> $this->input->post('apellidos'),
				'direccion'			=> '',
				'email'				=> $this->input->post('email'),
				'fch_nac'			=> date('Y-m-d'),
				'telefono'			=> '963852741',
				//'sexo'				=> 1,
				'estado'			=> 1
			];
			$id_persona = $this->usuario->newPersona($persona);
			$usuario = [
				'usuario'			=> $this->input->post('usuario'),
				'pass'				=> sha1(md5($this->input->post('password').'Jsilvap')),
				'rol_id'			=> $this->input->post('rol'),
				'persona_id'		=> $id_persona,
				'estado'			=> 1,
				'ultima_session'	=> date('Y-m-d H:i:s'),
				'sede_id'			=> $this->input->post('sede')
			];
			$id_usuario = $this->usuario->newUsuario($usuario);
			header('Location: '.base_url('usuarios'));
		}
		$data['parameters'] = $this->parameters;
		$roles = $this->usuario->getRoles();
		$this->load->model('utils');
		$data['sedes'] = $this->utils->getSedes();
		$data['roles'] = $roles;
		$data['content'] = $this->load->view('admin/usuario/usuarionuevo',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Usuarios';
		$this->load->view('body',$data);
	}
	public function editar($id_usuario){
		if($this->input->post()){
			//dumpvar($this->input->post(null,true));
			$personas = $this->usuario->getPersonaId($id_usuario);
			if(!is_numeric($personas)) foreach ($personas as $key => $value) {
				$id_persona = $value->persona_id;
			} 
			$persona = [
				'nombres'			=> $this->input->post('nombres'),
				'apellidos'			=> $this->input->post('apellidos'),
				'email'				=> $this->input->post('email')
			];
			$this->persona->updatePersona($persona,$id_persona);
			$usuario = [
				'usuario'			=> $this->input->post('usuario'),
				'pass'				=> sha1(md5($this->input->post('password').'Jsilvap')),
				'rol_id'			=> $this->input->post('rol'),
				'persona_id'		=> $id_persona,
				'estado'			=> 1,
				'ultima_session'	=> date('Y-m-d H:i:s'),
				'sede_id'			=> $this->input->post('sede')
			];
			$id_usuario = $this->usuario->updateUsuario($usuario,$id_usuario);
			header('Location: '.base_url('usuarios'));
		}
		$data['parameters'] = $this->parameters;
		$roles = $this->usuario->getRoles();
		$this->load->model('utils');
		$data['sedes'] = $this->utils->getSedes();
		$data['roles'] = $roles;
		$data['user'] = $this->usuario->getUsuarioForId($id_usuario);
		$data['content'] = $this->load->view('admin/usuario/editarusuario',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Usuarios';
		$this->load->view('body',$data);		
	}
}