<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    IncludeTemplateLangFile(__FILE__);
    CJSCore::Init(array("fx"));
    $curPage = $APPLICATION->GetCurPage(true);    
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>

    <?include($_SERVER["DOCUMENT_ROOT"].DEFAULT_TEMPLATE_PATH."/include/meta.php")?>

</head>
<body class="<?if ($curPage == SITE_DIR."index.php"){?>mainPage<?}?>">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>

<?include($_SERVER["DOCUMENT_ROOT"].DEFAULT_TEMPLATE_PATH."/include/header.php")?>

<!--main-->
<main>

<!--catalogTitleBlock-->
<div class="catalogTitleBlock">
    <div class="widthWrapper">
        <h1><?$APPLICATION->ShowTitle()?></h1>

        <!--breadcrumb-->
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "nav_chain", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                ),
                false
            );?>    
        <!--END breadcrumb--> 

        <p class="titleText">     
            <?$APPLICATION->ShowViewContent('catalog_section_description');//sets in section template?>
        </p>
    </div>
    </div>
    <!--END catalogTitleBlock-->
    
    <div class="widthWrapper innerPageWrapper">