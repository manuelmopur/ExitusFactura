<?php
class Pagos extends CI_Model {

	public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function newPagos($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('pagos',$datos);
        $id = $this->db->insert_id();
        return $id;
    }
    public function newCuota($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('cuota',$datos);
        $id = $this->db->insert_id();
        return $id;
    }
    public function getMaterial($id_persona, $total){
        $q = $this->db->select('tv.Total')
                    ->where('persona_id',$id_persona)
                    ->where('tv.Total', $total)
                    ->get('tventa tv');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getProvisionalWhere($data){
        $db = $this->load->database('backup',TRUE);
        $q = $db->select('tv.*')
                    ->where($data)
                    ->get('tventa tv');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getMaterialProvisional($id_persona, $total){
        $db = $this->load->database('backup',TRUE);
        $q = $db->select('tv.Total')
                    ->where('persona_id',$id_persona)
                    ->where('tv.Total', $total)
                    ->get('tventa tv');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }
    public function getTipo_Pago($codigo){
        $q = $this->db->select('pg.Tipo_Pago')
                    ->join('alumno a','a.id = pg.alumno_id')
                    ->where('a.codigo',$codigo)
                    ->get('pagos pg');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }
    
    public function getPago($id_alumno){
        $q = $this->db->select('pg.id, pg.Monto, pg.Inicial, pg.Fecha_Pago_Inicial, pg.Boleta_Inicial, pg.Tipo_Pago, pg.Estado, pg.Observacion, pg.Material')
                    ->where('Alumno_id',$id_alumno)
                    ->get('pagos pg');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getPagoWhere($where){
        $q = $this->db->select('*')
                    ->where($where)
                    ->get('pagos');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getCuota($id_pago){
         $q = $this->db->select('c.id, c.Monto, c.Fecha_Pago, c.Fecha_Expiracion, c.Boleta, c.Estado, c.Pagos_id')
                    ->where('c.Pagos_id',$id_pago)
                    ->order_by('c.Fecha_Expiracion','asc')
                    ->get('cuota c');                           
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getPagoDetalle($id_pago){
        $q = $this->db->select()
                    ->where('pg.id',$id_pago)
                    ->get('pagos pg');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getCuotaDetalle($id){
        $q = $this->db->select()
                    ->where('c.id',$id)
                    ->get('cuota c');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getCliente($id = 0){
        $q = $this->db->select('tp.*, ti.nroidentificacion, tti.codigo as id_tipo_identificacion, td.nombre as departamento, tpr.nombre as provincia, tds.nombre as distrito')
                    ->join('identificacion ti','ti.empresa_id = tp.id')
                    ->join('tipo_identificacion tti','ti.tipo_identificacion_id = tti.id')
                    ->join('tdepartamento td','td.id = tp.id_dep')
                    ->join('tprovincia tpr','tpr.id = tp.id_prov')
                    ->join('tdistrito tds','tds.id = tp.id_dis')
                    ->where('tp.id != 1')
                    ->where("tp.id = ".$id)
                    ->where('tp.estado',1)
                    ->get('empresa tp');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getEmpresaRuc($ruc){
        $q = $this->db->select('e.*, i.nroidentificacion as ruc')
                    ->join('identificacion i','i.empresa_id = e.id')
                    ->like('i.nroidentificacion',$ruc,'both')
                    ->where('i.tipo_identificacion_id',4)
                    ->get('empresa e');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function newEmpresa($data){
        $this->db->insert('empresa',$data);
        $id = $this->db->insert_id();
        return $id;
    }

    public function newItems($data){
        $this->db->insert('items',$data);
        $id = $this->db->insert_id();
        return $id;
    }

    public function newTarifa($data){
        $this->db->insert('ttarifa',$data);
        $id = $this->db->insert_id();
        return $id;
    }

    public function newItemProvisional($data){
        $db = $this->load->database('backup',TRUE);
        $db->insert('items',$data);
        $id = $db->insert_id();
        return $id;
    }

    public function newTarifaProvisional($data){
        $db = $this->load->database('backup',TRUE);
        $db->insert('ttarifa',$data);
        $id = $db->insert_id();
        return $id;
    }

    public function newDetalleVenta($data){
        if($data['cod_doc'] == '99'){
            $db = $this->load->database('backup',TRUE);
            $db->insert('tdetalleventa',$data);
        }else{
            $this->db->insert('tdetalleventa',$data);
        }
    }

    public function newDetalleNota($data){
        $this->db->insert('tdetallenota',$data);
    }

    public function newBaja($data){
        $this->db->insert('tbajas',$data);
    }

    public function updateEmpresa($data,$id){
        $this->db->where('id',$id)->update('empresa',$data);
    }

    public function updateCuota($data,$where){
        $this->db->where($where)->update('cuota',$data);
    }

    public function updatePago($data,$where){
        $this->db->where($where)->update('pagos',$data);
    }

    public function updateVenta($data,$where){
        $this->db->where($where)->update('tventa',$data);        
    }
    public function updateVentaProvisional($data,$where){
        $db = $this->load->database('backup',TRUE);
        $db->where($where)->update('tventa',$data);        
    }


    public function updateNota($data,$where){
        $this->db->where($where)->update('tnota',$data);
    }

    public function newVenta($datos){
        if($datos['cod_doc'] == '99'){
            $db = $this->load->database('backup',TRUE);
            $q = $db->query("CALL ingresaventa('".$datos['cod_doc']."',".$datos['efectivo'].",'".$datos['fecha']."',".$datos['usuario_id'].",".$datos['persona_id'].",".$datos['empresa_id'].",".$datos['descuento'].",".$datos['total'].",'".$datos['moneda']."',".$datos['estado'].");");
        }else{
            $q = $this->db->query("CALL ingresaventa('".$datos['cod_doc']."',".$datos['efectivo'].",'".$datos['fecha']."',".$datos['usuario_id'].",".$datos['persona_id'].",".$datos['empresa_id'].",".$datos['descuento'].",".$datos['total'].",'".$datos['moneda']."',".$datos['estado'].");");
        }
        $res = $q->result();
        mysqli_next_result($datos['cod_doc'] == '99' ? $db->conn_id : $this->db->conn_id );
        //$this->db->free_result();
        /*$q->next_result();*/
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function newNota($datos){
        $q = $this->db->query("CALL ingresanota('".$datos['cod_doc']."','".$datos['nu_se']."','".$datos['nu_doc']."','".$datos['c_doc']."','".$datos['detalle']."',".$datos['afecto'].",'".$datos['cod_tipo']."',".$datos['diasmora'].",'".$datos['cancelado']."','".$datos['moneda']."',".$datos['id_empresa'].",".$datos['id_persona'].",".$datos['id_usuario'].");");
        $res = $q->result();
        mysqli_next_result( $this->db->conn_id );
        //$this->db->free_result();
        /*$q->next_result();*/
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getNota($num_serie,$num_documento){
        $q = $this->db->select()
                    ->where('tv.num_serie',$num_serie)
                    ->where('tv.num_documento',$num_documento)
                    ->get('tnota tv');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getDetallesNota($num_serie,$num_documento){
        $q = $this->db->select('tdv.*, ti.*, tm.nombre as medida, tm.codigo')
                    ->join('items ti','ti.id = tdv.id_item')
                    ->join('tmedida tm','tm.id = ti.medida_id')
                    ->where('tdv.num_serie',$num_serie)
                    ->where('tdv.num_documento',$num_documento)
                    ->get('tdetallenota tdv');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getProvisional($num_serie,$num_documento){
        $db = $this->load->database('backup',TRUE);
        $q = $db->select()
                    ->where('tv.num_serie',$num_serie)
                    ->where('tv.num_documento',$num_documento)
                    ->get('tventa tv');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getDetallesProvisional($num_serie,$num_documento){
        $db = $this->load->database('backup',TRUE);
        $q = $db->select('tdv.*, ti.*, tm.nombre as medida, tm.codigo')
                    ->join('items ti','ti.id = tdv.id_item')
                    ->join('tmedida tm','tm.id = ti.medida_id')
                    ->where('tdv.num_serie',$num_serie)
                    ->where('tdv.num_documento',$num_documento)
                    ->get('tdetalleventa tdv');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getComprobante($num_serie,$num_documento){
        $q = $this->db->select()
                    ->where('tv.num_serie',$num_serie)
                    ->where('tv.num_documento',$num_documento)
                    ->get('tventa tv');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getDetallesComprobante($num_serie,$num_documento){
        $q = $this->db->select('tdv.*, ti.*, tm.nombre as medida, tm.codigo')
                    ->join('items ti','ti.id = tdv.id_item')
                    ->join('tmedida tm','tm.id = ti.medida_id')
                    ->where('tdv.num_serie',$num_serie)
                    ->where('tdv.num_documento',$num_documento)
                    ->get('tdetalleventa tdv');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getCuotasDeuda($id_pagos){
        $q = $this->db->select()
                    //->join('items ti','ti.id = tdv.id_item')
                    ->where('Pagos_id',$id_pagos)
                    ->where('Estado',0)
                    //->where('tdv.num_documento',$num_documento)
                    ->get('cuota');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function updateCredito($id_pagos){
        $this->db->where('id',$id_pagos)->update('pagos',['Estado'=>1]);
    }

    public function getComprobanteBoletas($id_usario = 0,$where){
        $q = $this->db->select('tv.*, concat(pr.apellidos," ",pr.nombres) as cliente')
                    ->join('persona pr','pr.id = tv.persona_id')
                    ->where($where)
                    /*->where('Pagos_id',$id_pagos)
                    ->where('Estado',0)*/
                    ->where('tv.cod_doc','03');
        if($id_usario != 0)
            $this->db->where('tv.usuario_id',$id_usario);
        $q = $this->db->get('tventa tv');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getComprobanteFacturas($id_usario = 0,$where){
        $q = $this->db->select('tv.*, ep.razon_social as cliente')
                    ->join('empresa ep','ep.id = tv.empresa_id')
                    ->where($where)
                    /*->where('Pagos_id',$id_pagos)
                    ->where('Estado',0)*/
                    ->where('tv.cod_doc','01');
        if($id_usario != 0)
            $this->db->where('tv.usuario_id',$id_usario);
        $q = $this->db->get('tventa tv');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }
    public function getNotasCredito($id_usario = 0,$where){
        $q = $this->db->select('tn.*, concat(pr.apellidos," ",pr.nombres) as cliente')
                    ->join('persona pr','pr.id = tn.id_persona')
                    ->where($where)
                    /*->where('Pagos_id',$id_pagos)
                    ->where('Estado',0)*/
                    ->where('tn.cod_doc','07');
        if($id_usario != 0)
            $this->db->where('tn.id_usuario',$id_usario);
        $q = $this->db->get('tnota tn');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getComprobanteProvisionales($id_usario= 0, $where){
        $db = $this->load->database('backup',TRUE);
        $q = $db->select('tv.*, concat(pr.apellidos," ",pr.nombres) as cliente')
                    ->join('persona pr','pr.id = tv.persona_id')
                    ->where($where)
                    /*->where('Pagos_id',$id_pagos)
                    ->where('Estado',0)*/
                    ->where('tv.usuario_id',$id_usario)
                    ->where('tv.cod_doc','99')
                    ->get('tventa tv');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getComprobanteProvisionalUsuario($id_usario = 0,$where){
        $db = $this->load->database('backup',TRUE);
        $db->select('tv.*, sd.Descripcion as sede')
                    ->where($where)
                    //->join('persona pr','pr.id = tv.persona_id')
                    //->join('alumno a','a.persona_id = pr.id','left')
                    //->join('area ar','ar.id = a.Area_id','left')
                    ->join('sedes sd','sd.id = tv.sede_id');
                    //->join('usuario u','u.id = tv.usuario_id');
        $db->where_in('tv.cod_doc',['99']);
        if($id_usario != 0)
            $db->where('tv.usuario_id',$id_usario);
        $q = $db->get('tventa tv');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getComprobanteBoletasUsuario($id_usario = 0,$where){
        $this->db->select('tv.*, concat(pr.apellidos," ",pr.nombres) as cliente, sd.Descripcion as sede, u.usuario, ar.Descripcion as area')
                    ->where($where)
                    ->join('persona pr','pr.id = tv.persona_id')
                    ->join('alumno a','a.persona_id = pr.id','left')
                    ->join('area ar','ar.id = a.Area_id','left')
                    ->join('sedes sd','sd.id = tv.sede_id')
                    ->join('usuario u','u.id = tv.usuario_id');
        $this->db->where_in('tv.cod_doc',['03']);
        if($id_usario != 0)
            $this->db->where('tv.usuario_id',$id_usario);
        $q = $this->db->get('tventa tv');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getComprobanteFacturasUsuario($id_usario = 0,$where){
        $q = $this->db->select('tv.*, ep.razon_social as cliente, sd.Descripcion as sede, u.usuario')
                    ->join('empresa ep','ep.id = tv.empresa_id')
                    ->join('sedes sd','sd.id = tv.sede_id')
                    ->join('usuario u','u.id = tv.usuario_id')
                    ->where($where)
                    /*->where('Pagos_id',$id_pagos)*/
                    ->where('tv.cod_doc','01');
        if($id_usario != 0)
            $this->db->where('tv.usuario_id',$id_usario);
        $q = $this->db->get('tventa tv');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function searchClienteRuc($ruc = ''){
        $q = $this->db->select('tp.*, ti.nroidentificacion as ruc')
                    ->join('identificacion ti','ti.empresa_id = tp.id')
                    ->where('tp.id != 1')
                    ->where('tp.estado',1)
                    ->where("ti.nroidentificacion like '%".$ruc."%'")
                    ->get('empresa tp');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function searchCliente($razon = ''){
        $q = $this->db->select('tp.*, ti.nroidentificacion as ruc')
                    ->join('identificacion ti','ti.empresa_id = tp.id')
                    ->where('tp.id != 1')
                    ->where('tp.estado',1)
                    ->where("tp.razon_social like '%".$razon."%'")
                    ->get('empresa tp');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function searchCatalogo($nombre = ''){
        $q = $this->db->select()
                    ->where("tc.nombre like '%".$nombre."%'")
                    ->limit(20)
                    ->get('tcatalogo tc');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getLastMatricula($alumno_id){
        $q = $this->db->select('tv.Boleta_Inicial, tv.Fecha_Pago_Inicial')
                    ->where('Alumno_id',$alumno_id)
                    ->limit(20)
                    ->order_by('tv.Fecha_Pago_Inicial','desc')
                    ->limit(1)
                    ->get('pagos tv');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getComprobantes(){
        $q = $this->db->select('num_serie,num_documento,cod_doc')
                    ->where_in(['01','03'])
                    ->get('tventa');

        $numComprobantes = ($q->num_rows())?$q->num_rows():0;
        return $numComprobantes;
    }

    public function getPagos($where){
        $q = $this->db->select('id')
                    ->where($where)
                    ->get('pagos');

        $numComprobantes = ($q->num_rows())?$q->num_rows():0;
        return $numComprobantes;
    }

    public function searchItemComprobante($num_serie,$num_documento,$id_item){
        $q = $this->db->select('tdv.*, i.descripcion, i.cod_catalogo, i.tipo, i.stock, i.estado, i.medida_id')
                    ->join('items i','i.id = tdv.id_item')
                    ->where('tdv.num_serie',$num_serie)
                    ->where('tdv.num_documento',$num_documento)
                    ->where('tdv.id_item',$id_item)
                    ->get('tdetalleventa tdv');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getBajas($fecha){
        $q = $this->db->query("select count(cod_doc) as bajas from tbajas where fecha like '%".$fecha."%';");
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getComprobantesEnvia($where){
        $q = $this->db->select()
                    ->where('estado',1)
                    //->where_in('tv.cod_doc',['03','01'])
                    ->where($where)
                    ->order_by('tv.fecha');
        $q = $this->db->get('tventa tv');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function searchProducto($data = ''){
        $q = $this->db->select('ti.*, tt.precio, tm.nombre as medida')
                    ->join('ttarifa tt','tt.iditem = ti.id')
                    ->join('tmedida tm','ti.medida_id = tm.id')
                    ->where('tt.id_empresa = 1')
                    ->where('tt.estado = 1')
                    ->where("ti.descripcion like '%".$data."%'")
                    ->get('items ti');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getTotalPagosContado($id_sede, $fecha = ''){
        /*if($fecha == '')
            $fecha = date('Y-m');*/
        $this->db->select_sum('p.Monto')
                    ->join('pagos p','p.Alumno_id = a.id')
                    ->where('a.estado',1)
                    ->where('a.sede_id',$id_sede)
                    ->where('p.Estado',1)
                    ->where('p.Tipo_pago',1);
        if($fecha != '')
            $this->db->like("p.Fecha_Pago_Inicial",date('Y-m'),'after');
        $q = $this->db->get('alumno a');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getTotalCuotasPagadas($id_sede,$fecha = ''){
        $this->db->select_sum('p.Monto')
                    ->join('pagos p','p.Alumno_id = a.id')
                    ->join('cuota c','c.Pagos_id = p.id')
                    ->where('a.estado',1)
                    ->where('a.sede_id',$id_sede)
                    ->where('c.Estado',1)
                    ->where('p.Tipo_pago',0);
        if($fecha != '')
            $this->db->like("p.Fecha_Pago_Inicial",date('Y-m'),'after');
        $q = $this->db->get('alumno a');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getTotalDeudas($id_sede){
        $q = $this->db->select_sum('p.Monto')
                    ->join('pagos p','p.Alumno_id = a.id')
                    ->join('cuota c','c.Pagos_id = p.id')
                    ->where('a.estado',1)
                    ->where('a.sede_id',$id_sede)
                    ->where('c.Estado',0)
                    ->where('p.Tipo_pago',0)
                    //->like("p.Fecha_Pago_Inicial",date('Y-m'),'after')
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

}