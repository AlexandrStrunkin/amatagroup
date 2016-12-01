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
<div class="infoBlocksMenu">
    <a href="#stores" class="activeInfoBlock">Магазины</a>
    <a href="#internet" class="">Интернет-магазины</a>
</div>

<div class="infoBlocksContent" id="stores" style="display: block">
    <div class="where_to_buy_change_city">
        <div class="where_to_buy_city"><?= GetMessage("SELECT_CITY") ?></div>
        <div class="where_to_buy_current_city"><?= GetMessage("MOSCOW") ?></div>
        <div class="where_to_buy_button_city"></div>
        <div class="where_to_buy_toggle_button"></div>
        <div class="where_to_buy_toggle_list"><?= GetMessage("HIDE_ALL") ?></div> 
    </div>

    <div class="where_to_buy_popup">
        <div class="close_where_to_buy_popup">
        </div>
        <div class="popup_wrapper">    
            <h1><?= GetMessage("SELECT_CITY_POPUP") ?></h1>        
            <ul class="city_column">
                <? $element_in_column = 6; ?>
                <? $element_quant = 0; ?> 
                <? foreach ($arResult['CITY_LIST'] as $city_id => $city_data) { ?>            
                    <li data-city-id="<?= $city_id ?>" data-coordinates="<?= $city_data['COORD'] ?>" data-city-name="<?= $city_data['TITLE'] ?>"><?= $city_data['TITLE'] ?></li>
                    <?
                    if ($element_quant == $element_in_column) {
                        $element_quant = 0;
                        echo '</ul><ul class="city_column">';    
                    } else {
                        $element_quant = $element_quant + 1;
                    }            
                    ?>       
                <? } ?>       
            </ul> 
        </div>
    </div>

    <table class="where_to_buy_table">
        <tr>
            <th class="where_to_buy_name"><div class="cell_wrapper"><?= GetMessage("STORE_NAME") ?></div></th>
            <th class="where_to_buy_adds"><div class="cell_wrapper"><?= GetMessage("STORE_ADDS") ?></div></th>
            <th class="where_to_buy_phone"><div class="cell_wrapper"><?= GetMessage("STORE_PHONE") ?></div></th>
            <th class="where_to_buy_site"><div class="cell_wrapper"><?= GetMessage("STORE_SITE") ?></div></th>
        </tr>
        <? foreach($arResult["ITEMS"] as $arItem) { ?>
            <? if ($arItem["IBLOCK_SECTION_ID"] != WHERE_TO_BUY_INTERNET_SECTION_ID) {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <tr data-city-id="<?= $arItem["IBLOCK_SECTION_ID"]?>" data-coordinates="<?= $arItem['PROPERTIES']['COORDINATES']['VALUE']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <td class="where_to_buy_name"><div class="cell_wrapper"><?= $arItem["NAME"] ?></div></td>
                    <td class="where_to_buy_adds"><div class="cell_wrapper"><?= $arItem["PROPERTIES"]["ADDRESS"]["VALUE"] ?></div></td>
                    <td class="where_to_buy_phone"><div class="cell_wrapper"><?= $arItem["PROPERTIES"]["PHONE"]["VALUE"] ?></div></td>
                    <td class="where_to_buy_site"><div class="cell_wrapper"><a href="<?= $arItem["PROPERTIES"]["URL"]["VALUE"] ?>" target="_blank"><?= $arItem["PROPERTIES"]["URL"]["VALUE"] ?></a></div></td>
                </tr>
            <? }
        } ?>
    </table>
    <div id="contacts">
        <div id="map-zoom-plus" class="map-zoom-plus"></div>
        <div id="map-zoom-minus" class="map-zoom-minus"></div>
        <div id="map-full-mode" class="map-full-mode"></div>
        <div id="map-normal-mode" class="map-normal-mode"></div>
        <div id="map" class="map"></div>
        <?
		    $containers_counter = 0;
		    $lat_center = 0;
		    $lng_center = 0;
		    $google_coordinates = array();
	    ?>
        <? foreach($arResult["ITEMS"] as $ItemID => $arItem) { ?>    
            <div class="contactsWindow" id="contactsWindow<?= $containers_counter ?>" data-store-id="<?= $arItem["ID"]?>">
	            <div class="close"></div>
	            <h2><?= $arItem["NAME"] ?></h2>
	            <div class="basketBody tabs">
	                <!--tabsLinks-->
	                <div class="basketBodyMenu tabsLinks">
	                    <a href="#info" class="active js_google_tabs"><?= GetMessage("INFO") ?></a>
	                    <a href="#manager" class="js_google_tabs"><?= GetMessage("MANAGERS") ?></a>
	                </div>
	                <!--END tabsLinks-->
	                <!--info-->
	                <div id="info" class="basketBlock" style="display: block">
	                    <!--line-->
	                    <div class="line">
	                        <strong><?= GetMessage("ADDRESS") ?></strong>
	                        <?= $arItem["PROPERTIES"]["ADDRESS"]["VALUE"] ?>
	                    </div>
	                    <!--END line-->
	                    <!--line-->
	                    <div class="line">
                                <strong><?= GetMessage("STORE_SITE") ?></strong>
                                <a href="<?= $arItem["PROPERTIES"]["URL"]["VALUE"] ?>" target="_blank">
                                    <?= $arItem["PROPERTIES"]["URL"]["VALUE"] ?>
                                </a>
                        </div>
	                    <!--END line-->
	                    <!--line-->
	                    <div class="line">
	                        <strong><?= GetMessage("PHONE") ?></strong>
	                        <?= $arItem["PROPERTIES"]["PHONE"]["VALUE"] ?>
	                    </div>
	                    <!--END line-->
	                </div>
	                <!--END info-->
	                <!--manager-->
	                <div id="manager" class="basketBlock">
	            	    <? foreach ($arItem["PROPERTIES"]["MANAGER"]["VALUE"] as $manager) { ?>
		                    <div class="line">
		                        <?= $manager ?>
		                    </div>
	                    <? } ?>
	                </div>
	                <!--END manager-->
	                <?	
                        if (!empty($arItem["PROPERTIES"]["COORDINATES"]["VALUE"])) {
					        $exploded_coordinates = explode(",", $arItem["PROPERTIES"]["COORDINATES"]["VALUE"]);
					        $lat_center += $exploded_coordinates[0];
					        $lng_center += $exploded_coordinates[1];
	            	        array_push(
						        $google_coordinates,
						        "{lat: " . $exploded_coordinates[0] . ", lng: " . $exploded_coordinates[1] . ", disabled: 0}"
					        );
                        }
	                ?>
	            </div>
	            <!--btnContainer-->
	            <div class="btnContainer">
	                <a href="https://www.google.com.ru/maps/dir/+/г Москва <?= $arItem["PROPERTIES"]["ADDRESS"]["VALUE"] ?>" target="_blank"><img src="/img/map.png" alt=""/><?= GetMessage("HOW_TO_GET") ?></a>
	            </div>
	            <!--END btnContainer-->
	        </div>
	        <? $containers_counter++; ?>
        <? } ?>    
    </div>
</div>
<div class="infoBlocksContent" id="internet" style="display: none">
    <table class="where_to_buy_table internet">
        <tr>
            <th class="where_to_buy_name"><div class="cell_wrapper"><?= GetMessage("STORE_NAME") ?></div></th> 
            <th class="where_to_buy_site"><div class="cell_wrapper"><?= GetMessage("STORE_SITE") ?></div></th>
        </tr>
        <? foreach($arResult["ITEMS"] as $arItem) { ?>
            <? if ($arItem["IBLOCK_SECTION_ID"] == WHERE_TO_BUY_INTERNET_SECTION_ID) {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <tr id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <td class="where_to_buy_name"><div class="cell_wrapper"><?= $arItem["NAME"] ?></div></td>
                    <td class="where_to_buy_site"><div class="cell_wrapper"><a href="<?= $arItem["PROPERTIES"]["URL"]["VALUE"] ?>" target="_blank"><?= $arItem["PROPERTIES"]["URL"]["VALUE"] ?></a></div></td>
                </tr>
            <? }
        } ?>
    </table>
</div>
<script>

    var markersClicked = [], markers = [], ll;
    var openedMarker;
    var st;
    var map;
    var zoom;
    var markersArr = {};

    function initialize() {
        //адреса
        var coords = [<?= implode(",", $google_coordinates) ?>],
            default_center_coordinates = $("ul.city_column li[data-city-id='" + default_location + "']").attr("data-coordinates").split(","),            
            center = {lat: parseFloat(default_center_coordinates[0]), lng: parseFloat(default_center_coordinates[1])};

        //карта с настройками
        zoom = 10;
        map = new google.maps.Map(document.getElementById('map'), {
            scrollwheel: false,
            zoom: zoom,
            disableDefaultUI: true,
            center: center
        });

        //маркеры
        var i = 0;
        for (i = 0; i < coords.length; i++) {
            markers[i] = addMarker(coords[i], map, i);
            if (openedMarker && openedMarker.ind == i) {
                openedMarker = markers[i];
                openedMarker.setIcon("/img/pinRetail.png");
            }
        }

        //зоом +
        $("#map-zoom-plus").off("click").on("click", function () {
            var currentZoomLevel = zoom;
            if (currentZoomLevel != 21) {
                zoom = currentZoomLevel + 1;

            }
            map.setZoom(zoom);

        });

        //зоом -
        $("#map-zoom-minus").off("click").on("click", function () {
            var currentZoomLevel = zoom;
            if (currentZoomLevel != 0) {
                zoom = currentZoomLevel - 1;
            }
            map.setZoom(zoom);
        });

        //полноэкранный режим
        $("#map-full-mode").off("click").on("click", function () {
            st = $(window).scrollTop();
            $("#map-full-mode").hide();
            $("#map-normal-mode").show();
            $("#contacts").addClass("full");
            $("body").css("overflow", "hidden");

            initialize();
        });

        //обычный режим
        $("#map-normal-mode").off("click").on("click", function () {
            $("#map-normal-mode").hide();
            $("#map-full-mode").show();
            $("#contacts").removeClass("full");
            $("body").css("overflow", "auto");
            initialize();
            $("html, body").animate({scrollTop: st}, 2);
        });
        
        //Работа с картой при клике на магазины
        $(document).on("click", ".where_to_buy_table td.where_to_buy_name", function(){
            var new_center_coordinates = $(this).parent('tr').attr("data-coordinates").split(","),
                top_menu_height = $(".top-menu-fixed").height();
                target_coordinates = $("#contacts").offset().top - top_menu_height;
                index = $(this).parent('tr').attr("data-coordinates");
            zoom = 11;   
            map.setCenter({lat: parseFloat(new_center_coordinates[0]), lng: parseFloat(new_center_coordinates[1])}); 
            map.setZoom(zoom);
            $('html, body').animate({
                scrollTop: target_coordinates 
            }, 1200);
            markerObj = markersArr[index];
            jQuery.each(markersArr, function(e) {
                if ((markersArr[e] != index) && (markersArr[e].icon == "/img/pinRetail.png")) { 
                    markersArr[e].setIcon("/img/pinDisabled.png");    
                };
            });
            markerObj.setIcon("/img/pinRetail.png"); 
            openedMarker = markerObj;   
            var el = $(".contactsWindow"), el1 = $("#contactsWindow" + markerObj.ind);
            el.hide();
            if (el1.css("display") == "none") {
                el.hide();
                el1.fadeIn(300);
            } else {
                el.show();
                el1.fadeOut(300);
            }         
        })
    }

    function addMarker(location, map, i) {

        var marker = new google.maps.Marker({
            position: location,
            icon: "/img/pinDisabled.png",
            map: map,
            label: "",
            ind: i
        });
        
        markersArr[location.lat +","+location.lng] = marker;

        google.maps.event.addListener(marker, 'click', function () { 
            var el = $(".contactsWindow"), el1 = $("#contactsWindow" + marker.ind);
            if (openedMarker) {
                openedMarker.setIcon("/img/pinDisabled.png");

            }
            el.hide();
            if (el1.css("display") == "none") {
                el.hide();
                el1.fadeIn(300);
            } else {
                el.show();
                el1.fadeOut(300);
            }
            var link = el1.find(".tabsLinks a:first"), href = link.attr("href");
            link.parent().find("a").removeClass("active");
            link.addClass("active");
            el1.find(".basketBlock").hide();
            el1.find(href).show();

            openedMarker = this;
            openedMarker.setIcon("/img/pinRetail.png");

        });
        google.maps.event.addListener(marker, 'mouseover', function () {
            var div = $(".contactsWindow:visible");
            if ((!openedMarker) || (openedMarker.icon != "/img/pinRetail.png")) {
                this.setIcon("/img/pinActiveRetail.png");
            }
        });
        google.maps.event.addListener(marker, 'mouseout', function () {
            var div = $(".contactsWindow:visible");
            if ((!openedMarker) || (openedMarker.icon != "/img/pinRetail.png")) {
                this.setIcon("/img/pinDisabled.png");
            }
        }); 
                
        return marker;
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    //закрытие всплывающего окна
    $(".contactsWindow .close").off("click").on("click", function () {
        $(".contactsWindow").fadeOut(300);
        openedMarker.setIcon("/img/pinDisabled.png");
    });
    
    $(document).ready(function(){
    	$(document).on("change", "select[name='retail_city_select']", function(){
    		var new_center_coordinates = $(this).find("option:selected").val().split(",");
    		zoom = 11;
    		map.setCenter({lat: parseFloat(new_center_coordinates[0]), lng: parseFloat(new_center_coordinates[1])});
    		map.setZoom(zoom);
    	})
    })

    //Действия со списком городов в всплывающем окне
    $(document).ready(function(){
        //По дефолту Москва, нужно переделать, переменная в result_modifier 
              
        $('.where_to_buy_table tr[data-city-id="' + default_location + '"]').css("display" , "block");
        $(".where_to_buy_current_city").text(default_location_name);
        $('.where_to_buy_table tr:first-child').css("display" , "block");
                 
        console.log(default_center_coordinates);
        console.log(default_center_coordinates[0]);
        console.log(default_center_coordinates[1]);
        //Обработка клика по городу в списке 
        $(document).on("click", "ul.city_column li", function(){            
            var city_id = $(this).attr("data-city-id");
            $('.where_to_buy_table tr').hide();
            $('.where_to_buy_table tr[data-city-id=' + city_id + ']').css("display" , "block");
            $(".where_to_buy_current_city").text($(this).text()); 
            $('.where_to_buy_table tr:first-child').css("display" , "block");
            var new_center_coordinates = $(this).attr("data-coordinates").split(",");
            zoom = 11;
            map.setCenter({lat: parseFloat(new_center_coordinates[0]), lng: parseFloat(new_center_coordinates[1])});
            map.setZoom(zoom);
            $(".where_to_buy_popup").hide();
            $(".where_to_buy_table.internet tr").show();
        }) 
    })       
</script>