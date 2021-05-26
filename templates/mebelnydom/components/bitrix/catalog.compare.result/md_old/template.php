<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$request =  \Bitrix\Main\Context::getCurrent()->getRequest();
$isAjax = $request->isAjaxRequest();

if ($isAjax)
{
	$APPLICATION->RestartBuffer();
	$_REQUEST["ajax_action"] = "Y";
	$_POST["ajax_action"] = "Y";
	$_GET["ajax_action"] = "Y";
}

$bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name);

 ?>

<? //$isAjax = ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["ajax_action"]) && $_POST["ajax_action"] == "Y");

?>
            <div class="content-flex">
                <section class="p-comparison" id="bx_catalog_compare_block">
                    <div class="p-comparison__top">
                        <div class="p-comparison__title"><? $APPLICATION->ShowTitle(false)?></div>
                        <div class="p-comparison__btns bx_sort_container">                            
                            <a class="p-comparison__top-btn<? echo (!$arResult["DIFFERENT"] ? ' active' : ''); ?>" href="<? echo $arResult['COMPARE_URL_TEMPLATE'].'DIFFERENT=N'; ?>" onclick="BX.ajax.insertToNode('/compare/?DIFFERENT=N&bxajaxid=<?=$bxajaxid?>', 'comp_<?=$bxajaxid?>'); return false;" rel="nofollow"><?=GetMessage("CATALOG_ALL_CHARACTERISTICS")?></a>
	                        <a class="p-comparison__top-btn<? echo ($arResult["DIFFERENT"] ? ' active' : ''); ?>" href="<? echo $arResult['COMPARE_URL_TEMPLATE'].'DIFFERENT=Y'; ?>" onclick="BX.ajax.insertToNode('/compare/?DIFFERENT=Y&bxajaxid=<?=$bxajaxid?>', 'comp_<?=$bxajaxid?>'); return false;" rel="nofollow"><?=GetMessage("CATALOG_ONLY_DIFFERENT")?></a>
                        </div>
                    </div>

                    <div class="tables-wrapper">
                        <div class="table-left-wrap">
                            <!-- JSClone table here -->
                        </div>
                        <div class="table-right-wrap">
                            <table class="t-table">
                            <?
                            if (!empty($arResult["SHOW_FIELDS"]))
                            {
                                        ?>
                                        <thead>
                                        <tr><th><div class="t-table__thead-width"></div></th><?
                                        foreach($arResult["ITEMS"] as $arElement)
                                        {
                                    ?>
                                            <th>
                                            <div class="t-table__card">
                                                <a onclick="CatalogCompareObj.MakeAjaxAction('<?=CUtil::JSEscape($arElement['~DELETE_URL'])?>');" href="javascript:void(0)" class="t-table__card__del-btn"></a>
                            
                                                <div class="t-table__card-img-container">
                                                       <a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
                                                         <img src="<?=$arElement["FIELDS"]['PREVIEW_PICTURE']["SRC"]?>" alt="<?=$arElement["FIELDS"][$code]["ALT"]?>" title="<?=$arElement["FIELDS"][$code]["TITLE"]?>" class="t-table__card-img img-responsive">
                                
                                                       </a>
                                                </div>
                            
                                                <div class="t-table__card-mid">
                                                    <div class="t-table__card-price"><? echo $arElement['MIN_PRICE']['PRINT_DISCOUNT_VALUE']; ?></div>
                            
                                                    <div class="t-table__card-like">
                                                        <? /*?><a href="<?=$arElement["BUY_URL"]?>"><i class="fa fa-shopping-cart active" aria-hidden="true"></i></a><? */?>
                                                        <a class="addFav" data-id="<?=$arElement["~ID"];?>" href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                            
                                                <div class="t-table__card-title">
                                                    <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement['NAME']?></a>
                                                </div>
                                            </div>
                                                                        
                            
                                            </th>
                                        <?
                                        }
                                    }
                                ?>
                                </tr>
                                </thead>
                            <tbody>
                            <? if (!empty($arResult["SHOW_OFFER_FIELDS"]))
                            {
                                foreach ($arResult["SHOW_OFFER_FIELDS"] as $code => $arProp)
                                {
                                    $showRow = true;
                                    if ($arResult['DIFFERENT'])
                                    {
                                        $arCompare = array();
                                        foreach($arResult["ITEMS"] as $arElement)
                                        {
                                            $Value = $arElement["OFFER_FIELDS"][$code];
                                            if(is_array($Value))
                                            {
                                                sort($Value);
                                                $Value = implode(" / ", $Value);
                                            }
                                            $arCompare[] = $Value;
                                        }
                                        unset($arElement);
                                        $showRow = (count(array_unique($arCompare)) > 1);
                                    }
                                    if ($showRow)
                                    {
                                    ?>
                                    <tr>
                                        <td><?=GetMessage("IBLOCK_OFFER_FIELD_".$code)?></td>
                                        <? foreach($arResult["ITEMS"] as $arElement)
                                        {
                                            ?><td><?
                                            switch ($code)
                                            {
                                                case 'PREVIEW_PICTURE':
                                                case 'DETAIL_PICTURE':
                                                    if (!empty($arElement["OFFER_FIELDS"][$code]) && is_array($arElement["OFFER_FIELDS"][$code]))
                                                    {
                                                        ?><img border="0" src="<?= $arElement["OFFER_FIELDS"][$code]["SRC"] ?>"
                                                            width="auto" height="150"
                                                            alt="<?= $arElement["OFFER_FIELDS"][$code]["ALT"] ?>" title="<?= $arElement["OFFER_FIELDS"][$code]["TITLE"] ?>"
                                                        /><?
                                                    }
                                                    break;
                                                default:
                                                    ?><?=(is_array($arElement["OFFER_FIELDS"][$code])? implode("/ ", $arElement["OFFER_FIELDS"][$code]): $arElement["OFFER_FIELDS"][$code])?><?
                                                    break;
                                            }
                                            ?></td><?
                                        }
                                        unset($arElement);
                                        ?>
                                    </tr>
                                    <?
                                    }
                                }
                            }
                            ?>
                            <?
                            if (!empty($arResult["SHOW_PROPERTIES"]))
                            {
                                foreach ($arResult["SHOW_PROPERTIES"] as $code => $arProperty)
                                {
                                    $showRow = true;
                                    if ($arResult['DIFFERENT'])
                                    {
                                        $arCompare = array();
                                        foreach($arResult["ITEMS"] as $arElement)
                                        {
                                            $arPropertyValue = $arElement["DISPLAY_PROPERTIES"][$code]["VALUE"];
                                            if (is_array($arPropertyValue))
                                            {
                                                sort($arPropertyValue);
                                                $arPropertyValue = implode(" / ", $arPropertyValue);
                                            }
                                            $arCompare[] = $arPropertyValue;
                                        }
                                        unset($arElement);
                                        $showRow = (count(array_unique($arCompare)) > 1);
                                    }
                            
                                    if ($showRow)
                                    {
                                        ?>
                                        <tr>
                                            <td class="name"><?=$arProperty["NAME"]?></td>
                                            <?foreach($arResult["ITEMS"] as $arElement)
                                            {
                                                ?>
                                                <td>
                                                    <?=(is_array($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])? implode("/ ", $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]): $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])?>
                                                </td>
                                            <?
                                            }
                                            unset($arElement);
                                            ?>
                                        </tr>
                                    <?
                                    }
                                }
                            }
                            
                            if (!empty($arResult["SHOW_OFFER_PROPERTIES"]))
                            {
                                foreach($arResult["SHOW_OFFER_PROPERTIES"] as $code=>$arProperty)
                                {
                                    $showRow = true;
                                    if ($arResult['DIFFERENT'])
                                    {
                                        $arCompare = array();
                                        foreach($arResult["ITEMS"] as $arElement)
                                        {
                                            $arPropertyValue = $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["VALUE"];
                                            if(is_array($arPropertyValue))
                                            {
                                                sort($arPropertyValue);
                                                $arPropertyValue = implode(" / ", $arPropertyValue);
                                            }
                                            $arCompare[] = $arPropertyValue;
                                        }
                                        unset($arElement);
                                        $showRow = (count(array_unique($arCompare)) > 1);
                                    }
                                    if ($showRow)
                                    {
                                    ?>
                                    <tr>
                                        <td><?=$arProperty["NAME"]?></td>
                                        <? foreach($arResult["ITEMS"] as $arElement)
                                        {
                                        ?>
                                        <td>
                                            <?=(is_array($arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])? implode("/ ", $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]): $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])?>
                                        </td>
                                        <?
                                        }
                                        unset($arElement);
                                        ?>
                                    </tr>
                                    <?
                                    }
                                }
                            }
                                ?>
                                    <tr class="">
                                      <td></td>
                                      <? foreach($arResult["ITEMS"] as $arElement)
										{ ?>
                                        <?php /*<td><a href="<?=$arElement["BUY_URL"]?>" class="t-table__link">Купить</a></td>*/ ?>
<td>
	<div id="detailProductBasketButtons" class="bascket-wrap">
		<button class="product__buscket detailProductInCart btn-def" data-basketcheck="<?=$arElement['ID']?>" data-ids="" data-counts="" onclick="add_to_cart(<?=$arElement['ID']?>, this)">В корзину</button>
		<button class="product__buscket detailProductOutCart btn-def" onclick="location.href='/personal/cart/')" style="display:none">В корзине</button>
		<script data-skip-moving="true">
			var id = <?=$arElement['ID']?>;
			if (in_array_basket(id)) {
				document.getElementById('pib'+id).style.display = "";
				document.getElementById('pnb'+id).style.display = "none";
			}
		</script>
	</div>
</td>

										<?
                                        }
                                        unset($arElement);
                                      ?>
                                    </tr>
                                    
                                </tbody>
                            </table>
                                    </div>
                    </div>

                </section>
            </div>

               
<script type="text/javascript">
	var CatalogCompareObj = new BX.Iblock.Catalog.CompareClass("bx_catalog_compare_block");
</script>

			<?
            if ($isAjax)
            {
				?><script type="text/javascript">comparison_table();</script><?php
                die();
            }
            ?>

<? //echo '<pre>'; print_r($arResult["SHOW_FIELDS"]); echo '<pre>'; ?>