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
			$arResult['CITY_LIST'][$ar_result['IBLOCK_SECTION_ID']]['COORD'] = $ar_result["PROPERTY_COORDINATES_VALUE"];
		}
	}
}
?>
<script>
default_location = <?= WHERE_TO_BUY_DEFAULT?>;
default_location_name = <?= WHERE_TO_BUY_DEFAULT_NAME?>;
</script>