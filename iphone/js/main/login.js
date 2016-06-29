/* #####################################################################
   #
   #   Project       : Alfred
   #   Author        : Gauthier Donikian
   #   Version       : 2.0
   #
   ##################################################################### */
   
//############################## GESTION DE LA MODAL ##################################

$(function() {
    
    var $formLogin = $('#login-form');
    var $formLost = $('#lost-form');
    var $formRegister = $('#register-form');
    var $divForms = $('#div-forms');
    var $modalAnimateTime = 300;
    var $msgAnimateTime = 150;
    var $msgShowTime = 2000;

    $("form").submit(function () {
        switch(this.id) {
            case "login-form":
                var $lg_username=$('#login_username').val();
                var $lg_password=$('#login_password').val();
                if ($lg_username == "ERROR") {
                    msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "error", "glyphicon-remove", "Login error");
                } else {
                    msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "success", "glyphicon-ok", "Login OK");
                }
                return false;
                break;
            case "lost-form":
                var $ls_email=$('#lost_email').val();
                if ($ls_email == "ERROR") {
                    msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "error", "glyphicon-remove", "Send error");
                } else {
                    msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "success", "glyphicon-ok", "Send OK");
                }
                return false;
                break;
            case "register-form":
                var $rg_username=$('#register_username').val();
                var $rg_email=$('#register_email').val();
                var $rg_password=$('#register_password').val();
                if ($rg_username == "ERROR") {
                    msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "Register error");
                } else {
                    msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "success", "glyphicon-ok", "Register OK");
                }
                return false;
                break;
            default:
                return false;
        }
        return false;
    });
    
    $('#login_register_btn').click( function () { modalAnimate($formLogin, $formRegister) });
    $('#register_login_btn').click( function () { modalAnimate($formRegister, $formLogin); });
    $('#login_lost_btn').click( function () { modalAnimate($formLogin, $formLost); });
    $('#lost_login_btn').click( function () { modalAnimate($formLost, $formLogin); });
    $('#lost_register_btn').click( function () { modalAnimate($formLost, $formRegister); });
    $('#register_lost_btn').click( function () { modalAnimate($formRegister, $formLost); });
    
    function modalAnimate ($oldForm, $newForm) {
        var $oldH = $oldForm.height();
        var $newH = $newForm.height();
        $divForms.css("height",$oldH);
        $oldForm.fadeToggle($modalAnimateTime, function(){
            $divForms.animate({height: $newH}, $modalAnimateTime, function(){
                $newForm.fadeToggle($modalAnimateTime);
            });
        });
    }
    
    function msgFade ($msgId, $msgText) {
        $msgId.fadeOut($msgAnimateTime, function() {
            $(this).text($msgText).fadeIn($msgAnimateTime);
        });
    }
    
    function msgChange($divTag, $iconTag, $textTag, $divClass, $iconClass, $msgText) {
        var $msgOld = $divTag.text();
        msgFade($textTag, $msgText);
        $divTag.addClass($divClass);
        $iconTag.removeClass("glyphicon-chevron-right");
        $iconTag.addClass($iconClass + " " + $divClass);
        setTimeout(function() {
            msgFade($textTag, $msgOld);
            $divTag.removeClass($divClass);
            $iconTag.addClass("glyphicon-chevron-right");
            $iconTag.removeClass($iconClass + " " + $divClass);
        }, $msgShowTime);
    }
});



//############################## GESTION DE LA MODAL END ##################################

//############################## GESTION DES ACTIONS BLOCS ##################################

// Loading page complete
$(window).load(function()
{
    checkHero(); // Check hero height is correct

});

// Page ready
$(document).ready(function()
{
    $('.hero').css('height', $(window).height()+'px'); // Set initial hero height
    $('#scroll-hero').click(function()
    {
        $('html,body').animate({scrollTop: $("#hero-bloc").height()}, 'slow');
    });
    
    
});

// Window resize 
$(window).resize(function()
{       
    $('.hero').css('height',getHeroHeight()+'px'); // Refresh hero height   
}); 
 
// Get Hero Height
function getHeroHeight()
{
    var H = $(window).height(); // Window height
    
    if(H < heroBodyH) // If window height is less than content height
    {
        H = heroBodyH+100;
    }
    return H
}

// Check hero height
function checkHero()
{
    if($('#hero-bloc').length)
    {
        P = parseInt($('.hero-nav').css('padding-top'))*2
        window.heroBodyH = $('.hero-nav').outerHeight()+P+$('.vc-content').outerHeight()+50; // Set hero body height
        $('.hero').css('height', getHeroHeight() + 'px'); // Set hero to fill page height
    }
}
$(document).ready(function(){

        if($('#modal_button').click()) {
            $('#username').focus();
        };
        

        $('#username').keypress(function(e){
        if(e.keyCode==13){
        $('#connect').click(); 
        }});

        $('#password').keypress(function(e){
        if(e.keyCode==13){
        $('#connect').click(); 
        }});

        $('#login_button').click(function(){
            document.connect_e.submit();
        });
    })