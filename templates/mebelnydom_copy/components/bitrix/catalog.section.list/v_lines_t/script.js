$(document).on('ready', function(){
    $(".left-nav ul li").each(function(){ 
		var obj = $(this); 
		var submenu = obj.children("ul"); 
		
		if(submenu.length > 0) 
			$(this).children("ul li a").attr('onclick','return false;').after($('<span class="ico-arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></span>'))
			obj.children('a').click(function(){ 
				$(this).attr('onclick','return true;').siblings("ul").slideDown('slow').siblings('.ico-arrow').addClass('fa-rotate-180'); 
			});
  
			obj.children('a').siblings('.ico-arrow').click(function(){
				$(this).siblings('a').removeAttr('style').attr('onclick','return false;');
				$(this).siblings('ul').slideToggle('slow');
				$(this).toggleClass('fa-rotate-180');
			})
	}); 
	$(".left-sidebar-item ul").each(function(){
		var obj1 = $(this);
		if(obj1.length > 0) {
			$(this).parent('.left-sidebar-item').show();
		}
	});
	var pageUrl = window.location.pathname;
	var arPageUrl2 = pageUrl.split('/');
	var arPageUrl = pageUrl.substring(0, pageUrl.indexOf('?')).split('/');
	
	if(arPageUrl != '') {
		var rsPageUrl2 = arPageUrl.slice(-2)[0];
	}else{
		var rsPageUrl2 = arPageUrl2.slice(-2)[0];
	}
	$(".left-nav a").each(function(submenu){
		var objUl = $(this);
		var submenu = objUl.siblings("ul").attr('class');
		var dataName = $('ul').attr('data-name');
		if(objUl.attr('href') === pageUrl){
			$(this).parent('li').parent('ul').css('display', 'block');
			$(this).siblings("ul").css('display', 'block').children('li').siblings(".ico-arrow").children('i.fa').addClass('fa-rotate-180');
		}
	});
});