<?
CModule::IncludeModule("subscribe");


$subscr = new CSubscription;
//confirmation code from letter or confirmation form
if($CONFIRM_CODE <> "" && $aSubscr["ID"] > 0 && empty($action))
{
    if($str_CONFIRMED <> "Y")
    {
        //subscribtion confirmation
        if($subscr->Update($aSubscr["ID"], array("CONFIRM_CODE"=>$CONFIRM_CODE))){
            $str_CONFIRMED = "Y";
        }
        $strWarning .= $subscr->LAST_ERROR;
        $iMsg = $subscr->LAST_MESSAGE;
    }
} else {
    $arFields = Array(
        "USER_ID" => ($USER->IsAuthorized()? $USER->GetID():false),
        "FORMAT" => ($FORMAT <> "html"? "text":"html"),
        "EMAIL" => $arResult["arUser"]["EMAIL"],
        "ACTIVE" => "Y",
        "RUB_ID" => $RUB_ID
    );
    $subscr = new CSubscription;

    //can add without authorization
    $ID = $subscr -> Add($arFields);
    if($ID > 0) {
        CSubscription::Authorize($ID);
    }
} ?>