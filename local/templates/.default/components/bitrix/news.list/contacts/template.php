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
    <? foreach($arResult["ITEMS"] as $arItem) { ?>
	    <div class="contactsWindow" id="contactsWindow<?= $containers_counter ?>">
	        <div class="close"></div>
	        <div class="status"><?= GetMessage("OPENED") ?></div>
	        <h2><?= $arItem["NAME"] ?></h2>
	        <div class="date"><?= $arItem["PROPERTIES"]["WORKING_DAYS"]["VALUE"] ?>, <span><?= $arItem["PROPERTIES"]["WORKING_HOURS"]["VALUE"] ?></span></div>
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
	            <div id="manager" class="basketBlock">
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
	            <a href="https://www.google.com.ru/maps/dir/+/г Москва <?= $arItem["PROPERTIES"]["ADDRESS"]["VALUE"] ?>" target="_blank"><img src="/img/map.png" alt=""/><?= GetMessage("HOW_TO_GET") ?></a>
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


    function initialize() {
        //адреса
        var coords = [<?= implode(",", $google_coordinates) ?>];
        
        <?	
			$total_baloons = count($google_coordinates);
			$lat_center = floatval($lat_center / $total_baloons);
			$lng_center = floatval($lng_center / $total_baloons);
        ?>

        var center = {lat: <?= $lat_center ?>, lng: <?= $lng_center ?>};

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
    }

    function addMarker(location, map, i) {

        var marker = new google.maps.Marker({
            position: location,
            icon: "/img/pinDisabled.png",
            map: map,
            label: "",
            ind: i
        });

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