require 'sequel'

Sequel.migration do
  up do
    create_table(:sexos) do
      primary_key :id
      String :nombre1, null: false, size: 10
      String :nombre2, null: false, size: 30
      String :sexo, null: false, size: 1
    end
	end

  down do
    drop_table(:sexos)
	end
end
