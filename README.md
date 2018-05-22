## CodeIgniter

Instalación de dependencias:

    $ composer install

Archivo de configuración de variables:

    application/config/config.php

Para recargar el autoload de clases:

    $ composer dump-autoload -o

Arancar servidor de prueba

    $ php -S localhost:8000

    ### Migraciones

Ejecutar migración

    $ sequel -m db/migrations -M #version postgres://host/database
    $ sequel -m db/migrations -M #version sqlite://db/gestion.db
    $ sequel -m db/migrations -M #version mysql://root:123@localhost/gestion

Ejecutar el 'down' de las migraciones de la última a la primera:

    $ sequel -m db/migrations -M 0 mysql://root:123@localhost/gestion

Ejecutar el 'up' de las migraciones hasta un versión especifica:

    $ sequel -m db/migrations -M #version mysql://root:123@localhost/gestion

Crear Vista de doctores

      MySQL
      >> CREATE VIEW vw_distrito_provincia_departamento AS select DI.id AS id, PA.id AS pais_id, concat(DI.nombre,', ',PR.nombre,', ',DE.nombre) AS nombre from ((distritos DI join provincias PR on((DI.provincia_id = PR.id))) join departamentos DE on((PR.departamento_id = DE.id))) join paises PA on((DE.pais_id = PA.id)) limit 2000;
      SQLite
      >> CREATE VIEW vw_doctores AS SELECT D.id AS id,  D.sede_id,  S.nombre1  || ' ' || D.paterno || ' '  || D.materno|| ', '  || D.nombres AS nombre FROM doctores D join sexos S on D.sexo_id = S.id limit 2000;

Crear vista de doctores con sexo, sede y especialidad:

    >> SQLite
    DROP VIEW IF EXISTS vw_doctores_sede_sexos_especialidades;
    CREATE VIEW vw_doctores_sede_sexos_especialidades AS SELECT
    D.id AS id, D.nombres,  D.paterno, D.materno, D.rne, D.cop, D.sede_id,  L.nombre AS sede,  TL.nombre AS tipo_sede , S.id AS sexo_id, S.nombre1 AS sexo, E.id AS especialidad_id, E.nombre AS especialidad
    FROM doctores D
    INNER JOIN sexos S on D.sexo_id = S.id  
    INNER JOIN sedes L ON L.id = D.sede_id
    INNER JOIN especialidades E ON E.id = D.especialidad_id
    INNER JOIN tipo_sedes TL ON  L.tipo_sede_id = TL.id
    ORDER BY D.sede_id
    LIMIT 2000;

Tipos de Datos de Columnas

+ :string=>String
+ :integer=>Integer
+ :date=>Date
+ :datetime=>[Time, DateTime].freeze,
+ :time=>Sequel::SQLTime,
+ :boolean=>[TrueClass, FalseClass].freeze,
+ :float=>Float
+ :decimal=>BigDecimal
+ :blob=>Sequel::SQL::Blob

Correr migración a SQLite3

    $ sequel -m db/migrations -M 14 sqlite://db/coa.db

---

Fuentes:

+ https://stackoverflow.com/questions/804399/codeigniter-create-new-helper
+ https://github.com/pepeul1191/fuelphp-pp
+ https://github.com/pepeul1191/php-codeigniter
+ https://www.codeigniter.com/user_guide/tutorial/
+ http://php.net/manual/es/function.array-key-exists.php
+ https://www.w3schools.com/php/php_sessions.asp
+ https://stackoverflow.com/questions/1995562/now-function-in-php
+ http://php.net/manual/es/features.commandline.webserver.php
