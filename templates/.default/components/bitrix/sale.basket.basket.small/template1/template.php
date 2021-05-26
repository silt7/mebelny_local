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
$this->createFrame()->begin("..."); ?> 
<? //echo '<pre>'.print_r($arResult,true).'</pre>';
?>
<div class="badge bag middle-block">
    <?
    global $APPLICATION;
    $arFavorites = array();
    if(!$USER->IsAuthorized())
    {
        $arFavorites = unserialize($_COOKIE["favorites"]);
        //print_r($arFavorites);
    }
    else {
        $idUser = $USER->GetID();
        $rsUser = CUser::GetByID($idUser);
        $arUser = $rsUser->Fetch();
        $arFavorites = $arUser['UF_FAVORITES'];  // Достаём избранное пользователя
    }
    if($arFavorites){
        $far_qnt = count($arFavorites);
    }else{
        $far_qnt = 0;
    }
    ?>
    <div class="img-wrap" data-count="<?=$far_qnt?>">
        <span class="js_span_location" data-location="/personal/favorite/"><img src="<?=SITE_TEMPLATE_PATH?>/static/img/badge.png" alt="badge"></span>
    </div>
    <div class="js_span_location" data-location="/personal/favorite/">
								<div class="text-wrap block-none">
									<span class="h2">Избранное</span>
									<p>
<!--                                        Товаров (нет)-->
                                    </p>
								</div>
							</div>
</div>
<div class="bag middle-block" id="cart_line">

<?
if (IntVal($arResult["COUNT"])>0)
{
?>
        <!--a href="<? //=$arParams["PATH_TO_BASKET"]?>">
           <?echo str_replace('#NUM#', intval($arResult["COUNT"]), GetMessage('YOUR_CART'))?><br/>
           <?echo str_replace('#NUM#', $arResult["SUM"], GetMessage('TSBS_SUM'))?>
        </a-->

        <div class="img-wrap" data-count="<?=$arResult["COUNT"]?>">
            <span class="js_span_location" data-location="/personal/cart/"><img src="<?=SITE_TEMPLATE_PATH?>/static/img/shopping-bag.png" alt="bag"></span>
        </div>
        <div class="text-wrap block-none">
            <div class="js_span_location" data-location="/personal/cart/"><span class="h2">Корзина</span>
            <p><?=$arResult["COUNT"]?> тов., <?=$arResult["SUM"]?> руб</p></div>
        </div>
<? } else { ?> 
        <div class="img-wrap" data-count="0">
            <span class="js_span_location" data-location="/personal/cart/"><img src="<?=SITE_TEMPLATE_PATH?>/static/img/shopping-bag.png" alt="bag"></span>
        </div>
        <div class="text-wrap block-none">
            <div class="js_span_location" data-location="/personal/cart/"><span class="h2">Корзина</span>
            <p>0 товаров, 0.00 руб</p></div>
        </div>
<? } ?>

</div>