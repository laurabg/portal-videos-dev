<?php

error_reporting(E_ALL);

// Definición de variables
define("_PORTALROOT", $_SERVER["DOCUMENT_ROOT"]."/portal-videos-dev/");
define("_BBDD", _PORTALROOT."db/dbportalvideos.db");
define("_BBDDLOG", _PORTALROOT."db/dblog.db");
define("_DIRCURSOS", "cursos/");
define("_VIDEOSDATA", "videos-data/");
//define("_DIRCURSOS", "/home/laura/cursos");

$extensionesValidas = array("mp4");
$db = null;

include_once('db.php');
include_once('robot.php');
include_once('content.php');

dbCreate(_BBDD);
//resetDB();
//buscarCursos(_DIRCURSOS);

?>