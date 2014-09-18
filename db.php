<?php

function dbCreate($dbName) {
	global $db;

	if (!file_exists($dbName)) {
	//	echo 'Creando bbdd...<br />';
		$db = new SQLite3($dbName);

	//	echo 'Creando tablas...<br />';
		crearTablas();
	} else {
	//	echo 'La base de datos ya existe<br />';
		$db = new SQLite3($dbName);
	}
}

function crearTablas() {
	global $db;

	$db->exec('CREATE TABLE cursos (
		ID INTEGER PRIMARY KEY, 
		nombre TEXT, 
		descripcion TEXT);'
	);
	$db->exec('CREATE TABLE temas (
		ID INTEGER PRIMARY KEY, 
		nombre TEXT, 
		descripcion TEXT, 
		IDcurso INTEGER);'
	);
echo 'CREATE TABLE videos (
		ID INTEGER PRIMARY KEY, 
		nombre TEXT, 
		ruta TEXT, 
		descripcion TEXT, 
		img TEXT, 
		IDtema INTEGER, 
		IDcurso INTEGER);<br />';

	$db->exec('CREATE TABLE videos (
		ID INTEGER PRIMARY KEY, 
		nombre TEXT, 
		ruta TEXT, 
		descripcion TEXT, 
		img TEXT, 
		IDtema INTEGER, 
		IDcurso INTEGER);'
	);
}

function resetDB() {
	global $db;
	$db->exec('DELETE FROM videos');
	$db->exec('DELETE FROM temas');
	$db->exec('DELETE FROM cursos');
}

function getIDcurso($nombre) {
	global $db;

	if ($db->querySingle('SELECT COUNT(*) FROM cursos WHERE nombre = "'.$nombre.'"') == 0) {
	//	echo "Crear curso ".$nombre."<br />";
		$db->exec('INSERT INTO cursos (nombre) VALUES ("'.$nombre.'")');
	} else {
	//	echo "El curso ".$nombre." existe<br />";
	}

	$IDcurso = $db->querySingle('SELECT ID FROM cursos WHERE nombre = "'.$nombre.'"');
	return $IDcurso;
}


function getIDtema($IDcurso, $nombre) {
	global $db;

	if ($db->querySingle('SELECT COUNT(*) FROM temas WHERE nombre = "'.$nombre.'" AND IDcurso = '.$IDcurso) == 0) {
	//	echo "&nbsp;&nbsp;&nbsp;Crear tema ".$nombre."<br />";
		$db->exec('INSERT INTO temas (nombre, IDcurso) VALUES ("'.$nombre.'", '.$IDcurso.')');
	} else {
	//	echo "&nbsp;&nbsp;&nbsp;El tema ".$nombre." existe<br />";
	}

	$IDtema = $db->querySingle('SELECT ID FROM temas WHERE nombre = "'.$nombre.'" AND IDcurso = '.$IDcurso);
	return $IDtema;
}


function getIDvideo($IDcurso, $IDtema, $nombre, $ruta) {
	global $db;

	if ($db->querySingle('SELECT COUNT(*) FROM videos WHERE nombre = "'.$nombre.'" AND IDtema = '.$IDtema) == 0) {
	//	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Crear video ".$nombre."<br />";
		$db->exec('INSERT INTO videos (nombre, ruta, IDtema, IDcurso) VALUES ("'.$nombre.'", "'.$ruta.'/'.$nombre.'", '.$IDtema.', '.$IDcurso.')');
	} else {
	//	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;El video ".$nombre." existe<br />";
	}

	$IDvideo = $db->querySingle('SELECT ID FROM videos WHERE nombre = "'.$nombre.'" AND IDtema = '.$IDtema.' AND IDcurso = '.$IDcurso);
	return $IDvideo;
}

function updateVideo($IDvideo, $img) {
	global $db;

	$db->exec('UPDATE videos SET img = "'.$img.'" WHERE ID = '.$IDvideo.';');
}

?>