<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?$APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket.small", 
    "small_basket", 
    array(
        "COMPONENT_TEMPLATE" => "small_basket",
        "PATH_TO_BASKET" => "/personal/cart/",
        "PATH_TO_ORDER" => "/personal/order/make/",
        "SHOW_DELAY" => "Y",
        "SHOW_NOTAVAIL" => "Y",
        "SHOW_SUBSCRIBE" => "Y"
    ),
    false
    );?>