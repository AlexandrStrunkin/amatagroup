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
		<p class="dateText"><?= date_format(date_create_from_format('d.m.Y H:i:s', $arItem['DATE_CREATE']), 'd.m.Y') ?></p>
		<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="newsName"><?= $arItem['NAME'] ?></a>
		<p class="newsText">
			<?= $arItem['PREVIEW_TEXT'] ?>
		</p>
		<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="detailNews"><?= GetMessage('MORE') ?></a> 
	</li>
<?endforeach;?>
	</ul>
</div>