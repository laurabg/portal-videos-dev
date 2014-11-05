<?php

function dbCreate($dbName) {
	global $db;
	
	if (!file_exists($dbName)) {
	//	echo 'Creando bbdd...<br />';
		$db = new SQLite3($dbName);
		chmod($dbName, 0777);

	//	echo 'Creando tablas...<br />';
		crearTablas();
	} else {
	//	echo 'La base de datos ya existe<br />';
		$db = new SQLite3($dbName);
	}
}

function dbLogCreate($dbLogName) {
	global $dbLog;

	if (!file_exists($dbLogName)) {
	//	echo 'Creando bbddLog...<br />';
		$dbLog = new SQLite3($dbLogName);
		chmod($dbLogName, 0777);

	//	echo 'Creando tablasLog...<br />';
		crearTablasLog();
	} else {
	//	echo 'La base de datos ya existe<br />';
		$dbLog = new SQLite3($dbLogName);
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


function crearTablasLog() {
	global $dbLog;

	$dbLog->exec('CREATE TABLE log (
		ID INTEGER PRIMARY KEY, 
		descripcion TEXT,
		"timestamp" DATETIME DEFAULT CURRENT_TIMESTAMP);'
	);
}

function resetDB() {
	global $db;
	$db->exec('DELETE FROM videos');
	$db->exec('DELETE FROM temas');
	$db->exec('DELETE FROM cursos');
}

function resetDBLog() {
	global $dbLog;
	$dbLog->exec('DELETE FROM log');
}


function logAction($action) {
	global $dbLog;

	$dbLog->exec('INSERT INTO log (descripcion) VALUES ("'.$action.'")');
}


function getIDcurso($nombreCurso) {
	global $db;

	if ($db->querySingle('SELECT COUNT(*) FROM cursos WHERE nombre = "'.$nombreCurso.'"') == 0) {
	//	echo "Crear curso ".$nombre."<br />";
		$db->exec('INSERT INTO cursos (nombre, descripcion) VALUES ("'.$nombreCurso.'","Descripción del curso '.$nombreCurso.'")');
	} else {
	//	echo "El curso ".$nombre." existe<br />";
	}

	$IDcurso = $db->querySingle('SELECT ID FROM cursos WHERE nombre = "'.$nombreCurso.'"');
	return $IDcurso;
}


function getIDtema($IDcurso, $nombreTema) {
	global $db;

	if ($db->querySingle('SELECT COUNT(*) FROM temas WHERE nombre = "'.$nombreTema.'" AND IDcurso = '.$IDcurso) == 0) {
	//	echo "&nbsp;&nbsp;&nbsp;Crear tema ".$nombre."<br />";
		$db->exec('INSERT INTO temas (nombre, descripcion, IDcurso) VALUES ("'.$nombreTema.'", "Descripción del tema '.$nombreTema.'", '.$IDcurso.')');
	} else {
	//	echo "&nbsp;&nbsp;&nbsp;El tema ".$nombre." existe<br />";
	}

	$IDtema = $db->querySingle('SELECT ID FROM temas WHERE nombre = "'.$nombreTema.'" AND IDcurso = '.$IDcurso);
	return $IDtema;
}


function getIDvideo($IDcurso, $IDtema, $nombre, $ruta) {
	global $db;

	if ($db->querySingle('SELECT COUNT(*) FROM videos WHERE nombre = "'.$nombre.'" AND IDtema = '.$IDtema) == 0) {
	//	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Crear video ".$nombre."<br />";
		$db->exec('INSERT INTO videos (nombre, descripcion, ruta, IDtema, IDcurso) VALUES ("'.$nombre.'", "Descripción del vídeo '.$nombre.'", "'.$ruta.'", '.$IDtema.', '.$IDcurso.')');
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