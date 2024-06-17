<?php
class Front extends CI_Model {

	public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function getPortadas(){
    	$q = $this->db->select('')
                    //->where('tu.estado',1)
                    ->get('tportadas tu');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function newPortada($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('tportadas',$datos);
        $id = $this->db->insert_id();
        return $id;
    }

    public function updatePortada($data = array(),$id = 0){
        $this->db->where('id',$id)->update('tportadas',$data);
    }

    public function deletePortada($id){
    	$this->db->where('id',$id)->delete('tportadas');
    }

    public function newVideo($datos = array()){
    	if(count($datos) == 0)
            return 0;
        $this->db->insert('tvideos',$datos);
        $id = $this->db->insert_id();
        return $id;
    }

    public function updateVideoPortada($data = array(),$id = 0){
        $this->db->where('id',$id)->update('tvideos',$data);
    }

    public function getVideos(){
    	$q = $this->db->select('')
                    //->where('tu.estado',1)
                    ->get('tvideos tu');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getVideoWhere($where = array()){
    	$q = $this->db->select('')
                    ->where($where)
                    ->get('tvideos');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }
}