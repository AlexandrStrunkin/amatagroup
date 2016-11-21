<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?

$name = utf8win1251($_POST["name"]);
$generator = utf8win1251($_POST["generator"]);
$email = $_POST["email"];
$phone = $_POST["phone"];
$company = utf8win1251($_POST["company"]);
$text = utf8win1251($_POST["text"]);

$element_object = new CIBlockElement;

$iblock_properties = array(
	'F_GENERATOR' => $generator,
	'F_EMAIL'     => $email,
	'PHONE'       => $phone,
	'COMPANY'     => $company,
	'TEXT'        => $text
);

$iblock_fields = Array(
    "MODIFIED_BY"       => $USER->GetID(),
    "IBLOCK_SECTION_ID" => false,
    "IBLOCK_ID"         => IBLOCK_ID_QUASTION,
    "PROPERTY_VALUES"   => $iblock_properties,
    "NAME"              => $company . ' ' . $name,
    "ACTIVE"            => "Y",
);

$element_id = $element_object->Add($iblock_fields);

if ($element_id > 0) {
    $mail_fields = array(
    	"NAME"      => $name,
    	"GENERATOR" => $generator,
    	"EMAIL"     => $email,
    	"PHONE"     => $phone,
    	"COMPANY"   => $company,
    	"TEXT"      => $text
	);
    CEvent::Send("FORM_QUASTION", SITE_ID, $mail_fields, 'N', SEND_QUESTION_FORM_TEMPLATE_ID);
}
?>