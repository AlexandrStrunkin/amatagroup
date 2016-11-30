<!--fixed top menu-->
<div class="top-menu-fixed js-fixed-header">
    <div class="top-menu-fixed-wrapper ">
        <div class="mainLogoContain top-menu-fixed-block">
            <a href="/"><img src="<?=DEFAULT_TEMPLATE_PATH?>img/headMainLogo.png" alt=""/></a>
        </div>

        <div class="top-menu-fixed-catalog top-menu-fixed-block">
            <div class="secondLvlBlocks top-menu-fixed-catalog-control" >
                <p class="catalog-fixed-title"><?=GetMessage("CATALOG")?></p>
            </div>
        </div>

        <div class="top-menu-fixed-block auth-block">

            <?
                global $USER;
                if(!$USER->IsAuthorized()){?>
                <p class="registrationLink"><a href="/auth/registration/"><?=GetMessage("REGISTRATION")?></a></p>
                <?} else {?>
                <p class="personalLink"><a href="/personal/"><?=GetMessage("PERSONAL")?></a></p>
                <?}?>

        </div>

        <div class="top-menu-fixed-block auth-block">

            <?if(!$USER->IsAuthorized()){?>
                <p class="authorisationLink"><a href=""><?=GetMessage("AUTH")?></a></p>
                <?} else {?>
                <p class="logoutLink"><a href="?logout=yes"><?=GetMessage("LOGOUT")?></a></p>
                <?}?>

        </div>

        <div class="top-menu-fixed-block">
            <div class="firstLvlBlocks linksBlock" id="fixed-linkBlock1">

            <form action="/catalog/">
                <?$APPLICATION->IncludeComponent(
	                "bitrix:search.title",
	                "search_field_top",
	                array(
		                "SHOW_INPUT" => "Y",
		                "INPUT_ID" => "title-search-input-fixed",
		                "CONTAINER_ID" => "title-search-top",
		                "PRICE_CODE" => array(
			                0 => "BASE",
			                1 => "RETAIL",
		                ),
		                "PRICE_VAT_INCLUDE" => "Y",
		                "PREVIEW_TRUNCATE_LEN" => "150",
		                "SHOW_PREVIEW" => "Y",
		                "PREVIEW_WIDTH" => "75",
		                "PREVIEW_HEIGHT" => "75",
		                "CONVERT_CURRENCY" => "Y",
		                "CURRENCY_ID" => "RUB",
		                "PAGE" => "/catalog/",
		                "NUM_CATEGORIES" => "1",
		                "TOP_COUNT" => "10",
		                "ORDER" => "date",
		                "USE_LANGUAGE_GUESS" => "N",
		                "CHECK_DATES" => "Y",
		                "SHOW_OTHERS" => "N",
		                "CATEGORY_0_TITLE" => "Каталог",
		                "CATEGORY_0" => array(
			                0 => "iblock_1c_catalog",
		                ),
		                "CATEGORY_0_iblock_news" => array(
			                0 => "all",
		                ),
		                "CATEGORY_1_TITLE" => "Форумы",
		                "CATEGORY_1" => array(
			                0 => "forum",
		                ),
		                "CATEGORY_1_forum" => array(
			                0 => "all",
		                ),
		                "CATEGORY_2_TITLE" => "Каталоги",
		                "CATEGORY_2" => array(
			                0 => "iblock_books",
		                ),
		                "CATEGORY_2_iblock_books" => "all",
		                "CATEGORY_OTHERS_TITLE" => "Прочее",
		                "COMPONENT_TEMPLATE" => "search_field_top",
		                "CATEGORY_0_iblock_1c_catalog" => array(
			                0 => "5",
			                1 => "6",
		                )
	                ),
	                false
                );?>
            </form>
            </div>

            <div class="firstLvlBlocks linksBlock" id="fixed-linkBlock2">
                <a href="/personal/favourite/">
                    <p class="quantityOfLiked">
                        <?= $USER->IsAuthorized() ? Favorite::countFavoriteProducts() : 0 ?>
                    </p>
                </a>
            </div>

            <div class="firstLvlBlocks linksBlock js-small-basket" id="fixed-linkBlock3">
                <?$APPLICATION->IncludeComponent(
                        "bitrix:sale.basket.basket.small",
                        "small_basket",
                        array(
                            "COMPONENT_TEMPLATE" => "small_basket",
                            "PATH_TO_BASKET" => "/personal/cart/",
                            "PATH_TO_ORDER" => "/personal/order/make/",
                            "SHOW_DELAY" => "Y",
                            "SHOW_NOTAVAIL" => "Y",
                            "SHOW_SUBSCRIBE" => "Y"
                        ),
                        false
                    );?>
            </div>
        </div>

    </div>
</div>

<!--fixed top menu-->


<!--header-->
<div id="page-preloader"><span class="spinner"></span></div>
<header>
    <? global $USER ?>
    <!--widthWrapper-->
    <div class="widthWrapper">
    <!--indexPageHeader-->
    <div class="indexPageHeader">
        <div class="locationWrapper">
            <? $detected_city = getAltasibCity() ?>
            <p><?=GetMessage("CITY")?> :</p>
            <a href="javascript:void(0)" class="sityName"><?= $detected_city ? $detected_city : "Москва" ?></a>
        </div>

        <?$APPLICATION->IncludeComponent("bitrix:menu", "top_menu", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "ROOT_MENU_TYPE" => "top",    // Тип меню для первого уровня
                "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                "MENU_CACHE_USE_GROUPS" => "N",    // Учитывать права доступа
                "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                "MAX_LEVEL" => "1",    // Уровень вложенности меню
                "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                "DELAY" => "N",    // Откладывать выполнение шаблона меню
                "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                ),
                false
            );?>

    </div>
    <!--END indexPageHeader-->
    <!--firstLevel-->
    <div class="firstLevel">
        <div class="firstLvlBlocks mainLogoContain">
            <a href="/"><img src="<?=DEFAULT_TEMPLATE_PATH?>img/headMainLogo.png" alt=""/></a>
        </div>
        <div class="firstLvlBlocks mailtelinfo">
            <p><?=GetMessage("WRITE_FOR_US")?></p>
            <p><?$APPLICATION->IncludeFile(DEFAULT_TEMPLATE_PATH."include/include_areas/email.php", Array(),Array("MODE"=>"html"));?></p>
        </div>
        <div class="firstLvlBlocks mailtelinfo">
            <p><?=GetMessage("PHONE_IN_MOSCOW")?></p>
            <a href="tel:<?include($_SERVER["DOCUMENT_ROOT"].DEFAULT_TEMPLATE_PATH."include/include_areas/phone.php")?>" class="telNumber"><?$APPLICATION->IncludeFile(DEFAULT_TEMPLATE_PATH."include/include_areas/phone.php", Array(),Array("MODE"=>"html"));?></a>
        </div>

        <div class="firstLvlBlocks linksBlock" id="linkBlock1">


            <?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"search_field", 
	array(
		"COMPONENT_TEMPLATE" => "search_field",
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "15",
		"ORDER" => "rank",
		"USE_LANGUAGE_GUESS" => "N",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => "/catalog/",
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "title-search",
		"CATEGORY_0_TITLE" => "Товары",
		"CATEGORY_0" => array(
			0 => "iblock_1c_catalog",
		),
		"CATEGORY_0_iblock_1c_catalog" => array(
			0 => "5",
			1 => "6",
		),
		"CATEGORY_OTHERS_TITLE" => ""
	),
	false
);?>
            </div>

        <div class="firstLvlBlocks linksBlock" id="linkBlock2">
            <a href="/personal/favourite/"><p><?=GetMessage("FAVOURITE")?></p></a>
            <p class="quantityOfLiked">
                <?= $USER->IsAuthorized() ? Favorite::countFavoriteProducts() : 0 ?>
            </p>
        </div>

        <div class="firstLvlBlocks linksBlock js-small-basket" id="linkBlock3">
            <?$APPLICATION->IncludeComponent(
                    "bitrix:sale.basket.basket.small",
                    "small_basket",
                    array(
                        "COMPONENT_TEMPLATE" => "small_basket",
                        "PATH_TO_BASKET" => "/personal/cart/",
                        "PATH_TO_ORDER" => "/personal/order/make/",
                        "SHOW_DELAY" => "Y",
                        "SHOW_NOTAVAIL" => "Y",
                        "SHOW_SUBSCRIBE" => "Y"
                    ),
                    false
                );?>
        </div>

    </div>
    <!--END firstLevel-->
    <!--secondLevel-->
    <div class="secondLevel">
        <div class="secondLvlBlocks <?if ($curPage == SITE_DIR."index.php"){?>activeBlock<?}?> menuControle" id="<?if ($curPage == SITE_DIR."index.php"){?>secondLvlBlocks1<?} else {?>secondLvlBlocks4<?}?>">
            <p><?=GetMessage("CATALOG")?></p>
        </div>

        <div class="secondLvlBlocks" id="secondLvlBlocks2">
            <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "top_additional",
                    array(
                        "COMPONENT_TEMPLATE" => "top_additional",
                        "ROOT_MENU_TYPE" => "top_additional",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "N",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "N",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N"
                    ),
                    false
                );?>
        </div>

        <div class="secondLvlBlocks" id="secondLvlBlocks3">

            <div class="regHiddenBlock">
                <p class="authClose"></p>
                <?$APPLICATION->IncludeComponent("bitrix:main.register", "popup_register", Array(
                        "AUTH" => "Y",    // Автоматически авторизовать пользователей
                        "REQUIRED_FIELDS" => array(    // Поля, обязательные для заполнения
                            0 => "NAME",
                        ),
                        "SET_TITLE" => "N",    // Устанавливать заголовок страницы
                        "SHOW_FIELDS" => array(    // Поля, которые показывать в форме
                            0 => "NAME",
                            1 => "PERSONAL_PHONE",
                        ),
                        "SUCCESS_PAGE" => "",    // Страница окончания регистрации
                        "USER_PROPERTY" => "",    // Показывать доп. свойства
                        "USER_PROPERTY_NAME" => "",    // Название блока пользовательских свойств
                        "USE_BACKURL" => "Y",    // Отправлять пользователя по обратной ссылке, если она есть
                        ),
                        false
                    );?>
            </div>

            <?if(!$USER->IsAuthorized()){?>
                <p class="registrationLink"><a href="/auth/registration/"><?=GetMessage("REGISTRATION")?></a></p>
                <?} else {?>
                <p class="personalLink"><a href="/personal/"><?=GetMessage("PERSONAL")?></a></p>
                <?}?>

            <?if(!$USER->IsAuthorized()){?>
                <p class="authorisationLink"><a href=""><?=GetMessage("AUTH")?></a></p>
                <?} else {?>
                <p class="logoutLink"><a href="?logout=yes"><?=GetMessage("LOGOUT")?></a></p>
                <?}?>

            <div class="authHiddenBlock">


                <p class="authClose"></p>
                <!--authForm-->
                <?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "popup_auth", Array(), false);?>
                <!--END authForm-->


                <!--forgotForm-->
                <div class="forgotForm">
                    <form method="post">
                        <p class="authTitle"><?=GetMessage('PASSWORD')?></p>
                        <input type="text" class="authInput" name="email" placeholder="<?=GetMessage('REESTABLISH')?>">

                        <div class="btn-container">
                            <a href="javascript:void(0)" class="authEnter"><?=GetMessage('MASSAGE')?></a>
                        </div>

                    </form>
                    <div class="message">
                        <?=GetMessage('ENTER_EMAIL')?>
                    </div>
                </div>
                <!--END forgotForm-->


            </div>
        </div>
    </div>
    <!--END secondLevel-->

    <!--thirdLevel-->
    <div class="thirdLevel">


        <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "catalog_menu",
                array(
                    "COMPONENT_TEMPLATE" => "catalog_menu",
                    "IBLOCK_TYPE" => "1c_catalog",
                    "IBLOCK_ID" => "5",
                    "SECTION_ID" => "",
                    "SECTION_CODE" => "",
                    "COUNT_ELEMENTS" => "N",
                    "TOP_DEPTH" => "3",
                    "SECTION_FIELDS" => array(
                        0 => "",
                        1 => "",
                    ),
                    "SECTION_USER_FIELDS" => array(
                        0 => "",
                        1 => "",
                    ),
                    "VIEW_MODE" => "LIST",
                    "SHOW_PARENT_NAME" => "Y",
                    "SECTION_URL" => "",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "86400",
                    "CACHE_GROUPS" => "N",
                    "ADD_SECTIONS_CHAIN" => "Y"
                ),
                false
            );?>

        <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"slider_main",
	array(
		"TEMPLATE_THEME" => "blue",
		"PRODUCT_DISPLAY_MODE" => "N",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"OFFER_ADD_PICT_PROP" => "FILE",
		"OFFER_TREE_PROPS" => array(
			0 => "-",
		),
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_CLOSE_POPUP" => "Y",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"AJAX_MODE" => "N",
		"SEF_MODE" => "N",
		"IBLOCK_TYPE" => "services",
		"IBLOCK_ID" => "29",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "name",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"ADD_SECTIONS_CHAIN" => "Y",
		"DISPLAY_COMPARE" => "N",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "",
		"SET_LAST_MODIFIED" => "Y",
		"USE_MAIN_ELEMENT_SECTION" => "Y",
		"SET_STATUS_404" => "Y",
		"PAGE_ELEMENT_COUNT" => "30",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "SPECIAL_OFFER",
			1 => "PRICE_BANNER",
			2 => "PICTURE_WIDTH",
		),
		"OFFERS_FIELD_CODE" => "",
		"OFFERS_PROPERTY_CODE" => "",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "active_from",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "5",
		"BACKGROUND_IMAGE" => "-",
		"PRICE_CODE" => array(
		),
		"USE_PRICE_COUNT" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_PROPERTIES" => array(
		),
		"USE_PRODUCT_QUANTITY" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "Y",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"HIDE_NOT_AVAILABLE" => "Y",
		"OFFERS_CART_PROPERTIES" => "",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"COMPONENT_TEMPLATE" => "slider_main",
		"MESS_BTN_COMPARE" => "Сравнить",
		"AJAX_OPTION_ADDITIONAL" => "",
		"FILE_404" => ""
	),
	false
);?>

        <div class="littleBannersWrap">
            <div id="advantagesBlock">
                <p class="litleBannerTitle">Преимущества</p>

                <p class="littleBannerText">Качества и достоинства выделяющие нас</p>

                <p class="advantagesLink"><a href="/privilege/">Посмотреть</a></p>
            </div>
            <div id="retailBlock">
                <p class="litleBannerTitle">Купить в розницу</p>

                <p class="littleBannerText">Богатый выбор товаров <br/> по привлекательным ценам</p>

                <p class="retailLink"><a href="/where-to-buy/">Точки продаж</a></p>
            </div>
            <div id="worhWithUsBlock">
                <p class="litleBannerTitle">Работа с нами</p>

                <p class="littleBannerText">Начать сотрудничество <br/> с нами очень просто</p>

                <p class="worhWithUsLink"><a href="/partnership/">С чего начать</a></p>
            </div>
        </div>
    </div>
    <!--END thirdLevel-->

    <!--END widthWrapper-->
</header>
<!--END header-->