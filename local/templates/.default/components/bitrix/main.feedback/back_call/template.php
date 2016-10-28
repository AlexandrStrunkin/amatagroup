<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="popup bx_mfeedback bx_<?=$arResult["THEME"]?>" id="callBackPopup">
	<?if(!empty($arResult["ERROR_MESSAGE"]))
	{
		foreach($arResult["ERROR_MESSAGE"] as $v)
			ShowError($v);
	}
	if(strlen($arResult["OK_MESSAGE"]) > 0)
	{
		?><div class="message"><?=$arResult["OK_MESSAGE"]?></div><?
	}
	?>

    <p class="close"></p>
	<form action="<?=POST_FORM_ACTION_URI?>" method="POST" id="form_index">
		<?=bitrix_sessid_post()?>
        <p class="title"><?=GetMessage("MFT_CALL")?></p>

		<input type="text"  placeholder="<?=GetMessage('MFT_NAME')?>" class="input" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>"/ required>

        <input type="phone" placeholder="<?=GetMessage('MFT_PHONE')?>" class="input" name="user_tell" value="<?=$arResult["AUTHOR_TELL"]?>"/ required>

		<?if($arParams["USE_CAPTCHA"] == "Y"):?>
			<strong><?=GetMessage("MFT_CAPTCHA")?></strong><br/>
			<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA"><br/>
			<strong><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></strong><br/>
			<input type="text" name="captcha_word" size="30" maxlength="50" value=""/>
		<?endif;?>

		<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
		<input type="submit" class="btn_submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>" >
	</form>
</div>