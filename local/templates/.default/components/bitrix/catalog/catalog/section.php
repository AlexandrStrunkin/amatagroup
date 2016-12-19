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


    $arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

    $isFilter = ($arParams['USE_FILTER'] == 'Y');

    if ($isFilter)
    {
        $arFilter = array(
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "ACTIVE" => "Y",
            "GLOBAL_ACTIVE" => "Y",
        );
        if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
            $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
        elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
            $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

        $obCache = new CPHPCache();
        if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
        {
            $arCurSection = $obCache->GetVars();
        }
        elseif ($obCache->StartDataCache())
        {
            $arCurSection = array();
            if (Loader::includeModule("iblock"))
            {
                $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

                if(defined("BX_COMP_MANAGED_CACHE"))
                {
                    global $CACHE_MANAGER;
                    $CACHE_MANAGER->StartTagCache("/iblock/catalog");

                    if ($arCurSection = $dbRes->Fetch())
                        $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);

                    $CACHE_MANAGER->EndTagCache();
                }
                else
                {
                    if(!$arCurSection = $dbRes->Fetch())
                        $arCurSection = array();
                }
            }
            $obCache->EndDataCache($arCurSection);
        }
        if (!isset($arCurSection))
            $arCurSection = array();
    }
    

    //собираем цены для фильтра
    $filter_price = $arParams["PRICE_CODE"];
    //проверяем доступные типы цен для текущего покупателя, и удаляем из фильтра лишние, если для покупателя доступны несколько типов 
    $available_prices = CCatalogGroup::GetList(array(), array("CAN_BUY" => "Y"), false, false, array());
    while($ar_price = $available_prices->Fetch()) {
        //если цена выбрана для отображения и она не является основной, удаляем из фильтра все остальные типы цен
        if (in_array($ar_price["NAME"], $filter_price) && $ar_price["ID"] != CATALOG_GROUP_ID_PRICE_BASE) {
            $price_key = array_search($ar_price["NAME"], $filter_price);
            if ($price_key >= 0) {
                foreach ($filter_price as $p => $f_price) {
                    if ($p != $price_key) {
                        //удаляем для фильтра лишние типы цен
                        unset($filter_price[$p]);
                    }
                }
            }
            break;
        } else { //если пользователю доступна только основная цена
            if (!$price_key && $ar_price["ID"] == CATALOG_GROUP_ID_PRICE_BASE) {
                $price_key = array_search($ar_price["NAME"], $filter_price);    
            } 
        }  
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
        $priceCode = $arParams["PRICE_CODE"][$price_key];
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


            <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.smart.filter",
                    "catalog_filter", //catalog_filter
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "SECTION_ID" => $arCurSection['ID'],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "PRICE_CODE" => $filter_price,
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
                        "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
                        "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "DISPLAY_ELEMENT_COUNT" => "Y",
                        "POPUP_POSITION" => "right",
                        "SHOW_ALL_WO_SECTION" => "Y"
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );?>
            <!--END leftFiltersBlock-->


            <!--elementBlocksWrap-->
            <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list", 
                    "catalog_section_list", 
                    array(
                        "ADD_SECTIONS_CHAIN" => "N",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "COUNT_ELEMENTS" => "Y",
                        "IBLOCK_ID" => "5",
                        "IBLOCK_TYPE" => "1c_catalog",
                        "SECTION_CODE" => "",
                        "SECTION_FIELDS" => array(
                            0 => "DETAIL_PICTURE",
                            1 => "",
                        ),
                        "SECTION_ID" => $arCurSection["ID"],
                        "SECTION_URL" => "",
                        "SECTION_USER_FIELDS" => array(
                            0 => "",
                            1 => "",
                        ),
                        "SHOW_PARENT_NAME" => "Y",
                        "TOP_DEPTH" => "2",
                        "VIEW_MODE" => "LINE",
                        "COMPONENT_TEMPLATE" => "catalog_section_list",
                        "HIDE_SECTION_NAME" => "N"
                    ),
                    false
                );        if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
                    $basketAction = (isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '');
                else
                    $basketAction = (isset($arParams['SECTION_ADD_TO_BASKET_ACTION']) ? $arParams['SECTION_ADD_TO_BASKET_ACTION'] : '');

                $intSectionID = 0;

            ?>
            <?
                //если установлен фильтр по 1 бренду, выводим ссылку на все товары данного бренда
                $url = explode("/", $APPLICATION->GetCurDir());
                //если установлен фильтр и мы находимся не в корне каталога
                if (in_array("filter", $url) && substr_count($APPLICATION->GetCurDir(), "/catalog/filter") ==0 ) {  
                    foreach ($url as $url_param) {
                        //если есть фильтр по бренду и строго по одному бренду
                        if (substr_count($url_param, "brend-is-") > 0 && substr_count($url_param, "-or-") == 0) {  
                            $brand_id = str_replace("brend-is-", "", $url_param);
                            //получаем название бренда 
                            if (!empty($brand_id)) {    
                                $brand = CIBlockPropertyEnum::GetList(array(), array("EXTERNAL_ID" => $brand_id))->Fetch();    
                                //если нашли название бренда и в данный момент мы не в корне каталога
                                if ($brand["VALUE"] && $arCurSection['ID'] > 0) {?>
                                <div class="filter_view_all_products">
                                    <a href="/catalog/filter/<?=$url_param?>/apply/"><?=GetMessage("SHOW_ALL_PRODUCTS_BY_BRAND")?> "<?=$brand["VALUE"]?>"</a>
                                </div>    
                                <?}
                            }                            
                        } else if (substr_count($url_param, "vidtovara-is-") > 0 && substr_count($url_param, "-or-") == 0) {
                            //если есть фильтр по типу товара и строго по одному типу
                            $type_id = str_replace("vidtovara-is-", "", $url_param);
                            //получаем название типа 
                            if (!empty($type_id)) {        
                                $type = CIBlockPropertyEnum::GetList(array(), array("EXTERNAL_ID" => $type_id))->Fetch();    
                                //если нашли название типа и в данный момент мы не в корне каталога
                                if ($type["VALUE"] && $arCurSection['ID'] > 0) {?>
                                <div class="filter_view_all_products">
                                    <a href="/catalog/filter/<?=$url_param?>/apply/"><?=GetMessage("SHOW_ALL_PRODUCTS_BY_TYPE")?> "<?=$type["VALUE"]?>"</a>
                                </div>    
                                <?}
                            }    
                        }
                    }                      
                }
            ?>                

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

                        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
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
                        'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
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
<!--viewedElementBlock-->
<!--jcarousel-->
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.viewed.products", 
	"section_viewed", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADDITIONAL_PICT_PROP_5" => "MORE_PHOTO",
		"ADDITIONAL_PICT_PROP_6" => "MORE_PHOTO",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CART_PROPERTIES_5" => array(
			0 => "",
			1 => "",
		),
		"CART_PROPERTIES_6" => array(
			0 => "",
			1 => "",
		),
		"CONVERT_CURRENCY" => "N",
		"DEPTH" => "",
		"DETAIL_URL" => "",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "1c_catalog",
		"LABEL_PROP_5" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"OFFER_TREE_PROPS_6" => array(
			0 => "OBYEM",
			1 => "SEMNAYA_PEREDNYAYA_STENKA",
			2 => "MAKSIMALNYY_ROST",
			3 => "SILIKONOVYE_NAKLADKI",
			4 => "VYNIMAYUSHCHIESYA_REYKI",
			5 => "SLIV",
			6 => "TSVET",
			7 => "RAZMER",
			8 => "CML2_MANUFACTURER",
			9 => "SHASSI",
			10 => "LYULKA",
			11 => "PROGULOCHNYY_BLOK",
			12 => "AVTOKRESLO",
			13 => "KOLICHESTVO_STVOROK",
			14 => "KOLICHESTVO_VERTIKALNYKH_OTDELENIY",
			15 => "STRANA_BRENDA",
			16 => "STRANA_PROIZVODITEL",
			17 => "SHTANGA_DLYA_PLECHIKOV",
			18 => "VNUTRENNIE_POLKI",
			19 => "OTKRYTYE_POLKI",
			20 => "TIP_KROVATI",
			21 => "VYDVIZHNYE_YASHCHIKI",
			22 => "RAZMER_SPALNOGO_MESTA",
			23 => "DOVODCHIKI_VYDVIZHNYKH_YASHCHIKOV",
			24 => "MATERIAL",
			25 => "MEKHANIZM_KACHANIYA",
			26 => "VIDY_TRANSFORMATSII",
			27 => "VOZRAST_MES",
			28 => "KOLICHESTVO_UROVNEY_LOZHA",
			29 => "OPUSKAYUSHCHAYASYA_PEREDNYAYA_STENKA",
			30 => "KOLESA",
			31 => "RAZMER_SPALNOGO_MESTA_DKHSH_SM",
			32 => "YASHCHIKI_POD_KROVATYU",
			33 => "DOVODCHIKI_YASHCHIKOV_POD_KROVATYU",
			34 => "SOSTAV_KOMPLEKTA",
			35 => "VSTROENNYY_KOMOD",
			36 => "PODUSHKA",
			37 => "GABARITY_VSTROENNOGO_KOMODA",
			38 => "SOSTAV",
			39 => "YASHIKI_V_KOMODE",
			40 => "DOVODCHIKI_YASHCHIKOV_KOMODA",
			41 => "OTKRYTYE_POLKI_V_KOMODE",
			42 => "KOLICHESTVO_CHASTEY_BORTIKOV",
			43 => "SEMNYY_CHEKHOL_U_ZASHCHITNYKH_BORTIKOV",
			44 => "GARANTIYA_PROIZVODITELYA",
			45 => "POL",
			46 => "MATERIAL_1",
			47 => "RAZMER_DLYA_KROVATKI_DKHSH_SM",
			48 => "VOZRAST",
			49 => "VYSOTA_MATRASA",
			50 => "GARANTIYA_PROIZVODITELYA_1",
			51 => "PRUZHINY_SISTEMA_BONNEL",
			52 => "NEZAVISIMYE_PRUZHINY",
			53 => "TIP_KOMODA",
			54 => "KOLICHESTVO_PRUZHIN_NA_M2",
			55 => "OTKIDNOY_PELENALNYY_STOLIK",
			56 => "ZHESTKIE_KRAYA_MATRASA",
			57 => "VANNOCHKA",
			58 => "STORONY_ZIMA_LETO",
			59 => "RAZNAYA_ZHESTKOST_STORON",
			60 => "OTKRYTYE_POLKI_1",
			61 => "SEMNYY_CHEKHOL",
			62 => "MATERIAL_CHEKHLA",
			63 => "NALICHIE_KOLESIKOV",
			64 => "SISTEMA_VENTILYATSII",
			65 => "ZASHCHITA_OT_PROMOKANIYA",
			66 => "AROMATIZIROVANNYE_KAPSULY",
			67 => "BREND",
		),
		"PAGE_ELEMENT_COUNT" => "20",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "Рекомендованная Для сайта",
			1 => "Оптовая 1 Для сайта",
			2 => "Оптовая 2 Для сайта",
			3 => "Оптовая 3 Для сайта",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE_5" => array(
			0 => "",
			1 => "CML2_LINK",
			2 => "ARTIKUL_KHARAKTERISTIKI",
			3 => "TSVET",
			4 => "CML2_ARTICLE",
			5 => "CML2_BASE_UNIT",
			6 => "MORE_PHOTO",
			7 => "CML2_MANUFACTURER",
			8 => "CML2_TRAITS",
			9 => "CML2_TAXES",
			10 => "FILES",
			11 => "CML2_ATTRIBUTES",
			12 => "CML2_BAR_CODE",
			13 => "MODEL",
			14 => "BREND",
			15 => "",
		),
		"PROPERTY_CODE_6" => array(
			0 => "",
			1 => "CML2_LINK",
			2 => "ARTIKUL_KHARAKTERISTIKI",
			3 => "TSVET",
			4 => "CML2_ARTICLE",
			5 => "CML2_BASE_UNIT",
			6 => "MORE_PHOTO",
			7 => "CML2_MANUFACTURER",
			8 => "CML2_TRAITS",
			9 => "CML2_TAXES",
			10 => "FILES",
			11 => "CML2_ATTRIBUTES",
			12 => "CML2_BAR_CODE",
			13 => "MODEL",
			14 => "BREND",
			15 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_ELEMENT_CODE" => "",
		"SECTION_ELEMENT_ID" => "",
		"SECTION_ID" => "",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_IMAGE" => "Y",
		"SHOW_NAME" => "Y",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_PRODUCTS_5" => "Y",
		"TEMPLATE_THEME" => "blue",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "section_viewed"
	),
	false
);?>

<!--END viewedElementBlock-->

<script>
    //section id for catalog menu
    <?if ($arCurSection['ID'] > 0) {?>
        section_id = <?=$arCurSection['ID']?>;
        <?}?>
</script>
