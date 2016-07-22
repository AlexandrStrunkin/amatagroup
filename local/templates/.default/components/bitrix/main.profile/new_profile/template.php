<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
?>
<?=ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	echo ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<div class="settingsBlock bx_<?=$arResult["THEME"]?>" style="display: block">
	<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data">
        <div class="firstBlock">
            <div>
                <div class="inputBlock">
                    <p><?=GetMessage('NAME')?></p>
                    <input type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" />
                </div>
                <div class="inputBlock shortInp">
                    <p><?=GetMessage('LAST_NAME')?></p>
                    <input type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
                </div>
                <div class="inputBlock shortInp">
                    <p><?=GetMessage('SECOND_NAME')?></p>
                    <input type="text" name="SECOND_NAME" maxlength="50"  value="<?=$arResult["arUser"]["SECOND_NAME"]?>" />
                </div>
            </div>
		    <div>
                <div class="inputBlock">
                    <p><?=GetMessage('NEW_PASSWORD_REQ')?></p>
                    <input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" />
                </div>
                <div class="inputBlock">
                    <p><?=GetMessage('NEW_PASSWORD_CONFIRM')?></p>
                    <input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" />
                </div>
            </div>
            <?arshow($arResult["arUser"])?>
            <?=$arResult["BX_SESSION_CHECK"]?>
            <input type="hidden" name="lang" value="<?=LANG?>" />
            <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
            <input type="hidden" name="LOGIN" value=<?=$arResult["arUser"]["LOGIN"]?> />
            <input type="hidden" name="EMAIL" value=<?=$arResult["arUser"]["EMAIL"]?> />

		    <?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
			    <h2><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></h2>
			    <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
				    <strong><?=$arUserField["EDIT_FORM_LABEL"]?><?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;?></strong><br/>
				    <?$APPLICATION->IncludeComponent(
					    "bitrix:system.field.edit",
					    $arUserField["USER_TYPE"]["USER_TYPE_ID"],
					    array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y")
				    );?>
				    <br/>
			    <?endforeach;?>
		    <?endif;?>

		    <input name="save" value="<?=GetMessage("MAIN_SAVE")?>" class="bx_bt_button bx_big shadow" type="submit">
        </div>
        <div class="secondBlack">
        <?$APPLICATION->IncludeComponent("bitrix:subscribe.simple","",Array(
                "AJAX_MODE" => "N",
                "SHOW_HIDDEN" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "SET_TITLE" => "Y",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N"
                ),
                false
            );?>
            <?$APPLICATION->IncludeComponent("bitrix:subscribe.form","",Array(
        "USE_PERSONALIZATION" => "Y",
        "PAGE" => "#SITE_DIR#personal/subscribe/subscr_edit.php",
        "SHOW_HIDDEN" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600"
    )
);?>
            <div class="inputBlock emailInp">
                <p>Почта</p>
                <input type="text" name="email">
            </div>
            <div class="inputBlock subscribeInp">
                <input id="subscriptionNews" type="checkbox" hidden="" checked="">
                <label class="subscriptionText" for="subscriptionNews">
                    Хочу получать новости и акции компании
                </label>
            </div>
        </div>
    </form>
</div>
<br>

