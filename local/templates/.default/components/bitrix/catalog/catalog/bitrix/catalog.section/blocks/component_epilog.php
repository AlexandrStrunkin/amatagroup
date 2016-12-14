<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;
$APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH . "/js/shave.js");
?>
<script>
	<?= $APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH . "/js/blocks_titles_shave_script.js") ?>
	$(document).ready(function() {
		// функции для показа/скрытия попапа с кол-вом товара
		$(".blocks_stock_block").on("mouseover", function() {
			$(this).find(".stock_popup").show();
		});
		
		$(".stock_popup").on("mouseleave", function() {
			$(this).hide();
		})
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