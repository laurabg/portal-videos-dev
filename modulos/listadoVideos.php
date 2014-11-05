<?php

global $db;

$OUT = '';
$cont = 0;
$numCol = 4;

// Mostrar la cabecera del curso, con su nombre y descripción:
$res = $db->query('SELECT * FROM temas WHERE IDcurso = '.$IDcurso.' AND ID = '.$IDtema);
while ($row = $res->fetchArray()) {
	$OUT .= getCabecera($row['nombre'],$row['descripcion']);
}
$res = null;
	

$OUT .= '<div class="container">';
	$OUT .= '<div class="row">';
	
	$resVideos = $db->query('SELECT * FROM videos WHERE IDcurso = '.$IDcurso.' AND IDtema = '.$IDtema);
	while ($row = $resVideos->fetchArray()) {
//		if ($cont % $numCol == 0) {
//			$OUT .= '</div><div class="row">';
//		} 
		for ($i=0; $i <4 ; $i++) { 
		$OUT .= '<div class="col-sm-6 col-md-'.(12 / $numCol).' video-col">';
			$OUT .= '<div class="thumbnail">';
				$OUT .= '<a class="ver-video" href="#"><span class="glyphicon glyphicon-play play-video"></span>';
				$OUT .= '<img src="'._DIRCURSOS.$row['img'].'" /></a>';
				$OUT .= '<div class="caption">';
					$OUT .= '<h3>'.$row['nombre'].'</h3>';
					$OUT .= '<p>Descripción del vídeo '.$row['nombre'].'</p>';
					$OUT .= '<p><a href="?IDcurso='.$IDcurso.'&IDtema='.$IDtema.'&IDvideo='.$row['ID'].'" class="btn btn-primary" role="button">Ver vídeo</a></p>';
				$OUT .= '</div>';
			$OUT .= '</div>';
		$OUT .= '</div>';
		}
		
		$cont++;

//		$OUT .= '<div class="flowplayer" data-swf="js/flowplayer-5.4.4/flowplayer.swf">';
//			$OUT .= '<video controls>';
//				$OUT .= '<source src="'._DIRCURSOS.$row["ruta"].'" type="video/mp4" />';
//			$OUT .= '</video>';
//		$OUT .= '</div>';
	}
	$OUT .= '</div>';
$OUT .= '</div>';

echo $OUT;
?>