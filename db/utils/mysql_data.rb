require 'sequel'
require 'mysql2'

# conexión a base de datos
Sequel::Model.plugin :json_serializer
DB = Sequel.connect('mysql2://root:123@127.0.0.1:3306/naciocoa_web')

# clases ORM
class Especialidad < Sequel::Model(DB[:tb_especialidad])
end
class Sede < Sequel::Model(DB[:tb_sede])
end
class Doctor < Sequel::Model(DB[:tb_doctor])
end
class Director < Sequel::Model(DB[:tb_director])
end
class DoctorTurno < Sequel::Model(DB[:tb_doctor_turno])
end

# métodos de lectura

def listar_especialidades
  especialidades = Especialidad.order(:id).all.to_a
  especialidades.each do |especialidad|
    #puts especialidad.id.to_s + "::" + especialidad.nombre
    puts especialidad.nombre.length
  end
end

def listar_sedes
  sedes = Sede.order(:id).all.to_a
  sedes.each do |sede|
    puts sede.id.to_s + '::' + sede.id_tipo_sede.to_s + '::' + sede.nombre + '::' + sede.direccion + '::' + sede.telefono
  end
end

def listar_doctores
  doctores = Doctor.order(:id).all.to_a
  doctores.each do |doctor|
    puts doctor.id.to_s + '::' + doctor.nombre  + '::' + doctor.paterno  + '::' + doctor.materno  + '::' + doctor.cop.to_s  + '::' + doctor.id_sede.to_s + '::' + doctor.id_especialidad.to_s + '::' + doctor.id_sexo.to_s
  end
end

def listar_directores_sedes
  directores = Director.all.to_a
  directores.each do |director|
    puts director.id_doctor.to_s + '::' + director.id_sede.to_s
  end
end

def listar_doctores_turnos
  turnos = DoctorTurno.all.to_a
  turnos.each do |turno|
    puts turno.id_doctor.to_s + '::' + turno.id_sede.to_s +  '::' + turno.telefono
  end
end

listar_doctores_turnos
