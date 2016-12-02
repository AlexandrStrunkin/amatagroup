<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $filterView = (COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID) == "eshop_adapt_vertical" ? "HORIZONTAL" : "VERTICAL");
?>
<?if($APPLICATION->GetCurPage() == '/catalog/' && empty($_GET['q'])) {
    // LocalRedirect(SITE_DIR);
}?>
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog", 
    "catalog", 
    array(
        "IBLOCK_TYPE" => "1c_catalog",
        "IBLOCK_ID" => "5",
        "TEMPLATE_THEME" => "site",
        "HIDE_NOT_AVAILABLE" => "L",
        "BASKET_URL" => "/personal/cart/",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "SEF_MODE" => "Y",
        "SEF_FOLDER" => "/catalog/",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "N",
        "SET_TITLE" => "Y",
        "ADD_SECTION_CHAIN" => "Y",
        "ADD_ELEMENT_CHAIN" => "Y",
        "SET_STATUS_404" => "Y",
        "DETAIL_DISPLAY_NAME" => "N",
        "USE_ELEMENT_COUNTER" => "Y",
        "USE_FILTER" => "Y",
        "FILTER_NAME" => "catalog_filter",
        "FILTER_VIEW_MODE" => "VERTICAL",
        "FILTER_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "FILTER_PROPERTY_CODE" => array(
            0 => "BREND",
            1 => "TSVET",
            2 => "CML2_MANUFACTURER",
            3 => "",
        ),
        "FILTER_PRICE_CODE" => array(
            0 => "��������������� ��� �����",
        ),
        "FILTER_OFFERS_FIELD_CODE" => array(
            0 => "XML_ID",
            1 => "",
        ),
        "FILTER_OFFERS_PROPERTY_CODE" => array(
            0 => "TSVET",
            1 => "CML2_MANUFACTURER",
            2 => "BREND",
            3 => "",
        ),
        "USE_REVIEW" => "N",
        "MESSAGES_PER_PAGE" => "10",
        "USE_CAPTCHA" => "Y",
        "REVIEW_AJAX_POST" => "Y",
        "PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
        "FORUM_ID" => "1",
        "URL_TEMPLATES_READ" => "",
        "SHOW_LINK_TO_FORUM" => "Y",
        "USE_COMPARE" => "N",
        "PRICE_CODE" => array(
            0 => "��������������� ��� �����",
        ),
        "USE_PRICE_COUNT" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "PRICE_VAT_SHOW_VALUE" => "N",
        "PRODUCT_PROPERTIES" => array(
            0 => "UD_TSVET",
        ),
        "USE_PRODUCT_QUANTITY" => "Y",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "QUANTITY_FLOAT" => "N",
        "OFFERS_CART_PROPERTIES" => array(
            0 => "ARTIKUL_KHARAKTERISTIKI",
            1 => "TSVET",
            2 => "CML2_ARTICLE",
            3 => "BREND",
        ),
        "SHOW_TOP_ELEMENTS" => "N",
        "SECTION_COUNT_ELEMENTS" => "N",
        "SECTION_TOP_DEPTH" => "1",
        "SECTIONS_VIEW_MODE" => "LIST",
        "SECTIONS_SHOW_PARENT_NAME" => "N",
        "PAGE_ELEMENT_COUNT" => "24",
        "LINE_ELEMENT_COUNT" => "3",
        "ELEMENT_SORT_FIELD" => "desc",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_FIELD2" => "shows",
        "ELEMENT_SORT_ORDER2" => "asc",
        "LIST_PROPERTY_CODE" => array(
            0 => "BREND",
            1 => "ARTIKUL_KHARAKTERISTIKI",
            2 => "VYNIMAYUSHCHIESYA_REYKI",
            3 => "OBYEM",
            4 => "KODPOSTAVSHCHIKAKHARAKTERISTIKI",
            5 => "KOLESA",
            6 => "MAKSIMALNYY_ROST",
            7 => "SLIV",
            8 => "TSVET",
            9 => "YASHCHIKI_POD_KROVATYU",
            10 => "DOVODCHIKI_YASHCHIKOV_POD_KROVATYU",
            11 => "KOMPLEKTATSIYA",
            12 => "RAZMER",
            13 => "BLOG_POST_ID",
            14 => "CML2_ARTICLE",
            15 => "CML2_BASE_UNIT",
            16 => "VSTROENNYY_KOMOD",
            17 => "BLOG_COMMENTS_CNT",
            18 => "MODEL",
            19 => "CML2_MANUFACTURER",
            20 => "CML2_TRAITS",
            21 => "CML2_TAXES",
            22 => "CML2_ATTRIBUTES",
            23 => "SHASSI",
            24 => "CML2_BAR_CODE",
            25 => "GABARITY_VSTROENNOGO_KOMODA",
            26 => "LYULKA",
            27 => "TIP_KROVATI",
            28 => "OBSHCHIY_OBEM_UPAKOVKI_M3",
            29 => "PROGULOCHNYY_BLOK",
            30 => "RAZMER_SPALNOGO_MESTA",
            31 => "AVTOKRESLO",
            32 => "KOLICHESTVO_STVOROK",
            33 => "MATERIAL",
            34 => "KOLICHESTVO_VERTIKALNYKH_OTDELENIY",
            35 => "MEKHANIZM_KACHANIYA",
            36 => "STRANA_BRENDA",
            37 => "VIDY_TRANSFORMATSII",
            38 => "STRANA_PROIZVODITEL",
            39 => "SHTANGA_DLYA_PLECHIKOV",
            40 => "VNUTRENNIE_POLKI",
            41 => "VOZRAST_MES",
            42 => "KOLICHESTVO_UROVNEY_LOZHA",
            43 => "OTKRYTYE_POLKI",
            44 => "VYDVIZHNYE_YASHCHIKI",
            45 => "OPUSKAYUSHCHAYASYA_PEREDNYAYA_STENKA",
            46 => "DOVODCHIKI_VYDVIZHNYKH_YASHCHIKOV",
            47 => "SEMNAYA_PEREDNYAYA_STENKA",
            48 => "VNESHNIE_GABARITY_DKHSHKHV_SM",
            49 => "SILIKONOVYE_NAKLADKI",
            50 => "VES_TOVARA_S_UPAKOVKOY_KG",
            51 => "YASHIKI_V_KOMODE",
            52 => "DOVODCHIKI_YASHCHIKOV_KOMODA",
            53 => "KOLICHESTVO_KOROBOK_V_UPAKOVKE",
            54 => "GABARITY_UPAKOVKI_DKHSHKHV_SM",
            55 => "OTKRYTYE_POLKI_V_KOMODE",
            56 => "VNESHNIE_GABARITY_DKHSHKHV",
            57 => "OBSHCHIY_OBEM_UPAKOVKI_M3_1",
            58 => "OBEM_UPAKOVKI_M_KUB",
            59 => "RAZMER_SPALNOGO_MESTA_DKHSH_SM",
            60 => "VES_UPAKOVKI_KG",
            61 => "KOLICHESTVO_PREDMETOV",
            62 => "GARANTIYA_PROIZVODITELYA",
            63 => "SOSTAV_KOMPLEKTA",
            64 => "MATERIAL_1",
            65 => "PODUSHKA",
            66 => "VOZRAST_MES_1",
            67 => "RAZMER_NAVOLOCHKI_DKHSH_SM",
            68 => "GARANTIYA_PROIZVODITELYA_1",
            69 => "SOSTAV",
            70 => "RAZMER_PODODEYALNIKA_DKHSH_SM",
            71 => "TIP_KOMODA",
            72 => "OTKIDNOY_PELENALNYY_STOLIK",
            73 => "RAZMER_PROSTYNKI_DKHSH_SM",
            74 => "KOLICHESTVO_CHASTEY_BORTIKOV",
            75 => "RAZMER_PELENALNOGO_STOLIKA_SHKHD_SM",
            76 => "VANNOCHKA",
            77 => "OBSHCHIY_RAZMER_ZASHCHITNYKH_BORTIKOV_DKHV_SM",
            78 => "KOLICHESTVO_YASHCHIKOV",
            79 => "SEMNYY_CHEKHOL_U_ZASHCHITNYKH_BORTIKOV",
            80 => "OTKRYTYE_POLKI_1",
            81 => "POL",
            82 => "KOLICHESTVO_POLOK",
            83 => "RAZMER_DLYA_KROVATKI_DKHSH_SM",
            84 => "VYSOTA_MATRASA",
            85 => "NALICHIE_KOLESIKOV",
            86 => "VNESHNIE_GABARITY_DKHSHKHV_SM_2",
            87 => "PRUZHINY_SISTEMA_BONNEL",
            88 => "VES_TOVARA_S_UPAKOVKOY_KG_2",
            89 => "NEZAVISIMYE_PRUZHINY",
            90 => "KOLICHESTVO_KOROBOK_V_UPAKOVKE_1",
            91 => "KOLICHESTVO_PRUZHIN_NA_M2",
            92 => "GABARITY_UPAKOVKI_DKHSHKHV_SM_2",
            93 => "ZHESTKIE_KRAYA_MATRASA",
            94 => "STORONY_ZIMA_LETO",
            95 => "RAZNAYA_ZHESTKOST_STORON",
            96 => "SEMNYY_CHEKHOL",
            97 => "MATERIAL_CHEKHLA",
            98 => "SISTEMA_VENTILYATSII",
            99 => "ZASHCHITA_OT_PROMOKANIYA",
            100 => "AROMATIZIROVANNYE_KAPSULY",
            101 => "VNESHNIE_GABARITY_DKHSHKHV_SM_1",
            102 => "VES_TOVARA_S_UPAKOVKOY_KG_1",
            103 => "GABARITY_UPAKOVKI_DKHSHKHV_SM_1",
            104 => "OBSHCHIY_OBEM_UPAKOVKI_M3_2",
            105 => "KOD_POSTAVSHCHIKA",
            106 => "NEWPRODUCT",
            107 => "SALELEADER",
            108 => "SPECIALOFFER",
            109 => "",
        ),
        "INCLUDE_SUBSECTIONS" => "Y",
        "LIST_META_KEYWORDS" => "-",
        "LIST_META_DESCRIPTION" => "-",
        "LIST_BROWSER_TITLE" => "-",
        "LIST_OFFERS_FIELD_CODE" => array(
            0 => "ID",
            1 => "CODE",
            2 => "XML_ID",
            3 => "NAME",
            4 => "SORT",
            5 => "PREVIEW_TEXT",
            6 => "PREVIEW_PICTURE",
            7 => "DETAIL_TEXT",
            8 => "DETAIL_PICTURE",
            9 => "DATE_ACTIVE_FROM",
            10 => "ACTIVE_FROM",
            11 => "DATE_ACTIVE_TO",
            12 => "ACTIVE_TO",
            13 => "IBLOCK_ID",
            14 => "DATE_CREATE",
            15 => "",
        ),
        "LIST_OFFERS_PROPERTY_CODE" => array(
            0 => "ARTIKUL_KHARAKTERISTIKI",
            1 => "OBYEM",
            2 => "SEMNAYA_PEREDNYAYA_STENKA",
            3 => "KODPOSTAVSHCHIKAKHARAKTERISTIKI",
            4 => "MAKSIMALNYY_ROST",
            5 => "SILIKONOVYE_NAKLADKI",
            6 => "VYNIMAYUSHCHIESYA_REYKI",
            7 => "SLIV",
            8 => "TSVET",
            9 => "VES_TOVARA_S_UPAKOVKOY_KG",
            10 => "KOMPLEKTATSIYA",
            11 => "RAZMER",
            12 => "CML2_ARTICLE",
            13 => "CML2_BASE_UNIT",
            14 => "MORE_PHOTO",
            15 => "KOLICHESTVO_KOROBOK_V_UPAKOVKE",
            16 => "CML2_MANUFACTURER",
            17 => "CML2_TRAITS",
            18 => "CML2_TAXES",
            19 => "FILES",
            20 => "CML2_ATTRIBUTES",
            21 => "SHASSI",
            22 => "CML2_BAR_CODE",
            23 => "GABARITY_UPAKOVKI_DKHSHKHV_SM",
            24 => "LYULKA",
            25 => "OBSHCHIY_OBEM_UPAKOVKI_M3",
            26 => "PROGULOCHNYY_BLOK",
            27 => "AVTOKRESLO",
            28 => "KOLICHESTVO_STVOROK",
            29 => "KOLICHESTVO_VERTIKALNYKH_OTDELENIY",
            30 => "STRANA_BRENDA",
            31 => "STRANA_PROIZVODITEL",
            32 => "SHTANGA_DLYA_PLECHIKOV",
            33 => "VNUTRENNIE_POLKI",
            34 => "MODEL",
            35 => "OTKRYTYE_POLKI",
            36 => "TIP_KROVATI",
            37 => "VYDVIZHNYE_YASHCHIKI",
            38 => "RAZMER_SPALNOGO_MESTA",
            39 => "DOVODCHIKI_VYDVIZHNYKH_YASHCHIKOV",
            40 => "MATERIAL",
            41 => "VNESHNIE_GABARITY_DKHSHKHV_SM",
            42 => "MEKHANIZM_KACHANIYA",
            43 => "VES_TOVARA_S_UPAKOVKOY_KG_1",
            44 => "VIDY_TRANSFORMATSII",
            45 => "VOZRAST_MES",
            46 => "KOLICHESTVO_KOROBOK_V_UPAKOVKE_1",
            47 => "GABARITY_UPAKOVKI_DKHSHKHV_SM_1",
            48 => "KOLICHESTVO_UROVNEY_LOZHA",
            49 => "OBSHCHIY_OBEM_UPAKOVKI_M3_1",
            50 => "OPUSKAYUSHCHAYASYA_PEREDNYAYA_STENKA",
            51 => "KOLESA",
            52 => "RAZMER_SPALNOGO_MESTA_DKHSH_SM",
            53 => "KOLICHESTVO_PREDMETOV",
            54 => "YASHCHIKI_POD_KROVATYU",
            55 => "DOVODCHIKI_YASHCHIKOV_POD_KROVATYU",
            56 => "SOSTAV_KOMPLEKTA",
            57 => "VSTROENNYY_KOMOD",
            58 => "PODUSHKA",
            59 => "GABARITY_VSTROENNOGO_KOMODA",
            60 => "RAZMER_NAVOLOCHKI_DKHSH_SM",
            61 => "SOSTAV",
            62 => "YASHIKI_V_KOMODE",
            63 => "DOVODCHIKI_YASHCHIKOV_KOMODA",
            64 => "RAZMER_PODODEYALNIKA_DKHSH_SM",
            65 => "OTKRYTYE_POLKI_V_KOMODE",
            66 => "RAZMER_PROSTYNKI_DKHSH_SM",
            67 => "VNESHNIE_GABARITY_DKHSHKHV",
            68 => "KOLICHESTVO_CHASTEY_BORTIKOV",
            69 => "OBSHCHIY_RAZMER_ZASHCHITNYKH_BORTIKOV_DKHV_SM",
            70 => "OBEM_UPAKOVKI_M_KUB",
            71 => "VES_UPAKOVKI_KG",
            72 => "SEMNYY_CHEKHOL_U_ZASHCHITNYKH_BORTIKOV",
            73 => "GARANTIYA_PROIZVODITELYA",
            74 => "POL",
            75 => "MATERIAL_1",
            76 => "RAZMER_DLYA_KROVATKI_DKHSH_SM",
            77 => "VOZRAST",
            78 => "VYSOTA_MATRASA",
            79 => "GARANTIYA_PROIZVODITELYA_1",
            80 => "PRUZHINY_SISTEMA_BONNEL",
            81 => "NEZAVISIMYE_PRUZHINY",
            82 => "TIP_KOMODA",
            83 => "KOLICHESTVO_PRUZHIN_NA_M2",
            84 => "OTKIDNOY_PELENALNYY_STOLIK",
            85 => "ZHESTKIE_KRAYA_MATRASA",
            86 => "RAZMER_PELENALNOGO_STOLIKA_SHKHD_SM",
            87 => "VANNOCHKA",
            88 => "STORONY_ZIMA_LETO",
            89 => "KOLICHESTVO_YASHCHIKOV",
            90 => "RAZNAYA_ZHESTKOST_STORON",
            91 => "OTKRYTYE_POLKI_1",
            92 => "SEMNYY_CHEKHOL",
            93 => "KOLICHESTVO_POLOK",
            94 => "MATERIAL_CHEKHLA",
            95 => "NALICHIE_KOLESIKOV",
            96 => "SISTEMA_VENTILYATSII",
            97 => "VNESHNIE_GABARITY_DKHSHKHV_SM_2",
            98 => "ZASHCHITA_OT_PROMOKANIYA",
            99 => "AROMATIZIROVANNYE_KAPSULY",
            100 => "VNESHNIE_GABARITY_DKHSHKHV_SM_1",
            101 => "VES_TOVARA_S_UPAKOVKOY_KG_2",
            102 => "GABARITY_UPAKOVKI_DKHSHKHV_SM_2",
            103 => "OBSHCHIY_OBEM_UPAKOVKI_M3_2",
            104 => "KOD_POSTAVSHCHIKA",
            105 => "BREND",
            106 => "ARTNUMBER",
            107 => "COLOR_REF",
            108 => "SIZES_SHOES",
            109 => "SIZES_CLOTHES",
            110 => "",
        ),
        "LIST_OFFERS_LIMIT" => "0",
        "DETAIL_PROPERTY_CODE" => array(
            0 => "BREND",
            1 => "ARTIKUL_KHARAKTERISTIKI",
            2 => "VYNIMAYUSHCHIESYA_REYKI",
            3 => "KOMPLEKTATSIYA_23",
            4 => "MATERIAL_KORPUSA",
            5 => "OBYEM",
            6 => "TIP_KOLES",
            7 => "TIP_KOLYASKI",
            8 => "TIP_SKLADYVANIYA",
            9 => "SEZON",
            10 => "KODPOSTAVSHCHIKAKHARAKTERISTIKI",
            11 => "KOLESA",
            12 => "KOLESA_SEMNYE",
            13 => "KOLESA_1",
            14 => "MAKSIMALNYY_ROST",
            15 => "MATERIAL_OBIVKI",
            16 => "POL_2",
            17 => "REGULIROVKA_PO_VYSOTE_1",
            18 => "TIP_3",
            19 => "NARUZHNYY_MATERIAL",
            20 => "YASHCHIKI",
            21 => "ANTIKOLIKOVAYA_SISTEMA",
            22 => "BLOKIROVKA_KOLES",
            23 => "DVUKHFAZNOE_STSEZHIVANIE",
            24 => "KOLICHESTVO_DETEY",
            25 => "KOLICHESTVO_POLOK_1",
            26 => "MUZYKA",
            27 => "SLIV",
            28 => "TIP_STULCHIKA",
            29 => "PODKLADKA",
            30 => "KOLICHESTVO_YASHCHIKOV_1",
            31 => "FIKSATSIYA_KOLES",
            32 => "TSVET",
            33 => "YASHCHIKI_POD_KROVATYU",
            34 => "BOKOVOY_LAZ",
            35 => "DOVODCHIKI_YASHCHIKOV_POD_KROVATYU",
            36 => "ZVUKOVAYA_SVETOVAYA_INDIKATSIYA",
            37 => "IGRUSHKI_1",
            38 => "KOLICHESTVO_POLOK_3",
            39 => "KOLICHESTVO_REZHIMOV",
            40 => "KOMPLEKTATSIYA",
            41 => "MAKSIMALNYY_VES_REBYENKA_KG",
            42 => "MERNAYA_SHKALA",
            43 => "RAZMER",
            44 => "REGULIROVKA_STSEZHIVANIYA",
            45 => "SISTEMA_AMORTIZATSII",
            46 => "UTEPLITEL",
            47 => "POLKI",
            48 => "SHEZLONG",
            49 => "BLOG_POST_ID",
            50 => "CML2_ARTICLE",
            51 => "CML2_BASE_UNIT",
            52 => "VSTROENNYY_KOMOD",
            53 => "DATA",
            54 => "ZHK_DISPELEY",
            55 => "KOLESA_4",
            56 => "BLOG_COMMENTS_CNT",
            57 => "KOMPLEKTATSIYA_5",
            58 => "MAKSIMALNYY_VES_REBENKA_KG",
            59 => "MODEL",
            60 => "NALICHIE_TORMOZOV",
            61 => "OBEM_ML_2",
            62 => "CML2_MANUFACTURER",
            63 => "PULT_DU",
            64 => "REGULIROVKA_NAKLONA_SPINKI",
            65 => "CML2_TRAITS",
            66 => "CML2_TAXES",
            67 => "SEMNYY_CHEKHOL_1",
            68 => "TERMOMETR",
            69 => "ZASTEZHKI",
            70 => "KOLICHESTVO_POLOK_2",
            71 => "CML2_ATTRIBUTES",
            72 => "BESTSELLERS",
            73 => "SHASSI",
            74 => "CML2_BAR_CODE",
            75 => "BISFENOL_A_4",
            76 => "GABARITY_VSTROENNOGO_KOMODA",
            77 => "KOLICHESTVO_POLOZHENIY_SPINKI_1",
            78 => "KOLICHESTVO_REZHIMOV_1",
            79 => "KOMPLEKTATSIYA_2",
            80 => "KOMPLEKTATSIYA_3",
            81 => "LYULKA",
            82 => "MERNAYA_SHKALA_4",
            83 => "PERESTANOVKA_BLOKA_LITSOM_SPINOY",
            84 => "RAZMER_KOLYASKI_DXSHKHV_SM",
            85 => "RODITELSKAYA_RUCHKA",
            86 => "TIP_KROVATI",
            87 => "TIP_POTOKA",
            88 => "UD_TSVET",
            89 => "KAPYUSHON_1",
            90 => "KOLESA_2",
            91 => "VES_KOLYASKI_KG",
            92 => "GORIZONTALNOE_POLOZHENIE_SPINKI",
            93 => "KAPYUSHON",
            94 => "OBSHCHIY_OBEM_UPAKOVKI_M3",
            95 => "OBEM_ML",
            96 => "OTSEK_DLYA_KHRANENIYA_AKSESSUAROV",
            97 => "PEREKIDNAYA_RUCHKA",
            98 => "POL_1",
            99 => "PROGULOCHNYY_BLOK",
            100 => "PULT_DU_1",
            101 => "RAZMER_SPALNOGO_MESTA",
            102 => "STIKERY_DLYA_DATY",
            103 => "VSTROENNAYA_VANNOCHKA",
            104 => "PROTIVOSKOLZYASHCHIE_VSTAVKI",
            105 => "FIKSATOR",
            106 => "AVTOKRESLO",
            107 => "ADAPTERY_DLYA_STSEZHIVANIYA_I_KORMLENIYA",
            108 => "BISFENOL_A",
            109 => "KLASS_BEZOPASNOSTI",
            110 => "KOLICHESTVO_STVOROK",
            111 => "KOMPLEKTATSIYA_1",
            112 => "KOMPLEKTATSIYA_4",
            113 => "MAKSIMALNYY_VES_REBENKA_KG_3",
            114 => "MATERIAL",
            115 => "MEKHANIZM_SKLADYVANIYA",
            116 => "REGULIROVKA_VYSOTY_RUCHKI",
            117 => "REGULIROVKA_PO_VYSOTE",
            118 => "SVETOOTRAZHAYUSHCHIE_ELEMENTY",
            119 => "MATRAS_V_KOMPLEKTE",
            120 => "BISFENOL_A_5",
            121 => "KOLICHESTVO_VERTIKALNYKH_OTDELENIY",
            122 => "KOLICHESTVO_KOLES",
            123 => "KOLICHESTVO_POLOZHENIY_STULA_PO_VYSOTE",
            124 => "MEKHANIZM_KACHANIYA",
            125 => "POL_REBENKA",
            126 => "STRANA_BRENDA",
            127 => "CHASTOTA",
            128 => "SHASSI_V_SLOZHENNOM_VIDE_SHXDXV_SM",
            129 => "VIDY_TRANSFORMATSII",
            130 => "ZHK_DISPLEY_3",
            131 => "PEREDNIE_KOLESA",
            132 => "PODSVETKA_NOCHNIK",
            133 => "RABOTA_OT",
            134 => "REMNI_BEZOPASNOSTI_2",
            135 => "STRANA_PROIZVODITEL",
            136 => "POL_REBENKA_1",
            137 => "SHASSI_V_RAZLOZHENNOM_VIDE_SHXDXV_SM",
            138 => "SHTANGA_DLYA_PLECHIKOV",
            139 => "VNUTRENNIE_POLKI",
            140 => "VOZRAST_MES",
            141 => "DIAMETR_PEREDNIKH_KOLES_SM",
            142 => "KORZINA",
            143 => "MOSHCHNOST",
            144 => "POL_REBENKA_2",
            145 => "RABOTA_OT_2",
            146 => "RABOTA_OT_1",
            147 => "REGULIROVKA_PODNOZHKI_PO_VYSOTE",
            148 => "VES_SHASSI_KG",
            149 => "VOZMOZHNOST_SNYAT_I_POSTIRAT_POKRYTIE",
            150 => "DLINA_SHNURA_M",
            151 => "KOLICHESTVO_UROVNEY_LOZHA",
            152 => "KOMPLEKTATSIYA_24",
            153 => "OTKRYTYE_POLKI",
            154 => "POL_3",
            155 => "RAZMERY_DETSKOGO_BLOKA",
            156 => "SHIRINA_SHASSI_PEREDNIKH_KOLES_SM",
            157 => "VYDVIZHNYE_YASHCHIKI",
            158 => "KOMPLEKTATSIYA_16",
            159 => "LYULKA_V_KOMPLEKTE",
            160 => "MYAGKIY_PODGOLOVNIK",
            161 => "OPUSKAYUSHCHAYASYA_PEREDNYAYA_STENKA",
            162 => "POL_REBENKA_8",
            163 => "RAZMERY_RODITELSKOGO_BLOKA",
            164 => "SYEMNYY_BAMPER",
            165 => "FIKSATSIYA_PEREDNIKH_KOLES",
            166 => "VRASHCHENIE",
            167 => "DOVODCHIKI_VYDVIZHNYKH_YASHCHIKOV",
            168 => "ZADNIE_KOLESA",
            169 => "KOMPLEKTATSIYA_21",
            170 => "MATERIAL_KAPYUSHONA",
            171 => "MUZYKALNAYA",
            172 => "RADIOUPRAVLENIE",
            173 => "SOSTAV_3",
            174 => "STOPOR_NA_KOLESAKH",
            175 => "SEMNAYA_PEREDNYAYA_STENKA",
            176 => "TIP",
            177 => "ANTIBAKTERIALNOE_SVOYSTVO",
            178 => "VNESHNIE_GABARITY_DKHSHKHV_SM",
            179 => "DIAMETR_ZADNIKH_KOLES_SM",
            180 => "DOPUSKAETSYA_MYTE_V_POSUDOMOECHNOY_MASHINE",
            181 => "MAKSIMALNYY_VES_REBENKA_KG_5",
            182 => "NAPOLNITEL",
            183 => "PITANIE_5",
            184 => "PITANIE_3",
            185 => "RAZMER_LYULKI_SHXD_SM",
            186 => "SILIKONOVYE_NAKLADKI",
            187 => "SEMNAYA_STOLESHNITSA",
            188 => "BISFENOL_A_1",
            189 => "VES_LYULKI_KG",
            190 => "VES_TOVARA_S_UPAKOVKOY_KG",
            191 => "KOMPLEKTATSIYA_26",
            192 => "KOMPLEKTATSIYA_25",
            193 => "KOMPLEKTATSIYA_17",
            194 => "REGULIROVKA_STOLESHNITSY",
            195 => "SHIRINA_SHASSI_ZADNIKH_KOLES_SM",
            196 => "YASHIKI_V_KOMODE",
            197 => "DOVODCHIKI_YASHCHIKOV_KOMODA",
            198 => "DOPOLNITELNAYA_STOLESHNITSA",
            199 => "KOLICHESTVO_KOROBOK_V_UPAKOVKE",
            200 => "KOMPLEKTATSIYA_10",
            201 => "KOMPLEKTATSIYA_18",
            202 => "OBEM_ML_3",
            203 => "PROGULOCHNYY_BLOK_V_KOMPLEKTE",
            204 => "REGULIROVKA_PO_VYSOTE_2",
            205 => "FIKSATSIYA_ZADNIKH_KOLES",
            206 => "ANTIKOLIKOVAYA_SISTEMA_1",
            207 => "VID",
            208 => "GABARITY_UPAKOVKI_DKHSHKHV_SM",
            209 => "MUZYKA_2",
            210 => "OTKRYTYE_POLKI_V_KOMODE",
            211 => "REGULIRUEMAYA_SPINKA",
            212 => "STOLESHNITSU_MOZHNO_MYT_V_POSUDOMOECHNOY_MASHINE",
            213 => "VNESHNIE_GABARITY_DKHSHKHV",
            214 => "IGRUSHKI_2",
            215 => "KOMPLEKTATSIYA_",
            216 => "MERNAYA_SHKALA_1",
            217 => "OBSHCHIY_OBEM_UPAKOVKI_M3_1",
            218 => "PERIOD_ISPOLZOVANIYA",
            219 => "REMNI_BEZOPASNOSTI",
            220 => "SETKA_DLYA_IGRUSHEK",
            221 => "BESSHOVNAYA_TEKHNOLOGIYA",
            222 => "ZASHCHITNAYA_PEREKLADINA",
            223 => "KOLESA_3",
            224 => "MUZYKA_1",
            225 => "OBEM_UPAKOVKI_M_KUB",
            226 => "RAZMER_SPALNOGO_MESTA_DKHSH_SM",
            227 => "SEMNYY_CHEKHOL_2",
            228 => "TERMOMETR_1",
            229 => "TIP_SKLADYVANIYA_1",
            230 => "ANTIBAKTERIALNAYA_ZASHCHITA",
            231 => "VES_UPAKOVKI_KG",
            232 => "ZASTEZHKA",
            233 => "KOLESA_5",
            234 => "KOLICHESTVO_POLOZHENIY_SPINKI",
            235 => "KOLICHESTVO_PREDMETOV",
            236 => "KOMPAKTNOE_SLOZHENIE",
            237 => "KOMPLEKTATSIYA_6",
            238 => "KRYSHKA",
            239 => "RODITELSKAYA_RUCHKA_1",
            240 => "TIP_POTOKA_1",
            241 => "GARANTIYA_PROIZVODITELYA",
            242 => "KOMPLEKTATSIYA_19",
            243 => "OBEM_ML_1",
            244 => "PROREZINENNYE_ZAKHVATY",
            245 => "REGULIROVKA_VYSOTY_PODNOZHKI",
            246 => "REZHIM_VIBRATSII",
            247 => "SIDENE",
            248 => "SOSTAV_KOMPLEKTA",
            249 => "FIKSATOR_1",
            250 => "FIKSATSIYA_KOLES_1",
            251 => "BISFENOL_A_2",
            252 => "BOKOVOY_LAZ_1",
            253 => "IGRUSHKI",
            254 => "MAKSIMALNYY_VES_REBENKA_KG_4",
            255 => "MATERIAL_1",
            256 => "MATERIAL_PROGULOCHNOGO_BLOKA",
            257 => "PODUSHKA",
            258 => "TIP_1",
            259 => "VOZRAST_MES_1",
            260 => "MAKSIMALNYY_VES_REBENKA_KG_6",
            261 => "MERNAYA_SHKALA_2",
            262 => "POL_REBENKA_3",
            263 => "RAZMER_NAVOLOCHKI_DKHSH_SM",
            264 => "RAZMER_PROGULOCHNOGO_BLOKA_SHXD_SM",
            265 => "SVETOVYE_ZVUKOVYE_SIGNALY",
            266 => "SYEMNYY_LOZHEMENT",
            267 => "VES_PROGULOCHNOGO_BLOKA_KG",
            268 => "GARANTIYA_PROIZVODITELYA_1",
            269 => "IZMERENIE_ROSTA",
            270 => "KOLICHESTVO_OTDELENIY",
            271 => "KOMPLEKTATSIYA_7",
            272 => "SOSTAV",
            273 => "USTROYSTVO_VIBRATSII",
            274 => "AVTOKRESLO_V_KOMPLEKTE",
            275 => "DOPUSKAETSYA_MYTE_V_POSUDOMOECHNOY_MASHINE_1",
            276 => "ZHK_DISPLEY_1",
            277 => "KOMPLEKTATSIYA_8",
            278 => "RAZMER_PODODEYALNIKA_DKHSH_SM",
            279 => "REGULIROVKA_NAKLONA_2",
            280 => "TIP_KOMODA",
            281 => "ZADNIE_KOLESA_1",
            282 => "ISPOLZOVANIE_V_SVCH",
            283 => "KOMPLEKTATSIYA_9",
            284 => "OBNULENIE_TARY",
            285 => "OTKIDNOY_PELENALNYY_STOLIK",
            286 => "POL_REBENKA_4",
            287 => "RAZMER_AVTOKRESLA_SHXD_SM",
            288 => "RAZMER_PROSTYNKI_DKHSH_SM",
            289 => "SEZON_1",
            290 => "CHISLO_POLOZHENIY_NAKLONA",
            291 => "VOZMOZHNOST_USTANOVKI_AVTOKRESLA",
            292 => "ISPOLZOVANIE_V_KHOLODILNOY_I_MOROZILNOY_KAMERAKH",
            293 => "KOLICHESTVO_CHASTEY_BORTIKOV",
            294 => "MATERIAL_KOLES",
            295 => "MUZYKALNYY",
            296 => "NARUZHNYY_MATERIAL_1",
            297 => "RAZMER_PELENALNOGO_STOLIKA_SHKHD_SM",
            298 => "REMNI_BEZOPASNOSTI_3",
            299 => "FUNKTSIYA_PAMYAT",
            300 => "BISFENOL_A_3",
            301 => "VANNOCHKA",
            302 => "IGROVAYA_DUGA",
            303 => "MAKSIMALNYY_VES_REBENKA_KG_2",
            304 => "OBSHCHIY_RAZMER_ZASHCHITNYKH_BORTIKOV_DKHV_SM",
            305 => "PODKLADKA_1",
            306 => "SIDENE_1",
            307 => "SOVMESTIMYE_MODELI_AVTOKRESEL",
            308 => "FIKSIROVANIE_VESA_KNOPKOY",
            309 => "AVTOOTKLYUCHENIE",
            310 => "BORTIK",
            311 => "VES_AVTOKRESLA_KG",
            312 => "VES_KG",
            313 => "KOLICHESTVO_YASHCHIKOV",
            314 => "KOMPLEKTATSIYA_11",
            315 => "PITANIE",
            316 => "SEMNYY_CHEKHOL_U_ZASHCHITNYKH_BORTIKOV",
            317 => "UTEPLITEL_1",
            318 => "ZASTEZHKI_1",
            319 => "KREPLENIE_AVTOKRESLA",
            320 => "MAKSIMALNO_DOPUSTIMYY_VES_KG",
            321 => "MUZYKALNYE",
            322 => "OTKRYTYE_POLKI_1",
            323 => "PITANIE_1",
            324 => "POL",
            325 => "RUCHKA_DLYA_RODITELEY",
            326 => "YASHCHIKI_1",
            327 => "GRADUIROVKA_IZMERENIYA",
            328 => "IGRUSHKI_3",
            329 => "KAPYUSHON_2",
            330 => "KOLICHESTVO_POLOK",
            331 => "KOLICHESTVO_YASHCHIKOV_2",
            332 => "KOMPLEKTATSIYA_12",
            333 => "RAZMER_DLYA_KROVATKI_DKHSH_SM",
            334 => "SPOSOB_USTANOVKI",
            335 => "UPRAVLENIE_RULEM",
            336 => "VYSOTA_MATRASA",
            337 => "KOLICHESTVO_REZHIMOV_2",
            338 => "NALICHIE_KOLESIKOV",
            339 => "PODSTAVKI_DLYA_NOG",
            340 => "POLKI_1",
            341 => "PROTIVOSKOLZYASHCHIE_VSTAVKI_1",
            342 => "REMNI_BEZOPASNOSTI_AVTOKRESLO",
            343 => "SHKALA_IZMERENIYA_ROSTA",
            344 => "VNESHNIE_GABARITY_DKHSHKHV_SM_2",
            345 => "ZASHCHITA_OT_BOKOVYKH_UDAROV",
            346 => "KOLICHESTVO_POLOK_4",
            347 => "MINIMALNYY_ROST_IZMERENIYA",
            348 => "PRUZHINY_SISTEMA_BONNEL",
            349 => "REGULIROVKA_SKOROSTI",
            350 => "REMNI_BEZOPASNOSTI_4",
            351 => "SVETOOTRAZHAYUSHCHIE_ELEMENTY_1",
            352 => "VES_TOVARA_S_UPAKOVKOY_KG_2",
            353 => "ZHK_DISPLEY",
            354 => "KOLESA_6",
            355 => "MAKSIMALNYY_ROST_IZMERENIYA",
            356 => "NEZAVISIMYE_PRUZHINY",
            357 => "PROREZI_DLYA_REMNEY_BEZOPASNOSTI",
            358 => "REGULIROVKA_NAKLONA",
            359 => "STRAKHOVOCHNYY_OBOD",
            360 => "VSTROENNAYA_VANNOCHKA_1",
            361 => "DALNOST_DEYSTVIYA",
            362 => "KOZYREK",
            363 => "KOLICHESTVO_KOROBOK_V_UPAKOVKE_1",
            364 => "KOLICHESTVO_PRUZHIN_NA_M2",
            365 => "PODGOLOVNIK",
            366 => "TAYMER",
            367 => "ANATOMICHESKIY_VKLADYSH",
            368 => "GABARITY_UPAKOVKI_DKHSHKHV_SM_2",
            369 => "ZHESTKIE_KRAYA_MATRASA",
            370 => "KOMPLEKTATSIYA_13",
            371 => "MATRAS_V_KOMPLEKTE_1",
            372 => "PEREDAVAEMAYA_CHASTOTA",
            373 => "REGULIROVKA_NAKLONA_SPINKI_1",
            374 => "TKANEVAYA_VSTAVKA_NA_SIDENE",
            375 => "ZASHCHITA_OT_SOLNTSA",
            376 => "KOLICHESTVO_KANALOV",
            377 => "MAKSIMALNYY_VES_REBENKA_KG_7",
            378 => "RYUKZAK_NA_RUCHKE",
            379 => "STORONY_ZIMA_LETO",
            380 => "ZADNYAYA_KORZINA",
            381 => "PITANIE_2",
            382 => "POL_REBENKA_5",
            383 => "RAZNAYA_ZHESTKOST_STORON",
            384 => "SVYAZ",
            385 => "SODERZHIT_BISFENOL_A",
            386 => "SYEMNYY_CHEKHOL",
            387 => "KLAKSON",
            388 => "KOMPLEKTATSIYA_15",
            389 => "KOMPLEKTATSIYA_14",
            390 => "MAKSIMALNYY_VES_REBENKA_KG_1",
            391 => "POL_REBENKA_6",
            392 => "PREDUPREZHDENIE_O_VYKHODE_IZ_ZONY_SVYAZI",
            393 => "SEMNYY_CHEKHOL",
            394 => "MAKSIMALNYY_VES_REBENKA",
            395 => "MATERIAL_CHEKHLA",
            396 => "OBYEM_ML",
            397 => "REGULIROVKA_CHUVSTVITELNOSTI",
            398 => "TIP_USTANOVKI",
            399 => "AKTIVATSIYA_ZVUKOM",
            400 => "KOMPLEKTATSIYA_20",
            401 => "KREPLENIE",
            402 => "SISTEMA_VENTILYATSII",
            403 => "SOSTAV_1",
            404 => "AVTOOTKLYUCHENIE_1",
            405 => "AKTIVATSIYA_DVIZHENIEM",
            406 => "ZASHCHITA_OT_PROMOKANIYA",
            407 => "ISPOLZOVANIE_VO_VREMYA_BEREMENNOSTI",
            408 => "SPOSOB_USTANOVKI_1",
            409 => "AROMATIZIROVANNYE_KAPSULY",
            410 => "DLYA_TIPA_KOZHI",
            411 => "EMKOST",
            412 => "NOCHNOY_REZHIM",
            413 => "REMNI_BEZOPASNOSTI_1",
            414 => "VNESHNIE_GABARITY_DKHSHKHV_SM_1",
            415 => "ZASHCHITA_OT_BOKOVYKH_UDAROV_1",
            416 => "MERNAYA_SHKALA_3",
            417 => "OBYEM_ML_1",
            418 => "TEMPERATURNYY_DATCHIK",
            419 => "VES_TOVARA_S_UPAKOVKOY_KG_1",
            420 => "ZHK_DISPLEY_2",
            421 => "REGULIROVKA_NAKLONA_1",
            422 => "SOSTAV_2",
            423 => "GABARITY_UPAKOVKI_DKHSHKHV_SM_1",
            424 => "INDIKATSIYA_ZARYADA",
            425 => "KOMPLEKTATSIYA_22",
            426 => "PODGOLOVNIK_1",
            427 => "ANATOMICHESKIY_VKLADYSH_1",
            428 => "VID_IGRUSHKI",
            429 => "ZAZHIM_DLYA_KREPLENIYA_NA_ODEZHDE",
            430 => "KOLICHESTVO_KOLES_1",
            431 => "OBSHCHIY_OBEM_UPAKOVKI_M3_2",
            432 => "ZASHCHITA_OT_SOLNTSA_1",
            433 => "KOD_POSTAVSHCHIKA",
            434 => "POL_REBENKA_7",
            435 => "TIP_2",
            436 => "FOTO_VIDEOZAPIS",
            437 => "ZUM",
            438 => "PEREDNEE_KOLESO",
            439 => "PITANIE_4",
            440 => "SYEMNYY_CHEKHOL_1",
            441 => "NEWPRODUCT",
            442 => "MANUFACTURER",
            443 => "",
        ),
        "DETAIL_META_KEYWORDS" => "-",
        "DETAIL_META_DESCRIPTION" => "-",
        "DETAIL_BROWSER_TITLE" => "-",
        "DETAIL_OFFERS_FIELD_CODE" => array(
            0 => "ID",
            1 => "NAME",
            2 => "",
        ),
        "DETAIL_OFFERS_PROPERTY_CODE" => array(
            0 => "CML2_TRAITS",
            1 => "ARTNUMBER",
            2 => "COLOR_REF",
            3 => "SIZES_SHOES",
            4 => "SIZES_CLOTHES",
            5 => "",
        ),
        "LINK_IBLOCK_TYPE" => "",
        "LINK_IBLOCK_ID" => "",
        "LINK_PROPERTY_SID" => "",
        "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
        "USE_ALSO_BUY" => "Y",
        "ALSO_BUY_ELEMENT_COUNT" => "4",
        "ALSO_BUY_MIN_BUYES" => "1",
        "OFFERS_SORT_FIELD" => "shows",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_FIELD2" => "shows",
        "OFFERS_SORT_ORDER2" => "asc",
        "PAGER_TEMPLATE" => "catalog_pager",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "������",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
        "PAGER_SHOW_ALL" => "N",
        "ADD_PICT_PROP" => "-",
        "LABEL_PROP" => "-",
        "PRODUCT_DISPLAY_MODE" => "Y",
        "OFFER_ADD_PICT_PROP" => "-",
        "OFFER_TREE_PROPS" => array(
            0 => "TSVET",
            1 => "RAZMER",
            2 => "MATERIAL_1",
        ),
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "SHOW_OLD_PRICE" => "N",
        "MESS_BTN_BUY" => "������",
        "MESS_BTN_ADD_TO_BASKET" => "� �������",
        "MESS_BTN_COMPARE" => "���������",
        "MESS_BTN_DETAIL" => "���������",
        "MESS_NOT_AVAILABLE" => "��� � �������",
        "DETAIL_USE_VOTE_RATING" => "N",
        "DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
        "DETAIL_USE_COMMENTS" => "N",
        "DETAIL_BLOG_USE" => "Y",
        "DETAIL_VK_USE" => "N",
        "DETAIL_FB_USE" => "Y",
        "AJAX_OPTION_ADDITIONAL" => "",
        "USE_STORE" => "N",
        "USE_STORE_PHONE" => "Y",
        "USE_STORE_SCHEDULE" => "Y",
        "USE_MIN_AMOUNT" => "N",
        "STORE_PATH" => "/store/#store_id#",
        "MAIN_TITLE" => "������� �� �������",
        "MIN_AMOUNT" => "10",
        "DETAIL_BRAND_USE" => "Y",
        "DETAIL_BRAND_PROP_CODE" => array(
            0 => "",
            1 => "-",
            2 => "BRAND_REF",
            3 => "",
        ),
        "SIDEBAR_SECTION_SHOW" => "Y",
        "SIDEBAR_DETAIL_SHOW" => "N",
        "SIDEBAR_PATH" => "/catalog/sidebar.php",
        "COMPONENT_TEMPLATE" => "catalog",
        "COMMON_SHOW_CLOSE_POPUP" => "Y",
        "DETAIL_SHOW_MAX_QUANTITY" => "Y",
        "DETAIL_BLOG_URL" => "catalog_comments",
        "DETAIL_BLOG_EMAIL_NOTIFY" => "N",
        "DETAIL_FB_APP_ID" => "",
        "USE_MAIN_ELEMENT_SECTION" => "N",
        "SET_LAST_MODIFIED" => "N",
        "ADD_SECTIONS_CHAIN" => "Y",
        "USE_SALE_BESTSELLERS" => "N",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PARTIAL_PRODUCT_PROPERTIES" => "Y",
        "USE_COMMON_SETTINGS_BASKET_POPUP" => "Y",
        "COMMON_ADD_TO_BASKET_ACTION" => "BUY",
        "TOP_ADD_TO_BASKET_ACTION" => "BUY",
        "SECTION_ADD_TO_BASKET_ACTION" => "BUY",
        "DETAIL_ADD_TO_BASKET_ACTION" => array(
        ),
        "DETAIL_SHOW_BASIS_PRICE" => "Y",
        "SECTIONS_HIDE_SECTION_NAME" => "N",
        "DETAIL_SET_CANONICAL_URL" => "N",
        "DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
        "SHOW_DEACTIVATED" => "N",
        "DETAIL_DETAIL_PICTURE_MODE" => "IMG",
        "DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",
        "DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "H",
        "STORES" => "",
        "USER_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "SHOW_EMPTY_STORE" => "Y",
        "SHOW_GENERAL_STORE_INFORMATION" => "N",
        "USE_BIG_DATA" => "N",
        "BIG_DATA_RCM_TYPE" => "bestsell",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "SECTION_BACKGROUND_IMAGE" => "-",
        "DETAIL_BACKGROUND_IMAGE" => "-",
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
        "DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
        "CACHE_NOTES" => "",
        "USE_GIFTS_DETAIL" => "Y",
        "USE_GIFTS_SECTION" => "Y",
        "USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
        "GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
        "GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
        "GIFTS_DETAIL_BLOCK_TITLE" => "�������� ���� �� ��������",
        "GIFTS_DETAIL_TEXT_LABEL_GIFT" => "�������",
        "GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "3",
        "GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
        "GIFTS_SECTION_LIST_BLOCK_TITLE" => "������� � ������� ����� �������",
        "GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "�������",
        "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
        "GIFTS_SHOW_OLD_PRICE" => "Y",
        "GIFTS_SHOW_NAME" => "Y",
        "GIFTS_SHOW_IMAGE" => "Y",
        "GIFTS_MESS_BTN_BUY" => "�������",
        "GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",
        "GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
        "GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "�������� ���� �� �������, ����� �������� �������",
        "SEF_URL_TEMPLATES" => array(
            "sections" => "",
            "section" => "#SECTION_CODE_PATH#/",
            "element" => "#ELEMENT_CODE#/",
            "compare" => "compare/",
            "smart_filter" => "#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/",
        )
    ),
    false
    );?>         
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>