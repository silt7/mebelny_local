<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$arResult['ITEMS'] = array();
foreach ($arResult['SECTIONS'] as $item) {
    if ($item['IBLOCK_SECTION_ID'] > 0) {
        $arResult['ITEMS'][$item['IBLOCK_SECTION_ID']]['CHILD'][] = $item;
    } else {
        $item['CHILD'] = array();
        $arResult['ITEMS'][$item['ID']] = $item;
    }
}

$this->setFrameMode(true);
?>


<div class="footer-list__flex">
<?php
    $index = 0;
    foreach ($arResult['ITEMS'] as $item) {
        $index += 1;
        if ($index <= 8) continue;
		if ($index == 14) break;
?>
    <div class="list-wrap">
            <div class="h5"><a href="<?=$item['SECTION_PAGE_URL']?>"><?=$item['NAME']?></a> <span>(<?=$item['ELEMENT_CNT']?>)</span></div>
            <ul class="footer-list">
            <? $output = array_slice($item['CHILD'], 0, 4); ?>
            <?php foreach ($output as $child) { ?>
                <li><a href="<?=$child['SECTION_PAGE_URL']?>"><?=$child['NAME']?></a></li>
            <?php } ?>
            </ul>
            <a href="<?=$item["SECTION_PAGE_URL"]?>" class="show-all"><span></span><span></span><span></span></a>
    </div>
<?php } ?>
</div>

<? //if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>'; }