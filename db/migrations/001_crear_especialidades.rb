require 'sequel'

Sequel.migration do
  up do
    create_table(:especialidades) do
      primary_key :id
      String :nombre, null: false, size: 45
    end
	end

  down do
    drop_table(:especialidades)
	end
end
