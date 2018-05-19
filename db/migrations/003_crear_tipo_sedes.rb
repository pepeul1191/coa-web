require 'sequel'

Sequel.migration do
  up do
    create_table(:tipo_sedes) do
      primary_key :id
      String :nombre, null: false, size: 10
    end
	end

  down do
    drop_table(:tipo_sedes)
	end
end
