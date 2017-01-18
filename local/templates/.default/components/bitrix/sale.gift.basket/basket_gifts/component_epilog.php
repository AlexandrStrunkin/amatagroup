<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
global $APPLICATION;
$APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH . "/js/shave.js");
?>
<script>
	<?= $APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH . "/js/blocks_titles_shave_script.js") ?>
</script>
<script>
	<?= $APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH . "/js/blocks_view_offers_scripts.js") ?>
</script>
<script>
BX.ready(BX.defer(function() {
	// т.к. товар добавляется в корзину только после перезагрузки, то после добавления подарка перезагружаем страницу
	$(".basket_gifts .js-add-to-basket").on("click", function() {
		location.reload(true);
	})
}));
</script>
<?if (isset($templateData['TEMPLATE_THEME']))
{
	$APPLICATION->SetAdditionalCSS($templateData['TEMPLATE_THEME']);
}
CJSCore::Init(array("popup"));
?>