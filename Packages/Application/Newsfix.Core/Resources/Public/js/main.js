$(function () {
	$('#upgradeLink').on('click', function(e) {
		e.preventDefault();
		$('#modalBox').fadeIn();
	});

	$('#decideLater').on('click', function(e) {
		e.preventDefault();
		$('#modalBox').fadeOut();
	});
	$('#modalBox').on('click', function(e) {
		e.preventDefault();
		$('#modalBox').fadeOut();
	});
});