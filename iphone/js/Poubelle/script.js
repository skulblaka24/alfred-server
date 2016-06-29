/*

Check si la classe est présente:
!$(".app").hasClass( "active" )

Récupération d'un attribut:
html --> <div id="div1" data="chose"></div>
html --> <div id="div2" data="truc"></div>
js --> $("#div1").attr("data");





*/
$(document).ready(function() {
 	var state = 0;
 	var init = 0;
 	
 	//Fonction quant il y a passage de la souris.
 	$(".app_icon").hover(function () { //true
 		if (state == 1){
      		$(".app").parent().addClass("show_fond");
      		$(".app").parent().addClass("show_button");
  		}
   	}, function() { //false
    	if (state == 1){
    		$(".app").parent().removeClass("show_fond");
    		$(".app").parent().removeClass("show_button");
    	}
  	});

 	//Fonction quant on clique sur l'icone
 	$(".app_icon").on("click", function(){
		if (state == 0){

			// Trigger css to do actions
			$(this).parent().addClass("active");
			$(".app").parent().addClass("show_fond");
			$(".app").parent().addClass("show_button");
			$(".app").parent().addClass("hide_title");//
			$(".app").parent().addClass("show_title_iframe");
			

			if(init == 0){

				//Load la page une premiere fois
				$(this).parent().find(".window").attr('src',$(this).parent().attr("load"));
				init = 1;
			}
			state = 1;
			
		}
		else if (state == 1){
			//Code quant on clique sur l'icone une deuxième fois.
		}
	});
	

	$("#imgr").on("click", function(e){
		e.stopPropagation();
		$(".app_icon").parent().removeClass("active");
		$(".app").parent().removeClass("show_fond");
		$(".app").parent().removeClass("hide_title");
		$(".app").parent().removeClass("show_title_iframe");
		$(".app").parent().removeClass("show_button");
		state =0;
		hover = 0;
	});
	$("#imgf").on("click", function(e){
		e.stopPropagation();
		$(this).parent().parent().find(".window").attr('src',$(this).parent().parent().find(".window").attr("src"));
	});
	$("#imgc").on("click", function(e){
		e.stopPropagation();
		$(".app").parent().find(".window").attr('src', null);
		$(".app_icon").parent().removeClass("active");
		$(".app").parent().removeClass("show_fond");
		$(".app").parent().removeClass("hide_title");
		$(".app").parent().removeClass("show_title_iframe");
		$(".app").parent().removeClass("show_button");
		init = 0;
		state =0;
		hover = 0;
	});

	
});