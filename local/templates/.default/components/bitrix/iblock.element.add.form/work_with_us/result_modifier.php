<?                                  
//Меняем порядок детального описания, так как сортировка на него не работает  
for ($i = DETAIL_PAGE_LIST_NUMBER; $i <= FILE_LIST_NUMBER - 2; $i++) {
    $tempValue = $arResult["PROPERTY_LIST"][$i];
    $arResult["PROPERTY_LIST"][$i] = $arResult["PROPERTY_LIST"][$i + 1];
    $arResult["PROPERTY_LIST"][$i + 1] = $tempValue; 
}                                                       
?>