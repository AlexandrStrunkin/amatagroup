<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    IncludeTemplateLangFile(__FILE__);
    CJSCore::Init(array("fx"));
    $curPage = $APPLICATION->GetCurPage(true);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>

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
            </div>
            <p class="blockTitle"><?=GetMessage('TEXT_TOP')?></p>
            <div class="newsBlock">
                <?
                  global $ShowWithImage;
                  $curr_date = mktime(date('d.m.Y G:i:s'));
                  $date_create_date = $curr_date - (604800 * 2);
                  $ShowWithImage[] = array(
                     //   ">DATE_CREATE" => date('d.m.Y H:i:s', $date_create_date),
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
		                "DETAIL_URL" => "",
		                "DISABLE_INIT_JS_IN_COMPONENT" => "Y",
		                "DISPLAY_BOTTOM_PAGER" => "N",
		                "DISPLAY_TOP_PAGER" => "N",
		                "ELEMENT_SORT_FIELD" => "date_create",
		                "ELEMENT_SORT_FIELD2" => "id",
		                "ELEMENT_SORT_ORDER" => "desc",
		                "ELEMENT_SORT_ORDER2" => "desc",
		                "FILTER_NAME" => "ShowWithImage",
		                "HIDE_NOT_AVAILABLE" => "Y",
		                "IBLOCK_ID" => "5",
		                "IBLOCK_TYPE" => "1c_catalog",
		                "INCLUDE_SUBSECTIONS" => "Y",
		                "LABEL_PROP" => "-",
		                "LINE_ELEMENT_COUNT" => "4",
		                "MESSAGE_404" => "",
		                "MESS_BTN_ADD_TO_BASKET" => "� �������",
		                "MESS_BTN_BUY" => "������",
		                "MESS_BTN_DETAIL" => "���������",
		                "MESS_BTN_SUBSCRIBE" => "�����������",
		                "MESS_NOT_AVAILABLE" => "��� � �������",
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
		                "PAGER_TITLE" => "������",
		                "PAGE_ELEMENT_COUNT" => "8",
		                "PARTIAL_PRODUCT_PROPERTIES" => "N",
		                "PRICE_CODE" => array(
			                0 => "������� 1 ��� �����",
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
		                "SECTION_URL" => "/catalog/news_product/",
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
		                "COMPONENT_TEMPLATE" => "product_news"
	                ),
	                false
                );?>
                <?
                    global $arFilter;
                    $arFilter = array('!PROPERTY_BESTSELLERS' => false);
                ?>
                <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"bestsellers",
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
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "create",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arFilter",
		"HIDE_NOT_AVAILABLE" => "Y",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "1c_catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "4",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "� �������",
		"MESS_BTN_BUY" => "������",
		"MESS_BTN_DETAIL" => "���������",
		"MESS_BTN_SUBSCRIBE" => "�����������",
		"MESS_NOT_AVAILABLE" => "��� � �������",
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
		"PAGER_TITLE" => "������",
		"PAGE_ELEMENT_COUNT" => "8",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "������� 1 ��� �����",
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
			0 => "BESTSELLERS",
			1 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "/catalog/latest_product/",
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
		"COMPONENT_TEMPLATE" => "bestsellers"
	),
	false
);?>

                <ul class="productList" id="productList3">
                    <li>
                        <div class="productWrapper">
                            <p class="price">25 800<span class="rub">c</span></p>
                            <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product1.jpg" alt=""/></a>

                            <div>
                                <a href="" class="productName">������� �������� ������ ����������</a>

                                <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                </div>
                            </div>
                            <div class="newProductWrapper">�������</div>
                        </div>
                    </li>
                    <li>
                        <div class="productWrapper">
                            <p class="price">25 800<span class="rub">c</span></p>
                            <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product2.jpg" alt=""/></a>

                            <div>
                                <a href="" class="productName">������� �������� ������ ����������</a>

                                <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                </div>
                            </div>
                            <div class="newProductWrapper">�������</div>
                        </div>
                    </li>
                    <li>
                        <div class="productWrapper">
                            <p class="price">25 800<span class="rub">c</span></p>
                            <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product3.jpg" alt=""/></a>

                            <div>
                                <a href="" class="productName">������� �������� ������ ����������</a>

                                <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                </div>
                            </div>
                            <div class="newProductWrapper">�������</div>
                        </div>
                    </li>
                    <li>
                        <div class="productWrapper">
                            <p class="price">25 800<span class="rub">c</span></p>
                            <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product4.jpg" alt=""/></a>

                            <div>
                                <a href="" class="productName">������� �������� ������ ����������</a>

                                <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                </div>
                            </div>
                            <div class="newProductWrapper">�������</div>
                        </div>
                    </li>
                    <li>
                        <div class="productWrapper">
                            <p class="price">25 800<span class="rub">c</span></p>
                            <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product5.jpg" alt=""/></a>

                            <div>
                                <a href="" class="productName">������� �������� ������ ����������</a>

                                <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                </div>
                            </div>
                            <div class="newProductWrapper">�������</div>
                        </div>
                    </li>
                    <li>
                        <div class="productWrapper">
                            <p class="price">25 800<span class="rub">c</span></p>
                            <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product6.jpg" alt=""/></a>

                            <div>
                                <a href="" class="productName">������� �������� ������ ����������</a>

                                <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                </div>
                            </div>
                            <div class="newProductWrapper">�������</div>
                        </div>
                    </li>
                    <li>
                        <div class="productWrapper">
                            <p class="price">25 800<span class="rub">c</span></p>
                            <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product7.jpg" alt=""/></a>

                            <div>
                                <a href="" class="productName">������� �������� ������ ����������</a>

                                <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                </div>
                            </div>
                            <div class="newProductWrapper">�������</div>
                        </div>
                    </li>
                    <li>
                        <div class="productWrapper">
                            <p class="price">25 800<span class="rub">c</span></p>
                            <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product7.jpg" alt=""/></a>

                            <div>
                                <a href="" class="productName">������� �������� ������ ����������</a>

                                <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                </div>
                            </div>
                            <div class="newProductWrapper">�������</div>
                        </div>
                    </li>


                </ul>

            </div>

            <div class="hitsBlock">

            </div>

            <div class="lastProdBlock">

            </div>


        </div>
        <!--END productBlockWrapper-->
        <!--brandsWrapper-->
        <div class="brandsWrapper">

            <p class="brandTitle"><a href="/brands/">������</a></p>

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
            <?$Filter_brands[">PREVIEW_PICTURE"] = 0;?>
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
                        "DETAIL_URL" => "",
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
                        "PAGER_TITLE" => "������",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array(
                            0 => "MAIN_DISPLAY",
                            1 => "",
                        ),
                        "SET_BROWSER_TITLE" => "Y",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "Y",
                        "SET_META_KEYWORDS" => "Y",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "Y",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "NAME",
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
                <p class="partnerTitle">������ ���������</p>

                <p class="partnerText">�� 10 ��� ������ �� ����� �� ��������������� ����</p>


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
                            "PAGER_TITLE" => "�������",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(
                                0 => "CITY",
                                1 => "POSITION",
                                2 => "AUTHOR",
                                3 => "COMPANY",
                                4 => "",
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
                    <p class="confidensTitle">��� ��������</p>
                    <p class="confidensText">�� 10 ��� ������ �� ����� �� ��������������� ����, ��� ���������
                        ��������.</p>
                    <div class="confidens_container">
                        <div class="previews_slider_navigation_arrow confidens_slider_arrow" data-preview-slider-direction="prev"><span></span></div>
                        <div class="previews_slider_navigation_arrow confidens_slider_arrow" data-preview-slider-direction="next"><span></span></div>
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
                                        "DETAIL_URL" => "",
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
                                        "PAGER_TITLE" => "�������",
                                        "PARENT_SECTION" => "",
                                        "PARENT_SECTION_CODE" => "",
                                        "PREVIEW_TRUNCATE_LEN" => "",
                                        "PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                            2 => "",
                                            3 => "",
                                            4 => "",
                                            5 => "",
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

