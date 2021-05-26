/**
 * Created by volodimir on 8/7/17.
 */

$(document).ready(function(){
    // "use strict"
    var clock = $('#clock');
    if (clock.length > 0) {
        $('#clock').countdown($('#clock').data('final'), function(event) {
            $(this).html(event.strftime('<p>%D<span>дней</span></p> : <p>%H<span>часов</span></p> : <p>%M<span>минут</span></p> : <p>%S<span>секунд</span></p>'));
        });
    }
    $('.slider-photo-main').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      fade: true,
      arrows: false,
      asNavFor: '.slider-photo-small'
    });
    $('.slider-photo-small').slick({
      slidesToScroll: 1,
      asNavFor: '.slider-photo-main',
      dots: false,
      arrows: true,
      centerPadding: '0px',
      slidesToShow: 4,
      vertical: true,
      centerMode: true,
      focusOnSelect: true,
      responsive: [
        {
          breakpoint: 1025,
          settings: {
            slidesToShow: 2,
            centerPadding: '0px',
            vertical: false,
          }
        }
      ]
    });
    /*$('.recomend-slider').slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      dots:false,
      responsive: [
        {
          breakpoint: 1025,
          settings: {
            slidesToShow: 3,
          }
        },
        {
          breakpoint: 737,
          settings: {
            arrows:false,
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 1,
          }
        }
      ]
    });*/
    var i = 0;
    $('.quantity').on('click',function () {
        if($(this).hasClass("active")){
            $(this).removeClass('active');
        } else{
            $(this).addClass('active');
        }
    });
    $('.tabs label').on('click',function () {
        if($('.tabs label').hasClass("active")){
            $('.tabs label').removeClass('active');
        }
        $(this).addClass('active');
    });
});