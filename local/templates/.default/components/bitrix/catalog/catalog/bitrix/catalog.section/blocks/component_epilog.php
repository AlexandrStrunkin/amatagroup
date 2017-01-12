<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;
$APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH . "/js/shave.js");
?>
<script>
	<?= $APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH . "/js/blocks_titles_shave_script.js") ?>
</script>
<script type="text/javascript">
BX.ready(BX.defer(function() {
	// скролл для списка предложений
	$(".blocks_offers_options_wrapper").mCustomScrollbar({
        theme: "dark-thin"
    });
    // показ/скрытие предложений
    $(".blocks_offers_select").on("click", function() {
    	var options = $(this).next(),
    		arrow   = $(this).find(".blocks_offers_arrows");

    	options.toggle();
		options.css('display') == 'none' ? arrow.css("background-position", "0 0") : arrow.css("background-position", "100% 0");
    });
    
    $(".productWrapper").on("mouseleave", function() {
    	var options = $(this).find(".blocks_offers_options_wrapper"),
    		arrow   = $(this).find(".blocks_offers_arrows");

		options.hide();
		arrow.css("background-position", "0 0");
    });
    
    $(".blocks_offers_options_wrapper li").on("click", function() {
    	var this_option_text  = $(this).text(),
    		select_value_text = $(this).parents(".blocks_offers_wrapper").find(".blocks_offers_title"),
    		options           = $(this).parents(".blocks_offers_options_wrapper"),
    		arrow             = $(this).parents(".blocks_offers_wrapper").find(".blocks_offers_arrows");

    	select_value_text.text(this_option_text);
    	options.hide();
    	arrow.css("background-position", "0 0");
    })
}));
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