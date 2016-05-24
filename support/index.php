<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Техническая поддержка");
?><?$APPLICATION->IncludeComponent(
	"bitrix:support.wizard", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "services",
		"IBLOCK_ID" => "4",
		"PROPERTY_FIELD_TYPE" => "",
		"PROPERTY_FIELD_VALUES" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"TICKETS_PER_PAGE" => "50",
		"MESSAGES_PER_PAGE" => "20",
		"MESSAGE_MAX_LENGTH" => "70",
		"MESSAGE_SORT_ORDER" => "asc",
		"SET_PAGE_TITLE" => "Y",
		"TEMPLATE_TYPE" => "standard",
		"SHOW_RESULT" => "Y",
		"SHOW_COUPON_FIELD" => "N",
		"SET_SHOW_USER_FIELD" => array(
		),
		"SECTIONS_TO_CATEGORIES" => "N",
		"VARIABLE_ALIASES" => array(
			"ID" => "ID",
		)
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>