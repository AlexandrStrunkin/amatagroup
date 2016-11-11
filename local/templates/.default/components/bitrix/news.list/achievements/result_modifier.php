<?
foreach ($arResult["ITEMS"] as $key => $arItem) {
    $arFileTmp = CFile::ResizeImageGet(
        $arItem["DETAIL_PICTURE"]["ID"],
        array("width" => 600, "height" => 800),
        BX_RESIZE_IMAGE_EXACT,
        true,
        $arWaterMark
    );
    $arItem["PICTURE"] = $arFileTmp;
    $arResult["ITEMS"][$key] = $arItem;
}
?>