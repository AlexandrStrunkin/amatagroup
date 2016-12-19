<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    /** @var array $templateData */
    /** @var @global CMain $APPLICATION */
    use Bitrix\Main\Loader;
    use \Bitrix\Catalog\CatalogViewedProductTable as CatalogViewedProductTable;
    global $APPLICATION;
    $APPLICATION->SetAdditionalCSS("/vendor/fancybox/jquery.fancybox.css");
    $APPLICATION->AddHeadScript("/vendor/fancybox/jquery.fancybox.pack.js");
    $user_id = CSaleBasket::GetBasketUserID(); // нужен именно ID юзера в корзине !
    if($user_id  > 0) {
        $product_id = $arResult['ID'];
        CatalogViewedProductTable::refresh($product_id, $user_id);
    }
    if (isset($templateData['TEMPLATE_THEME']))
    {
        $APPLICATION->SetAdditionalCSS($templateData['TEMPLATE_THEME']);
    }
    $APPLICATION->AddHeadScript($templateFolder . "/preview_slider.js");
    if (isset($templateData['TEMPLATE_LIBRARY']) && !empty($templateData['TEMPLATE_LIBRARY']))
    {
        $loadCurrency = false;
        if (!empty($templateData['CURRENCIES']))
            $loadCurrency = Loader::includeModule('currency');
        CJSCore::Init($templateData['TEMPLATE_LIBRARY']);
        if ($loadCurrency)
        {
        ?>
        <script type="text/javascript">
            BX.Currency.setCurrencies(<? echo $templateData['CURRENCIES']; ?>);
        </script>
        <?
        }
    }
    if (isset($templateData['JS_OBJ']))
    {
    ?><script type="text/javascript">
        BX.ready(BX.defer(function(){
            $(".fancybox").fancybox();
            $("a[rel=element_gallery]").fancybox({
                'transitionIn'  :   'elastic',
                'transitionOut' :   'elastic',
                'speedIn'       :   600, 
                'speedOut'      :   200, 
                'overlayShow'   :   false,
                'changeSpeed'   :   500
            });
            // простенький слайдер для превьюх в карточке товара
            var preview_slider = new PreviewSlider({
                slide_distance: 104,
                arrows_class: "previews_slider_navigation_arrow",
                wrapper_id: "previews_slider_wrapper",
                items_in_rows: 6
            });
            preview_slider.init();
            // переключение табов на правой части
            $(".productTitle li").on("click", function() {
                if (!$(this).hasClass("active")) {
                    $(".productTitle li").removeClass("active");
                    $(this).addClass("active");
                    $(".product_info_tab_content").fadeOut(100);
                    $(".product_info_tab_content[data-product-tab='" + $(this).data("product-tab") + "']").fadeIn(200);
                }
            });
            // скролл для вкладки описание
            $(".product_card_description").mCustomScrollbar({
                theme: "dark-thin"
            });
            if (!!window.<? echo $templateData['JS_OBJ']; ?>)
            {
                window.<? echo $templateData['JS_OBJ']; ?>.allowViewedCount(true);
            } 
        }));
    </script><?
    }
?>
<script>
    //section id for catalog menu
    section_id = <?=$arResult["IBLOCK_SECTION_ID"]?>;
</script>

<?
    $additional_items = getAdditionalProducts($arResult["IBLOCK_SECTION_ID"]);
    if (is_array($additional_items) && count($additional_items) > 0) {
        global $additional_items_filter;
        $additional_items_filter["ID"] = $additional_items; 
    }   
    //если найдены сопутствующие товары
    if (count($additional_items) > 0) {             
    ?>

    <!--additionalProductsBlock-->
    <div class="viewedElementBlock">
        <div class="widthWrapper">
            <div class="viewedBlock productCarousel elmentsList">
                <h2><?=GetMessage("ADDITIONAL_PRODUCTS")?></h2>
                <!--jcarousel-wrapper-->
                <div class="jcarousel-wrapper">
                    <!--jcarousel-->
                    <div class="jcarousel">           
                        <?$APPLICATION->IncludeComponent(
                                "bitrix:catalog.section", 
                                "blocks", 
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
                                    "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                                    "DISPLAY_BOTTOM_PAGER" => "N",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "ELEMENT_SORT_FIELD" => "RAND",
                                    "ELEMENT_SORT_FIELD2" => "id",
                                    "ELEMENT_SORT_ORDER" => "asc",
                                    "ELEMENT_SORT_ORDER2" => "desc",
                                    "FILTER_NAME" => "additional_items_filter",
                                    "HIDE_NOT_AVAILABLE" => "N",
                                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                    "IBLOCK_TYPE" => "1c_catalog",
                                    "INCLUDE_SUBSECTIONS" => "Y",
                                    "LABEL_PROP" => "-",
                                    "LINE_ELEMENT_COUNT" => "3",
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
                                        0 => "",
                                        1 => "",
                                    ),
                                    "OFFERS_LIMIT" => "5",
                                    "OFFERS_PROPERTY_CODE" => array(
                                        0 => "",
                                        1 => "",
                                    ),     
                                    "OFFERS_SORT_FIELD" => "sort",
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
                                    "PAGE_ELEMENT_COUNT" => "10",
                                    "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                    "PRICE_CODE" =>$arParams["PRICE_CODE"],
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
                                    "SEF_MODE" => "N",
                                    "SET_BROWSER_TITLE" => "Y",
                                    "SET_LAST_MODIFIED" => "N",
                                    "SET_META_DESCRIPTION" => "Y",
                                    "SET_META_KEYWORDS" => "Y",
                                    "SET_STATUS_404" => "N",
                                    "SET_TITLE" => "N",
                                    "SHOW_404" => "N",
                                    "SHOW_ALL_WO_SECTION" => "N",
                                    "SHOW_CLOSE_POPUP" => "N",
                                    "SHOW_DISCOUNT_PERCENT" => "N",
                                    "SHOW_OLD_PRICE" => "N",
                                    "SHOW_PRICE_COUNT" => "1",
                                    "TEMPLATE_THEME" => "blue",
                                    "USE_MAIN_ELEMENT_SECTION" => "N",
                                    "USE_PRICE_COUNT" => "N",
                                    "USE_PRODUCT_QUANTITY" => "N",
                                    "COMPONENT_TEMPLATE" => "blocks",
                                    "SHOW_ALL_WO_SECTION" => "Y"                            
                                ),
                                false
                            );?>
                    </div>
                    <a href="" class="jcarousel-control-prev"></a>
                    <a href="" class="jcarousel-control-next"></a>

                </div>
                <!--END jcarousel-wrapper-->
            </div>
        </div>
    </div>
    <!--END additionalProductsBlock-->     
    <?}?>