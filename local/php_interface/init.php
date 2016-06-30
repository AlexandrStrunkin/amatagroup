<?

    include(GetLangFileName(dirname(__FILE__)."/", "/init.php"));

    CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");

    use Bitrix\Main;
    use Bitrix\Main\Loader;
    use Bitrix\Main\Localization\Loc;
    use Bitrix\Sale\Internals;

    $arPageElementCount = array(12, 24, 60); //��������� �������� ���������� ��������� �� ��������

    //������ ��������� ���������� ������� � ��������
    $catalogAvailableSort = array("NAME", "DATE_CREATE", "PRICE");  

    //��������� ����������� ���������� �������
    $catalogAvailableSortDirections = array("ASC", "DESC");   

    global $availableParams;
    //������ ���������� ���������� ��� ����������� �������� ���� => ������ ���������� ��������
    $availableParams = array(
        "PAGE_ELEMENT_COUNT" => $arPageElementCount, //���������� ��������� �� ��������
        "ELEMENT_SORT_FIELD" => $catalogAvailableSort, //���� ��� ������ ����������
        "ELEMENT_SORT_ORDER" => $catalogAvailableSortDirections, //����������� ��� ������ ����������
        "ELEMENT_SORT_FIELD2" => $catalogAvailableSort, //���� ��� ������ ����������
        "ELEMENT_SORT_ORDER2" => $catalogAvailableSortDirections, //����������� ��� ������ ���������� 
        "CATALOG_SECTION_TEMPLATE" => array("blocks", "table"), //������� ������ ���������
    );       


    define("DEFAULT_TEMPLATE_PATH", SITE_DIR."local/templates/.default/"); //path of ".default" site template 
    define("CATALOG_IBLOCK_ID", 5); //main catalog
    define("OFFERS_IBLOCK_ID", 6);  //offers
    define("FAVORITE_IBLOCK_ID", 12);
	define("USER_SAVED_ADDRESSES_IBLOCK_ID", 13);
	
	define("USER_SAVED_ADDRESSES_STREET_PROPERTY", 433); // �����
	define("USER_SAVED_ADDRESSES_HOUSING_PROPERTY", 434); // ��������/������
	define("USER_SAVED_ADDRESSES_BUILDING_PROPERTY", 435); // ���
	define("USER_SAVED_ADDRESSES_APARTMENT_PROPERTY", 436); // ��������/����
	define("USER_SAVED_ADDRESSES_BX_LOCATION_ID_PROPERTY", 437); // ID �������������� �������
	
	define("ORDER_LOCATION_ID", 18); // ��������������
	define("ORDER_LOCATION", "ORDER_PROP_18"); // ��������������
	define("ORDER_STREET", "ORDER_PROP_20"); // �����
	define("ORDER_HOUSING", "ORDER_PROP_21"); // ��������/������
	define("ORDER_BUILDING", "ORDER_PROP_22"); // ���
	define("ORDER_APARTMENT", "ORDER_PROP_23"); // ��������/����
	
    /*��������� ��� ����������� ��������*/
    define("DEFAULT_PAGE_ELEMENT_COUNT", $GLOBALS["arPageElementCount"][0]); //���������� ��������� �� �������� ������� �������� �� ���������
    define("DEFAULT_ELEMENT_SORT_FIELD", $GLOBALS["catalogAvailableSort"][0]); //���� ��� ������ ���������� ��������� � �������� �� ���������
    define("DEFAULT_ELEMENT_SORT_ORDER", $GLOBALS["availableParams"]["ELEMENT_SORT_ORDER"][0]); //����������� ��� ������ ���������� ��������� � �������� �� ���������
    define("DEFAULT_ELEMENT_SORT_FIELD2", $GLOBALS["catalogAvailableSort"][1]); //���� ��� ������ ���������� ��������� � �������� �� ���������
    define("DEFAULT_ELEMENT_SORT_ORDER2", $GLOBALS["availableParams"]["ELEMENT_SORT_ORDER2"][0]); //����������� ��� ������ ���������� ��������� � �������� �� ���������
    define("DEFAULT_CATALOG_SECTION_TEMPLATE", "blocks"); //������ ��� ����������� ��������� ������� �� ���������      
    /*///*/

    define("NEW_PRODUCT_STATUS_LENGTH", 14); //���������� ����, ������ ����� ��������� ��������
    define("FRESH_PRODUCT_STATUS_LENGTH", 2); //���������� ����, ������ ����� ��������� ��������� ������������
    
    // ���� � ����� ��� ����������
	file_exists($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/favorite/class.php') ? require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/favorite/class.php') : "";

    function arshow($array, $adminCheck = false){
        global $USER;
        $USER = new Cuser;
        if ($adminCheck) {
            if (!$USER->IsAdmin()) {
                return false;
            } 
        }
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    //������� ������ �� EMAIL ��� ����������� � ��������� ������������
    AddEventHandler("main", "OnBeforeUserRegister", Array("OnBeforeUserRegisterHandler", "OnBeforeUserRegister"));
    AddEventHandler("main", "OnBeforeUserUpdate", Array("OnBeforeUserRegisterHandler", "OnBeforeUserRegister"));
    class OnBeforeUserRegisterHandler {
        function OnBeforeUserRegister(&$arFields) {                            
            $arFields['LOGIN'] = $arFields['EMAIL'];   
            return $arFields;    
        }
    }


    /***
    * ������� ���������� ������ ���������� ��� ����������� ��������:
    * ���������� ��������� �� �������� PAGE_ELEMENT_COUNT
    * ���� ��� ������ ���������� ELEMENT_SORT_FIELD
    * ����������� ������ ���������� ELEMENT_SORT_ORDER
    * ���� ��� ������ ���������� ELEMENT_SORT_FIELD2
    * ����������� ��� ������� ���������� ELEMENT_SORT_ORDER2
    * ������ ������ ��������� CATALOG_SECTION_TEMPLATE (������/������� [blocks/table])
    */
    function getCatalogViewParams() {

        $page_element_count = (intval($_SESSION["CATALOG_PARAMS"]["PAGE_ELEMENT_COUNT"]) > 0 ? intval($_SESSION["CATALOG_PARAMS"]["PAGE_ELEMENT_COUNT"]) : DEFAULT_PAGE_ELEMENT_COUNT);
        $element_sort_field = (!empty($_SESSION["CATALOG_PARAMS"]["ELEMENT_SORT_FIELD"]) ? $_SESSION["CATALOG_PARAMS"]["ELEMENT_SORT_FIELD"] : DEFAULT_ELEMENT_SORT_FIELD);
        $element_sort_order = (!empty($_SESSION["CATALOG_PARAMS"]["ELEMENT_SORT_ORDER"]) ? $_SESSION["CATALOG_PARAMS"]["ELEMENT_SORT_ORDER"] : DEFAULT_ELEMENT_SORT_ORDER);
        $element_sort_field2 = (!empty($_SESSION["CATALOG_PARAMS"]["ELEMENT_SORT_FIELD2"]) ? $_SESSION["CATALOG_PARAMS"]["ELEMENT_SORT_FIELD2"] : DEFAULT_ELEMENT_SORT_FIELD2);
        $element_sort_order2 = (!empty($_SESSION["CATALOG_PARAMS"]["ELEMENT_SORT_ORDER2"]) ? $_SESSION["CATALOG_PARAMS"]["ELEMENT_SORT_ORDER2"] : DEFAULT_ELEMENT_SORT_ORDER2);
        $catalog_section_template = (!empty($_SESSION["CATALOG_PARAMS"]["CATALOG_SECTION_TEMPLATE"]) ? $_SESSION["CATALOG_PARAMS"]["CATALOG_SECTION_TEMPLATE"] : DEFAULT_CATALOG_SECTION_TEMPLATE);

        return array(
            "PAGE_ELEMENT_COUNT" => $page_element_count,
            "ELEMENT_SORT_FIELD" => $element_sort_field,
            "ELEMENT_SORT_ORDER" => $element_sort_order,
            "ELEMENT_SORT_FIELD2" => $element_sort_field2,
            "ELEMENT_SORT_ORDER2" => $element_sort_order2,
            "CATALOG_SECTION_TEMPLATE" => $catalog_section_template
        );
    }


    /***
    * ������� ������������� ��������� ��� ����������� ��������
    * 
    * $arParams - ������ ����������, ������� ����� ���������� ���� "�������� ���������" => "��������"
    * $pageRefresh - ������������� ������������ �������� ����� ��������� ����������
    */
    function setCatalogViewParams($arParams = array(), $pageRefresh = false) {

        $availableParams = $GLOBALS["availableParams"];

        //���� �� ��������� ������������ � ������� ���������� ����������
        if (is_array($arParams) && count($arParams) > 0) {
            foreach ($arParams as $paramName => $paramValue) {
                if (is_array($availableParams[$paramName]) && in_array($paramValue, $availableParams[$paramName])) {
                    $_SESSION["CATALOG_PARAMS"][$paramName] = $paramValue;
                }
            }
        }                   

        //��� ������������� ������ ������������ �������� � ������� ��������� �� ����
        if ($pageRefresh) {
            global $APPLICATION;
            header ("location: ".$_SERVER["HTTP_REFERER"]);
        }

    }        


    /***
    * ������� ������ ����� �������� ���������� �������� �� ���������/ ����� ��� ������ � ����������� ��������
    * 
    * @param mixed $blockName
    */
    function getParamKey($blockName) {
        $curParams = getCatalogViewParams(); 
        $availableParam = $GLOBALS["availableParams"][$blockName]; 
        $currentKey = array_search($curParams[$blockName], $availableParam); 

        if (empty($currentKey)) {
            $currentKey = 0;
        }

        return $currentKey;
    }


    /***
    * ������� ���������� html ��� ������� ����� ��� ���������� ��������� (����� ���������� ��������� �� ��������, ������ ����������, ����������� ����������)
    * 
    * @param string $blockName (PAGE_ELEMENT_COUNT, ELEMENT_SORT_FIELD, ELEMENT_SORT_ORDER)
    */
    function getCatalogOptionBlock($blockName) {

        if (empty($blockName)) {
            return false;
        }

        $curParams = getCatalogViewParams();
        $availableParam = $GLOBALS["availableParams"][$blockName];

        $currentKey = getParamKey($blockName);  //������ �������� ��������� �������� �� ���� ���������

        switch ($blockName) {

            case "PAGE_ELEMENT_COUNT" :                  
            ?>
            <p data-sort="<?=$currentKey?>" id="activeQuantOnPageBot"><?=$curParams[$blockName]?></p>     
            <div class="hidingMenu js-page-element-count">
                <?foreach ($availableParam as $key => $count){?>
                    <p data-sort="<?=$key?>" data-href="?<?=$blockName?>=<?=$count?>"><?=$count?></p>
                    <?}?>   
            </div> 
            <?   
                break; 

            case "ELEMENT_SORT_FIELD" : 
            ?>
            <p data-sort="<?=$currentKey?>" class="firstFiltElement1" id="activeFirstFilt"><?=GetMessage("CATALOG_ORDER_BY_".$curParams[$blockName])?></p>
            <div class="hidingMenu">
                <?foreach ($availableParam as $key => $fieldName){?>
                    <p data-sort="<?=$key?>" data-href="?<?=$blockName?>=<?=$fieldName?>"><?=GetMessage("CATALOG_ORDER_BY_".$fieldName)?></p>
                    <?}?> 
            </div>    
            <?
                break;  

            case "ELEMENT_SORT_ORDER" :
            ?>
            <p data-sort="<?=$currentKey?>" id="activeSecondFilt"><?=GetMessage("CATALOG_ORDER_DIRECTION_".$curParams[$blockName])?></p>
            <div class="hidingMenu">
                <?foreach ($availableParam as $key => $fieldName){?>
                    <p data-sort="<?=$key?>" data-href="?<?=$blockName?>=<?=$fieldName?>"><?=GetMessage("CATALOG_ORDER_DIRECTION_".$fieldName)?></p>
                    <?}?> 
            </div>
            <?      
                break;

            default: 
                return false;

                break;
        }     

    }



    /***
    * ������� ���������, �� ������ �� ����� GET ��������� ��� ����������� ��������. ���� ������ - ��������� � ������
    */
    AddEventHandler("main", "OnProlog", "checkRequestData");
    function checkRequestData() {            
        $availableParams = $GLOBALS["availableParams"]; //��������� ��� ����������� ��������
        //���� � ������� $_GET ���� ��������� ��� ����������� ��������, �� ������������ ��
        $result = array();
        //��������� ������������ ����������
        foreach ($availableParams as $paramKey => $paramValue) { 
            if ($_GET[$paramKey] && in_array($_GET[$paramKey], $paramValue)) {
                $result[$paramKey] = $_GET[$paramKey];
            }   
        }
        //����� ��������� ������������ ������� ������������� ��������
        if (count($result) > 0) {
            setCatalogViewParams($result, true);
        }

    }


    /**
    * ������� ���������� ������ �������, ����������� � ������� ������������ � ������ ������.
    * ������������ ������ ����: ID ������ (�� ��������� �������� ������� ��� PRODUCT_ID) => array(
    * QUANTITY => ���������� ������� ������ � �������, ID => ID ������ � ������� - �� ������ � PRODUCT_ID, NAME => �������� ������
    * )
    */
    function getCurrentBasket() {

        $arResult = array();
        $dbBasketItems = CSaleBasket::GetList(
            array(), 
            array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL", "DELAY" => "N", "CAN_BUY" => "Y"), 
            false, 
            false, 
            array("ID", "NAME", "PRODUCT_ID", "QUANTITY" )
        );
        while ($arItems = $dbBasketItems->Fetch()) {
            $arResult[$arItems["PRODUCT_ID"]] = array("NAME" => $arItems["NAME"], "ID" => $arItems["ID"], "QUANTITY" => $arItems["QUANTITY"], "PRODUCT_ID" => $arItems["PRODUCT_ID"]);
        }

        return $arResult;
    }
	
	AddEventHandler("sale", "OnBeforeOrderAdd", "addUserLocationToSaved");
	
	/**
	 * 
	 * ���������� ����������� ������ ��� ������������
	 * 
	 * @param int $user_id
	 * @return array $addresses
	 * 
	 * */
	function getUsersSavedLocations($user_id) {
		
		$addresses = array();
		
		$select = Array(
			"ID",
			"IBLOCK_ID",
			"NAME",
			"PROPERTY_BX_LOCATION_ID",
			"PROPERTY_CITY",
			"PROPERTY_STREET",
			"PROPERTY_HOUSING",
			"PROPERTY_BUILDING",
			"PROPERTY_APARTMENT",
		);
		$filter = Array(
			"IBLOCK_ID"  => USER_SAVED_ADDRESSES_IBLOCK_ID,
			"CREATED_BY" => $user_id,
			"ACTIVE"     => "Y"
		);
		
		$saved_addresses = CIBlockElement::GetList(Array(), $filter, false, false, $select);
		while ($address = $saved_addresses->Fetch()) { 
			array_push($addresses, $address);
		}
		
		return $addresses;
	}
	
	/**
	 * �������� ������������� � ���������
	 * 
	 * @param array $arFields
	 * @return int|string
	 * 
	 * */
	
	function addUserLocationToSaved(&$arFields) {
		global $USER;
		
		$location_string = "";
		$location = CSaleLocation::GetByID((int)$_REQUEST[ORDER_LOCATION]);
		if (is_array($location)) {
			$location_string .= ($location["CITY_NAME_ORIG"] ? $location["CITY_NAME_ORIG"] : $location["REGION_NAME_ORIG"]) . ", "; // ����� ��� �������
			$location_string .= $_REQUEST[ORDER_STREET] ? "��. " . $_REQUEST[ORDER_STREET] . ", " : ""; // �����
			$location_string .= $_REQUEST[ORDER_HOUSING] ? "������ " . $_REQUEST[ORDER_HOUSING] . ", " : ""; // ������
			$location_string .= $_REQUEST[ORDER_BUILDING] ? "�. " . $_REQUEST[ORDER_BUILDING] . ", " : ""; // ���
			$location_string .= $_REQUEST[ORDER_APARTMENT] ? "��. " . $_REQUEST[ORDER_APARTMENT] . ", " : ""; // ��������
		}
		$new_saved_location = new CIBlockElement;

		$properties = array();
		$properties[USER_SAVED_ADDRESSES_BX_LOCATION_ID_PROPERTY] = $_REQUEST[ORDER_LOCATION];
		$properties[USER_SAVED_ADDRESSES_STREET_PROPERTY] = $_REQUEST[ORDER_STREET];
		$properties[USER_SAVED_ADDRESSES_HOUSING_PROPERTY] = $_REQUEST[ORDER_HOUSING];
		$properties[USER_SAVED_ADDRESSES_BUILDING_PROPERTY] = $_REQUEST[ORDER_BUILDING];
		$properties[USER_SAVED_ADDRESSES_APARTMENT_PROPERTY] = $_REQUEST[ORDER_APARTMENT];
		
		$saved_location_data = Array(
			"MODIFIED_BY"       => $USER->GetID(),
			"IBLOCK_SECTION_ID" => false,
			"IBLOCK_ID"         => USER_SAVED_ADDRESSES_IBLOCK_ID,
			"PROPERTY_VALUES"   => $properties,
			"NAME"              => $location_string,
			"ACTIVE"            => "Y"
		);
		
		$location_id = $new_saved_location->Add($saved_location_data);

		return $location_id ? $location_id : $new_saved_location -> LAST_ERROR;
	}
	
?>