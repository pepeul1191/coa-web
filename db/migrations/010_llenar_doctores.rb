require 'sequel'

Sequel.migration do
  up do
    Sequel.connect('sqlite://db/coa.db')
    #Sequel.connect('mysql2://localhost/gestion?user=root&password=123')
		DB.transaction do
	  	file = File.new('db/data/doctores.txt', 'r')
			while (line = file.gets)
				line_array = line.split('::')
        #    puts doctor.id.to_s + '::' + doctor.nombre  + '::' + doctor.paterno  + '::' + doctor.materno  + '::' + doctor.cop.to_s  + '::' + doctor.id_sede.to_s + '::' + doctor.id_especialidad.to_s + '::' + doctor.id_sexo.to_s
				id = line_array[0]
        nombres = line_array[1]
				paterno = line_array[2]
        materno = line_array[3]
        cop = line_array[4]
        sede_id = line_array[5]
        especialidad_id = line_array[6]
        sexo_id = line_array[7].strip
				#puts id + " - " + nombre
				DB[:doctores].insert(id: id, nombres: nombres, paterno: paterno, materno: materno, cop: cop, sede_id: sede_id, especialidad_id: especialidad_id, sexo_id: sexo_id)
      end
		end
  end

	down do
		DB = Sequel.connect('sqlite://db/coa.db')
    DB[:doctores].delete
	end
end
