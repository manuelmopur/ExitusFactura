<?php
class Alumno extends CI_Model {

	public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function newAlumno($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('alumno',$datos);
        $id = $this->db->insert_id();
        return $id;
    }
    public function newExamen($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('examen',$datos);
        $id = $this->db->insert_id();
        return $id;
    }
    public function newExamenDetalle($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('examen_detalle',$datos);
        $id = $this->db->insert_id();
        return $id;
    }
    public function newComentario($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('comentarios',$datos);
        $id = $this->db->insert_id();
        return $id;
    }
    public function updateAlumno($data,$id){
        $this->db->where('id',$id)->update('alumno',$data);
    }
    public function updateCarnetsImpreso($ids = array()){
        $this->db->where_in('id',$ids)->update('alumno',['carnet_impreso'=>1]);
    }
    public function generaCodigo($id_alumno, $id_area){
        $this->db->query("CALL genera_codigo_alumno(".$id_alumno.",".$id_area.");");
    }
    public function getAlumno($id){
        $q = $this->db->select('a.id, a.codigo, a.colegio, a.foto, a.ciclo_id, a.Area_id, ci.descripcion as ciclo, ar.descripcion as area, t.descripcion as turno, p.apellidos, p.nombres, p.direccion, p.email, p.fch_nac, p.telefono, p.estado, i.nroidentificacion, p.id as persona_id, a.Grupo fch_inicio, a.Grupo_fin fch_fin, a.sede_id, a.estado_asistencia, a.Foto')
                    ->join('persona p','p.id = a.persona_id')
                    ->join('identificacion i','i.persona_id = p.id')
                    ->join('ciclo ci','ci.id = a.ciclo_id')
                    ->join('area ar','ar.id = a.area_id')
                    ->join('turno t','t.id = a.turno_id')
                    ->where('a.id',$id)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getComentarios($id){
        $q = $this->db->select('c.id, c.usuario_id, c.alumno_id, concat(p.apellidos," ", p.nombres) as Profesor, c.Fecha, c.Comentario')
                    ->join('usuario u','u.id = c.usuario_id')
                    ->join('persona p','p.id = u.persona_id')
                    ->where('alumno_id',$id)
                    ->get('comentarios c');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getFaltas($id){
        $q = $this->db->select('f.id, f.id_alumno, f.Fecha, f.Estado, f.Justificacion, f.usuario_id, u.usuario as Auxiliar')
                    ->join('usuario u','u.id = f.usuario_id')
                    ->where('id_alumno',$id)
                    ->get('tasistencia f');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getFaltasDetalle($id){
        $q = $this->db->select('f.id, f.id_alumno, f.Fecha, f.Estado, f.Justificacion')
                    ->where('id',$id)
                    ->get('tasistencia f');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getNotas($id){
        $q = $this->db->select('te.descripcion, e.fecha, ed.respuestas_buenas as buenas, ed.respuestas_malas as malas, ed.puntaje, ed.nota, ed.ubicacion')
                    ->join('examen e','e.id = ed.examen_id')
                    ->join('tipo_examen te','te.id = e.tipo_examen_id')
                    ->where('ed.alumno_id',$id)
                    ->get('examen_detalle ed');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getExamen($id_examen){
        $q = $this->db->select('te.descripcion, e.fecha, s.Descripcion as sede, c.Descripcion as ciclo, ar.Descripcion as area, t.descripcion as turno')
                    ->join('tipo_examen te','te.id = e.tipo_examen_id')
                    ->join('sedes s','s.id = e.sede_id')
                    ->join('ciclo c','c.id = e.ciclo_id')
                    ->join('area ar','ar.id = e.area_id')
                    ->join('turno t','t.id = e.turno_id')
                    ->where('e.id',$id_examen)
                    ->get('examen e');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getNotasDetalle($id_examen){
        $q = $this->db->select('a.codigo, concat(p.apellidos," ",p.nombres) as persona, ed.*')
                    ->join('alumno a','a.id = ed.alumno_id')
                    ->join('persona p','p.id = a.persona_id')
                    ->where('ed.examen_id',$id_examen)
                    ->get('examen_detalle ed');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getExamenesWhere($where, $areas = array()){
        $q = $this->db->select('te.descripcion, e.id, e.fecha, ar.Descripcion as area')
                    ->where($where)
                    ->where_in('e.area_id',$areas)
                    ->join('tipo_examen te','te.id = e.tipo_examen_id')
                    ->join('area ar','ar.id = e.area_id')
                    ->get('examen e');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getTiposExamen(){
        $q = $this->db->select();                  
        $this->db->order_by('descripcion');    
        $q = $this->db->get('tipo_examen');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getComentarioDetalle($id){
        $q = $this->db->select('c.id, c.usuario_id, c.alumno_id, c as Profesor, c.Fecha, c.Comentario')
                    ->join('usuario u','u.id = c.usuario_id')
                    ->join('persona p','p.id = u.persona_id')
                    ->where('c.id',$id)
                    ->get('comentarios c');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function updateComentario($data,$where){
        $this->db->where($where)->update('comentarios',$data);
    }

    public function updateAsistencia($data,$where){
        $this->db->where($where)->update('tasistencia',$data);
    }


    public function getAlumnoWhere($where){
        $q = $this->db->select('a.id as id_alumno, a.codigo, a.colegio, a.foto, a.Grupo as grupo, a.Grupo_fin as grupo_fin, ar.descripcion as area, ci.Descripcion as ciclo, t.descripcion as turno, p.apellidos, p.nombres, p.direccion, p.email, p.fch_nac, p.telefono, p.estado, i.nroidentificacion, p.id as persona_id, a.Area_id, a.sede_id')
                    ->join('persona p','p.id = a.persona_id')
                    ->join('identificacion i','i.persona_id = p.id')
                    ->join('area ar','ar.id = a.area_id')
                    ->join('ciclo ci','ci.id = a.ciclo_id')
                    ->join('turno t','t.id = a.turno_id')
                    ->where($where)
                    ->where('a.estado',1)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getAlumnoWhereFoto($where){
        $q = $this->db->select('a.id as id_alumno, a.codigo, a.colegio, a.foto, a.Grupo as grupo, a.Grupo_fin as grupo_fin, a.carnet_impreso, ar.descripcion as area, ci.Descripcion as ciclo, t.descripcion as turno, p.apellidos, p.nombres, p.direccion, p.email, p.fch_nac, p.telefono, p.estado, i.nroidentificacion, p.id as persona_id, a.Area_id, a.sede_id')
                    ->join('persona p','p.id = a.persona_id')
                    ->join('identificacion i','i.persona_id = p.id')
                    ->join('area ar','ar.id = a.area_id')
                    ->join('ciclo ci','ci.id = a.ciclo_id')
                    ->join('turno t','t.id = a.turno_id')
                    ->where($where)
                    ->where('a.foto is not null')
                    ->where('a.estado',1)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getAllAlumno(){
        $q = $this->db->select('a.id, a.codigo, a.colegio, a.foto, ar.descripcion as area, t.descripcion as turno, p.apellidos, p.nombres, p.direccion, p.email, p.fch_nac, p.telefono, p.estado')
                    ->join('persona p','p.id = a.persona_id')
                    ->join('area ar','ar.id = a.area_id')
                    ->join('turno t','t.id = a.turno_id')
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getAlumnos(){
        $q = $this->db->select('p.id, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, concat(p.apellidos," ",p.nombres) as persona, a.codigo, p.direccion, p.email, p.fch_nac, p.telefono, p.estado, a.id as id_alumno, ar.Descripcion as area')
                    ->join('persona p','p.id = a.persona_id')
                    ->join('identificacion i','i.persona_id = p.id')
                    ->join('tipo_identificacion ti','ti.id = i.tipo_identificacion_id')
                    ->join('area ar','ar.id = a.Area_id')
                    ->where('a.estado',1)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getAlumnosSede($id_sede = 0){
        $q = $this->db->select('p.id, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, p.apellidos, p.nombres, concat(p.apellidos," ",p.nombres) as persona, a.codigo, a.Grupo as grupo, a.Grupo_fin as grupo_fin, p.direccion, p.email, p.fch_nac, p.telefono, p.estado, a.id as id_alumno, ar.Descripcion as area, ci.Descripcion as ciclo, t.descripcion as turno')
                    ->join('persona p','p.id = a.persona_id')
                    ->join('identificacion i','i.persona_id = p.id')
                    ->join('tipo_identificacion ti','ti.id = i.tipo_identificacion_id')
                    ->join('area ar','ar.id = a.Area_id')
                    ->join('ciclo ci','ci.id = a.ciclo_id')
                    ->join('turno t','t.id = a.Turno_id')                    
                    ->where('a.estado',1)
                    ->where('a.estadia',1);
        if($id_sede != 0)
            $this->db->where('a.sede_id',$id_sede);
        $q = $this->db->get('alumno a');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getAlumnosBy($ciclo_id, $area_id){
        $q = $this->db->select('p.id, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, concat(p.apellidos," ",p.nombres) as persona, a.codigo, p.direccion, p.email, p.fch_nac, p.telefono, p.estado, a.id as id_alumno, ar.Descripcion as area')
                    ->join('persona p','p.id = a.persona_id')
                    ->join('identificacion i','i.persona_id = p.id')
                    ->join('tipo_identificacion ti','ti.id = i.tipo_identificacion_id')
                    ->join('area ar','ar.id = a.Area_id')
                    ->where('a.estado = 1 and ciclo_id = '.$ciclo_id.' and area_id = '.$area_id)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getAlumnosPre(){
        $q = $this->db->select('p.id as id_persona, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, concat(p.apellidos," ",p.nombres) as persona, p.direccion, p.email, p.fch_nac, p.telefono, p.estado, a.id as id_alumno, a.fch_inscripcion')
                    ->join('persona p','p.id = a.persona_id')
                    ->join('identificacion i','i.persona_id = p.id')
                    ->join('tipo_identificacion ti','ti.id = i.tipo_identificacion_id')
                    ->where('a.estado',0)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getAlumnosPre_(){
        $q = $this->db->select('p.id as id_persona, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, concat(p.apellidos," ",p.nombres) as persona, p.direccion, p.email, p.fch_nac, p.telefono, p.estado, a.id as id_alumno')
                    ->join('persona p','p.id = a.persona_id')
                    ->join('identificacion i','i.persona_id = p.id')
                    ->join('tipo_identificacion ti','ti.id = i.tipo_identificacion_id')
                    ->where('a.estado',1)
                    ->where('a.ciclo_id >= 8')
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getAlumnoPre($id_alumno){
        $q = $this->db->select('p.id, concat(ti.abrev, " : ", i.nroidentificacion) as identificacion, concat(p.apellidos," ",p.nombres) as persona, p.direccion, p.email, p.fch_nac, p.telefono, p.estado, a.id as id_alumno, p.nombres, p.apellidos, i.nroidentificacion, a.Colegio as colegio, a.Grupo as grupo, a.Area_id as area_id, a.ciclo_id as ciclo_id, a.turno_id as turno_id, ar.Descripcion as area, a.estado as estado_alumno, a.codigo as cod_alumno, a.Grupo_fin')
                    ->join('persona p','p.id = a.persona_id')
                    ->join('identificacion i','i.persona_id = p.id')
                    ->join('tipo_identificacion ti','ti.id = i.tipo_identificacion_id')
                    ->join('area ar','ar.id = a.Area_id')
                    ->where('a.id',$id_alumno)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getAlumnoPersona($persona_id){
        $q = $this->db->select('a.id as id_alumno, a.codigo, a.colegio, a.foto, a.Grupo as grupo, a.Grupo_fin as grupo_fin, ar.descripcion as area, concat(p.apellidos," ",p.nombres) as persona, p.apellidos, p.nombres, p.direccion, p.email, p.fch_nac, p.telefono, p.estado, i.nroidentificacion, p.id as persona_id, a.Area_id, a.sede_id')
                    ->join('persona p','p.id = a.persona_id')
                    ->join('identificacion i','i.persona_id = p.id')
                    ->join('tipo_identificacion ti','ti.id = i.tipo_identificacion_id')
                    ->join('area ar','ar.id = a.Area_id','left')
                    ->where('a.persona_id',$persona_id)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getTutor($id_alumno){
        $q = $this->db->select('a.id, a.Tutor_id as tutor_id, p.apellidos, p.nombres, p.telefono, p.email, i.nroidentificacion')
                    ->join('tutor tu','tu.id = a.Tutor_id')
                    ->join('persona p','p.id = tu.persona_id')
                    ->join('identificacion i','i.persona_id = p.id')
                    ->where('a.id',$id_alumno)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }
    public function getAlumnosForCodigo($codigo){
        $q = $this->db->select('a.id as id_alumno, p.apellidos, p.nombres, a.codigo')
                    ->join('persona p','p.id = a.persona_id')
                    ->like('a.codigo',$codigo,'both')
                    ->where('a.estado',1)   
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }
    public function getAlumnosActualForCodigo($codigo){
        $q = $this->db->select('a.id as id_alumno, p.apellidos, p.nombres, a.codigo')
                    ->join('persona p','p.id = a.persona_id')
                    ->like('a.codigo',$codigo,'both')
                    ->where('a.estadia',1)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getAlumnoForFicha($codigo){
        $q = $this->db->select('a.*, a.id as id_alumno, p.apellidos, p.nombres, a.codigo, p.email, p.direccion, p.telefono')
                    ->join('persona p','p.id = a.persona_id')
                    //->join('identificacion i','i.persona_id = p.id')
                    ->where('a.codigo',$codigo)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getAlumnoForFichaId($id = 0){
        $q = $this->db->select('a.*, a.id as id_alumno, p.apellidos, p.nombres, a.codigo, p.email, p.direccion, p.telefono')
                    ->join('persona p','p.id = a.persona_id')
                    //->join('identificacion i','i.persona_id = p.id')
                    ->where('a.id',$id)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getAlumnosNombreorApellidos($data){
        $q = $this->db->select('a.id as id_alumno, p.apellidos, p.nombres, a.codigo')
                    ->join('persona p','p.id = a.persona_id')
                    ->like('p.apellidos',$data,'both')
                    ->where('a.estado',1)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }
    public function getAlumnosActualNombreorApellidos($data){
        $q = $this->db->select('a.id as id_alumno, p.apellidos, p.nombres, a.codigo')
                    ->join('persona p','p.id = a.persona_id')
                    ->like('p.apellidos',$data,'both')
                    ->where('a.estado',1)
                    ->where('a.estadia',1)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }
    public function getPersonaId($id_alumno){
        $q = $this->db->select('persona_id')
                    ->where('id',$id_alumno)
                    ->get('alumno');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getAlumnoForPersonaId($id_persona){
        $q = $this->db->select('*')
                    ->where('persona_id',$id_persona)
                    ->get('alumno');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getPersonaTutorId($id_alumno){
        $q = $this->db->select('t.persona_id')
                    ->join('alumno a','t.id = a.Tutor_id')
                    ->where('a.id',$id_alumno)
                    ->get('tutor t');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }
    public function updateAreas($descripcion, $codigo){
        $this->db->where('descripcion',$descripcion);
        $this->db->set('codigo', $codigo);
        return $this->db->update('area');
    }
    public function newCiclo($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('ciclo',$datos);
        $id = $this->db->insert_id();
        return $id;
    }
    public function newCicloArea($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('ciclo_area',$datos);
        $id = $this->db->insert_id();
        return $id;
    }

    public function getCountAlumnos($where){
        $q = $this->db->select('id')
                    ->where($where)
                    ->get('alumno');

        $numAlumnos = ($q->num_rows())?$q->num_rows():0;
        return $numAlumnos;
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }
    public function getAreasID(){
        $q = $this->db->select('id')
                    ->get('area');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getAreaForId($id){
        $q = $this->db->select()
                    ->where('id',$id)
                    ->get('area');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }
    public function getAreaForAlumnoId($id_alumno){
        $q = $this->db->select('Area_id as area')
                    ->where('id',$id_alumno)
                    ->get('alumno');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }
    public function getCicloForAlumnoId($id_alumno){
        $q = $this->db->select('ciclo_id as ciclo')
                    ->where('id',$id_alumno)
                    ->get('alumno');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getTurnoForId($id){
        $q = $this->db->select()
                    ->where('id',$id)
                    ->get('turno');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getCicloForId($id){
        $q = $this->db->select()
                    ->where('id',$id)
                    ->get('ciclo');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function getAlumnosWhere($where){
        $q = $this->db->select()
                    ->where($where)
                    ->where("codigo != ''")
                    ->get('alumno');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getAlumnosWhereAsistencia($where){
        $q = $this->db->select()
                    ->where($where)
                    ->where("codigo != ''")
                    ->get('alumno');
        //$res = $q->result();
        $num_registros = ($q->num_rows())?$q->num_rows():0;
        return $num_registros;
        if($res)
            return $res;
        else
            return 0;
    }

    public function newFalta($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('tasistencia',$datos);
        $id = $this->db->insert_id();
        return $id;
    }

    public function getFaltaWhere($where){
        $q = $this->db->select()
                    ->where($where)
                    ->get('tasistencia');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    public function updateAlumnoWithoutWhere($data){
        $this->db->update('alumno',$data);
    }

    public function getAlumnosInfoWhere($where,$areas = array()){
        $q = $this->db->select('a.*, p.nombres, p.apellidos, ar.Descripcion as area, s.Descripcion as sede, t.descripcion as turno')
                    ->where($where)
                    ->where_in('a.Area_id',$areas)
                    ->join('persona p','p.id = a.persona_id')
                    ->join('area ar','ar.id = a.Area_id')
                    ->join('sedes s','s.id = a.sede_id')
                    ->join('turno t','t.id = a.Turno_id')
                    ->where('a.estadia',1)
                    ->where('a.estado',1)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getAlumnosInfoWhere2($where){
        $q = $this->db->select('a.*, p.nombres, p.apellidos, ar.Descripcion as area, s.Descripcion as sede, tas.estado, tas.fecha')
                    ->where($where)
                    ->join('persona p','p.id = a.persona_id')
                    ->join('area ar','ar.id = a.Area_id')
                    ->join('sedes s','s.id = a.sede_id')
                    ->join('tasistencia tas','tas.id_alumno = a.id','left')
                    ->where('a.estadia',1)
                    ->where('a.estado',1)
                    ->get('alumno a');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }

    public function getFalta($where){
        $q = $this->db->select()
                    ->where($where)
                    ->get('tasistencia');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }
    public function getCountFalta($where){
        $q = $this->db->select('id')
                    ->where($where)
                    ->get('tasistencia');
        $res = ($q->num_rows())?$q->num_rows():0;    
        return $res;
    }

    public function getCicloActual(){
        $q = $this->db->select()
                    //->where($where)
                    ->order_by('Fecha_Inicio','desc')
                    ->get('ciclo');
        $res = $q->result();
        if($res)
            return $res[0];
        else
            return 0;
    }

    ///ingreso de imagenes en la inscripcion
    public function newImagen($datos = array()){
        if(count($datos) == 0)
            return 0;
        $this->db->insert('timagenes',$datos);
        $id = $this->db->insert_id();
        return $id;
    }

    public function getImagenesInscripcion($id_alumno = 0){
        $q = $this->db->select()
                    ->where('id_alumno',$id_alumno)
                    //->order_by('Fecha_Inicio','desc')
                    ->get('timagenes');
        $res = $q->result();
        if($res)
            return $res;
        else
            return 0;
    }
}
