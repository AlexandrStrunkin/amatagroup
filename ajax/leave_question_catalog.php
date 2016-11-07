<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule("iblock");
// Обработка входящих параметров
$name = utf8win1251($_POST["name"]);
$product_id = intval($_POST["product_id"]);
$email = $_POST["email"];
$phone = $_POST["phone"];
$company = utf8win1251($_POST["company"]);
$text = utf8win1251($_POST["text"]);
$href = $_POST["product_href"];
$form_type = $_POST["form_type"];

$el = new CIBlockElement;

$properties = array(
    'PRODUCT_ID' => $product_id,
    'F_EMAIL'    => $email,
    'PHONE'      => $phone,
    'COMPANY'    => $company,
    'TEXT'       => $text
);

$element_fields = Array(
    "MODIFIED_BY"       => $USER->GetID(),
    "IBLOCK_SECTION_ID" => false,
    "IBLOCK_ID"         => IBLOCK_ID_QUASTION_PRODUCT,
    "PROPERTY_VALUES"   => $properties,
    "NAME"              => $company . ' ' . $name,
    "ACTIVE"            => "Y"
);

$element_id = $el->Add($element_fields);

$ar_product = CIBlockElement::GetByID($product_id);
if ($ar_res = $ar_product->GetNext()) {
    $product_name = $ar_res["~NAME"];
}

if ($element_id > 0) {
	$mails = array(
	    FORM_FROM_EMAIL,
	    $email
	);
	$form_types = getFormTypes();
    $template_fields = array(
        "NAME"         => $name,
        "PRODUCT_NAME" => $product_name,
        "PHONE"        => $phone,
        "COMPANY"      => $company,
        "TEXT"         => $text,
        "PRODUCT_HREF" => $href
	);
	foreach ($mails as $mail) {
        $template_fields['FORM_TYPE'] = $mail == FORM_FROM_EMAIL ? "(" . $form_types[$form_type] . ")" : "";
        $template_fields['EMAIL'] = $mail;
        CEvent::Send("FORM_QUASTION", SITE_ID, $template_fields, 'N', CARD_QUESTION_FORM_TEMPLATE_ID);
        CEvent::Send("FORM_QUASTION", SITE_ID, $template_fields, 'N', CARD_QUESTION_FORM_TEMPLATE_ID_EMAIL);
	}
}
?>
<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>