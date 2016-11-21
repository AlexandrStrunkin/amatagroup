<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?

    $name = utf8win1251($_POST["name"]);
    $generator = utf8win1251($_POST["generator"]);
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $company = utf8win1251($_POST["company"]);
    $text = utf8win1251($_POST["text"]);

?>
<?
$el = new CIBlockElement;

$PROP = array();
$PROP['F_GENERATOR'] = $generator;
$PROP['F_EMAIL'] = $email;
$PROP['PHONE'] = $phone;
$PROP['COMPANY'] = $company;
$PROP['TEXT'] = $text;


$arLoadProductArray = Array(
    "MODIFIED_BY"    => $USER->GetID(),
    "IBLOCK_SECTION_ID" => false,
    "IBLOCK_ID"      => IBLOCK_ID_QUASTION,
    "PROPERTY_VALUES"=> $PROP,
    "NAME"           => $company.' '.$name,
    "ACTIVE"         => "Y",
    "PREVIEW_TEXT"   => "",
    "DETAIL_TEXT"    => "",
);

$element_id = $el->Add($arLoadProductArray);

if($element_id > 0){
    $arSend = array("NAME" => $name, "GENERATOR" => $generator, "EMAIL" => $email, "PHONE" => $phone, "COMPANY" => $company, "TEXT" => $text);
    CEvent::Send("FORM_QUASTION", SITE_ID, $arSend, 'N', SEND_QUESTION_FORM_TEMPLATE_ID);
}
?>