<!--header-->
<header>
    <!--widthWrapper-->
    <div class="widthWrapper">
    <!--indexPageHeader-->
    <div class="indexPageHeader">
        <div class="locationWrapper">
            <p>Город :</p>
            <a href="" class="sityName">Санкт-Петербург</a>

            <div class="list">
                <a href="">Абаза</a>
                <a href="">Абакан</a>
                <a href="">Абдулино</a>                         
            </div>
        </div>

        <?$APPLICATION->IncludeComponent("bitrix:menu", "top_menu", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                "MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
                "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                "MAX_LEVEL" => "1",	// Уровень вложенности меню
                "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                "DELAY" => "N",	// Откладывать выполнение шаблона меню
                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
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
            <p>Телефон в Москве</p>
            <a href="tel:74955189603" class="telNumber">+7 495 518 96 03</a>
        </div>

        <div class="firstLvlBlocks linksBlock" id="linkBlock1">

            <?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"search_field", 
	array(
		"COMPONENT_TEMPLATE" => "search_field",
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "5",
		"ORDER" => "rank",
		"USE_LANGUAGE_GUESS" => "Y",
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
		)
	),
	false
);?>

        </div>    

        <div class="firstLvlBlocks linksBlock" id="linkBlock2">
            <a href=""><p>Избранное</p></a>  
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
            <?$APPLICATION->IncludeComponent("bitrix:menu", "top_additional", Array(
                    "COMPONENT_TEMPLATE" => "top_additional",
                    "ROOT_MENU_TYPE" => "top_additional",    // Тип меню для первого уровня
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

        <div class="secondLvlBlocks" id="secondLvlBlocks3">



            <?if(!$USER->IsAuthorized()){?>
                <p class="registrationLink"><a href=""><?=GetMessage("REGISTRATION")?></a></p>
                <?} else {?>
                <p class="personalLink"><a href="/personal/"><?=GetMessage("PERSONAL")?></a></p>
                <?}?>

            <div class="regHiddenBlock">
                <p class="authClose"></p>

                <form method="post">
                    <p class="authTitle">Регистрация</p>
                    <input type="text" class="authInput" name="name" placeholder="Имя">
                    <input type="text" class="authInput" name="surname" placeholder="Фамилия">
                    <input type="text" class="authInput" name="email" placeholder="Email">
                    <input type="password" class="authInputPass" name="pass" placeholder="Пароль">
                    <input type="password" class="authInputPass" name="confirmpass" placeholder="Повторите пароль">
                    <div class="btn-container">
                        <a href="" class="authEnter">Зарегистрироваться</a>
                    </div>
                </form>
                <div class="message">
                    Регистрация будет подтверждена после проверки. Для полноценного использования сайта - необходимо
                    дождаться подтверждения регистрации.
                </div>
            </div>

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
                        <p class="authTitle">Забыли пароль</p>
                        <input type="text" class="authInput" name="email" placeholder="Введите email">

                        <div class="btn-container">
                            <a href="" class="authEnter">Восстановить</a>
                        </div>

                    </form>
                    <div class="message">
                        На email придёт письмо по восстановлению пароля
                    </div>
                </div>
                <!--END forgotForm-->


            </div>
        </div>
    </div>
    <!--END secondLevel-->

    <!--thirdLevel-->
    <div class="thirdLevel">

        <div class="mainLeftMenu">    
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
                        "CACHE_TIME" => "36000000",
                        "CACHE_GROUPS" => "N",
                        "ADD_SECTIONS_CHAIN" => "Y"
                    ),
                    false
                );?>      
        </div>

        <div class="mainBigBanner">

            <!--jcarousel-wrapper-->
            <div class="jcarousel-wrapper">
                <!--jcarousel-->
                <div class="jcarousel">
                    <ul>
                        <li>
                            <div class="bannerImgContainer">
                                <p><img src="<?=DEFAULT_TEMPLATE_PATH?>files/bannerImg1.png" alt=""/></p>

                                <p class="hitContainer">хит</p>
                            </div>
                            <div class="bannerTextContainer">
                                <p class="bannerCost">35 800 Р</p>

                                <p class="bannerText">Детская кроватка Giovanni Magico поперечный маятник1</p>

                            </div>
                        </li>
                        <li>
                            <div class="bannerImgContainer">
                                <p><img src="<?=DEFAULT_TEMPLATE_PATH?>files/bannerImg1.png" alt=""/></p>

                                <p class="hitContainer">хит</p>
                            </div>
                            <div class="bannerTextContainer">
                                <p class="bannerCost">35 800 Р</p>

                                <p class="bannerText">Детская кроватка Giovanni Magico поперечный маятник2</p>

                            </div>
                        </li>
                        <li>
                            <div class="bannerImgContainer">
                                <p><img src="<?=DEFAULT_TEMPLATE_PATH?>files/bannerImg1.png" alt=""/></p>

                                <p class="hitContainer">хит</p>
                            </div>
                            <div class="bannerTextContainer">
                                <p class="bannerCost">35 800 Р</p>

                                <p class="bannerText">Детская кроватка Giovanni Magico поперечный маятник3</p>

                            </div>
                        </li>
                        <li>
                            <div class="bannerImgContainer">
                                <p><img src="<?=DEFAULT_TEMPLATE_PATH?>files/bannerImg1.png" alt=""/></p>

                                <p class="hitContainer">хит</p>
                            </div>
                            <div class="bannerTextContainer">
                                <p class="bannerCost">35 800 Р</p>

                                <p class="bannerText">Детская кроватка Giovanni Magico поперечный маятник4</p>

                            </div>
                        </li>
                        <li>
                            <div class="bannerImgContainer">
                                <p><img src="<?=DEFAULT_TEMPLATE_PATH?>files/bannerImg1.png" alt=""/></p>

                                <p class="hitContainer">хит</p>
                            </div>
                            <div class="bannerTextContainer">
                                <p class="bannerCost">35 800 Р</p>

                                <p class="bannerText">Детская кроватка Giovanni Magico поперечный маятник5</p>

                            </div>
                        </li>
                    </ul>
                </div>
                <div class="jcarousel-pagination"></div>


            </div>
            <!--END jcarousel-wrapper-->

        </div>
        <div class="littleBannersWrap">
            <div id="advantagesBlock">
                <p class="litleBannerTitle">Преимущества</p>

                <p class="littleBannerText">Качества и достоинства выделяющие нас</p>

                <p class="advantagesLink"><a href="">Посмотреть</a></p>
            </div>
            <div id="retailBlock">
                <p class="litleBannerTitle">Купить в розницу</p>

                <p class="littleBannerText">Богатый выбор товаров <br/> по привлекательным ценам</p>

                <p class="retailLink"><a href="">Точки продаж</a></p>
            </div>
            <div id="worhWithUsBlock">
                <p class="litleBannerTitle">Работа с нами</p>

                <p class="littleBannerText">Начать сотрудничество <br/> с нами очень просто</p>

                <p class="worhWithUsLink"><a href="">С чего начать</a></p>
            </div>
        </div>
    </div>
    <!--END thirdLevel-->

    <!--END widthWrapper-->
</header>
<!--END header-->