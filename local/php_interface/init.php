<?

    CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");

    use Bitrix\Main;
    use Bitrix\Main\Loader;
    use Bitrix\Main\Localization\Loc;
    use Bitrix\Sale\Internals;

    global $arPageElementCount;
    $arPageElementCount = array(12, 24, 60); //��������� �������� ���������� ��������� �� ��������

    global $availableParams;
    //������ ���������� ���������� ��� ����������� �������� ���� => ������ ���������� ��������
    $availableParams = array(
        "PAGE_ELEMENT_COUNT" => $GLOBALS["arPageElementCount"], //���������� ��������� �� ��������
        "ELEMENT_SORT_FIELD" => array("NAME", "DATE_CREATE"), //���� ��� ������ ����������
        "ELEMENT_SORT_ORDER" => array("ASC", "DESC"), //����������� ��� ������ ����������
        "ELEMENT_SORT_FIELD2" => array("NAME", "DATE_CREATE"), //���� ��� ������ ����������
        "ELEMENT_SORT_ORDER2" => array("ASC", "DESC"), //����������� ��� ������ ���������� 
        "CATALOG_SECTION_TEMPLATE" => array("blocks", "table"), //������� ������ ���������
    );



    define("DEFAULT_TEMPLATE_PATH", SITE_DIR."local/templates/.default/"); //path of ".default" site template
    define("CATALOG_IBLOCK_ID", 5); //main catalog
    define("OFFERS_IBLOCK_ID", 6);  //offers

    /*��������� ��� ����������� ��������*/
    define("DEFAULT_PAGE_ELEMENT_COUNT", $GLOBALS["arPageElementCount"][0]); //���������� ��������� �� �������� ������� �������� �� ���������
    define("DEFAULT_ELEMENT_SORT_FIELD", "NAME"); //���� ��� ������ ���������� ��������� � �������� �� ���������
    define("DEFAULT_ELEMENT_SORT_ORDER", "AS�"); //����������� ��� ������ ���������� ��������� � �������� �� ���������
    define("DEFAULT_ELEMENT_SORT_FIELD2", "DATE_CREATE"); //���� ��� ������ ���������� ��������� � �������� �� ���������
    define("DEFAULT_ELEMENT_SORT_ORDER2", "AS�"); //����������� ��� ������ ���������� ��������� � �������� �� ���������
    define("DEFAULT_CATALOG_SECTION_TEMPLATE", "blocks"); //������ ��� ����������� ��������� ������� �� ���������      
    /*///*/
    
    define("NEW_PRODUCT_STATUS_LENGTH", 14); //���������� ����, ������ ����� ��������� ��������
    define("FRESH_PRODUCT_STATUS_LENGTH", 2); //���������� ����, ������ ����� ��������� ��������� ������������

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
            header ("location: ".$APPLICATION->GetCurDir());
        }

    }


    /**
    * ������� ������ ������ ��� ������ ���������� ��������� �� ��������
    * 
    */
    function getElemenOnPageCountList(){
        $curParams = getCatalogViewParams();
        $availableCount = $GLOBALS["arPageElementCount"];
        $currentKey = array_search($curParams["PAGE_ELEMENT_COUNT"], $availableCount);
        if (empty($currentKey)) {
            $currentKey = 1;
        }
    ?>
    <p data-sort="<?=$currentKey?>" class="quantOnPageBot<?=$currentKey?>" id="activeQuantOnPageBot"><?=$curParams["PAGE_ELEMENT_COUNT"]?></p>     
    <div class="hidingMenu js-page-element-count">
        <?foreach ($availableCount as $key => $count){?>
            <p data-sort="<?=$key?>" data-href="?PAGE_ELEMENT_COUNT=<?=$count?>"><?=$count?></p>
            <?}?>   
    </div> 
    <?   
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
?>