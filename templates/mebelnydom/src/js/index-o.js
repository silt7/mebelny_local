/* globals jQuery */
$(document).ready(function(){
    // "use strict"
    var ScreenWidth = screen.width;
    $('.catalog__product li a').on('mouseover', function () {
        $(this).addClass('active');
        $('.right-wrap').addClass('block-none');
    });
    $('.type-product>li').on('mouseover',function () {
        $('.type-product>li').removeClass('active');
        $('.type-product li ul').removeClass('active');
        $(this).addClass('active');
        if(ScreenWidth < 737){
            $('.type-product>li').css('transform','translateX(-100%)');
            $('.back-1').addClass('active');
        }
    });
    $('.firm-product>li').on('click',function () {
        $('.firm-product>li').removeClass('active');
        if(ScreenWidth < 737){
            $('.firm-product>li').css('transform','translateX(-100%)');
            $('.back-1').removeClass('active');
            $('.back-2').addClass('active');
        }
        $('.firm-product li ul').removeClass('active');
        $(this).addClass('active');
    });
	    if (screen.width < 737) {
		    $('a[data-haschild]').removeAttr('href');
	    }
    $('.back-2').on('click',function () {
        $('.firm-product>li').css('transform','translateX(0%)');
        $('.firm-product>li').removeClass('active');
        $(this).removeClass('active');
    });
    $('.back-1').on('click',function () {
        $('.type-product>li').css('transform','translateX(0%)');
        $('.type-product>li').removeClass('active');
    });
    $('.alezi-list>li').on('click',function () {
        $('.alezi-list>li').removeClass('active');
        $(this).addClass('active');
    });
    $('.main-menu__catalog').on('click',function () {
        $('.catalog').addClass('active');
    });
    $('.search-btn').on('click',function () {
        $('.search-close').addClass('active');
        $('.search input').addClass('active');
    });
    $('.search-close, body').on('click',function () {
        $(this).removeClass('active');
        $('.search input').removeClass('active');
    });
    $('.left-sidebar header').on('click',function () {
        $(this).addClass('active-header');
        $('.sidebar-list').addClass('active');
    });
    setTimeout(function () {
        $('.active-header').on('click',function () {
            $(this).removeClass('active-header');
            $('.sidebar-list').removeClass('active');
        });
    },500);
    $('.close').on('click',function () {
        $('.catalog').removeClass('active');
        $('.right-wrap').removeClass('block-none');
        $('.type-product>li').css('transform','translateX(0%)');
        $('.type-product>li').removeClass('active');
        $('.firm-product>li').css('transform','translateX(0%)');
        $('.firm-product>li').removeClass('active');
        $('.back-1,.back-2').removeClass('active');
    });
    $('#our-town').select2();
    $('.like i').on('click',function () {
        if($(this).hasClass("active")){
            $(this).removeClass('active');
        } else{
            $(this).addClass('active');
        }
    });
});
