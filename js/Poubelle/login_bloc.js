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