/**
 * Created by volodimir on 8/4/17.
 */

$(document).ready(function(){
    // "use strict"
    $('.banner-slider').slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      arrows:false,
      adaptiveHeight: true,
	  autoplay:true,
	  autoplaySpeed:5000
    });
    $('.brend-logo').slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      dots:false,
      arrows: true,
	  autoplay:true,
	  speed: 300,
    });
});		function WSMFavoritesInit() {		  if (window.BX.WSMFavorites) {			var CFav = new BX.WSMFavorites ({				link: 'addFav',				fav_text: '<?=$class?>',    				fav_class: 'favorites',				onInit: function(links){},				onReady: function(links, elements){},				onClick: function(id, checked, link){},				onStatusChange: function(id, checked, link){					if (location.pathname == '/personal/favorite/') {						if (!checked) {							$(link).closest('.product-wrap').remove();						}					}				},				onError: function(){},				onGetTotal: function(total){					$('.badge .img-wrap').attr('data-count', total);					if (total == 0) total = 'нет';					$('.badge .text-wrap p').html('Товаров (' + total + ')');					$('.add_favorites .add__title span').html('Товаров (' + total + ')');				},			  });			}		}		BX.ready(function() {			WSMFavoritesInit();			BX.addCustomEvent('onAjaxSuccess', function(event){				if (event == null) {					return true;				}				if (typeof(event.action) === 'undefined') {					WSMFavoritesInit();				}				return true;			});		});				//Активный при клике на выбор карты		$('.contacts .map_nav .item').click(function () {		   // var id = $(this).data('id');			$('.contacts .map_nav .item').removeClass('active');			$(this).addClass('active');			//console.log(id);		});		//Высота карты		var height = $('.contacts .map_nav').height();		$('.contacts .map, #WSM_MapOffice_YMAP').height(height);		console.log(height);			window['li'+'v'+'eTe'+'x'] = true,        window['l'+'iveT'+'exID'] = 116774,        window['li'+'v'+'eTex_'+'o'+'bjec'+'t'] = true;        (function() {        var t = document['c'+'re'+'ateEle'+'m'+'ent']('script');        t.type ='text/javascript';        t.async = true;        t.src = '//cs15.live'+'tex.ru/js/cl'+'ient.js';        var c = document['getE'+'lem'+'en'+'tsB'+'y'+'Ta'+'gN'+'a'+'me']('script')[0];        if ( c ) c['pare'+'n'+'tN'+'ode']['in'+'s'+'ertB'+'efore'](t, c);        else document['do'+'cumen'+'tElem'+'ent']['first'+'Chi'+'ld']['app'+'e'+'n'+'dChil'+'d'](t);})(); 