<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вопрос-ответ");
?>
<?
	$filter['!DETAIL_TEXT'] = false;
?>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "FAQ", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"DISPLAY_DATE" => "N",	// Выводить дату элемента
		"DISPLAY_NAME" => "N",	// Выводить название элемента
		"DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "PREVIEW_TEXT",
			1 => "DETAIL_TEXT",
			2 => "",
		),
		"FILTER_NAME" => "filter",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "24",	// Код информационного блока
		"IBLOCK_TYPE" => "services",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "999",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<div id="question_form">
	<h2>Задать вопрос</h2>
	<div id="form_container">
		<div class="tableBorderWrapper">
            <form method="post" id="faq_question">
                <table class="questionInfoForm about_question_form">
                    <tr>
                        <td colspan="2" class="inputsBlock">
                            <div class="leftBlock">
                                <input type="text" name="name" placeholder="Имя" pattern="[A-Za-zА-Яа-яЁё ]{2,}" title="Поле не может быть пустым,а также содержать цифры и спецсимволы" required>
                                <input type="email" name="email" placeholder="Почта" required>
                                <input type="text" name="company_name" placeholder="Название компании" pattern="[A-Za-zА-Яа-яЁё ]{2,}" title="Поле не может быть пустым,а также содержать цифры и спецсимволы" required>
                            	<input type="hidden" name="form_type" value="<?= FAQ_FORM ?>" >
                            </div>
                            <div class="rightBlock">
                                <textarea placeholder="Введите ваш вопрос" name="text" pattern="{6,}" title="Поле не может быть пустым" required></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr >
                    	<td>
                            <p class="Obligatory_field">* - Поля обязательные для заполнения</p>
                            <div class="form_result">
                            </div>
                        </td>
                        <td class="buttonsBlock">
                            <input type="submit" value="Отправить" class="formAcceptBut">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
	</div>
	<div class="hiddenProductComment" style="display: none;">
        <p class="authClose"></p>
        <div class="message" style="display: block;">
            Ваш вопрос отправлен. Наши консультанты свяжуться с вами по указанным координатам
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>