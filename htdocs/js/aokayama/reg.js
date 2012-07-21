$(function(){
	
	$("#place_id").change(function(){
		console.log("type? "+$("#place_id").val());
		if($(this).val() == 4) {
			$("#hiddenInput").slideDown(500);
		} else {
			$("#hiddenInput").slideUp(500);
		}
	});

});
