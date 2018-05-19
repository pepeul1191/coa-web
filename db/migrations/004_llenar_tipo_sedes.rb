require 'sequel'

Sequel.migration do
  up do
    Sequel.connect('sqlite://db/coa.db')
    #Sequel.connect('mysql2://localhost/gestion?user=root&password=123')
		DB.transaction do
	  	file = File.new('db/data/tipo_sedes.txt', 'r')
			while (line = file.gets)
				line_array = line.split('::')
				id = line_array[0]
				nombre = line_array[1].strip
				#puts id + " - " + nombre
				DB[:tipo_sedes].insert(id: id, nombre: nombre)
      end
		end
  end

	down do
		DB = Sequel.connect('sqlite://db/coa.db')
    DB[:tipo_sedes].delete
	end
end
