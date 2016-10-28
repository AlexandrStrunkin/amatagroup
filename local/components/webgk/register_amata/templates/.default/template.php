<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>


<form method="post" action="<?=POST_FORM_ACTION_URI?>" id="form_register" name="regform" enctype="multipart/form-data">

    <?
    if($arResult["BACKURL"] <> ''):
    ?>
	    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    <?
    endif;
    ?>
    <?if($USER->IsAuthorized()):?>

    <?else:?>
    <div class="wrap_form_1">
        <p class="authTitle"><?= GetMessage("AUTH_REGISTER")?></p>
    <?

    if (count($arResult["ERRORS"]) > 0):
        foreach ($arResult["ERRORS"] as $key => $error)
            if (intval($key) == 0 && $key !== 0)
                $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

        ShowError(implode("<br />", $arResult["ERRORS"]));

    elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
    ?>
    <p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
    <?endif?>
    <?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
	    <?if($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true):?>
				    <select name="REGISTER[AUTO_TIME_ZONE]" onchange="this.form.elements['REGISTER[TIME_ZONE]'].disabled=(this.value != 'N')">
					    <option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
					    <option value="Y"<?=$arResult["VALUES"][$FIELD] == "Y" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
					    <option value="N"<?=$arResult["VALUES"][$FIELD] == "N" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
				    </select>
				    <select name="REGISTER[TIME_ZONE]"<?if(!isset($_REQUEST["REGISTER"]["TIME_ZONE"])) echo 'disabled="disabled"'?>>
		    <?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
					    <option value="<?=htmlspecialcharsbx($tz)?>"<?=$arResult["VALUES"]["TIME_ZONE"] == $tz ? " selected=\"selected\"" : ""?>><?=htmlspecialcharsbx($tz_name)?></option>
		    <?endforeach?>
				    </select>
	    <?else:?>
	    <?
	    switch ($FIELD)
	    {
		case "PERSONAL_GENDER":
			?><select name="REGISTER[<?=$FIELD?>]">
				<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
				<option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
				<option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
			</select><?
			break;

		case "PERSONAL_COUNTRY":
		case "WORK_COUNTRY":
			?><select name="REGISTER[<?=$FIELD?>]"><?
			foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value)
			{
				?><option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
			<?
			}
			?></select><?
			break;

		case "PERSONAL_PHOTO":
		case "WORK_LOGO":
			?><input size="30" type="file" name="REGISTER_FILES_<?=$FIELD?>" /><?
			break;

        case "LOGIN":
            ?><input size="30" class="authInput"
                     type="hidden"
                     name="REGISTER[<?=$FIELD?>]"
                     id="reg_input_<?=$FIELD?>"
                     value="text"
                     <?= $arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y" ? "required" : "" ?> /><?
        break;
        case "PERSONAL_NOTES":
		case "WORK_NOTES":
			?><textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]"><?=$arResult["VALUES"][$FIELD]?></textarea><?
			break;
        case "PASSWORD":
        ?><input size="30" title="<?= GetMessage("MIN_PASSWORD_LENGHT")?>" pattern=".{6,}" <?= $arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y" ? "required" : "" ?> placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?>" type="password" id="reg_input_<?=$FIELD?>" class="authInputPass rfield new" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="bx-auth-input" />
            <?if($arResult["SECURE_AUTH"]):?>
                            <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                                <div class="bx-auth-secure-icon"></div>
                            </span>
                            <noscript>
                            <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                                <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                            </span>
                            </noscript>
            <script type="text/javascript">
            document.getElementById('bx_auth_secure').style.display = 'inline-block';
            </script>
            <?endif?>
        <?
            break;
        case "CONFIRM_PASSWORD":
            ?><input size="30" title="<?= GetMessage("MIN_PASSWORD_LENGHT")?>" pattern=".{6,}" <?= $arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y" ? "required" : "" ?> placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?>" type="password" id="reg_input_<?=$FIELD?>" class="authInputConfirmPass rfield confirmation" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" /><?
            break;

		default:

			if ($FIELD == "PERSONAL_BIRTHDAY"):?><small><?=$arResult["DATE_FORMAT"]?></small><br /><?endif;
			?><input size="30" class="authInput <?=($FIELD != "PERSONAL_PHONE")? 'rfield':''?>" placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?>"
					 type="<?=($FIELD == "PERSONAL_PHONE")? 'tel' : 'text'?>"
					 name="REGISTER[<?=$FIELD?>]"
                     class="<?=($FIELD == "PERSONAL_PHONE")? 'overflowMask' : ''?>"
                     id="reg_input_<?=$FIELD?>"
					 value="<?=$arResult["VALUES"][$FIELD]?>"
					 <?= $arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y" ? "required" : "" ?> />
			  <?
				if ($FIELD == "PERSONAL_BIRTHDAY")
					$APPLICATION->IncludeComponent(
						'bitrix:main.calendar',
						'',
						array(
							'SHOW_INPUT' => 'N',
							'FORM_NAME' => 'regform',
							'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
							'SHOW_TIME' => 'N'
						),
						null,
						array("HIDE_ICONS"=>"Y")
					);
				?><?
	        }?>
	    <?endif?>
    <?endforeach?>
    <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField){?>
         <?if($arUserField['FIELD_NAME'] == 'UF_FACE'){?>
            <span class="userFieldNameReg"><?=$arUserField["EDIT_FORM_LABEL"]?>:<?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;?></span>
            <?$APPLICATION->IncludeComponent(
                "bitrix:system.field.edit",
                $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y")
            );?>
         <?}?>

    <?}?>
<?
/* CAPTCHA */
if ($arResult["USE_CAPTCHA"] == "Y")
{
	?>
		<tr>
			<td colspan="2"><b><?=GetMessage("REGISTER_CAPTCHA_TITLE")?></b></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
			</td>
		</tr>
		<tr>
			<td><?=GetMessage("REGISTER_CAPTCHA_PROMT")?>:<span class="starrequired">*</span></td>
			<td><input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
	<?
}
/* !CAPTCHA */
?>

<div class="btn-container">
    <a href="javascript:void(0)" class="authNext" ><?=GetMessage("NEXT")?></a>
</div>

</div>

<div class="wrap_form_2">
<p class="authTitle"><?= GetMessage("AUTH_REGISTER_2")?></p>

<?// ********************* User properties ***************************************************?>
<b class="text_submit_2"> <?=GetMessage("USER_EDIT_TAB")?><br> </b>
<div class="additional_fields">
    <?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
        <?$count_face = 0;?>
        <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
        <?if($arUserField['FIELD_NAME'] != 'UF_FACE'){?>
        <?$count_face += 1;?>
        <div class="<?= ($count_face < 7)? 'face_1': 'face_2' ?>">
            <span class="userFieldName"><?=$arUserField["EDIT_FORM_LABEL"]?>:<?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;?></span>
            <label>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:system.field.edit",
                    $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                    array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y")
                );?>
            </label>
            <input type="button" value="x" title="удалить" class="reset">
        </div>
        <?}?>
        <?endforeach;?>
    <?endif;?>
</div>
<?// ******************** /User properties ***************************************************?>


<div class="btn-container">
    <a href="javascript:void(0)" class="btn_prew" ><?=GetMessage("PREW")?></a>
    <a href="javascript:void(0)" class="authSubmit" ><?=GetMessage("AUTH_REGISTER_SUBMIT")?></a>
	<input type="submit" style="display: none;"  name="register_submit_button" />
</div>

</div>

</form>
<?endif?>