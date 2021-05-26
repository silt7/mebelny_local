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
}

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

var lastScrollTop = 0;
$(window).scroll(function(event){
    var st = $(this).scrollTop();
    if (st > lastScrollTop){
        $('#filter-icon-mobile').hide();
    } else {
        $('#filter-icon-mobile').show();
    }
    lastScrollTop = st;
});

$('#filter-icon-mobile').on('click', function () {
    var ofset = $("#mobile-filter-opener").offset().top;
    $("html, body").animate({scrollTop: ofset - 3 }, 300);
    $("#mobile-filter-opener").addClass('active');
    $(".left-sidebar").addClass('active');
});