<?php

require_once 'application/models/contenidos/Sexo_model.php';

class Sexo extends CI_Controller
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
    $rs = Model::factory('Sexo_model', 'contenidos')
    	->select('id')
    	->select('sexo')
    	->find_array();
    echo json_encode($rs);
  }
}

?>
