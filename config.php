<?php

// Definición de variables
define("_PORTALROOT", "/portal-videos-dev/");
define("_DOCUMENTROOT", $_SERVER["DOCUMENT_ROOT"]._PORTALROOT);
define("_BBDD", _DOCUMENTROOT."db/dbportalvideos.db");
define("_BBDDLOG", _DOCUMENTROOT."db/dblog.db");
define("_BBDDANALYTICS", _DOCUMENTROOT."db/analytics.db");
define("_DIRCURSOS", "data/");


// Lista de extensiones válidas:
$extensionesValidas = array("mp4");

// Lista de directorios desde los que leer los cursos:
$listaDirs = array('cursos/');

?>