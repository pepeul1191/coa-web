<?php

require_once 'application/models/contenidos/Sede_model.php';

class Sede extends CI_Controller
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
    $rs = Model::factory('Sede_model', 'contenidos')
    	->select('id')
    	->select('nombre')
      ->select('direccion')
      ->select('telefono')
      ->select('latitud')
      ->select('longitud')
      ->select('tipo_sede_id')
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
          $sede = Model::factory('Sede_model', 'contenidos')->create();
          $sede->nombre = $nuevo->{'nombre'};
          $sede->direccion = $nuevo->{'direccion'};
          $sede->telefono = $nuevo->{'telefono'};
          $sede->latitud = $nuevo->{'latitud'};
          $sede->longitud = $nuevo->{'longitud'};
          $sede->tipo_sede_id = $nuevo->{'tipo_sede_id'};
          $sede->save();
          $temp = [];
          $temp['temporal'] = $nuevo->{'id'};
          $temp['nuevo_id'] = $sede->id;
          array_push( $array_nuevos, $temp );
        }
      }
      if(count($editados) > 0){
        foreach ($editados as &$editado) {
          $sede = Model::factory('Sede_model', 'contenidos')->find_one($editado->{'id'});
          $sede->nombre = $editado->{'nombre'};
          $sede->direccion = $editado->{'direccion'};
          $sede->telefono = $editado->{'telefono'};
          $sede->latitud = $editado->{'latitud'};
          $sede->longitud = $editado->{'longitud'};
          $sede->tipo_sede_id = $editado->{'tipo_sede_id'};
          $sede->save();
        }
      }
      if(count($eliminados) > 0){
        foreach ($eliminados as &$eliminado) {
          $sede = Model::factory('Sede_model', 'contenidos')->find_one($eliminado);
          $sede->delete();
        }
      }
      $rpta['tipo_mensaje'] = 'success';
      $rpta['mensaje'] = ['Se ha registrado los cambios en las sedes', $array_nuevos];
      ORM::get_db('contenidos')->commit();
    } catch (Exception $e) {
      $rpta['tipo_mensaje'] = 'error';
      $rpta['mensaje'] = ['Se ha producido un error en guardar la tabla de sedes', $e->getMessage()];
      ORM::get_db('contenidos')->rollBack();
    }
    echo json_encode($rpta);
  }
}

?>
