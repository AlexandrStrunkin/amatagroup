<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("subscribe");
// если есть post запрос с почтой то исполняем код
if($_POST["email"]) {
    $EMAIL = $_POST["email"];
    /* получим значение пользователя */
    if ($USER->IsAuthorized()){
        global $USER;
        $USER = $USER->GetID() ;
    }
    else {
       $USER = NULL ;
    }
    /* определим рубрики активные рубрики подписок */
    $RUB_ID = array();
    $rub = CRubric::GetList(array(), array("ACTIVE"=>"Y"));
    while($rub->ExtractFields("r_")):
     $RUB_ID = array($r_ID) ;
    endwhile;

    /* создадим массив на подписку */
    $subscr = new CSubscription;
    $arFields = Array(
        "USER_ID" => $USER,
        "FORMAT" => "html/text",
        "EMAIL" => $EMAIL,
        "ACTIVE" => "Y",
        "RUB_ID" => $RUB_ID,
        "SEND_CONFIRM" => "N",
        'CONFIRMED' => 'Y'
    );
    $idsubrscr = $subscr->Add($arFields);

    if($idsubrscr) {
      $popuptitle = 'green';
      $popuptext =  $EMAIL .' успешно подписан на рассылку';
    }
    else {
      $popuptitle = 'red';
      $popuptext =   $EMAIL .' уже был подписан на рассылку';
    }
    $ajax_color = $popuptitle;
    /* если ajax не подключен */
    if ($_POST["action"] != "ajax") {
       header('Location: '.$_SERVER['HTTP_REFERER']);
    }
}

?>

<form action="" name="subscribe" method="post">
    <input type="text" class="<?=$ajax_color?>" value="" title="Ваш e-mail" placeholder="<?=($popuptext)? $popuptext: 'Введите свою почту для получения рассылки'?>" class="mailing-text" name="email"/>
    <input type="submit" value="Подписаться" title="" class="mailing-submit" /><br />
</form>