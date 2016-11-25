<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="detail_news">

    <span>
    <?$datetime_from = date_format(date_create_from_format('d.m.Y H:i:s', $arResult['DATE_ACTIVE_FROM']), 'd.m.Y');
            $datetime_to = date_format(date_create_from_format('d.m.Y H:i:s', $arResult['DATE_ACTIVE_TO']), 'd.m.Y');
            $datetime_create = date_format(date_create_from_format('d.m.Y H:i:s', $arResult['DATE_CREATE']), 'd.m.Y');
            $date_today = new DateTime(date('d.m.Y'));
            $date_to = new DateTime(date_format(date_create_from_format('d.m.Y H:i:s', $arResult['DATE_ACTIVE_TO']), 'd.m.Y'));
            $interval_deadline = $date_to->diff($date_today);
            $format_day = $interval_deadline->format('%d');
    ?>
    </span>
     <div class="<?= ($datetime_to > date('d.m.Y') || !$arResult['DATE_ACTIVE_TO']) ? 'green' : 'red'; ?>">
            <? if ($datetime_to > date('d.m.Y') || !$arResult['DATE_ACTIVE_TO']) { ?>
                <span class="date_validity">
                    <?= GetMessage('DEADLINE') . getNumEnding($format_day, array(GetMessage('DAY_1'), GetMessage('DAY_2'), GetMessage('DAY_3')));?>
                </span>
            <?} else { ?>
                <span class="date_validity">
                    <?= GetMessage('DEADLINE_CLOSE');?>
                </span>
                <?}?>
            </div><br><br>
        <p class="dateText">
            <?= GetMessage('VALIDITY') . $datetime_create . GetMessage('VALIDITY_2') . $datetime_to; ?>
        </p>
    </span>
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
	<?endif?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
 	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
 		<div class="detail_text">
 			<?echo $arResult["DETAIL_TEXT"];?>
 		</div>
 	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
</div>
<div style="clear: both"></div>