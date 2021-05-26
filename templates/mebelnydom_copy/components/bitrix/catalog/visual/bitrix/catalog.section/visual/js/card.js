    function slickInit(){
        $('.card-imgs__slider').not('.slick-initialized').slick({
          arrows: false,
          dots: true,
          infinite: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          pauseOnHover: false,
          speed: 10,
          fade: true
        });
        // $('.card-imgs__slider').slick('slickPause');
        // $('.card').on('mouseenter', function () {
        //   $(this).find('.card-imgs__slider').slick('slickPlay');
        // });
        // $('.card').on('mouseleave', function () {
        //   $(this).find('.card-imgs__slider').slick('slickPause');
        // });
        
        //$( ".card-imgs__slider" ).mouseleave(function() {
        //   $(this).slick('slickGoTo', 0,  true);
        //});
        $('.card-imgs__slider').bind({
            mouseleave: function() {
                $(this).slick('slickGoTo', 0,  true);
            }
        });
        $('.card .slick-dots li').on('mouseenter', function () {
          $(this).click();
        });
    }




    $(document).ready(function(){
        slickInit();
    })
    $(document).ajaxComplete(function() {
        slickInit();
    });
    // if (window.matchMedia('(max-width: 768px)').matches) {
    //   $('.card-imgs__slider').slick('slickPause');
    // }


    for (let i = 0; i < $('.card').length; i++) {
      let title = $('.card').eq(i).find('.card__title h3');
      if ($('.card').eq(i).find('.slick-dots li').length <= 1) {
        $('.card').eq(i).find('.slick-dots li').remove();
      }
      if (window.matchMedia('(min-width: 1024px)').matches) {
        if ($('.card').eq(i).find('.card__title h3').text().length > 44) {
          title.text(title.text().substring(0, 44) + '...');
        }
      } else {
        if ($('.card').eq(i).find('.card__title h3').text().length > 28) {
          title.text(title.text().substring(0, 28) + '...');
        }
      }
    }
    $('button.like_btn').click(function(){
        if($(this).hasClass('active')){
            $(this).removeClass('active');
        } else {
           $(this).addClass('active');    
        }
    })