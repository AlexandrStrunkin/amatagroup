<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;
$APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH . "/js/shave.js");
?>
<script>
	$(document).ready(function(){
		// образаем длинные названия
		$(".productName").shave(60);
		// показываем скрытую часть названия в отображении блоками
		$(".productWrapper").hover(
			function(){
				var outer_block = $(this).parent(), // внешний блок, его высота эталонная
					name_block = $(this).find(".productName"), // блок названия
					additional_height = name_block[0].scrollHeight - name_block.height() + 20, // добавляемая скрытая разница в высоте
					full_name = name_block.data("element-full-name");
					
				outer_block.css("border-color", "transparent");
			
				$(this).css({
					"height" : outer_block.height() + additional_height + "px",
					"z-index": 2,
					"border" : "1px solid #c7c7c7",
					"margin-top": "-1px",
					"margin-left": "-1px"
				});
				
				name_block.html(full_name);
				
				name_block.css({
					"overflow" : "visible"
				});
			},
			function(){
				var outer_block = $(this).parent(),
					name_block = $(this).find(".productName");
				
				outer_block.css("border-color", "#e6e6e6");
				
				$(this).css({
					"height" : outer_block.height() + "px",
					"z-index": 0,
					"border" : "none",
					"margin-top": "0px",
					"margin-left": "0px"
				});
				
				name_block.shave(60);
				
				name_block.css({
					"overflow" : "hidden"
				});
			}
		)
	})
</script>
<?
if (isset($templateData['TEMPLATE_THEME']))
{
	$APPLICATION->SetAdditionalCSS($templateData['TEMPLATE_THEME']);
}
if (isset($templateData['TEMPLATE_LIBRARY']) && !empty($templateData['TEMPLATE_LIBRARY']))
{
	$loadCurrency = false;
	if (!empty($templateData['CURRENCIES']))
		$loadCurrency = Loader::includeModule('currency');
	CJSCore::Init($templateData['TEMPLATE_LIBRARY']);
	if ($loadCurrency)
	{
	?>
	<script type="text/javascript">
		BX.Currency.setCurrencies(<? echo $templateData['CURRENCIES']; ?>);
	</script>
<?
	}
}
?>