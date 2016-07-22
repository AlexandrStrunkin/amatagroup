
<?$APPLICATION->IncludeComponent(
	"bitrix:main.profile", 
	"new_profile", 
	array(
		"SET_TITLE" => "Y",
		"COMPONENT_TEMPLATE" => "new_profile",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"USER_PROPERTY" => array(
		),
		"SEND_INFO" => "N",
		"CHECK_RIGHTS" => "N",
		"USER_PROPERTY_NAME" => ""
	),
	false
);?>