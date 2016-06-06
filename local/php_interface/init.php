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
    $arPageElementCount = array(12, 24, 60); //возможные варианты количестка элементов на странице

    global $availableParams;
    //массив допустимых параметров для отображения каталога КЛЮЧ => МАССИВ ДОПУСТИМЫХ ЗНАЧЕНИЙ
    $availableParams = array(
        "PAGE_ELEMENT_COUNT" => $GLOBALS["arPageElementCount"], //количество элементов на странице
        "ELEMENT_SORT_FIELD" => array("NAME", "DATE_CREATE"), //поле для первой сортировки
        "ELEMENT_SORT_ORDER" => array("ASC", "DESC"), //направление для первой сортировки
        "ELEMENT_SORT_FIELD2" => array("NAME", "DATE_CREATE"), //поле для второй сортировки
        "ELEMENT_SORT_ORDER2" => array("ASC", "DESC"), //направление для второй сортировки 
        "CATALOG_SECTION_TEMPLATE" => array("blocks", "table"), //шаблоны списка элементов
    );



    define("DEFAULT_TEMPLATE_PATH", SITE_DIR."local/templates/.default/"); //path of ".default" site template
    define("CATALOG_IBLOCK_ID", 5); //main catalog
    define("OFFERS_IBLOCK_ID", 6);  //offers

    /*константы для отображения каталога*/
    define("DEFAULT_PAGE_ELEMENT_COUNT", $GLOBALS["arPageElementCount"][0]); //количество элементов на странице раздела каталога по умолчанию
    define("DEFAULT_ELEMENT_SORT_FIELD", "NAME"); //поле для первой сортировки элементов в каталоге по умолчанию
    define("DEFAULT_ELEMENT_SORT_ORDER", "ASС"); //направление для первой сортировки элементов в каталоге по умолчанию
    define("DEFAULT_ELEMENT_SORT_FIELD2", "DATE_CREATE"); //поле для второй сортировки элементов в каталоге по умолчанию
    define("DEFAULT_ELEMENT_SORT_ORDER2", "ASС"); //направление для второй сортировки элементов в каталоге по умолчанию
    define("DEFAULT_CATALOG_SECTION_TEMPLATE", "blocks"); //шаблон для отображения элементов раздела по умолчанию      
    /*///*/
    
    define("NEW_PRODUCT_STATUS_LENGTH", 14); //количество дней, котрое товар считается новинкой
    define("FRESH_PRODUCT_STATUS_LENGTH", 2); //количество дней, котрое товар считается последним поступлением

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

    //подмена логина на EMAIL при регистрации и изменении пользователя
    AddEventHandler("main", "OnBeforeUserRegister", Array("OnBeforeUserRegisterHandler", "OnBeforeUserRegister"));
    AddEventHandler("main", "OnBeforeUserUpdate", Array("OnBeforeUserRegisterHandler", "OnBeforeUserRegister"));
    class OnBeforeUserRegisterHandler {
        function OnBeforeUserRegister(&$arFields) {                            
            $arFields['LOGIN'] = $arFields['EMAIL'];   
            return $arFields;    
        }
    }


    /***
    * функция возвращает массив параметров для отображения каталога:
    * количество элементов на странице PAGE_ELEMENT_COUNT
    * поле для первой сортировки ELEMENT_SORT_FIELD
    * направление первой сортировки ELEMENT_SORT_ORDER
    * поле для второй сортировки ELEMENT_SORT_FIELD2
    * направление для всторой сортировки ELEMENT_SORT_ORDER2
    * шаблон списка элементов CATALOG_SECTION_TEMPLATE (притка/тиблица [blocks/table])
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
    * функция устанавливает параметры для отображения каталога
    * 
    * $arParams - массив переменных, которые нужно установить вида "НАЗВАНИЕ ПАРАМЕТРА" => "ЗНАЧЕНИЕ"
    * $pageRefresh - необходимость перезагрузки страницы после установки параметров
    */
    function setCatalogViewParams($arParams = array(), $pageRefresh = false) {

        $availableParams = $GLOBALS["availableParams"];

        //если мя параметра присутствует в массиве допустимых параметров
        if (is_array($arParams) && count($arParams) > 0) {
            foreach ($arParams as $paramName => $paramValue) {
                if (is_array($availableParams[$paramName]) && in_array($paramValue, $availableParams[$paramName])) {
                    $_SESSION["CATALOG_PARAMS"][$paramName] = $paramValue;
                }
            }
        }

        //при необходимости делаем перезагрузку страницы и удаляем параметры из урла
        if ($pageRefresh) {
            global $APPLICATION;
            header ("location: ".$APPLICATION->GetCurDir());
        }

    }


    /**
    * функция строит список для выбора количества элементов на странице
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
    * хендлер проверяет, не пришли ли через GET параметры для отображения каталога. если пришли - проверяем и меняем
    */
    AddEventHandler("main", "OnProlog", "checkRequestData");
    function checkRequestData() {            
        $availableParams = $GLOBALS["availableParams"]; //параметры для отобрадения каталога
        //если в массиве $_GET есть параметры для отобрадения каталога, то переписываем их
        $result = array();
        //проверяем корректность параметров
        foreach ($availableParams as $paramKey => $paramValue) { 
            if ($_GET[$paramKey] && in_array($_GET[$paramKey], $paramValue)) {
                $result[$paramKey] = $_GET[$paramKey];
            }   
        }
        //после окончания формирования массива перезагружаем страницу
        if (count($result) > 0) {
            setCatalogViewParams($result, true);
        }

    }


    /**
    * функция возвращает массив товаров, находящихся в корзине пользователя в данный момент.
    * возвращается массив вида: ID товара (из инфоблока каталога товаров или PRODUCT_ID) => array(
    * QUANTITY => количество данного товара в корзине, ID => ID записи в корзине - не путать с PRODUCT_ID, NAME => название товара
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