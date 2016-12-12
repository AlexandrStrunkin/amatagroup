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
<!-- Yandex.Metrika counter --> 
<script type="text/javascript"> 
(function (d, w, c) { 
    (w[c] = w[c] || []).push(function() { 
        try { 
            w.yaCounter38954910 = new Ya.Metrika({ 
                id:38954910, 
                clickmap:true, 
                trackLinks:true, 
                accurateTrackBounce:true, 
                webvisor:true, 
                trackHash:true, 
                ecommerce:"dataLayer" 
            }); 
        } 
        catch(e) { } 
    }); 
    var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { 
        n.parentNode.insertBefore(s, n); 
    }; 
    s.type = "text/javascript"; 
    s.async = true; 
    s.src = "https://mc.yandex.ru/metrika/watch.js"; 
    if (w.opera == "[object Opera]") { 
        d.addEventListener("DOMContentLoaded", f, false); 
    } else { 
        f(); 
    } 
})
(document, window, "yandex_metrika_callbacks"); 
</script> 
<noscript>
    <div>
        <img src="https://mc.yandex.ru/watch/38954910" style="position:absolute; left:-9999px;" alt="" />
    </div>
</noscript> 
<!-- /Yandex.Metrika counter -->
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
    
    <div class="innerPageWrapper">