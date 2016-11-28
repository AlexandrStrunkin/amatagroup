<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("�����");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news",
	"news_without_tabs",
	array(
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "NAME",
			1 => "DETAIL_TEXT",
			2 => "DETAIL_PICTURE",
			3 => "DATE_ACTIVE_FROM",
			4 => "DATE_ACTIVE_TO",
			5 => "DATE_CREATE",
			6 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "N",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "��������",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "27",
		"IBLOCK_TYPE" => "news",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DATE_ACTIVE_FROM",
			4 => "DATE_ACTIVE_TO",
			5 => "DATE_CREATE",
			6 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "9999",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "�������",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"COMPONENT_TEMPLATE" => "news_without_tabs",
		"SEF_FOLDER" => "/promo/",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?>

<div class="backgroundColor">
    <!--widthWrapper-->
    <div class="widthWrapper">
        <!--productBlockWrapper-->
        <div class="productBlockWrapper">
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
                <?$APPLICATION->IncludeComponent("bitrix:catalog.section", "product_news_promo", Array(
	"ACTION_VARIABLE" => "action",	// �������� ����������, � ������� ���������� ��������
		"ADD_PICT_PROP" => "-",	// �������������� �������� ��������� ������
		"ADD_PROPERTIES_TO_BASKET" => "Y",	// ��������� � ������� �������� ������� � �����������
		"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
		"ADD_TO_BASKET_ACTION" => "ADD",	// ���������� ������ ���������� � ������� ��� �������
		"AJAX_MODE" => "N",	// �������� ����� AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
		"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
		"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
		"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
		"BACKGROUND_IMAGE" => "-",	// ���������� ������� �������� ��� ������� �� ��������
		"BASKET_URL" => "/personal/basket.php",	// URL, ������� �� �������� � �������� ����������
		"BROWSER_TITLE" => "-",	// ���������� ��������� ���� �������� �� ��������
		"CACHE_FILTER" => "N",	// ���������� ��� ������������� �������
		"CACHE_GROUPS" => "Y",	// ��������� ����� �������
		"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
		"CACHE_TYPE" => "A",	// ��� �����������
		"CONVERT_CURRENCY" => "N",	// ���������� ���� � ����� ������
		"DETAIL_URL" => "/catalog/#ELEMENT_CODE#/",	// URL, ������� �� �������� � ���������� �������� �������
		"DISABLE_INIT_JS_IN_COMPONENT" => "Y",	// �� ���������� js-���������� � ����������
		"DISPLAY_BOTTOM_PAGER" => "N",	// �������� ��� �������
		"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
		"ELEMENT_SORT_FIELD" => "rand",	// �� ������ ���� ��������� ��������
		"ELEMENT_SORT_FIELD2" => "id",	// ���� ��� ������ ���������� ���������
		"ELEMENT_SORT_ORDER" => "date_create",	// ������� ���������� ���������
		"ELEMENT_SORT_ORDER2" => "desc",	// ������� ������ ���������� ���������
		"FILTER_NAME" => "ShowWithImage",	// ��� ������� �� ���������� ������� ��� ���������� ���������
		"HIDE_NOT_AVAILABLE" => "Y",	// ������, �� ��������� ��� �������
		"IBLOCK_ID" => "5",	// ��������
		"IBLOCK_TYPE" => "1c_catalog",	// ��� ���������
		"INCLUDE_SUBSECTIONS" => "Y",	// ���������� �������� ����������� �������
		"LABEL_PROP" => "-",	// �������� ����� ������
		"LINE_ELEMENT_COUNT" => "4",	// ���������� ��������� ��������� � ����� ������ �������
		"MESSAGE_404" => "",	// ��������� ��� ������ (�� ��������� �� ����������)
		"MESS_BTN_ADD_TO_BASKET" => "� �������",	// ����� ������ "�������� � �������"
		"MESS_BTN_BUY" => "������",	// ����� ������ "������"
		"MESS_BTN_DETAIL" => "���������",	// ����� ������ "���������"
		"MESS_BTN_SUBSCRIBE" => "�����������",	// ����� ������ "��������� � �����������"
		"MESS_NOT_AVAILABLE" => "��� � �������",	// ��������� �� ���������� ������
		"META_DESCRIPTION" => "-",	// ���������� �������� �������� �� ��������
		"META_KEYWORDS" => "-",	// ���������� �������� ����� �������� �� ��������
		"OFFERS_CART_PROPERTIES" => "",	// �������� �����������, ����������� � �������
		"OFFERS_FIELD_CODE" => array(	// ���� �����������
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "15",	// ������������ ���������� ����������� ��� ������ (0 - ���)
		"OFFERS_PROPERTY_CODE" => array(	// �������� �����������
			0 => "",
			1 => "",
		),
		"OFFERS_SORT_FIELD" => "rand",	// �� ������ ���� ��������� ����������� ������
		"OFFERS_SORT_FIELD2" => "id",	// ���� ��� ������ ���������� ����������� ������
		"OFFERS_SORT_ORDER" => "asc",	// ������� ���������� ����������� ������
		"OFFERS_SORT_ORDER2" => "desc",	// ������� ������ ���������� ����������� ������
		"PAGER_BASE_LINK_ENABLE" => "N",	// �������� ��������� ������
		"PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
		"PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
		"PAGER_SHOW_ALWAYS" => "N",	// �������� ������
		"PAGER_TEMPLATE" => ".default",	// ������ ������������ ���������
		"PAGER_TITLE" => "������",	// �������� ���������
		"PAGE_ELEMENT_COUNT" => "8",	// ���������� ��������� �� ��������
		"PARTIAL_PRODUCT_PROPERTIES" => "N",	// ��������� ��������� � ������� ������, � ������� ��������� �� ��� ��������������
		"PRICE_CODE" => array(	// ��� ����
			0 => "������� 1 ��� �����",
		),
		"PRICE_VAT_INCLUDE" => "Y",	// �������� ��� � ����
		"PRODUCT_DISPLAY_MODE" => "N",	// ����� �����������
		"PRODUCT_ID_VARIABLE" => "id",	// �������� ����������, � ������� ���������� ��� ������ ��� �������
		"PRODUCT_PROPERTIES" => "",	// �������������� ������
		"PRODUCT_PROPS_VARIABLE" => "prop",	// �������� ����������, � ������� ���������� �������������� ������
		"PRODUCT_QUANTITY_VARIABLE" => "",	// �������� ����������, � ������� ���������� ���������� ������
		"PRODUCT_SUBSCRIPTION" => "N",	// ��������� ���������� ��� ������������� �������
		"PROPERTY_CODE" => array(	// ��������
			0 => "",
			1 => "",
		),
		"SECTION_CODE" => "",	// ��� �������
		"SECTION_CODE_PATH" => "",	// ���� �� ���������� ����� �������
		"SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID �������
		"SECTION_ID_VARIABLE" => "SECTION_ID",	// �������� ����������, � ������� ���������� ��� ������
		"SECTION_URL" => "/catalog/news_product/",	// URL, ������� �� �������� � ���������� �������
		"SECTION_USER_FIELDS" => array(	// �������� �������
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "Y",	// �������� ��������� ���
		"SEF_RULE" => "",	// ������� ��� ���������
		"SET_BROWSER_TITLE" => "Y",	// ������������� ��������� ���� ��������
		"SET_LAST_MODIFIED" => "N",	// ������������� � ���������� ������ ����� ����������� ��������
		"SET_META_DESCRIPTION" => "Y",	// ������������� �������� ��������
		"SET_META_KEYWORDS" => "Y",	// ������������� �������� ����� ��������
		"SET_STATUS_404" => "N",	// ������������� ������ 404
		"SET_TITLE" => "Y",	// ������������� ��������� ��������
		"SHOW_404" => "N",	// ����� ����������� ��������
		"SHOW_ALL_WO_SECTION" => "Y",	// ���������� ��� ��������, ���� �� ������ ������
		"SHOW_CLOSE_POPUP" => "N",	// ���������� ������ ����������� ������� �� ����������� �����
		"SHOW_DISCOUNT_PERCENT" => "N",	// ���������� ������� ������
		"SHOW_OLD_PRICE" => "N",	// ���������� ������ ����
		"SHOW_PRICE_COUNT" => "1",	// �������� ���� ��� ����������
		"TEMPLATE_THEME" => "blue",	// �������� ����
		"USE_MAIN_ELEMENT_SECTION" => "N",	// ������������ �������� ������ ��� ������ ��������
		"USE_PRICE_COUNT" => "N",	// ������������ ����� ��� � �����������
		"USE_PRODUCT_QUANTITY" => "N",	// ��������� �������� ���������� ������
		"COMPONENT_TEMPLATE" => "product_news"
	),
	false
);?>
            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>