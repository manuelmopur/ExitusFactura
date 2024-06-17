<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caja extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->config->load('parameters',true);
		$this->parameters = $this->config->item('parameters');
		$this->load->model('usuario');
		$this->load->model('alumno');
		$this->load->model('persona');
		$this->load->model('pagos');
		$this->load->model('utils');
		if(!isset($_SESSION['usuario'])){
			header('Location: '.base_url('admin'));
		}
	}

	public function ver($comprobante){
		$param = $this->parameters;
		//$comprobante = $this->input->post('comprobante');
		$c = explode('-', $comprobante);
		$this->session->set_userdata('items',[]);
		$comprobante = $this->pagos->getComprobante($c[0],$c[1]);
		if(is_numeric($comprobante))
			header('Location: '.base_url('admin'));
		if($comprobante->empresa_id != 1){
			$cliente = $this->pagos->getCliente($comprobante->empresa_id);
		}else{
			$cliente = $this->persona->getPersonaForId($comprobante->persona_id);
		}
		$items = $this->pagos->getDetallesComprobante($c[0],$c[1]);
		//dumpvar($items);
        $data['parameters'] = $this->parameters;
        $data['comprobante'] = $comprobante;
        $data['items'] = $items;
        $data['cliente'] = $cliente;
		$data['content'] = $this->load->view('admin/caja/vercomprobante',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Caja';
		$this->load->view('body',$data);
	}

	public function index(){
		if(!$this->session->userdata('usuario'))
			header('Location: '.base_url('admin'));
		$u = $this->session->userdata('usuario');
		$data['parameters'] = $this->parameters;
		$data['perfil'] = $u['id_rol'];
		$data['host'] = $_SERVER['HTTP_HOST'];
		//dumpvar($data['medidas']);
		$data['content'] = $this->load->view('admin/caja/index',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Caja';
		$this->load->view('body',$data);
	}

	public function buscadocdep(){
		if(!$this->input->post())
            header('Location: '.base_url());
        $this->load->model('UtilsModel','utils');
		$dep = $this->utils->getDepartamentos();
		$docs = $this->utils->getTiposDocumento();
		$areas = $this->persona->getArea();
		echo json_encode(['status'=>200,'data'=>['departamentos'=>$dep,'documentos'=>$docs,'areas'=>$areas]]);
	}

	public function emisionprevia(){
		$data['parameters'] = $this->parameters;
		//$data['medidas'] = $this->utils->getMedidas();
		$data['data_comprobante'] = $this->session->userdata('genera_comprobante');
		$data['items'] = $this->session->userdata('items') ? $this->session->userdata('items') : [];
		//dumpvar($data['ites']);
		$data['content'] = $this->load->view('admin/caja/previo',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Caja';
		$this->load->view('body',$data);
	}

	public function emitir(){
		if($this->input->post()){
			if($this->input->post('id_cliente') == 0){
				$this->session->set_flashdata('datos_ingresado','Ingrese un cliente valido, asegurese de estar registrado');
				header('Location: '.base_url('caja/emitir'));
			}
			$this->session->set_userdata('genera_comprobante',$this->input->post(null,true));
			header('Location: '.base_url('caja/emisionprevia'));
		}
		$data['parameters'] = $this->parameters;
		$data['medidas'] = $this->utils->getMedidas();
		$data['host'] = $_SERVER['HTTP_HOST'];
		//dumpvar($data['medidas']);
		$data['items'] = $this->session->userdata('items') ? $this->session->userdata('items') : [];
		$data['content'] = $this->load->view('admin/caja/emitir',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Caja';
		$this->load->view('body',$data);
	}
	public function emitirConAlumno($id_alumno){
		if($this->input->post()){
			$this->session->set_userdata('genera_comprobante',$this->input->post(null,true));
			header('Location: '.base_url('caja/emisionprevia'));
		}
		$data['parameters'] = $this->parameters;
		$data['medidas'] = $this->utils->getMedidas();
		$alumno = $this->alumno->getAlumnoPre($id_alumno);
		$data['alumno'] = $alumno;
		//dumpvar($data['medidas']);
		$data['items'] = $this->session->userdata('items') ? $this->session->userdata('items') : [];
		$data['content'] = $this->load->view('admin/caja/emitir',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Caja';
		$this->load->view('body',$data);
	}

	public function consultaReporte(){
		if(!$this->input->post()){
			header('Location: '.base_url());
		}
		$usuario = $this->session->userdata('usuario');
		if($this->input->post('desde')!= ''){
			$d = date('Y-m-d',strtotime(date($this->input->post('desde'))));
			$h = date('Y-m-d', strtotime(date($this->input->post('hasta'))."+ 1 days"));;
			$where = "tv.fecha BETWEEN '".$d."' and '".$h."'";
		}
		else
			$where = "tv.fecha > '".date('Y-m-d')."'";
		//dumpvar($usuario);
		if($this->input->post('provisional') != 1){
			if($usuario['id_rol'] == 1 || $usuario['id_rol'] == 3){
				$boletas = $this->pagos->getComprobanteBoletasUsuario(0,$where);
				$facturas = $this->pagos->getComprobanteFacturasUsuario(0,$where);
			}else{
				$boletas = $this->pagos->getComprobanteBoletasUsuario($usuario['id_usuario'],$where);
				$facturas = $this->pagos->getComprobanteFacturasUsuario($usuario['id_usuario'],$where);
			}
		}else{
			$boletas = [];
			$facturas = [];
		}
			if($this->input->post('provisional') == 1){
				$provisional = $this->pagos->getComprobanteProvisionalUsuario(0,$where);
				foreach ($provisional as $key => $value) {
					$al = $this->alumno->getAlumnoPersona($value->persona_id);

					if(!is_numeric($al)){
						$provisional[$key]->cliente = $al->persona;
						$provisional[$key]->area = $al->area;
					}else{
						$provisional[$key]->cliente = ' ';
						//dumpvar($al);
					}
					$u = $this->usuario->getUsuarioForId($value->usuario_id);
					if(!is_numeric($u))
						$provisional[$key]->usuario = $u->usuario;
				}
				$boletas = array_merge(is_numeric($boletas) ? [] : $boletas, is_numeric($provisional) ? [] : $provisional);
			}
			$comprobantes = array_merge(is_numeric($boletas) ? [] : $boletas,is_numeric($facturas) ? [] : $facturas);
			$contBoletas = is_numeric($boletas) ? 0 : count($boletas);
			$contFacturas = is_numeric($facturas) ? 0 : count($facturas);
		if(is_numeric($comprobantes))
			echo json_encode(['status'=>202,'data'=>[],'message'=>'No se encontraron registros']);
		else
			echo json_encode(['status'=>200,'data'=>['comprobantes'=>$comprobantes,'total_boletas'=>$contBoletas,'total_facturas'=>$contFacturas],'message'=>'Registros encontrados']);
	}

	public function consultaComprobante(){
		if(!$this->input->post()){
			header('Location: '.base_url());
		}
		$usuario = $this->session->userdata('usuario');
		if($this->input->post('desde')!= ''){
			$d = date('Y-m-d',strtotime(date($this->input->post('desde'))));
			$h = date('Y-m-d', strtotime(date($this->input->post('hasta'))."+ 1 days"));
			$where = "tv.fecha BETWEEN '".$d."' and '".$h."'";
		}
		else
			$where = "tv.fecha > '".date('Y-m-d')."'";
		if($this->input->post('cod_doc') == '03')
			$comprobantes = $this->pagos->getComprobanteBoletas(0,$where);
		if($this->input->post('cod_doc') == '01')
			$comprobantes = $this->pagos->getComprobanteFacturas(0,$where);
		if($this->input->post('cod_doc') == '99'){
			$comprobantes = $this->pagos->getComprobanteProvisionalUsuario(0,$where);
			foreach ($comprobantes as $key => $value) {
				$al = $this->persona->getPersonaForId2($value->persona_id);
				//dumpvar($al);
				if(!is_numeric($al)){
					$comprobantes[$key]->cliente = $al->apellidos.' '.$al->nombres;
					$comprobantes[$key]->area = '';
				}else{
					$comprobantes[$key]->cliente = ' ';
				}
				$u = $this->usuario->getUsuarioForId($value->usuario_id);
				if(!is_numeric($u))
					$comprobantes[$key]->usuario = $u->usuario;
			}
		}
		if(is_numeric($comprobantes))
			echo json_encode(['status'=>202,'data'=>[],'message'=>'No se encontraron registros']);
		else
			echo json_encode(['status'=>200,'data'=>$comprobantes,'message'=>'Registros encontrados']);
	}

	public function consultaNota(){
		if(!$this->input->post()){
			header('Location: '.base_url());
		}
		$usuario = $this->session->userdata('usuario');
		if($this->input->post('desde')!= ''){
			$d = date('Y-m-d',strtotime(date($this->input->post('desde'))));
			$h = date('Y-m-d', strtotime(date($this->input->post('hasta'))."+ 1 days"));;
			$where = "tn.cancelado BETWEEN '".$d."' and '".$h."'";
		}
		else
			$where = "tn.cancelado > '".date('Y-m-d')."'";
		if($this->input->post('cod_doc') == '07')
			$comprobantes = $this->pagos->getNotasCredito(0,$where);
		//else
			//$comprobantes = $this->pagos->getComprobanteFacturas(0,$where);
		//dumpvar($comprobantes);
		if(is_numeric($comprobantes))
			echo json_encode(['status'=>202,'data'=>[],'message'=>'No se encontraron registros']);
		else
			echo json_encode(['status'=>200,'data'=>$comprobantes,'message'=>'Registros encontrados']);

		
	}


	public function enviar(){
		if(!$this->input->post()){
			header('Location: '.base_url());
		}
		$param = $this->parameters;
		$this->load->library('sunat',$param);
		//$this->load->model('VentaModel','ven');

		$comp = explode('-', $this->input->post('comprobante'));
		if(count($comp) != 2){
			header('Location: '.base_url());
		}
		$comprobante = $this->pagos->getComprobante($comp[0],$comp[1]);
		if(is_numeric($comprobante)){
			return json_encode(['status'=>202,'data'=>[],'message'=>'Error al cargar comprobante']);
		}

		switch ($comprobante->cod_doc) {
			case '01': {
				$r = 'facturas';
			}
				# code...
				break;
			case '03': {
				$r = 'boletas';
			}
				# code...
				break;
			
			default:
				# code...
				break;
		}
		$fecha = substr($comprobante->fecha, 0, 10);

		$filename = $param['ruc'].'-'.$comprobante->cod_doc.'-'.$this->input->post('comprobante');
		$dir = BASEPATH.'../archivos/'.$r.'/'.substr($fecha,0,10).'/';
		$status = $this->sunat->envia($filename,$dir);
		if($status['status'] == 200){
			$c = explode('-', $this->input->post('comprobante'));
			$this->pagos->updateVenta(['estado'=>2],['num_serie'=>$c[0],'num_documento'=>$c[1]]);
		}
		echo json_encode($status);
	}

	public function xml($serie = ''){
		if(!$this->session->userdata('usuario'))
			header('Location: '.base_url());
		//$this->load->model('VentaModel','ven');
		$param = $this->parameters;
		//$comprobante = $this->input->post('comprobante');
		$c = explode('-', $serie);
		$con = $this->pagos->getComprobante($c[0],$c[1]);
		if(is_numeric($con))
			$con = $this->ven->getNota($c[0],$c[1]);
		header('Content-Type: application/xml; charset=utf-8');
		$zip = new ZipArchive;
		if($con->cod_doc == '01'){
			$r = 'facturas';
			$cod = '01';
			$fecha = $con->fecha;
		}
		if($con->cod_doc == '14'){
			$r = 'facturasc';
			$cod = '01';
			$fecha = $con->fecha;
		}
		if($con->cod_doc == '03'){
			$r = 'boletas';
			$cod = '03';
			$fecha = $con->fecha;
		}
		if($con->cod_doc == '07'){
			$r = 'notas';
			$cod = '07';
			$fecha = $con->cancelado;
		}
		if(file_exists(BASEPATH.'../archivos/'.$r.'/'.substr($fecha,0,10).'/'.$param['ruc'].'-'.$cod.'-'.$serie.'.xml')){
			echo file_get_contents(BASEPATH.'../archivos/'.$r.'/'.substr($fecha,0,10).'/'.$param['ruc'].'-'.$cod.'-'.$serie.'.xml');
			exit();
		}
		$res = $zip->open(BASEPATH.'../archivos/'.$r.'/'.substr($fecha,0,10).'/'.$param['ruc'].'-'.$cod.'-'.$serie.'.zip');
		if ($res === TRUE) {
		    $zip->extractTo(BASEPATH.'../archivos/'.$r.'/'.substr($fecha,0,10).'/');
		    $zip->close();
		    //echo 'ok';
		} else {
		    //echo 'failed';
		}
		echo file_get_contents(BASEPATH.'../archivos/'.$r.'/'.substr($fecha,0,10).'/'.$param['ruc'].'-'.$cod.'-'.$serie.'.xml');
	}

	public function respuesta($serie = ''){
		if(!$this->session->userdata('usuario'))
			header('Location: '.base_url());
		//$this->load->model('VentaModel','ven');
		$param = $this->parameters;
		//$comprobante = $this->input->post('comprobante');
		$c = explode('-', $serie);
		$con = $this->pagos->getComprobante($c[0],$c[1]);
		if(is_numeric($con))
			$con = $this->ven->getNota($c[0],$c[1]);
		header('Content-Type: application/xml; charset=utf-8');
		$zip = new ZipArchive;
		if($con->cod_doc == '01'){
			$r = 'facturas';
			$cod = '01';
			$fecha = $con->fecha;
		}
		if($con->cod_doc == '14'){
			$r = 'facturasc';
			$cod = '01';
			$fecha = $con->fecha;
		}
		if($con->cod_doc == '03'){
			$r = 'boletas';
			$cod = '03';
			$fecha = $con->fecha;
		}
		if($con->cod_doc == '07'){
			$r = 'notas';
			$cod = '07';
			$fecha = $con->cancelado;
		}
		if(file_exists(BASEPATH.'../archivos/'.$r.'/'.substr($fecha,0,10).'/R-'.$param['ruc'].'-'.$cod.'-'.$serie.'.xml')){
			echo file_get_contents(BASEPATH.'../archivos/'.$r.'/'.substr($fecha,0,10).'/R-'.$param['ruc'].'-'.$cod.'-'.$serie.'.xml');
			exit();
		}
		$res = $zip->open(BASEPATH.'../archivos/'.$r.'/'.substr($fecha,0,10).'/R-'.$param['ruc'].'-'.$cod.'-'.$serie.'.zip');
		if ($res === TRUE) {
		    $zip->extractTo(BASEPATH.'../archivos/'.$r.'/'.substr($fecha,0,10).'/');
		    $zip->close();
		    //echo 'ok';
		} else {
		    //echo 'failed';
		}
		echo file_get_contents(BASEPATH.'../archivos/'.$r.'/'.substr($fecha,0,10).'/R-'.$param['ruc'].'-'.$cod.'-'.$serie.'.xml');
	}

	public function generacomprobante(){
		if(!$this->input->post()){
			header('Location: '.base_url());
		}
		$data = $this->session->userdata('genera_comprobante');
		try{
			$data_comprobante = [
				'cod_doc'						=> $data['cod_doc'],
				'efectivo'						=> number_format($data['total'],2,'.',''),
				'fecha'							=> date('Y-m-d H:i:s'),
				'usuario_id'					=> $this->session->userdata('usuario')['id_usuario'],
				'persona_id'					=> $data['cod_doc'] != '01' ? $data['id_cliente'] : 1,
				'empresa_id'					=> $data['cod_doc'] == '01' ? $data['id_cliente'] : 1,
				'descuento'						=> 0,
				'total'							=> $data['total'],
				'moneda'						=> 'PEN',
				'estado'						=> 1
			];
			$comprobante = $this->pagos->newVenta($data_comprobante);
			$this->pagos->updateVenta(['observacion'=> $data['observacion']],['num_serie'=>$comprobante->num_serie,'num_documento'=>$comprobante->num_documento]);
				$data_comprobante['totaligv_afecto'] = 0;
				$data_comprobante['totalsafecto'] = 0;
				$data_comprobante['totalsinafecto'] = 0;
				$data_comprobante['totalsexonerado'] = 0.00;
				$items = [];
			foreach ($this->session->userdata('items') as $key => $value) {
				if(!is_numeric($value['id'])){
					$d = [
						'descripcion'			=> mb_strtoupper($value['nombre']),
						'cod_catalogo'			=> $value['codigo_catalogo'],
						'tipo'					=> $value['tipo'],
						'stock'					=> 0,
						'estado'				=> 1,
						'medida_id'				=> $value['id_medida']
					];
					if($data['cod_doc'] == '99')
						$id = $this->pagos->newItemProvisional($d);
					else
						$id = $this->pagos->newItems($d);
					$value['id'] = $id;
					$tar = [
						'id_empresa'			=> 1,
						'precio'				=> $value['precioventa'],
						'descuento'				=> 0,
						'moneda'				=> 1,
						'iditem'				=> $value['id'],
						'estado'				=> 1
					];
					if($data['cod_doc'] == '99')
						$this->pagos->newTarifaProvisional($tar);
					else
						$this->pagos->newTarifa($tar);
				}else{
					if($data['cod_doc'] == '99'){
						$d = [
							'descripcion'			=> mb_strtoupper($value['nombre']),
							'cod_catalogo'			=> $value['codigo_catalogo'],
							'tipo'					=> $value['tipo'],
							'stock'					=> 0,
							'estado'				=> 1,
							'medida_id'				=> $value['id_medida']
						];
						$id = $this->pagos->newItemProvisional($d);
						$value['id'] = $id;
						$tar = [
							'id_empresa'			=> 1,
							'precio'				=> $value['precioventa'],
							'descuento'				=> 0,
							'moneda'				=> 1,
							'iditem'				=> $value['id'],
							'estado'				=> 1
						];
						$this->pagos->newTarifaProvisional($tar);
					}
				}
				//$data['totaldesc'] += ($value['cantidad']*$value['precioventa']/1.18)*$value['descuento']/100;
				$t = ($value['cantidad']*$value['precioventa'])-$value['cantidad']*$value['precioventa']*$value['descuento']/100;
				//$data['totalsini'] += $value['cantidad']*$value['precioventa'];
				$d = array(
					'num_serie'						=> $comprobante->num_serie,
					'num_documento'					=> $comprobante->num_documento,
					'cod_doc'						=> $data['cod_doc'],
					'id_item'						=> $value['id'],
					'cantidad'						=> $value['cantidad'],
					'precio'						=> number_format($value['precioventa'],4,'.',''),
					'descuento'						=> 0,
					'tipo_igv'						=> $value['tipoigv'],
					'id_medida'						=> $value['id_medida'],
					'cod_catalogo'					=> $value['codigo_catalogo']
				);
				switch ($value['tipoigv']) {
					case 1:
						$data_comprobante['totaligv_afecto'] += $t - $t/1.18;
						$data_comprobante['totalsafecto'] += $t/1.18;
						break;

					case 2:
						$data_comprobante['totalsinafecto'] += $t;
						break;

					case 3:
						$data_comprobante['totalsexonerado'] += $t;
						break;
					
					default:
						# code...
						break;
				}
				$this->pagos->newDetalleVenta($d);
				$d['precioventa'] = number_format($value['precioventa'],4,'.','');
				$d['igv'] = number_format(0,4,'.','');
				$med = $this->utils->getMedida($d['id_medida']);
				$d['codigo'] = $med->codigo;
				$d['nombre'] = $value['nombre'];
				$d['tipo_igv'] = $value['tipoigv'];
				$d['medida'] = $value['medida'];
				array_push($items, $d);
			}
			/*$data_detalle['precioventa'] = $data['total'];
				$data_detalle['igv'] = 0;
				$data_detalle['codigo'] = 'ZZ';
				$data_detalle['nombre']  = $data_item['descripcion'];*/
				//calculos
				$tl = $data['total'];
				$data_comprobante['num_serie'] = $comprobante->num_serie;
				$data_comprobante['num_documento'] = $comprobante->num_documento;
				$cliente = explode(' - ', $data['cliente']);
					$data_comprobante['nroidentificacion'] = $cliente[0];
					$data_comprobante['nombrecliente'] = $cliente[1];
				if($data['cod_doc'] == '01'){
					$cliente = $this->pagos->getCliente($this->input->post('persona_id'));
					$data_comprobante['cliente'] = $cliente;
				}
				/*if($this->input->post('comprobante') == '03'){
				}else{
					$data_comprobante['nroidentificacion'] = $cliente->nroidentificacion;
					$data_comprobante['nombrecliente'] = $cliente->razon_social;
				}*/
				if($data['cod_doc'] != '99'){
					$this->load->library('greenter',$this->parameters);
					$this->greenter->setData($data_comprobante);
					$this->greenter->setItems($items);
					$this->greenter->legenda($data);
					$datos = $this->greenter->preparaXML('boletas',substr($data_comprobante['fecha'],0,10));
					$this->load->library('barcode2');
					$this->barcode2->setData($this->parameters['ruc'].'|'.$data_comprobante['cod_doc'].'|'.$comprobante->num_serie.'|'.$comprobante->num_documento.'|'.number_format($data_comprobante['total']-$data_comprobante['total']/1.18,2).'|'.number_format($data_comprobante['total'],2).'|'.date('d/m/Y').'|06||'.$datos['DigestValue'].'|'.$datos['SignatureValue']);
					$a = $this->barcode2->getgd();
					file_put_contents('./barcodes/'.substr($data_comprobante['fecha'],0,10).$comprobante->num_serie.'-'.$comprobante->num_documento.'.png', $a);
					$this->pagos->updatePago([
						'Boleta_Inicial'=> $comprobante->num_serie.'-'.$comprobante->num_documento,
						'Estado'		=> 1
					],[
						'id'			=> $this->input->post('pago_id')
					]);
				}
				$this->session->set_userdata('items',[]);
				/*
				$cuotas_deuda = $this->pagos->getCuotasDeuda($cuota->Pagos_id);
				if(is_numeric($cuotas_deuda)){
					$this->pagos->updateCredito($cuota->Pagos_id);
				}*/
				//$this->load->library('')
				echo json_encode(['status'=>200,'data'=>[
					'num_serie'			=> $comprobante->num_serie,
					'num_documento'		=> $comprobante->num_documento,
					'fecha'				=> date('d/m/Y',strtotime(substr($data_comprobante['fecha'], 0, 10))),
					'cod_doc'			=> $data_comprobante['cod_doc'],
					'imagen'			=> substr($data_comprobante['fecha'],0,10).$comprobante->num_serie.'-'.$comprobante->num_documento.'.png',
					'data_comp'			=> $data_comprobante
				],'message'=>'Emisión satisfactoria']);
				exit();
		}catch(Exception $e){}
	}

	public function emitecomprobante(){
		if(!$this->input->post()){
			header('Location: '.base_url());
		}
		$alumno = $this->alumno->getAlumno($this->input->post('alumno_id'));
		try{
				$data_comprobante = [
					'cod_doc'						=> $this->input->post('comprobante'),
					'efectivo'						=> number_format($this->input->post('efectivo'),2,'.',''),
					'fecha'							=> date('Y-m-d H:i:s'),
					'usuario_id'					=> $this->session->userdata('usuario')['id_usuario'],
					'persona_id'					=> $this->input->post('persona_id'),
					'empresa_id'					=> $this->input->post('empresa_id'),
					'descuento'						=> number_format($this->input->post('descuento') ? $this->input->post('descuento') : 0,2,'.',''),
					'total'							=> $this->input->post('total'),
					'moneda'						=> 'PEN',
					'estado'						=> 1
				];
				$comprobante = $this->pagos->newVenta($data_comprobante);
				$data_item = [
					'descripcion'					=> $this->input->post('concepto'),
					'cod_catalogo'					=> '86131801',
					'tipo'							=> 2,
					'stock'							=> 0,
					'estado'						=> 0,
					'medida_id'						=> 16
				];
				$id_item = $this->pagos->newItems($data_item);
				$data_detalle = [
					'num_serie'						=> $comprobante->num_serie,
					'num_documento'					=> $comprobante->num_documento,
					'cod_doc'						=> $this->input->post('comprobante'),
					'id_item'						=> $id_item,
					'cantidad'						=> 1,
					'precio'						=> $this->input->post('total'),
					'descuento'						=> 0,
					'tipo_igv'						=> 2,
					'id_medida'						=> 16,
					'cod_catalogo'					=> '86131801'
				];
				$this->pagos->newDetalleVenta($data_detalle);
				$data_detalle['precioventa'] = $this->input->post('total');
				$data_detalle['igv'] = 0;
				$data_detalle['codigo'] = 'ZZ';
				$data_detalle['nombre']  = $data_item['descripcion'];
				//calculos
				$tl = $this->input->post('total')-$data_comprobante['descuento'];
				$data_comprobante['totaligv_afecto'] = number_format($tl - $tl/1.18,2,'.','');
				$data_comprobante['totalsafecto'] = number_format($tl,2,'.','');
				$data_comprobante['totalsexonerado'] = 0.00;
				$data_comprobante['num_serie'] = $comprobante->num_serie;
				$data_comprobante['num_documento'] = $comprobante->num_documento;
				if($this->input->post('comprobante') == '03'){
					$data_comprobante['nroidentificacion'] = $alumno->nroidentificacion;
					$data_comprobante['nombrecliente'] = $alumno->nombres.' '.$alumno->apellidos;
				}else{
					$cliente = $this->pagos->getCliente($this->input->post('empresa_id'));
					$data_comprobante['nroidentificacion'] = $cliente->nroidentificacion;
					$data_comprobante['nombrecliente'] = $cliente->razon_social;
					$data_comprobante['cliente'] = $cliente;
				}
				$this->load->library('greenter',$this->parameters);
				$this->greenter->setData($data_comprobante);
				$this->greenter->setItems([$data_detalle]);
				$this->greenter->legenda($data_comprobante);
				$datos = $this->greenter->preparaXML($this->input->post('comprobante') == '03' ? 'boletas' : 'facturas',substr($data_comprobante['fecha'],0,10));
				$this->load->library('barcode2');
				$this->barcode2->setData($this->parameters['ruc'].'|'.$data_comprobante['cod_doc'].'|'.$comprobante->num_serie.'|'.$comprobante->num_documento.'|'.number_format($data_comprobante['total']-$data_comprobante['total']/1.18,2).'|'.number_format($data_comprobante['total'],2).'|'.date('d/m/Y').'|06||'.$datos['DigestValue'].'|'.$datos['SignatureValue']);
				$a = $this->barcode2->getgd();
				file_put_contents('./barcodes/'.substr($data_comprobante['fecha'],0,10).$comprobante->num_serie.'-'.$comprobante->num_documento.'.png', $a);
				$this->pagos->updatePago([
					'Boleta_Inicial'=> $comprobante->num_serie.'-'.$comprobante->num_documento,
					'Estado'		=> 1
				],[
					'id'			=> $this->input->post('pago_id')
				]);
				/*
				$cuotas_deuda = $this->pagos->getCuotasDeuda($cuota->Pagos_id);
				if(is_numeric($cuotas_deuda)){
					$this->pagos->updateCredito($cuota->Pagos_id);
				}*/
				//$this->load->library('')
				echo json_encode(['status'=>200,'data'=>[
					'num_serie'			=> $comprobante->num_serie,
					'num_documento'		=> $comprobante->num_documento,
					'fecha'				=> date('d/m/Y',strtotime(substr($data_comprobante['fecha'], 0, 10))),
					'cod_doc'			=> $data_comprobante['cod_doc'],
					'imagen'			=> substr($data_comprobante['fecha'],0,10).$comprobante->num_serie.'-'.$comprobante->num_documento.'.png',
					'data_comp'			=> $data_comprobante
				],'message'=>'Emisión satisfactoria']);
				exit();
				echo '<img style="margin-top: 10px;" src="'.base_url('barcodes/'.substr($data_comprobante['fecha'], 0, 10).$comprobante->num_serie.'-'.$comprobante->num_documento.'.png').'" width="450"  height="150">';
				exit();
			}catch(Exception $e){
				echo json_encode(['status'=>202,'data'=>[],'message'=>'Error en la emisión de comprobante consulte con su administrador']);
				exit();
			}
	}

	public function pagarcuota($id = 0,$nro = 0){
		if($id == 0){
			header('Location: '.base_url());
		}
		$cuota = $this->pagos->getCuotaDetalle($id);
		if(is_numeric($cuota)) header('Location: '.base_url());
		$pago  = $this->pagos->getPagoDetalle($cuota->Pagos_id);
		$alumno = $this->alumno->getAlumno($pago->Alumno_id);
		/*echo '<pre>';
		print_r($pago);
		print_r($alumno);
		echo '</pre>';
		exit();*/
		if($this->input->post()){
			try{
				$data_comprobante = [
					'cod_doc'						=> $this->input->post('comprobante'),
					'efectivo'						=> $this->input->post('efectivo'),
					'fecha'							=> $this->input->post('fecha'),
					'usuario_id'					=> $this->session->userdata('usuario')['id_usuario'],
					'persona_id'					=> $this->input->post('persona_id'),
					'empresa_id'					=> $this->input->post('empresa_id'),
					'descuento'						=> number_format($this->input->post('descuento') ? $this->input->post('descuento') : 0,2,'.',''),
					'total'							=> $this->input->post('total'),
					'moneda'						=> 'PEN',
					'estado'						=> 1
				];
				$comprobante = $this->pagos->newVenta($data_comprobante);
				$data_item = [
					'descripcion'					=> 'Cuota N° '.$nro.' por enseñanza en '.$alumno->area.', Turno '.$alumno->turno,
					'cod_catalogo'					=> '86131801',
					'tipo'							=> 2,
					'stock'							=> 0,
					'estado'						=> 0,
					'medida_id'						=> 16
				];
				if($this->input->post('comprobante') == '99')
					$id_item = $this->pagos->newItemProvisional($data_item);
				else
					$id_item = $this->pagos->newItems($data_item);
				$data_detalle = [
					'num_serie'						=> $comprobante->num_serie,
					'num_documento'					=> $comprobante->num_documento,
					'cod_doc'						=> $this->input->post('comprobante'),
					'id_item'						=> $id_item,
					'cantidad'						=> 1,
					'precio'						=> $cuota->Monto,
					'descuento'						=> 0,
					'tipo_igv'						=> 1,
					'id_medida'						=> 16,
					'cod_catalogo'					=> '86131801'
				];
				$this->pagos->newDetalleVenta($data_detalle);
				$data_detalle['precioventa'] = $cuota->Monto;
				$data_detalle['igv'] = $cuota->Monto-$cuota->Monto/1.18;
				$data_detalle['codigo'] = 'ZZ';
				$data_detalle['nombre']  = $data_item['descripcion'];
				//calculos
				$tl = $this->input->post('total')-$data_comprobante['descuento'];
				$data_comprobante['totaligv_afecto'] = number_format($tl - $tl/1.18,2,'.','');
				$data_comprobante['totalsafecto'] = number_format($tl,2,'.','');
				$data_comprobante['totalsexonerado'] = 0.00;
				$data_comprobante['num_serie'] = $comprobante->num_serie;
				$data_comprobante['num_documento'] = $comprobante->num_documento;
				if($this->input->post('comprobante') == '03' || $this->input->post('comprobante') == '99'){
					$data_comprobante['nroidentificacion'] = $alumno->nroidentificacion;
					$data_comprobante['nombrecliente'] = $alumno->nombres.' '.$alumno->apellidos;
				}else{
					$cliente = $this->pagos->getCliente($this->input->post('empresa_id'));
					$data_comprobante['nroidentificacion'] = $cliente->nroidentificacion;
					$data_comprobante['nombrecliente'] = $cliente->razon_social;
					$data_comprobante['cliente'] = $cliente;
				}

				//DESDE AQUI 
				if($data_comprobante['cod_doc'] != '99'){
					$this->load->library('greenter',$this->parameters);
					$this->greenter->setData($data_comprobante);
					$this->greenter->setItems([$data_detalle]);
					$this->greenter->legenda($data_comprobante);
					$datos = $this->greenter->preparaXML($this->input->post('comprobante') == '03' ? 'boletas' : 'facturas',substr($data_comprobante['fecha'],0,10));
					$this->load->library('barcode2');
					$this->barcode2->setData($this->parameters['ruc'].'|'.$data_comprobante['cod_doc'].'|'.$comprobante->num_serie.'|'.$comprobante->num_documento.'|'.number_format($data_comprobante['total']-$data_comprobante['total']/1.18,2).'|'.number_format($data_comprobante['total'],2).'|'.date('d/m/Y').'|06||'.$datos['DigestValue'].'|'.$datos['SignatureValue']);
					$a = $this->barcode2->getgd();
					file_put_contents('./barcodes/'.substr($data_comprobante['fecha'],0,10).$comprobante->num_serie.'-'.$comprobante->num_documento.'.png', $a);
					$this->pagos->updateCuota([
						'Fecha_Pago'	=> date('Y-m-d'),
						'Boleta'		=> $comprobante->num_serie.'-'.$comprobante->num_documento,
						'Estado'		=> 1
					],[
						'id'			=> $id
					]);			
				}
				else{//si es comprobante provisional no agrega boleta y agrega en backup tventa el id_cuota
					$this->pagos->updateCuota([
						'Fecha_Pago'	=> date('Y-m-d'),
						'Estado'		=> 1
					],[
						'id'			=> $id
					]);

					$this->pagos->updateVentaProvisional([						
						'cuota_id'		=> $id
					],[
						'num_serie'						=> $comprobante->num_serie,
						'num_documento'					=> $comprobante->num_documento
					]);
				}
				$cuotas_deuda = $this->pagos->getCuotasDeuda($cuota->Pagos_id);
				if(is_numeric($cuotas_deuda)){
						$this->pagos->updateCredito($cuota->Pagos_id);
				}
				//HASTA AQUI CHINGA SU MADRE

				//$this->load->library('')
				echo json_encode(['status'=>200,'data'=>[
					'num_serie'			=> $comprobante->num_serie,
					'num_documento'		=> $comprobante->num_documento,
					'fecha'				=> date('d/m/Y',strtotime(substr($data_comprobante['fecha'], 0, 10))),
					'cod_doc'			=> $data_comprobante['cod_doc'],
					'imagen'			=> substr($data_comprobante['fecha'],0,10).$comprobante->num_serie.'-'.$comprobante->num_documento.'.png',
					'data_comp'			=> $data_comprobante
				],'message'=>'Emisión satisfactoria']);
				exit();
				echo '<img style="margin-top: 10px;" src="'.base_url('barcodes/'.substr($data_comprobante['fecha'], 0, 10).$comprobante->num_serie.'-'.$comprobante->num_documento.'.png').'" width="450"  height="150">';
				exit();
			}catch(Exception $e){
				echo json_encode(['status'=>202,'data'=>[],'message'=>'Error en la emisión de comprobante consulte con su administrador']);
				exit();
			}
		}
		$data['parameters'] = $this->parameters;
		$data['alumno'] = $alumno;
		$data['pago'] = $pago;
		$data['cuota'] = $cuota;
		$data['nro'] = $nro;
		$data['host'] = $_SERVER['HTTP_HOST'];
		//dumpvar($data['alumnos']);
		$data['content'] = $this->load->view('admin/caja/emision',$data,true);
		$data['usuario'] = $this->session->userdata('usuario');
		$data['module'] = 'Caja';
		$this->load->view('body',$data);
	}

	public function consultaRuc(){
		if(!$this->input->post())
			header('Location: '.base_url());
		$this->load->library('consulta',['url_api'=>$this->parameters['url_api'],'header_api'=>$this->parameters['header_api']]);
		$datos = $this->consulta->buscaRuc($this->input->post('ruc'));
		if($datos){
			$em = $this->pagos->getEmpresaRuc($this->input->post('ruc'));
        	if(is_numeric($em)){
        		if(isset($datos['Telefono']))
        			$t = explode('/', $datos['Telefono']);
        		else
        			$t = [0,0];
	        		$dir = explode(' - ', $datos['Direccion']);
	        	$direccion = $datos['Direccion'];
        		if($datos['Direccion'] != '-'){
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
						'nombre_comercial'		=> $datos['RazonSocial'],
	        			'razon_social'	=> $datos['RazonSocial'],
	        			//'ruc'			=> $datos['RUC'],
	        			'direccion'		=> $direccion,
	        			'telefono1'		=> strlen($t[0]) < 4 ? str_replace(' ', '', $t[1]) : str_replace(' ', '', $t[0]),
	        			'telefono2'		=> isset($t[1]) ? str_replace(' ', '', $t[1]) : '',
	        			'email'			=> 'email@email.com',
	        			'id_dis'		=> $dep->id,
	        			'id_prov'		=> $prov->id,
	        			'id_dep'		=> $dep->id,
	        			'ubigeo'		=> $dis->id == 1 ? '201000' : $dis->ubigeo,
	        			'estado'		=> 1	
					];
					$id = $this->pagos->newEmpresa($data);
					$d = array(
						'persona_id'				=> 1,
						'tipo_identificacion_id'	=> 4,
						'nroidentificacion'			=> $datos['RUC'],
						'empresa_id'				=> $id
					);
					$this->persona->newIdentificacion($d);
        	}
        	else{
        		$id = $em->id;
	            if(isset($datos['Telefono']))
	              $t = explode('/', $datos['Telefono']);
	            else
	              $t = [0,0];
        		$dir = explode(' - ', $datos['Direccion']);
        		if($datos['Direccion'] != '-'){
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
        		$dir = explode(' - ', $datos['Direccion']);
        		$direccion = $datos['Direccion'];
        		if($datos['Direccion'] != '-'){
	        		$d = explode(' ', $dir[0]);
	        		$direccion = substr($dir[0], 0, strlen($dir[0])-strlen($d[count($d)-1]));
	        	}
        		$data = [
					'nombre_comercial'		=> $datos['RazonSocial'],
        			'razon_social'	=> $datos['RazonSocial'],
        			//'ruc'			=> $datos['RUC'],
        			'direccion'		=> $direccion,
        			'telefono1'		=> strlen($t[0]) < 4 ? str_replace(' ', '', $t[1]) : str_replace(' ', '', $t[0]),
        			'telefono2'		=> isset($t[1]) ? str_replace(' ', '', $t[1]) : '',
        			'id_dis'		=> $dep->id,
        			'id_prov'		=> $prov->id,
        			'id_dep'		=> $dep->id,
        			'ubigeo'		=> $dis->id == 1 ? '201000' : $dis->ubigeo,
        			'estado'		=> 1	
				];
				$this->pagos->updateEmpresa($data,$id);
        	}
        	$datos['id'] = $id;
			echo json_encode(['status'=>200,'data'=>$datos,'message'=>'Busqueda satisfactoria']);
		}
		else
			echo json_encode(['status'=>202,'data'=>[],'message'=>'Error en la consulta']);
	}

	public function deleteItem(){
		if(!$this->input->post())
            header('Location: '.base_url());
        if($this->session->userdata('items'))
            $items = $this->session->userdata('items');
        else
            $items = array();
        $datos = $this->input->post(null,true);
        $precio = $items[$datos['id']]['precio'];
        $cantidad = $items[$datos['id']]['cantidad'];
        if(isset($items[$datos['id']]))
            unset($items[$datos['id']]);
        $this->session->set_userdata('items',$items);
        /*if(isset($items[$datos['id']]))
            echo json_encode($items[$datos['id']]);
        else*/
            echo json_encode(array('cantidad'=>0,'id'=>$datos['id'],'precio'=>$precio*$cantidad));
	}

	public function saveItem(){
		if(!$this->input->post())
            header('Location: '.base_url());
        if($this->session->userdata('items'))
        	$items = $this->session->userdata('items');
        else
        	$items = array();
        $datos = $this->input->post(null,true);
        if($datos['id'] == 0){
        	$datos['id'] = md5($datos['nombre']);
        }
        if(isset($items[$datos['id']])){
        	if($items[$datos['id']]['nombre'] != $datos['nombre']){
        		unset($items[$datos['id']]);
        		$datos['last_id'] = $datos['id'];
        		$datos['id'] = md5($datos['nombre']);
        	}
            $items[$datos['id']] = $datos;
        }
        else{
            if(!isset($datos['cantidad']))
        	   $datos['cantidad'] = 1;
        	if(!isset($datos['descuento']))
        		$datos['descuento'] = 0.0;
        	$items[$datos['id']] = $datos;
        }
        $this->session->set_userdata('items',$items);
        echo json_encode($items[$datos['id']]);
	}

	public function generanota(){
		if(!$this->input->post())
			header('Location: '.base_url());
		$comprobante = $this->pagos->getComprobante($this->input->post('num_serie'),$this->input->post('num_documento'));
		$data_nota = [
			'cod_doc'				=> $this->input->post('doc_nota'),
			'nu_se'					=> $this->input->post('num_serie'),
			'nu_doc'				=> $this->input->post('num_documento'),
			'c_doc'					=> $this->input->post('cod_doc'),
			'detalle'				=> $this->input->post('observacion'),
			'cod_tipo'				=> $this->input->post('doc_nota') == '07' ? $this->input->post('motivo_credito') : $this->input->post('motivo_debito'),
			'diasmora'				=> 0,
			'cancelado'				=> date('Y-m-d H:i:s'),
			'moneda'				=> $comprobante->moneda,
			'id_empresa'			=> $comprobante->empresa_id,
			'id_persona'			=> $comprobante->persona_id,
			'id_usuario'			=> $comprobante->usuario_id
		];
		$data_detalles_nota = [];
		if($this->input->post('doc_nota') == '07'){
			switch ($this->input->post('motivo_credito')) {
				case '01':{
					$data_nota['afecto']			= $comprobante->total;
					$nota = $this->pagos->newNota($data_nota);
					$detalles = $this->pagos->getDetallesComprobante($this->input->post('num_serie'),$this->input->post('num_documento'));
					//dumpvar($detalles);

					foreach ($detalles as $key => $value) {
						$dll = [
							'num_serie'			=> $nota->num_serie,
							'num_documento'		=> $nota->num_documento,
							'cod_doc'			=> $this->input->post('doc_nota'),
							'id_item'			=> $value->id_item,
							'cantidad'			=> $value->cantidad,
							'precio'			=> $value->precio,
							'descuento'			=> $value->descuento,
							'tipo_igv'			=> $value->tipo_igv,
							'igv'				=> $value->tipo_igv == 1 ? $value->precio-$value->precio/1.18 : 0,
							'id_medida'			=> $value->medida_id,
							'codigo_catalogo'	=> $value->cod_catalogo
						];
						$this->pagos->newDetalleNota($dll);
						$dll['precioventa'] = $dll['precio'];
						$dll['codigo'] = $value->codigo;
						$dll['nombre'] = $value->descripcion;
						$dll['igv'] = 0;
						$dll['cod_catalogo'] = $dll['codigo_catalogo'];
						array_push($data_detalles_nota,$dll);
					}

					$this->pagos->updateVenta(['estado'=>3],['num_serie'=>$this->input->post('num_serie'),'num_documento'=>$this->input->post('num_documento')]);
				}
					# code...
					break;

				case '02':{
					$data_nota['afecto']			= $comprobante->total;
					$nota = $this->pagos->newNota($data_nota);
					$detalles = $this->pagos->getDetallesComprobante($this->input->post('num_serie'),$this->input->post('num_documento'));
					//dumpvar($detalles);

					foreach ($detalles as $key => $value) {
						$dll = [
							'num_serie'			=> $nota->num_serie,
							'num_documento'		=> $nota->num_documento,
							'cod_doc'			=> $this->input->post('doc_nota'),
							'id_item'			=> $value->id_item,
							'cantidad'			=> $value->cantidad,
							'precio'			=> $value->precio,
							'descuento'			=> $value->descuento,
							'tipo_igv'			=> $value->tipo_igv,
							'igv'				=> $value->tipo_igv == 1 ? $value->precio-$value->precio/1.18 : 0,
							'id_medida'			=> $value->medida_id,
							'codigo_catalogo'	=> $value->cod_catalogo
						];
						$this->pagos->newDetalleNota($dll);
						$dll['precioventa'] = $dll['precio'];
						$dll['codigo'] = $value->codigo;
						$dll['nombre'] = $value->descripcion;
						$dll['igv'] = 0;
						$dll['cod_catalogo'] = $dll['codigo_catalogo'];
						array_push($data_detalles_nota,$dll);
					}

					$this->pagos->updateVenta(['estado'=>3],['num_serie'=>$this->input->post('num_serie'),'num_documento'=>$this->input->post('num_documento')]);
				}
					# code...
					break;

				case '03':{
					$data_nota['afecto']			= $comprobante->total;
					$nota = $this->pagos->newNota($data_nota);
					//$detalles = $this->pagos->getDetallesComprobante($this->input->post('num_serie'),$this->input->post('num_documento'));
					//dumpvar($this->session->userdata('items'));
					$detalles = $this->session->userdata('items');

					foreach ($detalles as $key => $value) {
						$data_item = [
							'descripcion'					=> $value['nombre'],
							'cod_catalogo'					=> '86131801',
							'tipo'							=> 2,
							'stock'							=> 0,
							'estado'						=> 0,
							'medida_id'						=> 16
						];
						$id_item = $this->pagos->newItems($data_item);
						$dll = [
							'num_serie'			=> $nota->num_serie,
							'num_documento'		=> $nota->num_documento,
							'cod_doc'			=> $this->input->post('doc_nota'),
							'id_item'			=> $id_item,
							'cantidad'			=> $value['cantidad'],
							'precio'			=> $value['precioventa'],
							'descuento'			=> $value['descuento'],
							'tipo_igv'			=> $value['tipoigv'],
							'igv'				=> $value['tipoigv'] == 1 ? $value['precioventa']-$value['precioventa']/1.18 : 0,
							'id_medida'			=> $value['id_medida'],
							'codigo_catalogo'	=> $value['codigo_catalogo']
						];
						$this->pagos->newDetalleNota($dll);
						$dll['precioventa'] = $dll['precio'];
						$dll['codigo'] = 'ZZ';
						$dll['nombre'] = $value['nombre'];
						$dll['igv'] = 0;
						$dll['cod_catalogo'] = $dll['codigo_catalogo'];
						array_push($data_detalles_nota,$dll);
					}
				}
					# code...
					break;

				case '04':{
					$data_nota['afecto']			= $this->input->post('importe');
					$nota = $this->pagos->newNota($data_nota);
					$detalles = $this->pagos->getDetallesComprobante($this->input->post('num_serie'),$this->input->post('num_documento'));
					//dumpvar($detalles);

					foreach ($detalles as $key => $value) if($key == 0) {
						$data_item = [
							'descripcion'					=> $this->input->post('observacion'),
							'cod_catalogo'					=> '86131801',
							'tipo'							=> 2,
							'stock'							=> 0,
							'estado'						=> 0,
							'medida_id'						=> 16
						];
						$id_item = $this->pagos->newItems($data_item);
						$dll = [
							'num_serie'			=> $nota->num_serie,
							'num_documento'		=> $nota->num_documento,
							'cod_doc'			=> $this->input->post('doc_nota'),
							'id_item'			=> $id_item,
							'cantidad'			=> 1,
							'precio'			=> $this->input->post('importe'),
							'descuento'			=> 0,
							'tipo_igv'			=> $value->tipo_igv,
							'igv'				=> $value->tipo_igv == 1 ? $this->input->post('importe')-$this->input->post('importe')/1.18 : 0,
							'id_medida'			=> $value->medida_id,
							'codigo_catalogo'	=> $value->cod_catalogo
						];
						$this->pagos->newDetalleNota($dll);
						$dll['precioventa'] = $dll['precio'];
						$dll['codigo'] = $value->codigo;
						$dll['nombre'] = $this->input->post('observacion');
						$dll['igv'] = 0;
						$dll['cod_catalogo'] = $dll['codigo_catalogo'];
						array_push($data_detalles_nota,$dll);
					}
				}
					# code...
					break;

				case '05':{
					$af = 0;
					foreach ($this->session->userdata('items') as $key => $value) {
						$af += $value['descuento']*$value['cantidad'];
					}
					$data_nota['afecto']			= $af;
					$nota = $this->pagos->newNota($data_nota);
					$detalles = $this->pagos->getDetallesComprobante($this->input->post('num_serie'),$this->input->post('num_documento'));
					//dumpvar($this->session->userdata('items'));
					$items = $this->session->userdata('items');
					if(count($items) == 0){
						echo json_encode(['status'=>202,'data'=>[],'message'=>'No realizo ningun descuento']);
						exit();
					}

					foreach ($items as $key => $value) {
						$detalle = $this->searchItem($detalles,$value['id']);
						$dll = [
							'num_serie'			=> $nota->num_serie,
							'num_documento'		=> $nota->num_documento,
							'cod_doc'			=> $this->input->post('doc_nota'),
							'id_item'			=> $value['id'],
							'cantidad'			=> $value['cantidad'],
							'precio'			=> $value['descuento'],
							'descuento'			=> 0,
							'tipo_igv'			=> $detalle->tipo_igv,
							'igv'				=> $detalle->tipo_igv == 1 ? ($value['descuento'])-($value['descuento'])/1.18 : 0,
							'id_medida'			=> $detalle->id_medida,
							'codigo_catalogo'	=> $detalle->cod_catalogo
						];
						$this->pagos->newDetalleNota($dll);
						$dll['precioventa'] = $dll['precio'];
						$dll['codigo'] = $detalle->codigo;
						$dll['nombre'] = $detalle->descripcion;
						$dll['igv'] = 0;
						$dll['cod_catalogo'] = $dll['codigo_catalogo'];
						array_push($data_detalles_nota,$dll);
					}
				}
					# code...
					break;

				case '06':{
					$data_nota['afecto']			= $comprobante->total;
					$nota = $this->pagos->newNota($data_nota);
					$detalles = $this->pagos->getDetallesComprobante($this->input->post('num_serie'),$this->input->post('num_documento'));
					//dumpvar($detalles);

					foreach ($detalles as $key => $value) {
						$dll = [
							'num_serie'			=> $nota->num_serie,
							'num_documento'		=> $nota->num_documento,
							'cod_doc'			=> $this->input->post('doc_nota'),
							'id_item'			=> $value->id_item,
							'cantidad'			=> $value->cantidad,
							'precio'			=> $value->precio,
							'descuento'			=> $value->descuento,
							'tipo_igv'			=> $value->tipo_igv,
							'igv'				=> $value->tipo_igv == 1 ? $value->precio-$value->precio/1.18 : 0,
							'id_medida'			=> $value->medida_id,
							'codigo_catalogo'	=> $value->cod_catalogo
						];
						$this->pagos->newDetalleNota($dll);
						$dll['precioventa'] = $dll['precio'];
						$dll['codigo'] = $value->codigo;
						$dll['nombre'] = $value->descripcion;
						$dll['igv'] = 0;
						$dll['cod_catalogo'] = $dll['codigo_catalogo'];
						array_push($data_detalles_nota,$dll);
					}

					$this->pagos->updateVenta(['estado'=>3],['num_serie'=>$this->input->post('num_serie'),'num_documento'=>$this->input->post('num_documento')]);
				}
					# code...
					break;

				case '07':{
					//dumpvar($this->input->post(null,true));
					if(!$this->input->post('items') && count($this->input->post('items')) == 0){
						echo json_encode(['status'=>202,'data'=>[],'message'=>'Seleccione al menos un item']);
						exit();
					}
					$af = 0;
					$detalles = $this->pagos->getDetallesComprobante($this->input->post('num_serie'),$this->input->post('num_documento'));
					//dumpvar($detalles);
					foreach ($this->session->userdata('items') as $key => $value) {
						$detail = $this->searchItem($detalles,$value);
						if($detail)
							$af += $detail->precio;
					}
					$data_nota['afecto']			= $af;
					$nota = $this->pagos->newNota($data_nota);
					//dumpvar($this->input->post('items'));

					foreach ($this->input->post('items') as $key => $value) {
						$detail = $this->searchItem($detalles,$value);
						$dll = [
							'num_serie'			=> $nota->num_serie,
							'num_documento'		=> $nota->num_documento,
							'cod_doc'			=> $this->input->post('doc_nota'),
							'id_item'			=> $value,
							'cantidad'			=> $detail->cantidad,
							'precio'			=> $detail->precio,
							'descuento'			=> $detail->descuento,
							'tipo_igv'			=> $detail->tipo_igv,
							'igv'				=> $detail->tipo_igv == 1 ? $detail->precio-$detail->precio/1.18 : 0,
							'id_medida'			=> $detail->medida_id,
							'codigo_catalogo'	=> $detail->cod_catalogo
						];
						$this->pagos->newDetalleNota($dll);
						$dll['precioventa'] = $dll['precio'];
						$dll['codigo'] = $detail->codigo;
						$dll['nombre'] = $detail->descripcion;
						$dll['igv'] = 0;
						$dll['cod_catalogo'] = $dll['codigo_catalogo'];
						array_push($data_detalles_nota,$dll);
					}
				}
					# code...
					break;

				case '08':{
					$data_nota['afecto']			= $this->input->post('importe');
					$nota = $this->pagos->newNota($data_nota);
					$detalles = $this->pagos->getDetallesComprobante($this->input->post('num_serie'),$this->input->post('num_documento'));
					//dumpvar($detalles);

					foreach ($detalles as $key => $value) {
						$data_item = [
							'descripcion'					=> $this->input->post('observacion'),
							'cod_catalogo'					=> '86131801',
							'tipo'							=> 2,
							'stock'							=> 0,
							'estado'						=> 0,
							'medida_id'						=> 16
						];
						$id_item = $this->pagos->newItems($data_item);
						$dll = [
							'num_serie'			=> $nota->num_serie,
							'num_documento'		=> $nota->num_documento,
							'cod_doc'			=> $this->input->post('doc_nota'),
							'id_item'			=> $id_item,
							'cantidad'			=> $value->cantidad,
							'precio'			=> $value->precio,
							'descuento'			=> $value->descuento,
							'tipo_igv'			=> $value->tipo_igv,
							'igv'				=> $value->tipo_igv == 1 ? $value->precio-$value->precio/1.18 : 0,
							'id_medida'			=> $value->medida_id,
							'codigo_catalogo'	=> $value->cod_catalogo
						];
						$this->pagos->newDetalleNota($dll);
						$dll['precioventa'] = $dll['precio'];
						$dll['codigo'] = $value->codigo;
						$dll['nombre'] = $this->input->post('observacion');
						$dll['igv'] = 0;
						$dll['cod_catalogo'] = $dll['codigo_catalogo'];
						array_push($data_detalles_nota,$dll);
					}
				}
					# code...
					break;

				case '09':{
					$data_nota['afecto']			= $this->input->post('importe');
					$nota = $this->pagos->newNota($data_nota);
					$detalles = $this->pagos->getDetallesComprobante($this->input->post('num_serie'),$this->input->post('num_documento'));
					//dumpvar($detalles);

					foreach ($detalles as $key => $value) {
						$data_item = [
							'descripcion'					=> $this->input->post('observacion'),
							'cod_catalogo'					=> '86131801',
							'tipo'							=> 2,
							'stock'							=> 0,
							'estado'						=> 0,
							'medida_id'						=> 16
						];
						$id_item = $this->pagos->newItems($data_item);
						$dll = [
							'num_serie'			=> $nota->num_serie,
							'num_documento'		=> $nota->num_documento,
							'cod_doc'			=> $this->input->post('doc_nota'),
							'id_item'			=> $id_item,
							'cantidad'			=> $value->cantidad,
							'precio'			=> $value->precio,
							'descuento'			=> $value->descuento,
							'tipo_igv'			=> $value->tipo_igv,
							'igv'				=> $value->tipo_igv == 1 ? $value->precio-$value->precio/1.18 : 0,
							'id_medida'			=> $value->medida_id,
							'codigo_catalogo'	=> $value->cod_catalogo
						];
						$this->pagos->newDetalleNota($dll);
						$dll['precioventa'] = $dll['precio'];
						$dll['codigo'] = $value->codigo;
						$dll['nombre'] = $this->input->post('observacion');
						$dll['igv'] = 0;
						$dll['cod_catalogo'] = $dll['codigo_catalogo'];
						array_push($data_detalles_nota,$dll);
					}
				}
					# code...
					break;

				case '10':{
					$data_nota['afecto']			= $this->input->post('importe');
					$nota = $this->pagos->newNota($data_nota);
					$detalles = $this->pagos->getDetallesComprobante($this->input->post('num_serie'),$this->input->post('num_documento'));
					//dumpvar($detalles);

					foreach ($detalles as $key => $value) {
						$data_item = [
							'descripcion'					=> $this->input->post('observacion'),
							'cod_catalogo'					=> '86131801',
							'tipo'							=> 2,
							'stock'							=> 0,
							'estado'						=> 0,
							'medida_id'						=> 16
						];
						$id_item = $this->pagos->newItems($data_item);
						$dll = [
							'num_serie'			=> $nota->num_serie,
							'num_documento'		=> $nota->num_documento,
							'cod_doc'			=> $this->input->post('doc_nota'),
							'id_item'			=> $id_item,
							'cantidad'			=> $value->cantidad,
							'precio'			=> $value->precio,
							'descuento'			=> $value->descuento,
							'tipo_igv'			=> $value->tipo_igv,
							'igv'				=> $value->tipo_igv == 1 ? $value->precio-$value->precio/1.18 : 0,
							'id_medida'			=> $value->medida_id,
							'codigo_catalogo'	=> $value->cod_catalogo
						];
						$this->pagos->newDetalleNota($dll);
						$dll['precioventa'] = $dll['precio'];
						$dll['codigo'] = $value->codigo;
						$dll['nombre'] = $this->input->post('observacion');
						$dll['igv'] = 0;
						$dll['cod_catalogo'] = $dll['codigo_catalogo'];
						array_push($data_detalles_nota,$dll);
					}
				}
					# code...
					break;
				
				default:
					# code...
					break;
			}
			$data = $data_nota;
			$data['totalsafecto'] = 0;
			$data['totaligv_afecto'] = 0;
			$data['afecto'] = 0;
			//$data['direccion'] = $cliente->direccion;
			$u = $this->session->userdata('usuario');
			$data['usuario'] = $u['usuario'];
			$data['num_serie'] = $nota->num_serie;
			$data['num_documento'] = $nota->num_documento;
			$data['comprobante'] = 'nota';
			$data['total'] = $data_nota['afecto'];
			$cliente = $comprobante->cod_doc == '03' ? $this->persona->getPersonaForId($comprobante->persona_id) : $this->pagos->getCliente($comprobante->empresa_id);
			$data['nombrecliente'] = $comprobante->cod_doc == '03' ? $cliente->persona : $cliente->razon_social;
			$data['nroidentificacion'] = $cliente->nroidentificacion;

			//cambia estado del comprobante anterior
			//$this->ven->updateVenta(['estado'=>2],['num_serie'=>$comp->num_serie,'num_documento'=>$comp->num_documento]);
			//preparacion del xml
			$this->load->library('greenter',$this->parameters);
			$this->greenter->setData($data);
			$this->greenter->setItems($data_detalles_nota);
			$this->greenter->legenda($data);
			$datos = $this->greenter->preparaXML('notas/credito',substr($data_nota['cancelado'],0,10));
			$this->load->library('barcode2');
			$this->barcode2->setData($this->parameters['ruc'].'|'.$data['cod_doc'].'|'.$nota->num_serie.'|'.$nota->num_documento.'|'.number_format(0,2).'|'.number_format($data['afecto'],2,'.','').'|'.date('d/m/Y',strtotime(date($data['cancelado']))).'|'.($comprobante->cod_doc == '03' ? 6 : 1).'|'.$cliente->nroidentificacion.'|'.$datos['DigestValue'].'|'.$datos['SignatureValue']);
			$a = $this->barcode2->getgd();
			file_put_contents('./barcodes/'.substr($data['cancelado'],0,10).$nota->num_serie.'-'.$nota->num_documento.'.png', $a);
			echo json_encode(['status'=>200,'data'=>[
					'num_serie'			=> $nota->num_serie,
					'num_documento'		=> $nota->num_documento,
					'fecha'				=> date('d/m/Y',strtotime(substr($data['cancelado'], 0, 10))),
					'cod_doc'			=> $data['cod_doc'],
					'imagen'			=> substr($data['cancelado'],0,10).$nota->num_serie.'-'.$nota->num_documento.'.png',
					'data_comp'			=> $data
				],'message'=>'Emisión satisfactoria']);
		}
	}

	public function searchItem($items,$id){
		foreach ($items as $key => $value) {
			if($value->id_item == $id)
				return $value;
		}
		return 0;
	}

	public function getItemComprobante(){
		if(!$this->input->post())
            header('Location: '.base_url());
        $req = $this->input->post(null,true);
        $item = $this->pagos->searchItemComprobante($req['num_serie'],$req['num_documento'],$req['id']);
        $medidas = $this->utils->getMedidas();
        if(is_numeric($item))
        	echo json_encode(['status'=>202,'data'=>[],'message'=>'Datos no encontrados']);
        else
        	echo json_encode(['status'=>200,'data'=>['item'=>$item,'medidas'=>$medidas],'message'=>'Datos encontrados satisfactoriamente']);
	}

	public function baja($cod = ''){
		if(!$this->session->userdata('usuario'))
			header('Location: '.base_url());
		if(!$this->input->post())
			header('Location: '.base_url());
		$param = $this->parameters;
		$this->load->library('bajaxml');
		$this->load->library('sunat',$param);
		//$comprobante = $this->input->post('comprobante');
		$c = explode('-', $cod);
		$com = $this->pagos->getComprobante($c[0],$c[1]);
		$fecha = substr($com->fecha, 0, 10);
		if(is_numeric($com)){
			$com = $this->pagos->getNota($c[0],$c[1]);
			$fecha = substr($com->cancelado, 0, 10);
		}
		if(is_numeric($com)){
			echo json_encode(['status'=>202,'data'=>[],'msg'=>'Error en los datos solicitados']);
			exit();
		}
		$bajas = 0;
		$b = $this->pagos->getBajas(substr($fecha, 0, 10));
		if(!is_numeric($b))
			$bajas += $b->bajas;
		$bajas += 1;
		$this->bajaxml->cargaDocumento($com,$bajas,$this->input->post('motivo'),$param);
		$this->bajaxml->generarArchivo('bajas',$fecha,$param['ruc'].'-RA-'.date('Ymd',strtotime(date($fecha))).'-'.$bajas);
		$this->bajaxml->firmar('bajas',$fecha,$param['ruc'].'-RA-'.date('Ymd',strtotime(date($fecha))).'-'.$bajas,$param);
		$this->sunat->setMethodSumary();
		$status = $this->sunat->envia($param['ruc'].'-RA-'.date('Ymd',strtotime(date($fecha))).'-'.$bajas,BASEPATH.'../archivos/bajas/'.substr($fecha,0,10).'/');
		if($status['status'] != 200){
			echo json_encode(['status'=>202,'data'=>[],'msg'=>'Error '.$status['data']]);
			exit();
		}
		$ticket = $this->sunat->loadStatus('R-'.$param['ruc'].'-RA-'.date('Ymd',strtotime(date($fecha))).'-'.$bajas,BASEPATH.'../archivos/bajas/'.substr($fecha,0,10).'/');
		$status = $this->sunat->getStatus($ticket,'R-'.$param['ruc'].'-RA-'.date('Ymd',strtotime(date($fecha))).'-'.$bajas,BASEPATH.'../archivos/bajas/'.substr($fecha,0,10).'/');
		if($status['status'] != 200){
			echo json_encode(['status'=>202,'data'=>[],'msg'=>'Error '.$status['data']]);
			exit();
		}
		$this->pagos->newBaja([
			'num_serie'					=> $com->num_serie,
			'num_documento'				=> $com->num_documento,
			'cod_doc'					=> $com->cod_doc,
			'fecha'						=> date('Y-m-d H:i:s'),
			'file'						=> 'R-'.$param['ruc'].'-RA-'.date('Ymd',strtotime(date($fecha))).'-'.$bajas
		]);
		if($status['status'] == 200){
			if($com->cod_doc == '01' || $com->cod_doc == '03')
				$this->ven->updateVenta(['estado'=>3],['num_serie'=>$com->num_serie,'num_documento'=>$com->num_documento]);
			if($com->cod_doc == '07' || $com->cod_doc == '08')
				$this->ven->updateNota(['estado'=>3],['num_serie'=>$com->num_serie,'num_documento'=>$com->num_documento]);
		}
		//echo json_encode(['data'=>'10475518808-RA-'.date('Ymd',strtotime(date($v->fecha))).'-'.($b->bajas+1)]);
		echo json_encode($status);
	}

	public function autocompleteproducto(){
		if(!$this->input->post())
            header('Location: '.base_url());
        $productos = $this->pagos->searchProducto($this->input->post('data'));
        $a = array();
        if(!is_numeric($productos))
        foreach ($productos as $key => $value) 
            array_push($a, array('value'=>$value->descripcion.' S/'.number_format($value->precio,2,'.',''),'data'=>json_encode($value)));
        print json_encode(array('suggestions'=>$a));
	}
}