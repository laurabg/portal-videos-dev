<?php
	
	include_once('modulos/functions.php');

	if (!isset($_GET['IDcurso'])) {
		include_once('listadoCursos.php');

	} elseif ( (isset($_GET['IDcurso']))&&(!isset($_GET['IDtema']))&&(!isset($_GET['IDvideo'])) ) {
		$IDcurso = $_GET['IDcurso'];
		include_once('listadoTemas.php');

	} elseif ( (isset($_GET['IDcurso']))&&(isset($_GET['IDtema']))&&(!isset($_GET['IDvideo'])) ) {
		$IDcurso = $_GET['IDcurso'];
		$IDtema = $_GET['IDtema'];
		
		include_once('listadoVideos.php');

	} elseif ( (isset($_GET['IDcurso']))&&(isset($_GET['IDtema']))&&(isset($_GET['IDvideo'])) ) {
		$IDcurso = $_GET['IDcurso'];
		$IDtema = $_GET['IDtema'];
		$IDvideo = $_GET['IDvideo'];
		
		include_once('detalleVideo.php');
	}

?>