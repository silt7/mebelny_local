/**
 * Created by volodimir on 8/4/17.
 */
$(document).ready(function(){
    // "use strict"
    $("#example_id").ionRangeSlider({
        type: "double",
        grid: true,
        min: 0,
        max: 250000,
        from: 12000,
        to: 103000
    });
    $("#example_id-1").ionRangeSlider({
        type: "double",
        grid: true,
        min: 0,
        max: 250000,
        from: 12000,
        to: 103000
    });
    $('.open-filter').on('click',function () {
        $('body').addClass("filter-active");
        $('.filter').addClass("filter-active");
        BX.setCookie('filter-open', 'Y', {expires: 31500000, path: '/'});
    });
    $('.close-filter').on('click',function () {
        $('body').removeClass("filter-active");
        $('.filter').removeClass("filter-active");
        BX.setCookie('filter-open', 'N', {expires: 31500000, path: '/'});
    });
    /*$('.like i').on('click',function () {
        if($(this).hasClass("active")){
            $(this).removeClass('active');
        } else{
            $(this).addClass('active');
        }
    });
    $('.like .active').on('click',function () {
        $(this).removeClass("active");
    });*/
    $('.filter-bg').on('click',function () {
        $('body').removeClass("filter-active");
        $('.filter').removeClass("filter-active");
    })
});

