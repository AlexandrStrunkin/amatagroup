<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    /** @var array $arParams */
    /** @var array $arResult */
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global CDatabase $DB */
    /** @var CBitrixComponentTemplate $this */
    /** @var string $templateName */
    /** @var string $templateFile */
    /** @var string $templateFolder */
    /** @var string $componentPath */
    /** @var CBitrixComponent $component */
    $this->setFrameMode(true);

    if(!$arResult["NavShowAlways"])
    {
        if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
            return;
    }

    $strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
    $strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<div class="goToPageWrapp">
    <p class="goToPageTitle"><?=GetMessage("GO_TO_PAGE");?></p>

    <div class="goToPageFilter">
        <p data-page="1" class="nowThisPage1" id="nowPageBlock">1</p>

        <div class="hidingMenu">
            <?for ($i = 1; $i <= ($arResult['NavPageCount']); $i++) {?>
                <p data-page="<?=$i?>" class="nowThisPage<?=$i?>" data-href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$i?>"><?=$i?></p>
                <?}?>
        </div>
    </div>
</div>

<div class="numbOfpageWrapp">     

    <a class="prev" href="<?if ($arResult["NavPageNomer"] > 1) { echo $arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1);} else {?>#!<?}?>"></a>

    <?while($arResult["nStartPage"] <= $arResult["nEndPage"]){?>

        <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) {?>
            <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryStringFull?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["nStartPage"])?>" class="active"><?=$arResult["nStartPage"]?></a>            
            <?} else {?>
            <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryStringFull?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["nStartPage"])?>"><?=$arResult["nStartPage"]?></a>
            <?}?>
        <?$arResult["nStartPage"]++?>
        <?}?>      

    <a class="next" href="<?if ($arResult["NavPageNomer"] != $arResult["NavPageCount"]) { echo $arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1);} else {?>#!<?}?> "></a>

</div>


    

