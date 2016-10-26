<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
use \Bitrix\Catalog\CatalogViewedProductTable as CatalogViewedProductTable;
global $APPLICATION;
$APPLICATION->SetAdditionalCSS("/vendor/fancybox/jquery.fancybox.css");
$APPLICATION->AddHeadScript("/vendor/fancybox/jquery.fancybox.pack.js");
$user_id = CSaleBasket::GetBasketUserID(); // нужен именно ID юзера в корзине !
if($user_id  > 0) {
	$product_id = $arResult['ID'];
	CatalogViewedProductTable::refresh($product_id, $user_id);
}
if (isset($templateData['TEMPLATE_THEME']))
{
	$APPLICATION->SetAdditionalCSS($templateData['TEMPLATE_THEME']);
}
$APPLICATION->AddHeadScript($templateFolder . "/preview_slider.js");
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
if (isset($templateData['JS_OBJ']))
{
?><script type="text/javascript">
BX.ready(BX.defer(function(){
	$(".fancybox").fancybox();
	// простенький слайдер для превьюх в карточке товара
	var preview_slider = new PreviewSlider({
		slide_distance: 104,
		arrows_class: "previews_slider_navigation_arrow",
		wrapper_id: "previews_slider_wrapper",
		items_in_rows: 6
	});
	preview_slider.init();
	// переключение табов на правой части
	$(".productTitle li").on("click", function() {
		if (!$(this).hasClass("active")) {
			$(".productTitle li").removeClass("active");
			$(this).addClass("active");
			$(".product_info_tab_content").fadeOut(100);
			$(".product_info_tab_content[data-product-tab='" + $(this).data("product-tab") + "']").fadeIn(200);
		}
	});
	// скролл для вкладки описание
    $(".product_card_description").mCustomScrollbar({
        theme: "dark-thin"
    });
	if (!!window.<? echo $templateData['JS_OBJ']; ?>)
	{
		window.<? echo $templateData['JS_OBJ']; ?>.allowViewedCount(true);
	}
}));
</script><?
}
?>