<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if (count($arResult["ITEMS"]) < 1)
	return;
?>
<div class="infoBlocksContent" style="display: block">
	<ul class="infoNewsList">
<?foreach($arResult["ITEMS"] as $arItem):?>
<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_ELEMENT_DELETE_CONFIRM')));

?>
	<li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="imageWrapper"><img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt=""/></div>
		<p class="dateText">
            <?= date_format(date_create_from_format('d.m.Y H:i:s', $arItem['DATE_CREATE']), 'd.m.Y') ?>
        </p>
            <div class="<?= (date_format(date_create_from_format('d.m.Y H:i:s', $arItem['DATE_ACTIVE_TO']), 'd.m.Y') > date('d.m.Y') || !$arItem['DATE_ACTIVE_TO']) ? 'green' : 'red'; ?>"></div>
        <span>
        <?$datetime_from = new DateTime(date_format(date_create_from_format('d.m.Y H:i:s', $arItem['DATE_ACTIVE_FROM']), 'd.m.Y'));
            $datetime2 = new DateTime(date_format(date_create_from_format('d.m.Y H:i:s', $arItem['DATE_ACTIVE_TO']), 'd.m.Y'));
            $interval_validity = $datetime_from->diff($datetime2);
            $format_day_validity = $interval_validity->format('%d');
            echo GetMessage('VALIDITY') . getNumEnding($format_day_validity, array(GetMessage('DAY_1'), GetMessage('DAY_2'), GetMessage('DAY_3')));?>
        </span>
        <span class="date_validity">
        <?
            $datetime_to = new DateTime(date('d.m.Y'));
            $interval_deadline = $datetime2->diff($datetime_to);
            $format_day = $interval_deadline->format('%d');
            if( date_format(date_create_from_format('d.m.Y H:i:s', $arItem['DATE_ACTIVE_TO']), 'd.m.Y') > date('d.m.Y')){
                echo GetMessage('DEADLINE') . getNumEnding($format_day, array(GetMessage('DAY_1'), GetMessage('DAY_2'), GetMessage('DAY_3')));
            }
        ?>
        </span><br><br>
		<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="newsName"><?= $arItem['NAME'] ?></a>
		<p class="newsText">
			<?= $arItem['PREVIEW_TEXT'] ?>
		</p>
		<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="detailNews"><?= GetMessage('MORE') ?></a>
	</li>
<?endforeach;?>
	</ul>
</div>