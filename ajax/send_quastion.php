<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
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
  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
  "IBLOCK_ID"      => IBLOCK_ID_QUASTION,
  "PROPERTY_VALUES"=> $PROP,
  "NAME"           => $company.' '.$name,
  "ACTIVE"         => "Y",            // активен
  "PREVIEW_TEXT"   => "",
  "DETAIL_TEXT"    => "",
  );

$PRODUCT_ID = $el->Add($arLoadProductArray);

if($PRODUCT_ID > 0){
    $arSend = array("NAME" => $name, "GENERATOR" => $generator, "EMAIL" => $email, "PHONE" => $phone, "COMPANY" => $company, "TEXT" => $text);
    CEvent::Send("FEEDBACK_FORM", SITE_ID, $arSend, 'N', 76);
}
?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>