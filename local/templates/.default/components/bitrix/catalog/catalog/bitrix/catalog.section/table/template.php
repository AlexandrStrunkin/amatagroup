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
<?
    if (!empty($arResult['ITEMS'])) {
        $templateLibrary = array('popup');
        $currencyList = '';
        if (!empty($arResult['CURRENCIES'])) {
            $templateLibrary[] = 'currency';
            $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
        }
        $templateData = array(
            'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
            'TEMPLATE_LIBRARY' => $templateLibrary,
            'CURRENCIES' => $currencyList
        );
        unset($currencyList, $templateLibrary);

        $arSkuTemplate = array();
        if (!empty($arResult['SKU_PROPS'])) {
            foreach ($arResult['SKU_PROPS'] as &$arProp) {
                $templateRow = '';
                if ('TEXT' == $arProp['SHOW_MODE']) {
                    if (5 < $arProp['VALUES_COUNT']) {
                        $strClass = 'bx_item_detail_size full';
                        $strWidth = ($arProp['VALUES_COUNT']*20).'%';
                        $strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
                        $strSlideStyle = '';
                    } else {
                        $strClass = 'bx_item_detail_size';
                        $strWidth = '100%';
                        $strOneWidth = '20%';
                        $strSlideStyle = 'display: none;';
                    }
                    $templateRow .= '<div class="'.$strClass.'" id="#ITEM#_prop_'.$arProp['ID'].'_cont">'.
                    '<span class="bx_item_section_name_gray">'.htmlspecialcharsex($arProp['NAME']).'</span>'.
                    '<div class="bx_size_scroller_container"><div class="bx_size"><ul id="#ITEM#_prop_'.$arProp['ID'].'_list" style="width: '.$strWidth.';">';
                    foreach ($arProp['VALUES'] as $arOneValue) {
                        $arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
                        $templateRow .= '<li data-treevalue="'.$arProp['ID'].'_'.$arOneValue['ID'].'" data-onevalue="'.$arOneValue['ID'].'" style="width: '.$strOneWidth.';" title="'.$arOneValue['NAME'].'"><i></i><span class="cnt">'.$arOneValue['NAME'].'</span></li>';
                    }
                    $templateRow .= '</ul></div>'.
                    '<div class="bx_slide_left" id="#ITEM#_prop_'.$arProp['ID'].'_left" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
                    '<div class="bx_slide_right" id="#ITEM#_prop_'.$arProp['ID'].'_right" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
                    '</div></div>';
                } elseif ('PICT' == $arProp['SHOW_MODE']) {
                    if (5 < $arProp['VALUES_COUNT']) {
                        $strClass = 'bx_item_detail_scu full';
                        $strWidth = ($arProp['VALUES_COUNT']*20).'%';
                        $strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
                        $strSlideStyle = '';
                    } else {
                        $strClass = 'bx_item_detail_scu';
                        $strWidth = '100%';
                        $strOneWidth = '20%';
                        $strSlideStyle = 'display: none;';
                    }
                    $templateRow .= '<div class="'.$strClass.'" id="#ITEM#_prop_'.$arProp['ID'].'_cont">'.
                    '<span class="bx_item_section_name_gray">'.htmlspecialcharsex($arProp['NAME']).'</span>'.
                    '<div class="bx_scu_scroller_container"><div class="bx_scu"><ul id="#ITEM#_prop_'.$arProp['ID'].'_list" style="width: '.$strWidth.';">';
                    foreach ($arProp['VALUES'] as $arOneValue) {
                        $arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
                        $templateRow .= '<li data-treevalue="'.$arProp['ID'].'_'.$arOneValue['ID'].'" data-onevalue="'.$arOneValue['ID'].'" style="width: '.$strOneWidth.'; padding-top: '.$strOneWidth.';"><i title="'.$arOneValue['NAME'].'"></i>'.
                        '<span class="cnt"><span class="cnt_item" style="background-image:url(\''.$arOneValue['PICT']['SRC'].'\');" title="'.$arOneValue['NAME'].'"></span></span></li>';
                    }
                    $templateRow .= '</ul></div>'.
                    '<div class="bx_slide_left" id="#ITEM#_prop_'.$arProp['ID'].'_left" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
                    '<div class="bx_slide_right" id="#ITEM#_prop_'.$arProp['ID'].'_right" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
                    '</div></div>';
                }
                $arSkuTemplate[$arProp['CODE']] = $templateRow;
            }
            unset($templateRow, $arProp);
        }

        $strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
        $strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
        $arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

    ?>


    <div class="elementBlocksWrap smallElementList">   


        <div class="elementsTable">
            <div class="basketBlock basketBody">
                <table>
                    <thead>
                        <tr>
                            <th class="elementName"><?=GetMessage("PRODUCT_NAME")?></th>
                            <th class="elementColor"><?=GetMessage("PRODUCT_OFFERS")?></th>
                            <th class="elementQuant"><?=GetMessage("PRODUCT_QUANTITY")?></th>
                            <th class="elementPrice"><?=GetMessage("PRODUCT_PRICE")?></th>
                            <th class="elementActions"><?=GetMessage("PRODUCT_ACTIONS")?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?
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
                                if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE']))
                                    $minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);

                                $arItem["MIN_PRICE_TMP"] = $minPrice;

                            ?>

                            <tr id="<? echo $strMainID; ?>">
                                <td class="elementName">
                                    <div class="itemImgContainet">
                                        <a href="<?=$arItem['DETAIL_PAGE_URL'];?>">
                                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>">
                                        </a>
                                        <? if (isset($arItem['OFFERS']) || !empty($arItem['OFFERS'])) {
												foreach ($arItem['OFFERS'] as $offer) { ?>
													<?
													// ���� ���� � ���� ������
													if (isset($offer['DETAIL_PICTURE']) || !empty($offer['DETAIL_PICTURE'])) {
													?>
														<a class="table_previews" data-preview-offer-id="<?= $offer["ID"] ?>" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
															<img src="<?= getResizedImage($offer['DETAIL_PICTURE']['ID'], ELEMENT_CARD_PREVIEW_WIDTH, ELEMENT_CARD_PREVIEW_HEIGHT, BX_RESIZE_IMAGE_PROPORTIONAL_ALT) ?>" alt=""/>
														</a>
													<? } else {?>
                                                        <a class="table_previews" data-preview-offer-id="<?= $offer["ID"] ?>" href="<?= SITE_TEMPLATE_PATH ?>/images/nophoto.png">
                                                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/nophoto.png" alt=""/>
                                                        </a>
                                                    <?} ?>
											<? 	}
											}
										?>
                                    </div>

                                    <?//������� ������
                                        if ($arItem["MIN_PRICE_TMP"]['DISCOUNT_VALUE'] < $arItem["MIN_PRICE_TMP"]['VALUE'] && $arItem["MIN_PRICE_TMP"]["DISCOUNT_DIFF_PERCENT"] > 0) {?>
                                        <p class="elementStatus statusExpected">-<?=$arItem["MIN_PRICE_TMP"]["DISCOUNT_DIFF_PERCENT"];?>%</p>
                                        <? //������� �������. ���� �����  ������ ����� 2 ������ �����
                                        } else if (date("U") - 86400 * FRESH_PRODUCT_STATUS_LENGTH <= MakeTimeStamp($arItem["DATE_CREATE"], "DD.MM.YYYY HH:MI:SS")) {
                                        ?>
                                        <p class="elementStatus statusByOrderEmpty" title="<?=GetMessage("FRESH_PRODUCT")?>">FRESH</p>
                                        <?} else if (date("U") - 86400 * NEW_PRODUCT_STATUS_LENGTH <= MakeTimeStamp($arItem["DATE_CREATE"], "DD.MM.YYYY HH:MI:SS")) {
                                        ?>
                                        <p class="elementStatus statusByOrder" title="<?=GetMessage("NEW_PRODUCT")?>">NEW</p>
                                        <?
                                            //������� ��������� �����������. ���� �����  ������ ����� 2 ���� �����
                                        } else /*if ($arItem["CAN_BUY"] == "Y")*/{?>
                                        <p class="elementStatus statusInStock" style="<?= $arItem["CAN_BUY"] == "Y" ? "" : "display:none" ?>" ><?= GetMessage("PRODUCT_AVAILABLE") ?></p>
                                        <?}?>
                                    <br>
                                    <p class="elementTitle">
                                        <span>
                                            <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" title="<?=$arItem["NAME"]?>">
                                                <?=$arItem["NAME"]?>
                                            </a>
                                        </span>
                                    </p>

                                    <p class="elemendCode"><?=$arItem["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></p>
                                </td>
                                <td class="elementColor">
                                    <?if (isset($arItem['OFFERS']) && !empty($arItem['OFFERS'])) {?>

                                    <?if (count($arItem['OFFERS']) > 1) {?>
                                        <div class="selectric-wrapper selectric-basketSelect">
                                            <select name="color" data-item-id="<?=$arItem["ID"]?>" class="js-offer-select">

                                                <?foreach ($arItem["OFFERS"] as $offer) {

                                                            $offer_name_visible = $offer["NAME"];
                                                            $offerName = array();

                                                        foreach ($arParams["OFFER_TREE_PROPS"] as $offer_prop_name) {
                                                                if (!empty($offer["PROPERTIES"][$offer_prop_name]["VALUE"])) {
                                                                    $offerName[] = $offer["PROPERTIES"][$offer_prop_name]["VALUE"];
                                                                }
                                                            }
                                                            if (count($offerName) > 0) {
                                                                $offer_name_visible = trim(implode(", ", $offerName));
                                                            }
                                                        ?>
                                                        <option value="<?=$offer["ADD_URL"]?>" data-offer-id="<?=$offer["ID"]?>"><?=$offer_name_visible?></option>
                                                    <?}?>
                                                </select>
                                            </div>
                                            <?} else if (!stristr($offer["NAME"], '(��������)')){?>
                                                <?foreach ($arItem["OFFERS"] as $offer) {?>
                                                    <p value="<?=$offer["ADD_URL"]?>" data-offer-id="<?=$offer["ID"]?>"><?=$offer["NAME"]?></p>
                                                <?}?>
                                            <?} else if ($arItem["PROPERTIES"]["MATERIAL_1"]["VALUE"]){?>
                                                <p><?=$arItem["PROPERTIES"]["MATERIAL_1"]["NAME"] . ': '. $arItem["PROPERTIES"]["MATERIAL_1"]["VALUE"]?></p>
                                            <?}?>
                                        <?} else if ($arItem["PROPERTIES"]["MATERIAL_1"]["VALUE"]) {?>
                                            <p><?=$arItem["PROPERTIES"]["MATERIAL_1"]["NAME"] . ': '. $arItem["PROPERTIES"]["MATERIAL_1"]["VALUE"]?></p>
                                        <?}?>
                                </td>

                                <td class="elementQuant">
                                    <?if (($arItem['CAN_BUY'] && empty($arItem["OFFERS"])) || !empty($arItem["OFFERS"])) {?>
                                        <div>
                                            <input type="text" class="quantityText js-item-quantity" value="1" data-name="quantity" data-quantity-variable="<?=$arParams["PRODUCT_QUANTITY_VARIABLE"]?>" data-item-id="<?=$arItem['ID'];?>">
                                            <a href="" class="quantityPlus"></a>
                                            <a href="" class="quantityMinus"></a>
                                        </div>
                                        <?}?>
                                </td>

                                <td class="elementPrice">

                                    <? if (isset($arItem['OFFERS']) && !empty($arItem['OFFERS'])) { ?>

                                        <?
                                        $k = 0;
                                        foreach ($arItem['OFFERS'] as $offer) {?>
                                            <p data-offer-id="<?=$offer["ID"]?>" class="js-item-price" <?if ($k != 0){?>style="display: none;"<?}?> data-item-id="<?=$arItem["ID"]?>">
                                                <?
                                                    $minPrice = (isset($offer['RATIO_PRICE']) ? $offer['RATIO_PRICE'] : $offer['MIN_PRICE']);

                                                    echo $minPrice['PRINT_DISCOUNT_VALUE'];

                                                    if ('Y' == $arParams['SHOW_OLD_PRICE'] && $minPrice['DISCOUNT_VALUE'] < $minPrice['VALUE']) {?>
                                                    <br>&nbsp;<span class="old_price"><? echo $minPrice['PRINT_VALUE']; ?></span>
                                                    <?
                                                    }

                                                    unset($minPrice);
                                                ?> &nbsp;
                                            </p>
                                            <?$k++;}
                                    } else {?>
                                           <p data-offer-id="<?=$offer["ID"]?>" class="js-item-price">
                                                <?
                                                    $minPrice = $arItem["MIN_PRICE_TMP"];

                                                    echo $minPrice['PRINT_DISCOUNT_VALUE'];

                                                    if ('Y' == $arParams['SHOW_OLD_PRICE'] && $minPrice['DISCOUNT_VALUE'] < $minPrice['VALUE']) {?>
                                                    <br>&nbsp;<span class="old_price"><? echo $minPrice['PRINT_VALUE']; ?></span>
                                                    <?
                                                    }

                                                    unset($minPrice);
                                                ?> &nbsp;
                                            </p>
                                    <?}?>


                                    <?
                                        $showSubscribeBtn = false;
                                        $compareBtnMessage = ($arParams['MESS_BTN_COMPARE'] != '' ? $arParams['MESS_BTN_COMPARE'] : GetMessage('CT_BCS_TPL_MESS_BTN_COMPARE'));
                                        if (!isset($arItem['OFFERS']) || empty($arItem['OFFERS'])) {
                                            $emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
                                            if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties) {
                                            ?>
                                            <div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none;">
                                                <?
                                                    if (!empty($arItem['PRODUCT_PROPERTIES_FILL'])) {
                                                        foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) {
                                                        ?>
                                                        <input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
                                                        <?
                                                            if (isset($arItem['PRODUCT_PROPERTIES'][$propID]))
                                                                unset($arItem['PRODUCT_PROPERTIES'][$propID]);
                                                        }
                                                    }
                                                    $emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
                                                    if (!$emptyProductProperties) {
                                                    ?>
                                                    <table>
                                                        <?
                                                            foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo) {
                                                            ?>
                                                            <tr><td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
                                                                <td>
                                                                    <?
                                                                        if(
                                                                            'L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE']
                                                                            && 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE']
                                                                        ) {
                                                                            foreach($propInfo['VALUES'] as $valueID => $value) {
                                                                            ?><label><input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?></label><br><?
                                                                            }
                                                                        } else {
                                                                        ?><select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
                                                                            foreach($propInfo['VALUES'] as $valueID => $value) {
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
                                            if ($arParams['DISPLAY_COMPARE'])
                                            {
                                                $arJSParams['COMPARE'] = array(
                                                    'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
                                                    'COMPARE_PATH' => $arParams['COMPARE_PATH']
                                                );
                                            }
                                            unset($emptyProductProperties);
                                        ?><script type="text/javascript">
                                            var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
                                        </script><?
                                        } else {

                                            if ('Y' == $arParams['PRODUCT_DISPLAY_MODE']) {
                                                if (!empty($arItem['OFFERS_PROP'])) {
                                                    $arSkuProps = array();
                                                ?>
                                                <div class="bx_catalog_item_scu" id="<? echo $arItemIDs['PROP_DIV']; ?>" style="display:none"><?
                                                    foreach ($arSkuTemplate as $code => $strTemplate)
                                                    {
                                                        if (!isset($arItem['OFFERS_PROP'][$code]))
                                                            continue;
                                                        echo '<div>', str_replace('#ITEM#_prop_', $arItemIDs['PROP'], $strTemplate), '</div>';
                                                    }
                                                    foreach ($arResult['SKU_PROPS'] as $arOneProp)
                                                    {
                                                        if (!isset($arItem['OFFERS_PROP'][$arOneProp['CODE']]))
                                                            continue;
                                                        $arSkuProps[] = array(
                                                            'ID' => $arOneProp['ID'],
                                                            'SHOW_MODE' => $arOneProp['SHOW_MODE'],
                                                            'VALUES_COUNT' => $arOneProp['VALUES_COUNT']
                                                        );
                                                    }
                                                    foreach ($arItem['JS_OFFERS'] as &$arOneJs)
                                                    {
                                                        if (0 < $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'])
                                                        {
                                                            $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'] = '-'.$arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'].'%';
                                                            $arOneJs['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'] = '-'.$arOneJs['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'].'%';
                                                        }
                                                    }
                                                    unset($arOneJs);
                                                ?></div>
                                                <?
                                                    if ($arItem['OFFERS_PROPS_DISPLAY'])
                                                    {
                                                        foreach ($arItem['JS_OFFERS'] as $keyOffer => $arJSOffer)
                                                        {
                                                            $strProps = '';
                                                            if (!empty($arJSOffer['DISPLAY_PROPERTIES']))
                                                            {
                                                                foreach ($arJSOffer['DISPLAY_PROPERTIES'] as $arOneProp)
                                                                {
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
                                            else
                                            {
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
                                    }?>

                                </td>

                                <td class="elementActions">
                                    <a href="javascript:void(0)"
                                        class="list_favorite likedButton <?= $arResult['USER_AUTHORIZED'] ?  ($arItem['USER_HAVE_ITEM_IN_FAVORITE'] ? " activeLikeBut already_in_favorite" : " js_add_to_favorite") : " js_favorite_need_auth" ?>"
                                        data-favorite-product-id="<?= $arItem["ID"] ?>"
                                        data-favorite-delete="<?= $arItem['USER_HAVE_ITEM_IN_FAVORITE'] ? "Y" : "" ?>"
                                        data-favorite-item-id="<?= $arItem['USER_HAVE_ITEM_IN_FAVORITE'] ?>">
                                        <p></p>
                                    </a>

                                    <? if (($arItem['CAN_BUY'] && empty($arItem["OFFERS"])) || !empty($arItem["OFFERS"])) { ?>
                                    	<?$first_offer = $arItem["OFFERS"][0];?>
                                        <div id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>"  <?if ($arItem['IN_BASKET'] == "Y") { ?> title="<?=GetMessage("PRODUCT_ALREADY_IN_BASKET")?>"<?}?>  class="bx_catalog_item_controls_blocktwo productBasketBlock changingBasket <?if ($arItem['IN_BASKET'] == "Y"){?> active<?}?>">
                                            <a id="<? echo $arItemIDs['BUY_LINK']; ?>" data-item-id="<?=$arItem["ID"]?>" class="blockLink bx_bt_button bx_medium <?if ($arItem['IN_BASKET'] != "Y") {?>js-add-to-basket <?}?>" href="<?if (empty($arItem["OFFERS"])) {echo $arItem['ADD_URL'];} elseif ((isset($arItem['OFFERS']) && !empty($arItem['OFFERS'])) || $first_offer) { echo $first_offer['ADD_URL']; }?>" rel="nofollow"></a>
                                        </div>
                                        <? } ?>
                                </td>

                            </tr>
                            <?}?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <script type="text/javascript">
        BX.message({
            BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
            BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
            ADD_TO_BASKET_OK: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
            TITLE_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
            TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
            TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
            BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
            BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
            BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>',
            BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
            COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK') ?>',
            COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
            COMPARE_TITLE: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE') ?>',
            BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
            SITE_ID: '<? echo SITE_ID; ?>'
        });
    </script>

    <?if ($arParams["DISPLAY_BOTTOM_PAGER"]) {?>
        <?$this->SetViewTarget('catalog_pager'); //show in section.php?>
        <?echo $arResult["NAV_STRING"];?>
        <?$this->EndViewTarget();?>
        <?}?>
    <?}?>

    <?$this->SetViewTarget('catalog_section_description'); //show in header.php?>
    <?=$arResult["DESCRIPTION"]?>
    <?$this->EndViewTarget();?>