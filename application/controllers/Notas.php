<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->config->load('parameters',true);
		$this->parameters = $this->config->item('parameters');
		$this->load->model('usuario');
		$this->load->model('alumno');
		$this->load->model('persona');
		$this->load->model('utils');
		if(isset($_SESSION['usuario'])){
			$u = $_SESSION['usuario'];
			//dumpvar($u);
			if($u['id_rol'] != 1 && $u['id_rol'] != 2 && $u['id_rol'] != 8){
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
		$data['turnos'] = $this->utils->getTurnos();
		$data['tipos'] = $this->alumno->getTiposExamen();
		$data['id_alumno'] = $id_alumno;
		$data['id_usuario'] = $usuario['id_usuario'];
		$data['content'] = $this->load->view('admin/notas/index',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Notas';
		$this->load->view('body',$data);
	}

	public function subirNotas(){
		if(!$this->input->post())
			header('Location: '.base_url());
		$archivo = $_FILES['archivo']['tmp_name'];
		
		$_FILES['archivo']['name'] = trim(strtolower($_FILES['archivo']['name']));

		//$_FILES['archivo']['tmp_name'] = strtolower($_FILES['archivo']['tmp_name']);
		//dumpvar($_FILES);
		if(!file_exists(BASEPATH."../excel/"))
			mkdir(BASEPATH."../excel/");
		//if(!file_exists(BASEPATH."../excel/".strtoupper($alumno->area).'/'))
		//	mkdir(BASEPATH."../excel/".strtoupper($alumno->area).'/');
	    $config['upload_path'] = BASEPATH."../excel/";
		$config['file_name'] = uniqid(date('Y-m-d').'_');//cambiar el uniqid
		$config['allowed_types'] = "xlsx|xlsm|xlsb|xltx|xltm|xls|xlt|xml";
	    $config['max_size'] = "50000";

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
	    //Inicio del SpreadSheet
	    $this->load->library('PHPSproudSheets');
	    $inputFileName = $data['uploadSuccess']['full_path'];
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
		for($i = 0; $i<= 20; $i++){
			$sheet = $spreadsheet->getSheet($i);
			if(strncasecmp($sheet->getTitle(), "GRAL", 4) == 0)
				break 1;
		}	
		$fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($sheet->getCellByColumnAndRow(10, 3)->getValue());
		$examen = [
			'tipo_examen_id'		=> $this->input->post('tipo'),
			'sede_id'				=> $this->input->post('sede'),
			'area_id'				=> $this->input->post('area'),
			'ciclo_id'				=> $this->input->post('ciclo'),
			'turno_id'				=> $this->input->post('turno'),
			'fecha'					=> $fecha->format('Y-m-d'),
			'archivo'				=> $data['uploadSuccess']['file_name']
		];
		$id_examen = $this->alumno->newExamen($examen);
		foreach($sheet->getRowIterator(5) as $row){
			if(!is_null($sheet->getCellByColumnAndRow(2, $row->getRowIndex())->getValue())){				
				if(!strncasecmp($sheet->getCellByColumnAndRow(2, $row->getRowIndex())->getValue(), "ZZ", 2) == 0){
					$alumnos = $this->alumno->getAlumnoWhere([
						'a.codigo'			=> $sheet->getCellByColumnAndRow(2, $row->getRowIndex())->getValue(),				
						'a.Area_id'			=> $this->input->post('area'),				
						'a.Turno_id'		=> $this->input->post('turno'),	
						'a.sede_id'			=> $this->input->post('sede'),
						'a.ciclo_id'		=> $this->input->post('ciclo')
					]);
					$examen_detalle = [
						'examen_id'				=> $id_examen,
						'alumno_id'				=> $alumnos[0]->id_alumno,
						'respuestas'			=> $sheet->getCellByColumnAndRow(4, $row->getRowIndex())->getValue(),
						'respuestas_buenas'		=> $sheet->getCellByColumnAndRow(5, $row->getRowIndex())->getValue(),
						'respuestas_malas'		=> $sheet->getCellByColumnAndRow(6, $row->getRowIndex())->getValue(),
						'puntaje'				=> $sheet->getCellByColumnAndRow(7, $row->getRowIndex())->getValue(),
						'nota'					=> $sheet->getCellByColumnAndRow(8, $row->getRowIndex())->getValue(),
						'respuestas_blancas'	=> $sheet->getCellByColumnAndRow(9, $row->getRowIndex())->getValue(),
						'respuestas_multiples'	=> $sheet->getCellByColumnAndRow(10, $row->getRowIndex())->getValue(),
						'marcas_incorrectas'	=> $sheet->getCellByColumnAndRow(11, $row->getRowIndex())->getValue(),
						'marcas_correctas'		=> $sheet->getCellByColumnAndRow(12, $row->getRowIndex())->getValue(),
						'sumario_marcas'		=> $sheet->getCellByColumnAndRow(13, $row->getRowIndex())->getValue(),
						'ubicacion'				=> $sheet->getCellByColumnAndRow(14, $row->getRowIndex())->getValue()
					];
					$this->alumno->newExamenDetalle($examen_detalle);	
				}
				else{
					if(!is_null($sheet->getCellByColumnAndRow(3, $row->getRowIndex())->getValue())){	
						if(!strncasecmp($sheet->getCellByColumnAndRow(3, $row->getRowIndex())->getValue(), "NN", 2) == 0){
							$alumnos = $this->alumno->getAlumnoWhere([
								'concat(p.apellidos," ", p.nombres) = '	=> $sheet->getCellByColumnAndRow(3, $row->getRowIndex())->getValue(),
								'a.Area_id'								=> $this->input->post('area'),				
								'a.Turno_id'							=> $this->input->post('turno'),
								'a.sede_id'								=> $this->input->post('sede'),
								'a.ciclo_id'							=> $this->input->post('ciclo')
							]);
							$examen_detalle = [
								'examen_id'				=> $id_examen,
								'alumno_id'				=> $alumnos[0]->id_alumno,
								'respuestas'			=> $sheet->getCellByColumnAndRow(4, $row->getRowIndex())->getValue(),
								'respuestas_buenas'		=> $sheet->getCellByColumnAndRow(5, $row->getRowIndex())->getValue(),
								'respuestas_malas'		=> $sheet->getCellByColumnAndRow(6, $row->getRowIndex())->getValue(),
								'puntaje'				=> $sheet->getCellByColumnAndRow(7, $row->getRowIndex())->getValue(),
								'nota'					=> $sheet->getCellByColumnAndRow(8, $row->getRowIndex())->getValue(),
								'respuestas_blancas'	=> $sheet->getCellByColumnAndRow(9, $row->getRowIndex())->getValue(),
								'respuestas_multiples'	=> $sheet->getCellByColumnAndRow(10, $row->getRowIndex())->getValue(),
								'marcas_incorrectas'	=> $sheet->getCellByColumnAndRow(11, $row->getRowIndex())->getValue(),
								'marcas_correctas'		=> $sheet->getCellByColumnAndRow(12, $row->getRowIndex())->getValue(),
								'sumario_marcas'		=> $sheet->getCellByColumnAndRow(13, $row->getRowIndex())->getValue(),
								'ubicacion'				=> $sheet->getCellByColumnAndRow(14, $row->getRowIndex())->getValue()
							];
							$this->alumno->newExamenDetalle($examen_detalle);	
						}
					}
				}
			}			
		}
		
	    //$this->alumno->updateAlumno([
	    //	'Foto'			=> $data['uploadSuccess']['file_name']
	    //],$this->input->post('id_alumno'));

	    $response = [
	    	'status'		=> 200,
	    	'data'			=> [
	    		'ruta'				=> 'excel/',
	    		'archivo'			=> $data['uploadSuccess']['file_name']
	    	],
	    	'message'		=> 'Carga de archivo satisfactoria'
	    ];
	    echo json_encode($response);
	    exit();
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

		$notas = $this->alumno->getNotas($this->input->post('id_alumno'));
	    $alumno->notas = $notas;
		
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

	public function buscarExamen(){
		if(!$this->input->post())
			header('Location: '.base_url());
		set_time_limit(0);
		// Buscamos todos los alumnos de dicha area
		$where = [
			'e.sede_id'			=> $this->input->post('sede'),
			'e.ciclo_id'		=> $this->input->post('ciclo'),
			'e.turno_id'		=> $this->input->post('turno')
		];

		$examenes = $this->alumno->getExamenesWhere($where, $this->input->post('area'));
		
		if(is_numeric($examenes))
			echo json_encode(['status'=>202,'data'=>[],'message'=>'No se encontraron registros']);
		else
			echo json_encode(['status'=>200,'data'=>['examenes'=>$examenes],'message'=>'Consulta satisfactoria']);
		exit();
	}

	public function reporte(){
		if(!$this->input->post())
			header('Location: '.base_url());
		set_time_limit(0);
		
		$examen =  $this->alumno->getExamen($this->input->post('id_examen'));
		$titulo = $examen->descripcion.' '.date('d-m-Y', strtotime($examen->fecha)).' '.$examen->sede.' '.$examen->ciclo.' '.$examen->area.' '.$examen->turno;
		$reporte = $this->alumno->getNotasDetalle($this->input->post('id_examen'));
				
		if(is_numeric($reporte))
			echo json_encode(['status'=>202,'data'=>[],'message'=>'No se encontraron registros']);
		else
			echo json_encode(['status'=>200,'data'=>['reporte'=>$reporte, 'titulo'=>$titulo],'message'=>'Consulta satisfactoria']);
		exit();
	}
}