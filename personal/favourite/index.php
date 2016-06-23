<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?><?$APPLICATION->IncludeComponent(
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
        ),
        "COMPONENT_TEMPLATE" => "basket",
        "USE_PREPAYMENT" => "N",
        "ACTION_VARIABLE" => "action"
    ),
    false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>