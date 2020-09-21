# PHPDB
***

## Libreria para el manejo de base de datos

### ¿Qué es PHPDB? 
PHPDB es una pequeña librería para el manejo de consultas a una base de datos SQL.
PHPDB es totalmente orientada a objetos y trabaja con la extensión PDO, además de usar consultas preparadas.

### ¿Cómo uso PHPDB?
Para usar esta librería solo debe de incluir la ruta del archivo DB.php e inicializar la clase:
```php
include 'DB.php';

use PHPDB\DB;

$init = new DB();
```

Una vez hecho esto invocar el método que desea utilizar
`$init->new();`
`$init->show();`
`$init->update();`
`$init->delete();`


* Método `new()`
Este método se encarga de insertar nuevos registros en la base de datos, es obligatorio pasar los parámetros el orden correcto para que no devuelva un error.
Variable $table es donde se guarda el nombre de la tabla a utilizar.
Variable $insert es un arreglo donde se pasan los nombres de los campos como las claves de los arreglos y los valores del arreglo serán los datos a insertar en dichos campos.

```php
$tabla = 'ejemplo';
$insert = array('id' => null, 'campo' => 'Lorem ipsum.');
$init->new($tabla , $insert);
```

Método `show()`
Este método se encarga de mostrar los registros se la base de datos, es obligatorio pasar los parámetros el orden correcto para que no devuelva un error.
Variable $table es donde se guarda el nombre de la tabla a utilizar.
Variable $ver es un arreglo donde se pasan los nombres de los campos como las claves del arreglo y los valores del arreglo serán los datos que validan la consulta.

```php
$tabla = 'ejemplo';
$ver = array( 'id ' => 3, 'campo' => 'Lorem ipsum.');
$result = $init->show($tabla, $ver);
```
```sql
SELECT * FROM ejemplo WHERE id=3 AND campo='Lorem ipsum.'
```

* Método `update()`
Este método se encarga de actualizar nuevos registros en la base de datos, es obligatorio pasar los parámetros el orden correcto para que no devuelva un error.
Variable $table es donde se guarda el nombre de la tabla a utilizar.
Variable $ update  es un arreglo donde se pasan los nombres de los campos como las claves de los arreglos y los valores del arreglo serán los datos a actualizar en dichos campos.

```php
$tabla = 'ejemplo';
$update = array( 'id' => 5, 'campo' => 'Valor actualizado');
$init->update($tabla, $update);
```

* Método `delete()`
Este método se encarga de eliminar nuevos registros en la base de datos, es obligatorio pasar los parámetros el orden correcto para que no devuelva un error.
Variable $table es donde se guarda el nombre de la tabla a utilizar.
Variable $ del es un arreglo donde se pasan los nombres de los campos como las claves de los arreglos y los valores del arreglo serán los datos que validan la consulta.

```php
$tabla = 'ejemplo';
$del = array('id' => 2);
$init->delete($tabla, $del);
```

Nota: En caso de no especificar ningún valor en la variable `$del` la consulta se llevara a cabo eliminando todos los datos de la tabla
