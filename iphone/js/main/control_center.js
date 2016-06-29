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


	$(".app_icon").parent().attr("data")
	&& (data=="true")

	alert(data);
*/
//############################## GESTION DU MENU ##################################
$(document).ready(function () {

		var _amp = $('#button_menu_amp');
		var _pri = $('#button_menu_pri');
		var _cmd = $('#button_menu_cmd');
		var _room = $('#button_menu_room');
		var _oth = $('#button_menu_oth');

		var _switch = "";

		_amp.on('click', function () {
			if (_amp.attr('state') == 0) {

					// Gestion de la selection des boutons 'surlignage'
					_amp.addClass('surligne');_pri.removeClass('surligne');_cmd.removeClass('surligne');_room.removeClass('surligne');_oth.removeClass('surligne');
					_amp.attr('state', 1);_pri.attr('state', 0);_cmd.attr('state', 0);_room.attr('state', 0);_oth.attr('state', 0);
					
					// Apparition des boutons
					$('.amp_menu').addClass('show');
					$('.pri_menu').removeClass('show');
					$('.cmd_menu').removeClass('show');
					$('.room_menu').removeClass('show');
					$('.oth_menu').removeClass('show');
					_switch.removeClass('show');
			}
		});
		_pri.on('click', function () {
			if (_pri.attr('state') == 0) {

					// Gestion de la selection des boutons 'surlignage'
					_pri.addClass('surligne');_amp.removeClass('surligne');_cmd.removeClass('surligne');_room.removeClass('surligne');_oth.removeClass('surligne');
					_pri.attr('state', 1);_amp.attr('state', 0);_cmd.attr('state', 0);_room.attr('state', 0);_oth.attr('state', 0);
					
					$('.pri_menu').addClass('show');
					$('.amp_menu').removeClass('show');
					$('.cmd_menu').removeClass('show');
					$('.room_menu').removeClass('show');
					$('.oth_menu').removeClass('show');
					_switch.removeClass('show');
			}
		});
		_cmd.on('click', function () {
			if (_cmd.attr('state') == 0) {

					// Gestion de la selection des boutons 'surlignage'
					_cmd.addClass('surligne');_amp.removeClass('surligne');_pri.removeClass('surligne');_room.removeClass('surligne');_oth.removeClass('surligne');
					_cmd.attr('state', 1);_amp.attr('state', 0);_pri.attr('state', 0);_room.attr('state', 0);_oth.attr('state', 0);
					$('.cmd_menu').addClass('show');
					$('.amp_menu').removeClass('show');
					$('.pri_menu').removeClass('show');
					$('.room_menu').removeClass('show');
					$('.oth_menu').removeClass('show');
					_switch.removeClass('show');
			}
		});
		_room.on('click', function () {
			if (_room.attr('state') == 0) {

					// Gestion de la selection des boutons 'surlignage'
					_room.addClass('surligne');_amp.removeClass('surligne');_pri.removeClass('surligne');_cmd.removeClass('surligne');_oth.removeClass('surligne');
					_room.attr('state', 1);_amp.attr('state', 0);_pri.attr('state', 0);_cmd.attr('state', 0);_oth.attr('state', 0);
					//$('.room_menu').addClass('show');
					$('.room_choice').addClass('show_room_choice');					

					$('.amp_menu').removeClass('show');
					$('.pri_menu').removeClass('show');
					$('.cmd_menu').removeClass('show');
					$('.oth_menu').removeClass('show');
					_switch.removeClass('show');
			}
		});
		_oth.on('click', function () {
			if (_oth.attr('state') == 0) {

					// Gestion de la selection des boutons 'surlignage'
					_oth.addClass('surligne');_amp.removeClass('surligne');_pri.removeClass('surligne');_cmd.removeClass('surligne');_room.removeClass('surligne');
					_oth.attr('state', 1);_amp.attr('state', 0);_pri.attr('state', 0);_cmd.attr('state', 0);_room.attr('state', 0);
					$('.oth_menu').addClass('show');
					$('.amp_menu').removeClass('show');
					$('.pri_menu').removeClass('show');
					$('.cmd_menu').removeClass('show');
					$('.room_menu').removeClass('show');
					_switch.removeClass('show');
			}
		});
		$('.room_choice').on('click', function () {
			_room.removeClass('surligne');
			_room.attr('state', 0);
			$('.room_choice').removeClass('show_room_choice');
		});
		$('.btn_room').on('click', function (e) {
	
			e.stopPropagation();
			_room.removeClass('surligne');
			_room.attr('state', 0);
			$('.room_choice').removeClass('show_room_choice');

			var _app = $('.'+$(this).attr('room_name')+'_menu');
			_switch = _app;
			_app.addClass('show');
		});
		$('.btn_relai').on('click', function (e) {
			e.stopPropagation();
			var data = ("relai=" + $(this).attr('data-id'));//+  "&content=" + content;
			getOutput(data);

		});










// ###########################################################################
		// handles the click event for link 1, sends the query
		function getOutput(data) {
		  getRequest(
		      '../../iphone/page/action/action_relai.php', // URL for the PHP file
		       drawOutput,  // handle successful request
		       drawError,
		       data   // handle error
		  );
		  return false;
		}  
		// handles drawing an error message
		function drawError() {
		    var container = document.getElementById('output');
		    container.innerHTML = 'Bummer: there was an error!';
		}
		// handles the response, adds the html
		function drawOutput(responseText) {
		    var container = document.getElementById('output');
		    container.innerHTML = responseText;
		    // <div id="output">waiting for action</div>
		}
		// helper function for cross-browser request object
		function getRequest(url, success, error, data) {
		    var req = false;
		    try{
		        // most browsers
		        req = new XMLHttpRequest();
		    } catch (e){
		        // IE
		        try{
		            req = new ActiveXObject("Msxml2.XMLHTTP");
		        } catch(e) {
		            // try an older version
		            try{
		                req = new ActiveXObject("Microsoft.XMLHTTP");
		            } catch(e) {
		                return false;
		            }
		        }
		    }
		    if (!req) return false;
		    if (typeof success != 'function') success = function () {};
		    if (typeof error!= 'function') error = function () {};
		    req.onreadystatechange = function(){
		        if(req.readyState == 4) {
		            return req.status === 200 ? 
		                success(req.responseText) : error(req.status);
		        }
		    }
		    req.open("POST", url, true);
		    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		    req.send(data);
		    return req;
		}

// #########################################################################

});





