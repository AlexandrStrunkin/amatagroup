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

         <?include('cart/index.php')?>

    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
