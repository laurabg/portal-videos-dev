<?php

function listarCursos() {
	global $db;
	
	$OUT = '';
	$cont = 0;

	$OUT .= '<div class="container">';
		$OUT .= '<div class="panel panel-primary">';
			$OUT .= '<div class="panel-heading">Cursos disponibles</div>';
			$OUT .= '<div class="panel-body">';
				$OUT .= '<div class="row">';
				
				$res = $db->query('SELECT * FROM cursos');
				while ($row = $res->fetchArray()) {
					if ($cont % 3 == 0) {
						$OUT .= '</div><div class="row">';
					} 
					$OUT .= '<div class="col-sm-6 col-md-4">';
						$OUT .= '<div class="thumbnail">';
							$OUT .= '<div class="caption">';
								$OUT .= '<h3>'.$row['nombre'].'</h3>';
								$OUT .= '<p>'.$row['descripcion'].'</p>';
								$OUT .= '<p><a href="?IDcurso='.$row['ID'].'" class="btn btn-primary" role="button">Acceder al curso</a></p>';
							$OUT .= '</div>';
						$OUT .= '</div>';
					$OUT .= '</div>';
					
					$cont++;
				}
				$OUT .= '</div>';
			$OUT .= '</div>';
		$OUT .= '</div>';
	$OUT .= '</div>';
	
	return $OUT;
}

function listarContenidoCurso($IDcurso) {
	global $db;

	$OUT = '';
	
	$res = $db->query('SELECT * FROM cursos WHERE ID = '.$IDcurso);
	while ($row = $res->fetchArray()) {
		$OUT = getCabecera($row['nombre'], $row['descripcion']);
	}
	
	$OUT .= '<div class="container">';
		
	$res = $db->query('SELECT * FROM temas WHERE IDcurso = '.$IDcurso);
	while ($row = $res->fetchArray()) {
		$OUT .= '<div class="panel panel-primary">';
			$OUT .= '<div class="panel-heading">'.$row['nombre'].'</div>';
			$OUT .= '<div class="panel-body">';
				$OUT .= listarVideos($IDcurso, $row['ID']);
			$OUT .= '</div>';
		$OUT .= '</div>';
	}
	$OUT .= '</div>';

	return $OUT;
}


function listarVideos($IDcurso, $IDtema) {
	global $db;

	$OUT = '';
	
	$OUT .= '<div class="row">';
	
	$cont = 0;

	$resVideos = $db->query('SELECT * FROM videos WHERE IDcurso = '.$IDcurso.' AND IDtema = '.$IDtema);
	while ($row = $resVideos->fetchArray()) {
		if ($cont % 3 == 0) {
			$OUT .= '</div><div class="row">';
		} 
		$OUT .= '<div class="col-sm-6 col-md-4 video-col">';
			$OUT .= '<div class="thumbnail">';
				$OUT .= '<a class="ver-video" href="#"><span class="glyphicon glyphicon-play play-video"></span>';
				$OUT .= '<img src="'._DIRCURSOS.$row['img'].'" /></a>';
				$OUT .= '<div class="caption">';
					$OUT .= '<h3>'.$row['nombre'].'</h3>';
					$OUT .= '<p>Descripción del vídeo '.$row['nombre'].'</p>';
					$OUT .= '<p><a href="#" class="btn btn-primary" role="button">Ver vídeo</a></p>';
				$OUT .= '</div>';
			$OUT .= '</div>';
		$OUT .= '</div>';
		
		$cont++;

	//	$OUT .= '<div class="flowplayer" data-swf="js/flowplayer-5.4.4/flowplayer.swf">';
	//		$OUT .= '<video controls>';
	//			$OUT .= '<source src="'._DIRCURSOS.$row["ruta"].'" type="video/mp4" />';
	//		$OUT .= '</video>';
	//	$OUT .= '</div>';
	}
	$OUT .= '</div>';
	
	return $OUT;
}

function getCabecera($nombre, $desc) {
	$OUT = '';

	$OUT .= '<div class="jumbotron">';
		$OUT .= '<div class="container">';
			$OUT .= '<h1>'.$nombre.'</h1>';
			$OUT .= '<p class="lead">'.$desc.'</p>';
		$OUT .= '</div>';
	$OUT .= '</div>';

	return $OUT;
}

?>