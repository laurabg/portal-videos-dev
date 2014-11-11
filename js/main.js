$(document).ready(function() {
	var sPageURL = window.location.search.substring(1);
	var sURLVariables = sPageURL.split('&');

	firstPlay = 1;
	$('video').on('play', function() {
		if (firstPlay == 1) {

			$.ajax({
				type: 'POST',
				async: true,
				url: 'ajax/videoPlayed.php',
				data: sPageURL,
				success: function(msg) {
					alert(msg);
				}
			});
			
			firstPlay = 0;
		}
	});
	
	// Tabs para cursos:
	$('#admin-cursos a').click(function() {
		divCurso = $(this).attr('href');
		IDcurso = divCurso.replace('#curso-','');

		$(this).tab('show');
		$(divCurso).load('ajax/admin-curso.php?IDcurso='+IDcurso, function() {});
	});

	// Cargar el contenido de la primera pestaña:
	divCurso = $('div.tab-content').children('.active').attr('id');
	IDcurso = divCurso.replace('curso-','');

	$('#'+divCurso).load('ajax/admin-curso.php?IDcurso='+IDcurso, function() {});

});