// Количество выбранных чекбоксов
var count = 0;
$(function () {
    count = $('.wds_fltr_categories input:checked').length;
    displayCount();

    $('.wds_fltr_categories input').bind('click', function (e, a) {
        if (this.checked) {
            count += a ? -1 : 1;
        } else {
            count += a ? 1 : -1;
        }
        displayCount();
    });
    $('#invert').click(function (e) {
        $('#wds_fltr_count').text(0);
        $('.wds_fltr_categories input').removeAttr("checked");
        count = 0;
    });
});
function displayCount() {
    $('#wds_fltr_count').text(count);
};

// При скроле, прячем плавующую кнопку "Показать" и фиксируем фильтр
// $(window).scroll(function () {
//     $('.modef-wrap').hide();
//     var height = $(window).scrollTop();
//     if (height > 200) {
//         $("#kombox-filter").addClass('wds_fixed_filter');
//     } else {
//         $("#kombox-filter").removeClass('wds_fixed_filter');
//     }
// });
// $('.wds_chkbox_checkmark').click(function () {
//     $('.modef-wrap').show();
// });

var lastScrollTop = 0, delta = 5;
$(window).scroll(function(event){
    if($(document).width() < 1000){
        var st = $(this).scrollTop();
        if(Math.abs(lastScrollTop - st) <= delta)
           return;
        if (st > lastScrollTop){
           $('.filter-icon').fadeOut(500);
        } else {
            $('.filter-icon').fadeIn(500);
        }
        lastScrollTop = st;
    }
});
$('.filter-icon').click(function (e) {
  e.preventDefault();
  $('body,html').animate({
    scrollTop: $('#filter').offset().top - 150
  }, 1000);
  if (!$('.filter__wrap').hasClass('filter__wrap__active')) {
    $('.filter-open').click();
  }
});
$('.filter-open').click(function () {
  $('.filter__wrap').toggleClass('filter__wrap__active');
  if ($('.filter__wrap').hasClass('filter__wrap__active')) {
    $('.filter__wrap').animate({
      height: 'show'
    }, 500);
  } else {
    $('.filter__wrap').animate({
      height: 'hide'
    }, 500);
  }
});

/*$('#filter-icon-mobile').on('click', function () {
    var ofset = $("#mobile-filter-opener").offset().top;
    $("html, body").animate({scrollTop: ofset - 3 }, 300);
    $("#mobile-filter-opener").addClass('active');
    $(".left-sidebar").addClass('active');
});
$('.filter-category__title').on('click', function () {
      $(this).parents('.filter-category__item').toggleClass('filter-category__item__active');
      if ($(this).parents('.filter-category__item').hasClass('filter-category__item__active')) {
        $(this).parents('.filter-category__item').find('.filter-category__drop').animate({
          height: 'show'
        }, 300);
      } else {
        $(this).parents('.filter-category__item').find('.filter-category__drop').animate({
          height: 'hide'
        }, 300);
      }
});

$('.filter-icon').click(function (e) {
  e.preventDefault();
  $('body,html').animate({
    scrollTop: $('#filter').offset().top - 150
  }, 1000);
  if (!$('.filter__wrap').hasClass('filter__wrap__active')) {
    $('.filter-open').click();
  }
});;
$(document).scroll(function () {
  if ($(document).scrollTop() > $('.catalog__content').offset().top + 250) {
    $('.filter-icon').fadeIn(500);
  } else {
    $('.filter-icon').fadeOut(500);
  }
})*/