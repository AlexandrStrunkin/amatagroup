<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
use \Bitrix\Catalog\CatalogViewedProductTable as CatalogViewedProductTable;
global $APPLICATION;
$APPLICATION->AddHeadScript($templateFolder . "/preview_slider.js");
?>
<script type="text/javascript">
BX.ready(BX.defer(function(){
	// простенький слайдер для превьюх в карточке товара
	var preview_slider = new PreviewSlider({
		slide_distance: 300,
		arrows_class: "previews_slider_navigation_arrow",
		wrapper_id: "confidens_slider_wrapper",
		items_in_rows: 5
	});
	preview_slider.init();
}));
</script>