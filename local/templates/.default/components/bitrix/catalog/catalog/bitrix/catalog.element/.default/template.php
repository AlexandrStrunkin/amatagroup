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
IncludeTemplateLangFile(__FILE__);
$templateLibrary = array('popup');
$currencyList = '';
if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = array(
	//'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_sticker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
	'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'BASIS_PRICE' => $strMainID.'_basis_price',
	'BUY_LINK' => $strMainID.'_buy_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
	'BASKET_ACTIONS' => $strMainID.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	: $arResult['NAME']
);
$strAlt = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	: $arResult['NAME']
);
?>
<?
if ('Y' == $arParams['DISPLAY_NAME'])
{
?>
<div class="bx_item_title"><h1><span><?
	echo (
		isset($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != ''
		? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
		: $arResult["NAME"]
	); ?>
</span></h1></div>
<?
}
reset($arResult['MORE_PHOTO']);
$arFirstPhoto = current($arResult['MORE_PHOTO']);
?>
	<!--productCardImg-->
    <div class="productCardImg">
        <!--logosContainer-->
        <div class="logosContainer">
        	<? 
        	if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']) {
				if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS'])) {
					if (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF']) { ?>
						<div class="discountLogoWrapper" id="<? echo $arItemIDs['DISCOUNT_PICT_ID'] ?>"><? echo -$arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>
				<?	}
				} else { 
					foreach ($arResult['OFFERS'] as $offer) { 
						if (0 < $offer['MIN_PRICE']['DISCOUNT_DIFF']) { ?>
							<div class="discountLogoWrapper" style="display: none" id="discount_label_<?= $offer['ID'] ?>"><? echo -$arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>
						<? } ?>
					<? } ?>
			<?	}
			} ?>
            <!--<div class="bestLogoWrapper">BEST</div>-->
            <?//шильдик новинки. Если товар  создан менее 2 недель назад
               if (date("U") - 86400 * NEW_PRODUCT_STATUS_LENGTH <= MakeTimeStamp($arResult["DATE_CREATE"], "DD.MM.YYYY HH:MI:SS")) {
            ?>
                <div class="newLogoWrapper" title="<?=GetMessage("NEW_PRODUCT")?>">NEW</div>
            <?}?>
            <!-- <div class="freshLogoWrapper">FRESH</div>
            <div class="saleLogoWrapper">SALE</div>-->
        </div>
        <!--END logosContainer-->
        <!--previewImg-->
        <div class="previewImg">
            <img id="<? echo $arItemIDs['PICT']; ?>" src="<? echo $arFirstPhoto['SRC']; ?>" alt="<? echo $strAlt; ?>" title="<? echo $strTitle; ?>">
        </div>
        <!--END previewImg-->
        <!--smallPreviewImg-->
        <div class="smallPreviewImg">
        <? if (is_array($arResult['MORE_PHOTO'])) { ?>
        	<? foreach ($arResult['MORE_PHOTO'] as &$arOnePhoto) { ?>
				<a href="<?= $arOnePhoto['SRC'] ?>"><img src="<?= $arOnePhoto['SRC'] ?>" alt=""/></a>
			<? } ?>
		<? }
			if (is_array($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])) {
				foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $photo_id) { ?>
					<a href="<?= CFile::GetPath($photo_id) ?>"><img src="<?= CFile::GetPath($photo_id) ?>" alt=""/></a>
			<? 	} 
			}
			unset($arOnePhoto);
		?>
		</div>
        <!--END smallPreviewImg-->
    </div>
    <!--END productCardImg-->
     <!--productCardDesc-->
    <div class="productCardDesc">
        <!--productTitle-->
        <div class="productTitle">
            <?= GetMessage("CT_DESCRIPTION") ?>
        </div>
        <!--END productTitle-->
        <!--productInfo-->
        <div class="productInfo">
            <div class="brandText">
            	<strong><?= GetMessage("CT_BRAND") ?>:</strong> 
            	<a href=""><?= $arResult['DISPLAY_PROPERTIES']['BREND']['DISPLAY_VALUE'] ? $arResult['DISPLAY_PROPERTIES']['BREND']['DISPLAY_VALUE'] : "Не задан" ?></a>
            </div>
            <div class="productArticle">
            	<strong><?= GetMessage("CT_VENDOR_CODE") ?>:</strong>
            	 <?= $arResult['DISPLAY_PROPERTIES']['CML2_ARTICLE']['DISPLAY_VALUE'] ? $arResult['DISPLAY_PROPERTIES']['CML2_ARTICLE']['DISPLAY_VALUE'] : "Не задан" ?>
            </div>
            <div class="productText">
            	<?= $arResult['DETAIL_TEXT'] ? $arResult['DETAIL_TEXT'] : $arResult['PREVIEW_TEXT'] ?>
            </div>
        </div>
        <!--END productInfo-->
        <!--productPrice-->
        <?// TODO: Выводимая цена для торговых предложений нифига не минимальная?>
        <div class="productPrice">
        	<?
			$minPrice = (isset($arResult['RATIO_PRICE']) ? $arResult['RATIO_PRICE'] : $arResult['MIN_PRICE']);
			$boolDiscountShow = (0 < $minPrice['DISCOUNT_DIFF']); ?>
			<strong><?= GetMessage("CT_PRICE") ?>: 
			<? if ($arParams['SHOW_OLD_PRICE'] == 'Y') { ?>
				<span class="discount_price"><?= ($boolDiscountShow ? $minPrice['PRINT_VALUE'] : ''); ?></span>
			<? } ?>
			</strong>
			<span class="actual_price"><?= $minPrice['PRINT_DISCOUNT_VALUE']; ?></span>
        </div>
        <!-- Цены предложений, если они есть -->
        <? if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) { 
               foreach ($arResult["OFFERS"] as $offer) { ?>
               	<div class="productPrice" data-price-offer-id="<?= $offer['ID'] ?>" style="display: none">
		        	<?
					$minPrice = (isset($offer['RATIO_PRICE']) ? $offer['RATIO_PRICE'] : $offer['MIN_PRICE']);
					$boolDiscountShow = (0 < $minPrice['DISCOUNT_DIFF']); ?>
					<strong><?= GetMessage("CT_PRICE") ?>: 
					<? if ($arParams['SHOW_OLD_PRICE'] == 'Y') { ?>
						<span class="discount_price"><?= ($boolDiscountShow ? $minPrice['PRINT_VALUE'] : ''); ?></span>
					<? } ?>
					</strong>
					<span class="actual_price"><?= $minPrice['PRINT_DISCOUNT_VALUE']; ?></span>
		        </div>
        	<? }
			} ?>
        <!--END productPrice-->
        <!--productCount-->
        <div class="productCount">
            <strong><?= GetMessage("CT_QUANTITY") ?>:</strong>
            <div class="middleSelectBlock">
                <div class="elementQuant">
                    <div>
						<input id="<? echo $arItemIDs['QUANTITY']; ?>" type="text" class="quantityText" data-quantity-variable="<?=$arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="<? echo (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])
								? 1
								: $arResult['CATALOG_MEASURE_RATIO']
							); ?>">
                    </div>
                </div>
            </div>
        </div>
        <!--END productCount-->
        <!--productColor-->
        <? if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) { ?>
	        <div class="productColor horizontalFilterWrap">
	            <strong><?= GetMessage("CT_OFFERS") ?>:</strong>

	            <div class="firstFilter item_card_offers">
	                <p data-sort="" data-offer-id="0" class="firstFiltElement1" id="activeFirstFilt"><span class="col"></span>Не выбрано</p>
	                <div class="hidingMenu">
	                	<?foreach ($arResult["OFFERS"] as $offer) {?>
		                    <?
		                    $offerNameVisible = $offer["NAME"];
		                    $offerName = array();
		                    ?>
		                    <? foreach ($arParams["~OFFER_TREE_PROPS"] as $offerPropName) { ?>
		                        <? 
		                            if ($offer["PROPERTIES"][$offerPropName]["VALUE"]) {
		                                $offerName[] = $offer["PROPERTIES"][$offerPropName]["VALUE"];
		                        } ?>
	                        <? } ?>
	                        <?
	                        if (count($offerName) > 0) {
                                $offerNameVisible = trim(implode(", ", $offerName));
                            }     
	                        ?>
		                    <p data-offer-id="<?= $offer["ID"] ?>" data-item-can-buy="<?= $offer["CATALOG_QUANTITY"] ?>" data-offer-buy-link="<?= $offer["ADD_URL"] ?>" class="js-offer-option"><?= $offerNameVisible ?></p>
	                    <?}?>
	                </div>
	            </div>
	        </div>
	        <input type="hidden" value="" name="card_quantity" />
        <? } ?>
        <!--END productColor-->

        <div class="productFavorites">
            <a href=""><?= GetMessage("CT_ADD_TO_FAVORITE") ?></a>
        </div>
        <div class="productComment">
            <a href=""><?= GetMessage("CT_ASK_QUESTION") ?></a>
        </div>
        <?
        if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
			$canBuy = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['CAN_BUY'];
		} else {
			$canBuy = $arResult['CAN_BUY'];
		}
		$item_have_offers = is_array($arResult['OFFERS']);
		$addToBasketBtnMessage = GetMessage('CT_BCE_CATALOG_ADD');
		$notAvailableMessage = ($arParams['MESS_NOT_AVAILABLE'] != '' ? $arParams['MESS_NOT_AVAILABLE'] : GetMessageJS('CT_BCE_CATALOG_NOT_AVAILABLE')); ?>
		<? if ($canBuy) {?>
			<a href="<?= $arResult['ADD_URL'] ?>" data-offer-id="0" data-item-have-offers="<?= $item_have_offers ?>" data-main-item-id="<?= $arResult['ID'] ?>" class="js-add-to-basket addBtn"><span></span><? echo $addToBasketBtnMessage; ?></a> 
		<? } ?>
		<span id="<? echo $arItemIDs['NOT_AVAILABLE_MESS']; ?>" class="bx_notavailable" style="display: <? echo (!$canBuy ? '' : 'none'); ?>;"><? echo $notAvailableMessage; ?></span>
    </div>
    <!--END productCardDesc-->
    <div class="basketBody tabs">
    <div class="basketBodyMenu tabsLinks">
        <a href="#characters" class="active"><?= GetMessage("CT_CHARACTERISTICS") ?></a>
        <a href="#docs"><?= GetMessage("CT_DOCS") ?></a>
        <!--<a href="#video">Видео</a>-->
    </div>
    <div id="characters" class="basketBlock productSlider" style="display: block">
		<div id="characteristics_wrapper">
			<? foreach ($arResult['DISPLAY_PROPERTIES'] as $property_code => $property) { ?>
				<? if ($property['VALUE'] && !is_array($property['VALUE'])) { ?>
				<div class="characteristics_block">
					<div class="characteristic_title"><?= $property['NAME'] ?>:</div>
					<div class="characteristic_value"><?= $property['VALUE'] ?></div>
				</div>
				<? } ?>
			<? } ?>
		</div>
    </div>
    <div id="docs" class="basketBlock productSlider" style="display: none">
        <!--jcarousel-wrapper-->
        <div class="jcarousel-wrapper">
            <!--jcarousel-->
            <div class="jcarousel">
                <ul>
                    <li>
                        <div class="reviesElement">
                            <div class="productWrapper">

                                <a href="" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="" class="infoDocDownload"></a>
                                <p class="infoDocName">Инструкция по сборке</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="reviesElement">
                            <div class="productWrapper">
                                <a href="" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="" class="infoDocDownload"></a>
                                <p class="infoDocName">Инструкция по сборке</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="reviesElement">
                            <div class="productWrapper">
                                <a href="" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="" class="infoDocDownload"></a>
                                <p class="infoDocName">Инструкция по сборке</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="reviesElement">
                            <div class="productWrapper">
                                <a href="" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="" class="infoDocDownload"></a>
                                <p class="infoDocName">Инструкция по сборке</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="reviesElement">
                            <div class="productWrapper">
                                <a href="" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="" class="infoDocDownload"></a>
                                <p class="infoDocName">Инструкция по сборке</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <a href="" class="jcarousel-control-prev"></a>
            <a href="" class="jcarousel-control-next"></a>
        </div>
        <!--END jcarousel-wrapper-->
    </div>
    <div id="video" class="basketBlock productSlider" style="display: none">
        <!--jcarousel-wrapper-->
        <div class="jcarousel-wrapper">
            <!--jcarousel-->
            <div class="jcarousel">
                <ul>
                    <li>
                        <div class="reviesElement">
                            <div class="productWrapper">

                                <a href="" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="" class="infoDocDownload"></a>
                                <p class="infoDocName">Инструкция по сборке</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="reviesElement">
                            <div class="productWrapper">
                                <a href="" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="" class="infoDocDownload"></a>
                                <p class="infoDocName">Инструкция по сборке</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="reviesElement">
                            <div class="productWrapper">
                                <a href="" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="" class="infoDocDownload"></a>
                                <p class="infoDocName">Инструкция по сборке</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="reviesElement">
                            <div class="productWrapper">
                                <a href="" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="" class="infoDocDownload"></a>
                                <p class="infoDocName">Инструкция по сборке</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="reviesElement">
                            <div class="productWrapper">
                                <a href="" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="" class="infoDocDownload"></a>
                                <p class="infoDocName">Инструкция по сборке</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <a href="" class="jcarousel-control-prev"></a>
            <a href="" class="jcarousel-control-next"></a>
        </div>
        <!--END jcarousel-wrapper-->
    </div>
</div>