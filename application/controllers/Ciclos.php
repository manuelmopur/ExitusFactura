<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ciclos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->config->load('parameters',true);
		$this->parameters = $this->config->item('parameters');
		$this->load->model('usuario');
		$this->load->model('alumno');
		$this->load->model('persona');
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
		if($this->input->post()){
			//dumpvar($this->input->post(null,true));
			$usuario = $this->session->userdata('usuario');
			$ciclo = [
				'descripcion'		=> $this->input->post('descripcion') ? $this->input->post('descripcion') : '',
				'fecha_inicio'		=> date('Y-m-d',strtotime(date($this->input->post('fecha_inicio')))),
				'fecha_fin'			=> date('Y-m-d',strtotime(date($this->input->post('fecha_fin')))),
				'estado'			=> 1
			];
			$id_ciclo = $this->alumno->newCiclo($ciclo);

			$areasID = $this->alumno->getAreasID();
			
			if(!is_numeric($areasID)) foreach ($areasID as $key => $value) {				
				$id_area = $value->id;
				$ciclo_area = [
					'ciclo_id'		=> $id_ciclo,
					'area_id'		=> $id_area,
					'sede_id'		=> $usuario['sede_id'],
					'codigo'		=> $this->input->post($id_area)
				];
				$this->alumno->newCicloArea($ciclo_area);
			}
			echo json_encode(['status'=>200,'data'=>[],'message'=>'Registro satisfactorio']);
			exit();
		}
		$data['parameters'] = $this->parameters;
		$usuario = $this->session->userdata('usuario');
		$data['areas'] = $this->persona->getArea();	
		$data['ciclos'] = $this->persona->getCiclos($usuario['sede_id']);
		//dumpvar($data['alumnos']);
		$data['content'] = $this->load->view('admin/ciclo/index',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Ciclo y Areas';
		$this->load->view('body',$data);
	} 

	public function getCodigos(){
		if(!$this->input->post())
            header('Location: '.base_url());

        $usuario = $this->session->userdata('usuario');
        $areasC=$this->persona->getAreaCodigo($usuario['sede_id'],$this->input->post('valor'));	
	    
        if(is_numeric($areasC))
        	echo json_encode(['status'=>202,'data'=>[],'message'=>'Error en la consulta de datos']);
        else
        	echo json_encode(['status'=>200,'data'=>$areasC,'message'=>'Datos encontrados']);
	}

	public function actualizaArea(){
		if(!$this->input->post())
			header('Location: '.base_url());
		$this->persona->updateArea([
			'Descripcion'			=> $this->input->post('nombre')
		],$this->input->post('id'));
		echo json_encode(['status'=>200,'data'=>[],'message'=>'Datos actualizados correctamente']);
	}

	public function registrarArea(){
		if(!$this->input->post())
			header('Location: '.base_url());
		$this->persona->newArea([
			'Descripcion'			=> $this->input->post('nombre')
		]);
		echo json_encode(['status'=>200,'data'=>[],'message'=>'Datos registrados correctamente']);
	}
	
}