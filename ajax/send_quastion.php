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
$PROP[455] = $name;
$PROP[456] = $generator;
$PROP[457] = $email;
$PROP[458] = $phone;
$PROP[459] = $company;
$PROP[460] = $text;


$arLoadProductArray = Array(
  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
  "IBLOCK_ID"      => 18,
  "PROPERTY_VALUES"=> $PROP,
  "NAME"           => $company.' '.$name,
  "ACTIVE"         => "Y",            // активен
  "PREVIEW_TEXT"   => "",
  "DETAIL_TEXT"    => "",
  );

$PRODUCT_ID = $el->Add($arLoadProductArray);

$arSend = array("NAME" => $name, "GENERATOR" => $generator, "EMAIL" => $email, "PHONE" => $phone, "COMPANY" => $company, "TEXT" => $text);
CEvent::Send("FEEDBACK_FORM", SITE_ID, $arSend, 'N', 76);
?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>