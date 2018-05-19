require 'sequel'

Sequel.migration do
  up do
    Sequel.connect('sqlite://db/coa.db')
    #Sequel.connect('mysql2://localhost/gestion?user=root&password=123')
		DB.transaction do
	  	file = File.new('db/data/sedes.txt', 'r')
			while (line = file.gets)
				line_array = line.split('::')
				id = line_array[0]
        tipo_sede_id = line_array[1]
				nombre = line_array[2]
        direccion = line_array[3]
        telefono = line_array[4].strip
				#puts id + " - " + nombre
				DB[:sedes].insert(id: id, tipo_sede_id: tipo_sede_id, nombre: nombre, direccion: direccion, telefono: telefono)
      end
		end
  end

	down do
		DB = Sequel.connect('sqlite://db/coa.db')
    DB[:sedes].delete
	end
end
