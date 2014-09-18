<?php

function listarCursos() {
	global $db;
	$content = "";
	$OUT = "";

	$resCursos = $db->query('SELECT * FROM cursos');
	$i = 0;
	while ($row = $resCursos->fetchArray()) {
		$OUT .= '<div class="row">';
			$OUT .= '<h2>'.$row['nombre'].'</h2>';

			$resTemas = $db->query('SELECT * FROM temas WHERE IDcurso = '.$row['ID']);
			while ($rowTema = $resTemas->fetchArray()) {
				$OUT .= '<div class="col-md-4">';
					$OUT .= '<h3>'.$rowTema['nombre'].'</h3>';
				$OUT .= '</div>';
			}
		$OUT .= '</div>';
	}

	return $OUT;
}

/*********************************************************************
 listCursos: Lista los cursos de la BBDD
 *********************************************************************/
function listCursos() {
	$OUT = "";
	$dbcon = dbConnection();
	
	$SQL = "SELECT * FROM cursos";
	$res = sqlite_query($dbcon, $SQL);
	if (!$res) {
		die ("Cannot execute query<br />$SQL");
	}
	
	while ($row = sqlite_fetch_array($res, SQLITE_ASSOC)) {
		$OUT .= listVideos($row["id"], $row["nombre"]);
	}
	
	echo $OUT;
}


/*********************************************************************
 listVideos: Lista los videos de un curso
 Parámetros:
	@IDcurso				Identificador del curso
 *********************************************************************/
function listVideos($IDcurso, $nombreCurso) {
	$OUT = "";
	
	$dbcon = dbConnection();
	
	$SQL = "SELECT * FROM videos WHERE curso = '".$IDcurso."' ORDER BY id DESC LIMIT "._NUMVIDEOSHOME;
	$res = sqlite_query($dbcon, $SQL);
	if (!$res) {
		die ("Cannot execute query<br />$SQL");
	}
	
	if (sqlite_num_rows($res) > 0) {
		$OUT .= '<div class="panel panel-default">';
		$OUT .= '<div class="panel-heading"><h3 class="panel-title">'.$nombreCurso.'</h3></div>';
		$OUT .= '<div class="panel-body"><div class="row">';
	}
	
	while ($row = sqlite_fetch_array($res, SQLITE_ASSOC)) {
		$OUT .= '<div class="col col-md-3">';
			$OUT .= '<div class=""><a href="?IDcurso='.$IDcurso.'&IDvideo='.$row['id'].'">'.$row["nombre"].'</a></div>';
		//	$OUT .= '<div class="flowplayer" data-swf="js/flowplayer-5.4.4/flowplayer.swf">';
		//		$OUT .= '<video controls>';
		//			$OUT .= '<source src="'._DIRCURSOS.'/'.$row["ruta"].'/'.$row["nombre"].'" type="video/mp4" />';
		//		$OUT .= '</video>';
		//	$OUT .= '</div>';
		$OUT .= '</div>';
	}
	
	if (sqlite_num_rows($res) > 0) {
		$OUT .= '</div><div class="row"><a href="?IDcurso='.$IDcurso.'"><button class="btn btn-default">Ver curso completo</button></a></div>';
		$OUT .= '</div></div>';
	}
	
	return $OUT;
}

?>