$(document).ready(function () {
    $('.tabs .tab-link').click(function () {
        var tab_id = $(this).attr('data-tab');

        $('.tabs .tab-link').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#" + tab_id).addClass('current');
    })
    
    
})

// ссылки в формат JS+SPAN
$("body").on("click", ".jspan_location", function () {
    if ($(this).attr("data-target")) {
        window.open($(this).data("location"));
    } else {
        location.href = $(this).data("location");
    }
});