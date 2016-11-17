<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
    /** @var CBitrixBasketComponent $component */
    $curPage = $APPLICATION->GetCurPage().'?'.$arParams["ACTION_VARIABLE"].'=';
    $arUrls = array(
        "delete" => $curPage."delete&id=#ID#",
        "delay" => $curPage."delay&id=#ID#",
        "add" => $curPage."add&id=#ID#",
    );
    unset($curPage);

    $arBasketJSParams = array(
        'SALE_DELETE' => GetMessage("SALE_DELETE"),
        'SALE_DELAY' => GetMessage("SALE_DELAY"),
        'SALE_TYPE' => GetMessage("SALE_TYPE"),
        'TEMPLATE_FOLDER' => $templateFolder,
        'DELETE_URL' => $arUrls["delete"],
        'DELAY_URL' => $arUrls["delay"],
        'ADD_URL' => $arUrls["add"]
    );
?>
<script type="text/javascript">
    var basketJSParams = <?=CUtil::PhpToJSObject($arBasketJSParams);?>
</script>

<!--widthWrapper-->
<div class="widthWrapper">
    <!--basketBody-->
    <div class="basketBody">
        <div class="widthWrapper">

            <div class="basketBodyMenu">
                <a href="#!" class="active"><?=GetMessage("SALE_BASKET")?></a>
                <a href="/personal/favourite/"><?=GetMessage("SALE_FAVOURITE")?></a>
            </div>

            <?
                $APPLICATION->AddHeadScript($templateFolder."/script.js");

                if (strlen($arResult["ERROR_MESSAGE"]) <= 0)
                {
                ?>
                <div id="warning_message">
                    <?
                        if (!empty($arResult["WARNING_MESSAGE"]) && is_array($arResult["WARNING_MESSAGE"]))
                        {
                            foreach ($arResult["WARNING_MESSAGE"] as $v)
                                ShowError($v);
                        }
                    ?>
                </div>
                <?
                    $normalCount = count($arResult["ITEMS"]["AnDelCanBuy"]);
                    $normalHidden = ($normalCount == 0) ? 'style="display:none;"' : '';
                ?>

                <div id="basket" class="basketBlock" style="display: block">

                    <form method="post" action="<?=POST_FORM_ACTION_URI?>" name="basket_form" id="basket_form">
                        <div id="basket_form_container">
                            <div class="bx_ordercart">

                                <?
                                    include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items.php");
                                ?>

                            </div>
                        </div>
                        <input type="hidden" name="BasketOrder" value="BasketOrder" />
                        <!-- <input type="hidden" name="ajax_post" id="ajax_post" value="Y"> -->
                    </form>


                </div>

                <?
                }
                else
                {  ?>
                <div class="empty_basket">
                    <?ShowError($arResult["ERROR_MESSAGE"]);?>
                </div>
                <?}
            ?>

        </div>
    </div>
    <!--END basketBody-->
    </div>
