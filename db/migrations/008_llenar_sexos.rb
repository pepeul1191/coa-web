require 'sequel'

Sequel.migration do
  up do
    Sequel.connect('sqlite://db/coa.db')
    #Sequel.connect('mysql2://localhost/gestion?user=root&password=123')
		DB.transaction do
	  	file = File.new('db/data/sexos.txt', 'r')
			while (line = file.gets)
				line_array = line.split('::')
				id = line_array[0]
        nombre1 = line_array[1]
        nombre2 = line_array[2]
        sexo = line_array[3].strip
				#puts id + " - " + nombre
				DB[:sexos].insert(id: id, nombre1: nombre1, nombre2: nombre2, sexo: sexo)
      end
		end
  end

	down do
		DB = Sequel.connect('sqlite://db/coa.db')
    DB[:sexos].delete
	end
end
