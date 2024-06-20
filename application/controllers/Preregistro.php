<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preregistro extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->config->load('parameters',true);
		$this->parameters = $this->config->item('parameters');
		$this->load->model('persona');
		$this->load->model('tutor');
		$this->load->model('alumno');
	}

	public function index(){
		$data['parameters'] = $this->parameters;
		//dumpvar($data['usuarios']);
		$areas = $this->persona->getArea();
		$data['areas'] = $areas;
		$turnos = $this->persona->getTurno();
		$data['turnos'] = $turnos;
		$data['content'] = $this->load->view('home/preregistro',$data,true);
		$this->load->view('body_front',$data);
	}

	public function nuevo(){
		if($this->input->post() || $_FILES){
			//dumpvar([$this->input->post(null,true),$_FILES]);
			$alumno_nuevo = $this->input->post(null,true);
			//Llenado de tabla persona e identificacion con la preinscripcion del alumno
			$persona_alumno = [
				'nombres'			=> $alumno_nuevo['nombres'] ? $alumno_nuevo['nombres'] : '',
				'apellidos'			=> $alumno_nuevo['apellidos'] ? $alumno_nuevo['apellidos'] : '',
				'direccion'			=> $alumno_nuevo['direccion'] ? $alumno_nuevo['direccion'] : '',
				'email'				=> $alumno_nuevo['email'] ? $alumno_nuevo['email'] : '',
				'fch_nac'			=> date('Y-m-d',strtotime(date($alumno_nuevo['fch_nac']))),
				'telefono'			=> $alumno_nuevo['telefono'] ? $alumno_nuevo['telefono'] : '',
				'estado'			=> 1
			];
			$id_persona_alumno = $this->persona->newPersona($persona_alumno);

			$identificacion = [
				'persona_id'				=> $id_persona_alumno,
				'tipo_identificacion_id'	=> 2,
				'nroidentificacion'			=> $alumno_nuevo['dni'] ? $alumno_nuevo['dni'] : ''
			];
			$this->persona->newIdentificacion($identificacion);

			//Llenado de tabla persona, tutor e identificacion con la preinscripcion del tutor
			$persona_tutor = [
				'nombres'			=> $alumno_nuevo['nombres2'] ? $alumno_nuevo['nombres2'] : '',
				'apellidos'			=> $alumno_nuevo['apellidos2'] ? $alumno_nuevo['apellidos2'] : '',
				'direccion'			=> $alumno_nuevo['direccion'] ? $alumno_nuevo['direccion'] : '',
				'email'				=> $alumno_nuevo['email2'] ? $alumno_nuevo['email2'] : '',
				'fch_nac'			=> date('Y-m-d'),
				'telefono'			=> $alumno_nuevo['telefono2'] ? $alumno_nuevo['telefono2'] : '',
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
				'nroidentificacion'			=> $alumno_nuevo['dni2'] ? $alumno_nuevo['dni2'] : ''
			];
			$this->persona->newIdentificacion($identificacion);

			
			$alumno = [
				'persona_id'		=> $id_persona_alumno,
				'colegio'			=> '',
				'tutor_id'			=> $id_tutor,	
				'area_id'			=> $alumno_nuevo['area'] ? $alumno_nuevo['area'] : '',
				'turno_id'			=> $alumno_nuevo['turno'] ? $alumno_nuevo['turno'] : '',
				'estado'			=> 0,
				'estadia'			=> 0,
				'ciclo_id'			=> 1,
				'colegio'			=> $alumno_nuevo['colegio'] ? $alumno_nuevo['colegio'] : ''
			];
			$id_alumno = $this->persona->newAlumno($alumno);

			/** AGREGAR IMAGENES NUEVA FUNCIONALIDAD **/
			$name_file = uniqid(date('Y-m-d').'_');
			if(!file_exists(BASEPATH."../imgs/"))
				mkdir(BASEPATH."../imgs/");
			/*if(!file_exists(BASEPATH."../assets/assets/"))
				mkdir(BASEPATH."../assets/assets/");
			if(!file_exists(BASEPATH."../assets/assets/img/"))
				mkdir(BASEPATH."../assets/assets/img/");*/
		    $config['upload_path'] = BASEPATH."../imgs/";
		    $config['file_name'] = $name_file;
		    $config['allowed_types'] = "gif|jpg|jpeg|png";
		    $config['max_size'] = "50000";
		    $config['max_width'] = "3000";
		    $config['max_height'] = "5000";

		    $this->load->library('upload', $config);

		    if ($this->upload->do_upload('foto-dni')) {
		    	$data['uploadSuccess'] = $this->upload->data();
		        $ruta_foto = $data['uploadSuccess']['file_name'];
		        $this->alumno->newImagen([
		        	'id_alumno'			=> $id_alumno,
		        	'file'				=> $ruta_foto,
		        	'tipo'				=> 1
		        ]);
		    }
		    $config['file_name'] = uniqid(date('Y-m-d').'_');
		    $this->load->library('upload', $config);
		    if ($this->upload->do_upload('foto-boucher')) {
		    	$data['uploadSuccess'] = $this->upload->data();
		        $ruta_foto = $data['uploadSuccess']['file_name'];
		        $this->alumno->newImagen([
		        	'id_alumno'			=> $id_alumno,
		        	'file'				=> $ruta_foto,
		        	'tipo'				=> 2
		        ]);
		    }
		    $config['file_name'] = uniqid(date('Y-m-d').'_');
		    $this->load->library('upload', $config);
		    if ($this->upload->do_upload('foto')) {
		    	$data['uploadSuccess'] = $this->upload->data();
		        $ruta_foto = $data['uploadSuccess']['file_name'];
		        $this->alumno->newImagen([
		        	'id_alumno'			=> $id_alumno,
		        	'file'				=> $ruta_foto,
		        	'tipo'				=> 3
		        ]);
		        $area = $this->alumno->getAreaForId($alumno['area_id']);
		        if(!file_exists(BASEPATH."../fotos/"))
					mkdir(BASEPATH."../fotos/");
				if(!file_exists(BASEPATH."../fotos/".strtoupper($area->Descripcion).'/'))
					mkdir(BASEPATH."../fotos/".strtoupper($area->Descripcion).'/');
	    		copy($config['upload_path'].$ruta_foto, BASEPATH."../fotos/".strtoupper($area->Descripcion).'/'.uniqid($id_alumno.'_').'.jpg');
	    		/*$config['upload_path'] = BASEPATH."../fotos/".strtoupper($area->Descripcion).'/';
	    		$config['file_name'] = uniqid($id_alumno.'_');*/
	    		if($this->upload->do_upload('foto')){
			        $this->alumno->updateAlumno([
				    	'Foto'			=> uniqid($id_alumno.'_').'.jpg'
				    ],$id_alumno);
			    }
		    }
		    /** FIN DE LA NUEVA FUNCIONALIDAD **/

			echo json_encode(['status'=>200,'data'=>[],'message'=>'Registro satisfactorio']);
			exit();
			//header('Location: '.base_url());
		}
		$data['parameters'] = $this->parameters;
		//dumpvar($data['usuarios']);
		$areas = $this->persona->getArea();
		$data['areas'] = $areas;
		$turnos = $this->persona->getTurno();
		$data['turnos'] = $turnos;
		$data['content'] = $this->load->view('home/preregistro',$data,true);
		$this->load->view('body_front',$data);		
	}
}