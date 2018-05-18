require 'sequel'

Sequel.migration do
  up do
    Sequel.connect('sqlite://db/coa.db')
    #Sequel.connect('mysql2://localhost/gestion?user=root&password=123')
		DB.transaction do
	  	file = File.new('db/data/especialidades.txt', 'r')
			while (line = file.gets)
				line_array = line.split('::')
				id = line_array[0]
				nombre = line_array[1].strip
				#puts id + " - " + nombre
				DB[:especialidades].insert(id: id, nombre: nombre)
      end
		end
  end

	down do
		DB = Sequel.connect('sqlite://db/coa.db')
    DB[:especialidades].delete
	end
end
