<?php

require_once 'application/models/contenidos/Especialidad_model.php';

class Especialidad extends CI_Controller
{
  public function listar()
  {
  	$this->load->library('HttpAccess',
  		array(
  			'config' => $this->config,
  			'allow' => ['GET'],
  			'received' => $this->input->method(TRUE)
  		)
  	);
    $rs = Model::factory('Especialidad_model', 'contenidos')
    	->select('id')
    	->select('nombre')
    	->find_array();
    echo json_encode($rs);
  }
}

?>
