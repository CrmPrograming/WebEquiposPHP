function mostrarTutorial() {
	intro = introJs();
	intro.setOptions({		
		prevLabel: '&larr;',
		nextLabel: '&rarr;',
		skipLabel: 'Terminar',
		doneLabel: 'Hecho',
		exitOnEsc: true,
		exitOnOverlayClick: true,
		showStepNumers: true
	});
	intro.start();
}