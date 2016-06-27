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
                        <?foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader) {
                            $arHeader["name"] = (isset($arHeader["name"]) ? (string)$arHeader["name"] : '');
                            if ($arHeader["name"] == '')
                                $arHeader["name"] = GetMessage("SALE_".$arHeader["id"]);
                            $arHeaders[] = $arHeader["id"];

                        }?>
                        <th class="elementName item" id="col_NAME"><?=GetMessage("SALE_PRODUCT_NAME")?></th>
                        <th class="elementColor custom"><?=GetMessage("SALE_PRODUCT_OFFER")?></th>
                        <th class="elementPrice price" id="col_PRICE"><?=GetMessage("SALE_PRICE")?></th>
                        <th class="elementQuant custom" id="col_QUANTITY"><?=GetMessage("SALE_QUANTITY")?></th>
                        <th class="elementFinalPrice custom" id="col_SUM"><?=GetMessage("SALE_SUM")?></th>
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
                                                    $url = $templateFolder."/images/nophoto.png";
                                                    endif;
                                            ?>
                                            <img src="<?=$url?>" alt="" />
                                        </a>
                                    </div>

                                    <a class="elementTitle" href="<?=$arItem["DETAIL_PAGE_URL"] ?>">
                                        <span>                                                 
                                            <?=$arItem["NAME"]?>                                             
                                        </span>
                                    </a>
                                    <?if ($arResult["ITEMS_PROPS"][$arItem["PRODUCT_ID"]]["CML2_ARTICLE"]) {?>
                                        <p class="elemendCode"><?=$arResult["ITEMS_PROPS"][$arItem["PRODUCT_ID"]]["CML2_ARTICLE"]?></p>
                                        <?}?>
                                </td>

                                <td class="elementColor">



                                </td>

                                <td class="elementPrice price">

                                    <p class="current_price" id="current_price_<?=$arItem["ID"]?>">     
                                        <?=$arItem["PRICE_FORMATED"]?>                                  
                                    </p>
                                    <p class="old_price" id="old_price_<?=$arItem["ID"]?>">
                                        <?if (floatval($arItem["DISCOUNT_PRICE_PERCENT"]) > 0):?>
                                            <?=$arItem["FULL_PRICE_FORMATED"]?>
                                            <?endif;?>
                                    </p>

                                </td>

                                <td class="elementQuant custom">    

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
                                            onchange="updateQuantity('QUANTITY_INPUT_<?=$arItem["ID"]?>', '<?=$arItem["ID"]?>', <?=$ratio?>, <?=$useFloatQuantityJS?>)"
                                            >
                                        <? 
                                            if (!isset($arItem["MEASURE_RATIO"])) {
                                                $arItem["MEASURE_RATIO"] = 1;
                                            }

                                            if (floatval($arItem["MEASURE_RATIO"]) != 0) {
                                            ?>    
                                            <a href="javascript:void(0);" class="plus" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'up', <?=$useFloatQuantityJS?>);"></a>
                                            <a href="javascript:void(0);" class="minus" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'down', <?=$useFloatQuantityJS?>);"></a>
                                            <?}?>
                                    </div>


                                    <input type="hidden" id="QUANTITY_<?=$arItem['ID']?>" name="QUANTITY_<?=$arItem['ID']?>" value="<?=$arItem["QUANTITY"]?>" />
                                </td>

                                <td class="elementFinalPrice">         
                                    <p id="sum_<?=$arItem["ID"]?>">
                                        <?=$arItem["SUM"];?>
                                    </p>
                                </td>

                                <td class="elementActions">
                                    <a href="" class="likedButton js_add_to_favorite"><p></p></a>
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

            <div class="discountsBlock">

                <p class="titleText"><?=GetMessage("SALE_DISCOUNTS")?></p>

                <div class="discountBodyBlock">
                    <p class="titleText"><?=GetMessage("SALE_YOU_HAVE_NO_DOSCOUNTS")?></p>

                    <p class="bodyText"><?=GetMessage("SALE_DISCOUNTS_LEARN_MORE")?></p>
                    <a href="" class="salesDetail"><p><?=GetMessage("SALE_DISCOUNTS_MORE_LINK")?></p></a>

                    <div class="orangeRound">15%</div>
                    <div class="yellowRound">10%</div>
                    <div class="greenRound">5%</div>
                </div>
            </div>

            <div class="decorBlock bx_ordercart_order_sum">
                <p class="titleText"><?=GetMessage("SALE_PROCESSING")?></p>

                <p class="orderPrice"><?=GetMessage("SALE_ORDER_SUMM")?>
                    <span id="PRICE_WITHOUT_DISCOUNT">
                        <?if (floatval($arResult["DISCOUNT_PRICE_ALL"]) > 0):?>
                            <?=$arResult["PRICE_WITHOUT_DISCOUNT"]?>
                            <?endif;?>
                    </span>
                </p>

                <p class="orderDiscount" ><?=GetMessage("SALE_CONTENT_DISCOUNT")?><span id="TOTAL_DISCOUNT"><?=$arResult["DISCOUNT_PRICE_ALL_FORMATED"]?></span></p>

                <p class="orderBonus"><?=GetMessage("SALE_YOUR_BONUSES")?><span>0 Р</span></p>

                <p class="orderSertificate"><?=GetMessage("SALE_YOUR_SERTIFICATES")?><span>0 Р</span></p>

                <p class="totalPrice" ><?=GetMessage("SALE_TOTAL")?><span id="allSum_FORMATED"><?=$arResult["allSum_FORMATED"]?></span></p>
            </div>

            <div class="couponInputBlock">
                <div class="bx_ordercart_order_pay_left" id="coupons_block">
                    <?
                        if ($arParams["HIDE_COUPON"] != "Y") {
                        ?>
                        <div class="bx_ordercart_coupon">
                            <input type="text" id="coupon" name="COUPON" value="" onchange="enterCoupon();" placeholder="<?=GetMessage("SALE_ENTER_COUPON")?>">
                            <button disabled onclick="enterCoupon();"><?=GetMessage("SALE_SEND_COUPON")?></button>
                        </div><?
                            /*  //список введенных купонов
                            if (!empty($arResult['COUPON_LIST'])) {
                            foreach ($arResult['COUPON_LIST'] as $oneCoupon) {
                            $couponClass = 'disabled';
                            switch ($oneCoupon['STATUS']) {
                            case DiscountCouponsManager::STATUS_NOT_FOUND:
                            case DiscountCouponsManager::STATUS_FREEZE:
                            $couponClass = 'bad';
                            break;
                            case DiscountCouponsManager::STATUS_APPLYED:
                            $couponClass = 'good';
                            break;
                            }
                            ?><div class="bx_ordercart_coupon">
                            <div class="bx_ordercart_coupon_notes">
                            <?
                            if (isset($oneCoupon['CHECK_CODE_TEXT'])) {
                            echo htmlspecialcharsbx($oneCoupon['COUPON'])." - ".(is_array($oneCoupon['CHECK_CODE_TEXT']) ? implode('<br>', $oneCoupon['CHECK_CODE_TEXT']) : $oneCoupon['CHECK_CODE_TEXT']);
                            }
                            ?></div>
                            </div><?
                            }
                            unset($couponClass, $oneCoupon);
                            }*/
                        } 
                    ?>
                </div>


            </div>
            <div class="orderConfirmBlock">
                <a href="javascript:void(0)" onclick="checkOut();" class="checkout"><p><?=GetMessage("SALE_MAKE_ORDER")?></p></a>
            </div>

        </div>
    </div>

    <script>
        BX.ready(function() {     
            recalcBasketAjax({}); 
        });
    </script>

    <?
        else:
    ?>
    <div id="basket_items_list" >
        <table>
            <tbody>
                <tr>
                    <td colspan="<?=$numCells?>" style="text-align:center">
                        <div class="empty_basket"><?=GetMessage("SALE_NO_ITEMS");?></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?
        endif;
?>