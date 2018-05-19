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

  public function guardar()
  {
    $this->load->library('HttpAccess',
  		array(
  			'config' => $this->config,
  			'allow' => ['POST'],
  			'received' => $this->input->method(TRUE)
  		)
  	);
    ORM::get_db('contenidos')->beginTransaction();
    $data = json_decode($this->input->post('data'));
    $nuevos = $data->{'nuevos'};
    $editados = $data->{'editados'};
    $eliminados = $data->{'eliminados'};
    $rpta = []; $array_nuevos = [];
    try {
      if(count($nuevos) > 0){
        foreach ($nuevos as &$nuevo) {
          $especialidad = Model::factory('Especialidad_model', 'contenidos')->create();
          $especialidad->nombre = $nuevo->{'nombre'};
          $especialidad->save();
          $temp = [];
          $temp['temporal'] = $nuevo->{'id'};
          $temp['nuevo_id'] = $especialidad->id;
          array_push( $array_nuevos, $temp );
        }
      }
      if(count($editados) > 0){
        foreach ($editados as &$editado) {
          $especialidad = Model::factory('Especialidad_model', 'contenidos')->find_one($editado->{'id'});
          $especialidad->nombre = $editado->{'nombre'};
          $especialidad->save();
        }
      }
      if(count($eliminados) > 0){
        foreach ($eliminados as &$eliminado) {
          $especialidad = Model::factory('Especialidad_model', 'contenidos')->find_one($eliminado);
          $especialidad->delete();
        }
      }
      $rpta['tipo_mensaje'] = 'success';
      $rpta['mensaje'] = ['Se ha registrado los cambios en los especialidades', $array_nuevos];
      ORM::get_db('contenidos')->commit();
    } catch (Exception $e) {
      $rpta['tipo_mensaje'] = 'error';
      $rpta['mensaje'] = ['Se ha producido un error en guardar la tabla de especialidades', $e->getMessage()];
      ORM::get_db('contenidos')->rollBack();
    }
    echo json_encode($rpta);
  }
}

?>
