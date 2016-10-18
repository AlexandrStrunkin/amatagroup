<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

 foreach ($arResult['ITEMS'] as $key => $arItem) {
    // Выберем все скидки для данного товара
    $dbProductDiscounts = CCatalogDiscount::GetList(
        array("SORT" => "ASC"),
        array(
                "PRODUCT_ID" => $arItem["PROPERTIES"]["SALE_PRODUCT"]["VALUE"],
                "ACTIVE" => "Y",
            ),
        false,
        false,
        array('VALUE','VALUE_TYPE','PRODUCT_ID')
        )->Fetch();
        if($dbProductDiscounts["VALUE_TYPE"] == 'P'){
            $sale_price = '-'.round($dbProductDiscounts["VALUE"]).'%';
        }
      $arItem["SALE_PRICE"] = $sale_price;
      $arItems[$key] = $arItem;
 }
 $arResult['ITEMS'] = $arItems;
