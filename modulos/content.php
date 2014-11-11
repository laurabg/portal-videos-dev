<?php
	
	include_once('modulos/functions.php');

	if ( (isset($_GET['admin']))&&($_GET['admin'] == true) ) {
		include_once('modulos/admin.php');

	} elseif (!isset($_GET['IDcurso'])) {
		include_once('modulos/listadoCursos.php');

	} elseif ( (isset($_GET['IDcurso']))&&(!isset($_GET['IDtema']))&&(!isset($_GET['IDvideo'])) ) {
		$IDcurso = $_GET['IDcurso'];
		include_once('modulos/listadoTemas.php');

	} elseif ( (isset($_GET['IDcurso']))&&(isset($_GET['IDtema']))&&(!isset($_GET['IDvideo'])) ) {
		$IDcurso = $_GET['IDcurso'];
		$IDtema = $_GET['IDtema'];
		
		include_once('modulos/listadoVideos.php');

	} elseif ( (isset($_GET['IDcurso']))&&(isset($_GET['IDtema']))&&(isset($_GET['IDvideo'])) ) {
		$IDcurso = $_GET['IDcurso'];
		$IDtema = $_GET['IDtema'];
		$IDvideo = $_GET['IDvideo'];
		
		include_once('modulos/detalleVideo.php');
	}

?>