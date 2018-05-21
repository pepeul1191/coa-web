<?php

require_once 'application/models/contenidos/Sede_model.php';
require_once 'application/models/contenidos/Director_model.php';
require_once 'application/models/contenidos/DoctorTurno_model.php';

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

  public function obtenerResponsables($sede_id)
  {
    $this->load->library('HttpAccess',
      array(
        'config' => $this->config,
        'allow' => ['GET'],
        'received' => $this->input->method(TRUE)
      )
    );
    $director = Model::factory('Director_model', 'contenidos')->where('sede_id', $sede_id)->find_one();
    $doctor_turno = Model::factory('DoctorTurno_model', 'contenidos')->where('sede_id', $sede_id)->find_one();
    $director_id = 'E';
    $doctor_turno_id = 'E';
    $telefono = '';
    if($director != false){
      $director_id = $director->doctor_id;
    }
    if($doctor_turno != false){
      $doctor_turno_id = $doctor_turno->doctor_id;
      $telefono = $doctor_turno->telefono;
    }
    $responsable = array(
      'director_id' => $director_id,
      'doctor_turno_id' => $doctor_turno_id,
      'telefono' => $telefono,
    );
    echo json_encode($responsable);
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

  public function gudardarDoctorTurno()
  {
    $this->load->library('HttpAccess',
      array(
        'config' => $this->config,
        'allow' => ['POST'],
        'received' => $this->input->method(TRUE)
      )
    );
    $rpta = [];
    ORM::get_db('contenidos')->beginTransaction();
    $data = json_decode($this->input->post('data'));
    try {
      $doctor_turno = Model::factory('DoctorTurno_model', 'contenidos')->where('sede_id', $data->{'sede_id'})->find_one();
      if($doctor_turno != false){
        $doctor_turno->doctor_id = $data->{'doctor_id'};
        $doctor_turno->telefono = $data->{'telefono'};
        $doctor_turno->save();
      }else{
        $doctor_turno_nuevo = Model::factory('DoctorTurno_model', 'contenidos')->create();
        $doctor_turno_nuevo->sede_id = $data->{'sede_id'};
        $doctor_turno_nuevo->telefono = $data->{'telefono'};
        $doctor_turno_nuevo->doctor_id = $data->{'doctor_id'};
        $doctor_turno_nuevo->save();
      }
      ORM::get_db('contenidos')->commit();
      $rpta['tipo_mensaje'] = 'success';
      $rpta['mensaje'] = ['Se ha registrado el doctor de turno de la sede', []];
      //$this->response->statusCode(200);
      echo json_encode($rpta);
    } catch (Exception $e) {
      $rpta['tipo_mensaje'] = 'error';
      $rpta['mensaje'] = ['Se ha producido un error en guardar el doctor de turno de la sede', $e->getMessage()];
      ORM::get_db('contenidos')->rollBack();
      //$this->response->statusCode(500);
      echo json_encode($rpta);
    }
  }

  public function gudardarDirector()
  {
    $this->load->library('HttpAccess',
      array(
        'config' => $this->config,
        'allow' => ['POST'],
        'received' => $this->input->method(TRUE)
      )
    );
    $rpta = [];
    ORM::get_db('contenidos')->beginTransaction();
    $data = json_decode($this->input->post('data'));
    try {
      $director = Model::factory('Director_model', 'contenidos')->where('sede_id', $data->{'sede_id'})->find_one();
      if($director != false){
        $director->doctor_id = $data->{'doctor_id'};
        $director->save();
      }else{
        $director_nuevo = Model::factory('Director_model', 'contenidos')->create();
        $director_nuevo->sede_id = $data->{'sede_id'};
        $director_nuevo->doctor_id = $data->{'doctor_id'};
        $director_nuevo->save();
      }
      ORM::get_db('contenidos')->commit();
      $rpta['tipo_mensaje'] = 'success';
      $rpta['mensaje'] = ['Se ha registrado el director de la sede', []];
      //$this->response->statusCode(200);
      echo json_encode($rpta);
    } catch (Exception $e) {
      $rpta['tipo_mensaje'] = 'error';
      $rpta['mensaje'] = ['Se ha producido un error en guardar el director de la sede', $e->getMessage()];
      ORM::get_db('contenidos')->rollBack();
      //$this->response->statusCode(500);
      echo json_encode($rpta);
    }
  }
}

?>
