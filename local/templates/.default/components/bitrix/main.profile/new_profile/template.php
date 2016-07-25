<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
?>
<?=ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
    echo ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<div class="settingsBlock bx_<?=$arResult["THEME"]?>" style="display: block">
    <form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data">
        <?=$arResult["BX_SESSION_CHECK"]?>
        <input type="hidden" name="lang" value="<?=LANG?>" />
        <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
        <input type="hidden" name="LOGIN" value=<?=$arResult["arUser"]["LOGIN"]?> />
        <input type="hidden" name="EMAIL" value=<?=$arResult["arUser"]["EMAIL"]?> />

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

        </div>
        <div class="secondBlack">

            <div class="inputBlock emailInp">
                <p><?=GetMessage('EMAIL')?></p>
                <input type="email" name="EMAIL" maxlength="50" value="<?=$arResult["arUser"]["EMAIL"]?>" />
            </div>
            <div class="inputBlock subscribeInp">
                <?$APPLICATION->IncludeComponent("bitrix:subscribe.simple", "personal_subscribe", Array(
                    "AJAX_MODE" => "N",    // Включить режим AJAX
                    "SHOW_HIDDEN" => "Y",    // Показать скрытые рубрики подписки
                    "CACHE_TYPE" => "A",    // Тип кеширования
                    "CACHE_TIME" => "3600",    // Время кеширования (сек.)
                    "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
                    "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
                    "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
                    "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
                    ),
                false
                );?>
            </div>
        </div>



        <div class="thirdBlack">
            <div class="inputBlock">
                <input type="reset" value="Отменить" class="cancelInp">
                <input name="save" value="<?=GetMessage("MAIN_SAVE")?>" class="saveInp" type="submit">
            </div>
        </div>
    </form>
</div>



