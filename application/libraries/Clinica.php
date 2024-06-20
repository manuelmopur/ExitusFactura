<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clinica
{

	public function __get($var){
		return get_instance()->$var;
	}

	public function catgaDataN($detalle,$a = 0){
		$datos_notac = array();
		if(!is_numeric($detalle))
			foreach ($detalle as $key => $value) {
				if($a == 0)
					array_push($datos_notac, array(
						'cod_analisis'	=> $value->cod_analisis,
						'nombre'		=> $value->nombre,
						'descuento'		=> $value->descuento,
						'cantidad'		=> $value->cantidad,
						'precio'		=> $value->monto
						));
				else
					array_push($datos_notac, array(
						'cod_analisis'	=> 80702,
						'nombre'		=> $value->descripcion,
						'descuento'		=> $value->dsto,
						'cantidad'		=> $value->cantidad,
						'precio'		=> $value->precioventa
						));
		}
		$this->session->set_userdata('datos_notac',$datos_notac);
	}

	public function catgaDataND($detalle,$a = 0){
		$datos_notac = array();
		if(!is_numeric($detalle))
			foreach ($detalle as $key => $value) {
				if($a == 0)
					array_push($datos_notac, array(
						'cod_analisis'	=> $value->cod_analisis,
						'nombre'		=> $value->nombre,
						'aumento'		=> isset($value->aumento) ? $value->aumento : 0,
						'precio'		=> $value->monto
						));
				else
					array_push($datos_notac, array(
						'cod_analisis'	=> 0,
						'nombre'		=> $value->descripcion,
						'descuento'		=> 0,
						'precio'		=> $value->precioventa
						));
		}
		$this->session->set_userdata('datos_notad',$datos_notac);
	}

	public function cargaDataNC($nota){
		$this->load->database();
		$n = $nota['nota'][0];
		$v = $nota['venta'][0];
		$data = array(
			'num_serie'		=> $v->num_serie,
			'num_documento'	=> $v->num_documento,
			'cod_doc'		=> $v->cod_doc,
			'observacion'	=> $n->detalle,
			'estado'		=> $n->estado,
			'cod_tipo'		=> $n->cod_tipo,
			'diasmora'		=> $n->diasmora,
			'interesdia'	=> $n->interesdia,
			'cancelado'		=> $n->cancelado,
			'descuento'		=> $n->descuento,
			'saldo'			=> $n->saldo
			);
		$this->load->model('user');
		if($v->id_empresa != 1){
			$user = $this->user->searchPaciente($v->id_persona);
			if(substr($v->num_serie, 0,1) == 'F'){
				$data['ruc'] = $user->ruc;
				$data['cliente'] = $user->razon_social;
			}
			else{
				$data['dni'] = $user->dni;
				$data['cliente'] = $user->apellidos.', '.$user->nombres;
			}
		}else{
			$empresa = $this->user->searchEmpresa($v->id_empresa);
			$data['ruc'] = $empresa->ruc;
			$data['cliente'] = $empresa->razon_social;
		}
		$this->session->set_userdata('data_notacredito',$data);
		/*$this->load->model('ventas_usuario','venta');
		$this->venta->traeDNotaC($n->num_serie,$n->num_documento);*/
	}

	public function cargaDataND($nota){
		$this->load->database();
		$n = $nota['nota'][0];
		$v = $nota['venta'][0];
		$data = array(
			'num_serie'		=> $v->num_serie,
			'num_documento'	=> $v->num_documento,
			'cod_doc'		=> $v->cod_doc,
			'observacion'	=> $n->detalle,
			'estado'		=> $n->estado,
			'cod_tipo'		=> $n->cod_tipo,
			'diasmora'		=> $n->diasmora,
			'interesdia'	=> $n->interesdia,
			'cancelado'		=> $n->cancelado,
			'descuento'		=> $n->descuento,
			'saldo'			=> $n->saldo
			);
		$this->load->model('user');
		if($v->id_empresa != 1){
			$user = $this->user->searchPaciente($v->id_persona);
			if(substr($v->num_serie, 0,1) == 'F'){
				$data['ruc'] = $user->ruc;
				$data['cliente'] = $user->razon_social;
			}
			else{
				$data['dni'] = $user->dni;
				$data['cliente'] = $user->apellidos.', '.$user->nombres;
			}
		}else{
			$empresa = $this->user->searchEmpresa($v->id_empresa);
			$data['ruc'] = $empresa->ruc;
			$data['cliente'] = $empresa->razon_social;
		}
		$this->session->set_userdata('data_notadebito',$data);
		/*$this->load->model('ventas_usuario','venta');
		$this->venta->traeDNotaC($n->num_serie,$n->num_documento);*/
	}

	public function cargaData($venta,$detalle){
		//carga de datos venta1
		$datos_venta1 = array(
			'cod_oficina'		=> $venta->cod_oficina,
			'numero-paciente'	=> $venta->cod_paciente,
			'cod_medico'		=> $venta->cod_medico
			);
		$trama_venta = array(
			'cod_usuario'		=> $venta->cod_usuario,
			'fecha'			=> $venta->fecha
			);
		$this->session->set_userdata('trama_venta',$trama_venta);
		$this->load->model('user');
		$paciente = $this->user->searchPaciente($venta->cod_paciente);
		if($venta->id_empresa == '1'){
			$datos_venta1['tipo-atencion'] = '0';
			$datos_venta1['doc-paciente'] = $paciente->dni;
			$datos_venta1['apellidos'] = $paciente->apellidos.', '.$paciente->nombres;
			$datos_venta1['sexo'] = $paciente->sexo;
			$datos_venta1['fch_nac'] = $paciente->nacimiento;
			if($venta->cod_doc == '03' && $venta->cod_paciente != $venta->id_persona){
				$datos_venta1['document'] = 'dni';
				$datos_venta1['id-persona'] = $venta->id_persona;
				$pagador = $this->user->searchPaciente($venta->id_persona);
				$datos_venta1['dni-comprobante'] = $pagador->dni;
				$datos_venta1['nombre-comprobante']	= $pagador->apellidos.', '.$pagador->nombres;
			}
			else if($venta->cod_doc == '01'){
				$datos_venta1['id-entidad'] = $venta->id_persona;
				$datos_venta1['document'] = 'ruc';
				$pagador = $this->user->searchPaciente($venta->id_persona);
				$datos_venta1['ruc-comprobante'] = $pagador->ruc;
				$datos_venta1['razon-social'] = $pagador->razon_social;
			}
		}
		else{
			//$this->load->model('compania');
			$empresa = $this->user->searchEmpresa($venta->id_empresa);
			$datos_venta1['tipo-atencion'] = '1';
			$datos_venta1['id-institucion'] = $venta->id_empresa;
			$datos_venta1['numero-paciente'] = $venta->id_persona;
			$datos_venta1['apellidos'] = $paciente->apellidos.', '.$paciente->nombres;
			$datos_venta1['doc-paciente'] = $paciente->dni;
			$datos_venta1['institucion'] = $empresa->ruc.'-'.$empresa->razon_social;
		}
		$this->session->set_userdata('datos_venta1',$datos_venta1);
		//carga de datos venta2
		$venta2 = array();
		if($detalle != 0 && $detalle[0]->cod_analisis != '80702')
			foreach ($detalle as $key => $value) {
				$pu = $value->precioventa/(1-$value->dsto_analisis);
					$dsc = $pu*$value->dsto_analisis;
				array_push($venta2, array(
					'cod_analisis'	=> $value->cod_analisis,
					'nombre'		=> $value->nombre,
					'precio'		=> $pu/$value->cantidad,
					'categoria'		=> $value->nombre_cat,
					'descuento'		=> $value->dsto_analisis,
					'aumento'		=> 0,
					'cantidad'		=> $value->cantidad,
					'cod_infinity'	=> $value->cod_infinity
					));
			}
		else{
			$this->load->model('ventas_usuario','venta');
			$d = $this->venta->traeServD($venta->num_serie,$venta->num_documento);
			if(!is_numeric($d))
				foreach ($d as $key => $value) {
					array_push($venta2, array(
						'cod_analisis'		=> '80702',
						'nombre'			=> $value->descripcion,
						'precio'			=> $value->precioventa,
						'categoria'			=> 'Especiales',
						'descuento'			=> $value->dsto,
						'aumento'			=> $value->aumento,
						'cantidad'			=> $value->cantidad,
						'cod_infinity'		=> '   '
						));
				}
		}
		class_implements('stdclass');
		$obj = new stdclass();
		$obj->num_serie = $venta->num_serie;
		$obj->num_documento = $venta->num_documento;
		$obj->cod_omega = $venta->cod_omega;
		$this->session->set_userdata('data_venta',$obj);
		$this->session->set_userdata('datos_venta2',$venta2);
		//carga de datos venta3
		$this->session->set_userdata('datos_venta3',array('total'=> $venta->total));
		$data['ingreso-efectivo'] = number_format($venta->efectivo,2);
		$data['ingreso-tarjeta'] = number_format($venta->tarjeta,2);
		$data['vuelto'] = number_format($venta->total - ($venta->efectivo + $venta->tarjeta),2);
		$this->session->set_userdata('metodo-pago',$data);
	}


	public function leterNumber($n = ''){
		$letra = array(
			0		=> '',
			1		=> 'UNO',
			2		=> 'DOS',
			3		=> 'TRES',
			4		=> 'CUATRO',
			5		=> 'CINCO',
			6		=> 'SEIS',
			7		=> 'SIETE',
			8		=> 'OCHO',
			9		=> 'NUEVE',
			10		=> 'DIEZ',
			11		=> 'ONCE',
			12		=> 'DOCE',
			13		=> 'TRECE',
			14		=> 'CATORCE',
			15		=> 'QUINCE',
			16		=> 'DIECISEIS',
			17		=> 'DIECISITE',
			18		=> 'DIECIOCHO',
			19		=> 'DIECINUEVE',
			20		=> 'VEINTE',
			30		=> 'TREINTA',
			40		=> 'CUARENTA',
			50		=> 'CINCUENTA',
			60		=> 'SESENTA',
			70		=> 'SETENTA',
			80		=> 'OCHENTA',
			90		=> 'NOVENTA',
			100		=> 'CIEN',
			200		=> 'DOSCIENTOS',
			300		=> 'TRESCIENTOS',
			400		=> 'CUATROCIENTOS',
			500		=> 'QUINIENTOS',
			600		=> 'SEISCIENTOS',
			700		=> 'SETECIENTOS',
			800		=> 'OCHOCIENTOS',
			900		=> 'NOVECIENTOS',
			1000	=> 'MIL'
			);
		$n = (int)$n;
		if($n <= 20)
			return $letra[$n];
		if($n <= 100){
			$a = (int)($n/10);
			$b = $n%10;
			return ($a == 2 ?  substr($letra[$a*10], 0, 5).'I' : $letra[$a*10]).($b == 0 ? '' : ($a == 2 ? $letra[$b] : ' Y '.$letra[$b]));
		}
		if($n > 100 && $n < 1000){
			$a = (int)($n/100);
			$b = (int)($n - $a*100)/10;
			$c = (int)($b*10)%10;
			$d = (int)$n - (int)$a*100;
			return $letra[(int)$a*100].($a == 1 ? 'TO ' : '').((int)$d < 20 ? ' '.$this->leterNumber($d) : ' '.$letra[(int)$b*10].' Y '.$letra[$c]);
		}
		if($n >= 1000 && $n < 1000000){
			$a = (int)($n/1000);
			if($a == 1)
				return 'MIL '.$this->leterNumber($n - 1000);
			if($a > 1)
				return $this->leterNumber($a).' MIL '.$this->leterNumber($n - $a * 1000);
		}
		if($n >= 1000000){
			$a = (int)($n/1000000);
			if($a == 1)
				return 'UN MILLON '.$this->leterNumber($n - 1000000);
			if($a > 1)
				return $this->leterNumber($a).' MILLONES '.$this->leterNumber($n - $a * 1000000);
		}
	}

	public function getValues($cod_doc = '03',$num_serie = '',$num_documento = ''){
		$url         = "http://localhost:8093/WebDoc.asmx?WSDL"; 
		$client     = new SoapClient($url); 
		$data = array();
		if($cod_doc == '03'){
			$r = $client->GetBoletaX(array(
				'serie'				=> $num_serie,
				'correlativo'		=> $num_documento
				));
			$b = explode(' ||| ', $r->GetBoletaXResult);
			$data['DigestValue']	= $b[0];
			$data['SignatureValue']	= $b[1];
		}
		else{
			$r = $client->GetFacturaX(array(
				'serie'				=> $num_serie,
				'correlativo'		=> $num_documento
				));
			$b = explode(' ||| ', $r->GetFacturaXResult);
			$data['DigestValue']	= $b[0];
			$data['SignatureValue']	= $b[1];
		}
		return $data;
		//return array('DigestValue'=>'firma','SignatureValue'=>'huella');
	}
}