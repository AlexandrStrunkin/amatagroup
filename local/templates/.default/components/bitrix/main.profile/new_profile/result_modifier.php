<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult["THEME"] = COption::GetOptionString("main", "wizard_eshop_adapt_theme_id", "blue", SITE_ID);
global $aSubscr;
CModule::IncludeModule("subscribe");
$aSubscr = CSubscription::GetUserSubscription();
 $subscr = new CSubscription;
// ¬ывод рубрик можно производить таким способом
$arOrder = Array("SORT"=>"ASC", "NAME"=>"ASC");
$arFilter = Array("ACTIVE"=>"Y", "LID"=>LANG);
$rsRubric = CRubric::GetList($arOrder, $arFilter);
$arRubrics = array();
while($arRubric = $rsRubric->GetNext()) {
     $RUB_ID[] = $arRubric["ID"];
}
if($aSubscr["ID"] > 0) {
    if($_POST["RUB_ID"] == "") {
        //subscribtion confirmation
        $subscr->Update($aSubscr["ID"], array("ACTIVE" => 'N'));
    } else {
        $subscr->Update($aSubscr["ID"], array("ACTIVE" => 'Y'));
    }

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
    if($_POST["RUB_ID"] != "") {
        $ID = $subscr -> Add($arFields);
        if($ID > 0) {
            CSubscription::Authorize($ID);
        }
    }
}
?>

