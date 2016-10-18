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
?>
<div class="mainBigBanner">

    <!--jcarousel-wrapper-->
    <div class="jcarousel-wrapper">
        <!--jcarousel-->
        <div class="jcarousel">
            <ul>
            <?
            foreach ($arResult['ITEMS'] as $key => $arItem) {?>
                <li>
                    <div class="bannerImgContainer">
                        <p><img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" height="<?=$arItem["DETAIL_PICTURE"]["HEIGHT"]?>" alt=""/></p>
                        <?if($arItem["PROPERTIES"]["SPECIAL_OFFER"]["VALUE_ENUM_ID"] == 3651){?>
                            <p class="hitContainer"><?=$arItem["PROPERTIES"]["SPECIAL_OFFER"]["VALUE"]?></p>
                        <?} else if($arItem["PROPERTIES"]["SPECIAL_OFFER"]["VALUE_ENUM_ID"] == 3652) {?>
                            <p class="newContainer"><?=GetMessage('PODUCT_SPECIAL_NEW')?></p>
                        <?} else if($arItem["PROPERTIES"]["SPECIAL_OFFER"]["VALUE_ENUM_ID"] == 3653) {?>
                            <p class="bestContainer"><?=GetMessage('PODUCT_SPECIAL_BEST')?></p>
                        <?} else if($arItem["PROPERTIES"]["SPECIAL_OFFER"]["VALUE_ENUM_ID"] == 3654 && $arItem["SALE_PRICE"]) {?>
                            <p class="saleContainer"><?=$arItem["SALE_PRICE"]?></p>
                        <?}?>
                    </div>
                    <div class="bannerTextContainer">
                        <p class="bannerCost"><?=$arItem["PROPERTIES"]["PRICE_BANNER"]["VALUE"]?></p>

                        <p class="bannerText"><?=$arItem["DETAIL_TEXT"]?></p>

                    </div>
                </li>
            <?}?>
            </ul>
        </div>
        <div class="jcarousel-pagination"></div>


    </div>
    <!--END jcarousel-wrapper-->

</div>