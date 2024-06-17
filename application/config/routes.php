<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'preregistro/nuevo';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['noticias'] = 'home/noticias';
$route['nosotros'] = 'home/nosotros';
$route['areas'] = 'home/areas';
$route['pre-registro'] = 'preregistro/nuevo';
$route['control'] = 'asistencia/controlasistencia';