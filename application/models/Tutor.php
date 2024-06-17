<?php
class Tutor extends CI_Model {

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function newTutor($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('tutor',$datos);
        $id = $this->db->insert_id();
        return $id;
    }
    public function getAllTutor(){
        $q = $this->db->select('Select tt.id,concat(p.apellidos," ",p.nombres) as Tutor, p.direccion, p.email, p.fch_nac, p.telefono, p.sexo, p.estado, concat(pe.nombres," ",pe.apellidos) as Alumno')
                    ->join('persona p','p.id = tt.persona_id')
                    ->join('alumno a','a.Tutor_id = tt.id')
                    ->join('persona pe','pe.id = a.persona_id')
                    ->get('tutor tt');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }
    public function getTutor($codigo){
        $q = $this->db->select('Select tt.id,concat(p.apellidos," ",p.nombres) as Tutor, p.direccion, p.email, p.fch_nac, p.telefono, p.sexo, p.estado, concat(pe.nombres," ",pe.apellidos) as Alumno')
                    ->join('persona p','p.id = tt.persona_id')
                    ->join('alumno a','a.Tutor_id = tt.id')
                    ->join('persona pe','pe.id = a.persona_id')
                    ->where('a.codigo',$codigo)
                    ->get('tutor tt');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }    
}