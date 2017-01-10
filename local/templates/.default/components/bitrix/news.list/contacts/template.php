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
<?foreach($arResult['ITEMS'] as $arItem) {?>
    <a href="#city<?= $arItem["ID"] ?>" class="contacts" data-coordinates="<?= $arItem["PROPERTIES"]["COORDINATES"]["VALUE"]?>"><?= $arItem["NAME"] ?></a>
<?}?>
</div>

<?foreach($arResult['ITEMS'] as $arItem) {?>
                                               
<table class="infoBlocksContent contacts_table" id="city<?= $arItem["ID"] ?>" style="display:none">
    <tr>
        <td colspan="4"><div class="table_title"><?= $arItem["NAME"] ?></div></td>
        <td><a class="directions_button" href="<?= $arItem["PROPERTIES"]["WAY_TO"]["VALUE"] ?>" target="_blank"><?= GetMessage("WAY_TO") ?></a></td>
    </tr>
    <tr>
        <td colspan="2" rowspan="2" class="address_cell"><div class="cell_name"><?=GetMessage("ADRESS")?></div><div class="address"><?= $arItem["PROPERTIES"]["ADDRESS"]["VALUE"] ?></div></td>
        <td><div class="cell_name"><?= GetMessage("OFFICE_WORK_HOURS") ?></div><div class="phone"><?= $arItem["PROPERTIES"]["WORKING_DAYS"]["VALUE" ]?></div></td>
        <td><div class="cell_name"><?= GetMessage("PHONE") ?></div><div class="phone"><?= $arItem["PROPERTIES"]["PHONE"]["VALUE"] ?></div></td>
        <td><div class="cell_name"><?= GetMessage("STORAGE_PHONE") ?></div><div class="phone"><?= $arItem["PROPERTIES"]["STORAGE_PHONE"]["VALUE"] ?></div></td>
    </tr>
    <tr>
        <td><div class="cell_name"><?= GetMessage("STORAGE_WORK_HOURS") ?></div><div class="phone"><?= $arItem["PROPERTIES"]["STORAGE_WORKING_DAYS"]["VALUE"] ?></div></td>
        <td colspan="2"><div class="cell_name"><?= GetMessage("UNIVERSAL_MAIL") ?></div><a href="mailto:<?= $arItem["PROPERTIES"]["MAIL"]["VALUE"] ?>" class="mailto"><?= $arItem["PROPERTIES"]["MAIL"]["VALUE"] ?></a><div class="equal_symbol mail"></div></td>
    </tr>
    <tr>
        <td class="personal_cell_operational">
            <div class="personal_cell_title"><?= GetMessage("OPERATING_MANAGERS") ?></div>
            <div class="personal_cell_buttons">
                <div class="button_left">
                    <div class="equal_symbol">
                    </div>
                </div>
                <div class="button_right">
                    <div class="equal_symbol">
                    </div>
                </div>
            </div>
        </td>
        <td class="personal_cell_customer">
            <div class="personal_cell_title"><?= GetMessage("CUSTOMER_SERVICE") ?></div>
            <div class="personal_cell_buttons">
                <div class="button_left">
                    <div class="equal_symbol">
                    </div>
                </div>
                <div class="button_right">
                    <div class="equal_symbol">
                    </div>
                </div>
            </div>
        </td>
        <td colspan="3"><div class="personal_cell_title"><div><?= GetMessage("DEPARTMENTS") ?></div></div></td>
    </tr>
    <tr class="last_row">
        <td class="personal_card_operational">
        <? foreach($arItem['PROPERTIES']['OPERATING_MANAGERS']['VALUE'] as $arManager) { ?>
            <div class="personal_card" style="display:none">
                <div class="personal_card_top">
                <? if(!empty($arManager['PREVIEW_PICTURE']['src'])) {
                    $avatar = $arManager['PREVIEW_PICTURE']['src'];
                } else {
                    $avatar = '/local/templates/.default/img/defaultContactsAvatar.png';    
                } ?>
                    <div class="personal_photo"><img src="<?= $avatar ?>"></div>
                </div>
                <div class="personal_card_bottom">
                    <div class="personal_name">
                        <?= $arManager['NAME'] ?>
                    </div>
                    <div class="personal_phone">                       
                        <?= $arManager['PROPERTY_PHONE_VALUE'].'<br>' ?>
                        <? if(!empty($arManager['PROPERTY_ADDITIONAL_PHONE_VALUE'])) {
                            echo '('.GetMessage("ADDITIONAL_PHONE").' '.$arManager['PROPERTY_ADDITIONAL_PHONE_VALUE'].')';        
                        } else {
                            echo '<br/>';    
                        } ?>
                    </div>     
                    <div class="personal_mail">
                        <a href="mailto:<?= $arManager['PROPERTY_MAIL_VALUE'] ?>"><?= $arManager['PROPERTY_MAIL_VALUE'] ?></a>
                    </div>        
                </div>
            </div> 
        <? } ?>
        </td>
        <td class="personal_card_customer">            
        <? foreach($arItem['PROPERTIES']['CUSTOMER_SERVICE']['VALUE'] as $arManager) { ?>
            <div class="personal_card" style="display:none">
                <div class="personal_card_top">
                <? if(!empty($arManager['PREVIEW_PICTURE']['src'])) {
                    $avatar = $arManager['PREVIEW_PICTURE']['src'];
                } else {
                    $avatar = '/local/templates/.default/img/defaultContactsAvatar.png';    
                } ?>
                    <div class="personal_photo"><img src="<?= $avatar ?>"></div>
                </div>
                <div class="personal_card_bottom">
                    <div class="personal_name">
                        <?= $arManager['NAME'] ?>
                    </div>
                    <div class="personal_phone">                       
                        <?= $arManager['PROPERTY_PHONE_VALUE'].'<br>' ?>
                        <?if(!empty($arManager['PROPERTY_ADDITIONAL_PHONE_VALUE'])) {
                            echo '('.GetMessage("ADDITIONAL_PHONE").' '.$arManager['PROPERTY_ADDITIONAL_PHONE_VALUE'].')';        
                        } else {
                            echo '<br/>';    
                        }?>
                    </div>
                    <div class="personal_mail">
                        <a href="mailto:<?= $arManager['PROPERTY_MAIL_VALUE'] ?>"><?= $arManager['PROPERTY_MAIL_VALUE'] ?></a>
                    </div>           
                </div>
            </div> 
        <? } ?>             
        </td>
        <td colspan="3">
            <div class="department_block" data-mcs-theme="dark-3">
                <ul>
                    <? foreach($arItem['PROPERTIES']['DEPARTMENTS']['VALUE'] as $departmentID => $departmentName) { ?>
                        <li><div class="department_name"><?= $departmentName ?>: </div><a href="mailto:<?= $arItem['PROPERTIES']['DEPARTMENTS']['DESCRIPTION'][$departmentID] ?>" class="mailto"><?= $arItem['PROPERTIES']['DEPARTMENTS']['DESCRIPTION'][$departmentID] ?></a><div class="equal_symbol"></div></li>                       
                    <? } ?>                                                                                                                    
                </ul>                        
            </div>    
        </td> 
    </tr>
</table>
<?}?>
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
    <? foreach($arResult["ITEMS"] as $i=>$arItem) { ?>
        <div class="contactsWindow" id="contactsWindow<?= $containers_counter ?>" data-coordinates="<?= $arItem["PROPERTIES"]["COORDINATES"]["VALUE"]?>">
            <div class="close"></div>
            <div class="status"><?= GetMessage("OPENED") ?></div>
            <h2><?= $arItem["NAME"] ?></h2>
            <div class="date"><?= $arItem["PROPERTIES"]["WORKING_DAYS"]["VALUE"] ?> <span><?= $arItem["PROPERTIES"]["WORKING_HOURS"]["VALUE"] ?></span></div>
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
                        <strong><?= GetMessage("MAIL") ?></strong>
                        <a href="mailto:<?= $arItem["PROPERTIES"]["MAIL"]["VALUE"] ?>"><?= $arItem["PROPERTIES"]["MAIL"]["VALUE"] ?></a>
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
                <div id="manager" class="basketBlock" style="display:none">
                    <? foreach ($arItem["PROPERTIES"]["MANAGER"]["VALUE"] as $manager) { ?>
                        <div class="line">
                            <?= $manager ?>
                        </div>
                        <? } ?>
                </div>
                <!--END manager-->
                <?	
                    $exploded_coordinates = explode(",", $arItem["PROPERTIES"]["COORDINATES"]["VALUE"]);
                    $lat_center += $exploded_coordinates[0];
                    $lng_center += $exploded_coordinates[1];

                    array_push(
                        $google_coordinates,
                        "{lat: " . $exploded_coordinates[0] . ", lng: " . $exploded_coordinates[1] . ", disabled: 0}"
                    );
                ?>
            </div>
            <!--btnContainer-->
            <div class="btnContainer">
                <a href="https://www.google.com.ru/maps/dir/+/<?= $arItem["PROPERTIES"]["ADDRESS"]["VALUE"] ?>" target="_blank"><img src="/img/map.png" alt=""/><?= GetMessage("HOW_TO_GET") ?></a>
            </div>
            <!--END btnContainer-->
        </div>
        <? $containers_counter++; ?>
        <? } ?>
</div>
<script>

    var markersClicked = [], markers = [], ll;
    var openedMarker;
    var st;
    var markersArr = {};


    function initialize() {
        //адреса
        var coords = [<?= implode(",", $google_coordinates) ?>],
            center_coordinates = $('a.contacts.activeInfoBlock').attr("data-coordinates").split(","), 
            center_index = $('a.contacts.activeInfoBlock').attr("data-coordinates");

        var center = {lat: parseFloat(center_coordinates[0]), lng: parseFloat(center_coordinates[1])};

        //карта с настройками
        var zoom = 13;
        var map = new google.maps.Map(document.getElementById('map'), {
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
                openedMarker.setIcon("/img/pin.png");
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
        
        //Показываем карточку с городом по дефолту 
        var el_default = $(".contactsWindow"), el1_default = $(".contactsWindow[data-coordinates='" + center_index + "']");
            el_default.hide();
            if (el1_default.css("display") == "none") {
                el_default.hide();
                el1_default.fadeIn(300);
            } else {
                el_default.show();
                el1_default.fadeOut(300);
            }
        markerObjDefault = markersArr[center_index];
        jQuery.each(markersArr, function(e) {
            if ((markersArr[e] != center_index) && (markersArr[e].icon == "/img/pinRetail.png")) { 
                markersArr[e].setIcon("/img/pinDisabled.png");    
            };
        });
        markerObjDefault.setIcon("/img/pinRetail.png");     
        
        //Смена положения карты при клике на табы
        $(document).on("click", "a.contacts", function(){
            var new_center_coordinates = $(this).attr("data-coordinates").split(","), 
                index = $(this).attr("data-coordinates");
            zoom = 13;   
            map.setCenter({lat: parseFloat(new_center_coordinates[0]), lng: parseFloat(new_center_coordinates[1])}); 
            map.setZoom(zoom);
            markerObj = markersArr[index];
            jQuery.each(markersArr, function(e) {
                if ((markersArr[e] != index) && (markersArr[e].icon == "/img/pinRetail.png")) { 
                    markersArr[e].setIcon("/img/pinDisabled.png");    
                };
            });
            markerObj.setIcon("/img/pinRetail.png"); 
            openedMarker = markerObj;   
            var el = $(".contactsWindow"), el1 = $(".contactsWindow[data-coordinates='" + index + "']");
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
            console.log(marker);
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
            openedMarker.setIcon("/img/pin.png");

        });
        google.maps.event.addListener(marker, 'mouseover', function () {
            var div = $(".contactsWindow:visible");
            if ((!openedMarker) || (openedMarker.icon != "/img/pin.png")) {
                this.setIcon("/img/pinActive.png");
            }
        });
        google.maps.event.addListener(marker, 'mouseout', function () {
            var div = $(".contactsWindow:visible");
            if ((!openedMarker) || (openedMarker.icon != "/img/pin.png")) {
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
</script>