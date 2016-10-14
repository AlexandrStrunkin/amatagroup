<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$filterView = (COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID) == "eshop_adapt_vertical" ? "HORIZONTAL" : "VERTICAL");
?>
<?
  global $arrFilter;
  $curr_date = mktime(date('d.m.Y G:i:s'));
  $date_create_date = $curr_date - 259200;

  $arrFilter[] = array(
        ">DATE_CREATE" => date('d.m.Y H:i:s', $date_create_date)
    );
?>
<div class="backgroundColor news_wrap">
    <!--widthWrapper-->
    <div class="widthWrapper">
        <!--productBlockWrapper-->
        <div class="productBlockWrapper">

            <div class="newsBlock">
            <?$APPLICATION->IncludeComponent(
	                "bitrix:catalog.section",
	                "section_catalog",
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
		                "DETAIL_URL" => "",
		                "DISABLE_INIT_JS_IN_COMPONENT" => "Y",
		                "DISPLAY_BOTTOM_PAGER" => "Y",
		                "DISPLAY_TOP_PAGER" => "N",
		                "ELEMENT_SORT_FIELD" => "date_create",
		                "ELEMENT_SORT_FIELD2" => "id",
		                "ELEMENT_SORT_ORDER" => "desc",
		                "ELEMENT_SORT_ORDER2" => "desc",
		                "FILTER_NAME" => "arrFilter",
		                "HIDE_NOT_AVAILABLE" => "Y",
		                "IBLOCK_ID" => "5",
		                "IBLOCK_TYPE" => "1c_catalog",
		                "INCLUDE_SUBSECTIONS" => "Y",
		                "LABEL_PROP" => "-",
		                "LINE_ELEMENT_COUNT" => "4",
		                "MESSAGE_404" => "Новинки",
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
			                0 => "",
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
		                "PAGER_TITLE" => "Новинки",
		                "PAGE_ELEMENT_COUNT" => "100",
		                "PARTIAL_PRODUCT_PROPERTIES" => "N",
		                "PRICE_CODE" => array(
			                0 => "Оптовая 1 Для сайта",
		                ),
		                "PRICE_VAT_INCLUDE" => "Y",
		                "PRODUCT_DISPLAY_MODE" => "N",
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
		                "SECTION_URL" => "",
		                "SECTION_USER_FIELDS" => array(
			                0 => "",
			                1 => "",
		                ),
		                "SEF_MODE" => "Y",
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
		                "COMPONENT_TEMPLATE" => "section_catalog"
	                ),
	                false
                );?>
            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>