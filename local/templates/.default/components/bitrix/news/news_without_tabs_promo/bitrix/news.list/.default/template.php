<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (count($arResult["ITEMS"]) < 1)
	return;
?>
<div class="infoBlocksContent" style="display:block">
    <ul class="infoNewsList">
    <? foreach ($arResult['ITEMS'] as $arItem) { ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_ELEMENT_DELETE_CONFIRM')));
    ?>
        <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="imageWrapper"><img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt=""/></div>
            <?  // ���������� ���� ��������, ������ ���������� � ��������� � ���������� � ������� d.m.Y
                $datetime_from = date_format(date_create_from_format('d.m.Y H:i:s', $arItem['DATE_ACTIVE_FROM']), 'd.m.Y');
                $datetime_to = date_format(date_create_from_format('d.m.Y H:i:s', $arItem['DATE_ACTIVE_TO']), 'd.m.Y');
                $datetime_create = date_format(date_create_from_format('d.m.Y H:i:s', $arItem['DATE_CREATE']), 'd.m.Y');
                $date_today = new DateTime(date('d.m.Y'));
                $date_to = new DateTime(date_format(date_create_from_format('d.m.Y H:i:s', $arItem['DATE_ACTIVE_TO']), 'd.m.Y'));
                //������������ ������� ����� ������ � ������� ���������� ����
                $interval_deadline = $date_to->diff($date_today);
                $format_day = $interval_deadline->format('%a');
            ?>                 
            <?if ($arItem['PROPERTIES']['DO_NOT_SHOW_DATE']['VALUE'] != 'Y') {?>
            <?if($arItem["IBLOCK_SECTION_ID"] == PROMO_IBLOCK_SECTION_ID){?>
                <div class="wrap_date <?= (strtotime($datetime_to) > strtotime(date('d.m.Y')) || !$arItem['DATE_ACTIVE_TO']) ? 'green' : 'red'; ?>">
                <? if (strtotime($datetime_to) > strtotime(date('d.m.Y')) || !$arItem['DATE_ACTIVE_TO']) { ?>
                    <span class="date_validity">
                        <?= GetMessage('DEADLINE') . getNumEnding($format_day, array(GetMessage('DAY_1'), GetMessage('DAY_2'), GetMessage('DAY_3')));?>
                    </span>
                <?} else { ?>
                    <span class="date_validity">
                        <?= GetMessage('DEADLINE_CLOSE');?>
                    </span>
                    <?}?>
                </div>
            
                <p class="dateText">
                    <?= GetMessage('VALIDITY') . $datetime_from . GetMessage('VALIDITY_2') . $datetime_to; ?>
                </p>
            <? } else { ?>
                <p class="dateText">
                    <?= $datetime_from; ?>
                </p>
            <? } 
            } ?>


            <div class="tabs_news_list_text">
                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="newsName"><?= $arItem['NAME'] ?></a>
                <p class="newsText">
                    <?= $arItem['PREVIEW_TEXT'] ?>
                </p>
                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="detailNews"><?= GetMessage('MORE') ?></a>
            </div>
        </li>
    <? } ?>
    </ul>
</div>