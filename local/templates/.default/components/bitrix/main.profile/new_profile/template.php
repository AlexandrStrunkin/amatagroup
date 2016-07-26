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
            <?
            CModule::IncludeModule("subscribe");
            $aSubscr = CSubscription::GetUserSubscription();

            // Вывод рубрик можно производить таким способом
            $arOrder = Array("SORT"=>"ASC", "NAME"=>"ASC");
            $arFilter = Array("ACTIVE"=>"Y", "LID"=>LANG);
            $rsRubric = CRubric::GetList($arOrder, $arFilter);
            $arRubrics = array();
            while($arRubric = $rsRubric->GetNext()) {  ?>
                <input id="RUB_<?=$arRubric["ID"]?>" type="checkbox" class="subscriptionNews" name="RUB_ID[]" checked="" value="<?= $arRubric["ID"]?>">
            <?}?>
            <label for="subscriptionNews?>">Хочу получать новости и акции компании</label>

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



