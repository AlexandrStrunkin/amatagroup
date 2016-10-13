<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>
<?
if (!$USER->IsAuthorized()) {
    $APPLICATION->IncludeComponent(
	"webgk:register_amata",
	".default",
	array(
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
		),
		"SET_TITLE" => "Y",
		"SHOW_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "PERSONAL_PHONE",
		),
		"SUCCESS_PAGE" => "confirm.php",
		"USER_PROPERTY" => array(
			0 => "UF_DOCUMENT_1",
			1 => "UF_DOCUMENT_2",
			2 => "UF_DOCUMENT_3",
			3 => "UF_DOCUMENT_4",
			4 => "UF_DOCUMENT_5",
			5 => "UF_DOCUMENT_6",
			6 => "UF_DOCUMENT_7",
			7 => "UF_DOCUMENT_9",
			8 => "UF_DOCUMENT_8",
			9 => "UF_DOCUMENT_10",
			10 => "UF_DOCUMENT_11",
            11 => "UF_FACE",
		),
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "N",
		"COMPONENT_TEMPLATE" => "new_registration"
	),
	false
);
} else {?>
    <p>Вы зарегистрированы и успешно авторизовались.</p>

    <p><a href="<?=SITE_DIR?>">Вернуться на главную страницу</a></p>
<?}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>