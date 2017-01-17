<? foreach ($arResult['ITEMS'] as $key => $arItem) {
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

	if (isset($arItem['OFFERS']) && !empty($arItem['OFFERS'])) {
		$first_offer = $arItem["OFFERS"][0];
	}

  
?>

<li id="<? echo $strMainID; ?>">
    <div class="productWrapper">                    
        <? if (isset($arItem['OFFERS']) && !empty($arItem['OFFERS'])) { ?>
            <?
            $k = 0;
            foreach ($arItem['OFFERS'] as $offer) {?>
                <p data-offer-id="<?=$offer["ID"]?>" class="price" <?if ($k != 0){?>style="display: none;"<?}?> data-item-id="<?=$arItem["ID"]?>">
                    <?
                        $minPrice = (isset($offer['RATIO_PRICE']) ? $offer['RATIO_PRICE'] : $offer['MIN_PRICE']);

                        echo ($minPrice['PRINT_DISCOUNT_VALUE']) ? $minPrice['PRINT_DISCOUNT_VALUE'] : GetMessage("WITHOUT_PRICE");

                        if ('Y' == $arParams['SHOW_OLD_PRICE'] && $minPrice['DISCOUNT_VALUE'] < $minPrice['VALUE']) {?>
                        <span class="old_price"><? echo $minPrice['PRINT_VALUE']; ?></span>
                        <?
                        }

                        unset($minPrice);
                    ?> &nbsp;
                </p>
                <?$k++;}
        } else { ?>
               <p class="price">
                    <?
                        $minPrice = $arItem["MIN_PRICE_TMP"];

                        echo ($minPrice['PRINT_DISCOUNT_VALUE']) ? $minPrice['PRINT_DISCOUNT_VALUE'] : GetMessage("WITHOUT_PRICE");

                        if ('Y' == $arParams['SHOW_OLD_PRICE'] && $minPrice['DISCOUNT_VALUE'] < $minPrice['VALUE']) {?>
                        <span class="old_price"><? echo $minPrice['PRINT_VALUE']; ?></span>
                        <?
                        }

                        unset($minPrice);
                    ?> &nbsp;
                </p>
        <? } ?>
        <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="productimg">
			<?
			if ($first_offer['DETAIL_PICTURE']['ID']) {
                $preview_path = getResizedImage($first_offer['DETAIL_PICTURE']['ID'], BLOCKS_PREVIEW_WIDTH, BLOCKS_PREVIEW_HEIGHT, BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
            } else {
                $preview_path = $this->GetFolder().'/images/nophoto.png';
            }
			?>
            <img src="<?= $preview_path ?>" alt="<?=$arItem["NAME"]?>"/>
        </a>

        <div class="blocks_element_main_title">
            <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" data-element-full-name="<?= $arItem["NAME"] ?>" class="productName"><?= $arItem["NAME"] ?></a>
        </div>
        
        <div class="blocks_offers">
        	<? if (isset($arItem['OFFERS']) && !empty($arItem['OFFERS'])) { ?>
        	<div class="blocks_offers_wrapper">
        		<div class="blocks_offers_select">
        			<?
	                    $offerNameVisible = $first_offer["NAME"];
	                    $offerName = array();
	                    ?>
	                    <? foreach ($arParams["~OFFER_TREE_PROPS"] as $offerPropName) { ?>
	                        <?
	                            if ($first_offer["PROPERTIES"][$offerPropName]["VALUE"]) {
	                                $offerName[] = $first_offer["PROPERTIES"][$offerPropName]["VALUE"];
	                        } ?>
	                    <? } ?>
	                    <?
	                    if (count($offerName) > 0) {
	                        $offerNameVisible = trim(implode(", ", $offerName));
	                    }
                    ?>
        			<div class="blocks_offers_title">
        				<span class="title_container"><?= $offerNameVisible ?></span>
        			</div>
        			<div class="blocks_offers_arrows"></div>
        		</div>
        		<div class="blocks_offers_options_wrapper">
        			<ul>
        				<?foreach ($arItem["OFFERS"] as $offer) {?>
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

							if ($offer['DETAIL_PICTURE']['ID']) {
                                $preview_path = getResizedImage($offer['DETAIL_PICTURE']['ID'], BLOCKS_PREVIEW_WIDTH, BLOCKS_PREVIEW_HEIGHT, BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
                            } else {
                                $preview_path = BLOCKS_NO_PHOTO;
                            }
	                        ?>
		                    <li data-offer-id="<?= $offer["ID"] ?>" data-item-can-buy="<?= $offer["CATALOG_QUANTITY"] ?>" data-offer-buy-link="<?= $offer["ADD_URL"] ?>" data-preview-image="<?= $preview_path ?>" ><?= $offerNameVisible ?></li>
	                    <?}?>
        			</ul>
        		</div>
        	</div>
        	<? } else { ?>
        	<div class="blocks_no_offers">
        		<?= GetMessage("NO_OFFERS") ?>
        	</div>
        	<? } ?>
        </div>
        
        <div class="blocks_operations">
        	<div class="blocks_operations_wrapper">
        		<div class="blocks_operations_quantity">
					<div class="blocks_operations_container">
						<div class="blocks_operations_minus quantityMinus"></div>
						<div class="blocks_operations_quantity"><input data-item-id="<?= $first_offer ? $first_offer['ID'] : $arItem['ID'] ?>" data-name="quantity" data-quantity-variable="<?=$arParams["PRODUCT_QUANTITY_VARIABLE"]?>" class="quantityText js-item-quantity" type="text" value="1" /></div>
						<div class="blocks_operations_minus quantityPlus"></div>
					</div>
        		</div>
        		<div class="blocks_operations_buttons">
        			<!-- Кнопка лайка -->
                    <div class="productLikeBlock changingLike">
                    	<a href="javascript:void(0)"
			               class="list_favorite blockLink <?= $arResult['USER_AUTHORIZED'] ?  ($arItem['USER_HAVE_ITEM_IN_FAVORITE'] ? " active already_in_favorite" : " js_add_to_favorite") : " js_favorite_need_auth" ?>"
			               data-favorite-product-id="<?= $arItem["ID"] ?>"
			               data-favorite-delete="<?= $arItem['USER_HAVE_ITEM_IN_FAVORITE'] ? "Y" : "" ?>"
			               data-favorite-item-id="<?= $arItem['USER_HAVE_ITEM_IN_FAVORITE'] ?>">
			            </a>
                    </div>
        			<!-- Кнопка корзины -->
                    <? if (isset($arItem['OFFERS']) && !empty($arItem['OFFERS'])) { ?>
                        <div id="<? echo $first_offer['BASKET_ACTIONS']; ?>" <?if ($first_offer['IN_BASKET'] == "Y"){?>title="<?=GetMessage("PRODUCT_ALREADY_IN_BASKET")?>"<?}?>  class="bx_catalog_item_controls_blocktwo productBasketBlock changingBasket <?if ($arItem['IN_BASKET'] == "Y"){?> active<?}?>">
                            <a id="<? echo $first_offer['BUY_LINK']; ?>" data-item-id="<?= $first_offer ? $first_offer['ID'] : $arItem['ID'] ?>" class="blockLink bx_bt_button bx_medium <?if ($arItem['IN_BASKET'] != "Y") {?>js-add-to-basket <?}?>" href="<?=$first_offer['ADD_URL']?>" rel="nofollow"></a>
                        </div>
                    <? } else { ?>
                    	<div id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" <?if ($arItem['IN_BASKET'] == "Y"){?>title="<?=GetMessage("PRODUCT_ALREADY_IN_BASKET")?>"<?}?>  class="bx_catalog_item_controls_blocktwo productBasketBlock changingBasket <?if ($arItem['IN_BASKET'] == "Y"){?> active<?}?>">
                            <a id="<? echo $arItemIDs['BUY_LINK']; ?>" data-item-id="<?= $first_offer ? $first_offer['ID'] : $arItem['ID'] ?>" class="blockLink bx_bt_button bx_medium <?if ($arItem['IN_BASKET'] != "Y") {?>js-add-to-basket <?}?>" href="<?=$arItem['ADD_URL']?>" rel="nofollow"></a>
                        </div>
                    <? } ?>
        		</div>
        	</div>
        </div>
        <div class="logosContainer">
			<? if (isset($arItem['OFFERS']) && !empty($arItem['OFFERS'])) { ?>
	        	<? foreach ($arItem['OFFERS'] as $offer) { ?>
	        		<? $item_quantity = getQuantityLang($offer["CATALOG_QUANTITY"]); ?>
				        <div style="display:<?= $first_offer == $offer ? "block" : "none" ?>" data-offer-id="<?= $offer["ID"] ?>" class="blocks_stock_block <?= $item_quantity ?>">
							<div class="lvl_block"></div>
							<div class="stock_popup">
								<div class="block_popup_text"><?= GetMessage($item_quantity) ?></div>
								<div class="block_popup_quantity"><?= getQuantityText($offer["CATALOG_QUANTITY"]) ?></div>
							</div>
						</div>
	        	<? } ?>
	        <? } else {
	        	$item_quantity = getQuantityLang($arItem["CATALOG_QUANTITY"]); ?>
			        <div class="blocks_stock_block <?= $item_quantity ?>">
						<div class="lvl_block"></div>
						<div class="stock_popup">
							<div class="block_popup_text"><?= GetMessage($item_quantity) ?></div>
							<div class="block_popup_quantity"><?= getQuantityText($arItem["CATALOG_QUANTITY"]) ?></div>
						</div>
					</div>
	         <? } ?>
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
                var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
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
                        var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
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
                    var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
                </script>
                <?
                }
            }
        ?>
    </div>
</li>
<? } ?>