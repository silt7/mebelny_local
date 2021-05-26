function openBuyProduct(id)
{
   var authPopup = BX.PopupWindowManager.create("openBuyProduct", null, {
         autoHide: true,
         offsetLeft: 0,
         offsetTop: 0,
         overlay : true,
         draggable: {restrict:true},
         closeByEsc: true,
         closeIcon: { right : "12px", top : "10px"},
         content: '<div style="width:400px;height:400px; text-align: center;"></div>',
            events: {
               onAfterPopupShow: function()
               {
                     this.setContent(BX("bx_by_product"));
               }
         }
        });
    
    var elem = $('#' + id);
    var title = elem.find('.card__title').text();
    var img =  elem.find('.card-img').attr('src');
    var price = elem.find('.card-price__price').text();
    $('.modal-busket__content img').attr("src", img);
    $('.modal-busket__price').text(price);
    $('.modal-busket__subinfo').text(title);
    
    
    authPopup.show();
}
function openRecallPopup2(title)
{
    var authPopup = BX.PopupWindowManager.create("openRecallPopup2", null, {
         autoHide: true,
         offsetLeft: 0,
         offsetTop: 0,
         overlay : true,
         draggable: {restrict:true},
         closeByEsc: true,
         closeIcon: { right : "12px", top : "10px"},
         content: '<div style="width:300px;height:550 !important; text-align: center;"></div>',
            events: {
               onAfterPopupShow: function()
               {
                     this.setContent(BX("bx_recall_popup_form2"));
               }
         }
    });

    authPopup.show();
    $('#openRecallPopup2').find('.form-def__title.title-html').text('Сообщить о поступлении товара ('+title+')');
    $('input[name="form_hidden_19"]').prop('required',true);
    $('input[name="form_hidden_20"]').prop('required',true);
    $('input[name="form_hidden_21"]').val(title);
    //$('input[name="form_hidden_22"]').val(1111);
    $('#openRecallPopup2').find('form').attr({"onsubmit": "ym(26789943,'reachGoal','sayifavailable', {URL:document.location.href})"});
}
function popupHide(){
    $('.popup-window-overlay').css('display','none');
    $('.popup-window').css('display','none');
}
function add_basket(id, prop){
    var post = {};
    post['id'] = id;
    post['prop'] = prop;
    $.post(
        '/local/ajax/addCart.php',
        post,
        function (result) {
            $("#cart_desc").text(result);
            $(".cart_desc-mobile").text(result);
            openBuyProduct(id);
        }
    );
}

$(document).ready(function(){
    $('.catalog-new__slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: true,
        prevArrow: '<img src="/upload/left.svg" alt="" class="catalog-new__arrow catalog-new__arrow_prev">',
        nextArrow: '<img src="/upload/right.svg" alt="" class="catalog-new__arrow catalog-new__arrow_next">'
    });
    if ($('.catalog-new').length <= 1) {
      $('.catalog-new__wrap .slick-dots').hide();
    }
    if($(document).width() <= 900){
        $('.catalog-new__wrap.mobile').show();
    } else {
        $('.catalog-new__wrap.display').show();
    }
})