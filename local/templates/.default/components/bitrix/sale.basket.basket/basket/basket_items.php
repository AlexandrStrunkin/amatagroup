<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    use Bitrix\Sale\DiscountCouponsManager;

    if (!empty($arResult["ERROR_MESSAGE"]))
        ShowError($arResult["ERROR_MESSAGE"]);

    $bDelayColumn  = false;
    $bDeleteColumn = false;
    $bWeightColumn = false;
    $bPropsColumn  = false;
    $bPriceType    = false;

    if ($normalCount > 0):
    ?>



    <div id="basket_items_list">
        <div class="bx_ordercart_order_table_container">
            <table id="basket_items">
                <thead>
                    <tr>
                        <th class="elementName"><?=GetMessage("SALE_PRODUCT_NAME")?></th>
                        <th class="elementColor"><?=GetMessage("SALE_PRODUCT_OFFER")?></th>
                        <th class="elementPrice"><?=GetMessage("SALE_PRICE")?></th>
                        <th class="elementQuant"><?=GetMessage("SALE_QUANTITY")?></th>
                        <th class="elementFinalPrice"><?=GetMessage("SALE_SUM")?></th>
                        <th class="elementActions"><?=GetMessage("SALE_ACTIONS")?></th>
                    </tr>
                </thead>

                <tbody>
                    <?
                        foreach ($arResult["GRID"]["ROWS"] as $k => $arItem):

                            if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y"): 
                            ?>            

                            <tr id="<?=$arItem["ID"]?>">

                                <td class="elementName">
                                    <div>
                                        <a href="<?=$arItem["DETAIL_PAGE_URL"] ?>">
                                            <?
                                                if (strlen($arItem["PREVIEW_PICTURE_SRC"]) > 0):
                                                    $url = $arItem["PREVIEW_PICTURE_SRC"];
                                                    elseif (strlen($arItem["DETAIL_PICTURE_SRC"]) > 0):
                                                    $url = $arItem["DETAIL_PICTURE_SRC"];
                                                    else:
                                                    $url = $templateFolder."/images/no_photo.png";
                                                    endif;
                                            ?>
                                            <img src="<?=$url?>" alt="" />
                                        </a>
                                    </div>

                                    <p class="elementTitle">
                                        <span>
                                            <a href="<?=$arItem["DETAIL_PAGE_URL"] ?>">
                                                <?=$arItem["NAME"]?>
                                            </a>
                                        </span>
                                    </p>

                                    <p class="elemendCode">артикул</p>
                                </td>

                                <td class="elementColor">
                                    <select class="basketSelect">
                                        <option>Avorio</option>
                                        <option>Almond Beige</option>
                                        <option>Ququ</option>
                                    </select>
                                </td>

                                <td class="elementPrice price">
                                    
                                        <div class="current_price" id="current_price_<?=$arItem["ID"]?>">
                                        <p>
                                            <?=$arItem["PRICE_FORMATED"]?>
                                             </p>
                                        </div>
                                        <div  id="old_price_<?=$arItem["ID"]?>">
                                         <p class="old_price">
                                            <?if (floatval($arItem["DISCOUNT_PRICE_PERCENT"]) > 0):?>
                                                <?=$arItem["FULL_PRICE_FORMATED"]?>
                                                <?endif;?>
                                                </p>
                                        </div>
                                   
                                </td>

                                <td class="elementQuant">    

                                            <?
                                                if (!isset($arItem["MEASURE_RATIO"])) {
                                                    $arItem["MEASURE_RATIO"] = 1;
                                                }

                                                if (floatval($arItem["MEASURE_RATIO"]) != 0) {
                                                ?>
                                                    <?
                                                        $ratio = isset($arItem["MEASURE_RATIO"]) ? $arItem["MEASURE_RATIO"] : 0;
                                                        $max = isset($arItem["AVAILABLE_QUANTITY"]) ? "max=\"".$arItem["AVAILABLE_QUANTITY"]."\"" : "";
                                                        $useFloatQuantity = ($arParams["QUANTITY_FLOAT"] == "Y") ? true : false;
                                                        $useFloatQuantityJS = ($useFloatQuantity ? "true" : "false");
                                                    ?>
                                                    <div id="basket_quantity_control">
                                                        <input
                                                            type="text"
                                                            size="3"
                                                            id="QUANTITY_INPUT_<?=$arItem["ID"]?>"
                                                            name="QUANTITY_INPUT_<?=$arItem["ID"]?>"
                                                            size="2"
                                                            maxlength="18"
                                                            min="0"
                                                            <?=$max?>
                                                            step="<?=$ratio?>"
                                                            style="max-width: 50px"
                                                            value="<?=$arItem["QUANTITY"]?>"
                                                            class="quantityText"
                                                            onchange="updateQuantity('QUANTITY_INPUT_<?=$arItem["ID"]?>', '<?=$arItem["ID"]?>', <?=$ratio?>, <?=$useFloatQuantityJS?>)"
                                                            >
                                                        <a href="javascript:void(0);" class="plus" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'up', <?=$useFloatQuantityJS?>);"></a>
                                                        <a href="javascript:void(0);" class="minus" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'down', <?=$useFloatQuantityJS?>);"></a>
                                                    </div>
                                                <?}?>
                                     
                                    <input type="hidden" id="QUANTITY_<?=$arItem['ID']?>" name="QUANTITY_<?=$arItem['ID']?>" value="<?=$arItem["QUANTITY"]?>" />
                                </td>

                                <td class="elementFinalPrice">         
                                        <p id="sum_<?=$arItem["ID"]?>">
                                            <?=$arItem["FULL_PRICE_FORMATED"];?>
                                        </p>
                                </td>

                                <td class="elementActions">
                                    <a href="" class="likedButton"><p></p></a>
                                    <a href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["delete"])?>" class="deleteButton"><p></p></a>
                                </td>        

                            </tr>
                            <?
                                endif;
                            endforeach;
                    ?>
                </tbody>
            </table>
        </div>
        <input type="hidden" id="column_headers" value="<?=CUtil::JSEscape(implode($arHeaders, ","))?>" />
        <input type="hidden" id="offers_props" value="<?=CUtil::JSEscape(implode($arParams["OFFERS_PROPS"], ","))?>" />
        <input type="hidden" id="action_var" value="<?=CUtil::JSEscape($arParams["ACTION_VARIABLE"])?>" />
        <input type="hidden" id="quantity_float" value="<?=$arParams["QUANTITY_FLOAT"]?>" />
        <input type="hidden" id="count_discount_4_all_quantity" value="<?=($arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] == "Y") ? "Y" : "N"?>" />
        <input type="hidden" id="price_vat_show_value" value="<?=($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N"?>" />
        <input type="hidden" id="hide_coupon" value="<?=($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N"?>" />
        <input type="hidden" id="use_prepayment" value="<?=($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N"?>" />

        <div class="bx_ordercart_order_pay">

            <div class="bx_ordercart_order_pay_left" id="coupons_block">
                <?
                    if ($arParams["HIDE_COUPON"] != "Y")
                    {
                    ?>
                    <div class="bx_ordercart_coupon">
                        <span><?=GetMessage("STB_COUPON_PROMT")?></span><input type="text" id="coupon" name="COUPON" value="" onchange="enterCoupon();">
                    </div><?
                        if (!empty($arResult['COUPON_LIST']))
                        {
                            foreach ($arResult['COUPON_LIST'] as $oneCoupon)
                            {
                                $couponClass = 'disabled';
                                switch ($oneCoupon['STATUS'])
                                {
                                    case DiscountCouponsManager::STATUS_NOT_FOUND:
                                    case DiscountCouponsManager::STATUS_FREEZE:
                                        $couponClass = 'bad';
                                        break;
                                    case DiscountCouponsManager::STATUS_APPLYED:
                                        $couponClass = 'good';
                                        break;
                                }
                            ?><div class="bx_ordercart_coupon"><input disabled readonly type="text" name="OLD_COUPON[]" value="<?=htmlspecialcharsbx($oneCoupon['COUPON']);?>" class="<? echo $couponClass; ?>"><span class="<? echo $couponClass; ?>" data-coupon="<? echo htmlspecialcharsbx($oneCoupon['COUPON']); ?>"></span><div class="bx_ordercart_coupon_notes"><?
                                    if (isset($oneCoupon['CHECK_CODE_TEXT']))
                                    {
                                        echo (is_array($oneCoupon['CHECK_CODE_TEXT']) ? implode('<br>', $oneCoupon['CHECK_CODE_TEXT']) : $oneCoupon['CHECK_CODE_TEXT']);
                                    }
                                ?></div></div><?
                            }
                            unset($couponClass, $oneCoupon);
                        }
                    }
                    else
                    {
                    ?>&nbsp;<?
                    }
                ?>
            </div>
            <div class="bx_ordercart_order_pay_right">
                <table class="bx_ordercart_order_sum">
                    <?if ($bWeightColumn):?>
                        <tr>
                            <td class="custom_t1"><?=GetMessage("SALE_TOTAL_WEIGHT")?></td>
                            <td class="custom_t2" id="allWeight_FORMATED"><?=$arResult["allWeight_FORMATED"]?></td>
                        </tr>
                        <?endif;?>
                    <?if ($arParams["PRICE_VAT_SHOW_VALUE"] == "Y"):?>
                        <tr>
                            <td><?echo GetMessage('SALE_VAT_EXCLUDED')?></td>
                            <td id="allSum_wVAT_FORMATED"><?=$arResult["allSum_wVAT_FORMATED"]?></td>
                        </tr>
                        <tr>
                            <td><?echo GetMessage('SALE_VAT_INCLUDED')?></td>
                            <td id="allVATSum_FORMATED"><?=$arResult["allVATSum_FORMATED"]?></td>
                        </tr>
                        <?endif;?>

                    <tr>
                        <td class="fwb"><?=GetMessage("SALE_TOTAL")?></td>
                        <td class="fwb" id="allSum_FORMATED"><?=str_replace(" ", "&nbsp;", $arResult["allSum_FORMATED"])?></td>
                    </tr>
                    <tr>
                        <td class="custom_t1"></td>
                        <td class="custom_t2" style="text-decoration:line-through; color:#828282;" id="PRICE_WITHOUT_DISCOUNT">
                            <?if (floatval($arResult["DISCOUNT_PRICE_ALL"]) > 0):?>
                                <?=$arResult["PRICE_WITHOUT_DISCOUNT"]?>
                                <?endif;?>
                        </td>
                    </tr>

                </table>
                <div style="clear:both;"></div>
            </div>
            <div style="clear:both;"></div>
            <div class="bx_ordercart_order_pay_center">

                <?if ($arParams["USE_PREPAYMENT"] == "Y" && strlen($arResult["PREPAY_BUTTON"]) > 0):?>
                    <?=$arResult["PREPAY_BUTTON"]?>
                    <span><?=GetMessage("SALE_OR")?></span>
                    <?endif;?>

                <a href="javascript:void(0)" onclick="checkOut();" class="checkout"><?=GetMessage("SALE_ORDER")?></a>
            </div>
        </div>
    </div>
    <?
        else:
    ?>
    <div id="basket_items_list">
        <table>
            <tbody>
                <tr>
                    <td colspan="<?=$numCells?>" style="text-align:center">
                        <div class=""><?=GetMessage("SALE_NO_ITEMS");?></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?
        endif;
?>