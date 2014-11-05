<?php

dbCreate(_BBDD);

function listarCursos() {
	global $db;
	
	$OUT = '';
	$cont = 0;

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
	
	echo $OUT;
}

function getCabecera($nombre, $desc) {
	$OUT = '';

	$OUT .= '<div class="jumbotron">';
		$OUT .= '<div class="container">';
			$OUT .= '<h1>'.$nombre.'</h1>';
			$OUT .= '<p class="lead">'.$desc.'</p>';
		$OUT .= '</div>';
	$OUT .= '</div>';

	echo $OUT;
}


?>