<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("�������");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	"basket", 
	array(
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "Y",
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "DISCOUNT",
			2 => "PROPS",
			3 => "DELETE",
			4 => "DELAY",
			5 => "PRICE",
			6 => "QUANTITY",
			7 => "SUM",
		),
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"PATH_TO_ORDER" => "/personal/order/make/",
		"HIDE_COUPON" => "N",
		"QUANTITY_FLOAT" => "N",
		"PRICE_VAT_SHOW_VALUE" => "Y",
		"SET_TITLE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"OFFERS_PROPS" => array(
			0 => "TSVET",
			1 => "RAZMER",
		),
		"COMPONENT_TEMPLATE" => "basket",
		"USE_PREPAYMENT" => "N",
		"ACTION_VARIABLE" => "action",
		"CORRECT_RATIO" => "N",
		"AUTO_CALCULATION" => "Y",
		"USE_GIFTS" => "Y",
		"GIFTS_PLACE" => "BOTTOM",
		"GIFTS_BLOCK_TITLE" => "�������� ���� �� ��������",
		"GIFTS_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_TEXT_LABEL_GIFT" => "�������",
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "undefined",
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
		"GIFTS_SHOW_OLD_PRICE" => "N",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_MESS_BTN_BUY" => "�������",
		"GIFTS_MESS_BTN_DETAIL" => "���������",
		"GIFTS_PAGE_ELEMENT_COUNT" => "10",
		"GIFTS_CONVERT_CURRENCY" => "N",
		"GIFTS_HIDE_NOT_AVAILABLE" => "Y"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>