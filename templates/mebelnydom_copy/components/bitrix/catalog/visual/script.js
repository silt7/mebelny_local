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

/*$('.sort-item').click(function (e) {
  let arrows = $(this).find('i');
  if (!e.target.closest('.sort-item__open')) {
    if (arrows.eq(0).hasClass('sort-arrow__selected') || arrows.eq(1).hasClass('sort-arrow__selected')) {
      arrows.eq(0).toggleClass('sort-arrow__selected');
      arrows.eq(1).toggleClass('sort-arrow__selected');
      console.log(arrows);
    } else {
      $('.sort-item').find('i').removeClass('sort-arrow__selected');
      arrows.eq(0).addClass('sort-arrow__selected');
    }
    $('.sort-item__mob').find('i').remove();
    arrows.clone().appendTo($('.sort-item__mob'));
    $('.sort-item__mob').find('.sort-item__name').text($(this).find('.sort-item__name').text());
    $('.sort-item').removeClass('sort-item__active');
    $('.sort-items').removeClass('sort-items__active');
  }
});*/

$('.sort-item__open').click(function () {
  $('.sort-items').toggleClass('sort-items__active');
  $(this).parents('.sort-item').toggleClass('sort-item__active');
});

/*function WSMFavoritesInit() {		  
    if (window.BX.WSMFavorites) {			
        var CFav = new BX.WSMFavorites ({				
            link: 'addFav',				
            fav_text: '<?=$class?>',    				
            fav_class: 'favorites',				
            onInit: function(links){},				
            onReady: function(links, elements){},				
            onClick: function(id, checked, link){},				
            onStatusChange: function(id, checked, link){					
                if (location.pathname == '/personal/favorite/') {						
                    if (!checked) {							
                        $(link).closest('.product-wrap').remove();						
                    }					
                }				
            },				
            onError: function(){},				
            onGetTotal: function(total){				
                $('.badge .img-wrap').attr('data-count', total);					
                if (total == 0) total = 'нет';					
                $('.badge .text-wrap p').html('Товаров (' + total + ')');					
                $('.add_favorites .add__title span').html('Товаров (' + total + ')');				
            },			  
        });			
    }		
}		
BX.ready(function() {			
    WSMFavoritesInit();
    BX.addCustomEvent('onAjaxSuccess', function(event){	
        alert();
        if (event == null) {				
            return true;				
        }				
        if (typeof(event.action) === 'undefined') {				
            WSMFavoritesInit();				
        }
        return true;			
    });		
});*/
function add_favorite(id){
    var data = {};
    data['id'] = id;
    $.get(
        '/local/ajax/favorites.php',
        data,
        function (result) {
            count = parseInt($("#favorites_count").text());
            if((count > 0)&&(result == 2)) {
                count = count - 1;
            } else if (result == 1){
                count = count + 1;
            }
            $("#favorites_count").text(count + ' тов.');
        }
    );
}
function compare_tov(id, element)
{
    if (element.classList.contains('active') == false)
    {
        //Добавить
        $.get('/local/ajax/compare.list.php', {action: "ADD_TO_COMPARE_LIST", id: id}, function( data ) {
            $('#compare_mini_list').html(data);
        });
        $(element).addClass('active');
        $(element).find('span').text('Удалить из сравнения');
    }
    else
       {
        //Удалить
        $.get('/local/ajax/compare.list.php', {action: "DELETE_FROM_COMPARE_LIST", id: id}, function( data ) {
            $('#compare_mini_list').html(data);
        });
        $(element).removeClass('active');
        $(element).find('span').text('Добавить в сравнение');
    }
}
$('.like i').click(function(){
    if($(this).hasClass('active') == true){
        $(this).removeClass('active');
    } else {
        $(this).addClass('active');
    }
});
$('#modal_review .send-btn').click(function(){
    if($("label[for='askaron_reviews_grade_1']").hasClass('active') == false){
        $(".add_reviews_stars").css('border', '1px solid red');
    } else {
        $(".add_reviews_stars").css('border', 'none');
    }
});