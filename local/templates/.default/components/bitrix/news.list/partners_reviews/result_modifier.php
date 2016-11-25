<?
//Изменяем размер картинки анонса под размер автарки
foreach ($arResult["ITEMS"] as $arItemID => $arItem) { 
    if ($arItem["PREVIEW_PICTURE"]) { 
        $avatar_picture = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>IMAGE_AVATAR_SIZE, 'height'=>IMAGE_AVATAR_SIZE), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
        $arResult["ITEMS"][$arItemID]["PREVIEW_PICTURE"]["HTML"] = '<img src="' . $avatar_picture['src'] . '">';                                        
    }
} 
?>