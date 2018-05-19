require 'sequel'
require 'mysql2'

# conexión a base de datos
Sequel::Model.plugin :json_serializer
DB = Sequel.connect('mysql2://root:123@127.0.0.1:3306/naciocoa_web')

# clases ORM
class Especialidad < Sequel::Model(DB[:tb_especialidad])
end

def listar_especialidades
  especialidades = Especialidad.order(:id).all.to_a
  especialidades.each do |especialidad|
    #puts especialidad.id.to_s + "::" + especialidad.nombre
    puts especialidad.nombre.length
  end
end
