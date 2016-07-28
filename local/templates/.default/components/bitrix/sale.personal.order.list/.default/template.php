<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(!empty($arResult['ERRORS']['FATAL'])):?>

	<?foreach($arResult['ERRORS']['FATAL'] as $error):?>
		<?=ShowError($error)?>
	<?endforeach?>

<?else:?>

	<?if(!empty($arResult['ERRORS']['NONFATAL'])):?>

		<?foreach($arResult['ERRORS']['NONFATAL'] as $error):?>
			<?=ShowError($error)?>
		<?endforeach?>

	<?endif?>
    <div class="ordersMenu">
        <a href="#ordersActive" class="activeElement"><?=GetMessage('ACTIVE')?></a>
        <a href="#ordersCompleted"><?=GetMessage('COMPLITED')?></a>
        <a href="#ordersCancelled"><?=GetMessage('CANSELED')?></a>
    </div>
	<?if(!empty($arResult['ORDERS'])):?>

		<?foreach($arResult["ORDER_BY_STATUS"] as $key => $group):?>
            <? if($arResult["INFO"]["STATUS"][$key]["ID"] != 'F' && !$status_active) {?>
                <?$status_active = 'Y';?>
                <div id="ordersActive" class="ordersContainer ordersContainer1">
                <?foreach($group as $k => $order):?>

                    <div class="orderContainer disableOrder">
                        <p class="activeOrderTitle">
                            <?=GetMessage('SPOL_ORDER')?> <?=GetMessage('SPOL_NUM_SIGN')?><?=$order["ORDER"]["ACCOUNT_NUMBER"]?>
                        </p>
                        <div class="statusLogo <?=$arResult["INFO"]["STATUS"][$key]['COLOR']?>">
                            <?=$arResult["INFO"]["STATUS"][$key]["NAME"]?>
                        </div>

                        <div class="orderBodyWrap">
                        <div><p class="orderListTitle"><?=GetMessage('SPOL_BASKET')?></p></div>
                            <table>
                                <thead>
                                    <tr>
                                        <th><?=GetMessage('PICTURE')?></th>
                                        <th><?=GetMessage('NAME')?></th>
                                        <th><?=GetMessage('COLOR')?></th>
                                        <th><?=GetMessage('PRICE')?></th>
                                        <th><?=GetMessage('COUNT')?></th>
                                        <th><?=GetMessage('TOTAL')?></th>
                                    </tr>
                                </thead>
                                <??>
                                <?foreach ($order["BASKET_ITEMS"] as $item):?>
                                      <tr>
                                          <td class="photoColumn">
                                            <a href="<?=$item["DETAIL_PAGE_URL"]?>"><img width="55" src="<?=$item["PICTURE"]?>" alt=""/></a>
                                          </td>
                                    </td>
                                    <td class="nameColumn">
                                        <?if(strlen($item["DETAIL_PAGE_URL"])):?>
                                        <a href="<?=$item["DETAIL_PAGE_URL"]?>" target="_blank"><?=$item['NAME']?></a>
                                        <?endif?>
                                        <p class="identificationNumber"><?=$item["PROPERTY"]['CML2_ARTICLE']["VALUE"]?></p>
                                    </td>
                                    <td class="colorColumn">
                                        <p><?=$item["PROPERTY"]['TSVET']["VALUE_ENUM"]?></p>
                                    </td>
                                    <td class="priceColumn">
                                        <p><?=$item['PRICE'] * 1?> <span class="rub">c</span></p>
                                    </td>
                                    <td class="quantityColumn">
                                        <p><?=$item['QUANTITY']?></p>
                                    </td>
                                    <td class="finalPriceColumn">
                                        <p><?=$item['PRICE'] * $item['QUANTITY']?> <span class="rub">c</span></p>
                                    </td>
                                     </tr>
                                <?endforeach?>
                            </table>
                            <? // DELIVERY SYSTEM ?>
                            <div class="shipingWrap">
                                <?if($order['HAS_DELIVERY']):?>
                                <p class="optionsTitle"><?=GetMessage('SPOL_DELIVERY')?>:</p>
                                <?if(intval($order["ORDER"]["DELIVERY_ID"])):?>
                                    <p class="optionsText"><?=$arResult["INFO"]["DELIVERY"][$order["ORDER"]["DELIVERY_ID"]]["NAME"]?></p>

                                <?elseif(strpos($order["ORDER"]["DELIVERY_ID"], ":") !== false):?>

                                    <?$arId = explode(":", $order["ORDER"]["DELIVERY_ID"])?>
                                    <p class="optionsText">
                                        <?=$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["NAME"]?> (<?=$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["PROFILES"][$arId[1]]["TITLE"]?>) <br />
                                    </p>
                                <?endif?>

                            <?endif?>
                            </div>
                            <div class="addressWrap">
                                <p class="optionsTitle"><?=GetMessage('DELIVERY_ADRESS')?></p>
                                <p><?=$order["LOCATION"]["COUNTRY_NAME"].' '.$order["LOCATION"]["REGION_NAME"].' '.$order["LOCATION"]["CITY_NAME_ORIG"].' ул. '.$order["ADRESS"]["STREET"]["VALUE"].''.$order["ADRESS"]["HOUSING"]["VALUE"].' '.$order["ADRESS"]["BUILDING"]["VALUE"].' '.$order["ADRESS"]["APARTAMENT"]["VALUE"] ?></p>
                            </div>

                             <? // PAY SYSTEM ?>
                            <div class="paymentWrap">
                                <?if(intval($order["ORDER"]["PAY_SYSTEM_ID"])):?>
                                    <p class="optionsTitle"><?=GetMessage('SPOL_PAYSYSTEM')?></p>
                                    <p><?=$arResult["INFO"]["PAY_SYSTEM"][$order["ORDER"]["PAY_SYSTEM_ID"]]["NAME"]?></p>
                                <?endif?>
                            </div>
                            <div class="commentsBlock">
                                <p class="optionsTitle"><?=GetMessage('COMMENT')?></p>
                                <p class="commentsText"><?=$order["ORDER"]["USER_DESCRIPTION"]?></p>
                            </div>
                            <div class="finalBlockWrap">
                                <p><?=GetMessage('SPOL_PAY_SUM')?> <span><?=$order["ORDER"]["FORMATED_PRICE"]?></span></p>
                                <?if($order["ORDER"]["CANCELED"] != "Y"):?>
                                    <a href="<?=$order["ORDER"]["URL_TO_CANCEL"]?>" style="min-width:140px"class="cancelBut"><?=GetMessage('SPOL_CANCEL_ORDER')?></a>
                                <?endif?>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
               </div>


            <?endforeach?>
        </div>
            <?} elseif ($arResult["INFO"]["STATUS"][$key]["ID"] == 'F' && !$status_complited) {?>
                <?$status_complited = 'F';?>
                <div id="ordersCompleted" class="ordersContainer ordersContainer2">
                <?foreach($group as $k => $order):?>
                    <div class="orderContainer disableOrder">
                        <p class="activeOrderTitle">
                            <?=GetMessage('SPOL_ORDER')?> <?=GetMessage('SPOL_NUM_SIGN')?><?=$order["ORDER"]["ACCOUNT_NUMBER"]?>
                        </p>
                        <div class="statusLogo <?=$arResult["INFO"]["STATUS"][$key]['COLOR']?>">
                            <?=$arResult["INFO"]["STATUS"][$key]["NAME"]?>
                        </div>

                        <div class="orderBodyWrap">
                        <div><p class="orderListTitle"><?=GetMessage('SPOL_BASKET')?></p></div>
                            <table>
                                 <thead>
                                    <tr>
                                        <th><?=GetMessage('PICTURE')?></th>
                                        <th><?=GetMessage('NAME')?></th>
                                        <th><?=GetMessage('COLOR')?></th>
                                        <th><?=GetMessage('PRICE')?></th>
                                        <th><?=GetMessage('COUNT')?></th>
                                        <th><?=GetMessage('TOTAL')?></th>
                                    </tr>
                                </thead>
                                <?foreach ($order["BASKET_ITEMS"] as $item):?>
                                      <tr>
                                          <td class="photoColumn">
                                            <a href="<?=$item["DETAIL_PAGE_URL"]?>"><img width="55" src="<?=$item["PICTURE"]?>" alt=""/></a>
                                          </td>
                                    </td>
                                    <td class="nameColumn">
                                        <?if(strlen($item["DETAIL_PAGE_URL"])):?>
                                        <a href="<?=$item["DETAIL_PAGE_URL"]?>" target="_blank"><?=$item['NAME']?></a>
                                        <?endif?>
                                        <p class="identificationNumber"><?=$item["PROPERTY"]['CML2_ARTICLE']["VALUE"]?></p>
                                    </td>
                                    <td class="colorColumn">
                                        <p><?=$item["PROPERTY"]['TSVET']["VALUE_ENUM"]?></p>
                                    </td>
                                    <td class="priceColumn">
                                        <p><?=$item['PRICE'] * 1?> <span class="rub">c</span></p>
                                    </td>
                                    <td class="quantityColumn">
                                        <p><?=$item['QUANTITY']?></p>
                                    </td>
                                    <td class="finalPriceColumn">
                                        <p><?=$item['PRICE'] * $item['QUANTITY']?> <span class="rub">c</span></p>
                                    </td>
                                     </tr>
                                <?endforeach?>
                            </table>
                            <? // DELIVERY SYSTEM ?>
                            <div class="shipingWrap">
                                <?if($order['HAS_DELIVERY']):?>
                                <p class="optionsTitle"><?=GetMessage('SPOL_DELIVERY')?>:</p>
                                <?if(intval($order["ORDER"]["DELIVERY_ID"])):?>
                                    <p class="optionsText"><?=$arResult["INFO"]["DELIVERY"][$order["ORDER"]["DELIVERY_ID"]]["NAME"]?></p>

                                <?elseif(strpos($order["ORDER"]["DELIVERY_ID"], ":") !== false):?>

                                    <?$arId = explode(":", $order["ORDER"]["DELIVERY_ID"])?>
                                    <p class="optionsText">
                                        <?=$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["NAME"]?> (<?=$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["PROFILES"][$arId[1]]["TITLE"]?>) <br />
                                    </p>
                                <?endif?>

                            <?endif?>
                            </div>
                            <div class="addressWrap">
                                <p class="optionsTitle"><?=GetMessage('DELIVERY_ADRESS')?></p>
                                <p><?=$order["LOCATION"]["COUNTRY_NAME"].' '.$order["LOCATION"]["REGION_NAME"].' '.$order["LOCATION"]["CITY_NAME_ORIG"].' ул. '.$order["ADRESS"]["STREET"]["VALUE"].''.$order["ADRESS"]["HOUSING"]["VALUE"].' '.$order["ADRESS"]["BUILDING"]["VALUE"].' '.$order["ADRESS"]["APARTAMENT"]["VALUE"] ?></p>
                            </div>

                             <? // PAY SYSTEM ?>
                            <div class="paymentWrap">
                                <?if(intval($order["ORDER"]["PAY_SYSTEM_ID"])):?>
                                    <p class="optionsTitle"><?=GetMessage('SPOL_PAYSYSTEM')?></p>
                                    <p><?=$arResult["INFO"]["PAY_SYSTEM"][$order["ORDER"]["PAY_SYSTEM_ID"]]["NAME"]?></p>
                                <?endif?>
                            </div>
                            <div class="commentsBlock">
                                <p class="optionsTitle"><?=GetMessage('COMMENT')?></p>
                                <p class="commentsText"><?=$order["ORDER"]["USER_DESCRIPTION"]?></p>
                            </div>
                            <div class="finalBlockWrap">
                                <p><?=GetMessage('SPOL_PAY_SUM')?> <span><?=$order["ORDER"]["FORMATED_PRICE"]?></span></p>
                                <?if($order["ORDER"]["CANCELED"] != "Y"):?>
                                    <a href="<?=$order["ORDER"]["URL_TO_CANCEL"]?>" style="min-width:140px"class="cancelBut"><?=GetMessage('SPOL_CANCEL_ORDER')?></a>
                                <?endif?>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
               </div>


            <?endforeach?>
        </div>
            <?} elseif (empty($arResult["INFO"]["STATUS"][$key]["ID"]) && !$status_close){?>
                <?$status_close = 'N';?>
                <div id="ordersCancelled" class="ordersContainer ordersContainer3">
                <?foreach($group as $k => $order):?>
                    <div class="orderContainer disableOrder">
                        <p class="activeOrderTitle">
                            <?=GetMessage('SPOL_ORDER')?> <?=GetMessage('SPOL_NUM_SIGN')?><?=$order["ORDER"]["ACCOUNT_NUMBER"]?>
                        </p>
                        <div class="statusLogo <?=$arResult["INFO"]["STATUS"][$key]['COLOR']?>">
                            <?=$arResult["INFO"]["STATUS"][$key]["NAME"]?>
                        </div>

                        <div class="orderBodyWrap">
                        <div><p class="orderListTitle"><?=GetMessage('SPOL_BASKET')?></p></div>
                            <table>
                                 <thead>
                                    <tr>
                                        <th><?=GetMessage('PICTURE')?></th>
                                        <th><?=GetMessage('NAME')?></th>
                                        <th><?=GetMessage('COLOR')?></th>
                                        <th><?=GetMessage('PRICE')?></th>
                                        <th><?=GetMessage('COUNT')?></th>
                                        <th><?=GetMessage('TOTAL')?></th>
                                    </tr>
                                </thead>
                                <?foreach ($order["BASKET_ITEMS"] as $item):?>
                                      <tr>
                                          <td class="photoColumn">
                                            <a href="<?=$item["DETAIL_PAGE_URL"]?>"><img width="55" src="<?=$item["PICTURE"]?>" alt=""/></a>
                                          </td>
                                    </td>
                                    <td class="nameColumn">
                                        <?if(strlen($item["DETAIL_PAGE_URL"])):?>
                                        <a href="<?=$item["DETAIL_PAGE_URL"]?>" target="_blank"><?=$item['NAME']?></a>
                                        <?endif?>
                                        <p class="identificationNumber"><?=$item["PROPERTY"]['CML2_ARTICLE']["VALUE"]?></p>
                                    </td>
                                    <td class="colorColumn">
                                        <p><?=$item["PROPERTY"]['TSVET']["VALUE_ENUM"]?></p>
                                    </td>
                                    <td class="priceColumn">
                                        <p><?=$item['PRICE'] * 1?> <span class="rub">c</span></p>
                                    </td>
                                    <td class="quantityColumn">
                                        <p><?=$item['QUANTITY']?></p>
                                    </td>
                                    <td class="finalPriceColumn">
                                        <p><?=$item['PRICE'] * $item['QUANTITY']?> <span class="rub">c</span></p>
                                    </td>
                                     </tr>
                                <?endforeach?>
                            </table>
                            <? // DELIVERY SYSTEM ?>
                            <div class="shipingWrap">
                                <?if($order['HAS_DELIVERY']):?>
                                <p class="optionsTitle"><?=GetMessage('SPOL_DELIVERY')?>:</p>
                                <?if(intval($order["ORDER"]["DELIVERY_ID"])):?>
                                    <p class="optionsText"><?=$arResult["INFO"]["DELIVERY"][$order["ORDER"]["DELIVERY_ID"]]["NAME"]?></p>

                                <?elseif(strpos($order["ORDER"]["DELIVERY_ID"], ":") !== false):?>

                                    <?$arId = explode(":", $order["ORDER"]["DELIVERY_ID"])?>
                                    <p class="optionsText">
                                        <?=$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["NAME"]?> (<?=$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["PROFILES"][$arId[1]]["TITLE"]?>) <br />
                                    </p>
                                <?endif?>

                            <?endif?>
                            </div>
                            <div class="addressWrap">
                                <p class="optionsTitle"><?=GetMessage('DELIVERY_ADRESS')?></p>
                                <p><?=$order["LOCATION"]["COUNTRY_NAME"].' '.$order["LOCATION"]["REGION_NAME"].' '.$order["LOCATION"]["CITY_NAME_ORIG"].' ул. '.$order["ADRESS"]["STREET"]["VALUE"].''.$order["ADRESS"]["HOUSING"]["VALUE"].' '.$order["ADRESS"]["BUILDING"]["VALUE"].' '.$order["ADRESS"]["APARTAMENT"]["VALUE"] ?></p>
                            </div>

                             <? // PAY SYSTEM ?>
                            <div class="paymentWrap">
                                <?if(intval($order["ORDER"]["PAY_SYSTEM_ID"])):?>
                                    <p class="optionsTitle"><?=GetMessage('SPOL_PAYSYSTEM')?></p>
                                    <p><?=$arResult["INFO"]["PAY_SYSTEM"][$order["ORDER"]["PAY_SYSTEM_ID"]]["NAME"]?></p>
                                <?endif?>
                            </div>
                            <div class="commentsBlock">
                                <p class="optionsTitle"><?=GetMessage('COMMENT')?></p>
                                <p class="commentsText"><?=$order["ORDER"]["USER_DESCRIPTION"]?></p>
                            </div>
                            <div class="finalBlockWrap">
                                <p><?=GetMessage('SPOL_PAY_SUM')?> <span><?=$order["ORDER"]["FORMATED_PRICE"]?></span></p>
                                <?if($order["ORDER"]["CANCELED"] != "Y"):?>
                                    <a href="<?=$order["ORDER"]["URL_TO_CANCEL"]?>" style="min-width:140px"class="cancelBut"><?=GetMessage('SPOL_CANCEL_ORDER')?></a>
                                <?endif?>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
               </div>


            <?endforeach?>
        </div>
             <?}?>
   		<?endforeach?>

		<?if(strlen($arResult['NAV_STRING'])):?>
			<?=$arResult['NAV_STRING']?>
		<?endif?>

	<?else:?>
		<?=GetMessage('SPOL_NO_ORDERS')?>
	<?endif?>

<?endif?>