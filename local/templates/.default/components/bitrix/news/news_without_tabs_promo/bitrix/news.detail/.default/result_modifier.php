<?
$arSelect = Array("ID", "NAME", "PROPERTY_DO_NOT_SHOW_DATE");
$arFilter = Array("ID"=>$arResult['ID']);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
$ob = $res->Fetch();                          
$arResult['DO_NOT_SHOW_DATE'] = $ob['PROPERTY_DO_NOT_SHOW_DATE_VALUE'];
?> 