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
          $doctor = Model::factory('Doctor_model', 'contenidos')->create();
          $doctor->nombres = $nuevo->{'nombres'};
          $doctor->paterno = $nuevo->{'paterno'};
          $doctor->materno = $nuevo->{'materno'};
          $doctor->cop = $nuevo->{'cop'};
          $doctor->rne = $nuevo->{'rne'};
          $doctor->sede_id = $nuevo->{'sede_id'};
          $doctor->especialidad_id = $nuevo->{'especialidad_id'};
          $doctor->sexo_id = $nuevo->{'sexo_id'};
          $doctor->save();
          $temp = [];
          $temp['temporal'] = $nuevo->{'id'};
          $temp['nuevo_id'] = $doctor->id;
          array_push( $array_nuevos, $temp );
        }
      }
      if(count($editados) > 0){
        foreach ($editados as &$editado) {
          $doctor = Model::factory('Doctor_model', 'contenidos')->find_one($editado->{'id'});
          $doctor->nombres = $editado->{'nombres'};
          $doctor->paterno = $editado->{'paterno'};
          $doctor->materno = $editado->{'materno'};
          $doctor->cop = $editado->{'cop'};
          $doctor->rne = $editado->{'rne'};
          $doctor->sede_id = $editado->{'sede_id'};
          $doctor->especialidad_id = $editado->{'especialidad_id'};
          $doctor->sexo_id = $editado->{'sexo_id'};
          $doctor->save();
        }
      }
      if(count($eliminados) > 0){
        foreach ($eliminados as &$eliminado) {
          $doctor = Model::factory('Doctor_model', 'contenidos')->find_one($eliminado);
          $doctor->delete();
        }
      }
      $rpta['tipo_mensaje'] = 'success';
      $rpta['mensaje'] = ['Se ha registrado los cambios en los doctores de la sede', $array_nuevos];
      ORM::get_db('contenidos')->commit();
    } catch (Exception $e) {
      $rpta['tipo_mensaje'] = 'error';
      $rpta['mensaje'] = ['Se ha producido un error en guardar la tabla de doctores de la sede', $e->getMessage()];
      ORM::get_db('contenidos')->rollBack();
    }
    echo json_encode($rpta);
  }
}

?>
