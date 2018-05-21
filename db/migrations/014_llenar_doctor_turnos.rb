require 'sequel'

Sequel.migration do
  up do
    Sequel.connect('sqlite://db/coa.db')
    #Sequel.connect('mysql2://localhost/gestion?user=root&password=123')
		DB.transaction do
	  	file = File.new('db/data/doctor_turnos.txt', 'r')
			while (line = file.gets)
				line_array = line.split('::')
				doctor_id = line_array[0]
        sede_id = line_array[1]
        telefono = line_array[2].strip
				puts doctor_id + " - " + sede_id
				DB[:doctor_turnos].insert(doctor_id: doctor_id, sede_id: sede_id, telefono: telefono)
      end
		end
  end

	down do
		DB = Sequel.connect('sqlite://db/coa.db')
    DB[:doctor_turnos].delete
	end
end
