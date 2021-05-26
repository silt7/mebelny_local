"use strict";
$(document).ready(function () {
    $("#clock").countdown($("#clock").data('final'), function (s) {
        $(this).html(s.strftime("<p>%D<span>дней</span></p> : <p>%H<span>часов</span></p> : <p>%M<span>минут</span></p> : <p>%S<span>секунд</span></p>"))
    }), $(".slider-photo-main").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: !0,
        arrows: !1,
        asNavFor: ".slider-photo-small"
    }),
        $(".slider-photo-small").slick({
        slidesToScroll: 1,
        asNavFor: ".slider-photo-main",
        dots: !1,
        arrows: !0,
        centerPadding: "0px",
        slidesToShow: 4,
        vertical: !0,
        centerMode: !0,
        focusOnSelect: !0,
        responsive: [{breakpoint: 1025, settings: {slidesToShow: 3, centerPadding: "0px", vertical: !1}}]
    }),
        $(".recomend-slider").slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: !0,
        autoplaySpeed: 5e3,
        dots: !1,
        responsive: [{breakpoint: 1025, settings: {slidesToShow: 3}}, {
            breakpoint: 737,
            settings: {arrows: !1, centerMode: !0, centerPadding: "60px", slidesToShow: 1}
        }]
    });

    $(".quantity").on("click", function () {
        $(this).hasClass("active") ? $(this).removeClass("active") : $(this).addClass("active")
    });

    $('#review-modal-close-btn').on('click', function (e) {
       e.preventDefault();
       $('.modal-review-form').hide().removeClass('in');
    });
});