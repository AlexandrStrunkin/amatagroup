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

    $templateData = array(
        //'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/colors.css',
        'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME']
    );

    if (isset($templateData['TEMPLATE_THEME'])) {
        $this->addExternalCss($templateData['TEMPLATE_THEME']);
    }
    //$this->addExternalCss("/bitrix/css/main/bootstrap.css");
    //$this->addExternalCss("/bitrix/css/main/font-awesome.css");
?>


<div class="leftFiltersBlock" style="display: block">


    <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
        <?foreach($arResult["HIDDEN"] as $arItem):?>
            <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
            <?endforeach;?>
        <?foreach($arResult["ITEMS"] as $key=>$arItem) {//prices

                $activeFilterItem = false;

                $key = $arItem["ENCODED_ID"];
                if(isset($arItem["PRICE"])):
                    if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                        continue;

                    $precision = 2;
                    if (Bitrix\Main\Loader::includeModule("currency")) {
                        $res = CCurrencyLang::GetFormatDescription($arItem["VALUES"]["MIN"]["CURRENCY"]);
                        $precision = $res['DECIMALS'];
                    }

                    if ($arItem["VALUES"]["MIN"]["HTML_VALUE"] || $arItem["VALUES"]["MAX"]["HTML_VALUE"]) {
                        $activeFilterItem = true;
                    }
                ?>

                <div class="typeBlockFilter">
                    <p class="leftFilterName <?if ($activeFilterItem){?> activeFilter<?}?>"><?=GetMessage("PRICE")?>, <span class="rub">c</span></p>

                    <div class="optionContain <?if ($activeFilterItem){?> active<?}?>" >
                        <div class="close"></div>
                        <input type="text" id="range" value="" name="range" class="js-range"/>
                        <input type="hidden" class="js-range-min" value="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>"/>
                        <input type="hidden" class="js-range-max" value="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>"/>

                        <input class="min-price" type="hidden" name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                            value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                            size="5"
                            onkeyup="smartFilter.keyup(this)"
                            />     

                        <input class="max-price" type="hidden" name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                            value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                            size="5"
                            onkeyup="smartFilter.keyup(this)"
                            />     
                    </div>

                </div>     

                <?
                    $precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
                    $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
                ?>
                <?
                    $arJsParams = array(
                        "leftSlider" => 'left_slider_'.$key,
                        "rightSlider" => 'right_slider_'.$key,
                        "tracker" => "drag_tracker_".$key,
                        "trackerWrap" => "drag_track_".$key,
                        "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                        "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                        "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                        "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                        "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                        "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                        "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
                        "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                        "precision" => $precision,
                        "colorUnavailableActive" => 'colorUnavailableActive_'.$key,
                        "colorAvailableActive" => 'colorAvailableActive_'.$key,
                        "colorAvailableInactive" => 'colorAvailableInactive_'.$key,
                    );
                ?>
                <script type="text/javascript">
                    BX.ready(function(){
                        window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                    });
                </script>
                <?endif;
            }

            // arshow($arResult);
            
            //not prices
            foreach($arResult["ITEMS"] as $key=>$arItem) {
                if(empty($arItem["VALUES"]) || isset($arItem["PRICE"]))
                    continue;

                if ($arItem["DISPLAY_TYPE"] == "A" && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0))
                    continue;

                $activeFilterItem = false;        
                
                if ($arItem["DISPLAY_EXPANDED"] == "Y") {
                    $activeFilterItem = true;
                }
            ?>
            <div class="typeBlockFilter">
                <p class="leftFilterName <?if ($activeFilterItem){?> activeFilter<?}?>"><?=$arItem["NAME"]?></p>   

                <?
                    $arCur = current($arItem["VALUES"]);
                    switch ($arItem["DISPLAY_TYPE"]) {
                        case "A"://NUMBERS_WITH_SLIDER
                        ?>
                        <div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
                            <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_FROM")?></i>
                            <div class="bx-filter-input-container">
                                <input
                                    class="min-price"
                                    type="text"
                                    name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                    id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                    value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                    size="5"
                                    onkeyup="smartFilter.keyup(this)"
                                    />
                            </div>
                        </div>
                        <div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
                            <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_TO")?></i>
                            <div class="bx-filter-input-container">
                                <input
                                    class="max-price"
                                    type="text"
                                    name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                    id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                    value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                    size="5"
                                    onkeyup="smartFilter.keyup(this)"
                                    />
                            </div>
                        </div>

                        <div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">
                            <div class="bx-ui-slider-track" id="drag_track_<?=$key?>">
                                <?
                                    $precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
                                    $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
                                    $value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
                                    $value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
                                    $value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
                                    $value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
                                    $value5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                                ?>
                                <div class="bx-ui-slider-part p1"><span><?=$value1?></span></div>
                                <div class="bx-ui-slider-part p2"><span><?=$value2?></span></div>
                                <div class="bx-ui-slider-part p3"><span><?=$value3?></span></div>
                                <div class="bx-ui-slider-part p4"><span><?=$value4?></span></div>
                                <div class="bx-ui-slider-part p5"><span><?=$value5?></span></div>

                                <div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
                                <div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
                                <div class="bx-ui-slider-pricebar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
                                <div class="bx-ui-slider-range" 	id="drag_tracker_<?=$key?>"  style="left: 0;right: 0;">
                                    <a class="bx-ui-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
                                    <a class="bx-ui-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
                                </div>
                            </div>
                        </div>
                        <?
                            $arJsParams = array(
                                "leftSlider" => 'left_slider_'.$key,
                                "rightSlider" => 'right_slider_'.$key,
                                "tracker" => "drag_tracker_".$key,
                                "trackerWrap" => "drag_track_".$key,
                                "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                                "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                                "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                                "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                                "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
                                "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                                "precision" => $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0,
                                "colorUnavailableActive" => 'colorUnavailableActive_'.$key,
                                "colorAvailableActive" => 'colorAvailableActive_'.$key,
                                "colorAvailableInactive" => 'colorAvailableInactive_'.$key,
                            );
                        ?>
                        <script type="text/javascript">
                            BX.ready(function(){
                                window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                            });
                        </script>
                        <?
                            break;
                        case "B"://NUMBERS
                        ?>
                        <div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
                            <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_FROM")?></i>
                            <div class="bx-filter-input-container">
                                <input
                                    class="min-price"
                                    type="text"
                                    name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                    id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                    value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                    size="5"
                                    onkeyup="smartFilter.keyup(this)"
                                    />
                            </div>
                        </div>
                        <div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
                            <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_TO")?></i>
                            <div class="bx-filter-input-container">
                                <input
                                    class="max-price"
                                    type="text"
                                    name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                    id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                    value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                    size="5"
                                    onkeyup="smartFilter.keyup(this)"
                                    />
                            </div>
                        </div>
                        <?
                            break;                                       

                        default://CHECKBOXES
                        ?>
                        <div class="optionContain <?if ($activeFilterItem){?> active<?}?>" >
                            <?foreach($arItem["VALUES"] as $val => $ar):?>     

                                <div class="close"></div>
                                <p>
                                    <input type="checkbox" value="<? echo $ar["HTML_VALUE"] ?>" name="<? echo $ar["CONTROL_NAME"] ?>" id="<? echo $ar["CONTROL_ID"] ?>"
                                        <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                        onclick="smartFilter.click(this)" hidden=""
                                        />
                                    <label class="countryText" data-role="label_<?=$ar["CONTROL_ID"]?>" for="<? echo $ar["CONTROL_ID"] ?>"><?=$ar["VALUE"];?></label>
                                </p>


                                <?endforeach;?>
                        </div>
                        <?
                    }
                ?>
            </div>  
            <?}?>

        <div class="bx-filter-parameters-box-container" style="display: none;">       
            <div class="bx-filter-popup-result <?if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
                <?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
                <span class="arrow"></span>
                <br/>
                <a href="<?echo $arResult["FILTER_URL"]?>" target=""><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
            </div>
        </div>       

        <div class="typeBlockFilter">
            <input class="accept" type="button" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
            <input class="clear" type="button" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" />    
        </div>

        <div class="typeBlockFilter">
            <button class="turnButton"><?=GetMessage("CLOSE_FILTER")?></button>
        </div>   
    </form>


</div> 


<script>
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>
