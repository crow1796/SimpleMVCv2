$(document).ready(function(){

	// $('.flash').delay(5000).slideUp('slow');

	$('#sampleajaxbtn').on('click', function(e){
		$.ajax({
			url: 'sampleajax',
			type: 'POST',
			success: function(data){
				// var d = $.parseJSON(data);
				// alert(d[0]);
				var d = $.parseJSON(data);
				alert(d[1].name);
			}
		});
	});
});
