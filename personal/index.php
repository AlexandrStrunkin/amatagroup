<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("������������ ������");       
?>

<div class="widthWrapper">
    <div class="mainSectionWrap">
        <?$APPLICATION->IncludeComponent(
                "bitrix:sale.personal.order",
                ".default",
                array(
                    "SEF_MODE" => "Y",
                    "SEF_FOLDER" => "/personal/order/",
                    "ORDERS_PER_PAGE" => "10",
                    "PATH_TO_PAYMENT" => "/personal/order/payment/",
                    "PATH_TO_BASKET" => "/personal/cart/",
                    "SET_TITLE" => "Y",
                    "SAVE_IN_SESSION" => "Y",
                    "NAV_TEMPLATE" => "arrows",
                    "SHOW_ACCOUNT_NUMBER" => "Y",
                    "COMPONENT_TEMPLATE" => ".default",
                    "PROP_1" => array(
                    ),
                    "PROP_2" => array(
                    ),
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "CACHE_GROUPS" => "Y",
                    "CUSTOM_SELECT_PROPS" => array(
                    ),
                    "HISTORIC_STATUSES" => array(),
                    "SEF_URL_TEMPLATES" => array(
                        "list" => "index.php",
                        "detail" => "detail/#ID#/",
                        "cancel" => "cancel/#ID#/",
                    )
                ),
                false
            );?>    
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>