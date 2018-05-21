require 'sequel'

Sequel.migration do
  up do
    create_table(:doctor_turnos) do
      primary_key :id
      String :telefono, null: false, size: 20
    end

    alter_table(:doctor_turnos) do
      add_foreign_key :sede_id, :sedes
      add_foreign_key :doctor_id, :doctores
    end
	end

  down do
    drop_column :doctor_turnos, :sede_id
    drop_column :doctor_turnos, :doctor_id
    drop_table(:doctor_turnos)
	end
end
