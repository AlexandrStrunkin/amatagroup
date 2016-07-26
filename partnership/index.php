<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сотрудничество");
?>
<div class="widthWrapper">

            <div class="infoBlocksMenu">
                <a href="#wholesale" class="activeInfoBlock">Для оптовых покупателей</a>
                <a href="#retail">Для поставщиков</a>
            </div>

            <div class="infoBlocksContent about_tabs" id="wholesale" style="display: block">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include", 
				".default", 
				array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "standard.php",
					"COMPONENT_TEMPLATE" => ".default",
					"PATH" => "/include/wholesale.php"
				),
				false
			);?>
            </div>
            <div class="infoBlocksContent about_tabs" id="retail">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include", 
				".default", 
				array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "standard.php",
					"COMPONENT_TEMPLATE" => ".default",
					"PATH" => "/include/retail.php"
				),
				false
			);?>
            </div>
        </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>