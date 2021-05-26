<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);
?>
<? /*?>/filter/fabr-is-".$fabr."/apply/<? */?>
  <section class="brand">
    <h2 class="brand__title-hero">Бренды</h2>
    <div class="container brand__wrap">
      <ul class="brands-list brand__list">
        <li><img loading="lazy" decoding="async" class="brands-list__img"  src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>"/></li>
		<? 
		  array_unshift($arResult["PROPERTIES"]["LINKS"]["DESCRIPTION"],"empty");
		  array_unshift($arResult["PROPERTIES"]["LINKS"]["VALUE"],"empty");
		  $arFilter = Array('IBLOCK_ID'=>"2", 'ACTIVE'=>'Y', "ACTIVE_DATE"=>"Y", "DEPTH_LEVEL" => "1", "CNT_ACTIVE" => "Y", 'PROPERTY'=>Array('Fabr'=>$arResult["ID"]));
          $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
          ?>

          <? while($ar_result = $db_list->GetNext())
              {

                $key = array_search($ar_result['NAME'], $arResult["PROPERTIES"]["LINKS"]["DESCRIPTION"]);

                // ищем внутри корневого раздела раздел, в котором встречается название фабрики
                  $arFilterChild = Array(
                      'IBLOCK_ID'=>"2",
                      'ACTIVE'=>'Y',
                      "ACTIVE_DATE"=>"Y",
                      "!DEPTH_LEVEL" => "1",
                      'SECTION_ID'=>$ar_result["ID"],
                      '%NAME' => $arResult["NAME"],
                      "CNT_ACTIVE" => "Y",
                  );
                  $db_list_child = CIBlockSection::GetList(Array($by=>$order), $arFilterChild, true);
                  $arChildSection = array();
                  $link = '';
                  $count = '';
                  while($arChildSection = $db_list_child->GetNext()){
                      $link = $arChildSection["SECTION_PAGE_URL"];
                      //$count = $arChildSection["ELEMENT_CNT"];
                      
                        $elements = CIBlockElement::GetList (
                           Array("SORT" => "ASC"),
                           Array("SECTION_ID" => $arChildSection["ID"], "ACTIVE" => "Y", array("LOGIC" => "OR", ">PROPERTY_POD_ZAKAZ" => 0, ">PROPERTY_QTY" => 0))
                        );
                        $count = $elements->SelectedRowsCount();
                        if($count == 0) $count = -1;
                  }
                  
                  if(!$link) {
                      if ($key > 0) {
                          $link = $arResult["PROPERTIES"]["LINKS"]["VALUE"][$key];
                      } else {
                          $link = '/' . $ar_result['CODE'] . '/filter/fabr-' . $arResult["PROPERTIES"]["PROPERTY_CODE"]["VALUE"] . '/';
                      }
                  }
                  if(!$count){
                        $count =  $ar_result['ELEMENT_CNT'];
                  }
                
                  $fabr = ToLower(str_replace(" ", "+", $arResult['NAME']));
                if($count > 0){
                    echo "<li><a class='brands-list__link' href=".$link.">".$ar_result['NAME']." <span class='contside__link-mark'>«".$arResult['NAME']."»</span> (".$count.')</a></li>';
                }
                //echo "<pre>"; print_r($ar_result); echo "</pre>";
              }
        ?>
        <li class="brands-list__follow">
          <span>Поделиться с друзьями</span>
          <div class="brands-list__follow-links">
            <a href="https://www.facebook.com/wwwmebelnydomcom" class="brands-list__follow-link"><i class="fa fa-facebook-f"></i></a>
            <a href="https://vk.com/moscowmebelnydomcom" class="brands-list__follow-link"><i class="fa fa-vk"></i></a>
            <a href="https://twitter.com/MebelnyDom" class="brands-list__follow-link"><i class="fa fa-twitter"></i></a>
            <a href="https://plus.google.com/+Mebelny-dom" class="brands-list__follow-link"><i class="fa fa-google"></i></a>
            <a href="https://www.instagram.com/mebelny_dom_com/" class="brands-list__follow-link"><i class="fa fa-instagram"></i></a>
          </div>
        </li>
      </ul>
      <!-- /.brands-list -->
      <div class="brand__content">
        <h1 class="brand__title"><?=$arResult['PROPERTIES']["TITLE"]["VALUE"]?></h1>
        <div class="brand__desc">
            <?=$arResult['DETAIL_TEXT']?>
        </div>
        <div class="brand__video"><iframe width="100%" height="460" src="https://www.youtube.com/embed/<?=$arResult['PROPERTIES']["VIDEO"]["VALUE"]?>" frameborder="0" allowfullscreen></iframe></div>
        <div class="form-help brand__form">
          <h4 class="form-help__title">Выбирайте мебель с нами!</h4>
          <span class="form-help__subtitle">Оставьте заявку или свяжитесь с нами по телефону. Мы поможем выбрать
            подходящую
            мебель, оформим заказ и доставку в удобное время</span>
          <span class="form-help__subtitle form-help__subtitle__blue">Отвечаем в течении 5 минут!</span>
        </div>
        <? $strEmail = Coption::GetOptionString('main','email_from'); ?>
        <? $APPLICATION->IncludeComponent(
        	"altasib:feedback.form", 
        	"brand", 
        	array(
        		"ACTIVE_ELEMENT" => "Y",
        		"ADD_EVENT_FILES" => "N",
        		"ADD_HREF_LINK" => "Y",
        		"ALX_LINK_POPUP" => "N",
        		"BBC_MAIL" => "",
        		"CAPTCHA_TYPE" => "default",
        		"CATEGORY_SELECT_NAME" => "Выберите категорию",
        		"CHANGE_CAPTCHA" => "N",
        		"CHECKBOX_TYPE" => "CHECKBOX",
        		"CHECK_ERROR" => "Y",
        		"COLOR_OTHER" => "#009688",
        		"COLOR_SCHEME" => "BRIGHT",
        		"COLOR_THEME" => "",
        		"EVENT_TYPE" => "ALX_FEEDBACK_FORM",
        		"FB_TEXT_NAME" => "",
        		"FB_TEXT_SOURCE" => "PREVIEW_TEXT",
        		"FORM_ID" => "1",
        		"IBLOCK_ID" => "4",
        		"IBLOCK_TYPE" => "d2mg_orderscall",
        		"INPUT_APPEARENCE" => array(
        			0 => "DEFAULT",
        		),
        		"JQUERY_EN" => "N",
        		"LINK_SEND_MORE_TEXT" => "Отправить ещё одно сообщение",
        		"LOCAL_REDIRECT_ENABLE" => "N",
        		"MASKED_INPUT_PHONE" => array(
        		),
        		"MESSAGE_OK" => "Ваше сообщение было успешно отправлено",
        		"NAME_ELEMENT" => "NAME",
        		"NOT_CAPTCHA_AUTH" => "Y",
        		"PROPERTY_FIELDS" => array(
        			0 => "PHONE",
        			1 => "NAME",
        		),
        		"PROPERTY_FIELDS_REQUIRED" => array(
        			0 => "PHONE",
        			1 => "NAME",
        		),
        		"PROPS_AUTOCOMPLETE_EMAIL" => array(
        		),
        		"PROPS_AUTOCOMPLETE_NAME" => array(
        		),
        		"PROPS_AUTOCOMPLETE_PERSONAL_PHONE" => array(
        		),
        		"PROPS_AUTOCOMPLETE_VETO" => "N",
        		"SECTION_FIELDS_ENABLE" => "N",
        		"SECTION_MAIL_ALL" => $strEmail,
        		"SEND_IMMEDIATE" => "Y",
        		"SEND_MAIL" => "N",
        		"SHOW_LINK_TO_SEND_MORE" => "Y",
        		"SHOW_MESSAGE_LINK" => "N",
        		"USERMAIL_FROM" => "N",
        		"USER_CONSENT" => "N",
        		"USER_CONSENT_ID" => "0",
        		"USER_CONSENT_INPUT_LABEL" => "",
        		"USER_CONSENT_IS_CHECKED" => "Y",
        		"USER_CONSENT_IS_LOADED" => "N",
        		"USE_CAPTCHA" => "N",
        		"WIDTH_FORM" => "50%",
        		"COMPONENT_TEMPLATE" => "brand",
        		"USER_EVENT" => "ALX_FEEDBACK_FORM_SEND_MAIL"
        	),
        	false
        );?>
        <!-- /.form-help -->
      </div>
    </div>
  </section>