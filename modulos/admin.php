<?php

global $db;

$OUT = '';
$contentCursos = '';
$cont = 0;

$OUT .= getCabecera('Gestión cursos','Seleccione un curso para editar su contenido, o cree uno nuevo', 0);

$OUT .= '<div class="container">';
	$OUT .= '<div class="row">';
		$OUT .= '<form method="POST" action="" class="form-inline">';
			$OUT .= '<fieldset>';
				$OUT .= '<legend>Cursos</legend>';
				$OUT .= '<input type="hidden" name="admin" value="true" />';
				$OUT .= '<input type="text" placeholder="Nombre del curso" name="curso" />';
				$OUT .= '<button type="submit" class="btn">Crear</button>';
			$OUT .= '</fieldset>';
		$OUT .= '</form>';
	$OUT .= '</div>';
	$OUT .= '<div class="row">';
		/*$OUT .= '<select id="admin-select-curso" name="IDcurso" class="selectpicker">';
			$OUT .= '<option value="" selected>Seleccione un curso</option>';
			$res = $db->query('SELECT * FROM cursos');
			while ($row = $res->fetchArray()) {
				$OUT .= '<option value="'.$row['ID'].'">'.$row['nombre'].'</option>';
			}
		$OUT .= '</select>';*/
	$OUT .= '</div>';

	$OUT .= '<div class="row">';
		$OUT .= '<ul class="nav nav-tabs" id="admin-cursos">';
		$res = $db->query('SELECT * FROM cursos');
		while ($row = $res->fetchArray()) {
			$OUT .= '<li';
			if ($cont == 0) {
				$OUT .= ' class="active"';
			}
			$OUT .= '><a href="#curso-'.$row['ID'].'">'.$row['nombre'].'</a></li>';
			$contentCursos .= '<div class="tab-pane';
			if ($cont == 0) {
				$contentCursos .= ' active';
			}
			$contentCursos .= '" id="curso-'.$row['ID'].'"></div>';
			$cont++;
		}
		$OUT .= '</ul>';
		$OUT .= '<div class="tab-content">';
			$OUT .= $contentCursos;
		$OUT .= '</div>';
	$OUT .= '</div>';
$OUT .= '</div>';

echo $OUT;

?>