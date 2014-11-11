<?php

include_once('../config.php');
include_once(_DOCUMENTROOT.'db/db.php');

dbAnalyticsCreate(_BBDDANALYTICS);

if ( (isset($_POST['IDcurso']))&&(isset($_POST['IDtema']))&&(isset($_POST['IDvideo'])) ) {
	videoPlayed($_POST['IDcurso'], $_POST['IDtema'], $_POST['IDvideo'], 0);
	echo 'OK';
} else {
	echo 'Faltan datos';
}

?>