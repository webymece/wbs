$(document).ready(function(){
	$(".presenter").click(function(){
		if($(this).attr("data-lock") != undefined && $(this).attr("data-lock") == "true"){
			return;
		}
		var children_p = $(this).children("p");
		var children_h4 = $(this).children("h4");
		if($(this).attr("data-flag") != undefined && $(this).attr("data-flag") == "false"){
			$(this).attr("data-lock","true");
			//if($(children_h4).css("margin") == "-30px 30px 0px 0px"){
			//$(children_p).attr("style","display:none;");
			var that = $(this);
			$(children_h4).fadeOut(400);
			$(children_p).slideUp(500,
				function(){
					$(children_h4).css("margin","-30px 30px 0px 0px");
					$(children_h4).fadeIn(400);
					$(that).attr("data-lock","false");
					$(that).attr("data-flag","true");
				});

		}else{
			$(this).attr("data-lock","true");
			$(children_h4).fadeOut(400);
			var that = $(this);
			$(children_p).slideDown(500,
				function(){
					$(children_h4).css("margin","0px 30px 0px 0px");
					$(children_h4).fadeIn(400);
					$(that).attr("data-flag","false");
					$(that).attr("data-lock","false");
				});
		}
	});
});
