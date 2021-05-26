function comparison_table() {
	$('.t-table').clone().appendTo('.table-left-wrap');

	$('.t-table tbody tr').hover(function() {
		var $this = $(this);
		var index = $this.index() + 1;

		$('.t-table tbody').find('tr:nth-child(' + index + ')').addClass('t-table__row-background');
	}, function() {
		var $this = $(this);
		var index = $this.index() + 1;

		$('.t-table tbody').find('tr:nth-child(' + index + ')').removeClass('t-table__row-background');
	});
}

$(document).ready(function(){

	$(".contside__link").on('click', function(e){
		$('.contside__item').removeClass('active');
		$(this).parent().addClass('active');
	});


	var ScreenWidth = screen.width;

	$('.type-product>li').on('click',function () {
		if(ScreenWidth < 737){
			$('.type-product>li').attr('style', '').css('margin-left','-100%');
		}
	});

	$('.firm-product>li').on('click',function () {
		if(ScreenWidth < 737){
			$('.firm-product>li').attr('style', '').css('margin-left','-100%');
		}
	});

	$('.back-2').on('click',function () {
		$('.firm-product>li').attr('style', '').css('margin-left','0');
	});

	$('.back-1').on('click',function () {
		$('.type-product>li').attr('style', '').css('margin-left','0');
	});

	$('.close').on('click',function () {
		$('.type-product>li').attr('style', '').css('margin-left','0');
		$('.firm-product>li').attr('style', '').css('margin-left','0');
	});
	
	
	/*
	*  comparison table 
	*/
	comparison_table();
	/*
	*  comparison table...end;
	*/

});


/* Избранное */