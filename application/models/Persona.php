<?php
class Persona extends CI_Model {

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function newPersona($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('persona',$datos);
        $id = $this->db->insert_id();
        return $id;
    }

    public function updatePersona($data,$id){
        $this->db->where('id',$id)->update('persona',$data);
    }
    
    public function newIdentificacion($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('identificacion',$datos);
        $id = $this->db->insert_id();
        return $id;
    }

    public function updateIdentificacion($data,$persona_id){
        $this->db->where('persona_id',$persona_id)->update('identificacion',$data);
    }

    public function newAlumno($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('alumno',$datos);
        $id = $this->db->insert_id();
        return $id;
    }

    public function searchClienteDni($dni = ''){
        $q = $this->db->select('tp.*, ti.nroidentificacion as dni, a.codigo')
                    ->join('identificacion ti','ti.persona_id = tp.id')
                    ->join('alumno a','a.persona_id = tp.id')
                    ->where('tp.id != 1')
                    ->where('tp.estado',1)
                    ->where("ti.nroidentificacion like '%".$dni."%'")
                    ->get('persona tp');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function searchClienteNameApell($nombres = '', $apellidos = ''){
        $q = $this->db->select('tp.*, ti.nroidentificacion as dni, a.codigo')
                    ->join('identificacion ti','ti.persona_id = tp.id')
                    ->join('alumno a','a.persona_id = tp.id')
                    ->where('tp.id != 1')
                    ->where('tp.estado',1)
                    ->where("tp.nombres like '%".$nombres."%'")
                    ->where("tp.apellidos like '%".$apellidos."%'")
                    ->get('persona tp');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function searchCliente($apell = ''){
        $q = $this->db->select('tp.*, ti.nroidentificacion as dni, a.codigo')
                    ->join('identificacion ti','ti.persona_id = tp.id')
                    ->join('alumno a','a.persona_id = tp.id')
                    ->where('tp.id != 1')
                    ->where('tp.estado',1)
                    ->where("tp.apellidos like '%".$apell."%'")
                    ->get('persona tp');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getAllPersona(){
        $q = $this->db->select('p.id, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, concat(p.apellidos," ",p.nombres) as persona, p.direccion, p.email, p.fch_nac, p.telefono, p.estado')
                    ->join('tipo_identificacion ti','ti.id = i.tipo_identificacion_id')
                    ->join('persona p','p.id = i.persona_id')
                    ->get('identificacion i');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getPersona($nroidentificacion){
        $q = $this->db->select('ti.abrev as Documento, i.nroidentificacion as Numero, p.id, concat(p.apellidos," ",p.nombres) as persona, p.direccion, p.email, p.fch_nac, p.telefono, p.estado')
                    ->join('tipo_identificacion ti','ti.id = i.tipo_identificacion_id')
                    ->join('persona p','p.id = i.persona_id')
                    ->where('i.nroidentificacion',$nroidentificacion)
                    ->get('identificacion i');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }   

    public function getArea(){
        $q = $this->db->select();                  
        $this->db->order_by('descripcion');    
        $q = $this->db->get('area');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getAreaForId($id){
        $this->db->select();                  
        $this->db->where('id',$id);    
        $q = $this->db->get('area');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    } 

    /**
     * Permite actualizar un area especifica
     *
     * @param Array $data
     * @param int $id
     * @return void
     */
    public function updateArea($data,$id){
        $this->db->where('id',$id)->update('area',$data);
    }

    /**
     * Permite registrar una nueva area
     *
     * @param array $datos
     * @return void
     */
    public function newArea($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('area',$datos);
        $id = $this->db->insert_id();
        return $id;
    }

    public function getAreaCodigo($id_sede, $id_ciclo){
        $q = $this->db->select('ar.id, ar.Descripcion, ca.codigo')
                      ->join('area ar','ar.id = ca.area_id')
                      ->where('sede_id',$id_sede) 
                      ->where('ciclo_id',$id_ciclo) 
                      ->order_by('ar.descripcion') 
                      ->get('ciclo_area ca');                       
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    } 
    
    public function getCiclos($id_sede){
        $q = $this->db->select('c.*')
                      ->distinct()
                      ->join('ciclo_area ca','c.id = ca.ciclo_id')
                      ->where('ca.sede_id',$id_sede)
                    ->get('ciclo c');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }
    
    public function getTurno(){
        $q = $this->db->select()
                    ->get('turno');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    } 

    public function getPersonaForId($id){
        $q = $this->db->select('ti.abrev as Documento, i.nroidentificacion as Numero, i.nroidentificacion, p.id, concat(p.apellidos," ",p.nombres) as persona, p.nombres, p.apellidos, p.direccion, p.email, p.fch_nac, p.telefono, p.estado')
                    ->join('tipo_identificacion ti','ti.id = i.tipo_identificacion_id')
                    ->join('persona p','p.id = i.persona_id')
                    ->where('p.id',$id)
                    ->get('identificacion i');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    } 

    public function getPersonaForId2($id){
        $q = $this->db->select('p.id, concat(p.apellidos," ",p.nombres) as persona, p.nombres, p.apellidos, p.direccion, p.email, p.fch_nac, p.telefono, p.estado')
                    //->join('tipo_identificacion ti','ti.id = i.tipo_identificacion_id')
                    //->join('persona p','p.id = i.persona_id')
                    ->where('p.id',$id)
                    ->get('persona p');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    } 

    public function getIdentificacion($id_persona){
        $q = $this->db->select('i.nroidentificacion as dni')
                    ->where('i.persona_id',$id_persona)
                    ->where('i.tipo_identificacion_id',2)
                    ->get('identificacion i');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }
}
