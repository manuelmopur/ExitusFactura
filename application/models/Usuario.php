<?php
class Usuario extends CI_Model {

	public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function newUsuario($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('usuario',$datos);
        $id = $this->db->insert_id();
        return $id;
    }

    public function updateUsuario($data,$id){
        $this->db->where('id',$id)->update('usuario',$data);
    }

    public function newPersona($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('persona',$datos);
        $id = $this->db->insert_id();
        return $id;
    }

    public function getUsuarios(){
        $q = $this->db->select('tp.*, tr.*, tu.*, tp.id as id_persona, tu.id as id_usuario, sd.Descripcion as sede')
                    ->join('persona tp','tp.id = tu.persona_id')
                    ->join('roles tr','tr.id = tu.rol_id')
                    ->join('sedes sd','sd.id = tu.sede_id')
                    //->where('tu.usuario',$user)
                    ->get('usuario tu');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getUsuario($user){
        $q = $this->db->select('tu.*, tp.nombres, tp.apellidos, tp.direccion, tp.email, tp.fch_nac, tp.telefono, tu.estado')
                    ->join('persona tp','tp.id = tu.persona_id')
                    ->where('tu.usuario',$user)
                    ->get('usuario tu');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getUsuarioWithEmail($email){
        $q = $this->db->select('tu.*, tp.nombres, tp.apellidos, tp.direccion, tp.email, tp.fch_nac, tp.telefono, tu.estado')
                    ->join('persona tp','tp.id = tu.persona_id')
                    ->where('tp.email',$email)
                    ->where('tu.estado',1)
                    ->get('usuario tu');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }
    

    public function getUsuarioForId($id){
        $q = $this->db->select('tu.*, tp.nombres, tp.apellidos, tp.direccion, tp.email, tp.fch_nac, tp.telefono, tp.estado')
                    ->join('persona tp','tp.id = tu.persona_id')
                    ->where('tu.id',$id)
                    ->get('usuario tu');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getPermisos($id_rol){
        $q = $this->db->select('m.nombre, m.logo, m.route')
                    ->join('permisos p','p.menu_id = m.id')
                    ->where('p.rol_id',$id_rol)
                    ->where('m.estado',1)
                    ->get('menu m');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getRoles(){
        $q = $this->db->select()
                    ->get('roles');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }
    public function getPersonaId($id_usuario){
        $q = $this->db->select('persona_id')
                    ->where('id',$id_usuario)
                    ->get('usuario');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }
}