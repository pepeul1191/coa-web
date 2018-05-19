require 'sequel'

Sequel.migration do
  up do
    create_table(:doctores) do
      primary_key :id
      String :nombres, null: false, size: 50
      String :paterno, null: false, size: 30
      String :materno, null: false, size: 30
      Integer :cop, null: false, size: 10
      Integer :rne, null: true, size: 10
    end

    alter_table(:doctores) do
      add_foreign_key :sede_id, :sedes
      add_foreign_key :especialidad_id, :especialidades
      add_foreign_key :sexo_id, :sexos
    end
	end

  down do
    drop_column :doctores, :sede_id
    drop_column :doctores, :especialidad_id
    drop_column :doctores, :sexo_id
    drop_table(:doctores)
	end
end
