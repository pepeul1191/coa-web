require 'sequel'

Sequel.migration do
  up do
    create_table(:directores) do
      primary_key :id
    end

    alter_table(:directores) do
      add_foreign_key :sede_id, :sedes
      add_foreign_key :doctor_id, :doctores
    end
	end

  down do
    drop_column :directores, :sede_id
    drop_column :directores, :doctor_id
    drop_table(:directores)
	end
end
