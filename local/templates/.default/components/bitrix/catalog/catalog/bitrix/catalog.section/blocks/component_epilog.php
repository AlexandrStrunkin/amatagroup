<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;
$APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH . "/js/clamp.js");?>
<script>
	$(document).ready(function(){
		var products_name = document.querySelectorAll(".productName");
		Array.prototype.forEach.call(products_name, function(product, i){
			$clamp(product, {clamp: 2});
		});
		// показываем скрытую часть названия в отображении блоками
		$(".productWrapper").hover(
			function(){
				var outer_block = $(this).parent(), // внешний блок, его высота эталонная
					name_block = $(this).find(".productName"), // блок названия
					additional_height = name_block[0].scrollHeight - name_block.height(); // добавляемая скрытая разница в высоте
			
				$(this).css({
					"height" : outer_block.height() + additional_height + "px",
					"z-index": 2,
					"border-bottom" : "1px solid #e6e6e6"
				});
				name_block.css({
					"display" : "block",
					"overflow" : "visible"
				});
			},
			function(){
				var outer_block = $(this).parent(),
					name_block = $(this).find(".productName"),
					additional_height = name_block[0].scrollHeight - name_block.height();
			
				$(this).css({
					"height" : outer_block.height() + "px",
					"z-index": 0,
					"border-bottom" : "none"
				});
				name_block.css({
					"display" : "-webkit-box",
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