<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!--viewedElementBlock-->
                    <?$APPLICATION->IncludeComponent("bitrix:catalog.viewed.products", "section_viewed", Array(
                            "ACTION_VARIABLE" => "action",    // �������� ����������, � ������� ���������� ��������
                            "ADDITIONAL_PICT_PROP_5" => "MORE_PHOTO",    // �������������� ��������
                            "ADDITIONAL_PICT_PROP_6" => "MORE_PHOTO",    // �������������� ��������
                            "ADD_PROPERTIES_TO_BASKET" => "Y",    // ��������� � ������� �������� ������� � �����������
                            "BASKET_URL" => "/personal/basket.php",    // URL, ������� �� �������� � �������� ����������
                            "CACHE_GROUPS" => "Y",    // ��������� ����� �������
                            "CACHE_TIME" => "36000000",    // ����� ����������� (���.)
                            "CACHE_TYPE" => "A",    // ��� �����������
                            "CART_PROPERTIES_5" => array(    // �������� ��� ���������� � �������
                                0 => "",
                                1 => "",
                            ),
                            "CART_PROPERTIES_6" => array(    // �������� ��� ���������� � �������
                                0 => "",
                                1 => "",
                            ),
                            "CONVERT_CURRENCY" => "N",    // ���������� ���� � ����� ������
                            "DEPTH" => "",    // ������������ ������������ ������� ��������
                            "DETAIL_URL" => "",    // URL, ������� �� �������� � ���������� �������� �������
                            "HIDE_NOT_AVAILABLE" => "N",    // �� ���������� ������, ������� ��� �� �������
                            "IBLOCK_ID" => "5",    // ��������
                            "IBLOCK_TYPE" => "1c_catalog",    // ��� ���������
                            "LABEL_PROP_5" => "-",    // �������� ����� ������
                            "LINE_ELEMENT_COUNT" => "3",    // ���������� ���������, ��������� � ����� ������
                            "MESS_BTN_BUY" => "������",    // ����� ������ "������"
                            "MESS_BTN_DETAIL" => "���������",    // ����� ������ "���������"
                            "MESS_BTN_SUBSCRIBE" => "�����������",    // ����� ������ "��������� � �����������"
                            "OFFER_TREE_PROPS_6" => array(    // �������� ��� ������ �����������
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
                            "PAGE_ELEMENT_COUNT" => "5",    // ���������� ��������� �� ��������
                            "PARTIAL_PRODUCT_PROPERTIES" => "N",    // ��������� �������� ����������� ��������
                            "PRICE_CODE" => array(    // ��� ����
                                0 => "������� 1 ��� �����",
                            ),
                            "PRICE_VAT_INCLUDE" => "Y",    // �������� ��� � ����
                            "PRODUCT_ID_VARIABLE" => "id",    // �������� ����������, � ������� ���������� ��� ������ ��� �������
                            "PRODUCT_PROPS_VARIABLE" => "prop",    // �������� ����������, � ������� ���������� �������������� ������
                            "PRODUCT_QUANTITY_VARIABLE" => "",    // �������� ����������, � ������� ���������� ���������� ������
                            "PRODUCT_SUBSCRIPTION" => "N",    // ��������� ���������� ��� ������������� �������
                            "PROPERTY_CODE_5" => array(    // �������� ��� �����������
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
                            "PROPERTY_CODE_6" => array(    // �������� ��� �����������
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
                            "SECTION_CODE" => "",    // ��� �������
                            "SECTION_ELEMENT_CODE" => "",    // ���������� ��� ��������, ��� �������� ����� ������ ������
                            "SECTION_ELEMENT_ID" => "",    // ID ��������, ��� �������� ����� ������ ������
                            "SECTION_ID" => "",    // ID �������
                            "SHOW_DISCOUNT_PERCENT" => "Y",    // ���������� ������� ������
                            "SHOW_FROM_SECTION" => "N",    // ���������� ������ �� �������
                            "SHOW_IMAGE" => "Y",    // ���������� �����������
                            "SHOW_NAME" => "Y",    // ���������� ��������
                            "SHOW_OLD_PRICE" => "Y",    // ���������� ������ ����
                            "SHOW_PRICE_COUNT" => "1",    // �������� ���� ��� ����������
                            "SHOW_PRODUCTS_5" => "Y",    // ���������� ������ ��������
                            "TEMPLATE_THEME" => "blue",    // �������� ����
                            "USE_PRODUCT_QUANTITY" => "N",    // ��������� �������� ���������� ������
                            ),
                            false
                        );?>
                </div>
                <a href="" class="jcarousel-control-prev"></a>
                <a href="" class="jcarousel-control-next"></a>
<!--END viewedElementBlock-->