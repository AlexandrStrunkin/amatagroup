<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
?>
<div class="widthWrapper">
    <div class="mainSectionWrap">
        <div class="settingsWrap">
	        <p class="blockTitle active">Мои настройки</p>
                <?include('profile/index.php')?>
         </div>
         <div class="settingsWrap">
          <p class="blockTitle">Мои заказы</p>
            <div class="settingsBlock">
                <?$APPLICATION->IncludeComponent("bitrix:sale.personal.order", "", array(
                    "SEF_MODE" => "Y",
                    "SEF_FOLDER" => "/personal/order/",
                    "ORDERS_PER_PAGE" => "10",
                    "PATH_TO_PAYMENT" => "/personal/order/payment/",
                    "PATH_TO_BASKET" => "/personal/cart/",
                    "SET_TITLE" => "Y",
                    "SAVE_IN_SESSION" => "N",
                    "NAV_TEMPLATE" => "arrows",
                    "SEF_URL_TEMPLATES" => array(
                        "list" => "index.php",
                        "detail" => "detail/#ID#/",
                        "cancel" => "cancel/#ID#/",
                    ),
                    "SHOW_ACCOUNT_NUMBER" => "Y"
                    ),
                    false
                );?>
            </div>
         </div>
         <div class="settingsWrap">
                    <p class="blockTitle">Счета<span class="whiteCount">25</span></p>

                    <div class="settingsBlock">
                        <div class="billingsListMenu">
                            <a href="#billingsActive" class="activeBillingMenu active">Активные <span
                                    style="background-color: #FCE47C">3</span></a>

                            <a href="#billingsPaid">Оплаченные <span style="background-color: #DEE8B7">7</span>
                            </a>
                        </div>
                        <div id="billingsActive" class="activeBillingsBlock">
                            <div class="viewedBlock productCarousel elmentsList">
                                <div class="jcarousel-wrapper">
                                    <!--jcarousel-->
                                    <div class="jcarousel " data-jcarousel="true">

                                    </div>
                                    <a href="" class="jcarousel-control-prev"></a>
                                    <a href="" class="jcarousel-control-next"></a>

                                </div>
                            </div>

                        </div>
                        <div id="billingsPaid" class="activeBillingsBlock" style="display: none">
                            <div class="viewedBlock productCarousel elmentsList">
                                <div class="jcarousel-wrapper">
                                    <!--jcarousel-->
                                    <div class="jcarousel " data-jcarousel="true">

                                    </div>
                                    <a href="" class="jcarousel-control-prev"></a>
                                    <a href="" class="jcarousel-control-next"></a>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
