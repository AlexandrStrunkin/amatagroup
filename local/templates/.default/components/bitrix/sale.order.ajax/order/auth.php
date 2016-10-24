<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script>
<!--
function ChangeGenerate(val)
{
	if(val)
	{
		document.getElementById("sof_choose_login").style.display='none';
	}
	else
	{
		document.getElementById("sof_choose_login").style.display='block';
		document.getElementById("NEW_GENERATE_N").checked = true;
	}

	try{document.order_reg_form.NEW_LOGIN.focus();}catch(e){}
}
//-->
</script>
<div class="bx-authform">


			<?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
                <h2><?echo GetMessage("AUTH_TITLE")?></h2>
			<?endif;?>

			<form method="post" action="" name="order_auth_form">
				<?=bitrix_sessid_post()?>
				<?
				foreach ($arResult["POST"] as $key => $value)
				{
				?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
				<?
				}
		        ?>
				<div class="bx-authform-formgroup-container">
                    <div class="bx-authform-label-container"><?=GetMessage("STOF_LOGIN")?><span class="starrequired">*</span></div>
					<input type="text" name="USER_LOGIN" maxlength="30" size="30" value="<?=$arResult["AUTH"]["USER_LOGIN"]?>">
                </div>
				<div class="bx-authform-formgroup-container">
                    <div class="bx-authform-label-container"><?echo GetMessage("STOF_PASSWORD")?><span class="starrequired">*</span></div>
					<input type="password" name="USER_PASSWORD" maxlength="30" size="30">
                </div>
                <div class="bx-authform-link-container_auth">
				    <a href="<?=$arParams["PATH_TO_AUTH"]?>?forgot_password=yes&back_url=<?= urlencode($APPLICATION->GetCurPageParam()); ?>"><?echo GetMessage("STOF_FORGET_PASSWORD")?></a>
					<input type="submit" value="<?echo GetMessage("STOF_NEXT_STEP")?>">
					<input type="hidden" name="do_authorize" value="Y">
                </div>
			</form>
            <div class="bx-authform-link-container">
                <p><?=GetMessage("AUTH_AUTHORIZE")?></p><br>
                <a href="/auth/registration/" rel="nofollow"><b><?= GetMessage('AUTH_REGISTER')?></b></a>
            </div>
</div>
<br /><br />
<div style="clear:both"></div>
<?echo GetMessage("STOF_PRIVATE_NOTES")?>
