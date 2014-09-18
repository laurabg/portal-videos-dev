<?php

$bd = new SQLite3('db/mibdsqlite.db');

echo '***<br /><br />';


echo $bd->exec('CREATE TABLE foo (bar STRING)');

echo '+++<br /><br />';

echo $bd->exec("INSERT INTO foo (bar) VALUES ('Esto es una prueba')");

echo '---<br /><br />';


$resultado = $bd->query('SELECT bar FROM foo');
var_dump($resultado->fetchArray());

?>