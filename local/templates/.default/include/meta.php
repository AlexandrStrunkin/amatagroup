<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />

<?
    $APPLICATION->AddHeadScript("http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js");
    $APPLICATION->AddHeadScript("https://maps.googleapis.com/maps/api/js?v=3.exp");
    $APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH."js/jquery.mCustomScrollbar.concat.min.js");
    $APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH."js/jQueryRotate.js");
    $APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH."js/jquery.selectric.min.js");
    $APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH."js/jquery.maskedinput.js");
    $APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH."js/jquery.jcarousel.min.js");
    $APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH."js/ion.rangeSlider.min.js");
    $APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH."js/circle-progress.js");
    $APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH."js/main.js");
    $APPLICATION->AddHeadScript(DEFAULT_TEMPLATE_PATH."js/inputMask.js");

?>

<?
    $APPLICATION->SetAdditionalCSS("https://fonts.googleapis.com/css?family=PT+Serif:400,400italic&subset=latin,cyrillic");
    $APPLICATION->SetAdditionalCSS(DEFAULT_TEMPLATE_PATH."css/jquery.mCustomScrollbar.css");
    $APPLICATION->SetAdditionalCSS(DEFAULT_TEMPLATE_PATH."css/selectric.css");
    $APPLICATION->SetAdditionalCSS(DEFAULT_TEMPLATE_PATH."css/jcarousel.basic.css");
    $APPLICATION->SetAdditionalCSS(DEFAULT_TEMPLATE_PATH."css/ion.rangeSlider.css");
    $APPLICATION->SetAdditionalCSS(DEFAULT_TEMPLATE_PATH."css/ion.rangeSlider.skinNice.css");
    $APPLICATION->SetAdditionalCSS(DEFAULT_TEMPLATE_PATH."css/style.css");

     CAjax::Init();
?>

    <?$APPLICATION->ShowHead();?>
    <title><?$APPLICATION->ShowTitle()?></title>