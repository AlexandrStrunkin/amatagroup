<?
CModule::IncludeModule("subscribe");
$aSubscr = CSubscription::GetUserSubscription();

$str_CONFIRMED = $_POST('str_CONFIRMED');

$subscr = new CSubscription;
//confirmation code from letter or confirmation form
if($RUB_ID <> "" && $aSubscr["ID"] > 0) {
    if($str_CONFIRMED <> "Y") {
        //subscribtion confirmation
        if($subscr->Update($aSubscr["ID"], array("CONFIRM_CODE"=>$str_CONFIRMED))){
            $str_CONFIRMED = "Y";
        }
    } else {
        if($subscr->Update($aSubscr["ID"], array("CONFIRM_CODE"=>$str_CONFIRMED))){
            $str_CONFIRMED = "N";
        }
    }
    arshow($subscr);
} else {
    $arFields = Array(
        "USER_ID" => ($USER -> IsAuthorized()? $USER -> GetID():false),
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