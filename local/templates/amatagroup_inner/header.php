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
        <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"nav_chain", 
	array(
		"COMPONENT_TEMPLATE" => "nav_chain",
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1"
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