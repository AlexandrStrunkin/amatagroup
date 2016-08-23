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

    $strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
    $strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
    $arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>
 <div class="mainLeftMenu">
<?if (0 < $arResult["SECTIONS_COUNT"]) {?>
    <ul class="js-catalog-menu">
        <?
            $intCurrentDepth = 1;
            $boolFirst = true;
            foreach ($arResult['SECTIONS'] as &$arSection) {
                $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

                if ($intCurrentDepth < $arSection['RELATIVE_DEPTH_LEVEL']) {
                    if (0 < $intCurrentDepth) {
                        $str = '<ul>';

                        if ($arSection["DEPTH_LEVEL"] == 2) {
                            $str = '<ul class="secondLvlCatalog firstLvl">';
                        }

                        if ($arSection["DEPTH_LEVEL"] == 3) {
                            $str = '<ul class="secondLvl">';
                        }
                        echo "\n",str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']),$str;
                    }
                } elseif ($intCurrentDepth == $arSection['RELATIVE_DEPTH_LEVEL']) {
                    if (!$boolFirst)
                        echo '</li>';
                } else {
                    while ($intCurrentDepth > $arSection['RELATIVE_DEPTH_LEVEL']) {
                        echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
                        $intCurrentDepth--;
                    }
                    echo str_repeat("\t", $intCurrentDepth-1),'</li>';
                }

                echo (!$boolFirst ? "\n" : ''),str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']);
            ?>
            <li <? if ($arSection["DEPTH_LEVEL"] == 2) { ?> class="firstLvlLi" <? } elseif($arSection["DEPTH_LEVEL"] == 1) { ?> class="topLvlLi" <? } ?> id="<?=$this->GetEditAreaId($arSection['ID']);?>">
            <?if ($arSection["DEPTH_LEVEL"] == 1) {?>
                <img src="<?=$arSection["PICTURE"]["SRC"]?>" alt=""/>
                <?}?>
            <a href="<? echo $arSection["SECTION_PAGE_URL"]; ?>">
                <? echo $arSection["NAME"];?>
            </a>
            <?

                $intCurrentDepth = $arSection['RELATIVE_DEPTH_LEVEL'];
                $boolFirst = false;
            }

            unset($arSection);
            while ($intCurrentDepth > 1) {
                echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
                $intCurrentDepth--;
            }
            if ($intCurrentDepth > 0) {
                echo '</li>',"\n";
            }

        ?>
    </ul>
    <?}?>

    <div class="bottomBlockMailLeft">
        <a href="" class="link1"><p><?=GetMessage("OPEN_ALL")?></p></a>
        <a href="" class="link2"><p><?=GetMessage("CLOSE_ALL")?></p></a>
    </div>

</div>