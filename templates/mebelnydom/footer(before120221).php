<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)die();?>

<? if($isMain == "Y") { ?>
    <div class="contact">
        <div class="container">
            <p class="h1">Контакты</p>
                        <div class="contact-flex">
                <div class="contact-maps">
                   				<?  $APPLICATION->IncludeComponent(
	"wsm:offices.yandexmap", 
	"home", 
	array(
		"IBLOCK_TYPE" => "presscenter",
		"IBLOCK_ID" => "51",
		"POINT_POSITION" => "SHOP_MAP_COORDS",
		"CITY" => "N",
		"USE_GEOIP" => "N",
		"INCLUDE_YMAP_SCRIPT" => "Y",
		"SHOW_TRAFFIC" => "Y",
		"MAP_SET_CENTER_AUTO" => "N",
		"MAP_POINT_PRESET" => "red",
		"MAP_POINT_PRESET_TYPE" => "Dot",
		"BALOON_BODY" => array(
			0 => "NAME2",
			1 => "",
		),
		"OFFICES_WITHOUT_SHOWING_POSITIONS" => "Y",
		"CHECK_PERMISSIONS" => "N",
		"FILTER_NAME" => "",
		"SORT_BY1" => "NAME",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"PROPERTIES" => array(
			0 => "NAME2",
			1 => "ADRES",
			2 => "WORK_TIME",
			3 => "PHONE",
			4 => "",
		),
		"PARENT_SECTION" => "0",
		"PARENT_SECTION_CODE" => "",
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SORT_CITY_BY1" => "NAME",
		"SORT_CITY_ORDER1" => "ASC",
		"COMPONENT_TEMPLATE" => "home",
		"MAP_CENTER" => "55.753215,37.622504",
		"MAP_ZOOM" => "12",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>
                </div>
             <? $APPLICATION->IncludeComponent(
                "bitrix:news.list", 
                "shops2", 
                array(
                    "COMPONENT_TEMPLATE" => "shops2",
                    "IBLOCK_TYPE" => "presscenter",
                    "IBLOCK_ID" => "51",
                    "NEWS_COUNT" => "20",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "SHOP_MAP_COORDS",
                        1 => "SHOP_TYPE",
                        2 => "",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "PAGER_TEMPLATE" => ".default",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "SET_STATUS_404" => "N",
                    "SHOW_404" => "N",
                    "MESSAGE_404" => "",
                    "RSGOPRO_PROP_COORD" => "SHOP_MAP_COORDS",
                    "RSGOPRO_PROP_TYPES" => "SHOP_TYPE",
                    "RSGOPRO_SHOW_TITLE" => "Y"
                ),
                false
            );?>
                            <a class="free-consalting btn-def" rel="nofollow" href="#modal-call" data-toggle="modal">Бесплатная консультация</a>

            </div>
            </div>
             <div class="container contact-desc article">
                <? $APPLICATION->IncludeFile(
					SITE_DIR."/include/index/seo.php",
					Array(),
					Array("MODE" => "html")
					);
				?>
          	 </div>
        </div>

    </div>
  <? } ?> 



    <script>
        // Спойлер перелинковки в разделах
        $('#spilerRelinkBottom_link').click(function(){     
            if($(this).hasClass('spoiler_close')){
            $(this).toggleClass('spoiler_open');
            $(this).removeClass('spoiler_close');
            $(this).html('СКРЫТЬ<span class="spilerRelinkBottom_up"></span>');
            $('#spilerRelinkBottom_container').addClass('spoiler_open');            
        }
        else{
            $(this).toggleClass('spoiler_close'); 
            $(this).removeClass('spoiler_open');
            $(this).html('ПОКАЗАТЬ КАТАЛОГ<span class="spilerRelinkBottom_down"></span>');
            $('#spilerRelinkBottom_container').removeClass('spoiler_open');
        }
        });
        // Спойлер перелинковки в карточках
        $('#spilerRelinkElement_link').click(function(){     
            if($(this).hasClass('spoiler_close')){
            $(this).toggleClass('spoiler_open');
            $(this).removeClass('spoiler_close');
            $(this).html('СКРЫТЬ<span class="spilerRelinkBottom_up"></span>');
            $('#spilerRelinkElement_container').addClass('spoiler_open');            
        }
        else{
            $(this).toggleClass('spoiler_close'); 
            $(this).removeClass('spoiler_open');
            $(this).html('ПОКАЗАТЬ КАТАЛОГ<span class="spilerRelinkBottom_down"></span>');
            $('#spilerRelinkElement_container').removeClass('spoiler_open');
        }
        });
    </script>    

    <footer class="footer">
        <div class="footer-top middle">
            <div class="container">
                <div class="mid-flex">
                    <div class="logo middle-block">
                        <div class="img-wrap">
                            <img src="<?=SITE_TEMPLATE_PATH?>/static/img/footer-logo.png" alt="logo">
                        </div>
                        <div class="text-wrap">
                            <span class="h2">Мебельный Дом</span>
                            <p>Ваш источник уюта</p>
                        </div>
                    </div>
                    <div class="service-flex-block">
                        <div class="service middle-block">
                            <div class="img-wrap">
                                <img src="<?=SITE_TEMPLATE_PATH?>/static/img/footer-service.png" alt="service">
                            </div>
                            <div class="text-wrap">
                                 <a style="font: 18px SegoeUISemiBold; color: #fff;" class="phone-header callibri_phone" href="tel:+78003500580" onclick="ym(26789943,'reachGoal','callme', {URL: document.location.href})"><span class="h2"><?=COption::GetOptionString("grain.customsettings","PHONE1");?></span></a>
                                <p>Бесплатно по всей России</p>
                            </div>
                        </div>
                        <div class="service middle-block">
                            <div class="img-wrap">
                                <img src="<?=SITE_TEMPLATE_PATH?>/static/img/footer-service.png" alt="service">
                            </div>
                            <div class="text-wrap">
                                <span class="h2">
                                    <span class="openpopup footer-callback-btn" data-toggle="modal">Бесплатная консультация</span>
                                </span>
                            </div>
                        </div>
                        <div class="time middle-block">
                            <div class="img-wrap">
                                <img src="<?=SITE_TEMPLATE_PATH?>/static/img/footer-open.png" alt="time">
                            </div>
                            <div class="text-wrap">
                                <span class="h2"><?=COption::GetOptionString("grain.customsettings","TIME");?></span>
                                <p>Без выходных</p>
                            </div>
                        </div>
                        <div class="social middle-block">
                            <div class="text-wrap">
                                <div class="icon">
								   <? $APPLICATION->IncludeFile(
                                        SITE_DIR."include/footer/socservice.php",
                                        Array(),
                                        Array("MODE"=>"html")
                                    );?>
                                </div>
                                <p>Следи за новостями</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-middle">
            <div class="container">
                <!-- <div class="main-menu__flex">
                    <div class="main-menu__catalog">
                        <div class="btn-open">
                            <span></span><span></span><span></span>
                        </div>
                        <div class="h3">Каталог товаров</div>
                    </div>
					 <? $APPLICATION->IncludeComponent(
						"bitrix:menu", 
						"bottom", 
						array(
							"ROOT_MENU_TYPE" => "tpanel",
							"MAX_LEVEL" => "1",
							"CHILD_MENU_TYPE" => "",
							"USE_EXT" => "N",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(
							),
							"COMPONENT_TEMPLATE" => "bottom",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
						),
						false
					);?>
                </div> -->
               
                <?/*** WDS_1510 → ***/?>
                <div class="footer-list__flex">
                    <div class="list-wrap">
                        <div class="h5">
                            <a>Каталог товаров</a>
                        </div>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:catalog.section.list", 
                            "depth_1", 
                            array(
                                "VIEW_MODE" => "TEXT",
                                "SHOW_PARENT_NAME" => "Y",
                                "IBLOCK_TYPE" => "catalog",
                                "IBLOCK_ID" => "2",
                                "SECTION_ID" => $_REQUEST["SECTION_ID"],
                                "SECTION_CODE" => "",
                                "SECTION_URL" => "",
                                "COUNT_ELEMENTS" => "N",
                                "TOP_DEPTH" => "1",
                                "SECTION_FIELDS" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "SECTION_USER_FIELDS" => array(
                                    0 => "UF_TO_FOOTER",
                                    1 => "",
                                ),
                                "ADD_SECTIONS_CHAIN" => "Y",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "36000000",
                                "CACHE_NOTES" => "",
                                "CACHE_GROUPS" => "Y",
                                "COMPONENT_TEMPLATE" => "depth_1",
                                "COMPOSITE_FRAME_MODE" => "A",
                                "COMPOSITE_FRAME_TYPE" => "AUTO"
                            ),
                            false
                        );?>
                    </div>
                    <div class="list-wrap">
                        <div class="h5">Компания</div>
                            <?$APPLICATION->IncludeComponent("bitrix:menu", "footer", Array(
                                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                    "CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
                                    "COMPOSITE_FRAME_MODE" => "A",	// Голосование шаблона компонента по умолчанию
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",	// Содержимое компонента
                                    "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                    "MAX_LEVEL" => "1",	// Уровень вложенности меню
                                    "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                                    "MENU_CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                                    "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                                    "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                                    "ROOT_MENU_TYPE" => "footer_company",	// Тип меню для первого уровня
                                    "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                    "COMPONENT_TEMPLATE" => ".default"
                                ),
                                false
                            );?>                            
                            <br><br>
                        <div class="h5">Клиентам</div>
                            <?$APPLICATION->IncludeComponent("bitrix:menu", "footer", Array(
                                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                    "CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
                                    "COMPOSITE_FRAME_MODE" => "A",	// Голосование шаблона компонента по умолчанию
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",	// Содержимое компонента
                                    "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                    "MAX_LEVEL" => "1",	// Уровень вложенности меню
                                    "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                                    "MENU_CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                                    "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                                    "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                                    "ROOT_MENU_TYPE" => "footer_clients",	// Тип меню для первого уровня
                                    "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                    "COMPONENT_TEMPLATE" => ".default"
                                ),
                                false
                            );?>
                    </div>
                    <div class="list-wrap">
                        <div class="h5">Сервис</div>
                            <?$APPLICATION->IncludeComponent("bitrix:menu", "footer", Array(
                                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                    "CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
                                    "COMPOSITE_FRAME_MODE" => "A",	// Голосование шаблона компонента по умолчанию
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",	// Содержимое компонента
                                    "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                    "MAX_LEVEL" => "1",	// Уровень вложенности меню
                                    "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                                    "MENU_CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                                    "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                                    "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                                    "ROOT_MENU_TYPE" => "footer_service",	// Тип меню для первого уровня
                                    "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                    "COMPONENT_TEMPLATE" => ".default"
                                ),
                                false
                            );?>
                        <br><br>
                        <div class="h5">Акции</div>
                            <?$APPLICATION->IncludeComponent("bitrix:menu", "footer", Array(
                                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                    "CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
                                    "COMPOSITE_FRAME_MODE" => "A",	// Голосование шаблона компонента по умолчанию
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",	// Содержимое компонента
                                    "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                    "MAX_LEVEL" => "1",	// Уровень вложенности меню
                                    "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                                    "MENU_CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                                    "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                                    "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                                    "ROOT_MENU_TYPE" => "footer_actions",	// Тип меню для первого уровня
                                    "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                    "COMPONENT_TEMPLATE" => ".default"
                                ),
                                false
                            );?>
                    </div>
                    <div class="list-wrap">
                        <div class="h5">Фирменный шоу-рум мебели</div>
                            <ul class="footer-list">
                                <li><a>Московская область, город Королев, улица Стрекалова, дом 1.</a></li>
                                <li><a>Пн-Пт с 09.00 до 18.00</a></li>
                                <li><a>Выходной</a></li>
                            </ul>
                        <br><br>
                        <div class="h5">Интернет магазин мебели "Мебельный дом"</div>
                            <ul class="footer-list">
                                <li><a>г. Москва, ул. Яхромская, д. 4/2</a></li>
                                <li><a>(Юридический адрес)</a></li>
                                <li><a>c 10:00 до 21:00</a></li>
                                <li><a>без выходных</a></li>
                            </ul>
                    </div>
                </div>
                <?/*** ← WDS_1510 ***/?>

                <div class="copyright-flex">
                    <p>© Все права защищены. Информация сайта защищена законом об авторских правах.</p>
                    <? /*?><p>Powered by Webernetic</p><? */?><p><a href="/personal_data/" class="personal_data">Конфиденциальность и защита персональных данных</a>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade modal-call" id="modal-call">
            <div class="modal-call__wrap">
                <div class="modal-call__dialog">
                    <span data-dismiss="modal" class="modal-call__close-btn"></span>
                    <div class="modal-call__container">
						<? $APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"fb2", 
	array(
		"CACHE_TIME" => "3600",
		"AJAX_OPTION_ADDITIONAL" => "INLINES",
		"CACHE_TYPE" => "Y",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/",
		"SUCCESS_URL" => "/brands",
		"USE_EXTENDED_ERRORS" => "N",
		"WEB_FORM_ID" => "3",
		"COMPONENT_TEMPLATE" => "fb2"
	),
	false
);?>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-busket">
            <div class="modal-call__wrap">
                <div class="modal-busket__dialog">
                    <a href="#" data-dismiss="modal" class="modal-call__close-btn"></a>
                    <div class="modal-busket__container">
                        <div class="modal-busket__title">Товар добавлен в корзину</div>
                        <div class="modal-busket__desc">Всего в вашей корзине 1 товар. <a href="/personal/cart/" class="modal-busket__desc-link">Посмотреть</a></div>

                        <div class="modal-busket__content">
                            <div class="modal-busket__content-left">
                                <div class="modal-busket__img-container">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/static/img/busket-item.png" alt="img" class="modal-busket__img">
                                </div>
                            </div>
                            <div class="modal-busket__content-right">
                                <div class="modal-busket__price">173 000 руб.</div>
                                <div class="modal-busket__subinfo">Кровать из массива гевеи Bali, темно серый </div>
                                <div class="modal-busket__remaining">Осталось в наличии: 2 шт</div>

                                <a href="#" class="modal-busket__delete-item"></a>
                            </div>
                        </div>

                        <div class="modal-busket__bottom">
                            <a href="/" class="modal-busket__return-btn">Продолжить покупки</a>
                            <a href="/personal/cart/" class="modal-busket__сheckout-btn btn-def">Оформить заказ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?=$GLOBALS["assetScriptToFooter"];?>
       <? if(\Bitrix\Main\Loader::includeModule('wsm.favorites'))
		{
			\Wsm\Favorites::addScript();
			\Wsm\Favorites::addStyle();  # подключение стилей (для варианта b - с оформлением)
		}
		?>
		<? $dir = $APPLICATION->GetCurDir(); if (!$dir == "/personal/favorite/") { $class = "<i class='fa fa-heart' aria-hidden='true'></i>"; } ?>
		<script>
        
        // SEO JS+SPAN
        $("body").on("click", ".js_span_location", function () {
            if ($(this).attr("data-target")) {
                window.open($(this).data("location"));
            } else {
                location.href = $(this).data("location");
            }
        });
        
		function WSMFavoritesInit() {
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
				if (event == null) {
					return true;
				}
				if (typeof(event.action) === 'undefined') {
					WSMFavoritesInit();
				}
				return true;
			});
		});
		
		//Активный при клике на выбор карты
		$('.contacts .map_nav .item').click(function () {
		   // var id = $(this).data('id');
			$('.contacts .map_nav .item').removeClass('active');
			$(this).addClass('active');
			//console.log(id);
		});
		//Высота карты
		var height = $('.contacts .map_nav').height();
		$('.contacts .map, #WSM_MapOffice_YMAP').height(height);
		console.log(height);
		</script>
<?if($_REQUEST["no_metrika"]){ ?>

<script type="text/javascript" >
    
    // var scroll = 1;
    // window.addEventListener('scroll', function() {
        function getBodyScrollTop()
        {
            return self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
        }
        // if(getBodyScrollTop() > 300 && scroll = 1){
            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

            ym(26789943, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true,
                ecommerce:"dataLayer"
            });
            
            // scroll = 0;
        // }
    // });с
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/26789943" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<? }else{  ?>
	
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(26789943, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/26789943" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<?}?>
<!-- {literal} -->
<script>

    /* Favorites */
    $('.addFav').on('click', function(e) {

        e.preventDefault();
        var favorID = $(this).attr('data-id');
        var doAction;
        if($(this).find('i').hasClass('active')) {
            doAction = 'delete';
        }else {
            doAction = 'add';
        }

        addFavorite(favorID, doAction);
    });

    $('.t-table__card__del-btn').on('click', function(){
        document.location.reload();
    });
    /* Favorites */

/* Избранное */
function addFavorite(id, action)
{
    var param = 'id='+id+"&action="+action;
    $.ajax({
        url:     '/local/ajax/favorites.php', // URL отправки запроса
        type:     "GET",
        dataType: "html",
        data: param,
        success: function(response) { // Если Данные отправлены успешно
            var result = $.parseJSON(response);
            if(result == 1){ // Если всё чётко, то выполняем действия, которые показывают, что данные отправлены :)
                $('.addFav[data-id="'+id+'"]').find('i').addClass('active');
                $('.add_favorites').addClass('active');
                var wishCount = parseInt($('.badge .img-wrap').attr('data-count')) + 1;
                $('.badge .img-wrap').attr('data-count',wishCount); // Визуально меняем количество у иконки
                $('.add-product .addFav').text('Убрать из избранного');
            }
            if(result == 2){
                $('.addFav[data-id="'+id+'"]').find('i').removeClass('active');
                $('.add_favorites').removeClass('active');
                var wishCount = parseInt($('.badge .img-wrap').attr('data-count')) - 1;
                $('.badge .img-wrap').attr('data-count',wishCount); // Визуально меняем количество у иконки
                $('.add-product .addFav').text('Добавить в избранное');
            }
        },
        error: function(jqXHR, textStatus, errorThrown){ // Если ошибка, то выкладываем печаль в консоль
            console.log('Error: '+ errorThrown);
        }
    });
}

        </script>
<script>
    $('.detailProductInCart').on('click', function(){
        yaCounter26789943.reachGoal('clickkupit');
    })
</script>
<!-- {/literal} -->
<script src="//cdn.callibri.ru/callibri.js" type="text/javascript" charset="utf-8"></script>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-70988640-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-70988640-1');
</script>
</body>
</html>