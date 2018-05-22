<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('index_css'))
{
  function index_css($config)
  {
    $rpta = null;
    switch($config->item('ambiente')){
      case 'desarrollo':
        $rpta = [
      	  'bower_components/bootstrap/dist/css/bootstrap.min',
				  'bower_components/font-awesome/css/font-awesome.min',
          'bower_components/swp-backbone/assets/css/constants',
          'bower_components/swp-backbone/assets/css/dashboard',
          'bower_components/swp-backbone/assets/css/table',
          'assets/css/constants',
        ];
        break;
      case 'produccion':
        $rpta = [
          'dist/contenido.min',
        ];
        break;

    }
    return $rpta;
  }
}

if ( ! function_exists('index_js'))
{
  function index_js($config)
  {
    $rpta = null;
    switch($config->item('ambiente')){
      case 'desarrollo':
        $rpta = [
          'bower_components/jquery/dist/jquery.min',
				  'bower_components/bootstrap/dist/js/bootstrap.min',
          'bower_components/underscore/underscore-min',
          'bower_components/backbone/backbone-min',
          'bower_components/backbone.marionette/lib/backbone.marionette.min',
          'bower_components/handlebars/handlebars.min',
          'bower_components/swp-backbone/layouts/application',
          'bower_components/swp-backbone/views/table',
          'bower_components/swp-backbone/views/modal',
          'models/sexo',
          'collections/sexo_collection',
          'models/tipo_sede',
          'collections/tipo_sede_collection',
          'models/especialidad',
          'collections/especialidad_collection',
          'collections/doctor_collection',
          'models/view_doctor',
          'collections/view_doctor_collection',
          'views/especialidad_table',
          'views/especialidad',
          'models/sede',
          'models/sexo',
          'models/doctor',
          'models/doctor_turno',
          'models/director',
          'collections/sede_collection',
          'collections/sede_doctor_collection',
          'collections/sexo_collection',
          'views/sede_doctor_table',
          'views/sede_doctor',
          'views/sede_responsable',
          'views/doctor_detalle',
          'views/sede_table',
          'views/doctor_table',
          'views/sede',
          'views/doctor',
          'routes/contenido',
        ];
        break;
      case 'produccion':
        $rpta = [
          'dist/contenido.min',
        ];
        break;

    }
    return $rpta;
  }
}

?>
