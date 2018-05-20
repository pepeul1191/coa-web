<?php

require_once 'application/models/contenidos/Doctor_model.php';

class Doctor extends CI_Controller
{
  public function sede($sede_id)
  {
  	$this->load->library('HttpAccess',
  		array(
  			'config' => $this->config,
  			'allow' => ['GET'],
  			'received' => $this->input->method(TRUE)
  		)
  	);
    $rs = Model::factory('Doctor_model', 'contenidos')
    	->select('id')
    	->select('nombres')
      ->select('paterno')
      ->select('materno')
      ->select('cop')
      ->select('rne')
      ->select('especialidad_id')
      ->select('sexo_id')
    	->where('sede_id', $sede_id)
    	->find_array();
    echo json_encode($rs);
  }
}

?>
