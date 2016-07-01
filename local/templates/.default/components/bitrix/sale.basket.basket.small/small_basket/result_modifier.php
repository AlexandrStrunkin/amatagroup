<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$availableItems = 0; 
foreach ($arResult["ITEMS"] as $item) {
    if ($item["DELAY"] == "N" && $item["CAN_BUY"] == "Y") {
        $availableItems++;
    }
}

$arResult["ITEMS_COUNT"] = $availableItems;
?>