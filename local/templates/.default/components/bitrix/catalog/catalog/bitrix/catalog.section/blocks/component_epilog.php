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
	$(".title_container").shave(39);
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
    // клик по опции
    $(".blocks_offers_options_wrapper li").on("click", function() {
    	var product_wrapper   = $(this).parents(".productWrapper"),
    		this_option_text  = $(this).text(),
    		select_value_text = product_wrapper.find(".title_container"),
    		options           = product_wrapper.find(".blocks_offers_options_wrapper"),
    		arrow             = product_wrapper.find(".blocks_offers_arrows"),
    		preview_picture   = $(this).data("preview-image"),
    		offer_id          = $(this).data("offer-id"),
    		current_offer_buy_link = $(this).data("offer-buy-link");
		// цены
		product_wrapper.find(".price").hide();
		product_wrapper.find(".price[data-offer-id='" + offer_id + "']").show();
		// смена картинки
		product_wrapper.find(".productimg img").attr("src", preview_picture);
		// ссылка для покупки
		product_wrapper.find(".js-add-to-basket").attr("href", current_offer_buy_link);
		// лого с остатками
		product_wrapper.find(".blocks_stock_block").hide();
		product_wrapper.find(".blocks_stock_block[data-offer-id='" + offer_id + "']").show();
		
		product_wrapper.find(".js-item-quantity").data("item-id", offer_id);
		
    	select_value_text.text(this_option_text).shave(39);
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