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
    use Bitrix\Main\Loader;
    use Bitrix\Main\ModuleManager;

    $this->setFrameMode(true);
    //$this->addExternalCss("/bitrix/css/main/bootstrap.css");


    $catalogParams = getCatalogViewParams();  //sets in init.php
    $sectionTemplate = $catalogParams["CATALOG_SECTION_TEMPLATE"];
    $arParams["PAGE_ELEMENT_COUNT"] = $catalogParams["PAGE_ELEMENT_COUNT"];
    $arParams["ELEMENT_SORT_FIELD"] = $catalogParams["ELEMENT_SORT_FIELD"];
    $arParams["ELEMENT_SORT_ORDER"] = $catalogParams["ELEMENT_SORT_ORDER"];
    $arParams["ELEMENT_SORT_FIELD2"] = $catalogParams["ELEMENT_SORT_FIELD2"];
    $arParams["ELEMENT_SORT_ORDER2"] = $catalogParams["ELEMENT_SORT_ORDER2"];

    //��������� ���������� ��� ��� ���� ����������
    if ($arParams["ELEMENT_SORT_FIELD"] == "PRICE") {
        $priceCode = $arParams["PRICE_CODE"][0];
        $arPrice = CCatalogGroup::GetList(array(), array("NAME" => $priceCode), false, false, array())->Fetch();
        if ($arPrice["ID"] > 0) {
            $arParams["ELEMENT_SORT_FIELD"] = "CATALOG_PRICE_".$arPrice["ID"];
        }
    }

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
            <!--leftFiltersBlock-->
            <? 
                $page = $APPLICATION->GetCurPage();
                $exploded_page = explode("/", $page);
            ?>
            <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.smart.filter",
                    "catalog_filter",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "SECTION_ID" => $arCurSection['ID'],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SAVE_IN_SESSION" => "N",
                        "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                        "XML_EXPORT" => "Y",
                        "SECTION_TITLE" => "NAME",
                        "SECTION_DESCRIPTION" => "DESCRIPTION",
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        "SEF_MODE" => $arParams["SEF_MODE"],
                        "SEF_RULE" => "/catalog/filter/#SMART_FILTER_PATH#/apply/",
                        "SMART_FILTER_PATH" => $exploded_page[3],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                        "SHOW_ALL_WO_SECTION" => "Y",       
                        "POPUP_POSITION" => "right"
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );?>
            <!--END leftFiltersBlock-->                 

            <?$intSectionID = $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    $sectionTemplate,
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                        "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                        "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                        "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                        "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                        "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                        "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                        "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                        "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                        "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                        "BASKET_URL" => $arParams["BASKET_URL"],
                        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                        "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SET_TITLE" => $arParams["SET_TITLE"],
                        "MESSAGE_404" => $arParams["MESSAGE_404"],
                        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                        "SHOW_404" => $arParams["SHOW_404"],
                        "FILE_404" => $arParams["FILE_404"],
                        "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                        "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                        "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                        "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                        "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                        "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                        "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

                        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                        "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                        "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

                        "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                        "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                        "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                        "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                        "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                        "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

                        "SECTION_ID" => $arCurSection['ID'],
                        "SECTION_CODE" => "",
                        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                        "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                        "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

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
                        "ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
                        'ADD_TO_BASKET_ACTION' => $basketAction,
                        'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                        'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                        'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
                        'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
                        "SHOW_ALL_WO_SECTION" => "Y"
                    ),
                    $component
                );?>
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