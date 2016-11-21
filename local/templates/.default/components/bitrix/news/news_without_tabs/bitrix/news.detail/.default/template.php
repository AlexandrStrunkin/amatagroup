<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="detail_news">
    <div class="date"><?= date_format(date_create_from_format('d.m.Y H:i:s', $arResult['DATE_CREATE']), 'd.m.Y') ?></div><br>
    <div class="<?= (date_format(date_create_from_format('d.m.Y H:i:s', $arResult['DATE_ACTIVE_TO']), 'd.m.Y') > date('d.m.Y') || !$arItem['DATE_ACTIVE_TO']) ? 'green' : 'red'; ?>"></div>
    <span>
    <?$datetime_from = new DateTime(date_format(date_create_from_format('d.m.Y H:i:s', $arResult['DATE_ACTIVE_FROM']), 'd.m.Y'));
        $datetime2 = new DateTime(date_format(date_create_from_format('d.m.Y H:i:s', $arResult['DATE_ACTIVE_TO']), 'd.m.Y'));
        $interval_validity = $datetime_from->diff($datetime2);
        $format_day_validity = $interval_validity->format('%d');
        echo GetMessage('VALIDITY') . getNumEnding($format_day_validity, GetMessage('DAY'));?>
    </span>
    <span class="date_validity">
    <?
        $datetime_to = new DateTime(date('d.m.Y'));
        $interval_deadline = $datetime2->diff($datetime_to);
        $format_day = $interval_deadline->format('%d');
        if( date_format(date_create_from_format('d.m.Y H:i:s', $arResult['DATE_ACTIVE_TO']), 'd.m.Y') > date('d.m.Y')){
            echo GetMessage('DEADLINE') . getNumEnding($format_day, GetMessage('DAY'));
        }
    ?>
    </span><br><br>
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