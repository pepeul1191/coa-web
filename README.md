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

Crear Vista de distrito/provincia/departamento

      MySQL
      >> CREATE VIEW vw_distrito_provincia_departamento AS select DI.id AS id, PA.id AS pais_id, concat(DI.nombre,', ',PR.nombre,', ',DE.nombre) AS nombre from ((distritos DI join provincias PR on((DI.provincia_id = PR.id))) join departamentos DE on((PR.departamento_id = DE.id))) join paises PA on((DE.pais_id = PA.id)) limit 2000;
      SQLite
      >> CREATE VIEW vw_distrito_provincia_departamentos AS select DI.id AS id,  DI.nombre || ', '  || PR.nombre || ', '  || DE.nombre AS nombre
    from distritos DI join provincias PR on DI.provincia_id = PR.id join departamentos DE on PR.departamento_id = DE.id limit 2000;

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

    sequel -m db/migrations -M 2 sqlite://db/coa.db


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
