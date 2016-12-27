<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    IncludeTemplateLangFile(__FILE__);
    CJSCore::Init(array("fx"));
    $curPage = $APPLICATION->GetCurPage(true);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
    <meta name="mailru-verification" content="3f378cce47e62dcb" />
    <?include($_SERVER["DOCUMENT_ROOT"].DEFAULT_TEMPLATE_PATH."/include/meta.php")?>
</head>
<body class="<?if ($curPage == SITE_DIR."index.php"){?>mainPage<?}?>">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>

<?include($_SERVER["DOCUMENT_ROOT"].DEFAULT_TEMPLATE_PATH."/include/header.php")?>

<!--main-->
<main>
    <!--backgroundColor-->
    <div class="backgroundColor">
    <!--widthWrapper-->
    <div class="widthWrapper">
        <!--productBlockWrapper-->
        <div class="productBlockWrapper">
            <div class="productBlockMenu">
                <div id="wrap_new" class="active" data-id='1'><?=GetMessage('NEWS')?></div>
                <div id="wrap_best"  data-id='2'><?=GetMessage('BESTSELLERS')?></div>
                <div id="wrap_latest" data-id='3'><?=GetMessage('LATEST')?></div>
                <div id="wrap_expected" data-id='4'><?=GetMessage('EXPECTED_PRODUCTS')?></div>
            </div>
            <div class="newsBlock">
                <?
                    global $ShowWithImage;
                    $curr_date = date('U');
                    $date_create_date = $curr_date - (86400 * NEW_PRODUCT_STATUS_LENGTH);
                    $ShowWithImage = array(
                        ">=DATE_CREATE" => ConvertTimeStamp($date_create_date,"FULL"),
                        '!PREVIEW_PICTURE' => false
                    );
                ?>
                <?$APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "product_news",
                        array(
                            "ACTION_VARIABLE" => "action",
                            "ADD_PICT_PROP" => "-",
                            "ADD_PROPERTIES_TO_BASKET" => "Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "ADD_TO_BASKET_ACTION" => "ADD",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "BACKGROUND_IMAGE" => "-",
                            "BASKET_URL" => "/personal/basket.php",
                            "BROWSER_TITLE" => "-",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CONVERT_CURRENCY" => "N",
                            "DETAIL_URL" => "/catalog/#ELEMENT_CODE#/",
                            "DISABLE_INIT_JS_IN_COMPONENT" => "Y",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_TOP_PAGER" => "N",
                            "ELEMENT_SORT_FIELD" => "rand",
                            "ELEMENT_SORT_FIELD2" => "id",
                            "ELEMENT_SORT_ORDER" => "date_create",
                            "ELEMENT_SORT_ORDER2" => "desc",
                            "FILTER_NAME" => "ShowWithImage",
                            "HIDE_NOT_AVAILABLE" => "Y",
                            "IBLOCK_ID" => "5",
                            "IBLOCK_TYPE" => "1c_catalog",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "LABEL_PROP" => "-",
                            "LINE_ELEMENT_COUNT" => "4",
                            "MESSAGE_404" => "",
                            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                            "MESS_BTN_BUY" => "Купить",
                            "MESS_BTN_DETAIL" => "Подробнее",
                            "MESS_BTN_SUBSCRIBE" => "Подписаться",
                            "MESS_NOT_AVAILABLE" => "Нет в наличии",
                            "META_DESCRIPTION" => "-",
                            "META_KEYWORDS" => "-",
                            "OFFERS_CART_PROPERTIES" => array(
                            ),
                            "OFFERS_FIELD_CODE" => array(
                                0 => "ID",
                                1 => "",
                            ),
                            "OFFERS_LIMIT" => "15",
                            "OFFERS_PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "OFFERS_SORT_FIELD" => "rand",
                            "OFFERS_SORT_FIELD2" => "id",
                            "OFFERS_SORT_ORDER" => "asc",
                            "OFFERS_SORT_ORDER2" => "desc",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Товары",
                            "PAGE_ELEMENT_COUNT" => "8",
                            "PARTIAL_PRODUCT_PROPERTIES" => "N",
                            "PRICE_CODE" => array(
                                0 => "Рекомендованная Для сайта",
                                1 => "Оптовая 1 Для сайта",
                                2 => "Оптовая 2 Для сайта",
                                3 => "Оптовая 3 Для сайта",
                            ),
                            "PRICE_VAT_INCLUDE" => "Y",
                            "PRODUCT_DISPLAY_MODE" => "Y",
                            "PRODUCT_ID_VARIABLE" => "id",
                            "PRODUCT_PROPERTIES" => array(
                            ),
                            "PRODUCT_PROPS_VARIABLE" => "prop",
                            "PRODUCT_QUANTITY_VARIABLE" => "",
                            "PRODUCT_SUBSCRIPTION" => "N",
                            "PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "SECTION_CODE" => "",
                            "SECTION_CODE_PATH" => "",
                            "SECTION_ID" => $_REQUEST["SECTION_ID"],
                            "SECTION_ID_VARIABLE" => "SECTION_ID",
                            "SECTION_URL" => "/catalog/new_products/",
                            "SECTION_USER_FIELDS" => array(
                                0 => "",
                                1 => "",
                            ),
                            "SEF_MODE" => "N",
                            "SEF_RULE" => "",
                            "SET_BROWSER_TITLE" => "Y",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "Y",
                            "SET_META_KEYWORDS" => "Y",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "Y",
                            "SHOW_404" => "N",
                            "SHOW_ALL_WO_SECTION" => "Y",
                            "SHOW_CLOSE_POPUP" => "N",
                            "SHOW_DISCOUNT_PERCENT" => "N",
                            "SHOW_OLD_PRICE" => "N",
                            "SHOW_PRICE_COUNT" => "1",
                            "TEMPLATE_THEME" => "blue",
                            "USE_MAIN_ELEMENT_SECTION" => "N",
                            "USE_PRICE_COUNT" => "N",
                            "USE_PRODUCT_QUANTITY" => "N",
                            "COMPONENT_TEMPLATE" => "product_news",
                            "OFFER_ADD_PICT_PROP" => "-",
                            "OFFER_TREE_PROPS" => array(
                            )
                        ),
                        false
                    );?>
                <?
                    global $arFilter;
                    $arFilter = array(
                        '!PROPERTY_TOPPRODAZH' => false
                    );
                ?>
                <?$APPLICATION->IncludeComponent(
                        "bitrix:catalog.top",
                        "bestsellers",
                        array(
                            "ACTION_VARIABLE" => "action",
                            "ADD_PICT_PROP" => "MORE_PHOTO",
                            "ADD_PROPERTIES_TO_BASKET" => "Y",
                            "ADD_TO_BASKET_ACTION" => "ADD",
                            "BASKET_URL" => "/personal/basket.php",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CONVERT_CURRENCY" => "N",
                            "DETAIL_URL" => "",
                            "DISPLAY_COMPARE" => "N",
                            "ELEMENT_COUNT" => "8",
                            "ELEMENT_SORT_FIELD" => "PROPERTY_TOPPRODAZH",
                            "ELEMENT_SORT_FIELD2" => "shows",
                            "ELEMENT_SORT_ORDER" => "desc",
                            "ELEMENT_SORT_ORDER2" => "desc",
                            "FILTER_NAME" => "arFilter",
                            "HIDE_NOT_AVAILABLE" => "Y",
                            "IBLOCK_ID" => "5",
                            "IBLOCK_TYPE" => "1c_catalog",
                            "LABEL_PROP" => "-",
                            "LINE_ELEMENT_COUNT" => "4",
                            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                            "MESS_BTN_BUY" => "Купить",
                            "MESS_BTN_COMPARE" => "Сравнить",
                            "MESS_BTN_DETAIL" => "Подробнее",
                            "MESS_NOT_AVAILABLE" => "Нет в наличии",
                            "OFFERS_CART_PROPERTIES" => array(
                            ),
                            "OFFERS_FIELD_CODE" => array(
                                0 => "ID",
                                1 => "",
                            ),
                            "OFFERS_LIMIT" => "5",
                            "OFFERS_PROPERTY_CODE" => array(
                                0 => "TOPPRODAZH",
                                1 => "",
                            ),
                            "OFFERS_SORT_FIELD" => "sort",
                            "OFFERS_SORT_FIELD2" => "id",
                            "OFFERS_SORT_ORDER" => "asc",
                            "OFFERS_SORT_ORDER2" => "desc",
                            "PARTIAL_PRODUCT_PROPERTIES" => "N",
                            "PRICE_CODE" => array(
                                0 => "Рекомендованная Для сайта",
                                1 => "Оптовая 1 Для сайта",
                                2 => "Оптовая 2 Для сайта",
                                3 => "Оптовая 3 Для сайта",
                            ),
                            "PRICE_VAT_INCLUDE" => "Y",
                            "PRODUCT_DISPLAY_MODE" => "Y",
                            "PRODUCT_ID_VARIABLE" => "id",
                            "PRODUCT_PROPERTIES" => array(
                            ),
                            "PRODUCT_PROPS_VARIABLE" => "prop",
                            "PRODUCT_QUANTITY_VARIABLE" => "",
                            "PROPERTY_CODE" => array(
                                0 => "TOPPRODAZH",
                                1 => "",
                            ),
                            "SECTION_ID_VARIABLE" => "SECTION_ID",
                            "SECTION_URL" => "/catalog/bestsellers/",
                            "SEF_MODE" => "N",
                            "SHOW_CLOSE_POPUP" => "N",
                            "SHOW_DISCOUNT_PERCENT" => "N",
                            "SHOW_OLD_PRICE" => "N",
                            "SHOW_PRICE_COUNT" => "1",
                            "TEMPLATE_THEME" => "blue",
                            "USE_PRICE_COUNT" => "N",
                            "USE_PRODUCT_QUANTITY" => "N",
                            "VIEW_MODE" => "SECTION",
                            "COMPONENT_TEMPLATE" => "bestsellers",
                            "SEF_RULE" => ""
                        ),
                        false
                    );?>
                <?
                    $arFilter_arrivals = array('!PROPERTY_NOVOE_POSTUPLENIE_VALUE' => false);
                ?>
                <?$APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "arrivals",
                        array(
                            "ACTION_VARIABLE" => "action",
                            "ADD_PICT_PROP" => "-",
                            "ADD_PROPERTIES_TO_BASKET" => "Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "ADD_TO_BASKET_ACTION" => "ADD",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "BACKGROUND_IMAGE" => "-",
                            "BASKET_URL" => "/personal/basket.php",
                            "BROWSER_TITLE" => "-",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CONVERT_CURRENCY" => "N",
                            "DETAIL_URL" => "/catalog/#ELEMENT_CODE#/",
                            "DISABLE_INIT_JS_IN_COMPONENT" => "Y",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_TOP_PAGER" => "N",
                            "ELEMENT_SORT_FIELD" => "create",
                            "ELEMENT_SORT_FIELD2" => "id",
                            "ELEMENT_SORT_ORDER" => "desc",
                            "ELEMENT_SORT_ORDER2" => "desc",
                            "FILTER_NAME" => "arFilter_arrivals",
                            "HIDE_NOT_AVAILABLE" => "Y",
                            "IBLOCK_ID" => "5",
                            "IBLOCK_TYPE" => "1c_catalog",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "LABEL_PROP" => "-",
                            "LINE_ELEMENT_COUNT" => "4",
                            "MESSAGE_404" => "",
                            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                            "MESS_BTN_BUY" => "Купить",
                            "MESS_BTN_DETAIL" => "Подробнее",
                            "MESS_BTN_SUBSCRIBE" => "Подписаться",
                            "MESS_NOT_AVAILABLE" => "Нет в наличии",
                            "META_DESCRIPTION" => "-",
                            "META_KEYWORDS" => "-",
                            "OFFERS_CART_PROPERTIES" => array(
                            ),
                            "OFFERS_FIELD_CODE" => array(
                                0 => "ID",
                                1 => "",
                            ),
                            "OFFERS_LIMIT" => "15",
                            "OFFERS_PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "OFFERS_SORT_FIELD" => "create",
                            "OFFERS_SORT_FIELD2" => "id",
                            "OFFERS_SORT_ORDER" => "asc",
                            "OFFERS_SORT_ORDER2" => "desc",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Товары",
                            "PAGE_ELEMENT_COUNT" => "8",
                            "PARTIAL_PRODUCT_PROPERTIES" => "N",
                            "PRICE_CODE" => array(
                                0 => "Рекомендованная Для сайта",
                                1 => "Оптовая 1 Для сайта",
                                2 => "Оптовая 2 Для сайта",
                                3 => "Оптовая 3 Для сайта",
                            ),
                            "PRICE_VAT_INCLUDE" => "Y",
                            "PRODUCT_DISPLAY_MODE" => "Y",
                            "PRODUCT_ID_VARIABLE" => "id",
                            "PRODUCT_PROPERTIES" => array(
                            ),
                            "PRODUCT_PROPS_VARIABLE" => "prop",
                            "PRODUCT_QUANTITY_VARIABLE" => "",
                            "PRODUCT_SUBSCRIPTION" => "N",
                            "PROPERTY_CODE" => array(
                                0 => "BESTSELLERS",
                                1 => "",
                            ),
                            "SECTION_CODE" => "",
                            "SECTION_CODE_PATH" => "",
                            "SECTION_ID" => $_REQUEST["SECTION_ID"],
                            "SECTION_ID_VARIABLE" => "SECTION_ID",
                            "SECTION_URL" => "/catalog/last_products/",
                            "SECTION_USER_FIELDS" => array(
                                0 => "",
                                1 => "",
                            ),
                            "SEF_MODE" => "N",
                            "SEF_RULE" => "",
                            "SET_BROWSER_TITLE" => "Y",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "Y",
                            "SET_META_KEYWORDS" => "Y",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "Y",
                            "SHOW_404" => "N",
                            "SHOW_ALL_WO_SECTION" => "Y",
                            "SHOW_CLOSE_POPUP" => "N",
                            "SHOW_DISCOUNT_PERCENT" => "N",
                            "SHOW_OLD_PRICE" => "N",
                            "SHOW_PRICE_COUNT" => "1",
                            "TEMPLATE_THEME" => "blue",
                            "USE_MAIN_ELEMENT_SECTION" => "N",
                            "USE_PRICE_COUNT" => "N",
                            "USE_PRODUCT_QUANTITY" => "N",
                            "COMPONENT_TEMPLATE" => "arrivals",
                            "OFFER_ADD_PICT_PROP" => "-",
                            "OFFER_TREE_PROPS" => array(
                            )
                        ),
                        false
                    );?>


                <?
                    //ожидаемые поступления
                    // создаем объект
                    $obCache = new CPHPCache;

                    // время кеширования - 1 день
                    $life_time = 86400;

                    // формируем идентификатор кеша в зависимости от всех параметров
                    // которые могут повлиять на результирующий HTML
                    $cache_id = "index_page_expected_products";

                    // если кеш есть и он ещё не истек, то
                    if($obCache->InitCache($life_time, $cache_id, "/")) {
                        // получаем закешированные переменные
                        $vars = $obCache->GetVars();
                        $expected_products = $vars["EXPECTED_PRODUCTS"];
                    } else {
                        // иначе обращаемся к базе
                        $expected_products = array();
                        //собираем предложения, у которых есть реквизит "ожидаемая дата поступления"
                        $expected_items = CIBLockElement::GetList(array(), array("IBLOCK_ID" => OFFERS_IBLOCK_ID, "ACTIVE" => "Y", array("LOGIC" => "AND", array(">PROPERTY_CML2_TRAITS" => date("Y-m-d H:i:s")), array("!PROPERTY_CML2_TRAITS" => false))), false, false, array("ID", "PROPERTY_CML2_TRAITS", "PROPERTY_CML2_LINK"));
                        while($arItem = $expected_items->Fetch()) {
                            //собираем основные товары для фильтрации
                            if (!empty($arItem["PROPERTY_CML2_LINK_VALUE"])) {
                                $expected_products[$arItem["PROPERTY_CML2_LINK_VALUE"]] = $arItem["PROPERTY_CML2_LINK_VALUE"];
                            }
                        }
                    }

                    // начинаем буферизирование вывода
                    if($obCache->StartDataCache()) {
                        // записываем предварительно буферизированный вывод в файл кеша
                        // вместе с дополнительной переменной
                        $obCache->EndDataCache(array(
                            "EXPECTED_PRODUCTS"    => $expected_products
                        ));
                    }

                    global $arFilter_expected;
                    $arFilter_expected = array();
                    $arFilter_expected["ID"] = $expected_products;
                ?>

                <?$APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "expected_products",
                        array(
                            "ACTION_VARIABLE" => "action",
                            "ADD_PICT_PROP" => "-",
                            "ADD_PROPERTIES_TO_BASKET" => "Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "ADD_TO_BASKET_ACTION" => "ADD",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "BACKGROUND_IMAGE" => "-",
                            "BASKET_URL" => "/personal/basket.php",
                            "BROWSER_TITLE" => "-",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CONVERT_CURRENCY" => "N",
                            "DETAIL_URL" => "/catalog/#ELEMENT_CODE#/",
                            "DISABLE_INIT_JS_IN_COMPONENT" => "Y",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_TOP_PAGER" => "N",
                            "ELEMENT_SORT_FIELD" => "RAND",
                            "ELEMENT_SORT_FIELD2" => "id",
                            "ELEMENT_SORT_ORDER" => "desc",
                            "ELEMENT_SORT_ORDER2" => "desc",
                            "FILTER_NAME" => "arFilter_expected",
                            "HIDE_NOT_AVAILABLE" => "Y",
                            "IBLOCK_ID" => "5",
                            "IBLOCK_TYPE" => "1c_catalog",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "LABEL_PROP" => "-",
                            "LINE_ELEMENT_COUNT" => "4",
                            "MESSAGE_404" => "",
                            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                            "MESS_BTN_BUY" => "Купить",
                            "MESS_BTN_DETAIL" => "Подробнее",
                            "MESS_BTN_SUBSCRIBE" => "Подписаться",
                            "MESS_NOT_AVAILABLE" => "Нет в наличии",
                            "META_DESCRIPTION" => "-",
                            "META_KEYWORDS" => "-",
                            "OFFERS_CART_PROPERTIES" => array(
                            ),
                            "OFFERS_FIELD_CODE" => array(
                                0 => "ID",
                                1 => "",
                            ),
                            "OFFERS_LIMIT" => "15",
                            "OFFERS_PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "OFFERS_SORT_FIELD" => "create",
                            "OFFERS_SORT_FIELD2" => "id",
                            "OFFERS_SORT_ORDER" => "asc",
                            "OFFERS_SORT_ORDER2" => "desc",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Товары",
                            "PAGE_ELEMENT_COUNT" => "8",
                            "PARTIAL_PRODUCT_PROPERTIES" => "N",
                            "PRICE_CODE" => array(
                                0 => "Рекомендованная Для сайта",
                                1 => "Оптовая 1 Для сайта",
                                2 => "Оптовая 2 Для сайта",
                                3 => "Оптовая 3 Для сайта",
                            ),
                            "PRICE_VAT_INCLUDE" => "Y",
                            "PRODUCT_DISPLAY_MODE" => "Y",
                            "PRODUCT_ID_VARIABLE" => "id",
                            "PRODUCT_PROPERTIES" => array(
                            ),
                            "PRODUCT_PROPS_VARIABLE" => "prop",
                            "PRODUCT_QUANTITY_VARIABLE" => "",
                            "PRODUCT_SUBSCRIPTION" => "N",
                            "PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "SECTION_CODE" => "",
                            "SECTION_CODE_PATH" => "",
                            "SECTION_ID" => $_REQUEST["SECTION_ID"],
                            "SECTION_ID_VARIABLE" => "SECTION_ID",
                            "SECTION_URL" => "/catalog/expected_products/",
                            "SECTION_USER_FIELDS" => array(
                                0 => "",
                                1 => "",
                            ),
                            "SEF_MODE" => "N",
                            "SEF_RULE" => "",
                            "SET_BROWSER_TITLE" => "Y",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "Y",
                            "SET_META_KEYWORDS" => "Y",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "Y",
                            "SHOW_404" => "N",
                            "SHOW_ALL_WO_SECTION" => "Y",
                            "SHOW_CLOSE_POPUP" => "N",
                            "SHOW_DISCOUNT_PERCENT" => "N",
                            "SHOW_OLD_PRICE" => "N",
                            "SHOW_PRICE_COUNT" => "1",
                            "TEMPLATE_THEME" => "blue",
                            "USE_MAIN_ELEMENT_SECTION" => "N",
                            "USE_PRICE_COUNT" => "N",
                            "USE_PRODUCT_QUANTITY" => "N",
                            "COMPONENT_TEMPLATE" => "expected_products",
                            "OFFER_ADD_PICT_PROP" => "-",
                            "OFFER_TREE_PROPS" => array(
                            )
                        ),
                        false
                    );?>


            </div>

        </div>
        <!--END productBlockWrapper-->
        <!--brandsWrapper-->
        <div class="brandsWrapper">

            <p class="brandTitle"><a href="/brands/">Бренды</a></p>

            <p class="brandText">
                <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "standard.php",
                            "PATH" => "/include/brands.php"
                        )
                    );?>
            </p><br>
            <?$Filter_brands = array(
                '!PROPERTY_MAIN_DUSPLAY' => false
            )?>
            <?$APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "brands_index",
                    array(
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "ADD_SECTIONS_CHAIN" => "Y",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "/brands/#ELEMENT_ID#/",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "DISPLAY_TOP_PAGER" => "N",
                        "FIELD_CODE" => array(
                            0 => "PREVIEW_PICTURE",
                            1 => "",
                        ),
                        "FILTER_NAME" => "Filter_brands",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => "14",
                        "IBLOCK_TYPE" => "services",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "8",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Бренды",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array(
                            0 => "",
                            1 => "MAIN_DISPLAY",
                            2 => "",
                        ),
                        "SET_BROWSER_TITLE" => "Y",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "Y",
                        "SET_META_KEYWORDS" => "Y",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "Y",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "rand",
                        "SORT_BY2" => "ID",
                        "SORT_ORDER1" => "DESC",
                        "SORT_ORDER2" => "ASC",
                        "COMPONENT_TEMPLATE" => "brands_index"
                    ),
                    false
                );?>
            <!--END brandsWrapper-->
            <!--partnerReviews-->
            <div class="productCarousel partnerReviews">
                <!-- <div class="rightArrow"></div>
                <div class="leftArrow"></div>-->
                <p class="partnerTitle">Отзывы партнеров</p>

                <p class="partnerText">
                    <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/reviews_partners.php"
                            )
                        );?>
                </p>


                <?$APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "partners_reviews",
                        array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "N",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array(
                                0 => "NAME",
                                1 => "PREVIEW_TEXT",
                                2 => "",
                            ),
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "16",
                            "IBLOCK_TYPE" => "services",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "20",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Новости",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(
                                0 => "CITY",
                                1 => "POSITION",
                                2 => "AUTHOR",
                                3 => "",
                            ),
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "DESC",
                            "SORT_ORDER2" => "ASC",
                            "COMPONENT_TEMPLATE" => "partners_reviews"
                        ),
                        false
                    );?>

                <!--confidenceWrapper-->
                <div class="confidenceWrapper">
                    <p class="confidensTitle">Нам доверяют</p>
                    <p class="partnerText">
                        <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => "/include/we_are_trusted.php"
                                )
                            );?>
                    </p>
                    <div class="confidens_container">
                        <div class="previews_slider_navigation_arrow confidens_slider_arrow" data-preview-slider-direction="prev"><span data-preview-slider-direction="prev"></span></div>
                        <div class="previews_slider_navigation_arrow confidens_slider_arrow" data-preview-slider-direction="next"><span data-preview-slider-direction="next"></span></div>
                        <div id="confidens_slider_wrapper">
                            <?$APPLICATION->IncludeComponent(
                                    "bitrix:news.list",
                                    "confidens",
                                    array(
                                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                        "ADD_SECTIONS_CHAIN" => "N",
                                        "AJAX_MODE" => "N",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "Y",
                                        "CACHE_FILTER" => "N",
                                        "CACHE_GROUPS" => "Y",
                                        "CACHE_TIME" => "36000000",
                                        "CACHE_TYPE" => "A",
                                        "CHECK_DATES" => "Y",
                                        "DETAIL_URL" => "/servis/",
                                        "DISPLAY_BOTTOM_PAGER" => "N",
                                        "DISPLAY_DATE" => "N",
                                        "DISPLAY_NAME" => "Y",
                                        "DISPLAY_PICTURE" => "N",
                                        "DISPLAY_PREVIEW_TEXT" => "Y",
                                        "DISPLAY_TOP_PAGER" => "N",
                                        "FIELD_CODE" => array(
                                            0 => "NAME",
                                            1 => "PREVIEW_PICTURE",
                                            2 => "",
                                        ),
                                        "FILTER_NAME" => "",
                                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                        "IBLOCK_ID" => "17",
                                        "IBLOCK_TYPE" => "services",
                                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                        "INCLUDE_SUBSECTIONS" => "Y",
                                        "MESSAGE_404" => "",
                                        "NEWS_COUNT" => "999",
                                        "PAGER_BASE_LINK_ENABLE" => "N",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "N",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_TEMPLATE" => ".default",
                                        "PAGER_TITLE" => "Новости",
                                        "PARENT_SECTION" => "",
                                        "PARENT_SECTION_CODE" => "",
                                        "PREVIEW_TRUNCATE_LEN" => "",
                                        "PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "SET_BROWSER_TITLE" => "N",
                                        "SET_LAST_MODIFIED" => "N",
                                        "SET_META_DESCRIPTION" => "N",
                                        "SET_META_KEYWORDS" => "N",
                                        "SET_STATUS_404" => "N",
                                        "SET_TITLE" => "N",
                                        "SHOW_404" => "N",
                                        "SORT_BY1" => "ACTIVE_FROM",
                                        "SORT_BY2" => "SORT",
                                        "SORT_ORDER1" => "DESC",
                                        "SORT_ORDER2" => "ASC",
                                        "COMPONENT_TEMPLATE" => "confidens"
                                    ),
                                    false
                                );?>
                        </div>
                    </div>
                </div>
                <!--END confidenceWrapper-->
            </div>
            <!--END partnerReviews-->
        </div>
        <!--END widthWrapper-->
    </div>
    <!--END backgroundColor-->
    </main>
    <!--END main-->

