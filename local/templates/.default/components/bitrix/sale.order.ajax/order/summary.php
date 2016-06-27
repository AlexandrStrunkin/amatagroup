<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$bDefaultColumns = $arResult["GRID"]["DEFAULT_COLUMNS"];
$colspan = ($bDefaultColumns) ? count($arResult["GRID"]["HEADERS"]) : count($arResult["GRID"]["HEADERS"]) - 1;
$bPropsColumn = false;
$bUseDiscount = false;
$bPriceType = false;
$bShowNameWithPicture = ($bDefaultColumns) ? true : false; // flat to show name and picture column in one column
?>

<div class="row6">
    <h3><?= GetMessage("SOA_TEMPL_SUMMARY_BLOCK_TITLE") ?></h3>
    <!--border-->
    <div class="border">
        <!--col1-->
        <div class="col1 order_summary">
            <div class="sum"><?= GetMessage("SOA_TEMPL_SUM_WEIGHT_SUM") ?> <span><?= $arResult["ORDER_WEIGHT_FORMATED"] ?></span></div>
			<div class="sum"><?= GetMessage("SOA_TEMPL_SUM_SUMMARY") ?> <span><?= $arResult["ORDER_PRICE_FORMATED"] ?></span></div>
			<? if (doubleval($arResult["DISCOUNT_PRICE"]) > 0) { ?>
			<div class="sum"><?=GetMessage("SOA_TEMPL_SUM_DISCOUNT")?><?if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0):?> (<?echo $arResult["DISCOUNT_PERCENT_FORMATED"];?>)<?endif;?> <span><<?echo $arResult["DISCOUNT_PRICE_FORMATED"]?></span></div>
			<? } ?>
			<? if (doubleval($arResult["DELIVERY_PRICE"]) > 0) { ?>
			<div class="sum"><?= GetMessage("SOA_TEMPL_SUM_DELIVERY") ?> <span><?= $arResult["DELIVERY_PRICE_FORMATED"] ?></span></div>
			<? } ?>
			<? if ($bUseDiscount) { ?>
			<div class="sum general"><?= GetMessage("SOA_TEMPL_SUM_IT") ?> <span><?= $arResult["ORDER_TOTAL_PRICE_FORMATED"] ?></span></div>
			<div class="sum" style="text-decoration:line-through; color:#828282;"><?= GetMessage("SOA_TEMPL_PRICE_WITHOUT_DISCOUNT") ?> <span><?= $arResult["PRICE_WITHOUT_DISCOUNT"] ?></span></div>
			<? } else { ?>
            <div class="sum general"><?= GetMessage("SOA_TEMPL_SUM_IT") ?> <span><?= $arResult["ORDER_TOTAL_PRICE_FORMATED"] ?></span></div>
            <? } ?>
        </div>
        <!--END col1-->
        <!--col2-->
        <div class="col2" style="display: none">
        </div>
        <!--END col2-->
    </div>
    <!--END border-->
</div>