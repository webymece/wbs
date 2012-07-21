$(function(){
	
	$("#u_type").click(function(){
		console.log("type? "+$("#u_type").val());
		if($(this).attr('checked') == true) {
			$("#for_presenter").slideDown(500);
		} else {
			$("#for_presenter").slideUp(500);
		}
	});

});
