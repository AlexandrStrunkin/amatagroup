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

    $arPageElementCount = array(12, 24, 36); //��������� �������� ���������� ��������� �� ��������

    //������ ��������� ���������� ������� � ��������
    $catalogAvailableSort = array("ID", "NAME", "PRICE");

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
        "CATALOG_AVAILABLE_PRODUCT" => array("Y", "N")  //�������� ������� ���������
    );


    define("DEFAULT_TEMPLATE_PATH", SITE_DIR."local/templates/.default/"); //path of ".default" site template
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

    define("USER_SAVED_ADDRESSES_STREET_PROPERTY", 433); // �����
    define("USER_SAVED_ADDRESSES_HOUSING_PROPERTY", 434); // ��������/������
    define("USER_SAVED_ADDRESSES_BUILDING_PROPERTY", 435); // ���
    define("USER_SAVED_ADDRESSES_APARTMENT_PROPERTY", 436); // ��������/����
    define("USER_SAVED_ADDRESSES_BX_LOCATION_ID_PROPERTY", 437); // ID �������������� �������

	define("ORGANIZATION_TYPE_OOO", 4); // ��� ����� ���
	define("ORGANIZATION_TYPE_IP", 5); // ��� ����� ��

    define("USER_QUESTIONS_EMAIL_PROPERTY", 468);
    define("USER_QUESTIONS_COMPANY_PROPERTY", 469);
    define("USER_QUESTIONS_QUESTION_PROPERTY", 470);

    define("USER_FAQ_QUESTIONS_EMAIL_PROPERTY", 473);
    define("USER_FAQ_QUESTIONS_COMPANY_PROPERTY", 474);

    define("ORDER_LOCATION_ID", 18); // ��������������
    define("ORDER_LOCATION", "ORDER_PROP_18"); // ��������������
    define("ORDER_STREET", "ORDER_PROP_20"); // �����
    define("ORDER_HOUSING", "ORDER_PROP_21"); // ��������/������
    define("ORDER_BUILDING", "ORDER_PROP_22"); // ���
    define("ORDER_APARTMENT", "ORDER_PROP_23"); // ��������/����
    define("DEFAULT_LOCATION_ID", 129); // ��������� �������������� - ������

    define("ELEMENT_CARD_THUMBNAIL_HEIGHT", 47);
    define("ELEMENT_CARD_THUMBNAIL_WIDTH", 45);
    define("ELEMENT_CARD_PREVIEW_HEIGHT", 83);
    define("ELEMENT_CARD_PREVIEW_WIDTH", 76);
    define("ELEMENT_CARD_MAIN_HEIGHT", 490);
    define("ELEMENT_CARD_MAIN_WIDTH", 510);

    // ��� �������� �� �������
    define("ELEMENT_SPECIAL_OFFER_HIT", 6257);
    define("ELEMENT_SPECIAL_OFFER_NEW", 6258);
    define("ELEMENT_SPECIAL_OFFER_BEST", 6259);
    define("ELEMENT_SPECIAL_OFFER_SALE", 6260);

    define("CARD_QUESTION_FORM_TEMPLATE_ID", 77);
    define("CARD_QUESTION_FORM_TEMPLATE_ID_EMAIL", 89);
    define("QUESTION_FORM_TEMPLATE_ID", 78);
    define("SEND_QUESTION_FORM_TEMPLATE_ID", 76);
    define("FORM_FROM_EMAIL", "info@amatagroup.ru");

    define("MANUFACTURER_FOOTER_FORM", "MANUFACTURER_FOOTER_FORM");
    define("CONTACTS_FEEDBACK_FORM", "CONTACTS_FEEDBACK_FORM");
    define("QUESTION_PRODUCT_CARD", "QUESTION_PRODUCT_CARD");
    define("FAQ_FORM", "FAQ_FORM");
    define("ABOUT_FORM", "ABOUT_FORM");

    /*��������� ��� ����������� ��������*/
    define("DEFAULT_PAGE_ELEMENT_COUNT", $GLOBALS["availableParams"]["PAGE_ELEMENT_COUNT"][0]); //���������� ��������� �� �������� ������� �������� �� ���������
    define("DEFAULT_ELEMENT_SORT_FIELD", $GLOBALS["availableParams"]["ELEMENT_SORT_FIELD"][0]); //���� ��� ������ ���������� ��������� � �������� �� ��������� - ������ �� ������� ��������
    define("DEFAULT_ELEMENT_SORT_ORDER", $GLOBALS["availableParams"]["ELEMENT_SORT_ORDER"][1]); //����������� ��� ������ ���������� ��������� � �������� �� ���������
    define("DEFAULT_ELEMENT_SORT_FIELD2", "HAS_PREVIEW_PICTURE"); //���� ��� ������ ���������� ��������� � �������� �� ���������
    define("DEFAULT_ELEMENT_SORT_ORDER2", $GLOBALS["availableParams"]["ELEMENT_SORT_ORDER2"][1]); //����������� ��� ������ ���������� ��������� � �������� �� ���������
    define("DEFAULT_CATALOG_AVAILABLE_PRODUCT", $GLOBALS["availableParams"]["CATALOG_AVAILABLE_PRODUCT"][1]); //���������� �� ������� ��������� � �������� �� ���������

    define("DEFAULT_CATALOG_SECTION_TEMPLATE", "blocks"); //������ ��� ����������� ��������� ������� �� ���������
    /*///*/

    /* ������ �������� */
    define("COURIER_DELIVERY", 2);

    define("NEW_PRODUCT_STATUS_LENGTH", 60); //���������� ����, ������ ����� ��������� ��������
    define("FRESH_PRODUCT_STATUS_LENGTH", 2); //���������� ����, ������ ����� ��������� ��������� ������������

    define("IBLOCK_ID_QUASTION_PRODUCT", 19); // �������� ������ ������ �� ������
    define("IBLOCK_ID_QUASTION", 18); // �������� �������� ������

    define("CATALOG_GROUP_ID_PRICE", 3); // ��� ���� ���� �������
    define("CATALOG_GROUP_ID_PRICE_BASE", 1); // ��� ���� ���� �������

    define("CATALOG_SECTION_LATEST", '/catalog/bestsellers/');
    define("IMAGE_SERTIFICATE_WIDTH", 600); // ��� ���� ���� �������
    define("IMAGE_SERTIFICATE_HEIGHT", 800); // ��� ���� ���� �������

    define("IMAGE_AVATAR_WIDTH", 40); // ������ �������� � �������
    define("IMAGE_AVATAR_HEIGHT", 40); // ������ �������� � �������




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

    function getFormTypes() {
        return array(
            MANUFACTURER_FOOTER_FORM => '������ ������������� �� ������',
            CONTACTS_FEEDBACK_FORM   => '�������� ����� �� ���������',
            QUESTION_PRODUCT_CARD    => '������ ������ �� �������� ������',
            FAQ_FORM                 => '����� "������-�����"',
            ABOUT_FORM               => '����� ������� �� ������� "� ��������"'
        );
    }

    /**
    *
    * ���������� ������������� ������������ ����� ��� ������ ������ Altasib
    * ������� �������������� ������ http://marketplace.1c-bitrix.ru/solutions/altasib.geobase/
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

    //������� ������ �� EMAIL ��� ����������� � ��������� ������������
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
    // ���������� ������������ ������ ����� ��������� ���������� ������������
    AddEventHandler("main", "OnBeforeUserUpdate", "OnBeforeUserRegisterHandler");
    function OnBeforeUserRegisterHandler(&$arFields)
    {
        $filter = Array("ID" => $arFields["ID"]);
        $rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); // �������� �������������
        while($arUser = $rsUsers->GetNext()) {
            $user_active = $arUser["ACTIVE"];
        };
        if ($arFields["ACTIVE"] == 'Y' && $user_active == "N") { // ��������� ����������� �� ��������� ������������
            $toSend = Array();
            $toSend["PASSWORD"] = $arFields["CONFIRM_PASSWORD"];
            $toSend["EMAIL"] = $arFields["EMAIL"];
            $toSend["USER_ID"] = $arFields["ID"];
            $toSend["USER_IP"] = $arFields["USER_IP"];
            $toSend["USER_HOST"] = $arFields["USER_HOST"];
            $toSend["LOGIN"] = $arFields["LOGIN"];
            $toSend["NAME"] = (trim ($arFields["NAME"]) == "")? $toSend["NAME"] = htmlspecialchars('�� �������'): $arFields["NAME"];
            $toSend["LAST_NAME"] = (trim ($arFields["LAST_NAME"]) == "")? $toSend["LAST_NAME"] = htmlspecialchars('�� �������'): $arFields["LAST_NAME"];
            CEvent::Send ("NEW_USER", "s1", $toSend, "N", 1);
        }
        return $arFields;
    }

    function SendMailOffThreeDay(){   // �������� ������ ��������� ����� 3 ���� �������� ����������� ������������
        CModule::IncludeModule('main');
        $filter = Array("ACTIVE" => "N");
        $rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); // �������� �������������
        while($arUser = $rsUsers->GetNext()) {
            $nextWeek = strtotime(date('d.m.Y H:i:s')) - strtotime($arUser["DATE_REGISTER"]);
            if($nextWeek > 259200) {  // ����� �������� ������ 3 ����
                $filter_user["USER_ID"] = $arUser["ID"];
                $filter_user["LOGIN"] = $arUser["LOGIN"];
                CEvent::Send ("NEW_USER", "s1", $filter_user, "N", 85);
            }
        };
        return 'SendMailOffThreeDay();';
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
            localredirect($_SERVER["REDIRECT_URL"]);
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
    * ������� ���������, �� ������ �� ����� $_GET ��������� ��� ����������� ��������. ���� ������ - ��������� � ������
    */
    AddEventHandler("main", "OnProlog", "checkRequestData");
    function checkRequestData() {
        $availableParams = $GLOBALS["availableParams"]; //��������� ��� ����������� ��������
        //���� � ������� $_GET ���� ��������� ��� ����������� ��������, �� ������������ ��
        $result = array();
        //��������� ������������ ����������
        foreach ($availableParams as $paramKey => $paramValue) {
            //���� � �������� ���� �������� ��� ������ �� ���������� � ��� ����� ���������� ��������
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
        // ������� ID ���������� ������ ����������
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
                    $location_string .= ($location["CITY_NAME_ORIG"] ? $location["CITY_NAME_ORIG"] : $location["REGION_NAME_ORIG"]) . ", "; // ����� ��� �������
                    $location_string .= $request_street ? "��. " . $request_street . ", " : ""; // �����
                    $location_string .= $request_housing ? "������ " . $request_housing . ", " : ""; // ������
                    $location_string .= $request_building ? "�. " . $request_building . ", " : ""; // ���
                    $location_string .= $request_apartment ? "��. " . $request_apartment . ", " : ""; // ��������
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
    * ���������, ��������� �� ��� ����� �������������.
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

    // ��� ��������/��������� ������ ��������� ������� ���������� ���
    AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "OnPriceUpdate");
    AddEventHandler("iblock", "OnAfterIBlockElementAdd", "OnPriceUpdate");
    function OnPriceUpdate(&$arFields) {
        if ($arFields["IBLOCK_ID"] == CATALOG_IBLOCK_ID && intval($arFields["ID"]) > 0) {
            setMinPrice($arFields["ID"]);
        }
    }

    /**
    * ������� ���������� ��� ����������� ������
    * � ������������� ��� ������ ����������� ���� ���� �����
    * ������ �� ��� �����������
    *
    * @param integer $product_id - ������������� ������
    * @param string $currency - ������
    */
    function setMinPrice($product_id, $currency = "RUB") {

        $product_id = intval($product_id);
        if (empty($product_id)) {
            return false;
        }
        //�������� ����������� ������
        $arOffers = CCatalogSKU::getOffersList(array($product_id), 0, array(), array(), array());

        //�������� ����������� �������� ������
        $offers = $arOffers[$product_id];
        if (!is_array($offers) || count($offers) <= 0) {
            return false;
        }

        $offers_list = array();
        //���������� �����������
        foreach ($offers as $fID => $offer) {
            $offers_list[] = $offer["ID"];
        }

        if (count($offers_list) <= 0) {
            return false;
        }

        //�������� ����������� ���� ����������� ��� ���� ��������� ����� ���
        $min_prices = array();
        $rsPrice = CPrice::GetList(array("PRODUCT_ID" => "ASC"), array("PRODUCT_ID" => $offers_list), false, false, array());
        while($arPrice = $rsPrice->Fetch()) {
            if (empty($min_prices[$arPrice["CATALOG_GROUP_ID"]]) || $arPrice["PRICE"] < $min_prices[$arPrice["CATALOG_GROUP_ID"]]) {
                $min_prices[$arPrice["CATALOG_GROUP_ID"]] = $arPrice["PRICE"];
            }
        }

        //��������� ���������� ���� ��� � ������
        if (count($min_prices) > 0) {
            foreach ($min_prices as $price_id => $price) {
                $res = CPrice::GetList( array(), array("PRODUCT_ID" => $product_id, "CATALOG_GROUP_ID" => $price_id));
                //��������� ������������� ������� ���� ���� � ������.
                $arFields = Array(
                    "PRODUCT_ID" => $product_id,
                    "CATALOG_GROUP_ID" => $price_id,
                    "CURRENCY" => $currency,
                );
                if ($arr = $res->Fetch()) {
                    //���� ���� - ���������
                    $arFields["PRICE"] = $price;
                    CPrice::Update($arr["ID"], $arFields);
                } else {
                    //���� ��� - ���������
                    $arFields["PRICE"] = $price;
                    CPrice::Add($arFields);
                }
            }
        }
    }


    //���������� ���������� � �������� ������ � ������ ���������� ��
    AddEventHandler("catalog", "OnProductAdd","UpdateProductQuantity");
    AddEventHandler("catalog", "OnProductUpdate","UpdateProductQuantity");

    function UpdateProductQuantity($id, $arFields) {
        $quantity = $arFields['QUANTITY'];

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

    // �������� ������ ������ � ������ ������
   AddEventHandler('sale', 'OnOrderNewSendEmail', "currencyTypeReplacement");

   function currencyTypeReplacement($ID, &$eventName, &$arFields) {

       $arFields["PRICE"] = preg_replace('~<span class="rub">c</span>~', '�', $arFields["PRICE"]);
       $arFields["ORDER_LIST"] = preg_replace('~<span class="rub">c</span>~', '�', $arFields["ORDER_LIST"]);

       return $arFields;
   }

    /**
     * ������� ���������� ��������� ��� �������������� ����� ����� �� ��������� ����� � ������� ���������
     * param  $number Integer ����� �� ������ �������� ����� ������������ ���������
     * param  $endingsArray  Array ������ ���� ��� ��������� ��� ����� (1, 4, 5),
     *         �������� array('������', '������', '�����')
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
?>