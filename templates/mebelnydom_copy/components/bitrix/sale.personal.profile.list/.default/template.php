<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(strlen($arResult["ERROR_MESSAGE"])>0)
	ShowError($arResult["ERROR_MESSAGE"]);?>
<?if(strlen($arResult["NAV_STRING"]) > 0):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>             
<div class="article">
    <table class="responsive">
        <? /*?><tr>
            <th><?=GetMessage("P_ID")?><br /><?=SortingEx("ID")?></th>
            <th><?=GetMessage("P_DATE_UPDATE")?><br /><?=SortingEx("DATE_UPDATE")?></th>
            <th><?=GetMessage("P_NAME")?><br /><?=SortingEx("NAME")?></th>
            <th><?=GetMessage("P_PERSON_TYPE")?><br /><?=SortingEx("PERSON_TYPE_ID")?></th>
            <th><?=GetMessage("SALE_ACTION")?></th>
        </tr><? */?>
        <? foreach($arResult["PROFILES"] as $val):?>
            <tr>
                <td><b><?=$val["ID"]?></b></td>
                <td><?=$val["DATE_UPDATE"]?></td>
                <td><?=$val["NAME"]?></td>
                <td><?=$val["PERSON_TYPE"]["NAME"]?></td>
                <td><a title="<?= GetMessage("SALE_DETAIL_DESCR") ?>" href="<?=$val["URL_TO_DETAIL"]?>" class="btn-def">Редактировать</a>
                    <? /*?><a title="<?= GetMessage("SALE_DELETE_DESCR") ?>" class="btn btn-warning" href="javascript:if(confirm('<?= GetMessage("STPPL_DELETE_CONFIRM") ?>')) window.location='<?=$val["URL_TO_DETELE"]?>'">Удалить</a><? */?></td>
                </td>
            </tr>
        <? endforeach;?>
    </table>
</div>
<?if(strlen($arResult["NAV_STRING"]) > 0):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>