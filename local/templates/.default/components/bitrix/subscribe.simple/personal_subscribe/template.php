<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>

<?if(count($arResult["ERRORS"]) > 0):?>
	<?foreach($arResult["ERRORS"] as $strError):?>
		<p class="errortext"><?echo $strError?></p>
	<?endforeach?>
	<?$this->setFrameMode(false);?>
<?elseif(count($arResult["RUBRICS"]) <= 0):?>
	<p class="errortext"><?echo GetMessage("CT_BSS_NO_RUBRICS_FOUND")?></p>
	<?$this->setFrameMode(false);?>
<?else:?>
	<?$frame=$this->createFrame()->begin();?>
	<?if($arResult["MESSAGE"]):?>
		<p class="notetext"><?echo $arResult["MESSAGE"]?></p>
	<?endif?>
	<form method="POST" action="<?echo $arResult["FORM_ACTION"]?>">
		    <?foreach($arResult["RUBRICS"] as $arRubric):?>
			    <input id="subscriptionNews" checked="" name="RUB_ID[]" value="<?echo $arRubric["ID"]?>"  type="checkbox">
		    <?endforeach?>
        <label for="subscriptionNews">Хочу получать новости и акции компании</label>
		<?echo bitrix_sessid_post();?>
		<input type="submit" name="Update" value="<?echo GetMessage("CT_BSS_FORM_BUTTON")?>">
	</form>
	<?$frame->beginStub();?>
	<form method="POST" action="<?echo $arResult["FORM_ACTION"]?>">

		<?foreach($arResult["RUBRICS"] as $arRubric):?>
            <input id="subscriptionNews" hidden="" checked="" name="RUB_ID[]" value="<?echo $arRubric["ID"]?>" id="RUB_<?echo $arRubric["ID"]?>" type="checkbox" <?if($arRubric["CHECKED"]) echo "checked";?>>
            <label for="RUB_<?echo $arRubric["ID"]?>"><?echo $arRubric["NAME"]?></label>
		<?endforeach?>
		<input type="submit" name="Update" value="<?echo GetMessage("CT_BSS_FORM_BUTTON")?>">

	</form>
	<?$frame->end();?>
<?endif?>
