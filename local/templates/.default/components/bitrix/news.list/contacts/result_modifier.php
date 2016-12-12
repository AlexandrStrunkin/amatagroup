<?
//Собираем информацию о менеджерах по ID
foreach($arResult['ITEMS'] as $ItemID => $arItem) { 
    $arManagerType = array ('OPERATING_MANAGERS', 'CUSTOMER_SERVICE');
    foreach($arManagerType as $ManagerType) {
        $arManagerID = array();
        $arManager = array();
        foreach($arItem['PROPERTIES'][$ManagerType]['VALUE'] as $managerID) {
            $arManagerID[] = $managerID; 
        }
        if(!empty($arManagerID)) {
            $arSelect = Array("ID", "NAME", "PROPERTY_PHONE", "PROPERTY_ADDITIONAL_PHONE", "PROPERTY_MAIL", "PREVIEW_PICTURE");
            $arFilter = Array("ID"=> $arManagerID, "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
            while($ar_fields = $res->Fetch())
            {
                if(!empty($ar_fields['PREVIEW_PICTURE'])) {
                $ar_fields['PREVIEW_PICTURE'] = CFile::ResizeImageGet($ar_fields['PREVIEW_PICTURE'], array('width' => CONTACTS_AVATAR_WIDTH, 'height' => CONTACTS_AVATAR_HEIGHT), BX_RESIZE_IMAGE_PROPORTIONAL, true);    
                }
                $arManager[] = $ar_fields;
            }      
        }
        foreach($arManager as $manager) {
            foreach($arItem['PROPERTIES'][$ManagerType]['VALUE'] as $ID => $managerID) {
                if($manager['ID'] == $managerID) {
                    $arResult['ITEMS'][$ItemID]['PROPERTIES'][$ManagerType]['VALUE'][$ID] = $manager;   
                }
            }    
        }    
    }
}
?>