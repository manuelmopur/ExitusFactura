<?php
class Utils extends CI_Model {

	public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function getMedida($id = 0){
        $q = $this->db->select('')
                    ->where('ti.id',$id)
                    ->get('tmedida ti');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getCiclo($id){
        $q = $this->db->select()
                    ->where('id',$id)
                    ->get('ciclo');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getTurnos(){
        $q = $this->db->select()
                    ->get('turno');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getSedes(){
        $q = $this->db->select()
                    ->get('sedes');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getSede($id){
        $q = $this->db->select()
                    ->where('id',$id)
                    ->get('sedes');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getDepartamentos(){
    	$q = $this->db->select()
    				->get('tdepartamento');
    	$res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getDepartamento($where = array()){
        $q = $this->db->select()
                    ->where($where)
                    ->get('tdepartamento');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getProvincias($id_dep = 0){
    	$q = $this->db->select()
    				->where('id_dep',$id_dep)
    				->get('tprovincia');
    	$res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getProvincia($where = array()){
        $q = $this->db->select()
                    ->where($where)
                    ->get('tprovincia');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getDistritos($id_prov = 0){
    	$q = $this->db->select()
    				->where('id_prov',$id_prov)
    				->get('tdistrito');
    	$res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getDistrito($where = array()){
        $q = $this->db->select()
                    ->where($where)
                    ->get('tdistrito');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getTiposDocumento(){
        $q = $this->db->select()
                    ->get('tipo_identificacion');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getMedidas(){
        $q = $this->db->select()
                    ->get('tmedida');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }
}