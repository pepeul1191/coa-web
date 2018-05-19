require 'sequel'

Sequel.migration do
  up do
    create_table(:sedes) do
      primary_key :id
      String :nombre, null: false, size: 50
      String :direccion, null: false, size: 100
      String :telefono, null: false, size: 20
      Float :latitud, null: true
      Float :longitud, null: true
    end

    alter_table(:sedes) do
      add_foreign_key :tipo_sede_id, :tipo_sedes
    end
	end

  down do
    drop_column :sedes, :tipo_sede_id
    drop_table(:sedes)
	end
end
