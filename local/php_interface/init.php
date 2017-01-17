<?

    include(GetLangFileName(dirname(__FILE__)."/", "/init.php"));

    CModule::IncludeModule("blog");
    CModule::IncludeModule("iblock");
    CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
    CModule::IncludeModule("main");
    CModule::IncludeModule("highloadblock");

    use Bitrix\Main;
    use Bitrix\Main\Loader;
    use Bitrix\Main\Localization\Loc;
    use Bitrix\Sale\Internals;

    use Bitrix\Highloadblock as HL;
    use Bitrix\Main\Entity;

    $arPageElementCount = array(12, 24, 36); //возможные варианты количестка элементов на странице

    //массив вариантов сортировки товаров в каталоге
    $catalogAvailableSort = array("ID", "NAME", "PRICE");

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
        "CATALOG_AVAILABLE_PRODUCT" => array("Y", "N")  //значения наличия элементов
    );


    define("DEFAULT_TEMPLATE_PATH", SITE_DIR."local/templates/.default/"); //path of ".default" site template
    define("BLOCKS_NO_PHOTO", SITE_DIR . "local/templates/.default/img/blocks_nophoto.png"); //path of no photo for blocks
    define("NEWS_IBLOCK_ID", 1);
    define("PROMO_IBLOCK_ID", 27);
    define("PROMO_IBLOCK_SECTION_ID", 2089);
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
    define("ITEM_TYPE_PROPERTY_ID", 1380);
	define("PROPERTY_BREND_HAVE_ITEMS_YES", 13956); // У бренда есть товары
	define("PROPERTY_BREND_HAVE_ITEMS_NO", 13957); // У бренда нет товаров
	define("PROPERTY_BREND_ID", 245);
	define("PROPERTY_PRODUCT_TYPE_ID", 1380);


    define("ORGANIZATION_TYPE_OOO", 4); // Тип фирмы ООО
    define("ORGANIZATION_TYPE_IP", 5); // Тип фирмы ИП

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

    define("BLOCKS_PREVIEW_HEIGHT", 200);
    define("BLOCKS_PREVIEW_WIDTH", 240);
    
    define("ELEMENT_CARD_THUMBNAIL_HEIGHT", 47);
    define("ELEMENT_CARD_THUMBNAIL_WIDTH", 45);
    define("ELEMENT_CARD_PREVIEW_HEIGHT", 83);
    define("ELEMENT_CARD_PREVIEW_WIDTH", 76);
    define("ELEMENT_CARD_MAIN_HEIGHT", 490);
    define("ELEMENT_CARD_MAIN_WIDTH", 510);

    // для слайдера на главной
    define("ELEMENT_SPECIAL_OFFER_HIT", 6257);
    define("ELEMENT_SPECIAL_OFFER_NEW", 6258);
    define("ELEMENT_SPECIAL_OFFER_BEST", 6259);
    define("ELEMENT_SPECIAL_OFFER_SALE", 6260);

    define("CARD_QUESTION_FORM_TEMPLATE_ID", 77);
    define("CARD_QUESTION_FORM_TEMPLATE_ID_EMAIL", 89);
    define("QUESTION_FORM_TEMPLATE_ID", 78);
    define("SEND_QUESTION_FORM_TEMPLATE_ID", 76);
    define("FORM_FROM_EMAIL", "info@amatagroup.ru");

    // границы кол-ва для индикации товара
    define("LOW_QUANTITY_BORDER", 5);
    define("MEDIUM_QUANTITY_FROM_BORDER", 6);
    define("MEDIUM_QUANTITY_TO_BORDER", 20);
	define("MANY_QUANTITY_BORDER", 21);

    define("MANUFACTURER_FOOTER_FORM", "MANUFACTURER_FOOTER_FORM");
    define("CONTACTS_FEEDBACK_FORM", "CONTACTS_FEEDBACK_FORM");
    define("QUESTION_PRODUCT_CARD", "QUESTION_PRODUCT_CARD");
    define("FAQ_FORM", "FAQ_FORM");
    define("ABOUT_FORM", "ABOUT_FORM");                                              

    /*константы для отображения каталога*/
    define("DEFAULT_PAGE_ELEMENT_COUNT", $GLOBALS["availableParams"]["PAGE_ELEMENT_COUNT"][0]); //количество элементов на странице раздела каталога по умолчанию
    define("DEFAULT_ELEMENT_SORT_FIELD", $GLOBALS["availableParams"]["ELEMENT_SORT_FIELD"][0]); //поле для первой сортировки элементов в каталоге по умолчанию - всегда по наличию картинок
    define("DEFAULT_ELEMENT_SORT_ORDER", $GLOBALS["availableParams"]["ELEMENT_SORT_ORDER"][1]); //направление для первой сортировки элементов в каталоге по умолчанию
    define("DEFAULT_ELEMENT_SORT_FIELD2", "HAS_PREVIEW_PICTURE"); //поле для второй сортировки элементов в каталоге по умолчанию
    define("DEFAULT_ELEMENT_SORT_ORDER2", $GLOBALS["availableParams"]["ELEMENT_SORT_ORDER2"][1]); //направление для второй сортировки элементов в каталоге по умолчанию
    define("DEFAULT_CATALOG_AVAILABLE_PRODUCT", $GLOBALS["availableParams"]["CATALOG_AVAILABLE_PRODUCT"][1]); //фильтрация по наличию элементов в каталоге по умолчанию

    define("DEFAULT_CATALOG_SECTION_TEMPLATE", "blocks"); //шаблон для отображения элементов раздела по умолчанию
    /*///*/

    /* службы доставки */
    define("COURIER_DELIVERY_1", 27);
    define("COURIER_DELIVERY_2", 28);

    define("NEW_PRODUCT_STATUS_LENGTH", 60); //количество дней, котрое товар считается новинкой
    define("FRESH_PRODUCT_STATUS_LENGTH", 2); //количество дней, котрое товар считается последним поступлением

    define("IBLOCK_ID_QUASTION_PRODUCT", 19); // инфоблок задать вопрос по товару
    define("IBLOCK_ID_QUASTION", 18); // инфоблок оставить вопрос

    define("CATALOG_GROUP_ID_PRICE_BASE", 2); // код типа цены по умолчанию

    define("CATALOG_SECTION_LATEST", '/catalog/bestsellers/');
    define("IMAGE_SERTIFICATE_WIDTH", 600); // код типа цены базовой
    define("IMAGE_SERTIFICATE_HEIGHT", 800); // код типа цены базовой


    define("IMAGE_AVATAR_WIDTH", 40); // размер аватарок в отзывах
    define("IMAGE_AVATAR_HEIGHT", 40); // размер аватарок в отзывах

    define("MAIL_THUMBNAIL_WIDTH", 55); // размер картинки товара в письме
    define("MAIL_THUMBNAIL_HEIGHT", 55); // размер картинки товара в письме

    define("IMAGE_AVATAR_WIDTH", 40); // размер аватарок в отзывах
    define("IMAGE_AVATAR_HEIGHT", 40); // размер аватарок в отзывах

    define("PARTNERS_HL_BLOCK_ID", 8); //ID highload-блока "партнеры"
    define("PARTNERS_GROUPS_HL_BLOCK_ID", 6); //ID highload-блока "соглашения с клиентами"
    define("IBLOCK_ID_CATALOG", 5); //ID инфоблока каталога

    define("NEW_USER_AUTOMATIC_REG_MAIL_TEMPLATE", 91); //ID шаблона письма об автоматической регистрации пользователя

    //функцинальные разделы каталога
    global $functional_sections;
    $functional_sections = array(
        "bestsellers" => array("NAME" => GetMessage("CATALOG_BESTSELLERS")), //бествеллеры
        "expected_products" => array("NAME" => GetMessage("CATALOG_EXPECTED_PRODUCTS")), //ожидаемые поступления
        "new_products" => array("NAME" => GetMessage("CATALOG_NEW_PRODUCTS")), //новинки
        "last_products" => array("NAME" => GetMessage("CATALOG_FRESH_PRODUCTS")) //последние поступления
    );

    file_exists($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/.config.php') ? require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/.config.php') : "";
    // файл с кодом для избранного
    file_exists($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/favorite/class.php') ? require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/favorite/class.php') : "";
    // файл с классом извлечения данных заказа
    file_exists($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/mailOrder.php') ? require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/mailOrder.php') : "";


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
            QUESTION_PRODUCT_CARD    => 'Задать вопрос из карточки товара',
            FAQ_FORM                 => 'Форма "Вопрос-ответ"',
            ABOUT_FORM               => 'Форма вопроса из раздела "О компании"'
        );
    }

	/**
	 * Получить языковую фразу для кол-ва товара
	 * Названия фраз завязаны на css классы !
	 * @param int $quantity
	 * @return string
	 **/

	function getQuantityLang($quantity) {
		$quantity_string = 	"quantity_zero";
		if ($quantity <= LOW_QUANTITY_BORDER && $quantity > 0) {
			$quantity_string = 	"quantity_low";
		} else if ($quantity <= MEDIUM_QUANTITY_TO_BORDER && $quantity >= MEDIUM_QUANTITY_FROM_BORDER) {
			$quantity_string = 	"quantity_medium";
		} else if ($quantity >= MANY_QUANTITY_BORDER) {
			$quantity_string = 	"quantity_high";
		}
		return $quantity_string;
	}

	/**
	 * Получить текстовую фразу для кол-ва товара
	 * @param int $quantity
	 * @param bool $short нужно только короткое описание в виде знака
	 * @return string
	 **/

	function getQuantityText($quantity, $short = false) {
		$short_macros = $short ? "> " : "";
		$quantity_string = GetMessage("zero_quantity_text");
		if ($quantity <= LOW_QUANTITY_BORDER && $quantity > 0) {
			$quantity_string = 	$quantity . " шт.";
		} else if ($quantity >= MEDIUM_QUANTITY_FROM_BORDER) {
			$quantity_string = 	$short_macros . GetMessage("more_than_quantity") . " шт.";
		}

		return $quantity_string;
	}

    /**
    * Пересобираем название элемента из свойств, если они заполнены
    * @param array $item
    * @return bool|string $result
    * */
    function getNamesFromProperties(&$item) {
        $result = "";
        $setted_model = "";
        $models = array(
        	// эта хитрая конструкция выбирает первый элемент массива, независимо от названия ключа, т.к. битрикс может их менять, там может быть 0, n0, рандомный набор чисел
            $item['PROPERTY_VALUES'][250][key($item['PROPERTY_VALUES'][250])]['VALUE'],
            $item['PROPERTY_VALUES'][1364][key($item['PROPERTY_VALUES'][1364])]['VALUE'],
            $item['PROPERTY_VALUES'][1369][key($item['PROPERTY_VALUES'][1369])]['VALUE'],
            $item['PROPERTY_VALUES'][1376][key($item['PROPERTY_VALUES'][1376])]['VALUE'],
            $item['PROPERTY_VALUES'][1466][key($item['PROPERTY_VALUES'][1466])]['VALUE'],
            $item['PROPERTY_VALUES'][1480][key($item['PROPERTY_VALUES'][1480])]['VALUE'],
            $item['PROPERTY_VALUES'][1509][key($item['PROPERTY_VALUES'][1509])]['VALUE'],
            $item['PROPERTY_VALUES'][2778][key($item['PROPERTY_VALUES'][2778])]['VALUE'],
            $item['PROPERTY_VALUES'][2779][key($item['PROPERTY_VALUES'][2779])]['VALUE']
        );
        // проверяем заполненность необходимых свойств
        if (
            $item['PROPERTY_VALUES'][PROPERTY_BREND_ID][0]['VALUE'] // бренд
            && $item['PROPERTY_VALUES'][PROPERTY_PRODUCT_TYPE_ID][0]['VALUE'] // объединенное свойство тип товара
            && ( // дальше ад, если заполнена хотя бы одна модель
                $setted_model = current(array_filter($models))
            )
        ) {
        	// т.к. бренд и тип товара приходят как ID значений свойств типа список, то сначала достанем их значения
        	$brand_value = getXMLIDByCode(CATALOG_IBLOCK_ID, "BREND", $item['PROPERTY_VALUES'][PROPERTY_BREND_ID][0]['VALUE']);
			$product_type_value = getXMLIDByCode(CATALOG_IBLOCK_ID, "VIDTOVARA", $item['PROPERTY_VALUES'][PROPERTY_PRODUCT_TYPE_ID][0]['VALUE']);
            $result = sprintf("%s %s %s", $product_type_value, $brand_value, $setted_model);
        }

        return $result;
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

	/***************
    *
    * получение VALUE свойства списка по его ID
    *
    * @param int $iblock_id - инфоблок, содержащий свойство
    * @param string $prop_code - символьный код свойства
    * @param string $prop_value_id - ID значения свойства
    * @return string $iblock_property_value["VALUE"]
    ***************/

    function getXMLIDByCode($iblock_id, $prop_code, $prop_value_id) {
        $iblock_props = CIBlockPropertyEnum::GetList(
        	array(),
        	array(
        		"IBLOCK_ID" => $iblock_id,
        		"CODE"      => $prop_code,
        		"ID"        => $prop_value_id
			)
		);
        if ($iblock_property_value = $iblock_props->Fetch()) {
            return $iblock_property_value["VALUE"];
        }
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

	AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "autoNameBuild");
	AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "autoNameBuild");

	/**
	 *
	 * Собираем автоимя, если соответствующие поля заполнены
	 * @param array $arFields
	 * @return void
	 *
	 * */
    function autoNameBuild(&$arFields) {
		// переприсваиваем имя товара, если необходимые свойства заполнены
		if ($arFields['IBLOCK_ID'] == CATALOG_IBLOCK_ID) {
			$new_product_name = getNamesFromProperties($arFields);
			$arFields['NAME'] = $new_product_name ? $new_product_name : $arFields['NAME'];
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

    // AddEventHandler("main", "OnAfterUserAdd", "OnAfterUserRegisterHandler");
    //  AddEventHandler("main", "OnAfterUserRegister", "OnAfterUserRegisterHandler");
    // отправляем пользователю письмо после изменения активности пользователя
    AddEventHandler("main", "OnBeforeUserUpdate", "OnBeforeUserRegisterHandler");
    function OnBeforeUserRegisterHandler(&$arFields)
    {
        $filter = Array("ID" => $arFields["ID"]);
        $rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); // выбираем пользователей
        while($arUser = $rsUsers->GetNext()) {
            $user_active = $arUser["ACTIVE"];
        };
        if ($arFields["ACTIVE"] == 'Y' && $user_active == "N") { // проверяем происходила ли активация пользователя
            $toSend = Array();
            $toSend["PASSWORD"] = $arFields["CONFIRM_PASSWORD"];
            $toSend["EMAIL"] = $arFields["EMAIL"];
            $toSend["USER_ID"] = $arFields["ID"];
            $toSend["USER_IP"] = $arFields["USER_IP"];
            $toSend["USER_HOST"] = $arFields["USER_HOST"];
            $toSend["LOGIN"] = $arFields["LOGIN"];
            $toSend["NAME"] = (trim ($arFields["NAME"]) == "")? $toSend["NAME"] = htmlspecialchars('Не указано'): $arFields["NAME"];
            $toSend["LAST_NAME"] = (trim ($arFields["LAST_NAME"]) == "")? $toSend["LAST_NAME"] = htmlspecialchars('Не указано'): $arFields["LAST_NAME"];
            CEvent::Send ("NEW_USER", "s1", $toSend, "N", 1);
        }
        return $arFields;
    }

    function SendMailOffThreeDay(){   // отправка письма менеджеру после 3 дней ожидания регистрации пользователя
        CModule::IncludeModule('main');
        $filter = Array("ACTIVE" => "N");
        $rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); // выбираем пользователей
        while($arUser = $rsUsers->GetNext()) {
            $nextWeek = strtotime(date('d.m.Y H:i:s')) - strtotime($arUser["DATE_REGISTER"]);
            if($nextWeek > 259200) {  // время создания больше 3 дней
                $filter_user["USER_ID"] = $arUser["ID"];
                $filter_user["LOGIN"] = $arUser["LOGIN"];
                CEvent::Send ("NEW_USER", "s1", $filter_user, "N", 85);
            }
        };
        return 'SendMailOffThreeDay();';
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
        $element_avalible_product = (!empty($_SESSION["CATALOG_PARAMS"]["CATALOG_AVAILABLE_PRODUCT"]) ? $_SESSION["CATALOG_PARAMS"]["CATALOG_AVAILABLE_PRODUCT"] : DEFAULT_CATALOG_AVAILABLE_PRODUCT);
        $catalog_section_template = (!empty($_SESSION["CATALOG_PARAMS"]["CATALOG_SECTION_TEMPLATE"]) ? $_SESSION["CATALOG_PARAMS"]["CATALOG_SECTION_TEMPLATE"] : DEFAULT_CATALOG_SECTION_TEMPLATE);

        return array(
            "PAGE_ELEMENT_COUNT" => $page_element_count,
            "ELEMENT_SORT_FIELD" => $element_sort_field,
            "ELEMENT_SORT_ORDER" => $element_sort_order,
            "ELEMENT_SORT_FIELD2" => $element_sort_field2,
            "ELEMENT_SORT_ORDER2" => $element_sort_order2,
            "CATALOG_AVAILABLE_PRODUCT" => $element_avalible_product,
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
            localredirect($_SERVER["REDIRECT_URL"]);
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
            <p data-sort="<?=$currentKey?>" class="firstFiltElement1" id="activeFirstFilt"><img src="<?=DEFAULT_TEMPLATE_PATH?>/img/SORT_<?=$curParams["ELEMENT_SORT_ORDER"]?>.png"> <?=GetMessage("CATALOG_ORDER_BY_".$curParams[$blockName])?></p>
            <div class="hidingMenu">
                <?foreach ($availableParam as $key => $fieldName){?>
                    <?foreach ($GLOBALS["availableParams"]["ELEMENT_SORT_ORDER"] as $sort_dir) {?>
                        <p data-sort="<?=$key?>" data-href="?<?=$blockName?>=<?=$fieldName?>&ELEMENT_SORT_ORDER=<?=$sort_dir?>"><img src="<?=DEFAULT_TEMPLATE_PATH?>/img/SORT_<?=$sort_dir?>.png"> <?=GetMessage("CATALOG_ORDER_BY_".$fieldName)?></p>
                        <?}?>
                    <?}?>
            </div>
            <?
                break;

                /*case "ELEMENT_SORT_ORDER" :

                ?>
                <p data-sort="<?=$currentKey?>" id="activeSecondFilt"><?=GetMessage("CATALOG_ORDER_DIRECTION_".$curParams[$blockName])?></p>
                <div class="hidingMenu">
                <?foreach ($availableParam as $key => $fieldName){?>
                <p data-sort="<?=$key?>" data-href="?<?=$blockName?>=<?=$fieldName?>"><?=GetMessage("CATALOG_ORDER_DIRECTION_".$fieldName)?></p>
                <?}?>
                </div>
                <?
                break; */
            case "CATALOG_AVAILABLE_PRODUCT" :
            ?>
            <?if($_SESSION["CATALOG_PARAMS"]["CATALOG_AVAILABLE_PRODUCT"] == 'Y'){?>
                <input type="checkbox" id="<?=$blockName?>" data-sort="<?=$currentKey?>" checked hidden><label title="<?=GetMessage('PRODUCT_AVALIBLE')?>"  data-href="?<?=$blockName?>=<?=$availableParam[1]?>" for="<?=$blockName?>"><?=GetMessage("CATALOG_AVALIBLE_PRODUCT")?> </label>
                <?} else {?>
                <input type="checkbox" id="<?=$blockName?>" data-sort="<?=$currentKey?>" hidden><label title="<?=GetMessage('PRODUCT_AVALIBLE')?>"  data-href="?<?=$blockName?>=<?=$availableParam[0]?>" for="<?=$blockName?>"><?=GetMessage("CATALOG_AVALIBLE_PRODUCT")?> </label>
                <?}?>
            <?
                break;
            default:
                return false;

                break;
        }

    }



    /***
    * хендлер проверяет, не пришли ли через $_GET параметры для отображения каталога. если пришли - проверяем и меняем
    */
    AddEventHandler("main", "OnProlog", "checkRequestData");
    function checkRequestData() {
        $availableParams = $GLOBALS["availableParams"]; //параметры для отображения каталога
        //если в массиве $_GET есть параметры для отображения каталога, то переписываем их
        $result = array();
        //проверяем корректность параметров
        foreach ($availableParams as $paramKey => $paramValue) {
            //если в реквесте есть значение для одного из параметров и оно имеет допустимое значение
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

    // при создании/изменении товара запускаем функцию пересборки цен
    AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "OnPriceUpdate");
    AddEventHandler("iblock", "OnAfterIBlockElementAdd", "OnPriceUpdate");
    function OnPriceUpdate(&$arFields) {
        if ($arFields["IBLOCK_ID"] == CATALOG_IBLOCK_ID && intval($arFields["ID"]) > 0) {
            setMinPrice($arFields["ID"]);
        }
    }

    /**
    * функция перебирает все предложения товара
    * и устанавливает для товара минимальные цены всех типов
    * исходя из цен предложений
    *
    * @param integer $product_id - идентификатор товара
    * @param string $currency - валюта
    */
    function setMinPrice($product_id, $currency = "RUB") {

        $product_id = intval($product_id);
        if (empty($product_id)) {
            return false;
        }
        //получаем предложения товара
        $arOffers = CCatalogSKU::getOffersList(array($product_id), 0, array(), array(), array());

        //выбираем предложения текущего товара
        $offers = $arOffers[$product_id];
        if (!is_array($offers) || count($offers) <= 0) {
            return false;
        }

        $offers_list = array();
        //перебираем предложения
        foreach ($offers as $fID => $offer) {
            $offers_list[] = $offer["ID"];
        }

        if (count($offers_list) <= 0) {
            return false;
        }

        //получаем минимальные цены предложений для всех возможных типов цен
        $min_prices = array();
        $rsPrice = CPrice::GetList(array("PRODUCT_ID" => "ASC"), array("PRODUCT_ID" => $offers_list), false, false, array());
        while($arPrice = $rsPrice->Fetch()) {
            if (empty($min_prices[$arPrice["CATALOG_GROUP_ID"]]) || $arPrice["PRICE"] < $min_prices[$arPrice["CATALOG_GROUP_ID"]]) {
                $min_prices[$arPrice["CATALOG_GROUP_ID"]] = $arPrice["PRICE"];
            }
        }

        //обновляем полученные типы цен у товара
        if (count($min_prices) > 0) {
            foreach ($min_prices as $price_id => $price) {
                $res = CPrice::GetList( array(), array("PRODUCT_ID" => $product_id, "CATALOG_GROUP_ID" => $price_id));
                //проверяем существование данного типа цены у товара.
                $arFields = Array(
                    "PRODUCT_ID" => $product_id,
                    "CATALOG_GROUP_ID" => $price_id,
                    "CURRENCY" => $currency,
                );
                if ($arr = $res->Fetch()) {
                    //если есть - обновляем
                    $arFields["PRICE"] = $price;
                    CPrice::Update($arr["ID"], $arFields);
                } else {
                    //если нет - добавляем
                    $arFields["PRICE"] = $price;
                    CPrice::Add($arFields);
                }
            }
        }
    }


    //обновление количества у основноо товара с учетом количества ТП
    AddEventHandler("catalog", "OnProductAdd","UpdateProductQuantity");
    AddEventHandler("catalog", "OnProductUpdate","UpdateProductQuantity");

    function UpdateProductQuantity($id, $arFields) {
        $quantity = $arFields['OLD_QUANTITY'];

        $arProductInfo = CCatalogSKU::GetProductInfo($id);
        if (is_array($arProductInfo)) {
            $arOffersInfo = CCatalogSKU::GetInfoByProductIBlock($arProductInfo['IBLOCK_ID']);
            $arFilter = array(
                'IBLOCK_ID' => OFFERS_IBLOCK_ID,
                "PROPERTY_CML2_LINK" => $arProductInfo['ID'],
                "!ID" => $id,
            );

            $obOffersList = CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter, false, false, array("CATALOG_QUANTITY"));
            while ($arOffers = $obOffersList->Fetch()) {
                $quantity += $arOffers["CATALOG_QUANTITY"];
            }

            $arFieldsProduct = array(
                "QUANTITY" => $quantity,
            );
            CCatalogProduct::Update($arProductInfo['ID'], $arFieldsProduct);
        }
    }

    // Заменяет символ валюты в письме заказа
    AddEventHandler('sale', 'OnOrderNewSendEmail', "currencyTypeReplacement");
    // Полная пересборка письма о новом заказе
    AddEventHandler('sale', 'OnOrderNewSendEmail', "newOrderMailRebuild");

    function currencyTypeReplacement($ID, &$eventName, &$arFields) {
        $arFields["PRICE"] = preg_replace('~<span class="rub">c</span>~', 'Р', $arFields["PRICE"]);
        $arFields["ORDER_LIST"] = preg_replace('~<span class="rub">c</span>~', 'Р', $arFields["ORDER_LIST"]);

        return $arFields;
    }

    function newOrderMailRebuild($ID, &$eventName, &$arFields) {
        // получаем данные заказа
        $order_data = OrderMail::GetOrderInfo($arFields['ORDER_ID']);
        // забиваем макросы
        $arFields["ORDER_STATUS"] = $order_data['status'];
        $arFields["DELIVERY_TYPE"] = $order_data['delivery_type'];
        $arFields["DELIVERY_ADDRESS"] = $order_data['address'];
        $arFields["PAYMENT_TYPE"] = $order_data['payment_system'];
        $arFields["COMMENT"] = $order_data['user_comment'];
        // из компонентов заказа формируем верстку
        $items = $order_data['items_in_order'];

        foreach ($items as $item_id => $item_fields) {
            $arFields["ITEMS_IN_ORDER"] .= str_replace(
                OrderMail::$items_in_order_template_macroses,
                array(
                    "http://" . $_SERVER['SERVER_NAME'] . $item_fields['detail_url'],
                    "http://" . $_SERVER['SERVER_NAME'] . $item_fields['picture'],
                    $item_fields['item_name'],
                    $item_fields['article'],
                    $item_fields['price'],
                    (int)$item_fields['quantity'],
                    round($item_fields['quantity'] * $item_fields['price'], 2),
                    $item_fields['offer']
                ),
                OrderMail::$items_in_order_template
            );
        }

        return $arFields;
    }

    /**
    * Функция возвращает окончание для множественного числа слова на основании числа и массива окончаний
    * param  $number Integer Число на основе которого нужно сформировать окончание
    * param  $endingsArray  Array Массив слов или окончаний для чисел (1, 4, 5),
    *         например array('яблоко', 'яблока', 'яблок')
    * return String
    */
    function getNumEnding($number, $endingArray) {
        $number = $number % 1000;
        if ($number>=11 && $number<=19) {
            $ending = $number . ' ' . $endingArray[2];
        } else {
            $i = $number % 10;
            switch ($i) {
                case (1): $ending = $number . ' ' . $endingArray[0]; break;
                case (2):
                case (3):
                case (4): $ending = $number . ' ' . $endingArray[1]; break;
                default: $ending = $number . ' ' . $endingArray[2];
            }
        }
        return $ending;
    }

    AddEventHandler("catalog", "OnSuccessCatalogImport1C", "findBrandsActiveItems");

    /**
    * После выгрузки из 1С проставляем наличие/отсутсвие товаров у бренда
    * @return void
    * */

    function findBrandsActiveItems() {
        // выбираем все существующие бренды из инфоблока брендов
        $brands = array();
        $brands_result = CIBlockElement::GetList(
            Array(),
            Array(
                "IBLOCK_ID" => BRANDS_IBLOCK_ID
            ),
            false,
            false,
            Array("ID", "NAME", "PROPERTY_HAVE_PRODUCTS")
        );
        while ($brand = $brands_result->Fetch()) {
            $brands[$brand['NAME']] = array(
                "ID"            => $brand['ID'],
                "HAVE_PRODUCTS" => $brand['PROPERTY_HAVE_PRODUCTS_VALUE']
            );
        }

        // ищем товары для данных брендов с учетом их активности
        $items_result = CIBlockElement::GetList(
            Array(),
            array(
                "IBLOCK_ID"            => CATALOG_IBLOCK_ID,
                "ACTIVE"               => "Y",
                "PROPERTY_BREND_VALUE" => array_keys($brands)
            ),
            array("PROPERTY_BREND"),
            false,
            array("ID", "NAME", "PROPERTY_BREND")
        );
        $brands_with_items = array();
        while ($item = $items_result->Fetch()) {
            array_push($brands_with_items, $item['PROPERTY_BREND_VALUE']);
        }
        // перебираем все бренды, проверяем их на наличие в брендах с товарами и в зависимости от этого проставляем флаг наличия товаров
        foreach ($brands as $brand_title => $brand_data) {
            if (!in_array($brand_title, $brands_with_items) && $brand_data['HAVE_PRODUCTS'] != "Нет") {
                // set NO
                CIBlockElement::SetPropertyValuesEx($brand_data['ID'], false, array("HAVE_PRODUCTS" => PROPERTY_BREND_HAVE_ITEMS_NO));
            } else if (in_array($brand_title, $brands_with_items) && $brand_data['HAVE_PRODUCTS'] != "Да") {
                // set YES
                CIBlockElement::SetPropertyValuesEx($brand_data['ID'], false, array("HAVE_PRODUCTS" => PROPERTY_BREND_HAVE_ITEMS_YES));
            }
        }
    }


    /**
    * класс для создания дополнительных функциональных разделов:
    * -новинки,
    * -лидеры продаж,
    * -ожидаемые поступления,
    * -последние поступления.
    *
    * Разделы создаются динамически после каждой выгрузки товаров (если они не существуют),
    * после этого к ним привязываются товары на основании ранее оговоренных правил
    */
    //запускаем обработчик после обмена с 1С
    AddEventHandler("catalog", "OnSuccessCatalogImport1C", array("FunctionalSections", "SetServiceSections"));
    class FunctionalSections {

        /**
        * функция для привязки элемента к дополнительному разделу
        *
        * @param array $items - ID элемента инфоблока или массив ID
        * @param integer $section_id - ID раздела для привязки
        */
        function UpdateItemSections($items, $section_id) {



            if (empty($items) || empty($section_id)) {
                return false;
            }

            $section_id = intval($section_id);

            if (!is_array($items) && intval($items) > 0) {
                $items = intval($items);
            }

            $items_sections = array();
            //собираем разделы для всех элементов
            $items_groups = CIBlockElement::GetElementGroups($items, false, array("ID", "IBLOCK_ELEMENT_ID"));
            while($ar_items_groups = $items_groups->Fetch()) {
                //сохраняем ID разделов, к которым привязан элемент
                $items_sections[$ar_items_groups["IBLOCK_ELEMENT_ID"]][$ar_items_groups["ID"]] = $ar_items_groups["ID"];
            }

            //проверяем элементы на принадлежность к указанной группе

            if (!empty($items_sections)) {
                //переираем элементы и их разделы, добавляем в список ID созданного выше раздела и пересохраняем элемент
                foreach ($items_sections as $item_id => $sections) {
                    //если элемент еще не привязан к указанному разделу, то привязываем его
                    if (!in_array($section_id, $sections)) {
                        $item_sections_new = array_merge($sections, array($section_id));
                        if (!empty($item_sections_new)) {
                            CIBlockElement::SetElementSection($item_id, $item_sections_new, false);
                        }
                    }
                }
            }
        }


        //создание функциональных разделов в каталоге (новинки, свежие поступления, ожидаемые поступления, хиты продаж)
        function SetServiceSections() {
            $sections = $GLOBALS["functional_sections"];
            if (!empty($sections)) {
                foreach ($sections as $section_code => $section) {
                    $check_section = CIBLockSection::GetList(array(), array("CODE" => $section_code, false, array("ID")))->Fetch();
                    //если раздел не существует - создаем
                    if (empty($check_section["ID"])) {
                        $s = new CIBlockSection;
                        $arFields = Array(
                            "ACTIVE" => "Y",
                            "IBLOCK_SECTION_ID" => 0, //помещаем разделы в корень каталога
                            "IBLOCK_ID" => CATALOG_IBLOCK_ID,
                            "NAME" => $section["NAME"],
                            "CODE" => $section_code,
                            "XML_ID" => md5($section_code),
                            "SORT" => 10
                        );
                        //добавляем раздел
                        $ID = $s->Add($arFields);
                        if ($ID > 0) {
                            $check_section["ID"] = $ID;
                        }
                    }

                    $section_id = $check_section["ID"];

                    if (!empty($section_id)) {

                        $items_filter = array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ACTIVE" => "Y");

                        //добавляем в раздел товары
                        switch ($section_code) {

                            //бестселлеры
                            case "bestsellers":
                                $items = array();
                                $items_filter["!PROPERTY_TOPPRODAZH"] = false ;
                                $rs_items = CIBLockElement::GetList(array(), $items_filter, false, false, array("ID"));
                                while ($ar_item = $rs_items->Fetch()) {
                                    $items[$ar_item["ID"]] = $ar_item["ID"];
                                }
                                //привязываем элементы к разделу бестселлеры
                                if (!empty($items)) {
                                    FunctionalSections::UpdateItemSections($items, $section_id);
                                }
                                break;

                                //ожидаемые поступления
                            case "expected_products":
                                $items = array();
                                //собираем предложения, у которых есть реквизит "ожидаемая дата поступления"
                                $expected_items = CIBLockElement::GetList(array(), array("IBLOCK_ID" => OFFERS_IBLOCK_ID, "ACTIVE" => "Y", array("LOGIR" => "AND", array(">PROPERTY_CML2_TRAITS" => date("Y-m-d H:i:s")), array("!PROPERTY_CML2_TRAITS" => false))), false, false, array("ID", "PROPERTY_CML2_TRAITS", "PROPERTY_CML2_LINK"));
                                while($arItem = $expected_items->Fetch()) {
                                    //собираем основные товары для филтрации
                                    if (!empty($arItem["PROPERTY_CML2_LINK_VALUE"])) {
                                        $items[$arItem["PROPERTY_CML2_LINK_VALUE"]] = $arItem["PROPERTY_CML2_LINK_VALUE"];
                                    }
                                }
                                //привязываем элементы к разделу ожидаемые поступления
                                if (!empty($items)) {
                                    FunctionalSections::UpdateItemSections($items, $section_id);
                                }
                                break;

                                //новинки
                            case "new_products":
                                $items = array();
                                $curr_date = date('U');
                                $date_create_date = $curr_date - (86400 * NEW_PRODUCT_STATUS_LENGTH);
                                $items_filter[">=DATE_CREATE"] = ConvertTimeStamp($date_create_date,"FULL");
                                $rs_items = CIBLockElement::GetList(array(), $items_filter, false, false, array("ID"));
                                while ($ar_item = $rs_items->Fetch()) {
                                    $items[$ar_item["ID"]] = $ar_item["ID"];
                                }
                                //привязываем элементы к разделу новинки
                                if (!empty($items)) {
                                    FunctionalSections::UpdateItemSections($items, $section_id);
                                }
                                break;

                                //последние поступления
                            case "last_products":
                                $items = array();
                                $items_filter ['!PROPERTY_NOVOE_POSTUPLENIE_VALUE'] = false;
                                $rs_items = CIBLockElement::GetList(array(), $items_filter, false, false, array("ID"));
                                while ($ar_item = $rs_items->Fetch()) {
                                    $items[$ar_item["ID"]] = $ar_item["ID"];
                                }
                                //привязываем элементы к разделу последние поступления
                                if (!empty($items)) {
                                    FunctionalSections::UpdateItemSections($items, $section_id);
                                }
                                break;
                        }
                    }
                }
            } else {
                return false;
            }
        }

    }


    /**
    * обновление групп клиентов в соответствии с данными из highload-блокаов VidyTSen, Partnery, SoglasheniyaSKlientami
    */
    AddEventHandler("catalog", "OnSuccessCatalogImport1C", "setClientsGroups");
    function setClientsGroups() {

        $available_groups_id = array(12, 13, 14); //ID групп для разных типов цен

        $partners_hl_block = PARTNERS_HL_BLOCK_ID;
        $partners_groups_hl_block = PARTNERS_GROUPS_HL_BLOCK_ID;

        //делаем запрос в HL блок партнеров
        $partners = HL\HighloadBlockTable::getById($partners_hl_block)->Fetch();
        $partners_entity = HL\HighloadBlockTable::compileEntity($partners);
        $partners_query = new Entity\Query($partners_entity);

        $select = array("*");
        $partners_query->setSelect($select);
        //выбираем пользователей, у которых есть email
        $filter= array("!UF_NAME" => false, /*"!UF_ELEKTRONNAYAPOCHT" => false*/);
        $partners_query->setFilter($filter);

        $partners_result = $partners_query->exec();
        $partners_result = new CDBResult($partners_result);
        //парсим результат выборки клиентов
        $client_names = array();

        //все данные партнера
        $partners_data = array();

        while($arPartnersResult = $partners_result->Fetch()) {
            //собираем имена клиентов
            $client_names[] = $arPartnersResult["UF_NAME"];
            $partners_data[] = $arPartnersResult;
        }

        $client_names = array_unique($client_names);

        //делаем запрос в соответствующий HL блок
        $groups = HL\HighloadBlockTable::getById($partners_groups_hl_block)->Fetch();
        $groups_entity = HL\HighloadBlockTable::compileEntity($groups);
        $groups_query = new Entity\Query($groups_entity);

        $select = array("*");
        $groups_query->setSelect($select);
        //выбираем пользователей, у которых есть email
        $filter= array("UF_PARTNER" => $client_names);
        $groups_query->setFilter($filter);

        $groups_result = $groups_query->exec();
        $groups_result = new CDBResult($groups_result);
        //парсим результат выборки клиентов
        $partners_prices = array();
        while($arGroupsResult = $groups_result->Fetch()) {
            $partners_prices[$arGroupsResult["UF_PARTNER"]] = $arGroupsResult["UF_VIDTSEN"];
        }


        //перебираем массив пользователей
        foreach ($partners_data as $partner) {
            //если у пользователя есть email и код цены
            $user_email = $partner["UF_ELEKTRONNAYAPOCHT"];
            $user_name = $partner["UF_NAME"];

            if (!empty($user_email)) {
                //находим пользователя по email
                $ar_user = CUser::GetList($by = "ID", $sort = "ASC", array("EMAIL" => trim($user_email)))->Fetch();

                //если пользователь существует, берем его ID
                if (!empty($ar_user["ID"]) && intval($ar_user["ID"]) > 0) {
                    $user_id = intval($ar_user["ID"]);
                    //обновляем флаг активности
                    $user = new CUser;
                    $active = (!empty($partner["UF_AGAKTIVNOSTNASAYT"])) ? "Y" : "N";
                    $fields = Array(
                        "ACTIVE" => $active,
                    );
                    $user->Update($user_id, $fields);

                } else {
                    //иначе - создаем пользователя
                    if (!empty($user_email)) {

                        $active = (!empty($partner["UF_AGAKTIVNOSTNASAYT"])) ? "Y" : "N";

                        $user = new CUser;
                        $arFields = Array(
                            "NAME"              => $user_name,
                            "EMAIL"             => $user_email,
                            "LOGIN"             => $user_email,
                            "PASSWORD"          => $user_email,
                            "CONFIRM_PASSWORD"  => $user_email,
                            "ACTIVE" => $active
                        );
                        $ID = $user->Add($arFields);
                        if (intval($ID) > 0) {
                            //отправляем письмо о регистрации
                            CEvent::Send ("NEW_USER", "s1", array("EMAIL" => $user_email), "N", NEW_USER_AUTOMATIC_REG_MAIL_TEMPLATE);
                        }
                    }
                }

                //получаем код цены
                $price_code = $partners_prices[$user_name];

                //если удалось получить ID пользователя
                if ($user_id > 0 && !empty($price_code) && !empty($user_name)) {
                    //получаем группы пользователя
                    $user_groups = CUser::GetUserGroup(intval($ar_user["ID"]));

                    $new_group = CGroup::GetList( $by = "ID", $sort = "asc", array("STRING_ID" => trim($price_code)))->Fetch();

                    //если пользователь еще не принадлежит к группе, в которую его нужно добавить
                    if (!in_array($new_group["ID"], $user_groups) && intval($new_group["ID"]) > 0) {

                        //перебираем текущие группы пользователей, убираем текущую ценовую группу и добавляем новую, которая пришла из выгрузки
                        foreach ($user_groups as $i => $group_id) {
                            if (in_array($group_id, $available_groups_id)) {
                                unset($user_groups[$i]);
                            }
                        }

                        //добавляем ID новой группы в массив и обновляем пользователя
                        $new_groups_array = array_merge($user_groups, array(intval($new_group["ID"])));
                        $user = new CUser;
                        $fields = Array(
                            "GROUP_ID" => $new_groups_array,
                        );
                        $user->Update($user_id, $fields);
                    }
                }
            }
        }

    }


    /***
    *
    * обновление значения свойства "Вид товара" для конкретного товара (с символьным кодом VIDTOVARA)
    * после изменения данного товара
    *
    * var @int $prop_enum_xml_id - XML_ID варианта свойства, содержащего в символьном коде "TIP_TOVARA"
    * var @int $main_prop_variant_id - ID варианта свойства "VIDTOVARA", которое надо присвоить данному товару, исходя из значения $prop_enum_xml_id
    *
    */
    AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "updatingItemType");

    function updatingItemType(&$arFields) {
        if ($arFields["IBLOCK_ID"] == CATALOG_IBLOCK_ID) {
            // добавляем в массив фильтрации все свойства, отвечающие за тип товара (TIP_TOVARA и от TIP_TOVARA_1 до TIP_TOVARA_41)
            for ($i = 0; $i <= 41; $i++) {
                $arSelect = array("ID", "NAME");
                $prop_id = "PROPERTY_TIP_TOVARA";
                if ($i > 0) {
                    $prop_id .= "_".$i;
                }
                $arSelect[] = $prop_id;
                $el_info = CIBlockElement::GetList (array(), array("ID" => $arFields["ID"]), false, false, $arSelect);
                while ($el = $el_info -> Fetch()) {
                    // если значение свойства типа товара задано
                    if ($el[$prop_id . "_ENUM_ID"] > 0) {
                        $prop_name = "TIP_TOVARA";
                        if ($i > 0) {
                            $prop_name .= "_" . $i;
                        }
                        // получение XML_ID значения свойства исходя из значения свойства "Тип товара"
                        $prop_enum_info = CIBlockProperty::GetPropertyEnum($prop_name, array(), array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "VALUE" => $el[$prop_id . "_VALUE"]));
                        while ($prop_enum = $prop_enum_info -> Fetch()) {
                            $prop_enum_xml_id = $prop_enum["XML_ID"];
                        }
                        // получение ID значения свойства исходя из XML_ID значения свойства "Вид товара"
                        $main_prop_enum_info = CIBlockProperty::GetPropertyEnum("VIDTOVARA", array(), array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "EXTERNAL_ID" => $prop_enum_xml_id));
                        while ($main_prop_enum = $main_prop_enum_info -> Fetch()) {
                            $main_prop_variant_id = $main_prop_enum["ID"];
                        }
                        // обновление значения свойства "Вид товара"
                        CIBlockElement::SetPropertyValuesEx($el["ID"], false, array("VIDTOVARA" => $main_prop_variant_id));
                    }
                }
            }
        }
    }

    /***
    *
    * обновление набора значений свойства "Вид товара" (с символьным кодом VIDTOVARA)
    * после изменения одного из свойств, содержащих в символьном коде TIP_TOVARA
    *
    * var @int $props - массив с информацией о наборе значений изменяемого свойства
    * var @int $variants_list - массив с информацией о наборе значений свойства VIDTOVARA
    *
    */

    AddEventHandler("iblock", "OnAfterIBlockPropertyUpdate", "updatingItemsTypesAfterUpdatingProps");

    function updatingItemsTypesAfterUpdatingProps (&$arFields) {
        if ($arFields["IBLOCK_ID"] == CATALOG_IBLOCK_ID && strstr($arFields["CODE"], "TIP_TOVARA")) {
            $props = array();
            $prop = CIBlockProperty::GetPropertyEnum($arFields["CODE"], array("ID" => "ASC"), Array("IBLOCK_ID" => CATALOG_IBLOCK_ID));
            while ($arProp = $prop->Fetch()) {
                $props[$arProp["XML_ID"]]["ID"] = $arProp["ID"];
                $props[$arProp["XML_ID"]]["VALUE"] = $arProp["VALUE"];
                $props[$arProp["XML_ID"]]["DEF"] = $arProp["DEF"];
                $props[$arProp["XML_ID"]]["SORT"] = $arProp["SORT"];
                $props[$arProp["XML_ID"]]["XML_ID"] = $arProp["XML_ID"];
                $props[$arProp["XML_ID"]]["EXTERNAL_ID"] = $arProp["EXTERNAL_ID"];
            }
            $variants_list = CIBlockProperty::GetPropertyEnum("VIDTOVARA", array(), array("IBLOCK_ID" => CATALOG_IBLOCK_ID));
            while ($variants = $variants_list -> Fetch()) {
                $xml_IDs[] = $variants["XML_ID"];
            }
            // если XML_ID варианта изменяемого свойства не содержится в массиве из XML_ID вариантов свойства "Вид товара" -
            // добавляем новый вариант значения свойства "Вид товара"
            foreach ($props as $xml_id_key => $props_val) {
                if (!in_array($xml_id_key, $xml_IDs)) {
                    CIBlockPropertyEnum::Add(
                        array(
                            "PROPERTY_ID" => ITEM_TYPE_PROPERTY_ID,
                            "VALUE" => $props_val["VALUE"],
                            "DEF" => $props_val["DEF"],
                            "SORT" => $props_val["SORT"],
                            "XML_ID" => $props_val["XML_ID"],
                            "EXTERNAL_ID" => $props_val["EXTERNAL_ID"]
                        )
                    );

                }
            }
        }
    }

    /**
    * функция для получения списка ID сопутствущих товаров для текущего раздела
    *
    * var @int $section_id - ID раздела, для которого ищем сопутствующие товары
    */
    function getAdditionalProducts($section_id) {
        $section_id = intval($section_id);

        if (empty($section_id)) {
            return false;
        }

        $result = array();

        $section = CIBlockSection::GetList(array(), array("ID" => $section_id, "IBLOCK_ID" => CATALOG_IBLOCK_ID), false, array("UF_*"))->Fetch();
        //если у текущего раздела не заполнено поле "сопутствующие товары", проверяем его родителя
        if (empty($section["UF_ADD_PRODUCTS"]) && intval($section["IBLOCK_SECTION_ID"]) > 0) {
            $result = getAdditionalProducts($section["IBLOCK_SECTION_ID"]);
            //если у текущего раздела не заполнено поле "сопутствующие товары", и нет родительского раздела
        } else if (empty($section["UF_ADD_PRODUCTS"]) && empty($section["IBLOCK_SECTION_ID"])) {
            $result = false;
            //если данные есть, получаем элементы
        } else {
            $additional_sections = $section["UF_ADD_PRODUCTS"];
            //собираем ID товаров из полученных разделов
            $items = CIBlockElement::GetList(array("ID" => "ASC"), array("SECTION_ID" => $additional_sections, "ACTIVE" => "Y", "CATALOG_AVAILABLE" => "Y"), false, array(), array("ID"));
            if ($items->SelectedRowsCount() > 0) {
                while($ar_item = $items->Fetch()) {
                    $result[] = $ar_item["ID"];
                }
            } else {
                $result = false;
            }
        }

        return $result;
    }


    //проверяем заполненные свойства товара и привязываем их к разделу-родителю товара для отображения в умном фильтре
    AddEventHandler("iblock", "OnAfterIblockElementUpdate", "addItemPropsToFilter");
    function addItemPropsToFilter($arFields) {

        //обрабатываем только элементы каталога
        if ($arFields["IBLOCK_ID"] != CATALOG_IBLOCK_ID) {
            return false;
        }

        //получаем все свойств типа "список", чтобы добавлять в фильтр только свойства данного типа
        $list_props_id = array();
        $list_props = CIBlockProperty::GetList (Array(), Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "PROPERTY_TYPE" => "L"));
        while($ar_list_props = $list_props->Fetch()) {
            if (!strstr($ar_list_props["CODE"], "TIP_TOVARA")) {
                $list_props_id[] = $ar_list_props["ID"];    
            }
        }

        //проверяем у товара заполненные свойства
        if (is_array($arFields["PROPERTY_VALUES"]) && count($arFields["PROPERTY_VALUES"]) > 0) {
            foreach ($arFields["PROPERTY_VALUES"] as $prop_id => $prop) {
                foreach ($prop as $prop_value) {
                    //если у элемента заполнено свойство и оно типа "список", добавляем его ID к массиву
                    if ($prop_value["VALUE"] && in_array($prop_id, $list_props_id)) {
                        $prop_array[$prop_id] = $prop_id;
                    }
                }
            }
        }

        //если у товара есть заполненные свойства
        if (is_array($prop_array) && count($prop_array) > 0 ) {

            //получаем ID функциональных разделов, чтобы исключить их их обработки (новинки, бестселлеры и тд)
            $functional_sections_id = array();
            $rs_functional_sections = CIBlockSection::GetList(array(), array("CODE" => array_keys($GLOBALS["functional_sections"])), false, array("ID"));
            while($ar_section = $rs_functional_sections->Fetch()) {
                $functional_sections_id[] = $ar_section["ID"];
            }

            $item_sections = $arFields["IBLOCK_SECTION"];
            //удаляем из списка разделов товара функциональные разделы, чтобы не привязывать к ним никакие свойства
            foreach ($item_sections as $s_id => $item_section) {
                if (in_array($item_section, $functional_sections_id)) {
                    unset($item_sections[$s_id]);
                }
            }

            //получаем раздел для привязки свойств
            $result_section = false;
            foreach ($item_sections as $s_id) {
                //получаем раздел-родитель верхнего уровня для текущего элемента
                $section_path = CIBlockSection::GetNavChain(CATALOG_IBLOCK_ID, $s_id, array("ID"));
                while($ar_section_path = $section_path->Fetch()) {
                    if ($ar_section_path["ID"] && !$ar_section_path["IBLOCK_SECTION_ID"]) {
                        $result_section = $ar_section_path["ID"];
                        break;
                    }
                }
                if ($result_section > 0) {
                    break;
                }
            }

            //привязываем полученные свойства к родителю первого уровня текущего товара
            if ($result_section > 0) {
                foreach ($prop_array as $p_id) {
                    if ($p_id > 0) {
                        CIBlockSectionPropertyLink::Add($result_section, $p_id, array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "SMART_FILTER" => "Y", "DISPLAY_TYPE" => "F"));
                    }
                }
            }
        }
    }
    AddEventHandler("catalog", "OnSuccessCatalogImport1C", "Import1CBrands"); // выгружает бренды в отдельный инфоблок при выгрузке из 1С

    function Import1CBrands(){
        global $USER;
        $arrFilter = Array("IBLOCK_ID" => BRANDS_IBLOCK_ID); // инфоблока каталога товаров
        $brands_catalog = CIBlockElement::GetList(Array(), $arrFilter, false, Array(), Array());
        while($brands = $brands_catalog->GetNext()) {
            $name_brand = trim(preg_replace('~\s+~s', ' ', $brands["NAME"])); // удаляем лишние пробелы
            $ar_brands[$name_brand] = $brands["ID"];
        }
        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF" => "DESC", "SORT" => "ASC"), Array("IBLOCK_ID" => IBLOCK_ID_CATALOG, "CODE" => "BREND"));
        while ($enum_fields = $property_enums->GetNext()) {
            $name = trim(preg_replace('~\s+~s', ' ', $enum_fields["VALUE"]));   // удаляем лишние пробелы
            if (!$ar_brands[$name]) {
                $el = new CIBlockElement;

                $ar_load_product_array = Array(
                  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
                  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
                  "IBLOCK_ID"      => BRANDS_IBLOCK_ID,   // инфоблок брендов
                  "NAME"           => $enum_fields["VALUE"],
                  "ACTIVE"         => "Y",            // активен
                  );

                $PRODUCT_ID = $el->Add($ar_load_product_array); // добавляем бренд в раздел брендов
            }
        }

    }
    AddEventHandler("iblock", "OnAfterIBlockElementAdd", "OnWorkWithUsAdd");
    function OnWorkWithUsAdd(&$arFields) {
        if ($arFields["IBLOCK_ID"] == WORK_WITH_US_IBLOCK_ID) {      
            $arSelect = Array("ID", "NAME", "PROPERTY_FILE");
            $arFilter = Array("ID"=>$arFields["ID"]);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
            while($fileProp = $res->Fetch())
            {
                $fileID[] = $fileProp['PROPERTY_FILE_VALUE'];
            }
            $toSend = Array();                   
            $toSend["NAME"] = $arFields["NAME"]; 
            $toSend["EMAIL"] = $arFields["PROPERTY_VALUES"][EMAIL_INPUT_ID]; 
            $toSend["OFFICE"] = $arFields["PROPERTY_VALUES"][OFFICE_INPUT_ID];
            $toSend["PHONE"] = $arFields["PROPERTY_VALUES"][PHONE_INPUT_ID];
            $toSend["MESSAGE"] = $arFields["DETAIL_TEXT"];    
            CEvent::Send ("NEW_RESUME", "s1", $toSend, "N", RESUME_MAIL_TEMPLATE_ID, $fileID);
        }
    }
