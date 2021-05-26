$(document).on('ready', function(){
	console.log('new');
	if($('.left-menu-depth-3').length){
		$('.left-menu-depth-3').siblings('a').attr('onclick','return false;').after($('<span class="ico-arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></span>'));
	}
	$('.left-menu-depth-2>li>a').on('click', function(){
		$(this).css('color','#3983df').siblings('.left-menu-depth-3').slideDown('slow');
		$(this).siblings('.ico-arrow').addClass('fa-rotate-180');
		$(this).attr('onclick','return true;');
	});
	$('.ico-arrow').on('click', function(){
		$(this).siblings('a').removeAttr('style').attr('onclick','return false;');
		$(this).siblings('.left-menu-depth-3').slideToggle('slow');
		$(this).toggleClass('fa-rotate-180');
	});
});