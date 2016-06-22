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
        "PAGE_ELEMENT_COUNT" => array(12, 24, 60), //���������� ��������� �� ��������
        "ELEMENT_SORT_FIELD" => $catalogAvailableSort, //���� ��� ������ ����������
        "ELEMENT_SORT_ORDER" => $catalogAvailableSortDirections, //����������� ��� ������ ����������
        "ELEMENT_SORT_FIELD2" => $catalogAvailableSort, //���� ��� ������ ����������
        "ELEMENT_SORT_ORDER2" => $catalogAvailableSortDirections, //����������� ��� ������ ���������� 
        "CATALOG_SECTION_TEMPLATE" => array("blocks", "table"), //������� ������ ���������
    );       


    define("DEFAULT_TEMPLATE_PATH", SITE_DIR."local/templates/.default/"); //path of ".default" site template
    define("CATALOG_IBLOCK_ID", 5); //�������� ������� �������
    define("OFFERS_IBLOCK_ID", 6);  //�������� �������� �����������

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
        
        //arshow($_SERVER); die();

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



?>