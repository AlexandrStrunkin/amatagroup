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
                    <div class="active" data-id='1'><?=GetMessage('NEWS')?></div>
                    <div data-id='2'><?=GetMessage('BESTSELLERS')?></div>
                    <div data-id='3'><?=GetMessage('LATEST')?></div>
                </div>

                <div class="newsBlock">

                     <?arshow($arrFilter)?>
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
	                        "FILTER_NAME" => "arrFilter",
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
	                        "PAGER_TITLE" => "Товары",
	                        "PAGE_ELEMENT_COUNT" => "8",
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
	                        "COMPONENT_TEMPLATE" => "product_news"
                        ),
                        false
                        );?>
                      <?
                      global $arFilter;
                      $arFilter = array('!PROPERTY_BESTSELLERS' => false);
                      ?>
                    <?$APPLICATION->IncludeComponent("bitrix:catalog.section", "bestsellers", Array(
	                        "ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
		                    "ADD_PICT_PROP" => "-",	// Дополнительная картинка основного товара
		                    "ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
		                    "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		                    "ADD_TO_BASKET_ACTION" => "ADD",	// Показывать кнопку добавления в корзину или покупки
		                    "AJAX_MODE" => "N",	// Включить режим AJAX
		                    "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		                    "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		                    "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		                    "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		                    "BACKGROUND_IMAGE" => "-",	// Установить фоновую картинку для шаблона из свойства
		                    "BASKET_URL" => "/personal/basket.php",	// URL, ведущий на страницу с корзиной покупателя
		                    "BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
		                    "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		                    "CACHE_GROUPS" => "Y",	// Учитывать права доступа
		                    "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		                    "CACHE_TYPE" => "A",	// Тип кеширования
		                    "CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
		                    "DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
		                    "DISABLE_INIT_JS_IN_COMPONENT" => "Y",	// Не подключать js-библиотеки в компоненте
		                    "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		                    "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		                    "ELEMENT_SORT_FIELD" => "create",	// По какому полю сортируем элементы
		                    "ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
		                    "ELEMENT_SORT_ORDER" => "desc",	// Порядок сортировки элементов
		                    "ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
		                    "FILTER_NAME" => "arFilter",	// Имя массива со значениями фильтра для фильтрации элементов
		                    "HIDE_NOT_AVAILABLE" => "Y",	// Не отображать товары, которых нет на складах
		                    "IBLOCK_ID" => "5",	// Инфоблок
		                    "IBLOCK_TYPE" => "1c_catalog",	// Тип инфоблока
		                    "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		                    "LABEL_PROP" => "-",	// Свойство меток товара
		                    "LINE_ELEMENT_COUNT" => "4",	// Количество элементов выводимых в одной строке таблицы
		                    "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		                    "MESS_BTN_ADD_TO_BASKET" => "В корзину",	// Текст кнопки "Добавить в корзину"
		                    "MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
		                    "MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
		                    "MESS_BTN_SUBSCRIBE" => "Подписаться",	// Текст кнопки "Уведомить о поступлении"
		                    "MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
		                    "META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		                    "META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		                    "OFFERS_CART_PROPERTIES" => "",	// Свойства предложений, добавляемые в корзину
		                    "OFFERS_FIELD_CODE" => array(	// Поля предложений
			                    0 => "",
			                    1 => "",
		                    ),
		                    "OFFERS_LIMIT" => "15",	// Максимальное количество предложений для показа (0 - все)
		                    "OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
			                    0 => "",
			                    1 => "",
		                    ),
		                    "OFFERS_SORT_FIELD" => "create",	// По какому полю сортируем предложения товара
		                    "OFFERS_SORT_FIELD2" => "id",	// Поле для второй сортировки предложений товара
		                    "OFFERS_SORT_ORDER" => "asc",	// Порядок сортировки предложений товара
		                    "OFFERS_SORT_ORDER2" => "desc",	// Порядок второй сортировки предложений товара
		                    "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		                    "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		                    "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		                    "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		                    "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		                    "PAGER_TITLE" => "Товары",	// Название категорий
		                    "PAGE_ELEMENT_COUNT" => "8",	// Количество элементов на странице
		                    "PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
		                    "PRICE_CODE" => array(	// Тип цены
			                    0 => "Оптовая 1 Для сайта",
		                    ),
		                    "PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
		                    "PRODUCT_DISPLAY_MODE" => "N",	// Схема отображения
		                    "PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
		                    "PRODUCT_PROPERTIES" => "",	// Характеристики товара
		                    "PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
		                    "PRODUCT_QUANTITY_VARIABLE" => "",	// Название переменной, в которой передается количество товара
		                    "PRODUCT_SUBSCRIPTION" => "N",	// Разрешить оповещения для отсутствующих товаров
		                    "PROPERTY_CODE" => array(	// Свойства
			                    0 => "BESTSELLERS",
			                    1 => "",
		                    ),
		                    "SECTION_CODE" => "",	// Код раздела
		                    "SECTION_CODE_PATH" => "",	// Путь из символьных кодов раздела
		                    "SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
		                    "SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
		                    "SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		                    "SECTION_USER_FIELDS" => array(	// Свойства раздела
			                    0 => "",
			                    1 => "",
		                    ),
		                    "SEF_MODE" => "Y",	// Включить поддержку ЧПУ
		                    "SEF_RULE" => "",	// Правило для обработки
		                    "SET_BROWSER_TITLE" => "Y",	// Устанавливать заголовок окна браузера
		                    "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		                    "SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
		                    "SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
		                    "SET_STATUS_404" => "N",	// Устанавливать статус 404
		                    "SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		                    "SHOW_404" => "N",	// Показ специальной страницы
		                    "SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
		                    "SHOW_CLOSE_POPUP" => "N",	// Показывать кнопку продолжения покупок во всплывающих окнах
		                    "SHOW_DISCOUNT_PERCENT" => "N",	// Показывать процент скидки
		                    "SHOW_OLD_PRICE" => "N",	// Показывать старую цену
		                    "SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
		                    "TEMPLATE_THEME" => "blue",	// Цветовая тема
		                    "USE_MAIN_ELEMENT_SECTION" => "N",	// Использовать основной раздел для показа элемента
		                    "USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
		                    "USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
		                    "COMPONENT_TEMPLATE" => "blocks"
	                    ),
	                    false
                    );?>

                     <?
                      global $arFilter;
                     // $arFilter = array('!PROPERTY_BESTSELLERS' => false);
                      ?>
                    <?$APPLICATION->IncludeComponent(
	                    "bitrix:catalog.section",
	                    "latest",
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
		                    "ELEMENT_SORT_FIELD" => "timestamp_x",
		                    "ELEMENT_SORT_FIELD2" => "id",
		                    "ELEMENT_SORT_ORDER" => "desc",
		                    "ELEMENT_SORT_ORDER2" => "desc",
		                    "FILTER_NAME" => "arFilter",
		                    "HIDE_NOT_AVAILABLE" => "L",
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
			                    0 => "",
			                    1 => "",
		                    ),
		                    "OFFERS_LIMIT" => "15",
		                    "OFFERS_PROPERTY_CODE" => array(
			                    0 => "",
			                    1 => "",
		                    ),
		                    "OFFERS_SORT_FIELD" => "timestamp_x",
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
			                    0 => "BESTSELLERS",
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
		                    "COMPONENT_TEMPLATE" => "latest"
	                    ),
	                    false
                    );?>


                </div>

                <div class="hitsBlock">

                </div>

                <div class="lastProdBlock">

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
		                "PAGER_TITLE" => "Бренды",
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
                <p class="partnerTitle">Отзывы партнеров</p>

                <p class="partnerText">За 10 лет работы на рынке мы зарекомендовали себя</p>


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
                    <p class="confidensTitle">Нам доверяют</p>
                    <p class="confidensText">За 10 лет работы на рынке мы зарекомендовали себя, как надежного
                        партнера.</p>
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
									"PAGER_TITLE" => "Новости",
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

