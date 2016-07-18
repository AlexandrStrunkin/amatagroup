<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="infoBlocksMenu">
	<? foreach ($arResult['REGROUPED_ITEMS'] as $section_id => $section_items) { ?>
		<a href="#news_<?= $section_id ?>" <? if ($section_items === reset($arResult['REGROUPED_ITEMS'])) { ?>class="activeInfoBlock"<? } ?>><?= $section_items['TITLE'] ?></a>
	<? } ?>
</div>

<? foreach ($arResult['REGROUPED_ITEMS'] as $section_id => $section_items) { ?>
<div class="infoBlocksContent" id="news_<?= $section_id ?>" <? if ($section_items === reset($arResult['REGROUPED_ITEMS'])) { ?>style="display: block"<? } ?>>
    <ul class="infoNewsList">
    <? foreach ($section_items['ELEMENTS'] as $item) { ?>
    <?
	$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_ELEMENT_DELETE_CONFIRM')));
    ?>
        <li id="<?=$this->GetEditAreaId($item['ID']);?>">
            <div class="imageWrapper"><img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $item['NAME'] ?>"/></div>
            <p class="dateText"><?= date_format(date_create_from_format('d.m.Y H:i:s', $item['DATE_CREATE']), 'd.m.Y') ?></p>
            <a href="" class="newsName"><?= $item['NAME'] ?></a>
            <p class="newsText">
            	<?= $item['PREVIEW_TEXT'] ?>
            </p>
            <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="detailNews"><?= GetMessage('DETAIL_NEWS') ?></a>
        </li>
	<? } ?>
    </ul>
</div>
<? } ?>

