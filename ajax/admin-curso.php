<?php

$OUT = '';

$OUT .= '<div class="container">';

	if (isset($_GET['IDcurso'])) {
		$OUT .= 'Admin del curso '.$_GET['IDcurso'];
	} else {
		$OUT .= '***';
	}
	
$OUT .= '</div>';

echo $OUT;

?>