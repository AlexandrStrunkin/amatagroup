<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	global $USER;
	
	$arResult['USER_AUTHORIZED'] = $USER->IsAuthorized() ? true : false;

    $articles = array();
    $rsElement = CIBlockElement::GetList(array(), array("ID" => $items), false, false, array("PROPERTY_CML2_ARTICLE", "ID", "PROPERTY_CML2_LINK"));
    while($arElement = $rsElement->Fetch()) {
        $arResult["ITEMS_PROPS"][$arElement["ID"]]["CML2_ARTICLE"] = $arElement["PROPERTY_CML2_ARTICLE_VALUE"];  
        $arResult["ITEMS_PROPS"][$arElement["ID"]]["CML2_LINK"] = $arElement["PROPERTY_CML2_LINK_VALUE"];  
    }
    
	//собираем артикулы товаров и основной товар для товаров с ТП
    $items = array();
    foreach ($arResult["GRID"]["ROWS"] as $k => &$arItem) {
        $items[] = $arItem["PRODUCT_ID"];
		if ($arResult['USER_AUTHORIZED']) {
			$product_id = $arResult["ITEMS_PROPS"][$arItem["PRODUCT_ID"]]["CML2_LINK"] ? $arResult["ITEMS_PROPS"][$arItem["PRODUCT_ID"]]["CML2_LINK"] : $arItem["PRODUCT_ID"];
			$arItem['USER_HAVE_ITEM_IN_FAVORITE'] = Favorite::checkIsExists($USER->GetID(), $product_id);
		}
    }
?>