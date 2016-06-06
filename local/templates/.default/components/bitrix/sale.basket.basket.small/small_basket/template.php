<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
    
    <a href="<?=$arParams["PATH_TO_BASKET"]?>"><p><?=GetMessage("BASKET")?></p></a>   
    <p class="quantityInBasket" title="<?=GetMessage("TSBS_READY")?>"><?=count($arResult["ITEMS"])?></p>


