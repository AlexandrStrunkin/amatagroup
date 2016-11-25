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
<div class="jcarousel-wrapper">
	<div class="jcarousel">
		<ul>
		<? foreach ($arResult["ITEMS"] as $arItem) { ?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
			<li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="reviesElement">
					<p class="reviesCity"><?= $arItem["PROPERTIES"]["CITY"]["VALUE"] ?></p>
		
		            <p class="reviewsTitle"><?= $arItem["NAME"] ?></p>
		
		            <p class="reviewsText"><?= $arItem["PREVIEW_TEXT"] ?></p>
                    
                    <div class="reviewsBottom">
		                <div class="avatarBlock">
                            <? 
                            if ($arItem["PREVIEW_PICTURE"]["HTML"]) { 
                                echo '<div class="avatarBackground">'.$arItem["PREVIEW_PICTURE"]["HTML"].'</div>';        
                            } 
                            ?>
                        </div>
		                <div class="authorsBlock">
		                    <p class="reviewsAuthor"><?= $arItem["PROPERTIES"]["AUTHOR"]["VALUE"] ?></p>
		    
		                    <p><?= $arItem["PROPERTIES"]["POSITION"]["VALUE"] ?>, <?= $arItem["PROPERTIES"]["COMPANY"]["VALUE"] ?></p>
		                </div>
                    </div>
				</div>            
                <div class="reviewsPopup">
                    <div class="reviewsElement">
                        <div class="closeReviewsPopup">
                        </div>                         
                        <p class="reviewsCity"><?= $arItem["PROPERTIES"]["CITY"]["VALUE"] ?></p>
            
                        <p class="reviewsTitle"><?= $arItem["NAME"] ?></p>
            
                        <p class="reviewsText"><?= $arItem["PREVIEW_TEXT"] ?></p>
            
                        <div class="reviewsBottom">
                            <div class="avatarBlock">
                                <? 
                                if ($arItem["PREVIEW_PICTURE"]["HTML"]) { 
                                    echo '<div class="avatarBackground">'.$arItem["PREVIEW_PICTURE"]["HTML"].'</div>';        
                                } 
                                ?>
                            </div>
                            <div class="authorsBlock">
                                <p class="reviewsAuthor"><?= $arItem["PROPERTIES"]["AUTHOR"]["VALUE"] ?></p>
                
                                <p><?= $arItem["PROPERTIES"]["POSITION"]["VALUE"] ?>, <?= $arItem["PROPERTIES"]["COMPANY"]["VALUE"] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
			</li>            
		<? } ?>
		</ul>
	</div>
	<? if (count($arResult["ITEMS"]) > 4) { ?>
		<a href="" class="jcarousel-control-prev"></a>
		<a href="" class="jcarousel-control-next"></a>
	<? } ?>
</div>