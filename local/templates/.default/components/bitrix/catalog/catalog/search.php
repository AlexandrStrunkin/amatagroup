<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    /** @var array $arParams */
    /** @var array $arResult */
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global CDatabase $DB */
    /** @var CBitrixComponentTemplate $this */
    /** @var string $templateName */
    /** @var string $templateFile */
    /** @var string $templateFolder */
    /** @var string $componentPath */
    /** @var CBitrixComponent $component */

    if (!empty($_GET["q"])) {
        $APPLICATION->SetTitle(GetMessage("SEARCH_RESULTS_TITLE").' "'.$_GET["q"].'"');
    }

    $catalogParams = getCatalogViewParams();  //sets in init.php
    $sectionTemplate = $catalogParams["CATALOG_SECTION_TEMPLATE"];
    $arParams["PAGE_ELEMENT_COUNT"] = $catalogParams["PAGE_ELEMENT_COUNT"];
    $arParams["ELEMENT_SORT_FIELD"] = $catalogParams["ELEMENT_SORT_FIELD"];
    $arParams["ELEMENT_SORT_ORDER"] = $catalogParams["ELEMENT_SORT_ORDER"];
    $arParams["ELEMENT_SORT_FIELD2"] = $catalogParams["ELEMENT_SORT_FIELD2"];
    $arParams["ELEMENT_SORT_ORDER2"] = $catalogParams["ELEMENT_SORT_ORDER2"];
    
    //формируем правильный вид для поля сортировки
    if ($arParams["ELEMENT_SORT_FIELD"] == "PRICE") {
        $priceCode = $arParams["PRICE_CODE"][0];
        $arPrice = CCatalogGroup::GetList(array(), array("NAME"=>$priceCode), false, false, array())->Fetch();
        if ($arPrice["ID"] > 0) {
            $arParams["ELEMENT_SORT_FIELD"] = "CATALOG_PRICE_".$arPrice["ID"];
        }
    }

    // $this->addExternalCss("/bitrix/css/main/bootstrap.css");

?>

<div class="catalogElementsBlock">
    <div class="widthWrapper">

        <!--horizontalFilterWrap-->
        <div class="horizontalFilterWrap">
            <div class="productFilterWrap">
                <p class="activeTopLeftBut"><?=GetMessage("CATALOG_FILTER")?></p>
            </div>
            <div class="displayTypeWrapAvalible">
                <div class="avalibleFilter">
                    <?getCatalogOptionBlock("CATALOG_AVAILABLE_PRODUCT"); //sets in init.php?>
                </div>
            </div>
            <div class="sortingWrap">

                <p><?=GetMessage("ORDER_BY")?></p>

                <div class="firstFilter">
                    <?getCatalogOptionBlock("ELEMENT_SORT_FIELD"); //sets in init.php?>
                </div>


            </div>
            <div class="displayTypeWrap">
                <?if ($sectionTemplate == "blocks") {?>
                    <div class="blockType checked"></div>
                    <div class="listType" data-href="?CATALOG_SECTION_TEMPLATE=table"></div>
                    <?} else {?>
                    <div class="blockType" data-href="?CATALOG_SECTION_TEMPLATE=blocks"></div>
                    <div class="listType checked"></div>
                    <?}?>
            </div>

            <div class="quantityWrap">
                <p class="quantityFiltTitle"><?=GetMessage("PAGE_ELEMENT_COUNT")?></p>
                <div class="quantOnPageFilt">
                    <?getCatalogOptionBlock("PAGE_ELEMENT_COUNT"); //sets in init.php?>
                </div>
            </div>

        </div>
        <!--END horizontalFilterWrap-->
        <!--allElementWrap-->
        <div class="allElementWrap">     

            <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.search",
                    "",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                        "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                        "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                        "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                        "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                        "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                        "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                        "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                        "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                        "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                        "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                        "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                        "OFFERS_LIMIT" => $arParams["OFFERS_LIMIT"],
                        "SECTION_URL" => $arParams["SECTION_URL"],
                        "DETAIL_URL" => $arParams["DETAIL_URL"],
                        "BASKET_URL" => $arParams["BASKET_URL"],
                        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                        "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        'DISPLAY_COMPARE' => (isset($arParams['USE_COMPARE']) ? $arParams['USE_COMPARE'] : ''),
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                        "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                        "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                        "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
                        "USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],
                        "CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
                        "CURRENCY_ID" => $arParams["CURRENCY_ID"],
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                        "FILTER_NAME" => "searchFilter",
                        "SECTION_ID" => "",
                        "SECTION_CODE" => "",
                        "SECTION_USER_FIELDS" => array(),
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "SHOW_ALL_WO_SECTION" => "Y",
                        "META_KEYWORDS" => "",
                        "META_DESCRIPTION" => "",
                        "BROWSER_TITLE" => "",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "SET_TITLE" => "N",
                        "SET_STATUS_404" => "N",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "N",

                        "RESTART" => "N",
                        "NO_WORD_LOGIC" => "Y",
                        "USE_LANGUAGE_GUESS" => "Y",
                        "CHECK_DATES" => "Y",

                        'LABEL_PROP' => $arParams['LABEL_PROP'],
                        'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                        'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

                        'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                        'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                        'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                        'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                        'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                        'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                        'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                        'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
                        'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
                        'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

                        'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                        'ADD_TO_BASKET_ACTION' => $basketAction,
                        'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                        'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare']
                    ),
                    $component,
                    array("HIDE_ICONS" => "Y")
                );
                unset($basketAction);
            ?>

            <!--END elementBlocksWrap-->
        </div>
        <!--END allElementWrap-->

        <!--bottomHorNavig-->
        <div class="bottomHorNavig">

            <?$APPLICATION->ShowViewContent('catalog_pager');//sets in section template?>

            <div class="elemOnPageWrapp">
                <p class="quantityFiltTitle"><?=GetMessage("PAGE_ELEMENT_COUNT")?></p>

                <div class="quantOnPageFiltBot">                     

                    <?getCatalogOptionBlock("PAGE_ELEMENT_COUNT"); //sets in init.php?>   

                </div>

            </div>
        </div>
        <!--END bottomHorNavig-->
    </div>
</div> 

<script type="">
    $(function(){
        //скрываем блок фильтра
        $(".smallElementList").removeClass("smallElementList");
        $(".elementBlocksWrap").css("margin-left", 0);
    })
</script>
