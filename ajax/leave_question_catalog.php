<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
CModule::IncludeModule("iblock");

    $name = utf8win1251($_POST["name"]);
    $product_id = $_POST["product_id"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $company = utf8win1251($_POST["company"]);
    $text = utf8win1251($_POST["text"]);

?>
<?
$el = new CIBlockElement;

$PROP = array();
$PROP[461] = $product_id;
$PROP[462] = $email;
$PROP[463] = $phone;
$PROP[464] = $company;
$PROP[465] = $text;


$arLoadProductArray = Array(
  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
  "IBLOCK_ID"      => 19,
  "PROPERTY_VALUES"=> $PROP,
  "NAME"           => $company.' '.$name,
  "ACTIVE"         => "Y",            // активен
  "PREVIEW_TEXT"   => "",
  "DETAIL_TEXT"    => "",
  );

$PRODUCT_ID = $el->Add($arLoadProductArray);

$ar_product = CIBlockElement::GetByID($product_id);
if($ar_res = $ar_product->GetNext()){
  $product_name = $ar_res["~NAME"];
}

$arSend = array("NAME" => $name, "PRODUCT_NAME" => $product_name, "EMAIL" => $email, "PHONE" => $phone, "COMPANY" => $company, "TEXT" => $text);
CEvent::Send("FEEDBACK_FORM", SITE_ID, $arSend, 'N', 77);
?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>