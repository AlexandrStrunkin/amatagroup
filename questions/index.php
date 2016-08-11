<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("������-�����");
?>
<?
	$filter['!DETAIL_TEXT'] = false;
?>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "FAQ", Array(
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
		"DISPLAY_NAME" => "N",	// �������� �������� ��������
		"DISPLAY_PICTURE" => "N",	// �������� ����������� ��� ������
		"DISPLAY_PREVIEW_TEXT" => "Y",	// �������� ����� ������
		"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
		"FIELD_CODE" => array(	// ����
			0 => "PREVIEW_TEXT",
			1 => "DETAIL_TEXT",
			2 => "",
		),
		"FILTER_NAME" => "filter",	// ������
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// �������� ������, ���� ��� ���������� ��������
		"IBLOCK_ID" => "24",	// ��� ��������������� �����
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
			0 => "",
			1 => "",
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
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<div id="question_form">
	<h2>������ ������</h2>
	<div id="form_container">
		<div class="tableBorderWrapper">
            <form method="post" id="faq_question">
                <table class="questionInfoForm about_question_form">
                    <tr>
                        <td colspan="2" class="inputsBlock">
                            <div class="leftBlock">
                                <input type="text" name="name" placeholder="���" pattern="[A-Za-z�-��-��� ]{2,}" title="���� �� ����� ���� ������,� ����� ��������� ����� � �����������" required>
                                <input type="email" name="email" placeholder="�����" required>
                                <input type="text" name="company_name" placeholder="�������� ��������" pattern="[A-Za-z�-��-��� ]{2,}" title="���� �� ����� ���� ������,� ����� ��������� ����� � �����������" required>
                            	<input type="hidden" name="form_type" value="<?= FAQ_FORM ?>" >
                            </div>
                            <div class="rightBlock">
                                <textarea placeholder="������� ��� ������" name="text" pattern="{6,}" title="���� �� ����� ���� ������" required></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr >
                    	<td>
                            <p class="Obligatory_field">* - ���� ������������ ��� ����������</p>
                            <div class="form_result">
                            </div>
                        </td>
                        <td class="buttonsBlock">
                            <input type="submit" value="���������" class="formAcceptBut">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
	</div>
	<div class="hiddenProductComment" style="display: none;">
        <p class="authClose"></p>
        <div class="message" style="display: block;">
            ��� ������ ���������. ���� ������������ ��������� � ���� �� ��������� �����������
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>