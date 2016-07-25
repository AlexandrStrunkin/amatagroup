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
        <a href="#ordersActive" class="activeElement">Активные</a>
        <a href="#ordersCompleted">Выполненные</a>
        <a href="#ordersCancelled">Отмененные</a>
    </div>
    <div class="bx_my_order_switch">

        <?$nothing = !isset($_REQUEST["filter_history"]) && !isset($_REQUEST["show_all"]);?>

        <?if($nothing || isset($_REQUEST["filter_history"])):?>
            <a class="bx_mo_link" href="<?=$arResult["CURRENT_PAGE"]?>?show_all=Y"><?=GetMessage('SPOL_ORDERS_ALL')?></a>
        <?endif?>

        <?if($_REQUEST["filter_history"] == 'Y' || $_REQUEST["show_all"] == 'Y'):?>
            <a class="bx_mo_link" href="<?=$arResult["CURRENT_PAGE"]?>?filter_history=N"><?=GetMessage('SPOL_CUR_ORDERS')?></a>
        <?endif?>

        <?if($nothing || $_REQUEST["filter_history"] == 'N' || $_REQUEST["show_all"] == 'Y'):?>
            <a class="bx_mo_link" href="<?=$arResult["CURRENT_PAGE"]?>?filter_history=Y"><?=GetMessage('SPOL_ORDERS_HISTORY')?></a>
        <?endif?>

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
                        <div><p class="orderListTitle">Состав заказа</p></div>

                            <table>
                                <thead>
                                <tr>
                                    <th>Фото</th>
                                    <th>Наименование</th>
                                    <th>Цвет</th>
                                    <th>Цена, Р</th>
                                    <th>Кол-во</th>
                                    <th>Итого, Р</th>
                                </tr>
                                </thead>
                                <?foreach ($order["BASKET_ITEMS"] as $item):?>
                                <?$element_id = CIblockElement::GetByID($item["PRODUCT_ID"]) -> Fetch()?>
                                <?$picture = CFile::GetPath($element_id["DETAIL_PICTURE"]);?>
                                <?$db_props_articul = CIBlockElement::GetProperty($element_id["IBLOCK_ID"], $element_id["ID"], "sort", "asc", Array('CODE' => 'CML2_ARTICLE'/*, 'CODE' => 'TSVET'*/)) -> Fetch();
                                /*while($db_props = $db_props_articul ){
                                     $ar_props[$db_props["CODE"]] = $db_props;
                                }  */?>
                                <?arshow($ar_props)?>
                                      <tr>
                                          <td class="photoColumn">
                                            <a href="<?=$item["DETAIL_PAGE_URL"]?>"><img width="55" src="<?=$picture?>" alt=""/></a>
                                          </td>
                                    </td>
                                    <td class="nameColumn">
                                        <?if(strlen($item["DETAIL_PAGE_URL"])):?>
                                        <a href="<?=$item["DETAIL_PAGE_URL"]?>" target="_blank"><?=$item['NAME']?></a>
                                        <?endif?>
                                        <p class="identificationNumber"><?=$db_props_articul["VALUE"]?></p>
                                    </td>
                                    <td class="colorColumn">
                                        <p>Almond Beige</p>
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
                            <a href="<?=$order["ORDER"]["URL_TO_DETAIL"]?>"><?=GetMessage('SPOL_ORDER_DETAIL')?></a>

                            <strong><?=GetMessage('SPOL_PAY_SUM')?>:</strong> <?=$order["ORDER"]["FORMATED_PRICE"]?> <br />

                            <strong><?=GetMessage('SPOL_PAYED')?>:</strong> <?=GetMessage('SPOL_'.($order["ORDER"]["PAYED"] == "Y" ? 'YES' : 'NO'))?> <br />

                            <? // PAY SYSTEM ?>
                            <?if(intval($order["ORDER"]["PAY_SYSTEM_ID"])):?>
                                <strong><?=GetMessage('SPOL_PAYSYSTEM')?>:</strong> <?=$arResult["INFO"]["PAY_SYSTEM"][$order["ORDER"]["PAY_SYSTEM_ID"]]["NAME"]?> <br />
                            <?endif?>

                            <? // DELIVERY SYSTEM ?>
                            <?if($order['HAS_DELIVERY']):?>

                                <strong><?=GetMessage('SPOL_DELIVERY')?>:</strong>

                                <?if(intval($order["ORDER"]["DELIVERY_ID"])):?>

                                    <?=$arResult["INFO"]["DELIVERY"][$order["ORDER"]["DELIVERY_ID"]]["NAME"]?> <br />

                                <?elseif(strpos($order["ORDER"]["DELIVERY_ID"], ":") !== false):?>

                                    <?$arId = explode(":", $order["ORDER"]["DELIVERY_ID"])?>
                                    <?=$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["NAME"]?> (<?=$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["PROFILES"][$arId[1]]["TITLE"]?>) <br />

                                <?endif?>

                            <?endif?>



                            <?=$order["ORDER"]["DATE_STATUS_FORMATED"];?>

                            <?if($order["ORDER"]["CANCELED"] != "Y"):?>
                                <a href="<?=$order["ORDER"]["URL_TO_CANCEL"]?>" style="min-width:140px"class="bx_big bx_bt_button_type_2 bx_cart bx_order_action"><?=GetMessage('SPOL_CANCEL_ORDER')?></a>
                            <?endif?>

                            <a href="<?=$order["ORDER"]["URL_TO_COPY"]?>" style="min-width:140px"class="bx_big bx_bt_button_type_2 bx_cart bx_order_action"><?=GetMessage('SPOL_REPEAT_ORDER')?></a>
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
                            <a href="<?=$order["ORDER"]["URL_TO_DETAIL"]?>"><?=GetMessage('SPOL_ORDER_DETAIL')?></a>

                            <strong><?=GetMessage('SPOL_PAY_SUM')?>:</strong> <?=$order["ORDER"]["FORMATED_PRICE"]?> <br />

                            <strong><?=GetMessage('SPOL_PAYED')?>:</strong> <?=GetMessage('SPOL_'.($order["ORDER"]["PAYED"] == "Y" ? 'YES' : 'NO'))?> <br />

                            <? // PAY SYSTEM ?>
                            <?if(intval($order["ORDER"]["PAY_SYSTEM_ID"])):?>
                                <strong><?=GetMessage('SPOL_PAYSYSTEM')?>:</strong> <?=$arResult["INFO"]["PAY_SYSTEM"][$order["ORDER"]["PAY_SYSTEM_ID"]]["NAME"]?> <br />
                            <?endif?>

                            <? // DELIVERY SYSTEM ?>
                            <?if($order['HAS_DELIVERY']):?>

                                <strong><?=GetMessage('SPOL_DELIVERY')?>:</strong>

                                <?if(intval($order["ORDER"]["DELIVERY_ID"])):?>

                                    <?=$arResult["INFO"]["DELIVERY"][$order["ORDER"]["DELIVERY_ID"]]["NAME"]?> <br />

                                <?elseif(strpos($order["ORDER"]["DELIVERY_ID"], ":") !== false):?>

                                    <?$arId = explode(":", $order["ORDER"]["DELIVERY_ID"])?>
                                    <?=$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["NAME"]?> (<?=$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["PROFILES"][$arId[1]]["TITLE"]?>) <br />

                                <?endif?>

                            <?endif?>

                            <strong><?=GetMessage('SPOL_BASKET')?>:</strong>
                            <ul class="bx_item_list">

                                <?foreach ($order["BASKET_ITEMS"] as $item):?>

                                    <li>
                                        <?if(strlen($item["DETAIL_PAGE_URL"])):?>
                                            <a href="<?=$item["DETAIL_PAGE_URL"]?>" target="_blank">
                                        <?endif?>
                                            <?=$item['NAME']?>
                                        <?if(strlen($item["DETAIL_PAGE_URL"])):?>
                                            </a>
                                        <?endif?>
                                        <nobr>&nbsp;&mdash; <?=$item['QUANTITY']?> <?=(isset($item["MEASURE_NAME"]) ? $item["MEASURE_NAME"] : GetMessage('SPOL_SHT'))?></nobr>
                                    </li>

                                <?endforeach?>

                            </ul>

                            <?=$order["ORDER"]["DATE_STATUS_FORMATED"];?>

                            <?if($order["ORDER"]["CANCELED"] != "Y"):?>
                                <a href="<?=$order["ORDER"]["URL_TO_CANCEL"]?>" style="min-width:140px"class="bx_big bx_bt_button_type_2 bx_cart bx_order_action"><?=GetMessage('SPOL_CANCEL_ORDER')?></a>
                            <?endif?>

                            <a href="<?=$order["ORDER"]["URL_TO_COPY"]?>" style="min-width:140px"class="bx_big bx_bt_button_type_2 bx_cart bx_order_action"><?=GetMessage('SPOL_REPEAT_ORDER')?></a>
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
                            <a href="<?=$order["ORDER"]["URL_TO_DETAIL"]?>"><?=GetMessage('SPOL_ORDER_DETAIL')?></a>

                            <strong><?=GetMessage('SPOL_PAY_SUM')?>:</strong> <?=$order["ORDER"]["FORMATED_PRICE"]?> <br />

                            <strong><?=GetMessage('SPOL_PAYED')?>:</strong> <?=GetMessage('SPOL_'.($order["ORDER"]["PAYED"] == "Y" ? 'YES' : 'NO'))?> <br />

                            <? // PAY SYSTEM ?>
                            <?if(intval($order["ORDER"]["PAY_SYSTEM_ID"])):?>
                                <strong><?=GetMessage('SPOL_PAYSYSTEM')?>:</strong> <?=$arResult["INFO"]["PAY_SYSTEM"][$order["ORDER"]["PAY_SYSTEM_ID"]]["NAME"]?> <br />
                            <?endif?>

                            <? // DELIVERY SYSTEM ?>
                            <?if($order['HAS_DELIVERY']):?>

                                <strong><?=GetMessage('SPOL_DELIVERY')?>:</strong>

                                <?if(intval($order["ORDER"]["DELIVERY_ID"])):?>

                                    <?=$arResult["INFO"]["DELIVERY"][$order["ORDER"]["DELIVERY_ID"]]["NAME"]?> <br />

                                <?elseif(strpos($order["ORDER"]["DELIVERY_ID"], ":") !== false):?>

                                    <?$arId = explode(":", $order["ORDER"]["DELIVERY_ID"])?>
                                    <?=$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["NAME"]?> (<?=$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["PROFILES"][$arId[1]]["TITLE"]?>) <br />

                                <?endif?>

                            <?endif?>

                            <strong><?=GetMessage('SPOL_BASKET')?>:</strong>
                            <ul class="bx_item_list">

                                <?foreach ($order["BASKET_ITEMS"] as $item):?>

                                    <li>
                                        <?if(strlen($item["DETAIL_PAGE_URL"])):?>
                                            <a href="<?=$item["DETAIL_PAGE_URL"]?>" target="_blank">
                                        <?endif?>
                                            <?=$item['NAME']?>
                                        <?if(strlen($item["DETAIL_PAGE_URL"])):?>
                                            </a>
                                        <?endif?>
                                        <nobr>&nbsp;&mdash; <?=$item['QUANTITY']?> <?=(isset($item["MEASURE_NAME"]) ? $item["MEASURE_NAME"] : GetMessage('SPOL_SHT'))?></nobr>
                                    </li>

                                <?endforeach?>

                            </ul>

                            <?=$order["ORDER"]["DATE_STATUS_FORMATED"];?>

                            <?if($order["ORDER"]["CANCELED"] != "Y"):?>
                                <a href="<?=$order["ORDER"]["URL_TO_CANCEL"]?>" style="min-width:140px"class="bx_big bx_bt_button_type_2 bx_cart bx_order_action"><?=GetMessage('SPOL_CANCEL_ORDER')?></a>
                            <?endif?>

                            <a href="<?=$order["ORDER"]["URL_TO_COPY"]?>" style="min-width:140px"class="bx_big bx_bt_button_type_2 bx_cart bx_order_action"><?=GetMessage('SPOL_REPEAT_ORDER')?></a>
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