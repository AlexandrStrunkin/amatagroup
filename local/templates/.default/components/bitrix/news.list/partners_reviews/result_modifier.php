<?
foreach ($arResult["ITEMS"] as $arItemID => $arItem) { 
    if ($arItem["PREVIEW_PICTURE"]) { 
        $avatar_picture = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>40, 'height'=>40), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
        $arResult["ITEMS"][$arItemID]["PREVIEW_PICTURE"]["HTML"] = '<img src="'.$avatar_picture['src'].'">';                                        
    }
} 
?>