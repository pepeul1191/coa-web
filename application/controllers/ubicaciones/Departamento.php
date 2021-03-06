<?php

require_once 'application/models/ubicaciones/Departamento_model.php';

class Departamento extends CI_Controller 
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
    $rs = Model::factory('Departamento_model', 'ubicaciones')
    	->select('id')
    	->select('nombre')
    	->find_array();
    echo json_encode($rs);
  }
}

?>