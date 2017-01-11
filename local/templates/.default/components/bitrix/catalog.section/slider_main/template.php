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
                <?$image_file = CFile::GetPath($arItem["PROPERTIES"]["PICTURE_WIDTH"]["VALUE"]);?>
                <li style="background-color: <?=$arItem["PROPERTIES"]["FON_COLOR"]["VALUE_XML_ID"]?>">
                    <a class="slide_link" href="<?=$arItem["PROPERTIES"]["LINK_PRODUCT"]["VALUE"]?>">
                    <?if($arItem["PROPERTIES"]["PICTURE_WIDTH"]["VALUE"]){?>
                        <img class="image_width" src="<?=$image_file?>" title="<?=$arItem["DETAIL_TEXT"]?>" width="580">
                    <?}?>
                    <?if($arItem["PREVIEW_PICTURE"]["SRC"]){?>
                        <img class="big_image" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" title="<?=$arItem["DETAIL_TEXT"]?>" height="580">
                    <?}?>
                        <div class="bannerImgContainer">
                            <a href="<?=$arItem["PROPERTIES"]["LINK_PRODUCT"]["VALUE"]?>" >
                            	<? $img = CFIle::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array("width" => 580, "height" => 520), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 70); ?>
                                <img src="<?=$img["src"]?>" style="width: <?=$arItem["PROPERTIES"]["WIDTH_PICTURE_SMALL"]["VALUE"]?>%" height="<?=$arItem["DETAIL_PICTURE"]["HEIGHT"]?>" alt=""/>
                            </a>
                            <?if($arItem["PROPERTIES"]["SPECIAL_OFFER"]["VALUE_ENUM_ID"] == ELEMENT_SPECIAL_OFFER_HIT){?>
                                <p style="top: <?=$arItem["PROPERTIES"]["VERTICAL_POSITION"]["VALUE"]?>%; left: <?=$arItem["PROPERTIES"]["HORIZONTAL_POSITION"]["VALUE"]?>%" class="hitContainer"><?=$arItem["PROPERTIES"]["SPECIAL_OFFER"]["VALUE"]?></p>
                            <?} else if($arItem["PROPERTIES"]["SPECIAL_OFFER"]["VALUE_ENUM_ID"] == ELEMENT_SPECIAL_OFFER_NEW) {?>
                                <p style="top: <?=$arItem["PROPERTIES"]["VERTICAL_POSITION"]["VALUE"]?>%; left: <?=$arItem["PROPERTIES"]["HORIZONTAL_POSITION"]["VALUE"]?>%" class="newContainer"><?=GetMessage('PODUCT_SPECIAL_NEW')?></p>
                            <?} else if($arItem["PROPERTIES"]["SPECIAL_OFFER"]["VALUE_ENUM_ID"] == ELEMENT_SPECIAL_OFFER_BEST) {?>
                                <p style="top: <?=$arItem["PROPERTIES"]["VERTICAL_POSITION"]["VALUE"]?>%; left: <?=$arItem["PROPERTIES"]["HORIZONTAL_POSITION"]["VALUE"]?>%" class="bestContainer"><?=GetMessage('PODUCT_SPECIAL_BEST')?></p>
                            <?} else if($arItem["PROPERTIES"]["SPECIAL_OFFER"]["VALUE_ENUM_ID"] == ELEMENT_SPECIAL_OFFER_SALE && $arItem["SALE_PRICE"]) {?>
                                <p style="top: <?=$arItem["PROPERTIES"]["VERTICAL_POSITION"]["VALUE"]?>%; left: <?=$arItem["PROPERTIES"]["HORIZONTAL_POSITION"]["VALUE"]?>%" class="saleContainer"><?=$arItem["SALE_PRICE"]?></p>
                            <?}?>
                        </div>
                        <div class="bannerTextContainer">
                            <?if($arItem["PROPERTIES"]["PRICE_BANNER"]["VALUE"]){?>
                                <p class="bannerCost"><?=$arItem["PROPERTIES"]["PRICE_BANNER"]["VALUE"]?> <span class="rub">c</span></p>
                            <?}?>
                            <a href="<?=$arItem["PROPERTIES"]["LINK_PRODUCT"]["VALUE"]?>"><p class="bannerText"><?=$arItem["DETAIL_TEXT"]?></p></a>

                            
                        </div>
                    </a>
                </li>
            <?}?>
            </ul>
        </div>
        <div class="jcarousel-pagination"></div>


    </div>
    <!--END jcarousel-wrapper-->

</div>