<?php 
require_once 'Clinica.php';
require dirname(__FILE__) . '/../../vendor/autoload.php';

//use MoodleRest;
/**
 * 
 */
class Aula{

    protected $management;
    protected $cursos;

    public function __construct(){
        $this->management = new \MoodleRest('http://aula.academiaexitus.edu.pe/webservice/rest/server.php', '93573c909386c08019252056cd02fa14');
    }

    public function cargarCursos($area = ''){
        $allCursos = $this->management->request('core_course_get_courses',[
            'options'       => [
                'ids'       => []
            ]
        ]);
        //return $allCursos;
        $courses = [];
        foreach($allCursos as $course){
            if(strrpos($course['shortname'], $area.'.virtual.oto') === false){}
            else{
                array_push($courses,$course);
            }
        }
        $this->cursos = $courses;
    }

    public function consultAlumno($username){
        $result = $this->management->request('core_user_get_users',[
            'criteria'=>[
                array(
                    'key'  => 'username',
                    'value'=> $username
                )
            ]
        ]);
        return $result;
    }

    public function registrarAlumno($data){
        $usuario = [
            'username'              => $data['username'],
            'auth'                  => 'manual',
            'password'              => '#aulaExitus2020',
            'firstname'             => $data['nombres'],
            'lastname'              => $data['apellidos'],
            'email'                 => $data['email'] == 'email@email.com' ? (implode('.',explode(' ',strtolower($data['nombres']))).'.'.(explode(' ',strtolower($data['apellidos']))[0]).'@email.com') : $data['email'],
            'idnumber'              => '',
            'lang'                  => 'es'
        ];
        $result = $this->management->request('core_user_create_users',[
            'users'     => [$usuario]
        ]);
        if(isset($result['errorcode'])){
            return ['status'=>202,'message'=>'error ne los parametros','data'=>[]];
        }else{
            $alumno = $result[0];
                $matriculas = [];
            if(isset($this->cursos[0])){
                foreach($this->cursos as $curso){
                    array_push($matriculas,[
                        'roleid'                => 5,
                        'userid'                => $alumno['id'],
                        'courseid'              => $curso['id']
                    ]);
                }
            }
            $usuario['id'] = $alumno['id'];
            $this->management->request('enrol_manual_enrol_users',['enrolments'=>$matriculas]);
            return ['status'=>200,'message'=>'registro satisfactorio','data'=>[
                'usuario'           => $usuario,
                'cursos'            => $this->cursos,
            ]];
        }
        return $result;
    }

}