<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

use Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

if (!$arResult['NavShowAlways']) {
    if ($arResult['NavRecordCount'] == 0 || ($arResult['NavPageCount'] == 1 && $arResult['NavShowAll'] == false)) {
        return;
    }
}

$strNavQueryString = ($arResult['NavQueryString'] != '' ? $arResult['NavQueryString'] . '&amp;' : '');

$strNavQueryStringFull = ($arResult['NavQueryString'] != '' ? '?' . $arResult['NavQueryString'] : ''); 

?>
<div class="ax-pagination js-ax-ajax-pagination-container ax-grey">
    <div class="ax-pagination-container row">

        <?php if ($arResult['NavPageNomer'] < $arResult['NavPageCount']) { ?>
            <a class="ax-show-more-pagination js-ax-show-more-pagination" rel="nofollow"
               href="<?php echo $arResult['sUrlPath'] ?>?<?php echo $strNavQueryString ?>PAGEN_<?php echo $arResult['NavNum'] ?>=<?php echo ($arResult['NavPageNomer'] + 1) ?>">
                <span class="ax-link ax-dotted-link"><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_SHOW_MORE') ?></span>
            </a>
        <?php } elseif ($arResult['NavPageNomer'] == $arResult['NavPageCount']) { ?>
            <span class="ax-show-more-pagination js-ax-show-more-pagination last-page" rel="nofollow">
                <span class="ax-no-more"><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_SHOW_NO_MORE') ?></span>
            </span>
        <?php } ?>

        <ul>
            <?php if ($arResult['bDescPageNumbering'] === true) { ?>

                <?php if ($arResult['NavPageNomer'] < $arResult['NavPageCount']) { ?>
                    <?php if ($arResult['bSavePage']) { ?>
                        <li class="ax-pag-prev">
                            <a href="<?php echo $arResult['sUrlPath'] ?>?<?php echo $strNavQueryString ?>PAGEN_<?php echo $arResult['NavNum'] ?>=<?php echo ($arResult['NavPageNomer'] + 1) ?>">
                                <span><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_BACK') ?></span>
                            </a>
                        </li>
                        <li>
                            <a class="js-ax-pager-link" href="<?php echo $arResult['sUrlPath'] ?>?<?php echo $strNavQueryString ?>PAGEN_<?php echo $arResult['NavNum'] ?>=<?php echo ($arResult['NavPageNomer'] + 1) ?>">
                                <span>1</span>
                            </a>
                        </li>
                    <?php } else { ?>
                        <?php if (($arResult['NavPageNomer'] + 1) == $arResult['NavPageCount']) { ?>
                            <li class="ax-pag-prev">
                                <a class="js-ax-pager-link" href="<?php echo $arResult['sUrlPath'] ?><?php echo $strNavQueryStringFull ?>">
                                    <span><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_BACK') ?></span>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="ax-pag-prev">
                                <a class="js-ax-pager-link"
                                   href="<?php echo $arResult['sUrlPath'] ?>?<?php echo $strNavQueryString ?>PAGEN_<?php echo $arResult['NavNum'] ?>=<?php echo ($arResult['NavPageNomer'] + 1) ?>">
                                    <span><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_BACK') ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <li>
                            <a class="js-ax-pager-link"
                               href="<?php echo $arResult['sUrlPath'] ?><?php echo $strNavQueryStringFull ?>">
                                <span>1</span>
                            </a>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <li class="ax-pag-prev"><span><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_BACK') ?></span></li>
                    <li class="ax-active"><span>1</span></li>
                <?php } ?>

                <?php
                $arResult['nStartPage']--;

                while ($arResult['nStartPage'] >= $arResult['nEndPage'] + 1) {
                    $NavRecordGroupPrint = $arResult['NavPageCount'] - $arResult['nStartPage'] + 1;
                    
                    if ($arResult['nStartPage'] == $arResult['NavPageNomer']) { ?>
                        <li class="ax-active"><span><?php echo $NavRecordGroupPrint ?></span></li>
                    <?php } else { ?>
                        <li>
                            <a class="js-ax-pager-link"
                               href="<?php echo $arResult['sUrlPath'] ?>?<?php echo $strNavQueryString ?>PAGEN_<?php echo $arResult['NavNum'] ?>=<?php echo $arResult['nStartPage'] ?>">
                                <span><?php echo $NavRecordGroupPrint ?></span></a>
                        </li>
                    <?php } ?>
                    <?php $arResult['nStartPage']-- ?>
                <?php } ?>

                <?php if ($arResult['NavPageNomer'] > 1) { ?>
                    <?php if ($arResult['NavPageCount'] > 1) { ?>
                        <li>
                            <a class="js-ax-pager-link"
                               href="<?php echo $arResult['sUrlPath'] ?>?<?php echo $strNavQueryString ?>PAGEN_<?php echo $arResult['NavNum'] ?>=1">
                                <span><?php echo $arResult['NavPageCount'] ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="ax-pag-next">
                        <a class="js-ax-pager-link"
                           href="<?php echo $arResult['sUrlPath'] ?>?<?php echo $strNavQueryString ?>PAGEN_<?php echo $arResult['NavNum'] ?>=<?php echo ($arResult['NavPageNomer'] - 1) ?>">
                            <span><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_FORWARD') ?></span>
                        </a>
                    </li>
                <?php } else { ?>
                    <?php if ($arResult['NavPageCount'] > 1) { ?>
                        <li class="ax-active"><span><?php echo $arResult['NavPageCount'] ?></span></li>
                    <?php } ?>
                    <li class="ax-pag-next"><span><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_FORWARD') ?></span></li>
                <?php } ?>

            <?php } else { ?>

                <?php if ($arResult['NavPageNomer'] > 1) { ?>
                    <?php if ($arResult['bSavePage']) { ?>
                        <li class="ax-pag-prev">
                            <a class="js-ax-pager-link"
                               href="<?php echo $arResult['sUrlPath'] ?>?<?php echo $strNavQueryString ?>PAGEN_<?php echo $arResult['NavNum'] ?>=<?php echo ($arResult['NavPageNomer'] - 1) ?>">
                                <span><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_BACK') ?></span>
                            </a>
                        </li>
                        <li>
                            <a class="js-ax-pager-link"
                               href="<?php echo $arResult['sUrlPath'] ?>?<?php echo $strNavQueryString ?>PAGEN_<?php echo $arResult['NavNum'] ?>=1">
                                <span>1</span>
                            </a>
                        </li>
                    <?php } else { ?>
                        <?php if ($arResult['NavPageNomer'] > 2) { ?>
                            <li class="ax-pag-prev">
                                <a class="js-ax-pager-link"
                                   href="<?php echo $arResult['sUrlPath'] ?>?<?php echo $strNavQueryString ?>PAGEN_<?php echo $arResult['NavNum'] ?>=<?php echo ($arResult['NavPageNomer'] - 1) ?>">
                                    <span><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_BACK') ?></span>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="ax-pag-prev">
                                <a class="js-ax-pager-link"
                                   href="<?php echo $arResult['sUrlPath'] ?><?php echo $strNavQueryStringFull ?>">
                                    <span><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_BACK') ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <li>
                            <a class="js-ax-pager-link"
                               href="<?php echo $arResult['sUrlPath'] ?><?php echo $strNavQueryStringFull ?>">
                                <span>1</span>
                            </a>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <li class="ax-pag-prev"><span><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_BACK') ?></span></li>
                    <li class="ax-active"><span>1</span></li>
                <?php } ?>

                <?php
                $arResult['nStartPage']++;

                while ($arResult['nStartPage'] <= $arResult['nEndPage'] - 1) {
                    if ($arResult['nStartPage'] == $arResult['NavPageNomer']) { ?>
                        <li class="ax-active">
                            <span><?php echo $arResult['nStartPage'] ?></span>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a class="js-ax-pager-link"
                               href="<?php echo $arResult['sUrlPath'] ?>?<?php echo $strNavQueryString ?>PAGEN_<?php echo $arResult['NavNum'] ?>=<?php echo $arResult['nStartPage'] ?>">
                                <span><?php echo $arResult['nStartPage'] ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php $arResult['nStartPage']++ ?>
                <?php } ?>

                <?php if ($arResult['NavPageNomer'] < $arResult['NavPageCount']) { ?>
                    <?php if ($arResult['NavPageCount'] > 1) { ?>
                        <li>
                            <a class="js-ax-pager-link"
                               href="<?php echo $arResult['sUrlPath'] ?>?<?php echo $strNavQueryString ?>PAGEN_<?php echo $arResult['NavNum'] ?>=<?php echo $arResult['NavPageCount'] ?>">
                                <span><?php echo $arResult['NavPageCount'] ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="ax-pag-next">
                        <a class="js-ax-pager-link"
                           href="<?php echo $arResult['sUrlPath'] ?>?<?php echo $strNavQueryString ?>PAGEN_<?php echo $arResult['NavNum'] ?>=<?php echo ($arResult['NavPageNomer'] + 1) ?>">
                            <span><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_FORWARD') ?></span>
                        </a>
                    </li>
                <?php } else { ?>
                    <?php if ($arResult['NavPageCount'] > 1) { ?>
                        <li class="ax-active">
                            <span><?php echo $arResult['NavPageCount'] ?></span>
                        </li>
                    <?php } ?>
                    <li class="ax-pag-next">
                        <span><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_FORWARD') ?></span>
                    </li>
                <?php } ?>
            <?php } ?>

            <?php if ($arResult['bShowAll']) { ?>
                <?php if ($arResult['NavShowAll']) { ?>
                    <li class="ax-pag-all">
                        <a class="js-ax-pager-link"
                           rel="nofollow"
                           href="<?php echo $arResult['sUrlPath'] ?>?<?php echo $strNavQueryString ?>SHOWALL_<?php echo $arResult['NavNum'] ?>=0">
                                <span><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_PAGES') ?></span>
                        </a>
                    </li>
                <?php } else { ?>
                    <li class="ax-pag-all">
                        <a class="js-ax-pager-link"
                           rel="nofollow"
                           href="<?php echo $arResult['sUrlPath'] ?>?<?php echo $strNavQueryString ?>SHOWALL_<?php echo $arResult['NavNum'] ?>=1">
                            <span><?php echo Loc::getMessage('ARTMIX_AJAXPAGINATION_ALL') ?></span>
                        </a>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
        <div style="clear:both"></div>
    </div>
</div>
