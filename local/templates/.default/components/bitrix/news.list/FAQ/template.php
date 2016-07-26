<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="qaWrapper">
	<p class="blockTitle"><?= GetMessage('FAQ_TITLE') ?><span><?= count($arResult["ITEMS"]) ?></span></p>
	<? foreach ($arResult["ITEMS"] as $arItem) { ?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="qaBlock" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
	    <p class="questionText"><?= $arItem['PREVIEW_TEXT'] ?></p>
	
	    <p class="answerText"><span class="triangle">&#9650;</span>
	       <?= $arItem['DETAIL_TEXT'] ?>
		</p>
	</div>
	<? } ?>
</div>