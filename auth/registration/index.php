<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("�����������");
?>
<?
if (!$USER->IsAuthorized()) {
    $APPLICATION->IncludeComponent(
	    "bitrix:main.register",
	    "new_registration",
	    array(
		    "AUTH" => "Y",
		    "REQUIRED_FIELDS" => array(
			    0 => "NAME",
		    ),
		    "SET_TITLE" => "Y",
		    "SHOW_FIELDS" => array(
			    0 => "EMAIL",
			    1 => "NAME",
			    2 => "PERSONAL_PHONE",
		    ),
		    "SUCCESS_PAGE" => "",
		    "USER_PROPERTY" => array(
			    0 => "UF_DOCUMENT_1",
			    1 => "UF_DOCUMENT_2",
			    2 => "UF_DOCUMENT_3",
			    3 => "UF_DOCUMENT_4",
			    4 => "UF_DOCUMENT_5",
		    ),
		    "USER_PROPERTY_NAME" => "",
		    "USE_BACKURL" => "Y",
		    "COMPONENT_TEMPLATE" => "new_registration"
	    ),
	    false
    );
} else{?>
    <p>�� ���������������� � ������� ��������������.</p>

    <p><a href="<?=SITE_DIR?>">��������� �� ������� ��������</a></p>
<?}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>