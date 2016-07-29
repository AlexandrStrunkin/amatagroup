<?
$arResult['CITY_LIST'] = Array();
$db_list = CIBlockSection::GetMixedList(array(), array("IBLOCK_ID" => RETAIL_IBLOCK_ID), false, array("IBLOCK_SECTION_ID", "PROPERTY_COORDINATES"));
while ($ar_result = $db_list->GetNext()) {
	if ($ar_result['TYPE'] == 'S') {
		$arResult['CITY_LIST'][$ar_result['ID']] = array(
			"TITLE" => $ar_result['NAME'],
			"COORD" => ""
		);
	} else {
		if (!$arResult['CITY_LIST'][$ar_result['IBLOCK_SECTION_ID']]['COORD']) {
			//$exploded_coordinates = explode(",", $ar_result["PROPERTY_COORDINATES_VALUE"]);
			//$arResult['CITY_LIST'][$ar_result['IBLOCK_SECTION_ID']]['COORD'] = "{lat: " . $exploded_coordinates[0] . ", lng: " . $exploded_coordinates[1] . "}";
			$arResult['CITY_LIST'][$ar_result['IBLOCK_SECTION_ID']]['COORD'] = $ar_result["PROPERTY_COORDINATES_VALUE"];
		}
	}
}
?>