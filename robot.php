<?php


function buscarCursos($dir) {
	$IDcurso = 0;
	$cont = 0;

	if ($handle = opendir($dir)) {
		while (false !== ($filename = readdir($handle))) {
			if ($filename != "." && $filename != "..") {
				if (is_dir($dir."/".$filename)) {
					$cont++;
				//	echo "Encontrado curso ".$filename."<br />";
					$IDcurso = getIDcurso($filename);
					buscarTemas($IDcurso, $filename, $dir."/".$filename);
				} else {
				//	echo "Los ficheros dentro de cursos no se procesarán <br />";
				}
			}
		}

		if ($cont == 0) {
		//	echo "No existen cursos<br />";
		}
	} else {
	//	echo "Error al leer de ".$dir."<br />";
	}
}

function buscarTemas($IDcurso, $cursoName, $dir) {
	$IDtema = 0;
	$cont = 0;

	if ($handle = opendir($dir)) {
		while (false !== ($filename = readdir($handle))) {
			if ($filename != "." && $filename != "..") {
				// Si existe la carpeta de INBOX, leer su contenido:
				if (is_dir($dir."/".$filename)) {
					$cont++;
				//	echo "&nbsp;&nbsp;&nbsp;Encontrado tema ".$filename."<br />";
					$IDtema = getIDtema($IDcurso, $filename);

					// Comprobar si existen las siguientes carpetas:
					if (!file_exists(_PORTALROOT._VIDEOSDATA.$cursoName)) {
						createDir(_PORTALROOT._VIDEOSDATA.$cursoName);
						createDir(_PORTALROOT._VIDEOSDATA.$cursoName."/".$filename);
						createDir(_PORTALROOT._VIDEOSDATA.$cursoName."/".$filename."/img");
						createDir(_PORTALROOT._VIDEOSDATA.$cursoName."/".$filename."/docs");
					}
					buscarVideos($IDcurso, $IDtema, $cursoName."/".$filename, $dir."/".$filename);

					//echo "Las carpetas dentro de temas no se procesarán <br />";
				} else {
				//	echo "&nbsp;&nbsp;&nbsp;Los ficheros dentro de un curso no se procesarán <br />";
				}
			}
		}

		if ($cont == 0) {
		//	echo "&nbsp;&nbsp;&nbsp;No existen temas para ".$dir."<br />";
		}
	} else {
	//	echo "&nbsp;&nbsp;&nbsp;Error al leer de ".$dir."<br />";
	}
}

function buscarVideos($IDcurso, $IDtema, $cursoTema, $dir) {
	global $extensionesValidas;

	$cont = 0;

	if ($handle = opendir($dir)) {
		while (false !== ($filename = readdir($handle))) {
			if ($filename != "." && $filename != "..") {
				// Si existe la carpeta de INBOX, leer su contenido:
				if (is_dir($dir."/".$filename)) {
					//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Las carpetas dentro de un tema no se procesarán <br />";
				} else {
					$extension = pathinfo($dir."/".$filename, PATHINFO_EXTENSION);
					if (in_array($extension, $extensionesValidas)) {
						$cont++;
					//	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(".$IDcurso." - ".$IDtema.") Encontrado vídeo ".$filename."<br />";
						$IDvideo = getIDvideo($IDcurso, $IDtema, $filename, str_replace(_DIRCURSOS."/", "", $dir));

						$img = getPortada($filename, $cursoTema, $dir);
						if ($img != '') {
							updateVideo($IDvideo, $img);
						}
					}
				}
			}
		}

		if ($cont == 0) {
		//	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No existen vídeos para ".$dir."<br />";
		}
	} else {
	//	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Error al leer de ".$dir."<br />";
	}
	//echo "<br /><br />";
}


function getPortada($nombre, $cursoTema, $ruta) {
	//echo $nombre."<br />";
	//echo $ruta."<br />";

	$ffmpeg = "/usr/bin/ffmpeg";
	$video = $ruta."/".$nombre;
	$img = $cursoTema."/img/".str_replace(".mp4","",$nombre).".jpg";
	$cmd = "$ffmpeg -i ".$video." -ss 3 -vframes 1 -f image2 "._PORTALROOT._VIDEOSDATA.$img;
	//echo $cmd."<br />";
	
	if (!shell_exec($cmd)) {
	//	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OK!!!<br />";
	} else {
	//	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ooohhh....<br />";
	}

	if (file_exists(_PORTALROOT._VIDEOSDATA.$img)) {
	//	echo "<br /><br /><img src=\""._VIDEOSDATA.$img."\" /><br /><br />";
		
		//$db->exec('UPDATE videos SET portada = "'.$img.'" WHERE ID = '.$IDvideo);
	} else {
	//	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ooohhh la foto ("._PORTALROOT._VIDEOSDATA.$img.") no existe....<br />";
	}

	return $img;
}

function createDir($rutaDir) {
	mkdir($rutaDir);
	chmod($rutaDir, 0777);
}

?>