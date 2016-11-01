<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О магазине");
?>
        <div class="widthWrapper">

            <div class="infoBlocksMenu">
                <a href="#history" class="activeInfoBlock">История</a>
                <a href="#achievements">Наши награды и достижения</a>
                <a href="#exclusiveBrands">Эксклюзивная дистрибуция брендов</a>
                <a href="#distribution">Дистрибьюция</a>
            </div>

            <div class="infoBlocksContent about_tabs" id="history" style="display: block">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				".default",
				array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "standard.php",
					"COMPONENT_TEMPLATE" => ".default",
					"PATH" => "/include/history.php"
				),
				false
			);?>
            </div>
            <div class="infoBlocksContent about_tabs" id="achievements">
            	<div class="achievements_wrapper">
            		<?$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"achievements",
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
							"DISPLAY_PICTURE" => "Y",
							"DISPLAY_PREVIEW_TEXT" => "Y",
							"DISPLAY_TOP_PAGER" => "N",
							"FIELD_CODE" => array(
								0 => "NAME",
								1 => "PREVIEW_PICTURE",
								2 => "DETAIL_PICTURE",
								3 => "",
							),
							"FILTER_NAME" => "",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"IBLOCK_ID" => "21",
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
							"COMPONENT_TEMPLATE" => ".default"
						),
						false
					);?>
                </div>
            </div>
            <div class="infoBlocksContent about_tabs" id="exclusiveBrands">
	            <h3>Мы являемся Эксклюзивными дистрибьюторами следующих торговых марок</h3>
	            <?
        		$filter[">PREVIEW_PICTURE"] = 0;
				$filter["PROPERTY_EXCLUSIVE_VALUE"] = "Да";
        	    ?> 
                <?$APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "brands_index",
                    Array(
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
                        "COMPONENT_TEMPLATE" => "brands_index",
                        "DETAIL_URL" => "",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "DISPLAY_TOP_PAGER" => "N",
                        "FIELD_CODE" => array(0=>"PREVIEW_PICTURE",1=>"",),
                        "FILTER_NAME" => "filter",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => "14",
                        "IBLOCK_TYPE" => "services",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "50",
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
                        "PROPERTY_CODE" => array(0=>"",1=>"",),
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
                        "SORT_ORDER2" => "ASC"
                    )
                );?> 
                <? unset($filter) ?>
            </div>
            <div class="infoBlocksContent about_tabs" id="distribution">
	        <h3>Мы являемся Эксклюзивными дистрибьюторами следующих торговых марок</h3>
	        <h3> </h3>
            <?
                $filter[">PREVIEW_PICTURE"] = 0;
                $filter["PROPERTY_DISPLAY_IN_ABOUT_VALUE"] = "Да";
            ?> 
            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "brands_index",
                Array(
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
                    "COMPONENT_TEMPLATE" => "brands_index",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(0=>"PREVIEW_PICTURE",1=>"",),
                    "FILTER_NAME" => "Filter_brands",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "14",
                    "IBLOCK_TYPE" => "services",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "N",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "50",
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
                    "PROPERTY_CODE" => array(0=>"",1=>"",),
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
                    "SORT_ORDER2" => "ASC"
                )
            );?> 
            <? unset($filter) ?>
        </div>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        <div id="question_form">
	        <h2>Задать вопрос</h2>
	        <div id="form_container">
		        <div class="tableBorderWrapper">
			        <form method="post" id="ask_question">
				        <table class="questionInfoForm about_question_form">
				            <tbody>
				                <tr>
					                <td colspan="2" class="inputsBlock">
						                <div class="leftBlock">
                                            <input name="name" placeholder="Имя" pattern="[A-Za-zА-Яа-яЁё ]{2,}" title="Поле не может быть пустым,а также содержать цифры и спецсимволы" required="" type="text"> 
                                            <input name="email" placeholder="Почта" required="" type="email"> 
                                            <input name="company_name" placeholder="Название компании" pattern="[A-Za-zА-Яа-яЁё ]{2,}" title="Поле не может быть пустым,а также содержать цифры и спецсимволы" required="" type="text"> 
                                            <input name="form_type" value="<?= ABOUT_FORM ?>" title="Код PHP: <?= ABOUT_FORM ?>" class="bxhtmled-surrogate" type="hidden">
                                            
						                </div>
						                <div class="rightBlock">
                                            <textarea placeholder="Введите ваш вопрос" name="text" pattern="{6,}" title="Поле не может быть пустым" required=""></textarea>
						                </div>
					                </td>
				                </tr>
				                <tr>
					                <td>
						                <p class="Obligatory_field">* - Поля обязательные для заполнения</p>
						                <div class="form_result">
						                </div>
					                </td>
					                <td class="buttonsBlock">
                                        <input value="Отправить" class="formAcceptBut" type="submit">
					                </td>
				                </tr>
				            </tbody>
				        </table>
			        </form>
		        </div>
	        </div>
	        <div class="hiddenProductComment" style="display: none;">
		        <p class="authClose">
		        </p>
		        <div class="message" style="display: block;">
			        Ваш вопрос отправлен. Наши консультанты свяжуться с вами по указанным координатам
		        </div>
	        </div>
        </div>
    </div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>