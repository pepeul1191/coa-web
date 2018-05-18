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
      'modulo' => 'Accesos',
      'title' => 'Home',
      'csss' => index_css($this->config),
      'jss' => index_js($this->config),
      'menu' => '[{"url" : "accesos", "nombre" : "Accesos"},{"url" : "libros", "nombre" : "Libros"}]',
      'items' => '[{"subtitulo":"","items":[{"item":"Gestión de Sistemas","url":"accesos/#/sistema"},{"item":"Gestión de Usuarios","url":"accesos/#/usuario"}]}]',
      'data' => json_encode(array(
        'mensaje' => false,
        'titulo_pagina' => 'Gestión de Accesos',
        'modulo' => 'Libros'
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
