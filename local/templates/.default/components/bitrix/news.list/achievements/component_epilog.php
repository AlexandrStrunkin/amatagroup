<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;
$APPLICATION->SetAdditionalCSS("/vendor/fancybox/jquery.fancybox.css");
$APPLICATION->AddHeadScript("/vendor/fancybox/jquery.fancybox.pack.js");
?>
<script type="text/javascript">
BX.ready(BX.defer(function(){
	$(".fancybox").fancybox();
}));
</script>