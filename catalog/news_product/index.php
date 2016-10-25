<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$[filter]View = (COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID) == "eshop_adapt_vertical" ? "HORIZONTAL" : "VERTICAL");
?>
<?
  global $arrFilter;
  $curr_date = mktime(date('d.m.Y G:i:s'));
  $date_create_date = $curr_date - (604800 * 2);
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
    <?$APPLICATION->IncludeComponent("bitrix:catalog", "catalog_new_product", Array(
	"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
		"IBLOCK_ID" => "5",	// Инфоблок
		"TEMPLATE_THEME" => "site",	// Цветовая тема
		"HIDE_NOT_AVAILABLE" => "L",	// Товары, не доступные для покупки
		"BASKET_URL" => "/personal/cart/",	// URL, ведущий на страницу с корзиной покупателя
		"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
		"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
		"SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
		"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
		"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
		"SEF_FOLDER" => "/catalog/news_product/",	// Каталог ЧПУ (относительно корня сайта)
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"ADD_SECTION_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",	// Включать название элемента в цепочку навигации
		"SET_STATUS_404" => "Y",	// Устанавливать статус 404
		"DETAIL_DISPLAY_NAME" => "N",	// Выводить название элемента
		"USE_ELEMENT_COUNTER" => "Y",	// Использовать счетчик просмотров
		"USE_FILTER" => "Y",	// Показывать фильтр
		"FILTER_NAME" => "arrFilter",	// Фильтр
		"FILTER_VIEW_MODE" => "VERTICAL",	// Вид отображения умного фильтра
		"FILTER_FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "",
		),
		"FILTER_PRICE_CODE" => "",	// Тип цены
		"FILTER_OFFERS_FIELD_CODE" => array(	// Поля предложений
			0 => "",
			1 => "",
		),
		"FILTER_OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
			0 => "",
			1 => "",
		),
		"USE_REVIEW" => "N",	// Разрешить отзывы
		"MESSAGES_PER_PAGE" => "10",
		"USE_CAPTCHA" => "Y",
		"REVIEW_AJAX_POST" => "Y",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"FORUM_ID" => "1",
		"URL_TEMPLATES_READ" => "",
		"SHOW_LINK_TO_FORUM" => "Y",
		"USE_COMPARE" => "N",	// Разрешить сравнение товаров
		"PRICE_CODE" => "",	// Тип цены
		"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
		"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
		"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
		"PRICE_VAT_SHOW_VALUE" => "N",	// Отображать значение НДС
		"PRODUCT_PROPERTIES" => "",	// Характеристики товара, добавляемые в корзину
		"USE_PRODUCT_QUANTITY" => "Y",	// Разрешить указание количества товара
		"CONVERT_CURRENCY" => "Y",	// Показывать цены в одной валюте
		"CURRENCY_ID" => "RUB",	// Валюта, в которую будут сконвертированы цены
		"QUANTITY_FLOAT" => "N",
		"OFFERS_CART_PROPERTIES" => "",	// Свойства предложений, добавляемые в корзину
		"SHOW_TOP_ELEMENTS" => "N",	// Выводить топ элементов
		"SECTION_COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"SECTION_TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
		"SECTIONS_VIEW_MODE" => "LIST",	// Вид списка подразделов
		"SECTIONS_SHOW_PARENT_NAME" => "N",	// Показывать название раздела
		"PAGE_ELEMENT_COUNT" => "24",	// Количество элементов на странице
		"LINE_ELEMENT_COUNT" => "3",	// Количество элементов, выводимых в одной строке таблицы
		"ELEMENT_SORT_FIELD" => "desc",	// По какому полю сортируем товары в разделе
		"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки товаров в разделе
		"ELEMENT_SORT_FIELD2" => "shows",	// Поле для второй сортировки товаров в разделе
		"ELEMENT_SORT_ORDER2" => "asc",	// Порядок второй сортировки товаров в разделе
		"LIST_PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "NEWPRODUCT",
			2 => "SALELEADER",
			3 => "SPECIALOFFER",
			4 => "",
		),
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"LIST_META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства раздела
		"LIST_META_DESCRIPTION" => "-",	// Установить описание страницы из свойства раздела
		"LIST_BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства раздела
		"LIST_OFFERS_FIELD_CODE" => array(	// Поля предложений
			0 => "",
			1 => "",
		),
		"LIST_OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
			0 => "",
			1 => "ARTNUMBER",
			2 => "COLOR_REF",
			3 => "SIZES_SHOES",
			4 => "SIZES_CLOTHES",
			5 => "",
		),
		"LIST_OFFERS_LIMIT" => "0",	// Максимальное количество предложений для показа (0 - все)
		"DETAIL_PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "NEWPRODUCT",
			2 => "MANUFACTURER",
			3 => "",
		),
		"DETAIL_META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"DETAIL_META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"DETAIL_BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
		"DETAIL_OFFERS_FIELD_CODE" => array(	// Поля предложений
			0 => "",
			1 => "",
		),
		"DETAIL_OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
			0 => "",
			1 => "ARTNUMBER",
			2 => "COLOR_REF",
			3 => "SIZES_SHOES",
			4 => "SIZES_CLOTHES",
			5 => "",
		),
		"LINK_IBLOCK_TYPE" => "",	// Тип инфоблока, элементы которого связаны с текущим элементом
		"LINK_IBLOCK_ID" => "",	// ID инфоблока, элементы которого связаны с текущим элементом
		"LINK_PROPERTY_SID" => "",	// Свойство, в котором хранится связь
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",	// URL на страницу, где будет показан список связанных элементов
		"USE_ALSO_BUY" => "N",	// Показывать блок "С этим товаром покупают"
		"ALSO_BUY_ELEMENT_COUNT" => "4",
		"ALSO_BUY_MIN_BUYES" => "1",
		"OFFERS_SORT_FIELD" => "shows",	// По какому полю сортируем предложения товара
		"OFFERS_SORT_ORDER" => "asc",	// Порядок сортировки предложений товара
		"OFFERS_SORT_FIELD2" => "shows",	// Поле для второй сортировки предложений товара
		"OFFERS_SORT_ORDER2" => "asc",	// Порядок второй сортировки предложений товара
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"PAGER_TITLE" => "Товары",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"ADD_PICT_PROP" => "-",	// Дополнительная картинка основного товара
		"LABEL_PROP" => "-",	// Свойство меток товара
		"PRODUCT_DISPLAY_MODE" => "N",	// Схема отображения
		"OFFER_ADD_PICT_PROP" => "-",	// Дополнительные картинки предложения
		"OFFER_TREE_PROPS" => "",	// Свойства для отбора предложений
		"SHOW_DISCOUNT_PERCENT" => "Y",	// Показывать процент скидки
		"SHOW_OLD_PRICE" => "N",	// Показывать старую цену
		"MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",	// Текст кнопки "Добавить в корзину"
		"MESS_BTN_COMPARE" => "Сравнение",	// Текст кнопки "Сравнение"
		"MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
		"MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
		"DETAIL_USE_VOTE_RATING" => "N",	// Включить рейтинг товара
		"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
		"DETAIL_USE_COMMENTS" => "N",	// Включить отзывы о товаре
		"DETAIL_BLOG_USE" => "Y",
		"DETAIL_VK_USE" => "N",
		"DETAIL_FB_USE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"USE_STORE" => "N",	// Показывать блок "Количество товара на складе"
		"USE_STORE_PHONE" => "Y",
		"USE_STORE_SCHEDULE" => "Y",
		"USE_MIN_AMOUNT" => "N",
		"STORE_PATH" => "/store/#store_id#",
		"MAIN_TITLE" => "Наличие на складах",
		"MIN_AMOUNT" => "10",
		"DETAIL_BRAND_USE" => "Y",	// Использовать компонент "Бренды"
		"DETAIL_BRAND_PROP_CODE" => array(	// Таблица с брендами
			0 => "",
			1 => "-",
			2 => "BRAND_REF",
			3 => "",
		),
		"SIDEBAR_SECTION_SHOW" => "Y",	// Показывать правый блок в списке товаров
		"SIDEBAR_DETAIL_SHOW" => "N",	// Показывать правый блок на детальной странице
		"SIDEBAR_PATH" => "/catalog/sidebar.php",	// Путь к включаемой области для вывода информации в правом блоке
		"COMPONENT_TEMPLATE" => "catalog",
		"COMMON_SHOW_CLOSE_POPUP" => "Y",	// Показывать кнопку продолжения покупок во всплывающих окнах
		"DETAIL_SHOW_MAX_QUANTITY" => "Y",	// Показывать общее количество товара
		"DETAIL_BLOG_URL" => "catalog_comments",
		"DETAIL_BLOG_EMAIL_NOTIFY" => "N",
		"DETAIL_FB_APP_ID" => "",
		"USE_MAIN_ELEMENT_SECTION" => "Y",	// Использовать основной раздел для показа элемента
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"USE_SALE_BESTSELLERS" => "N",	// Показывать список лидеров продаж
		"ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
		"USE_COMMON_SETTINGS_BASKET_POPUP" => "Y",	// Одинаковые настройки показа кнопок добавления в корзину или покупки на всех страницах
		"COMMON_ADD_TO_BASKET_ACTION" => "BUY",	// Показывать кнопку добавления в корзину или покупки
		"TOP_ADD_TO_BASKET_ACTION" => "BUY",	// Показывать кнопку добавления в корзину или покупки на странице с top'ом товаров
		"SECTION_ADD_TO_BASKET_ACTION" => "BUY",	// Показывать кнопку добавления в корзину или покупки на странице списка товаров
		"DETAIL_ADD_TO_BASKET_ACTION" => "",	// Показывать кнопки добавления в корзину и покупки на детальной странице товара
		"DETAIL_SHOW_BASIS_PRICE" => "Y",	// Показывать на детальной странице цену за единицу товара
		"SECTIONS_HIDE_SECTION_NAME" => "N",
		"DETAIL_SET_CANONICAL_URL" => "N",	// Устанавливать канонический URL
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",	// Использовать код группы из переменной, если не задан раздел элемента
		"SHOW_DEACTIVATED" => "N",	// Показывать деактивированные товары
		"DETAIL_DETAIL_PICTURE_MODE" => "IMG",	// Режим показа детальной картинки
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",	// Добавлять детальную картинку в слайдер
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "H",	// Показ описания для анонса на детальной странице
		"STORES" => "",
		"USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_EMPTY_STORE" => "Y",
		"SHOW_GENERAL_STORE_INFORMATION" => "N",
		"USE_BIG_DATA" => "N",	// Показывать персональные рекомендации
		"BIG_DATA_RCM_TYPE" => "bestsell",
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"SHOW_404" => "N",	// Показ специальной страницы
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"SECTION_BACKGROUND_IMAGE" => "-",	// Установить фоновую картинку для шаблона из свойства
		"DETAIL_BACKGROUND_IMAGE" => "-",	// Установить фоновую картинку для шаблона из свойства
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",	// Не подключать js-библиотеки в компоненте
		"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",	// Включить сохранение информации о просмотре товара на детальной странице для старых шаблонов
		"CACHE_NOTES" => "",
		"USE_GIFTS_DETAIL" => "N",	// Показывать блок "Подарки" в детальном просмотре
		"USE_GIFTS_SECTION" => "Y",	// Показывать блок "Подарки" в списке
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",	// Показывать блок "Товары к подарку" в детальном просмотре
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "3",	// Количество элементов в блоке "Подарки" строке в списке
		"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",	// Скрыть заголовок "Подарки" в списке
		"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",	// Текст заголовка "Подарки" в списке
		"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",	// Текст метки "Подарка" в списке
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",	// Показывать процент скидки
		"GIFTS_SHOW_OLD_PRICE" => "Y",	// Показывать старую цену
		"GIFTS_SHOW_NAME" => "Y",	// Показывать название
		"GIFTS_SHOW_IMAGE" => "Y",	// Показывать изображение
		"GIFTS_MESS_BTN_BUY" => "Выбрать",	// Текст кнопки "Выбрать"
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",	// Количество элементов в блоке "Товары к подарку" в строке в детальном просмотре
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",	// Скрыть заголовок "Товары к подарку" в детальном просмотре
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",	// Текст заголовка "Товары к подарку"
		"INSTANT_RELOAD" => "N",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE_PATH#/",
			"element" => "#ELEMENT_CODE#/",
			"compare" => "compare/",
			"smart_filter" => "#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/",
		)
	),
	false
);?>

            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>