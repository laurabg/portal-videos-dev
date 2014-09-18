<?php

error_reporting(E_ALL);

// Definición de variables
define("_PORTALROOT", $_SERVER["DOCUMENT_ROOT"]."/portal-videos-developer/");
define("_BBDD", _PORTALROOT."db/dbportalvideos.db");
define("_BBDDLOG", _PORTALROOT."db/dblog.db");
define("_DIRCURSOS", _PORTALROOT."cursos/");
define("_VIDEOSDATA", "videos-data/");
//define("_DIRCURSOS", "/home/laura/cursos");


$extensionesValidas = array("mp4");
$db = null;


include_once('db.php');
include_once('robot.php');

dbCreate(_BBDD);
resetDB();
buscarCursos(_DIRCURSOS);

//$db = new SQLite3(_BBDD);
/*
$res = $db->query('SELECT ID, nombre, descripcion FROM cursos');
$i = 0;
while ($row = $res->fetchArray()) {
    echo $row['ID'].' - '.$row['nombre'].' - '.$row['descripcion'].'<br />';
    $i++;
}
*/
//exec("sudo /usr/bin/ffmpeg -i 403.mp4 -ss 0 -vframes 1 -f image2 prueba2.jpg");
/*
$ffmpeg = "/usr/bin/ffmpeg";
$video = _PORTALROOT."/cursos/curso1/tema1/403.mp4";
$img = _PORTALROOT."/cursos/curso1/tema1/403.jpg";
$cmd = "$ffmpeg -i $video -ss 5 -vframes 1 -f image2 $img";
echo $cmd."<br /><br /><br />";

if (!shell_exec($cmd)) {
	echo "OK!!!";
} else {
	echo "ooohhh....";
}


echo "<img src=\"cursos/curso1/tema1/403.jpg\" />";*/
//echo exec('/usr/bin/ffmpeg');*/
?>