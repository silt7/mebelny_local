<?php $this->addExternalCss($templateFolder."/styles.css");?>
<?php $this->addExternalJs($templateFolder."/js/header.js");?>
<?php $this->addExternalJs("https://cdn.callibri.ru/callibri.js");?>
<div id="panel"><?=$APPLICATION->ShowPanel()?></div>
<header class="header">
<div class="header-top">
  <div class="container header-top__wrap">
    <nav class="top-menu">
        <? $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "tpanelHeader",
            array(
                "ROOT_MENU_TYPE" => "tpanel",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "",
                "USE_EXT" => "N",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => Array()
            )
        );?>
    </nav>
    <!-- /.top-menu -->
    <div class="top-login">
		<!--noindex-->
		<?$APPLICATION->IncludeComponent(
		"api:auth.ajax",
		"",
		Array(
			"LOGIN_BTN_CLASS" => "enter",
			"LOGIN_MESS_HEADER" => "Вход на сайт",
			"LOGIN_MESS_LINK" => "Вход",
			"REGISTER_BTN_CLASS" => "register",
			"REGISTER_MESS_HEADER" => "Регистрация",
			"REGISTER_MESS_LINK" => "Регистрация",
			"RESTORE_MESS_HEADER" => "Вспомнить пароль"
		)
		);?>
    	<!--/noindex-->
    </div>
    <!-- /.top-login -->
    <div class="header-item header-top__item">
      <img loading="lazy" decoding="async" src="<?= $templateFolder?>/imgs/header-item3.svg" alt="Режим работы"
        class="header-item__img">
      <div class="header-item__text">
        <div class="header-item__title"><?=COption::GetOptionString("grain.customsettings","TIME");?></div>
        <!-- /.header-item__title -->
        <span class="header-item__desc">Без выходных</span>
        <!-- /.header-item__desc -->
      </div>
      <!-- /.header-item__text -->
    </div>
    <!-- /.header-item -->
  </div>
  <!-- /.container -->
</div>
<!-- /.header-top -->
<div class="header-middle">
  <div class="container header-middle__wrap">
    <div class="header-item header-middle__item">
      <img loading="lazy" decoding="async" src="<?= $templateFolder?>/imgs/header-item-1.png" alt="Диван" class="header-item__img">
      <div class="header-item__text">
        <a href="/" class="header-item__title">Мебельный дом</a>
        <!-- /.header-item__title -->
        <span class="header-item__desc">Ваш источник уюта</span>
        <!-- /.header-item__desc -->
      </div>
      <!-- /.header-item__text -->
    </div>
    <!-- /.header-item -->
    <div class="header-item header-middle__item">
      <img loading="lazy" decoding="async" src="<?= $templateFolder?>/imgs/header-item2.svg" alt="Телефон" class="header-item__img">
      <div class="header-item__text">
        <a class="header-item__title callibri_phone" href="tel:+78003500580" onclick="ym(26789943,'reachGoal','callme', {URL: document.location.href}); gtag('event', 'zvonok_ga');"><?=COption::GetOptionString("grain.customsettings","PHONE2");?></a>
        <!-- /.header-item__title -->
        <a class="header-item__desc" href="javascript:void(0)" onclick="openRecallPopup()" style="cursor:pointer">Перезвоните мне</a>
        <!-- /.header-item__desc -->
      </div>
      <!-- /.header-item__text -->
    </div>
    <!-- /.header-item -->
    <div class="header-item header-middle__item">
      <img loading="lazy" decoding="async" src="<?= $templateFolder?>/imgs/header-item3.svg" alt="Режим работы"
        class="header-item__img">
      <div class="header-item__text">
        <div class="header-item__title"><?=COption::GetOptionString("grain.customsettings","TIME");?></div>
        <!-- /.header-item__title -->
        <span class="header-item__desc">Без выходных</span>
        <!-- /.header-item__desc -->
      </div>
      <!-- /.header-item__text -->
    </div>
    <!-- /.header-item -->
    <div class="header-item header-middle__item">
      <img loading="lazy" decoding="async" src="<?= $templateFolder?>/imgs/header-item4.svg" alt="Звезда" class="header-item__img">
      <div class="header-item__text">
        <a href="/personal/favorite/" class="header-item__title">Избранное</a>
        <!-- /.header-item__title -->
        <a href="/personal/favorite/" class="header-item__desc" id="favorites_count"><?= $arResult['favorites'];?> тов.</a>
        <!-- /.header-item__desc -->
      </div>
      <!-- /.header-item__text -->
    </div>
    <!-- /.header-item -->
    <div class="header-item header-middle__item">
      <img loading="lazy" decoding="async" src="<?= $templateFolder?>/imgs/header-item5.svg" alt="Корзина" class="header-item__img">
      <div class="header-item__text">
        <a href="/personal/cart/" class="header-item__title">Корзина</a>
        <!-- /.header-item__title -->
        <a href="/personal/cart/" class="header-item__desc" id="cart_desc"><?= $arResult['cart_num'];?> тов., <?= $arResult['cart_sum'];?> руб</a>
        <!-- /.header-item__desc -->
      </div>
      <!-- /.header-item__text -->
    </div>
    <!-- /.header-item -->

      <div class="header-new-mob">
    <div class="top-menu__open">
      <div class="top-menu__hamburger">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
      <!-- /.top-menu__hamburger -->
    </div>
    <!-- /.top-menu__open -->
    <div class="header-item header-middle__item">
      <img loading="lazy" decoding="async" src="<?= $templateFolder?>/imgs/header-item-1.png" alt="Диван" class="header-item__img">
      <div class="header-item__text">
        <a href="/" class="header-item__title">Мебельный дом</a>
        <!-- /.header-item__title -->
        <span class="header-item__desc">Ваш источник уюта</span>
        <!-- /.header-item__desc -->
      </div>
      <!-- /.header-item__text -->
    </div>
    <!-- /.header-item -->
    <div class="header-mob-search">
      <i class="fa fa-search"></i>
      <i class="fa fa-close"></i>
    </div>
    </div>
  </div>
  <!-- /.container -->
</div>
<!-- /.header-middle -->
<div class="header-bottom">
  <div class="container header-bottom__wrap">
    <nav class="main-menu">
      <ul>
        <li class="main-menu__hero">
          <div class="main-menu__link">
            <img class="icon_menu" loading="lazy" decoding="async" src="<?= $templateFolder?>/imgs/icon-grid.svg" alt="">
            <div class="main-menu__hamburger"><span></span><span></span><span></span></div>
            <span>Каталог мебели</span>
          </div>
          <div class="main-menu__drop">
<div class="main-menu__scroll">
    <div class="container" style="margin-left: 0; margin-right: 0">
  </div>
</div>
            <div class="container">
    			<?$APPLICATION->IncludeComponent(
					"bitrix:catalog.section.list",
					"menuHeader",
					Array(
						"ADD_SECTIONS_CHAIN" => "N",
						"CACHE_GROUPS" => "Y",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"COMPOSITE_FRAME_MODE" => "A",
						"COMPOSITE_FRAME_TYPE" => "AUTO",
						"COUNT_ELEMENTS" => "N",
						"IBLOCK_ID" => "2",
						"IBLOCK_TYPE" => "catalog",
						"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
						"SECTION_FIELDS" => array("",""),
						"SECTION_ID" => $_REQUEST["SECTION_ID"],
						"SECTION_URL" => "",
						"SECTION_USER_FIELDS" => array("",""),
						"SHOW_PARENT_NAME" => "Y",
						"TOP_DEPTH" => "1",
						"VIEW_MODE" => "LINE"
					)
        );?>


          <div class="main-menu__show-more menu__show-more">
            <img src="/upload/chevron-bottom.svg" class="desc" alt="">
            <img src="/upload/arrow-left.svg" class="mobile" alt="">
            <a href="/" style="text-decoration: none;"><span class="mobile">Вернуться на главную</span></a>
          </div>

            </div>
          </div>

        </li>
        <li class="">
          <a href="/aktsionnyye_tovary/" class="main-menu__link">Акционные товары</a>
        <li class="">
          <a href="/rasprodazha/" class="main-menu__link">Распродажи</a>
        </li>
        <li class="">
          <a href="/hity/" class="main-menu__link">Популярные</a>
        </li>
        <li class="">
          <a href="/novinki/" class="main-menu__link">Новинки</a>
        </li>
      </ul>
    </nav>
    <!-- /.main-menu -->
    <button type="submit" class="top-search__btn__mob"><i class="fa fa-search"></i></button>
    
		<? $APPLICATION->IncludeComponent(
            "bitrix:search.form",
            "searchHeader",
            Array(
                "USE_SUGGEST" => "N",
                "PAGE" => "/search/"
            ),
        false
        ); ?>
    <!-- /.top-search -->
    <nav class="top-menu__mob" >
      <div class="top-menu__close">
        <img src="/upload/close-icon.svg" alt="">
      </div>
      <div class="menu-lg">
        <div class="menu-lg__item">
          <img class="menu-lg__icon" src="/upload/phone-icon.svg" alt="">
          <div class="menu-lg__item-text">
            <a class="tell callibri_phone" href="tel:<?=str_replace(array(' ', ')', '(', '-'), '', COption::GetOptionString("grain.customsettings","PHONE2"));?>"><?=COption::GetOptionString("grain.customsettings","PHONE2");?></a>
            <small onclick="openRecallPopup()" style="cursor: pointer;color: #3E85DC;">Перезвоните мне</small>
          </div>
        </div>
        <a href="#" class="menu-lg__item">
          <img class="menu-lg__icon" src="/upload/login-icon.svg" alt="">
          <div class="menu-lg__item-text">
            <? if($USER->IsAuthorized()): ?>
                <p><span onClick="auth('lk');">Личный кабинет</span> / <span onClick="auth('exit');">Выйти</span></p>
            <?else:?>
                <p><span onClick="auth('sign-in');">Вход</span> / <span onClick="auth('reg');">Регистрация</span></p>
            <?endif?>
          </div>
          <img class="menu-lg__arrow" src="/upload/chevron-bottom.svg" style="transform: rotate(-90deg)" alt="">
        </a>
        <a href="/personal/cart/" class="menu-lg__item">
          <img class="menu-lg__icon" src="/upload/cart-icon.svg" alt="">
          <div class="menu-lg__item-text">
            <span>Корзина</span>
            <p class="cart_desc-mobile"><small><?= $arResult['cart_num'];?> тов., <span><?= $arResult['cart_sum'];?> руб.</span></small></p>
          </div>
          <img class="menu-lg__arrow" src="/upload/chevron-bottom.svg" style="transform: rotate(-90deg)" alt="">
        </a>
        <a href="/personal/favorite/" class="menu-lg__item">
          <img class="menu-lg__icon" src="/upload/favorite-icon.svg" alt="">
          <div class="menu-lg__item-text">
            <span>Избранное</span>
            <small><?= $arResult['favorites'];?> тов.</small>
          </div>
          <img class="menu-lg__arrow" src="/upload/chevron-bottom.svg" style="transform: rotate(-90deg)" alt="">
        </a>
        <a href="/compare/" class="menu-lg__item">
          <img class="menu-lg__icon" src="/upload/compare-icon.svg" alt="">
          <div class="menu-lg__item-text">
            <span>Сравнение</span>
            <small><?= $arResult['compare']?> тов.</small>
          </div>
          <img class="menu-lg__arrow" src="/upload/chevron-bottom.svg" style="transform: rotate(-90deg)" alt="">
        </a>
      </div>
      <div class="container">
        <ul class="top-menu__col">
          <li><a href="/o_kompanii/" class="top-menu__item">О Компании</a></li>
          <li><a href="/stati/" class="top-menu__item">Статьи</a></li>
          <li><a href="/akcii/" class="top-menu__item">Акции</a></li>
          <li><a href="/novosti/" class="top-menu__item">Новости</a></li>
          <li><a href="/oplata/" class="top-menu__item">Оплата</a></li>
        </ul>
        <ul class="top-menu__col">
          <li><a href="/rassrochka/" class="top-menu__item">Мебель в рассрочку</a></li>
          <li><a href="/dostavka/" class="top-menu__item">Доставка</a></li>
          <li><a href="/garantii/" class="top-menu__item">Гарантия и возврат</a></li>
          <li><a href="/kontakty/" class="top-menu__item">Контакты</a></li>
        </ul>
      </div>
    </nav>
    <!-- /.top-menu__mob -->
    <div class="top-menu__open">
      <div class="top-menu__hamburger">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
      <!-- /.top-menu__hamburger -->
      <span>Меню</span>
    </div>
    <!-- /.top-menu__open -->
    <div class="header-item header-item__cart header-middle__item">
      <img loading="lazy" decoding="async" src="/upload/new_cart.svg" alt="Корзина" class="header-item__img">
      <div class="header-item__text">
        <a href="/personal/cart/" class="header-item__desc cart_desc-mobile">
          <strong><?= $arResult['cart_sum'];?> руб</strong><br>
          <small><?= $arResult['cart_num'];?> товaров</small>
        </a>
        <!-- /.header-item__desc -->
      </div>
      <!-- /.header-item__text -->
    </div>
    <!-- /.header-item -->
  </div>
  <!-- /.container -->
</div>
<!-- /.header-bottom -->
</header>
<!-- /.header -->


<div class="popup-wrapper" style="display: none;">
    <div class="call-popup popup">
    	<div class="popup-close">×</div>
    	<div class="popup-form">
         	<? $APPLICATION->IncludeComponent(
            	"bitrix:form.result.new", 
            	"fb3", 
            	array(
            		"CACHE_TIME" => "3600",
            		"AJAX_OPTION_ADDITIONAL" => "INLINES",
            		"CACHE_TYPE" => "Y",
            		"AJAX_MODE" => "Y",
            		"AJAX_OPTION_JUMP" => "N",
            		"AJAX_OPTION_STYLE" => "N",
            		"AJAX_OPTION_HISTORY" => "N",
            		"CHAIN_ITEM_LINK" => "",
            		"CHAIN_ITEM_TEXT" => "",
            		"EDIT_URL" => "",
            		"IGNORE_CUSTOM_TEMPLATE" => "N",
            		"LIST_URL" => "",
            		"SEF_MODE" => "Y",
            		"SEF_FOLDER" => "/",
            		"SUCCESS_URL" => "",
            		"USE_EXTENDED_ERRORS" => "N",
            		"WEB_FORM_ID" => "3",
            		"COMPONENT_TEMPLATE" => "fb3"
            	),
            	false
            );?>
    	</div>
    </div>
    
    
    <div class="one_click-popup popup">
	<div class="popup-close">×</div>
	<div class="popup-form">
		<? $APPLICATION->IncludeComponent(
        	"bitrix:form.result.new", 
        	"fb3", 
        	array(
        		"CACHE_TIME" => "3600",
        		"AJAX_OPTION_ADDITIONAL" => "INLINES",
        		"CACHE_TYPE" => "Y",
        		"AJAX_MODE" => "Y",
        		"AJAX_OPTION_JUMP" => "N",
        		"AJAX_OPTION_STYLE" => "N",
        		"AJAX_OPTION_HISTORY" => "N",
        		"CHAIN_ITEM_LINK" => "",
        		"CHAIN_ITEM_TEXT" => "",
        		"EDIT_URL" => "",
        		"IGNORE_CUSTOM_TEMPLATE" => "N",
        		"LIST_URL" => "",
        		"SEF_MODE" => "Y",
        		"SEF_FOLDER" => "/",
        		"SUCCESS_URL" => "",
        		"USE_EXTENDED_ERRORS" => "N",
        		"WEB_FORM_ID" => "10",
        		"COMPONENT_TEMPLATE" => "fb3"
        	),
        	false
        );?>
	</div>
</div>
</div>
