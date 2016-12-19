<?
// собираем существующие новостные разделы
$existing_news_sections = array();
$sections = CIBlockSection::GetList (
    array(),
    array (
        'IBLOCK_ID' => NEWS_IBLOCK_ID
    ),
    false,
    array (

    )
); 
while ($section = $sections->Fetch()) {
    if($section["ACTIVE"] == 'Y'){
        $existing_news_sections[$section['ID']] = array(
            "TITLE" => $section['NAME'],
            "ELEMENTS" => array(),
            "CODE" => $section['CODE']
        );
    }
}  
// группируем элементы по этим разделам
foreach($arResult["ITEMS"] as $news_item) {
    array_push(
        $existing_news_sections[$news_item['IBLOCK_SECTION_ID']]['ELEMENTS'],
        $news_item
    );
}    
$arResult['REGROUPED_ITEMS'] = $existing_news_sections;
?>