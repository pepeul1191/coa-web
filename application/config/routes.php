<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['']['GET'] = 'home/index';
# login
$route['login']['GET'] = 'login/index';
$route['login/acceder']['POST'] = 'login/acceder';
$route['usuario/ver']['GET'] = 'login/ver';
$route['usuario/salir']['GET'] = 'login/salir';
# ubicaciones
$route['ubicaciones/departamento/listar']['GET'] = 'ubicaciones/departamento/listar';
$route['ubicaciones/distrito/buscar']['GET'] = 'ubicaciones/distrito/buscar';
$route['ubicaciones/distrito/nombre']['GET'] = 'ubicaciones/distrito/nombre';
$route['ubicaciones/distrito/listar/(:num)']['GET'] = 'ubicaciones/distrito/listar/$1';
$route['ubicaciones/provincia/listar/(:num)']['GET'] = 'ubicaciones/provincia/listar/$1';
# contenidos
$route['contenidos']['GET'] = 'contenidos/contenido/index';
# contenidos/especialidad
$route['contenidos/especialidad/listar']['GET'] = 'contenidos/especialidad/listar';
$route['contenidos/especialidad/guardar']['POST'] = 'contenidos/especialidad/guardar';
# contenidos/sede
$route['contenidos/sede/listar']['GET'] = 'contenidos/sede/listar';
$route['contenidos/sede/gudardar']['POST'] = 'contenidos/sede/guardar';
$route['contenidos/sede/obtener_responsables/(:num)']['GET'] = 'contenidos/sede/obtenerResponsables/$1';
$route['contenidos/sede/doctor_turno/guardar']['POST'] = 'contenidos/sede/gudardarDoctorTurno';
$route['contenidos/sede/director/guardar']['POST'] = 'contenidos/sede/gudardarDirector';
$route['contenidos/sede/tipo/(:num)']['GET'] = 'contenidos/sede/listarSedeTipo/$1';
# contenidos/doctor
$route['contenidos/doctor/listar/(:num)']['GET'] = 'contenidos/doctor/sede/$1';
$route['contenidos/doctor/sede/guardar']['POST'] = 'contenidos/doctor/guardar';
$route['contenidos/doctor/select/(:num)']['GET'] = 'contenidos/doctor/select/$1';
$route['contenidos/doctor/sexo_sede_especialidad']['GET'] = 'contenidos/doctor/doctorSedeSexoEspecialidad';
$route['contenidos/doctor/count_sexo_sede_especialidad']['GET'] = 'contenidos/doctor/countDoctorSedeSexoEspecialidad';
$route['contenidos/doctor/obtener/(:num)']['GET'] = 'contenidos/doctor/obtener/$1';
$route['contenidos/doctor/editar']['POST'] = 'contenidos/doctor/editar';
# contenidos/tipo_sede
$route['contenidos/tipo_sede/listar']['GET'] = 'contenidos/tipoSede/listar';
# contenidos/sexo
$route['contenidos/sexo/listar']['GET'] = 'contenidos/sexo/listar';
