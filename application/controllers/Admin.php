<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->config->load('parameters',true);
		$this->parameters = $this->config->item('parameters');
		$this->load->model('usuario');
		$this->load->model('pagos');
		$this->load->model('persona');
		$this->load->model('alumno');
		$this->load->model('utils');
	}

	public function consultAlumnoScanner(){
		if(!$this->input->post())
			header('Location: '.base_url());
		//$consulta = $this->alumno->busquedaAlumno($where);
			$id_alumno = $this->input->post('id_alumno');
		$alumno = $this->alumno->getAlumno($id_alumno);
		$u = $this->session->userdata('usuario');
		if(!array_key_exists($alumno->Area_id, $this->session->userdata('areas_activas'))){
			$cadena = implode(', ', array_values($this->session->userdata('areas_activas')));
			echo json_encode(['status'=>202,'data'=>[],'message'=>'Atención, este alumno no pertenece a las areas seleccionadas, '.$cadena]);
			exit();
		}
		if($alumno->sede_id != $u['sede_id']){
			echo json_encode(['status'=>202,'data'=>[],'message'=>'Atención, este alumno no pertenece a esta sede']);
			exit();
		}
		$pers = trim($alumno->apellidos).' '.trim($alumno->nombres);
        $file = str_replace(' ', '_', strtoupper($pers));
        $ruta = "fotos/".strtoupper($alumno->area).'/'.$alumno->foto;
        $pago = $this->pagos->getPago($id_alumno);
        $estado = 1;
        $cuotas = $this->pagos->getCuota($pago->id);
        $fecha_exp = date('Y-m-d');
        $monto = 0.0;
        $material = '';
        if(!is_numeric($cuotas)){
	        $dia = strtotime(date('Y-m-d'));
	        foreach ($cuotas as $key => $value) {
	        	$fecha = strtotime(date('Y-m-d',strtotime($value->Fecha_Expiracion)));
				if($dia > $fecha && $value->Estado == 0){
					$estado = 0;
					$fecha_exp = $value->Fecha_Expiracion;
					$monto = $value->Monto;
					break;
				}	        	
	        }
	    }
	    //INICIO ALGORITMO MATERIAL
	    if($pago->Material == 20 || $pago->Material == 26){
			$material = 'PAGADO: '.$pago->Material;
		}
		else{
			if($pago->Material == 0){
				if(!is_numeric($this->pagos->getMaterial($alumno->persona_id,20))){
					$material = 'PAGADO: 20';
				}
				else{
					if(!is_numeric($this->pagos->getMaterial($alumno->persona_id,26))){
						$material = 'PAGADO: 26';
					}
					else{
						if(!is_numeric($this->pagos->getMaterialProvisional($alumno->persona_id,20))){
							$material = 'PAGADO: 20';
						}
						else{
							if(!is_numeric($this->pagos->getMaterialProvisional($alumno->persona_id,26))){
								$material = 'PAGADO: 26';
							}
							else{
								$material = 'NO PAGADO';
							}
						}
					}
				}
			}
			else{						
				if(!is_numeric($this->pagos->getMaterial($alumno->persona_id,20-$pago->Material))){
					$material = 'PAGADO: 20';
				}
				else{
					if(!is_numeric($this->pagos->getMaterial($alumno->persona_id,26-$pago->Material))){
						$material = 'PAGADO: 26';
					}
					else{
						if(!is_numeric($this->pagos->getMaterialProvisional($alumno->persona_id,20-$pago->Material))){
							$material = 'PAGADO: 20';
						}
						else{
							if(!is_numeric($this->pagos->getMaterialProvisional($alumno->persona_id,26-$pago->Material))){
								$material = 'PAGADO: 26';
							}
							else{
								$material = 'PAGO PARCIAL: '.$pago->Material;
							}
						}
					}
				}
			}
		}
	    //FIN ALGORITMO MATERIAL
	    if($u['id_rol'] != 2)
			$this->alumno->updateAlumno(['estado_asistencia'=>1],$id_alumno);
		if($this->input->post('tardanza') == 1){
			$falta = $this->alumno->getFaltaWhere([
				'fecha'			=> date('Y-m-d'),
				'id_alumno'		=> $id_alumno,
				'estado'		=> 2
			]);
			if(is_numeric($falta)){
				$data_asistencia = [
					'id_alumno'				=> $id_alumno,
					'fecha'					=> date('Y-m-d'),
					'estado'				=> 2
				];
				$this->alumno->newFalta($data_asistencia);
			}
		}
        $data = [
        	'alumno'			=> $alumno,
        	'imagen'			=> $ruta,
        	'estado'			=> $estado,
        	'fecha'				=> date('d-m-Y',strtotime($fecha_exp)),
        	'monto'				=> number_format($monto,2,'.',''),
        	'material'			=> $material
        ];

        echo json_encode(['status'=>200,'data'=>$data,'message'=>'Consulta satisfactoria']);
        exit();
	}

	public function getReporteAdmin(){
		if(!$this->input->post())
            header('Location: '.base_url());
        $sedes = $this->utils->getSedes();
        $data = [
        	date('m-Y') => [],
        	'all'	=> []
        ];
        try{
	        foreach ($sedes as $key => $sede) {
	        	$total_contado = $this->pagos->getTotalPagosContado($sede->id,date('Y-m'));
	        	$cuotas_pagas = $this->pagos->getTotalCuotasPagadas($sede->id,date('Y-m'));
	        	$deudas = $this->pagos->getTotalDeudas($sede->id);
	        	array_push($data[date('m-Y')], [
	        		'nombre'				=> $sede->Descripcion,
	        		'monto_contado'			=> (double) (is_null($total_contado->Monto) ? 0 : $total_contado->Monto),
	        		'monto_credito'			=> (double) (is_null($cuotas_pagas->Monto) ? 0 : $cuotas_pagas->Monto),
	        		'monto_deudas'			=> (double) (is_null($deudas->Monto) ? 0 : $deudas->Monto)
	        	]);
	        }

	        foreach ($sedes as $key => $sede) {
	        	$total_contado = $this->pagos->getTotalPagosContado($sede->id);
	        	$cuotas_pagas = $this->pagos->getTotalCuotasPagadas($sede->id);
	        	$deudas = $this->pagos->getTotalDeudas($sede->id);
	        	array_push($data['all'], [
	        		'nombre'				=> $sede->Descripcion,
	        		'monto_contado'			=> (double) (is_null($total_contado->Monto) ? 0 : $total_contado->Monto),
	        		'monto_credito'			=> (double) (is_null($cuotas_pagas->Monto) ? 0 : $cuotas_pagas->Monto),
	        		'monto_deudas'			=> (double) (is_null($deudas->Monto) ? 0 : $deudas->Monto)
	        	]);
	        }
	        echo json_encode(['status'=>200,'data'=>$data,'message'=>'Consulta satisfactoria']);
	    }catch(Exception $e){
	    	echo json_encode(['status'=>202,'data'=>[],'message'=>'Error en la consulta']);
	    }
	}

	public function getAsistecciaAlumno(){
		if(!$this->input->post())
            header('Location: '.base_url());

		$alumno = $this->alumno->getAlumno($this->input->post('id_alumno'));

		$faltas = $this->alumno->getFaltas($this->input->post('id_alumno'));
	    $alumno->faltas = $faltas;
	    $notas = $this->alumno->getNotas($this->input->post('id_alumno'));
	    $alumno->notas = $notas;
	    $pagos = $this->pagos->getPago($this->input->post('id_alumno'));
	    $alumno->pagos = $pagos;

		$cuotas = $this->pagos->getCuota($pagos->id);
		if(!is_numeric($cuotas))
			foreach ($cuotas as $key => $value) {
				$prov = $this->pagos->getProvisionalWhere(['cuota_id'=>$value->id]);
				if(!is_numeric($prov))
					$cuotas[$key]->Boleta = $prov->num_serie.'-'.$prov->num_documento;
			}
		$alumno->cuotas = $cuotas;
		
		$tutor = $this->alumno->getTutor($alumno->id);
		$alumno->tutor = $tutor; 
	    
        if(is_numeric($alumno))
        	echo json_encode(['status'=>202,'data'=>[],'message'=>'Error en la consulta de datos']);
        else
        	echo json_encode(['status'=>200,'data'=>$alumno,'message'=>'Datos encontrados']);
	}	

	public function getInfo(){
		if(!$this->input->post())
			header('Location: '.base_url());
		$ciclo = $this->alumno->getCicloActual();
		$areas = $this->persona->getAreaCodigo(1,$ciclo->id);
		echo json_encode(['status'=>200,'data'=>[
			'ciclo'		=> [
				'nombre'	=> is_numeric($ciclo) ? '-' : $ciclo->Descripcion,
				'fecha'		=> is_numeric($ciclo) ? '-' : date('d/m/Y',strtotime($ciclo->Fecha_Inicio))
			],
			'areas'		=> is_numeric($areas) ? [] : $areas
		],'message'=>'Consulta satisfactoria']);
	}

	public function searchAlumnoApp(){
		if(!$this->input->post())
			header('Location: '.base_url());
		//$consulta = $this->alumno->busquedaAlumno($where);
			$id_alumno = $this->input->post('id_alumno');
		$alumno = $this->alumno->getAlumno($id_alumno);
		$pers = trim($alumno->apellidos).' '.trim($alumno->nombres);
        $file = str_replace(' ', '_', strtoupper($pers));
        $ruta = "fotos/".strtoupper($alumno->area).'/'.$alumno->foto;
        $pago = $this->pagos->getPago($id_alumno);
        $estado = 1;
        if($pago->Estado == 0)
        	$estado = 0;
        $cuotas = $this->pagos->getCuota($pago->id);
        $fecha_exp = date('Y-m-d');
        $monto = 0.0;
        if(!is_numeric($cuotas)){
	        $dia = strtotime(date('Y-m-d'));
	        foreach ($cuotas as $key => $value) {
	        	$fecha = strtotime(date('Y-m-d',strtotime($value->Fecha_Expiracion)));
				if($dia > $fecha && $value->Estado == 1){
					$estado = 0;
					$fecha_exp = $value->Fecha_Expiracion;
					$monto = $value->Monto;
					break;
				}
	        }
	    }
		$this->alumno->updateAlumno(['estado_asistencia'=>1],$id_alumno);
        $data = [
        	'alumno'			=> $pers,
        	'imagen'			=> $ruta,
        	'estado'			=> $estado,
        	'fecha'				=> $fecha_exp,
        	'monto'				=> number_format($monto,2,'.','')
        ];

        echo json_encode(['status'=>200,'data'=>$data,'message'=>'Consulta satisfactoria']);
        exit();
	}

	public function loginAppWithEmail(){
		if($this->input->post()){
			$u = $this->usuario->getUsuarioWithEmail($this->input->post('username'));
			if(is_numeric($u)){
				echo json_encode(['status'=>202,'data'=>[],'message'=>'Error en los datos ingresados']);
				exit();
			}
			if($this->input->post("google") == "yes" || $u->pass == sha1(md5($this->input->post('password').'Jsilvap'))){
				if($u->estado != 1){
					echo json_encode(['status'=>202,'data'=>[],'message'=>'Usuario Inactivo']);
					exit();
				}else{
					$this->load->model('utils');
					$sede = $this->utils->getSede($u->sede_id);
					$data = [
						'id_usuario'		=> $u->id,
						'usuario'			=> $u->usuario,
						'id_rol'			=> $u->rol_id,
						'id_persona'		=> $u->persona_id,
						'nombres'			=> $u->nombres,
						'apellidos'			=> $u->apellidos,
						'direccion'			=> $u->direccion,
						'email'				=> $u->email,
						'fch_nac'			=> $u->fch_nac,
						'telefono'			=> $u->telefono,
						//'sexo'				=> $u->sexo,
						'sede_id'			=> $u->sede_id,
						'sede'				=> $sede->Descripcion
					];
					echo json_encode(['status'=>200,'data'=>$data,'message'=>'Ingreso satisfactorio']);
					exit();
				}
			}else{
				echo json_encode(['status'=>202,'data'=>'','message'=>'Ingreso satisfactorio']);
				exit();
			}
		}
	}

	public function loginApp(){
		if($this->input->post()){
			$u = $this->usuario->getUsuario($this->input->post('username'));
			if(is_numeric($u)){
				echo json_encode(['status'=>202,'data'=>[],'message'=>'Error en los datos ingresados']);
				exit();
			}
			if($u->pass == sha1(md5($this->input->post('password').'Jsilvap'))){
				if($u->estado != 1){
					echo json_encode(['status'=>202,'data'=>[],'message'=>'Usuario Inactivo']);
					exit();
				}else{
					$this->load->model('utils');
					$sede = $this->utils->getSede($u->sede_id);
					$data = [
						'id_usuario'		=> $u->id,
						'usuario'			=> $u->usuario,
						'id_rol'			=> $u->rol_id,
						'id_persona'		=> $u->persona_id,
						'nombres'			=> $u->nombres,
						'apellidos'			=> $u->apellidos,
						'direccion'			=> $u->direccion,
						'email'				=> $u->email,
						'fch_nac'			=> $u->fch_nac,
						'telefono'			=> $u->telefono,
						//'sexo'				=> $u->sexo,
						'sede_id'			=> $u->sede_id,
						'sede'				=> $sede->Descripcion
					];
					echo json_encode(['status'=>200,'data'=>$data,'message'=>'Ingreso satisfactorio']);
					exit();
					//$modulos = $this->usuario->getPermisos($u->rol_id);
					$data['modulos'] = $modulos;
					$this->session->set_userdata('usuario',$data);
						header('Location:  '.base_url($modulos[0]->route));
					dumpvar($data);
					header('Location: '.base_url('admin'));
					echo '<pre>';
					print_r($u);
					echo '</pre>';
					exit();
				}
			}else{
				echo json_encode(['status'=>202,'data'=>'','message'=>'Error en la contraseña']);
				exit();
			}
		}
	}

	public function index(){
		/*$data['content'] = $this->load->view('home/home',[],true);*/
		if($this->input->post()){
			$u = $this->usuario->getUsuario($this->input->post('username'));
			if(is_numeric($u)){
				$this->session->set_flashdata('login_check','Error en los datos ingresados');
				header('Location: '.base_url('admin'));
				echo json_encode(['status'=>200,'data'=>[],'message'=>'Error en los datos ingresados']);
				exit();
			}
			if($u->pass == sha1(md5($this->input->post('password').'Jsilvap'))){
				if($u->estado != 1){
					$this->session->set_flashdata('login_check','Usuario inactivo');
					header('Location: '.base_url('admin'));
					echo json_encode(['status'=>200,'data'=>[],'message'=>'Usuario Inactivo']);
					exit();
				}else{
					$this->load->model('utils');
					$sede = $this->utils->getSede($u->sede_id);
					$data = [
						'id_usuario'		=> $u->id,
						'usuario'			=> $u->usuario,
						'id_rol'			=> $u->rol_id,
						'id_persona'		=> $u->persona_id,
						'nombres'			=> $u->nombres,
						'apellidos'			=> $u->apellidos,
						'direccion'			=> $u->direccion,
						'email'				=> $u->email,
						'fch_nac'			=> $u->fch_nac,
						'telefono'			=> $u->telefono,
						//'sexo'				=> $u->sexo,
						'sede_id'			=> $u->sede_id,
						'sede'				=> $sede->Descripcion
					];
					$modulos = $this->usuario->getPermisos($u->rol_id);
					$data['modulos'] = $modulos;
					$this->session->set_userdata('usuario',$data);
						header('Location:  '.base_url($modulos[0]->route));
					dumpvar($data);
					header('Location: '.base_url('admin'));
					echo '<pre>';
					print_r($u);
					echo '</pre>';
					exit();
				}
			}
			else{
				$this->session->set_flashdata('login_check','Error en los datos ingresados');
				header('Location: '.base_url('admin'));
				echo json_encode(['status'=>200,'data','message'=>'Error en los datos ingresados']);
				exit();
			}
		}
		if($this->session->userdata('usuario')){
			$data['parameters'] = $this->parameters;
			$data['usuario'] = $this->session->userdata('usuario');
			$data['content'] = $this->load->view('admin/dashboard',$data,true);
			$data['module'] = 'Dashboard';
			$this->load->view('body',$data);
		}
		else{
			$data['parameters'] = $this->parameters;
			$this->load->view('admin/login',$data);
		}
	}

	public function newCliente(){
		if(!$this->input->post())
			header('Location: '.base_url());
		$usuario = $this->session->userdata('usuario');
		if($this->input->post('cod_doc') == '01')
			$data_cliente = [
				'razon_social'				=> $this->input->post('razon'),
				'nombre_comercial'			=> $this->input->post('nombre'),
				'telefono1'					=> $this->input->post('telefono1'),
				'telefono2'					=> $this->input->post('telefono2'),
				'id_dis'					=> $this->input->post('distrito'),
				'id_prov'					=> $this->input->post('provincia'),
				'id_dep'					=> $this->input->post('departamento'),
				'ubigeo'					=> '111111'
			];
		else
			$data_cliente = [
				'nombres'					=> $this->input->post('nombres'),
				'apellidos'					=> $this->input->post('apellidos'),
				'fch_nac'					=> date('Y-m-d'),
				'telefono'					=> '963852741'
			];
		$data_cliente['direccion'] = $this->input->post('direccion');
		$data_cliente['email'] = $this->input->post('email');
		$data_cliente['estado'] = 1;
		if($this->input->post('cod_doc') == '01')
			$id_cliente = $this->pagos->newEmpresa($data_cliente);
		else{
			$per = $this->persona->searchClienteNameApell($this->input->post('nombres'),$this->input->post('apellidos'));
			if(is_numeric($per))
				$id_cliente = $this->persona->newPersona($data_cliente);
			else
				$id_cliente = $per[0]->id;
			$alumn = $this->alumno->getAlumnoForPersonaId($id_cliente);
			if(is_numeric($alumn)){
				$alumno = [
					'persona_id'		=> $id_cliente,
					'colegio'			=> '',
					'tutor_id'			=> 1,	
					'area_id'			=> $this->input->post('area') ? $this->input->post('area') : 1,
					'ciclo_id'			=> 1,
					'turno_id'			=> 1,
					'estado'			=> 1,
					'sede_id'			=> $usuario['sede_id']
				];
				$id_alumno = $this->persona->newAlumno($alumno);	
			}
		}
		$idenfiticacion = [
			'persona_id'				=> $this->input->post('cod_doc') == '01' ? 1 : $id_cliente,
			'tipo_identificacion_id'	=> $this->input->post('tipodoc'),
			'nroidentificacion'			=> $this->input->post('nrodoc'),
			'empresa_id'				=> $this->input->post('cod_doc') == '01' ? $id_cliente : 1
		];
		$this->persona->newIdentificacion($idenfiticacion);
		$data_cliente['id_cliente'] = $id_cliente;
		$data_cliente['nroidentificacion'] = $this->input->post('nrodoc');
		if($id_cliente)
			echo json_encode(['status'=>200,'data'=>$data_cliente,'message'=>'Registro satisfactorio']);
		else
			echo json_encode(['status'=>202,'data'=>[],'message'=>'Registro satisfactorio']);
	}

	public function autocompletecliente(){
		if(!$this->input->post())
            header('Location: '.base_url());
        //dumpvar($this->input->post(null,true));
        $clientes = [];
        if($this->input->post('cod_doc') == '01'){
	        //$this->load->model('EmpresaModel','emp');
	        if(is_numeric($this->input->post('data')))
	        	$empresas = $this->pagos->searchClienteRuc($this->input->post('data'));
	        else
	        	$empresas = $this->pagos->searchCliente($this->input->post('data'));
	        //recorrido de los clientes
	        if(!is_numeric($empresas))
	        foreach ($empresas as $key => $value) 
	            array_push($clientes, array('value'=>$value->ruc.' - '.$value->razon_social,'data'=>json_encode(array('id'=>$value->id,'ruc'=>$value->ruc,'direccion'=>$value->direccion))));
	    }else{
	    	if(is_numeric($this->input->post('data')))
	        	$personas = $this->persona->searchClienteDni($this->input->post('data'));
	        else
	        	$personas = $this->persona->searchCliente($this->input->post('data'));
	        //$a = array();
	        if(!is_numeric($personas))
	        foreach ($personas as $key => $value) 
	            array_push($clientes, array('value'=>$value->dni.' - '.$value->apellidos.', '.$value->nombres,'data'=>json_encode(array('id'=>$value->id,'dni'=>$value->dni))));
	    }
        //$a = array();
        print json_encode(array('suggestions'=>$clientes));
	}

	public function provincias(){
		if(!$this->input->post())
			header('Location: '.base_url());
		$this->load->model('utils');
		$prov = $this->utils->getProvincias($this->input->post('id_dep'));
		if(is_numeric($prov))
			echo json_encode(['status'=> 202,'data'=>0]);
		else
			echo json_encode(['status'=> 200,'data'=>$prov]);
		exit();
	}

	public function distritos(){
		if(!$this->input->post())
			header('Location: '.base_url());
		$this->load->model('utils');
		$prov = $this->utils->getDistritos($this->input->post('id_prov'));
		if(is_numeric($prov))
			echo json_encode(['status'=> 202,'data'=>0]);
		else
			echo json_encode(['status'=> 200,'data'=>$prov]);
		exit();
	}

	public function searchCatalogo(){
		if(!$this->input->post())
            header('Location: '.base_url());
        //$this->load->model('CatalogoModel','catalogo');
        $res = $this->pagos->searchCatalogo($this->input->post('data'));
        $a = array();
        if(!is_numeric($res))
	        foreach ($res as $key => $value) 
	            array_push($a, array('value'=>$value->nombre,'data'=>json_encode($value)));
        print json_encode(array('suggestions'=>$a));
	}

	public function logout(){
		$this->session->unset_userdata('areas_activas');
		$this->session->unset_userdata('usuario');
		header('Location: '.base_url('admin'));
	}

	public function buscaComprobante(){
		if(!$this->input->post() || !$this->session->userdata('usuario'))
            header('Location: '.base_url());
        $this->load->library('consulta',$this->parameters);
        if($this->input->post('cod_doc') == '01'){
	        $b = $this->consulta->buscaRuc($this->input->post('documento'));
	        if($b){
	        	/*$this->load->model('EmpresaModel','emp');
	        	$this->load->model('UtilsModel','util');*/
	        	$em = $this->pagos->getEmpresaRuc($b['RUC']);
	        	if(is_numeric($em)){
	        		if(isset($b['Telefono']))
	        			$t = explode('/', $b['Telefono']);
	        		else
	        			$t = [0,0];
		        		$dir = explode(' - ', $b['Direccion']);
		        	$direccion = $b['Direccion'];
	        		if($b['Direccion'] != '-'){
		        		$dp = explode(' ', $dir[count($dir)-3]);
		        		$depa = $dp[count($dp)-1];
		        		$d = explode(' ', $dir[0]);
		        		$direccion = substr($dir[0], 0, strlen($dir[0])-strlen($d[count($d)-1]));
					}else{
						$depa = '0123456789';
					}
		        		$dep = $this->utils->getDepartamento(['nombre' => $depa]);
		        		if(!is_numeric($dep)){
		        			$prov = $this->utils->getProvincia(['id_dep'=>$dep->id,'nombre'=>$dep->nombre]);
		        			$dis = $this->utils->getDistrito(['id_prov'=>$prov->id,'nombre'=>$prov->nombre]);
		        		}
		        		else{
		        			$dep = new stdClass();
		        			$prov = new stdClass();
		        			$dis = new stdClass();
		        			$dep->id = 1;
		        			$prov->id = 1;
		        			$dis->id = 1;
		        		}
		        		$data = [
							'nombre_comercial'		=> $b['RazonSocial'],
		        			'razon_social'	=> $b['RazonSocial'],
		        			//'ruc'			=> $b['RUC'],
		        			'direccion'		=> $direccion,
		        			'telefono1'		=> strlen($t[0]) < 4 ? str_replace(' ', '', $t[1]) : str_replace(' ', '', $t[0]),
		        			'telefono2'		=> isset($t[1]) ? str_replace(' ', '', $t[1]) : '',
		        			'email'			=> 'email@email.com',
		        			'id_dis'		=> $dep->id,
		        			'id_prov'		=> $prov->id,
		        			'id_dep'		=> $dep->id,
		        			'estado'		=> 1,
		        			'ubigeo'		=> '000000'
						];
						$id = $this->pagos->newEmpresa($data);
						$d = array(
							'persona_id'				=> 1,
							'tipo_identificacion_id'	=> 4,
							'nroidentificacion'			=> $b['RUC'],
							'empresa_id'				=> $id
						);
						$this->persona->newIdentificacion($d);
						$data['ruc'] = $b['RUC'];
	        	}
	        	else{
	        		$id = $em->id;
		            if(isset($b['Telefono']))
		              $t = explode('/', $b['Telefono']);
		            else
		              $t = [0,0];
	        		$dir = explode(' - ', $b['Direccion']);
	        		if($b['Direccion'] != '-'){
		        		$dp = explode(' ', $dir[count($dir)-3]);
		        		$depa = $dp[count($dp)-1];
		        		$dep = $this->utils->getDepartamento(['nombre' => $depa]);
		        		if(!is_numeric($dep)){
		        			$prov = $this->utils->getProvincia(['id_dep'=>$dep->id,'nombre'=>$dep->nombre]);
		        			$dis = $this->utils->getDistrito(['id_prov'=>$prov->id,'nombre'=>$prov->nombre]);
		        		}
		        	}
		        	else{
	        			$dep = new stdClass();
	        			$prov = new stdClass();
	        			$dis = new stdClass();
	        			$dep->id = 1;
	        			$prov->id = 1;
	        			$dis->id = 1;
	        		}
	        		$dir = explode(' - ', $b['Direccion']);
	        		$direccion = $b['Direccion'];
	        		if($b['Direccion'] != '-'){
		        		$d = explode(' ', $dir[0]);
		        		$direccion = substr($dir[0], 0, strlen($dir[0])-strlen($d[count($d)-1]));
		        	}
	        		$data = [
						'nombre_comercial'		=> $b['RazonSocial'],
	        			'razon_social'	=> $b['RazonSocial'],
	        			//'ruc'			=> $b['RUC'],
	        			'direccion'		=> $direccion,
	        			'telefono1'		=> strlen($t[0]) < 4 ? str_replace(' ', '', $t[1]) : str_replace(' ', '', $t[0]),
	        			'telefono2'		=> isset($t[1]) ? str_replace(' ', '', $t[1]) : '',
	        			'id_dis'		=> $dep->id,
	        			'id_prov'		=> $prov->id,
	        			'id_dep'		=> $dep->id,
	        			'estado'		=> 1	
					];
					$this->pagos->updateEmpresa($data,$id);
					$data['ruc'] = $b['RUC'];
	        	}
	        	echo json_encode([
	        		'status'	=> 200,
	        		'data'		=> $data,
	        		'id'		=> $id,
	        		'message'	=> 'Registro satisfactorio'
	        	]);
	        	exit();
	        }
	    }
        	echo json_encode([
        		'status'	=> 202,
        		'data'		=> 'Datos no encontrados'
        	]);
        exit();
	}

	function getInscripcionesPendientes(){
        
        $num_inscripciones_pendientes = $this->alumno->getCountAlumnos(['estado'=>0]);
        
        echo json_encode($num_inscripciones_pendientes);
            
    }

    function getAlumnosInscritos(){

    	$num_alumnos_inscritos = $this->alumno->getCountAlumnos(['estado'=>1]);

    	echo json_encode($num_alumnos_inscritos);
    }

    function getComprobantesRegistrados(){

    	$num_comprobantes_registrados = $this->pagos->getComprobantes();

    	echo json_encode($num_comprobantes_registrados);

    }

    function getPagosEnCreditos(){

    	$num_pagos_creditos = $this->pagos->getPagos(['Tipo_Pago'=>0]);

    	echo json_encode($num_pagos_creditos);

    }

}