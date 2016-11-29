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
    $this->setFrameMode(true);?>
<?
    $INPUT_ID = trim($arParams["~INPUT_ID"]);
    if(strlen($INPUT_ID) <= 0)
        $INPUT_ID = "title-search-input-fixed";
    $INPUT_ID = CUtil::JSEscape($INPUT_ID);

    $CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
    if(strlen($CONTAINER_ID) <= 0)
        $CONTAINER_ID = "title-search-top";
    $CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

    if($arParams["SHOW_INPUT"] !== "N") {?>

    <a href=""><p><?=GetMessage("CT_BST_SEARCH_BUTTON")?></p></a>

    <div class="searchForm" id="<?echo $CONTAINER_ID?>">
        <form action="<?echo $arResult["FORM_ACTION"]?>">
            <input class="input" placeholder="<?=GetMessage("ENTER_YOUR_SEARCH_QUERY")?>" id="<?echo $INPUT_ID?>" type="text" name="q" value="" size="40" maxlength="50" autocomplete="off"/>
            <button class="submit" type="submit" name="s"><?=GetMessage("FIND")?></button>
        </form>
    </div>
    <div class="searchFormClose"></div>

    <?}?>

<script>
    BX.ready(function(){
        new JCTitleSearch({
            'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
            'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
            'INPUT_ID': '<?echo $INPUT_ID?>',
            'MIN_QUERY_LEN': 2
        });
    });
</script>