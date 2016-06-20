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

    if (!isset($arParams['FILTER_VIEW_MODE']) || (string)$arParams['FILTER_VIEW_MODE'] == '')
        $arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
    $arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

    $isVerticalFilter = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");
    $isSidebar = ($arParams["SIDEBAR_SECTION_SHOW"] == "Y" && isset($arParams["SIDEBAR_PATH"]) && !empty($arParams["SIDEBAR_PATH"]));
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

?>


<div class="catalogElementsBlock">
    <div class="widthWrapper">

        <!--horizontalFilterWrap-->
        <div class="horizontalFilterWrap">
            <div class="productFilterWrap">
                <p class="activeTopLeftBut"><?=GetMessage("CATALOG_FILTER")?></p>
            </div>
            <div class="sortingWrap">  
                <p><?=GetMessage("ORDER_BY")?></p>  

                <div class="firstFilter">                      
                    <?getCatalogOptionBlock("ELEMENT_SORT_FIELD"); //sets in init.php?>                    
                </div>

                <div class="secondFilter">            
                    <?getCatalogOptionBlock("ELEMENT_SORT_ORDER"); //sets in init.php?>     
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
                        "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
                        "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "DISPLAY_ELEMENT_COUNT" => "Y",
                        "POPUP_POSITION" => "right"
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );?>
            <!--END leftFiltersBlock-->


            <!--elementBlocksWrap-->

            <? 
                if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
                    $basketAction = (isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '');
                else
                    $basketAction = (isset($arParams['SECTION_ADD_TO_BASKET_ACTION']) ? $arParams['SECTION_ADD_TO_BASKET_ACTION'] : '');

                $intSectionID = 0;

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
<div class="viewedElementBlock">
    <div class="widthWrapper">
        <!--viewedBlock-->
        <div class="viewedBlock productCarousel elmentsList">
            <h2>Просмотренные товары</h2>
            <!--jcarousel-wrapper-->
            <div class="jcarousel-wrapper">
                <!--jcarousel-->
                <div class="jcarousel ">
					<?$APPLICATION->IncludeComponent("bitrix:catalog.viewed.products", "section_viewed", Array(
						"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
							"ADDITIONAL_PICT_PROP_5" => "MORE_PHOTO",	// Дополнительная картинка
							"ADDITIONAL_PICT_PROP_6" => "MORE_PHOTO",	// Дополнительная картинка
							"ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
							"BASKET_URL" => "/personal/basket.php",	// URL, ведущий на страницу с корзиной покупателя
							"CACHE_GROUPS" => "Y",	// Учитывать права доступа
							"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
							"CACHE_TYPE" => "A",	// Тип кеширования
							"CART_PROPERTIES_5" => array(	// Свойства для добавления в корзину
								0 => "",
								1 => "",
							),
							"CART_PROPERTIES_6" => array(	// Свойства для добавления в корзину
								0 => "",
								1 => "",
							),
							"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
							"DEPTH" => "",	// Максимальная отображаемая глубина разделов
							"DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
							"HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
							"IBLOCK_ID" => "5",	// Инфоблок
							"IBLOCK_TYPE" => "1c_catalog",	// Тип инфоблока
							"LABEL_PROP_5" => "-",	// Свойство меток товара
							"LINE_ELEMENT_COUNT" => "3",	// Количество элементов, выводимых в одной строке
							"MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
							"MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
							"MESS_BTN_SUBSCRIBE" => "Подписаться",	// Текст кнопки "Уведомить о поступлении"
							"OFFER_TREE_PROPS_6" => array(	// Свойства для отбора предложений
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
							"PAGE_ELEMENT_COUNT" => "5",	// Количество элементов на странице
							"PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить частично заполненные свойства
							"PRICE_CODE" => array(	// Тип цены
								0 => "Оптовая 1 Для сайта",
							),
							"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
							"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
							"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
							"PRODUCT_QUANTITY_VARIABLE" => "",	// Название переменной, в которой передается количество товара
							"PRODUCT_SUBSCRIPTION" => "N",	// Разрешить оповещения для отсутствующих товаров
							"PROPERTY_CODE_5" => array(	// Свойства для отображения
								0 => "CML2_LINK",
								1 => "ARTIKUL_KHARAKTERISTIKI",
								9 => "TSVET",
								13 => "CML2_ARTICLE",
								14 => "CML2_BASE_UNIT",
								15 => "MORE_PHOTO",
								17 => "CML2_MANUFACTURER",
								18 => "CML2_TRAITS",
								19 => "CML2_TAXES",
								20 => "FILES",
								21 => "CML2_ATTRIBUTES",
								23 => "CML2_BAR_CODE",
								35 => "MODEL",
								106 => "BREND",
							),
							"PROPERTY_CODE_6" => array(	// Свойства для отображения
								0 => "CML2_LINK",
								1 => "ARTIKUL_KHARAKTERISTIKI",
								9 => "TSVET",
								13 => "CML2_ARTICLE",
								14 => "CML2_BASE_UNIT",
								15 => "MORE_PHOTO",
								17 => "CML2_MANUFACTURER",
								18 => "CML2_TRAITS",
								19 => "CML2_TAXES",
								20 => "FILES",
								21 => "CML2_ATTRIBUTES",
								23 => "CML2_BAR_CODE",
								35 => "MODEL",
								106 => "BREND",
							),
							"SECTION_CODE" => "",	// Код раздела
							"SECTION_ELEMENT_CODE" => "",	// Символьный код элемента, для которого будет выбран раздел
							"SECTION_ELEMENT_ID" => "",	// ID элемента, для которого будет выбран раздел
							"SECTION_ID" => "",	// ID раздела
							"SHOW_DISCOUNT_PERCENT" => "Y",	// Показывать процент скидки
							"SHOW_FROM_SECTION" => "N",	// Показывать товары из раздела
							"SHOW_IMAGE" => "Y",	// Показывать изображение
							"SHOW_NAME" => "Y",	// Показывать название
							"SHOW_OLD_PRICE" => "Y",	// Показывать старую цену
							"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
							"SHOW_PRODUCTS_5" => "Y",	// Показывать товары каталога
							"TEMPLATE_THEME" => "blue",	// Цветовая тема
							"USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
						),
						false
					);?>
                </div>
                <a href="" class="jcarousel-control-prev"></a>
                <a href="" class="jcarousel-control-next"></a>

            </div>
            <!--END jcarousel-wrapper-->
        </div>
        <!--END viewedBlock-->
    </div>
</div>
<!--END viewedElementBlock-->