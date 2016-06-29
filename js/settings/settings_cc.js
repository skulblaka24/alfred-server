/* #####################################################################
   #
   #   Project       : Alfred
   #   Author        : Gauthier Donikian
   #   Version       : 2.0
   #
   ##################################################################### */
/*
	Check si la classe est présente:
	!$(".app").hasClass( "active" )

	Récupération d'un attribut:
	html --> <div id="div1" data="chose"></div>
	html --> <div id="div2" data="truc"></div>
	js --> $("#div1").attr("data");
	
	$('.nav-img').removeAttr('src', '../../img/logout.png');
	$('.nav-img').attr('src', '../../img/logout.png');


	$(".app_icon").parent().attr("data")
	&& (data=="true")

	alert(data);
*/
$(document).ready(function(){
	
	$('#name').focus();

	var _id;
	var _name;
	var _relai;
	// Fonction quand il y a click
	$('.img-mod').click(function () { // true
		// EFFACER LES .val()
		_id = $(this).attr('data-id');
		
		_name = $(".rel_tab_n"+_id).attr('data-name');
		var _desc = $(".rel_tab_d"+_id).attr('data-desc');
		_relai = $(".rel_tab_r"+_id).attr('data-relai');
		var _time = $(".rel_tab_t"+_id).attr('data-time');
		var _freq = $(".rel_tab_f"+_id).attr('data-freq');
		
		var _pin = $(".rel_tab_p"+_id).attr('data-pin');
		var _tel = $(".rel_tab_te"+_id).attr('data-tel');
		var _rec = $(".rel_tab_re"+_id).attr('data-rec');
		
		var _room = $(".rel_tab_ro"+_id).attr('data-room');
		var _type = $(".rel_tab_ty"+_id).attr('data-type');
		var _cmd = $(".rel_tab_c"+_id).attr('data-cmd');
		
		var _ip = $(".rel_tab_i"+_id).attr('data-ip');
		var _port = $(".rel_tab_po"+_id).attr('data-port');
		var _login = $(".rel_tab_l"+_id).attr('data-login');
		var _password = $(".rel_tab_pa"+_id).attr('data-password');
		
		// Remplissage des inputs
		$("#name").val(_name);
		$("#description").val(_desc);
		
		// Select Menu
		$("#relai").val(_relai);
		// Select Menu
		$("#time").val(_time);
		
		$("#freq").val(_freq);
		$("#pin").val(_pin);
		$("#tel").val(_tel);
		
		// Select Menu
		$("#room").val(_room);
		
		$("#rec").val(_rec);
		
		// Select Menu
		$("#type").val(_type);
		
		$("#cmd").val(_cmd);
		$("#ip").val(_ip);
		
		$("#port").val(_port);
		$("#login").val(_login);
		$("#passport").val(_password);
		
		// Injecte nouvelle valeur dans le bouton
		$("#addSqlLine").text("Modifier");
		$("#addSqlLine").attr('value', "Modifier");
		
		
	});
	
	$('.btn-submit').click(function(){
		
		if ($('.btn-submit').attr('value') == 'Modifier') {
			// Passage de l'id dans la db pour update correct
			$("#name").val($("#name").val()+"-"+_id);
			// Vérification des inputs
		}
		else {
			// Vérification des inputs
			
			// Verification int etc
		}
		
		document.addsql_e.submit();
	});
	
	
	// Surveille le changement d'état de #relai pour déverrouiller ou verrouiller les inputs
	$( "#relai" ).change(function() {
		//alert('La valeur de _relai ='+$("#relai").val());
		 
  		if ($("#relai").val() == 'filaire') {
			$('#tel').attr('disabled', 'disabled');
			$('#rec').attr('disabled', 'disabled');
			$('#cmd').attr('disabled', 'disabled');
			$('#ip').attr('disabled', 'disabled');
			$('#port').attr('disabled', 'disabled');
			$('#login').attr('disabled', 'disabled');
			$('#password').attr('disabled', 'disabled');
			
			$('#pin').removeAttr("disabled");
			
			  
		} else if ($("#relai").val() == 'radio') {
			$('#cmd').attr('disabled', 'disabled');
			$('#ip').attr('disabled', 'disabled');
			$('#port').attr('disabled', 'disabled');
			$('#login').attr('disabled', 'disabled');
			$('#password').attr('disabled', 'disabled');
			
			$('#pin').removeAttr("disabled");
			$('#tel').removeAttr("disabled");
			$('#rec').removeAttr("disabled");
			
			 
		} else if ($("#relai").val() == 'cmd') {
			$('#pin').attr('disabled', 'disabled');
			$('#tel').attr('disabled', 'disabled');
			$('#rec').attr('disabled', 'disabled');
			$('#ip').attr('disabled', 'disabled');
			$('#port').attr('disabled', 'disabled');
			$('#login').attr('disabled', 'disabled');
			$('#password').attr('disabled', 'disabled');
			
			
			$('#cmd').removeAttr("disabled");
			
			  
		} else if ($("#relai").val() == 'rfilaire') {
			$('#tel').attr('disabled', 'disabled');
			$('#rec').attr('disabled', 'disabled');
			$('#cmd').attr('disabled', 'disabled');
			
			$('#pin').removeAttr("disabled");
			$('#ip').removeAttr("disabled");
			$('#port').removeAttr("disabled");
			$('#login').removeAttr("disabled");
			$('#password').removeAttr("disabled");
			  
		} else if ($("#relai").val() == 'rradio') {
			$('#cmd').attr('disabled', 'disabled');
			
			$('#pin').removeAttr("disabled");
			$('#tel').removeAttr("disabled");
			$('#rec').removeAttr("disabled");
			$('#ip').removeAttr("disabled");
			$('#port').removeAttr("disabled");
			$('#login').removeAttr("disabled");
			$('#password').removeAttr("disabled");
			  
		} else if ($("#relai").val() == 'rcmd') {
			$('#pin').attr('disabled', 'disabled');
			$('#tel').attr('disabled', 'disabled');
			$('#rec').attr('disabled', 'disabled');
			
			$('#pin').removeAttr("disabled");
			$('#tel').removeAttr("disabled");
			$('#rec').removeAttr("disabled");
			  
		}
	});
	$( "#time" ).change(function() {
		if ($("#time").val() == 'normal') {
			$('#freq').attr('disabled', 'disabled');
		} else if ($("#time").val() == 'impulsion') {
			$('#freq').removeAttr("disabled");
		}
	});
});