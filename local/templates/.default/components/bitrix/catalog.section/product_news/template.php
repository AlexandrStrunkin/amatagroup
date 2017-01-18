<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    /** @var array $arParams */
    /** @var array $arResult */
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global CDatabase $DB */
    /** @var CBitrixComponentTemplate $this */
    /** @var string $templateName */
    /** @var string $templateFile */
    /** @var string $templateFolder */
    /** @var string $componentPath */
    /** @var CBitrixComponent $component */
    $this->setFrameMode(true);
?>

<!--elmentsList-->
<?if(count($arResult['ITEMS']) > 0){?>

<ul class="productList" id="productList1">
<p class="blockTitle">
    <?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/news_page.php"
    )
);?>
</p>
    <?
        if (!empty($arResult['ITEMS'])) {
            $templateLibrary = array('popup');
            $currencyList = '';
            if (!empty($arResult['CURRENCIES'])) {
                $templateLibrary[] = 'currency';
                $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
            }
            $templateData = array(
                'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
                'TEMPLATE_LIBRARY' => $templateLibrary,
                'CURRENCIES' => $currencyList
            );
            unset($currencyList, $templateLibrary);

            $arSkuTemplate = array();
            if (!empty($arResult['SKU_PROPS'])) {
                foreach ($arResult['SKU_PROPS'] as &$arProp) {
                    $templateRow = '';
                    if ('TEXT' == $arProp['SHOW_MODE']) {
                        if (5 < $arProp['VALUES_COUNT']) {
                            $strClass = 'bx_item_detail_size full';
                            $strWidth = ($arProp['VALUES_COUNT']*20).'%';
                            $strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
                            $strSlideStyle = '';
                        } else {
                            $strClass = 'bx_item_detail_size';
                            $strWidth = '100%';
                            $strOneWidth = '20%';
                            $strSlideStyle = 'display: none;';
                        }
                        $templateRow .= '<div class="'.$strClass.'" id="#ITEM#_prop_'.$arProp['ID'].'_cont">'.
                        '<span class="bx_item_section_name_gray">'.htmlspecialcharsex($arProp['NAME']).'</span>'.
                        '<div class="bx_size_scroller_container"><div class="bx_size"><ul id="#ITEM#_prop_'.$arProp['ID'].'_list" style="width: '.$strWidth.';">';
                        foreach ($arProp['VALUES'] as $arOneValue) {
                            $arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
                            $templateRow .= '<li data-treevalue="'.$arProp['ID'].'_'.$arOneValue['ID'].'" data-onevalue="'.$arOneValue['ID'].'" style="width: '.$strOneWidth.';" title="'.$arOneValue['NAME'].'"><i></i><span class="cnt">'.$arOneValue['NAME'].'</span></li>';
                        }
                        $templateRow .= '</ul></div>'.
                        '<div class="bx_slide_left" id="#ITEM#_prop_'.$arProp['ID'].'_left" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
                        '<div class="bx_slide_right" id="#ITEM#_prop_'.$arProp['ID'].'_right" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
                        '</div></div>';
                    } elseif ('PICT' == $arProp['SHOW_MODE']) {
                        if (5 < $arProp['VALUES_COUNT']) {
                            $strClass = 'bx_item_detail_scu full';
                            $strWidth = ($arProp['VALUES_COUNT']*20).'%';
                            $strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
                            $strSlideStyle = '';
                        } else {
                            $strClass = 'bx_item_detail_scu';
                            $strWidth = '100%';
                            $strOneWidth = '20%';
                            $strSlideStyle = 'display: none;';
                        }
                        $templateRow .= '<div class="'.$strClass.'" id="#ITEM#_prop_'.$arProp['ID'].'_cont">'.
                        '<span class="bx_item_section_name_gray">'.htmlspecialcharsex($arProp['NAME']).'</span>'.
                        '<div class="bx_scu_scroller_container"><div class="bx_scu"><ul id="#ITEM#_prop_'.$arProp['ID'].'_list" style="width: '.$strWidth.';">';
                        foreach ($arProp['VALUES'] as $arOneValue) {
                            $arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
                            $templateRow .= '<li data-treevalue="'.$arProp['ID'].'_'.$arOneValue['ID'].'" data-onevalue="'.$arOneValue['ID'].'" style="width: '.$strOneWidth.'; padding-top: '.$strOneWidth.';"><i title="'.$arOneValue['NAME'].'"></i>'.
                            '<span class="cnt"><span class="cnt_item" style="background-image:url(\''.$arOneValue['PICT']['SRC'].'\');" title="'.$arOneValue['NAME'].'"></span></span></li>';
                        }
                        $templateRow .= '</ul></div>'.
                        '<div class="bx_slide_left" id="#ITEM#_prop_'.$arProp['ID'].'_left" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
                        '<div class="bx_slide_right" id="#ITEM#_prop_'.$arProp['ID'].'_right" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
                        '</div></div>';
                    }
                    $arSkuTemplate[$arProp['CODE']] = $templateRow;
                }
                unset($templateRow, $arProp);
            }


            $strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
            $strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
            $arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));?>                                                                                                
			<? require($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/blocks_items.php") ?>
         <?}?>
        <a class="transition_section" href="<?=$arParams["SECTION_URL"]?>"><?=GetMessage('NEW_PRODUCTS')?></a>
    </ul>       
    <!--END elmentsList-->
    <div style="clear: both;"></div>

    <script type="text/javascript">
        BX.message({
            BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
            BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
            ADD_TO_BASKET_OK: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
            TITLE_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
            TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
            TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
            BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
            BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
            BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>',
            BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
            COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK') ?>',
            COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
            COMPARE_TITLE: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE') ?>',
            BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
            SITE_ID: '<? echo SITE_ID; ?>'
        });
    </script>
 <?}?>
    <?if ($arParams["DISPLAY_BOTTOM_PAGER"]) {?>
        <?$this->SetViewTarget('catalog_pager'); //show in section.php?>
        <?echo $arResult["NAV_STRING"];?>
        <?$this->EndViewTarget();?>
    <?}?>

    <?$this->SetViewTarget('catalog_section_description'); //show in header.php?>
    <?=$arResult["DESCRIPTION"]?>
    <?$this->EndViewTarget();?>