<?php
if (!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);

$arFilterCodes = $GLOBALS["ALL_SECTIONS"];
?>

<?if($arResult['SECTIONS']):?>

    <?/*** RelinkMenuTags ***/?>
    <div class="w1510_menuTags">
        <div class="w1510_menuTags_wrap spoiler_close" id="spoilerMenuTags_container">
            <div class="w1510_menuTags_left">
                <?$page = $APPLICATION->GetCurPage();?>
                <?foreach($arResult['SECTIONS'] as $arSection):?>
                <?
                $active = '';
                if($page == $arSection["SECTION_PAGE_URL"]){
                    $active = 'active';
                }
                ?>
                    <?if($arSection['UF_TO_TAGS']==1 && $arSection["ACTIVE"]=="Y"):?>
                        <div class="w1510_menuTags_item <?=$active?>" data-filter="<?=$arSection["UF_URL_FILTER"]?>">
                            <a href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?> <span>(<?=$arSection['ELEMENT_CNT']?>)</span></a>
                        </div>
                    <?endif?>
                <?endforeach?>
            </div>                            
        </div>    
        <div class="w1510_menuTags_right">
            <a id="spoilerMenuTags_link">Показать ещё ↓</a>
        </div>                 
    </div>              
    
    <script>
        // Спойлер перелинковки облака тегов (в разделах)
        $('#spoilerMenuTags_link').click(function(){     
            if($('#spoilerMenuTags_container').hasClass('spoiler_close')){
                $('#spoilerMenuTags_container').toggleClass('spoiler_open');
                $('#spoilerMenuTags_container').removeClass('spoiler_close');
                $(this).html('Скрыть ↑');           
            }
            else{
                $('#spoilerMenuTags_container').toggleClass('spoiler_close'); 
                $('#spoilerMenuTags_container').removeClass('spoiler_open');
                $(this).html('Показать ещё ↓');
            }
        });
    </script>
    <?/*** // RelinkMenuTags ***/?>

<?endif?>

<style>
   @media screen and (min-width: 980px) {
    .recomend__product .product-wrap, .visual .product-wrap
    {
        width: 33.333%;
    }
   }
</style>