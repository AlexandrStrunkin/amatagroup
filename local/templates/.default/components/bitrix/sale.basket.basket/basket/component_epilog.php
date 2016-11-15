<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!--viewedElementBlock-->
                    <?$APPLICATION->IncludeComponent("bitrix:catalog.viewed.products", "section_viewed", Array(
                            "ACTION_VARIABLE" => "action",    // Название переменной, в которой передается действие
                            "ADDITIONAL_PICT_PROP_5" => "MORE_PHOTO",    // Дополнительная картинка
                            "ADDITIONAL_PICT_PROP_6" => "MORE_PHOTO",    // Дополнительная картинка
                            "ADD_PROPERTIES_TO_BASKET" => "Y",    // Добавлять в корзину свойства товаров и предложений
                            "BASKET_URL" => "/personal/basket.php",    // URL, ведущий на страницу с корзиной покупателя
                            "CACHE_GROUPS" => "Y",    // Учитывать права доступа
                            "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                            "CACHE_TYPE" => "A",    // Тип кеширования
                            "CART_PROPERTIES_5" => array(    // Свойства для добавления в корзину
                                0 => "",
                                1 => "",
                            ),
                            "CART_PROPERTIES_6" => array(    // Свойства для добавления в корзину
                                0 => "",
                                1 => "",
                            ),
                            "CONVERT_CURRENCY" => "N",    // Показывать цены в одной валюте
                            "DEPTH" => "",    // Максимальная отображаемая глубина разделов
                            "DETAIL_URL" => "",    // URL, ведущий на страницу с содержимым элемента раздела
                            "HIDE_NOT_AVAILABLE" => "N",    // Не отображать товары, которых нет на складах
                            "IBLOCK_ID" => "5",    // Инфоблок
                            "IBLOCK_TYPE" => "1c_catalog",    // Тип инфоблока
                            "LABEL_PROP_5" => "-",    // Свойство меток товара
                            "LINE_ELEMENT_COUNT" => "3",    // Количество элементов, выводимых в одной строке
                            "MESS_BTN_BUY" => "Купить",    // Текст кнопки "Купить"
                            "MESS_BTN_DETAIL" => "Подробнее",    // Текст кнопки "Подробнее"
                            "MESS_BTN_SUBSCRIBE" => "Подписаться",    // Текст кнопки "Уведомить о поступлении"
                            "OFFER_TREE_PROPS_6" => array(    // Свойства для отбора предложений
                                0 => "OBYEM",
                                1 => "SEMNAYA_PEREDNYAYA_STENKA",
                                2 => "MAKSIMALNYY_ROST",
                                3 => "SILIKONOVYE_NAKLADKI",
                                4 => "VYNIMAYUSHCHIESYA_REYKI",
                                5 => "SLIV",
                                6 => "TSVET",
                                7 => "RAZMER",
                                8 => "CML2_MANUFACTURER",
                                9 => "SHASSI",
                                10 => "LYULKA",
                                11 => "PROGULOCHNYY_BLOK",
                                12 => "AVTOKRESLO",
                                13 => "KOLICHESTVO_STVOROK",
                                14 => "KOLICHESTVO_VERTIKALNYKH_OTDELENIY",
                                15 => "STRANA_BRENDA",
                                16 => "STRANA_PROIZVODITEL",
                                17 => "SHTANGA_DLYA_PLECHIKOV",
                                18 => "VNUTRENNIE_POLKI",
                                19 => "OTKRYTYE_POLKI",
                                20 => "TIP_KROVATI",
                                21 => "VYDVIZHNYE_YASHCHIKI",
                                22 => "RAZMER_SPALNOGO_MESTA",
                                23 => "DOVODCHIKI_VYDVIZHNYKH_YASHCHIKOV",
                                24 => "MATERIAL",
                                25 => "MEKHANIZM_KACHANIYA",
                                26 => "VIDY_TRANSFORMATSII",
                                27 => "VOZRAST_MES",
                                28 => "KOLICHESTVO_UROVNEY_LOZHA",
                                29 => "OPUSKAYUSHCHAYASYA_PEREDNYAYA_STENKA",
                                30 => "KOLESA",
                                31 => "RAZMER_SPALNOGO_MESTA_DKHSH_SM",
                                32 => "YASHCHIKI_POD_KROVATYU",
                                33 => "DOVODCHIKI_YASHCHIKOV_POD_KROVATYU",
                                34 => "SOSTAV_KOMPLEKTA",
                                35 => "VSTROENNYY_KOMOD",
                                36 => "PODUSHKA",
                                37 => "GABARITY_VSTROENNOGO_KOMODA",
                                38 => "SOSTAV",
                                39 => "YASHIKI_V_KOMODE",
                                40 => "DOVODCHIKI_YASHCHIKOV_KOMODA",
                                41 => "OTKRYTYE_POLKI_V_KOMODE",
                                42 => "KOLICHESTVO_CHASTEY_BORTIKOV",
                                43 => "SEMNYY_CHEKHOL_U_ZASHCHITNYKH_BORTIKOV",
                                44 => "GARANTIYA_PROIZVODITELYA",
                                45 => "POL",
                                46 => "MATERIAL_1",
                                47 => "RAZMER_DLYA_KROVATKI_DKHSH_SM",
                                48 => "VOZRAST",
                                49 => "VYSOTA_MATRASA",
                                50 => "GARANTIYA_PROIZVODITELYA_1",
                                51 => "PRUZHINY_SISTEMA_BONNEL",
                                52 => "NEZAVISIMYE_PRUZHINY",
                                53 => "TIP_KOMODA",
                                54 => "KOLICHESTVO_PRUZHIN_NA_M2",
                                55 => "OTKIDNOY_PELENALNYY_STOLIK",
                                56 => "ZHESTKIE_KRAYA_MATRASA",
                                57 => "VANNOCHKA",
                                58 => "STORONY_ZIMA_LETO",
                                59 => "RAZNAYA_ZHESTKOST_STORON",
                                60 => "OTKRYTYE_POLKI_1",
                                61 => "SEMNYY_CHEKHOL",
                                62 => "MATERIAL_CHEKHLA",
                                63 => "NALICHIE_KOLESIKOV",
                                64 => "SISTEMA_VENTILYATSII",
                                65 => "ZASHCHITA_OT_PROMOKANIYA",
                                66 => "AROMATIZIROVANNYE_KAPSULY",
                                67 => "BREND",
                            ),
                            "PAGE_ELEMENT_COUNT" => "5",    // Количество элементов на странице
                            "PARTIAL_PRODUCT_PROPERTIES" => "N",    // Разрешить частично заполненные свойства
                            "PRICE_CODE" => array(    // Тип цены
                                0 => "Оптовая 1 Для сайта",
                            ),
                            "PRICE_VAT_INCLUDE" => "Y",    // Включать НДС в цену
                            "PRODUCT_ID_VARIABLE" => "id",    // Название переменной, в которой передается код товара для покупки
                            "PRODUCT_PROPS_VARIABLE" => "prop",    // Название переменной, в которой передаются характеристики товара
                            "PRODUCT_QUANTITY_VARIABLE" => "",    // Название переменной, в которой передается количество товара
                            "PRODUCT_SUBSCRIPTION" => "N",    // Разрешить оповещения для отсутствующих товаров
                            "PROPERTY_CODE_5" => array(    // Свойства для отображения
                                0 => "CML2_LINK",
                                1 => "ARTIKUL_KHARAKTERISTIKI",
                                9 => "TSVET",
                                13 => "CML2_ARTICLE",
                                14 => "CML2_BASE_UNIT",
                                15 => "MORE_PHOTO",
                                17 => "CML2_MANUFACTURER",
                                18 => "CML2_TRAITS",
                                19 => "CML2_TAXES",
                                20 => "FILES",
                                21 => "CML2_ATTRIBUTES",
                                23 => "CML2_BAR_CODE",
                                35 => "MODEL",
                                106 => "BREND",
                            ),
                            "PROPERTY_CODE_6" => array(    // Свойства для отображения
                                0 => "CML2_LINK",
                                1 => "ARTIKUL_KHARAKTERISTIKI",
                                9 => "TSVET",
                                13 => "CML2_ARTICLE",
                                14 => "CML2_BASE_UNIT",
                                15 => "MORE_PHOTO",
                                17 => "CML2_MANUFACTURER",
                                18 => "CML2_TRAITS",
                                19 => "CML2_TAXES",
                                20 => "FILES",
                                21 => "CML2_ATTRIBUTES",
                                23 => "CML2_BAR_CODE",
                                35 => "MODEL",
                                106 => "BREND",
                            ),
                            "SECTION_CODE" => "",    // Код раздела
                            "SECTION_ELEMENT_CODE" => "",    // Символьный код элемента, для которого будет выбран раздел
                            "SECTION_ELEMENT_ID" => "",    // ID элемента, для которого будет выбран раздел
                            "SECTION_ID" => "",    // ID раздела
                            "SHOW_DISCOUNT_PERCENT" => "Y",    // Показывать процент скидки
                            "SHOW_FROM_SECTION" => "N",    // Показывать товары из раздела
                            "SHOW_IMAGE" => "Y",    // Показывать изображение
                            "SHOW_NAME" => "Y",    // Показывать название
                            "SHOW_OLD_PRICE" => "Y",    // Показывать старую цену
                            "SHOW_PRICE_COUNT" => "1",    // Выводить цены для количества
                            "SHOW_PRODUCTS_5" => "Y",    // Показывать товары каталога
                            "TEMPLATE_THEME" => "blue",    // Цветовая тема
                            "USE_PRODUCT_QUANTITY" => "N",    // Разрешить указание количества товара
                            ),
                            false
                        );?>
                </div>
                <a href="" class="jcarousel-control-prev"></a>
                <a href="" class="jcarousel-control-next"></a>
<!--END viewedElementBlock-->