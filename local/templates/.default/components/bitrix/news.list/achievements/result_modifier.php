<?
foreach ($arResult["ITEMS"] as $key => $arItem) {
    $ar_File = CFile::ResizeImageGet(
        $arItem["DETAIL_PICTURE"]["ID"],
        array("width" => IMAGE_SERTIFICATE_WIDTH, "height" => IMAGE_SERTIFICATE_HEIGHT),
        BX_RESIZE_IMAGE_EXACT,
        true
    );
    $arItem["PICTURE"] = $ar_File;
    $arResult["ITEMS"][$key] = $arItem;
}
?>