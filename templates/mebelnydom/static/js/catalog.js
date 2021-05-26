"use strict";
$(document).ready(function() {
	$("#example_id").ionRangeSlider({
		type: "double",
		grid: !0,
		min: 0,
		max: 25e4,
		from: 12e3,
		to: 103e3
	}), $("#example_id-1").ionRangeSlider({
		type: "double",
		grid: !0,
		min: 0,
		max: 25e4,
		from: 12e3,
		to: 103e3
	}), $(".open-filter").on("click", function() {
		$("body").addClass("filter-active"), $(".filter").addClass("filter-active"), BX.setCookie('filter-open', 'Y', {expires: 31500000, path: '/'})
	}), $(".close-filter").on("click", function() {
		$("body").removeClass("filter-active"), $(".filter").removeClass("filter-active"), BX.setCookie('filter-open', 'N', {expires: 31500000, path: '/'})
	}),
	/*$(".like i").on("click",function(){$(this).hasClass("active")?$(this).removeClass("active"):$(this).addClass("active")}),$(".like .active").on("click",function(){$(this).removeClass("active")}),*/
	$(".filter-bg").on("click", function() {
		$("body").removeClass("filter-active"), $(".filter").removeClass("filter-active")
	})
});