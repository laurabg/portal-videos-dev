<?php

// Definición de variables
define("_PORTALROOT", $_SERVER["DOCUMENT_ROOT"]."/portal-videos-dev/");
define("_BBDD", _PORTALROOT."db/dbportalvideos.db");
define("_BBDDLOG", _PORTALROOT."db/dblog.db");
define("_DIRCURSOS", _PORTALROOT."data/");
//define("_VIDEOSDATA", "videos-data/");
//define("_DIRCURSOS", "/home/laura/cursos");


// Lista de extensiones válidas:
$extensionesValidas = array("mp4");

// Lista de directorios desde los que leer los cursos:
$listaDirs = array('cursos/','/home/laura/cursos2014/');


/*$db = null;

include_once('db.php');
include_once('robot.php');
include_once('content.php');

dbCreate(_BBDD);

resetDB();
buscarCursos(_DIRCURSOS);
*/
?>