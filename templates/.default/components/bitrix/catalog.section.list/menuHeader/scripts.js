$(document).ready(function() {
    $('.main-menu__item__hero').on('click', function(e) {
      $('.main-menu__item__hero').removeClass('active');
      if (!e.target.closest('.menu__show-more__sec')) {
        $(this).addClass('active');
        if($(this).find('.main-menu__drop__sec').length > 0){
            $('.main-menu__item__hero').addClass('active_mob');
            $('.menu-prev').show();
        } else {
            let href = $(this).find('a.prevent').attr('href');
            window.location.href = href;
        }
      }
    });
    for (let i = 0; i < $('.main-menu__item__hero').length; i++) {
      if (i >= 9) {
        $('.main-menu__item__hero').eq(i).animate({height: 'hide'}, 0).addClass('item-hide');
      }
      for (let x = 0; i < $('.main-menu__item__hero').eq(x).find('.main-menu__item__sec').length; x++) {
        if (x >= 9) {
          $('.main-menu__item__hero').eq(i).find('.main-menu__item__sec').eq(x).animate({height: 'hide'}, 0).addClass('item-hide__sec');
        }
      }
    }
    $('.menu__show-more').on('click', function() {
      $(this).toggleClass('active');
      if ($(this).hasClass('active')) {
        $(this).parents('.main-menu__drop').find('.item-hide').animate({height: 'show'}, 0);
      } else {
        $(this).parents('.main-menu__drop').find('.item-hide').animate({height: 'hide'}, 0);
        $('html, body').animate({
            scrollTop: $('header').offset().top
        }, 0);
      }
    });
    $('.menu-prev').on('click', function() {
      $('.menu-prev').hide();
      $('.main-menu__item__hero').removeClass('active active_mob');
      $(this).toggleClass('active');
      if ($(this).hasClass('active')) {
        $(this).parents('.main-menu__drop__sec').find('.item-hide__sec').animate({height: 'show'}, 0);
      } else {
        $(this).parents('.main-menu__drop__sec').find('.item-hide__sec').animate({height: 'hide'}, 0);
      }
    });
    $('.header-mob-search').on('click', function() {
      $(this).toggleClass('active');
      $('.top-search').toggleClass('active');
      $('.top-search__input').focus();
    });
});