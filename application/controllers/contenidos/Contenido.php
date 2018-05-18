<?php

class Contenido extends CI_Controller
{
  public function index()
  {
  	$this->load->library('HttpAccess',
  		array(
  			'config' => $this->config,
  			'allow' => ['GET'],
  			'received' => $this->input->method(TRUE)
  		)
  	);
    $this->load->helper('Contenido');
    $data_top = array(
      'mensaje' => false,
      'titulo_pagina' => 'Gestión de Contenidos',
      'title' => 'Contenidos',
      'csss' => index_css($this->config),
      'jss' => index_js($this->config),
      'menu' => json_encode(array(
        0 => array('url' => 'accesos', 'nombre' => 'Accesos'),
        1 => array('url' => 'contenidos', 'nombre' => 'Contenidos'),
      )),
      'items' => json_encode(array(
         0 => array('subtitulo' => 'Sedes y Doctores', 'items' => array(
           0 => array('item' => 'Gestión de Especialidades', 'url' => 'contenidos/#/especialidad'),
           1 => array('item' => 'Gestión de Sedes', 'url' => 'contenidos/#/sede'),
           2 => array('item' => 'Gestión de Doctores', 'url' => 'contenidos/#/doctor'),
         )),
         1 => array('subtitulo' => 'Otros', 'items' => array(
           0 => array('item' => 'Slider', 'url' => 'contenidos/#/slider'),
           1 => array('item' => 'Servicios', 'url' => 'contenidos/#/servicio'),
         ),
       ),
      )),
      'data' => json_encode(array(
        'mensaje' => false,
        'titulo_pagina' => 'Gestión de Accesos',
        'modulo' => 'Contenidos'
      )),
    );
    $data_bottom = array(
      'js_bottom' => 'dist/accesos.min.js',
    );
    $this->load->helper('View');
    $this->load->view('layouts/application_header', $data_top);
    $this->load->view('contenido/index');
    $this->load->view('layouts/application_footer', $data_bottom);
  }
}

?>
