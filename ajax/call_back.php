<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<?
$APPLICATION->IncludeComponent(
    "bitrix:main.feedback",
    "back_call",
    array(
        "EMAIL_TO" => FORM_FROM_EMAIL,
        "EVENT_MESSAGE_ID" => array(
            0 => "74",
        ),
        "OK_TEXT" => "��� ������ ���������. ���� ������������ �������� � ���� �� ���������� ������",
        "REQUIRED_FIELDS" => array(
            0 => "NAME",
        ),
        "USE_CAPTCHA" => "N",
        "COMPONENT_TEMPLATE" => "back_call"
    ),
    false
);
?>