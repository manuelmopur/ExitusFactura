<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->config->load('parameters',true);
		$this->parameters = $this->config->item('parameters');
	}

	public function index()
	{
		$data['content'] = $this->load->view('home/home',[],true);
		$data['parameters'] = $this->parameters;
		$this->load->view('body_front',$data);
	}

	public function noticias(){
		$data['content'] = $this->load->view('home/noticias',[],true);
		$data['parameters'] = $this->parameters;
		$this->load->view('body_front',$data);
	}

	public function preregistro(){
		$data['content'] = $this->load->view('home/preregistro',[],true);
		$data['parameters'] = $this->parameters;
		$this->load->view('body_front',$data);
	}

	public function nosotros(){
		$data['content'] = $this->load->view('home/nosotros',[],true);
		$data['parameters'] = $this->parameters;
		$this->load->view('body_front',$data);
	}

	public function areas(){
		$this->load->model('persona');
		$areas = $this->persona->getArea();
		$data['content'] = $this->load->view('home/areas',[
			'areas'				=> $areas
		],true);
		$data['parameters'] = $this->parameters;
		$this->load->view('body_front',$data);
	}
}
