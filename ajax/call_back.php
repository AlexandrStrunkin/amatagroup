<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<?
$_POST["user_tell"] = iconv("UTF-8", "CP1251", $_POST["user_tell"]);
$_POST["user_name"] = iconv("UTF-8", "CP1251", $_POST["user_name"]);
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