<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?        
$name = utf8win1251($_POST["name"]);
$email = $_POST["email"];
$phone = $_POST["phone"];
$text = utf8win1251($_POST["text"]);
$file = $_POST["file"];

$element_object = new CIBlockElement;

$iblock_fields = Array(
    "MODIFIED_BY"       => $USER->GetID(),
    "IBLOCK_SECTION_ID" => false,
    "IBLOCK_ID"         => 36,
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
    CEvent::Send("FORM_WORK_WITH_US", SITE_ID, $mail_fields, 'N', SEND_QUESTION_FORM_TEMPLATE_ID);
}
?>