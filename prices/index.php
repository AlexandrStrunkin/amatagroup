<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("������� � ����");
?>
        <div class="widthWrapper">

            <div class="infoBlocksMenu">
                <a href="#balances" class="activeInfoBlock">�������</a>
                <a href="#prices">��������� ����</a>
            </div>

            <div class="infoBlocksContent about_tabs productSlider" id="balances" style="display: block">
                <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include", 
                        ".default", 
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "standard.php",
                            "COMPONENT_TEMPLATE" => ".default",
                            "PATH" => "/include/remains.php"
                        ),
                        false
                    );?>
			    <?
				    $filter = array("PROPERTY_SECTION_TAB_VALUE" => "�������");
			    ?>
			    <?$APPLICATION->IncludeComponent("bitrix:news.list", "prices_and_balances", Array(
				    "ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
					    "ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
					    "AJAX_MODE" => "N",	// �������� ����� AJAX
					    "AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
					    "AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
					    "AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
					    "AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
					    "CACHE_FILTER" => "N",	// ���������� ��� ������������� �������
					    "CACHE_GROUPS" => "Y",	// ��������� ����� �������
					    "CACHE_TIME" => "36000000",	// ����� ����������� (���.)
					    "CACHE_TYPE" => "A",	// ��� �����������
					    "CHECK_DATES" => "Y",	// ���������� ������ �������� �� ������ ������ ��������
					    "DETAIL_URL" => "",	// URL �������� ���������� ��������� (�� ��������� - �� �������� ���������)
					    "DISPLAY_BOTTOM_PAGER" => "N",	// �������� ��� �������
					    "DISPLAY_DATE" => "N",	// �������� ���� ��������
					    "DISPLAY_NAME" => "Y",	// �������� �������� ��������
					    "DISPLAY_PICTURE" => "N",	// �������� ����������� ��� ������
					    "DISPLAY_PREVIEW_TEXT" => "N",	// �������� ����� ������
					    "DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
					    "FIELD_CODE" => array(	// ����
						    0 => "NAME",
						    1 => "",
					    ),
					    "FILTER_NAME" => "filter",	// ������
					    "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// �������� ������, ���� ��� ���������� ��������
					    "IBLOCK_ID" => "23",	// ��� ��������������� �����
					    "IBLOCK_TYPE" => "services",	// ��� ��������������� ����� (������������ ������ ��� ��������)
					    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
					    "INCLUDE_SUBSECTIONS" => "Y",	// ���������� �������� ����������� �������
					    "MESSAGE_404" => "",	// ��������� ��� ������ (�� ��������� �� ����������)
					    "NEWS_COUNT" => "999",	// ���������� �������� �� ��������
					    "PAGER_BASE_LINK_ENABLE" => "N",	// �������� ��������� ������
					    "PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
					    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
					    "PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
					    "PAGER_SHOW_ALWAYS" => "N",	// �������� ������
					    "PAGER_TEMPLATE" => ".default",	// ������ ������������ ���������
					    "PAGER_TITLE" => "�������",	// �������� ���������
					    "PARENT_SECTION" => "",	// ID �������
					    "PARENT_SECTION_CODE" => "",	// ��� �������
					    "PREVIEW_TRUNCATE_LEN" => "",	// ������������ ����� ������ ��� ������ (������ ��� ���� �����)
					    "PROPERTY_CODE" => array(	// ��������
						    0 => "SECTION_TAB",
						    1 => "FILE",
						    2 => "",
						    3 => "",
					    ),
					    "SET_BROWSER_TITLE" => "N",	// ������������� ��������� ���� ��������
					    "SET_LAST_MODIFIED" => "N",	// ������������� � ���������� ������ ����� ����������� ��������
					    "SET_META_DESCRIPTION" => "N",	// ������������� �������� ��������
					    "SET_META_KEYWORDS" => "N",	// ������������� �������� ����� ��������
					    "SET_STATUS_404" => "N",	// ������������� ������ 404
					    "SET_TITLE" => "N",	// ������������� ��������� ��������
					    "SHOW_404" => "N",	// ����� ����������� ��������
					    "SORT_BY1" => "ACTIVE_FROM",	// ���� ��� ������ ���������� ��������
					    "SORT_BY2" => "SORT",	// ���� ��� ������ ���������� ��������
					    "SORT_ORDER1" => "DESC",	// ����������� ��� ������ ���������� ��������
					    "SORT_ORDER2" => "ASC",	// ����������� ��� ������ ���������� ��������
					    "COMPONENT_TEMPLATE" => ".default"
				    ),
				    false
			    );?>
			    <? unset($filter) ?>
            </div>
            <div class="infoBlocksContent about_tabs productSlider" id="prices">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include", 
					".default", 
					array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "standard.php",
						"COMPONENT_TEMPLATE" => ".default",
						"PATH" => "/include/prices.php"
					),
					false
				);?>
				<?
					$filter = array("PROPERTY_SECTION_TAB_VALUE" => "��������� ����");
				?>
				<?$APPLICATION->IncludeComponent("bitrix:news.list", "prices_and_balances", Array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
						"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
						"AJAX_MODE" => "N",	// �������� ����� AJAX
						"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
						"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
						"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
						"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
						"CACHE_FILTER" => "N",	// ���������� ��� ������������� �������
						"CACHE_GROUPS" => "Y",	// ��������� ����� �������
						"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
						"CACHE_TYPE" => "A",	// ��� �����������
						"CHECK_DATES" => "Y",	// ���������� ������ �������� �� ������ ������ ��������
						"DETAIL_URL" => "",	// URL �������� ���������� ��������� (�� ��������� - �� �������� ���������)
						"DISPLAY_BOTTOM_PAGER" => "N",	// �������� ��� �������
						"DISPLAY_DATE" => "N",	// �������� ���� ��������
						"DISPLAY_NAME" => "Y",	// �������� �������� ��������
						"DISPLAY_PICTURE" => "N",	// �������� ����������� ��� ������
						"DISPLAY_PREVIEW_TEXT" => "N",	// �������� ����� ������
						"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
						"FIELD_CODE" => array(	// ����
							0 => "NAME",
							1 => "",
						),
						"FILTER_NAME" => "filter",	// ������
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// �������� ������, ���� ��� ���������� ��������
						"IBLOCK_ID" => "23",	// ��� ��������������� �����
						"IBLOCK_TYPE" => "services",	// ��� ��������������� ����� (������������ ������ ��� ��������)
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
						"INCLUDE_SUBSECTIONS" => "Y",	// ���������� �������� ����������� �������
						"MESSAGE_404" => "",	// ��������� ��� ������ (�� ��������� �� ����������)
						"NEWS_COUNT" => "999",	// ���������� �������� �� ��������
						"PAGER_BASE_LINK_ENABLE" => "N",	// �������� ��������� ������
						"PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
						"PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
						"PAGER_SHOW_ALWAYS" => "N",	// �������� ������
						"PAGER_TEMPLATE" => ".default",	// ������ ������������ ���������
						"PAGER_TITLE" => "�������",	// �������� ���������
						"PARENT_SECTION" => "",	// ID �������
						"PARENT_SECTION_CODE" => "",	// ��� �������
						"PREVIEW_TRUNCATE_LEN" => "",	// ������������ ����� ������ ��� ������ (������ ��� ���� �����)
						"PROPERTY_CODE" => array(	// ��������
							0 => "SECTION_TAB",
							1 => "FILE",
							2 => "",
							3 => "",
						),
						"SET_BROWSER_TITLE" => "N",	// ������������� ��������� ���� ��������
						"SET_LAST_MODIFIED" => "N",	// ������������� � ���������� ������ ����� ����������� ��������
						"SET_META_DESCRIPTION" => "N",	// ������������� �������� ��������
						"SET_META_KEYWORDS" => "N",	// ������������� �������� ����� ��������
						"SET_STATUS_404" => "N",	// ������������� ������ 404
						"SET_TITLE" => "N",	// ������������� ��������� ��������
						"SHOW_404" => "N",	// ����� ����������� ��������
						"SORT_BY1" => "ACTIVE_FROM",	// ���� ��� ������ ���������� ��������
						"SORT_BY2" => "SORT",	// ���� ��� ������ ���������� ��������
						"SORT_ORDER1" => "DESC",	// ����������� ��� ������ ���������� ��������
						"SORT_ORDER2" => "ASC",	// ����������� ��� ������ ���������� ��������
						"COMPONENT_TEMPLATE" => ".default"
					),
					false
				);?>
				<? unset($filter) ?>
            </div>
        </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>