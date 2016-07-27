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
     // создает у брендов алфавитный пор€док ..
    function isNumeric($strChar) {   // провер€ет €вл€ютс€ ли первые символы цифрами
        $intOrd = ord($strChar);      // определ€ем код символа первой буквы
        if($intOrd >= 48 && $intOrd <= 57) {  // возвращаем код если он попал в данны диапозон
            return true;
        } else {
            return false;
        }
    }

    $strBrandHtml = '';
    $strNumeric = '';
    $isEnglish = true;

    foreach ($arResult["ITEMS"] as $arProd) {
        $strLetter = ToUpper(substr($arProd["NAME"], 0, 1));
        if (isNumeric($strLetter)) {
            $strLetter = '123';
        }
        if ($strLetter != $strLastLetter) {
            $strLastLetter = $strLetter;
            if(!empty($strBrandHtml)) {
                $strBrandHtml .= '</ul></li>';
            }

            if (ord($strLetter) >= 192 && $isEnglish) {
                $isEnglish = false;
                $strBrandHtml .= '<li class="sk-menu-abc-devider"> | </li>';
            }

            if ($strLetter == '123') {
                $strNumeric .= '<li class="sk-menu-abc-devider"> | </li><li><a href="#">'.$strLetter.'</a><ul class="sk-menu-abc-sub">';
            } else {
                $strBrandHtml .= '<li><a href="#">'.$strLetter.'</a><ul class="sk-menu-abc-sub">';
            }
        }

        if ($strLetter == '123') {
            $strNumeric .= '<li><a href="/brands/'.$arProd["ID"].'/">'.$arProd["NAME"].'</a></li>';
        } else {
            $strBrandHtml .= '<li><a href="/brands/'.$arProd["ID"].'/">'.$arProd["NAME"].'</a></li>';
        }
    }
      // создает у брендов алфавитный пор€док ..
    if(!empty($strBrandHtml)) {
        $strBrandHtml .= '</ul>';
        if(!empty($strNumeric)){
            $strNumeric .= '</ul>';
        }?>
    <div class="wrap-sk-menu-abc">
        <ul class="sk-menu-abc">
            <li>Ѕренды:</li>
            <?=$strBrandHtml.$strNumeric?>
        </ul>
    </div><?
    }
?>

<div class="brandPhotoWrapper">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
        <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
            <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                <a id="<?=$this->GetEditAreaId($arItem['ID']);?>" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
                        src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                        alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                        title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                        /></a>
            <?else:?>
                <img
                    src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                    alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                    title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                    />
            <?endif;?>
        <?endif?>
        <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
            <span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
        <?endif?>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
