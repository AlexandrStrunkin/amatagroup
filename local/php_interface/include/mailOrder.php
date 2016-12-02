<?
class OrderMail {
	
	private static $new_order_status = "ѕрин€т, ожидаетс€ оплата";
	public static $items_in_order_template = <<<TEMPLATE
	<tr>
      <td style="text-align: center;border-right: 1px solid #e0e0e0;border-bottom: 1px solid #e0e0e0;">
        <a href="#ITEM_HREF#"><img width="55" src="#ITEM_THUMB#" alt=""></a>
      </td>
    
        <td style="padding-left: 20px;padding-top: 10px;border-right: 1px solid #e0e0e0;border-bottom: 1px solid #e0e0e0;">
            <a style="color: #5DB3DC;font-size: 16px;" href="#ITEM_HREF#" target="_blank">#ITEM_TITLE# </a>
            <p style="color: #8A8888;font-size: 12px;" class="identificationNumber">#ITEM_ARTICLE#</p>
        </td>
        <td style="text-align: center;border-right: 1px solid #e0e0e0;border-bottom: 1px solid #e0e0e0;">
            <p>#ITEM_OFFER#</p>
        </td>
        <td style="text-align: center;border-right: 1px solid #e0e0e0;border-bottom: 1px solid #e0e0e0;">
            <p>#ITEM_PER_ONE_PRICE# –</p>
        </td>
        <td style="text-align: center;border-right: 1px solid #e0e0e0;border-bottom: 1px solid #e0e0e0;">
            <p>#ITEM_QUANTITY#</p>
        </td>
        <td style="text-align: center;border-bottom: 1px solid #e0e0e0;">
            <p>#ITEM_TOTAL_PRICE# –</p>
        </td>
    </tr>
TEMPLATE;

	public static $items_in_order_template_macroses = array(
		"#ITEM_HREF#",
		"#ITEM_THUMB#",
		"#ITEM_TITLE#",
		"#ITEM_ARTICLE#",
		"#ITEM_PER_ONE_PRICE#",
		"#ITEM_QUANTITY#",
		"#ITEM_TOTAL_PRICE#",
		"#ITEM_OFFER#"
	);
  
    /*****
     *
     * @param string $id
     * @return array $arOrder
     *
     ******/

    private static function getOrder($id) {
        $order = CSaleOrder::GetList(Array(), array("ID" => $id));
        $arOrder = $order->Fetch();
        return $arOrder;
    }
	
	/*****
     *
     * @param string $id
     * @return string $location
     *
     ******/
	
	private static function getAddress($id) {
		$location = "";
		$order_props = CSaleOrderPropsValue::GetList(
			array("SORT" => "ASC"),
			array(
				"ORDER_ID" => $id,
				"CODE"     => array("LOCATION", "STREET")
			)
		);
		
		while ($property = $order_props->Fetch()) {
			if ($property['CODE'] == "LOCATION") {
				$location_array = CSaleLocation::GetByID($property['VALUE'], 'ru');
				$location .= $location_array['COUNTRY_NAME'] ? $location_array['COUNTRY_NAME'] . ", " : "";
				$location .= $location_array['REGION_NAME_ORIG'] ? $location_array['REGION_NAME_ORIG'] . ", " : "";
				$location .= $location_array['CITY_NAME_ORIG'] ? $location_array['CITY_NAME_ORIG'] . ", " : "";
			} else if ($property['CODE'] == "STREET") {
				$location .= $property['VALUE'] ? $property['VALUE'] : "";
			}
		}
		return $location;
	}
    
    /*****
     *
     * @return array
     *
     ******/

    private static function getOrderStatuses() {
        $statuses = CSaleStatus::GetList(array(), array("LID" => 'ru'), false, false, array());
        $a = array();
        while ($arStatus = $statuses -> Fetch()) {
            $a[$arStatus['ID']] = $arStatus['DESCRIPTION'];
        }

        return $a;
    }
    
    /*****
     *
     * @param string $i
     * @return string $ar_dtype['NAME']
     *
     ******/
    
    private static function getDeliverySystems($i){
        $db_dtype = CSaleDelivery::GetList(array(), array(), false, false, array());
        while ($ar_dtype = $db_dtype->Fetch()) {
            if ($ar_dtype['ID'] == $i) {
                return $ar_dtype['NAME'];
            }
        }
        
        return '—лужба доставки не установлена.';
    }
    
    /*****
     *
     * @param string $i
     * @return string $ptype['NAME']
     *
     ******/
    
    private static function getPaymentSystems($i){
        $db_ptype = CSalePaySystem::GetList($arOrder = Array(), Array());
        while ($ptype = $db_ptype->Fetch()) {
            if ($ptype['ID'] == $i) {
                return $ptype['NAME'];
            }
        }      
        return '—истема оплаты не установлена.';
    }
    
    /*****
     *
     * @param string $id
     * @return array $items
     *
     ******/
    
    private static function getItemsInOrder($id) {
        $items = array();
		$items_ids = array();
        $dbItemsInOrder = CSaleBasket::GetList(array(), array("ORDER_ID" => $id), false, false, array());
        while ($arItems = $dbItemsInOrder->Fetch()) {
        	$items_ids[] = $arItems['PRODUCT_ID'];
            $items[$arItems['PRODUCT_ID']] = array(
                'item_name'  => $arItems['NAME'],
                'price'      => round($arItems['PRICE'], 2),
                'quantity'   => $arItems['QUANTITY'],
                'detail_url' => $arItems['DETAIL_PAGE_URL']
            );
        }
        // выбираем данные товары из базы, чтобы достать артикул и картинку
		$items_result = CIBlockElement::GetList(Array(), array("ID" => $items_ids), false, false, array("ID", "IBLOCK_ID", "NAME", "PROPERTY_CML2_ARTICLE", "DETAIL_PICTURE", "PROPERTY_CML2_LINK", "PROPERTY_TSVET"));
		while ($item = $items_result->Fetch()) {
			// если это самосто€тельный товар	
			if (!$item['PROPERTY_CML2_LINK_VALUE']) {
				$items[$item['ID']]['article'] = $item['PROPERTY_CML2_ARTICLE_VALUE'];
			} else { // предложение, получаем данные артикула из родител€
				$parent_item_result = CIBlockElement::GetList(Array(), array("ID" => $item['PROPERTY_CML2_LINK_VALUE']), false, false, array("ID", "IBLOCK_ID", "NAME", "PROPERTY_CML2_ARTICLE"));
				while ($parent_item = $parent_item_result->Fetch()) {
					$items[$item['ID']]['article'] = $parent_item['PROPERTY_CML2_ARTICLE_VALUE'];
				}
			}
			$items[$item['ID']]['picture'] = getResizedImage($item['DETAIL_PICTURE'], MAIL_THUMBNAIL_WIDTH, MAIL_THUMBNAIL_HEIGHT, BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
			$items[$item['ID']]['offer'] = $item['PROPERTY_TSVET_VALUE'];
		}
        return $items;
    }

    /*****
     *
     * @param string $id
     * @return array $order_data
     *
     ******/

    public static function GetOrderInfo($id) {
        $order = self::getOrder($id);
        $order_data = array(
            'order_id'       => $order['ID'],
            'price'          => round($order['PRICE'], 2),
            'price_delivery' => round($order['PRICE_DELIVERY'], 2),
            'create_date'    => $order['DATE_INSERT'],
            'status'         => self::$new_order_status,
            'address'        => self::getAddress($order['ID']),
            'user_comment'   => $order['USER_DESCRIPTION'],
            'delivery_type'  => self::getDeliverySystems($order['DELIVERY_ID']),
            'payment_system' => self::getPaymentSystems($order['PAY_SYSTEM_ID']),
            'items_in_order' => self::getItemsInOrder($id)
        );
		return $order_data;
    }
}
?>