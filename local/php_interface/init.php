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

    $arPageElementCount = array(12, 24, 60); //возможные варианты количестка элементов на странице

    //массив вариантов сортировки товаров в каталоге
    $catalogAvailableSort = array("NAME", "DATE_CREATE", "PRICE");

    //возможные направления сортировки товаров
    $catalogAvailableSortDirections = array("ASC", "DESC");

    global $availableParams;
    //массив допустимых параметров для отображения каталога КЛЮЧ => МАССИВ ДОПУСТИМЫХ ЗНАЧЕНИЙ
    $availableParams = array(
        "PAGE_ELEMENT_COUNT" => $arPageElementCount, //количество элементов на странице
        "ELEMENT_SORT_FIELD" => $catalogAvailableSort, //поле для первой сортировки
        "ELEMENT_SORT_ORDER" => $catalogAvailableSortDirections, //направление для первой сортировки
        "ELEMENT_SORT_FIELD2" => $catalogAvailableSort, //поле для второй сортировки
        "ELEMENT_SORT_ORDER2" => $catalogAvailableSortDirections, //направление для второй сортировки
        "CATALOG_SECTION_TEMPLATE" => array("blocks", "table"), //шаблоны списка элементов
    );


    define("DEFAULT_TEMPLATE_PATH", SITE_DIR."local/templates/.default/"); //path of ".default" site template
    define("NEWS_IBLOCK_ID", 1);
    define("CATALOG_IBLOCK_ID", 5); //main catalog
    define("OFFERS_IBLOCK_ID", 6);  //offers
    define("FAVORITE_IBLOCK_ID", 12);
	define("USER_SAVED_ADDRESSES_IBLOCK_ID", 13);
	define("BRANDS_IBLOCK_ID", 14);

    define("USER_QUESTIONS_IBLOCK_ID", 22);
    define("USER_QUESTIONS_FAQ_IBLOCK_ID", 24);
	
	define("RETAIL_IBLOCK_ID", 28);

	define("USER_SAVED_ADDRESSES_STREET_PROPERTY", 433); // улица
	define("USER_SAVED_ADDRESSES_HOUSING_PROPERTY", 434); // Строение/корпус
	define("USER_SAVED_ADDRESSES_BUILDING_PROPERTY", 435); // Дом
	define("USER_SAVED_ADDRESSES_APARTMENT_PROPERTY", 436); // Квартира/офис
	define("USER_SAVED_ADDRESSES_BX_LOCATION_ID_PROPERTY", 437); // ID местоположения битрикс

	define("USER_QUESTIONS_EMAIL_PROPERTY", 468);
	define("USER_QUESTIONS_COMPANY_PROPERTY", 469);
	define("USER_QUESTIONS_QUESTION_PROPERTY", 470);

	define("USER_FAQ_QUESTIONS_EMAIL_PROPERTY", 473);
	define("USER_FAQ_QUESTIONS_COMPANY_PROPERTY", 474);

	define("ORDER_LOCATION_ID", 18); // местоположение
	define("ORDER_LOCATION", "ORDER_PROP_18"); // местоположение
	define("ORDER_STREET", "ORDER_PROP_20"); // улица
	define("ORDER_HOUSING", "ORDER_PROP_21"); // Строение/корпус
	define("ORDER_BUILDING", "ORDER_PROP_22"); // Дом
	define("ORDER_APARTMENT", "ORDER_PROP_23"); // Квартира/офис
	define("DEFAULT_LOCATION_ID", 129); // Дефолтное местоположение - Москва
	
	define("ELEMENT_CARD_PREVIEW_HEIGHT", 83);
	define("ELEMENT_CARD_PREVIEW_WIDTH", 76);
	define("ELEMENT_CARD_MAIN_HEIGHT", 520);
	define("ELEMENT_CARD_MAIN_WIDTH", 520);
	
	define("CARD_QUESTION_FORM_TEMPLATE_ID", 77);
	define("FORM_FROM_EMAIL", "info@amatagroup.ru");
	
	define("MANUFACTURER_FOOTER_FORM", "MANUFACTURER_FOOTER_FORM");
	define("CONTACTS_FEEDBACK_FORM", "CONTACTS_FEEDBACK_FORM");
	define("QUESTION_PRODUCT_CARD", "QUESTION_PRODUCT_CARD");

    /*константы для отображения каталога*/
    define("DEFAULT_PAGE_ELEMENT_COUNT", $GLOBALS["availableParams"]["PAGE_ELEMENT_COUNT"][0]); //количество элементов на странице раздела каталога по умолчанию
    define("DEFAULT_ELEMENT_SORT_FIELD", $GLOBALS["availableParams"]["ELEMENT_SORT_FIELD"][0]); //поле для первой сортировки элементов в каталоге по умолчанию
    define("DEFAULT_ELEMENT_SORT_ORDER", $GLOBALS["availableParams"]["ELEMENT_SORT_ORDER"][0]); //направление для первой сортировки элементов в каталоге по умолчанию
    define("DEFAULT_ELEMENT_SORT_FIELD2", $GLOBALS["availableParams"]["ELEMENT_SORT_FIELD"][1]); //поле для второй сортировки элементов в каталоге по умолчанию
    define("DEFAULT_ELEMENT_SORT_ORDER2", $GLOBALS["availableParams"]["ELEMENT_SORT_ORDER2"][0]); //направление для второй сортировки элементов в каталоге по умолчанию
    define("DEFAULT_CATALOG_SECTION_TEMPLATE", "blocks"); //шаблон для отображения элементов раздела по умолчанию
    /*///*/

	/* службы доставки */
	define("COURIER_DELIVERY", 2);

    define("NEW_PRODUCT_STATUS_LENGTH", 14); //количество дней, котрое товар считается новинкой
    define("FRESH_PRODUCT_STATUS_LENGTH", 2); //количество дней, котрое товар считается последним поступлением

    define("IBLOCK_ID_QUASTION_PRODUCT", 19); // инфоблок задать вопрос по товару
    define("IBLOCK_ID_QUASTION", 18); // инфоблок оставить вопрос


    // файл с кодом для избранного
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
	
	function getFormTypes() {
		return array(
			MANUFACTURER_FOOTER_FORM => 'Вопрос производителю из футера',
			CONTACTS_FEEDBACK_FORM   => 'Обратная связь из контактов',
			QUESTION_PRODUCT_CARD    => 'Задать вопрос из карточки товара'
		);
	}

    /**
	 *
	 * Возвращает автоматически определенный город при помощи модуля Altasib
	 * Требует установленного модуля http://marketplace.1c-bitrix.ru/solutions/altasib.geobase/
	 *
	 * @return bool|string
	 *
	 * */
    function getAltasibCity() {
    	return $_SESSION["ALTASIB_GEOBASE_CODE"]["CITY"]["NAME"] ? $_SESSION["ALTASIB_GEOBASE_CODE"]["CITY"]["NAME"] : false;
    }
	
	/**
	 * 
	 * @param int $photo_id
	 * @param int $width
	 * @param int $height
	 * @param string $type
	 * @return string $src
	 * 
	 * */
    function getResizedImage($photo_id, $width, $height, $type) {
    	$file_path = CFile::GetPath($photo_id);
    	if ($file_path && (int)$width && (int)$height && strval($width)) {
    		$preview_img_file = CFile::ResizeImageGet($photo_id, array('width' => $width, 'height' => $height), $type, true);
			return $preview_img_file['src'];
    	}
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
            header ("location: ".$_SERVER["HTTP_REFERER"]);
        }

    }


    /***
    * функция поиска ключа текущего выбранного элемента из возможных/ нужна для работы с параметрами каталога
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
    * функция возвращает html код нужного блока для управления каталогом (выбор количества элементов на странице, список сортировки, направления сортировки)
    *
    * @param string $blockName (PAGE_ELEMENT_COUNT, ELEMENT_SORT_FIELD, ELEMENT_SORT_ORDER)
    */
    function getCatalogOptionBlock($blockName) {

        if (empty($blockName)) {
            return false;
        }

        $curParams = getCatalogViewParams();
        $availableParam = $GLOBALS["availableParams"][$blockName];

        $currentKey = getParamKey($blockName);  //индекс текущего активного элемента из всех возможных

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
    * хендлер проверяет, не пришли ли через GET параметры для отображения каталога. если пришли - проверяем и меняем
    */
    AddEventHandler("main", "OnProlog", "checkRequestData");
    function checkRequestData() {
        $availableParams = $GLOBALS["availableParams"]; //параметры для отображения каталога
        //если в массиве $_GET есть параметры для отображения каталога, то переписываем их
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

	AddEventHandler("sale", "OnBeforeOrderAdd", "addUserLocationToSaved");

	/**
	 *
	 * Возвращаем сохраненные адреса для пользователя
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
	 * Добавить метоположение в избранное
	 *
	 * @param array $arFields
	 * @return int|string
	 *
	 * */

	function addUserLocationToSaved(&$arFields) {
		global $USER;
		// очищаем ID выбранного адреса избранного
		unset($_SESSION['SAVED_ADDRESS_ID']);

		if ($arFields['DELIVERY_ID'] != COURIER_DELIVERY) {
			$request_location  = (int)$_POST[ORDER_LOCATION];
			$request_street    = trim((string)$_POST[ORDER_STREET]);
			$request_housing   = (int)$_POST[ORDER_HOUSING];
			$request_building  = (int)$_POST[ORDER_BUILDING];
			$request_apartment = (int)$_POST[ORDER_APARTMENT];

			if (!isLocationAlreadySaved($request_location, $request_street, $request_housing, $request_building, $request_apartment)) {
				$location_string = "";
				$location = CSaleLocation::GetByID($request_location);
				if (is_array($location)) {
					$location_string .= ($location["CITY_NAME_ORIG"] ? $location["CITY_NAME_ORIG"] : $location["REGION_NAME_ORIG"]) . ", "; // город или область
					$location_string .= $request_street ? "ул. " . $request_street . ", " : ""; // улица
					$location_string .= $request_housing ? "корпус " . $request_housing . ", " : ""; // корпус
					$location_string .= $request_building ? "д. " . $request_building . ", " : ""; // дом
					$location_string .= $request_apartment ? "кв. " . $request_apartment . ", " : ""; // квартира
				}
				$new_saved_location = new CIBlockElement;

				$properties = array();
				$properties[USER_SAVED_ADDRESSES_BX_LOCATION_ID_PROPERTY] = $request_location;
				$properties[USER_SAVED_ADDRESSES_STREET_PROPERTY] = $request_street;
				$properties[USER_SAVED_ADDRESSES_HOUSING_PROPERTY] = $request_housing;
				$properties[USER_SAVED_ADDRESSES_BUILDING_PROPERTY] = $request_building;
				$properties[USER_SAVED_ADDRESSES_APARTMENT_PROPERTY] = $request_apartment;

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
		}
	}

	/**
	 *
	 * Проверяем, добавлено ли уже такое местопложение.
	 *
	 * @param int $location_id
	 * @param string $street
	 * @param int $housing
	 * @param int $building
	 * @param int $apartment
	 *
	 * @return bool
	 *
	 * */

	function isLocationAlreadySaved($location_id, $street, $housing = false, $building, $apartment) {
		global $USER;
		$result = false;

		$select = Array(
			"ID"
		);
		$filter = Array(
			"IBLOCK_ID"               => USER_SAVED_ADDRESSES_IBLOCK_ID,
			"CREATED_BY"              => $USER->GetID(),
			"ACTIVE"                  => "Y",
			"PROPERTY_BX_LOCATION_ID" => (int)$location_id,
			"PROPERTY_STREET"         => trim((string)$street),
			"PROPERTY_HOUSING"        => (int)$housing,
			"PROPERTY_BUILDING"       => (int)$building,
			"PROPERTY_APARTMENT"      => (int)$apartment,
		);

		$saved_addresses = CIBlockElement::GetList(Array(), $filter, false, false, $select);
		if ($address = $saved_addresses->Fetch()) {
			$result = true;
		}

		return $result;
	}

?>