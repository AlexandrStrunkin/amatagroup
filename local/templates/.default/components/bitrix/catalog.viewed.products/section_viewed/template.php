<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$frame = $this->createFrame()->begin();

if (!empty($arResult['ITEMS']))
{?> 
	<!--viewedElementBlock-->
<div class="viewedElementBlock">
    <div class="widthWrapper">
        <!--viewedBlock-->
        <div class="viewedBlock productCarousel elmentsList">
            <h2><?= GetMessage("VIEWED_PRODUCTS") ?></h2>

            <!--jcarousel-wrapper-->
            <div class="jcarousel-wrapper">
                <!--jcarousel-->
                <div class="jcarousel ">
	<?$templateData = array(
		'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
		'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
	);

	$arSkuTemplate = array();
	if(is_array($arResult['SKU_PROPS']))
	{
		foreach ($arResult['SKU_PROPS'] as $iblockId => $skuProps)
		{
			$arSkuTemplate[$iblockId] = array();
			foreach ($skuProps as &$arProp)
			{
				ob_start();
				if ('TEXT' == $arProp['SHOW_MODE'])
				{
					if (5 < $arProp['VALUES_COUNT'])
					{
						$strClass = 'bx_item_detail_size full';
						$strWidth = ($arProp['VALUES_COUNT'] * 20) . '%';
						$strOneWidth = (100 / $arProp['VALUES_COUNT']) . '%';
						$strSlideStyle = '';
					}
					else
					{
						$strClass = 'bx_item_detail_size';
						$strWidth = '100%';
						$strOneWidth = '20%';
						$strSlideStyle = 'display: none;';
					}
					?>
				<div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
					<span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>

					<div class="bx_size_scroller_container">
						<div class="bx_size">
							<ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;"><?
								foreach ($arProp['VALUES'] as $arOneValue)
								{
									?>
								<li
									data-treevalue="<? echo $arProp['ID'] . '_' . $arOneValue['ID']; ?>"
									data-onevalue="<? echo $arOneValue['ID']; ?>"
									style="width: <? echo $strOneWidth; ?>;"
									><i></i><span class="cnt"><? echo htmlspecialcharsex($arOneValue['NAME']); ?></span>
									</li><?
								}
								?></ul>
						</div>
						<div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
						<div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
					</div>
					</div><?
				}
				elseif ('PICT' == $arProp['SHOW_MODE'])
				{
					if (5 < $arProp['VALUES_COUNT'])
					{
						$strClass = 'bx_item_detail_scu full';
						$strWidth = ($arProp['VALUES_COUNT'] * 20) . '%';
						$strOneWidth = (100 / $arProp['VALUES_COUNT']) . '%';
						$strSlideStyle = '';
					}
					else
					{
						$strClass = 'bx_item_detail_scu';
						$strWidth = '100%';
						$strOneWidth = '20%';
						$strSlideStyle = 'display: none;';
					}
					?>
				<div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
					<span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>

					<div class="bx_scu_scroller_container">
						<div class="bx_scu">
							<ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;"><?
								foreach ($arProp['VALUES'] as $arOneValue)
								{
									?>
								<li
									data-treevalue="<? echo $arProp['ID'] . '_' . $arOneValue['ID'] ?>"
									data-onevalue="<? echo $arOneValue['ID']; ?>"
									style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>;"
									><i title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"></i>
							<span class="cnt"><span class="cnt_item"
													style="background-image:url('<? echo $arOneValue['PICT']['SRC']; ?>');"
													title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"
									></span></span></li><?
								}
								?></ul>
						</div>
						<div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
						<div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
					</div>
					</div><?
				}
				$arSkuTemplate[$iblockId][$arProp['CODE']] = ob_get_contents();
				ob_end_clean();
				unset($arProp);
			}
		}
	}

	?>

	<ul><?
	$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
	$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
	$elementDeleteParams = array('CONFIRM' => GetMessage('CVP_TPL_ELEMENT_DELETE_CONFIRM'));
	foreach ($arResult['ITEMS'] as $key => $arItem) {
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);

        $strMainID = $this->GetEditAreaId($arItem['ID']);

        $arItemIDs = array(
            'ID' => $strMainID,
            'PICT' => $strMainID.'_pict',
            'SECOND_PICT' => $strMainID.'_secondpict',
            'STICKER_ID' => $strMainID.'_sticker',
            'SECOND_STICKER_ID' => $strMainID.'_secondsticker',
            'QUANTITY' => $strMainID.'_quantity',
            'QUANTITY_DOWN' => $strMainID.'_quant_down',
            'QUANTITY_UP' => $strMainID.'_quant_up',
            'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
            'BUY_LINK' => $strMainID.'_buy_link',
            'BASKET_ACTIONS' => $strMainID.'_basket_actions',
            'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
            'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
            'COMPARE_LINK' => $strMainID.'_compare_link',

            'PRICE' => $strMainID.'_price',
            'DSC_PERC' => $strMainID.'_dsc_perc',
            'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',
            'PROP_DIV' => $strMainID.'_sku_tree',
            'PROP' => $strMainID.'_prop_',
            'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
            'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
        );

        $strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

        $productTitle = (
            isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
            ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
            : $arItem['NAME']
        );
        $imgTitle = (
            isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
            ? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
            : $arItem['NAME']
        );

        $minPrice = false;
        if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE'])) {
            $minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);
        }



    ?>   

    <li id="<? echo $strMainID; ?>">
        <div class="productWrapper">
            <p class="price" id="<? echo $arItemIDs['PRICE']; ?>">
                <? if (isset($arItem['OFFERS']) && !empty($arItem['OFFERS'])) { ?> 
                    <?             
                    foreach ($arItem['OFFERS'] as $offer) { 
                        $tempMinPrice = (isset($offer['RATIO_PRICE']) ? $offer['RATIO_PRICE'] : $offer['MIN_PRICE']);                                 
                        if($minPrice['VALUE'] > $tempMinPrice['VALUE']) {
                            $minPrice = $tempMinPrice;    
                        } elseif (empty($minPrice)) {
                            $minPrice = (isset($offer['RATIO_PRICE']) ? $offer['RATIO_PRICE'] : $offer['MIN_PRICE']);    
                        }              
                    }
                    echo ($minPrice['PRINT_DISCOUNT_VALUE']) ? $minPrice['PRINT_DISCOUNT_VALUE'] : GetMessage("WITHOUT_PRICE");
                    if ('Y' == $arParams['SHOW_OLD_PRICE'] && $minPrice['DISCOUNT_VALUE'] < $minPrice['VALUE']) {?>
                        <span class="old_price"><? echo $minPrice['PRINT_VALUE']; ?></span>
                        <?unset($minPrice);
                    }
                } else {
                    $minPrice = $arItem["MIN_PRICE_TMP"];
                    echo ($minPrice['PRINT_DISCOUNT_VALUE']) ? $minPrice['PRINT_DISCOUNT_VALUE'] : GetMessage("WITHOUT_PRICE"); 
                    if ('Y' == $arParams['SHOW_OLD_PRICE'] && $minPrice['DISCOUNT_VALUE'] < $minPrice['VALUE']) {?>
                        <span class="old_price"><? echo $minPrice['PRINT_VALUE']; ?></span>
                        
                    <?}
                    unset($minPrice);
                }?>
            </p>
            <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="productimg">
                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>"/>
            </a>

            <div>
                <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" data-element-full-name="<?= $arItem["NAME"] ?>" class="productName"><?=$arItem["NAME"]?></a>

                <?if ((!isset($arItem['OFFERS']) || empty($arItem['OFFERS'])) && $arItem['CAN_BUY']) {?>

                    <div id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" <?if ($arItem['IN_BASKET'] == "Y"){?>title="<?=GetMessage("PRODUCT_ALREADY_IN_BASKET")?>"<?}?>  class="bx_catalog_item_controls_blocktwo productBasketBlock changingBasket <?if ($arItem['IN_BASKET'] == "Y"){?> active<?}?>">
                        <a id="<? echo $arItemIDs['BUY_LINK']; ?>" class="blockLink bx_bt_button bx_medium <?if ($arItem['IN_BASKET'] != "Y") {?>js-add-to-basket <?}?>" href="<?=$arItem['ADD_URL']?>" rel="nofollow"></a>
                    </div>

                    <?}?>

                <div class="productLikeBlock changingLike">
                	<a href="javascript:void(0)"
		               class="list_favorite blockLink <?= $arResult['USER_AUTHORIZED'] ?  ($arItem['USER_HAVE_ITEM_IN_FAVORITE'] ? " active already_in_favorite" : " js_add_to_favorite") : " js_favorite_need_auth" ?>"
		               data-favorite-product-id="<?= $arItem["ID"] ?>"
		               data-favorite-delete="<?= $arItem['USER_HAVE_ITEM_IN_FAVORITE'] ? "Y" : "" ?>"
		               data-favorite-item-id="<?= $arItem['USER_HAVE_ITEM_IN_FAVORITE'] ?>">
		            </a>
                </div>


            </div>

            <?
	        	$item_quantity = getQuantityLang($arItem["CATALOG_QUANTITY"]);
	        ?>
            <div class="logosContainer">
				<div class="blocks_stock_block <?= $item_quantity ?>">
					<div class="lvl_block"></div>
					<div class="stock_popup">
						<div class="block_popup_text"><?= GetMessage($item_quantity) ?></div>
						<div class="block_popup_quantity"><?= getQuantityText($arItem["CATALOG_QUANTITY"]) ?></div>
					</div>
				</div>
                <?//шильдик скидки
                    if ($arItem["MIN_PRICE_TMP"]['DISCOUNT_VALUE'] < $arItem["MIN_PRICE_TMP"]['VALUE'] && $arItem["MIN_PRICE_TMP"]["DISCOUNT_DIFF_PERCENT"] > 0) {?>
                    <div class="discountLogoWrapper">-<?=$arItem["MIN_PRICE_TMP"]["DISCOUNT_DIFF_PERCENT"];?>%</div>
                    <?}?>

                <?//шильдик новинки. Если товар  создан менее 2 недель назад
                    if (date("U") - 86400 * NEW_PRODUCT_STATUS_LENGTH <= MakeTimeStamp($arItem["DATE_CREATE"], "DD.MM.YYYY HH:MI:SS")) {
                    ?>
                    <div class="newLogoWrapper" title="<?=GetMessage("NEW_PRODUCT")?>">NEW</div>
                    <?}?>

                <?//шильдик последние поступления. Если товар  создан менее 2 дней назад
                    if (date("U") - 86400 * FRESH_PRODUCT_STATUS_LENGTH <= MakeTimeStamp($arItem["DATE_CREATE"], "DD.MM.YYYY HH:MI:SS")) {
                    ?>
                    <div class="freshLogoWrapper" title="<?=GetMessage("FRESH_PRODUCT")?>">FRESH</div>
                    <?}?>



                <?/*
                    <div class="bestLogoWrapper">BEST</div>
                    <div class="saleLogoWrapper">SALE</div>
                */?>
            </div>

            <?
                $showSubscribeBtn = false;
                $compareBtnMessage = ($arParams['MESS_BTN_COMPARE'] != '' ? $arParams['MESS_BTN_COMPARE'] : GetMessage('CT_BCS_TPL_MESS_BTN_COMPARE'));
                if (!isset($arItem['OFFERS']) || empty($arItem['OFFERS'])) {

                    $emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
                    if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties) {
                    ?>
                    <div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none;">
                        <?
                            if (!empty($arItem['PRODUCT_PROPERTIES_FILL']))
                            {
                                foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
                                {
                                ?>
                                <input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
                                <?
                                    if (isset($arItem['PRODUCT_PROPERTIES'][$propID]))
                                        unset($arItem['PRODUCT_PROPERTIES'][$propID]);
                                }
                            }
                            $emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
                            if (!$emptyProductProperties)
                            {
                            ?>
                            <table>
                                <?
                                    foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo)
                                    {
                                    ?>
                                    <tr><td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
                                        <td>
                                            <?
                                                if(
                                                    'L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE']
                                                    && 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE']
                                                )
                                                {
                                                    foreach($propInfo['VALUES'] as $valueID => $value)
                                                    {
                                                    ?><label><input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?></label><br><?
                                                    }
                                                }
                                                else
                                                {
                                                ?><select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
                                                    foreach($propInfo['VALUES'] as $valueID => $value)
                                                    {
                                                    ?><option value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? 'selected' : ''); ?>><? echo $value; ?></option><?
                                                    }
                                                ?></select><?
                                                }
                                            ?>
                                        </td></tr>
                                    <?
                                    }
                                ?>
                            </table>
                            <?
                            }
                        ?>
                    </div>
                    <?
                    }
                    $arJSParams = array(
                        'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
                        'SHOW_QUANTITY' => ($arParams['USE_PRODUCT_QUANTITY'] == 'Y'),
                        'SHOW_ADD_BASKET_BTN' => false,
                        'SHOW_BUY_BTN' => true,
                        'SHOW_ABSENT' => true,
                        'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
                        'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
                        'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
                        'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
                        'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
                        'PRODUCT' => array(
                            'ID' => $arItem['ID'],
                            'NAME' => $productTitle,
                            'PICT' => ('Y' == $arItem['SECOND_PICT'] ? $arItem['PREVIEW_PICTURE_SECOND'] : $arItem['PREVIEW_PICTURE']),
                            'CAN_BUY' => $arItem["CAN_BUY"],
                            'SUBSCRIPTION' => ('Y' == $arItem['CATALOG_SUBSCRIPTION']),
                            'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
                            'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
                            'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
                            'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
                            'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL'],
                            'BASIS_PRICE' => $arItem['MIN_BASIS_PRICE']
                        ),
                        'BASKET' => array(
                            'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
                            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                            'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
                            'EMPTY_PROPS' => $emptyProductProperties,
                            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
                            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
                        ),
                        'VISUAL' => array(
                            'ID' => $arItemIDs['ID'],
                            'PICT_ID' => ('Y' == $arItem['SECOND_PICT'] ? $arItemIDs['SECOND_PICT'] : $arItemIDs['PICT']),
                            'QUANTITY_ID' => $arItemIDs['QUANTITY'],
                            'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
                            'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
                            'PRICE_ID' => $arItemIDs['PRICE'],
                            'BUY_ID' => $arItemIDs['BUY_LINK'],
                            'BASKET_PROP_DIV' => $arItemIDs['BASKET_PROP_DIV'],
                            'BASKET_ACTIONS_ID' => $arItemIDs['BASKET_ACTIONS'],
                            'NOT_AVAILABLE_MESS' => $arItemIDs['NOT_AVAILABLE_MESS'],
                            'COMPARE_LINK_ID' => $arItemIDs['COMPARE_LINK']
                        ),
                        'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
                    );

                    unset($emptyProductProperties);
                ?><script type="text/javascript">
                    var <? echo $strObName; ?> = new JCCatalogSectionViewed(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
                </script><?
                } else {


                    if ('Y' == $arParams['PRODUCT_DISPLAY_MODE']) {
                        if (!empty($arItem['OFFERS_PROP'])) {
                            $arSkuProps = array();
                            if ($arItem['OFFERS_PROPS_DISPLAY']) {
                                foreach ($arItem['JS_OFFERS'] as $keyOffer => $arJSOffer) {
                                    $strProps = '';
                                    if (!empty($arJSOffer['DISPLAY_PROPERTIES'])) {
                                        foreach ($arJSOffer['DISPLAY_PROPERTIES'] as $arOneProp) {
                                            $strProps .= '<br>'.$arOneProp['NAME'].' <strong>'.(
                                                is_array($arOneProp['VALUE'])
                                                ? implode(' / ', $arOneProp['VALUE'])
                                                : $arOneProp['VALUE']
                                            ).'</strong>';
                                        }
                                    }
                                    $arItem['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
                                }
                            }
                            $arJSParams = array(
                                'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
                                'SHOW_QUANTITY' => ($arParams['USE_PRODUCT_QUANTITY'] == 'Y'),
                                'SHOW_ADD_BASKET_BTN' => false,
                                'SHOW_BUY_BTN' => true,
                                'SHOW_ABSENT' => true,
                                'SHOW_SKU_PROPS' => $arItem['OFFERS_PROPS_DISPLAY'],
                                'SECOND_PICT' => $arItem['SECOND_PICT'],
                                'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
                                'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
                                'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
                                'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
                                'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
                                'DEFAULT_PICTURE' => array(
                                    'PICTURE' => $arItem['PRODUCT_PREVIEW'],
                                    'PICTURE_SECOND' => $arItem['PRODUCT_PREVIEW_SECOND']
                                ),
                                'VISUAL' => array(
                                    'ID' => $arItemIDs['ID'],
                                    'PICT_ID' => $arItemIDs['PICT'],
                                    'SECOND_PICT_ID' => $arItemIDs['SECOND_PICT'],
                                    'QUANTITY_ID' => $arItemIDs['QUANTITY'],
                                    'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
                                    'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
                                    'QUANTITY_MEASURE' => $arItemIDs['QUANTITY_MEASURE'],
                                    'PRICE_ID' => $arItemIDs['PRICE'],
                                    'TREE_ID' => $arItemIDs['PROP_DIV'],
                                    'TREE_ITEM_ID' => $arItemIDs['PROP'],
                                    'BUY_ID' => $arItemIDs['BUY_LINK'],
                                    'ADD_BASKET_ID' => $arItemIDs['ADD_BASKET_ID'],
                                    'DSC_PERC' => $arItemIDs['DSC_PERC'],
                                    'SECOND_DSC_PERC' => $arItemIDs['SECOND_DSC_PERC'],
                                    'DISPLAY_PROP_DIV' => $arItemIDs['DISPLAY_PROP_DIV'],
                                    'BASKET_ACTIONS_ID' => $arItemIDs['BASKET_ACTIONS'],
                                    'NOT_AVAILABLE_MESS' => $arItemIDs['NOT_AVAILABLE_MESS'],
                                    'COMPARE_LINK_ID' => $arItemIDs['COMPARE_LINK']
                                ),
                                'BASKET' => array(
                                    'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                                    'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
                                    'SKU_PROPS' => $arItem['OFFERS_PROP_CODES'],
                                    'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
                                    'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
                                ),
                                'PRODUCT' => array(
                                    'ID' => $arItem['ID'],
                                    'NAME' => $productTitle
                                ),
                                'OFFERS' => $arItem['JS_OFFERS'],
                                'OFFER_SELECTED' => $arItem['OFFERS_SELECTED'],
                                'TREE_PROPS' => $arSkuProps,
                                'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
                            );

                        ?>
                        <script type="text/javascript">
                            var <? echo $strObName; ?> = new JCCatalogSectionViewed(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
                        </script>
                        <?
                        }
                    } else {
                        $arJSParams = array(
                            'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
                            'SHOW_QUANTITY' => false,
                            'SHOW_ADD_BASKET_BTN' => false,
                            'SHOW_BUY_BTN' => false,
                            'SHOW_ABSENT' => false,
                            'SHOW_SKU_PROPS' => false,
                            'SECOND_PICT' => $arItem['SECOND_PICT'],
                            'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
                            'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
                            'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
                            'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
                            'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
                            'DEFAULT_PICTURE' => array(
                                'PICTURE' => $arItem['PRODUCT_PREVIEW'],
                                'PICTURE_SECOND' => $arItem['PRODUCT_PREVIEW_SECOND']
                            ),
                            'VISUAL' => array(
                                'ID' => $arItemIDs['ID'],
                                'PICT_ID' => $arItemIDs['PICT'],
                                'SECOND_PICT_ID' => $arItemIDs['SECOND_PICT'],
                                'QUANTITY_ID' => $arItemIDs['QUANTITY'],
                                'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
                                'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
                                'QUANTITY_MEASURE' => $arItemIDs['QUANTITY_MEASURE'],
                                'PRICE_ID' => $arItemIDs['PRICE'],
                                'TREE_ID' => $arItemIDs['PROP_DIV'],
                                'TREE_ITEM_ID' => $arItemIDs['PROP'],
                                'BUY_ID' => $arItemIDs['BUY_LINK'],
                                'ADD_BASKET_ID' => $arItemIDs['ADD_BASKET_ID'],
                                'DSC_PERC' => $arItemIDs['DSC_PERC'],
                                'SECOND_DSC_PERC' => $arItemIDs['SECOND_DSC_PERC'],
                                'DISPLAY_PROP_DIV' => $arItemIDs['DISPLAY_PROP_DIV'],
                                'BASKET_ACTIONS_ID' => $arItemIDs['BASKET_ACTIONS'],
                                'NOT_AVAILABLE_MESS' => $arItemIDs['NOT_AVAILABLE_MESS'],
                                'COMPARE_LINK_ID' => $arItemIDs['COMPARE_LINK']
                            ),
                            'BASKET' => array(
                                'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                                'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
                                'SKU_PROPS' => $arItem['OFFERS_PROP_CODES'],
                                'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
                                'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
                            ),
                            'PRODUCT' => array(
                                'ID' => $arItem['ID'],
                                'NAME' => $productTitle
                            ),
                            'OFFERS' => array(),
                            'OFFER_SELECTED' => 0,
                            'TREE_PROPS' => array(),
                            'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
                        );
                        if ($arParams['DISPLAY_COMPARE'])
                        {
                            $arJSParams['COMPARE'] = array(
                                'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
                                'COMPARE_PATH' => $arParams['COMPARE_PATH']
                            );
                        }
                    ?>
                    <script type="text/javascript">
                        var <? echo $strObName; ?> = new JCCatalogSectionViewed(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
                    </script>
                    <?
                    }
                }
            ?>
        </div>
    </li>
<?
	}
	unset($elementDeleteParams, $elementDelete, $elementEdit);
	?>
	<div style="clear: both;"></div>
	</ul>
	<script type="text/javascript">
		BX.message({
			CVP_MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CVP_TPL_MESS_BTN_BUY')); ?>',
			CVP_MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CVP_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',

			CVP_MESS_BTN_DETAIL: '<? echo ('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('CVP_TPL_MESS_BTN_DETAIL')); ?>',

			CVP_MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('CVP_TPL_MESS_BTN_DETAIL')); ?>',
			CVP_BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
			CVP_BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
			CVP_ADD_TO_BASKET_OK: '<? echo GetMessageJS('CVP_ADD_TO_BASKET_OK'); ?>',
			CVP_TITLE_ERROR: '<? echo GetMessageJS('CVP_CATALOG_TITLE_ERROR') ?>',
			CVP_TITLE_BASKET_PROPS: '<? echo GetMessageJS('CVP_CATALOG_TITLE_BASKET_PROPS') ?>',
			CVP_TITLE_SUCCESSFUL: '<? echo GetMessageJS('CVP_ADD_TO_BASKET_OK'); ?>',
			CVP_BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CVP_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
			CVP_BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
			CVP_BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_CLOSE') ?>'
		});
	</script>
                </div>
                <a href="" class="jcarousel-control-prev"></a>
                <a href="" class="jcarousel-control-next"></a>

            </div>
            <!--END jcarousel-wrapper-->
        </div>
        <!--END viewedBlock-->
    </div>
</div>
<!--END viewedElementBlock-->
<?
}
?>
<?$frame->beginStub();?>
<?$frame->end();?>