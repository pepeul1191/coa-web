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
          'assets/css/constants',
          'bower_components/swp-backbone/assets/css/dashboard',
        ];
        break;
      case 'produccion':
        $rpta = [
          'dist/home.min',
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
          'bower_components/handlebars/handlebars.min',
          'bower_components/swp-backbone/layouts/application',
          'bower_components/swp-backbone/assets/js/dashboard',
        ];
        break;
      case 'produccion':
        $rpta = [
          'dist/home.min',
        ];
        break;

    }
    return $rpta;
  }
}

?>