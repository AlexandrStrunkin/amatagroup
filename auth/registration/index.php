<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("�����������");
?><?$APPLICATION->IncludeComponent("bitrix:main.register", "new_registration", Array(
	"AUTH" => "Y",	// ������������� ������������ �������������
		"REQUIRED_FIELDS" => array(	// ����, ������������ ��� ����������
			0 => "EMAIL",
			1 => "NAME",
		),
		"SET_TITLE" => "Y",	// ������������� ��������� ��������
		"SHOW_FIELDS" => array(	// ����, ������� ���������� � �����
			0 => "EMAIL",
			1 => "NAME",
			2 => "PERSONAL_PHONE",
		),
		"SUCCESS_PAGE" => "",	// �������� ��������� �����������
		"USER_PROPERTY" => "",	// ���������� ���. ��������
		"USER_PROPERTY_NAME" => "",	// �������� ����� ���������������� �������
		"USE_BACKURL" => "Y",	// ���������� ������������ �� �������� ������, ���� ��� ����
		"COMPONENT_TEMPLATE" => "popup_register"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>