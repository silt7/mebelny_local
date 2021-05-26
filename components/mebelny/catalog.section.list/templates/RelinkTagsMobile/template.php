<?php
if (!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);

$arFilterCodes = $GLOBALS["ALL_SECTIONS"];
?>
<?if($arResult['SECTIONS']):?>


            <div class="wds_certificates_body">
                <?$page = $APPLICATION->GetCurPage();?>
                <?foreach($arResult['SECTIONS'] as $arSection):?>
                    <?
                    $active = '';
                    if($page == $arSection["SECTION_PAGE_URL"]){
                        $active = 'active';
                    }
                    ?>
                    <?if($arSection['UF_TO_TAGS']==1 && $arSection["ACTIVE"]=="Y"):?>
                        <div class="wds_certificates_item w1510_menuTags_item <?=$active?>" data-filter="<?=$arSection["UF_URL_FILTER"]?>">
                            <a href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?> <span>(<?=$arSection['ELEMENT_CNT']?>)</span></a>
                        </div>
                    <?endif?>
                <?endforeach?>
            </div>                            
         
    
    <script>
        $('.wds_certificates_body').slick({
            arrows:true
        });
    </script>


<?endif?>