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
<div class="files_in_prices">
<? foreach ($arResult["ITEMS"] as $arItem) { ?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="reviesElement" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="productWrapper">
			<?
				$file = CFile::GetFileArray($arItem["PROPERTIES"]["FILE"]["VALUE"]);
				$file_name = $file["FILE_NAME"];
				$file_array = explode(".", $file_name);
				$file_extension = strtolower(array_pop($file_array));
			?>
			<a href="<?= $file['SRC'] ?>" class="productimg"><img src="/img/files/<?= $file_extension ?>.png" alt=""></a>
			<a href="<?= $file['SRC'] ?>" class="infoDocDownload" download></a>
			<p class="infoDocName"><?= $arItem['NAME'] ?></p>
		</div>
	</div>
<? } ?>
</div>
