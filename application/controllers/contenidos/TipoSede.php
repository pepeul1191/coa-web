<?php

require_once 'application/models/contenidos/TipoSede_model.php';

class TipoSede extends CI_Controller
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
    $rs = Model::factory('TipoSede_model', 'contenidos')
    	->select('id')
    	->select('nombre')
    	->find_array();
    echo json_encode($rs);
  }
}

?>
