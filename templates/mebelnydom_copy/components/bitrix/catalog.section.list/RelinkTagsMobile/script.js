$(function () {
   $('.wds_certificates_item').each(function () {
      if($(this).hasClass('active')){
          var index = $(this).index() - 1;
          $('.wds_certificates_body').slick('slickGoTo', index);
      }
   });

   $('#mobile-filter-opener').on('click', function () {
       $('#mobile-filter-opener').toggleClass('active');
       $('.product-content .left-sidebar').toggleClass('active');
   });
   
   $( document ).ready(function() {
        console.log( "ready!" );
    });
});