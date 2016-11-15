<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule("subscribe");
    // если есть post запрос с почтой то исполняем код
    if($_POST["email"]) {
        $EMAIL = $_POST["email"];
        /* получим значение пользователя */
        if ($USER->IsAuthorized()) {
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

        if ($idsubrscr) {
            $popuptitle = 'green';
            $popuptext = $EMAIL . ' успешно подписан на рассылку';
            
            //отправляем письмо с уведомлением о том что пользователь добавлен в подписки
            if (empty($arFields["USER_ID"])) {
                $arEventFields = array(
                    "MESSAGE" => 'Добавлен анонимный подписчик на рассылку',
                    "EMAIL"   => $arFields["EMAIL"],                   
                );        
            } else {
                $rsUser = CUser::GetByID($arFields["USER_ID"]);
                $arUser = $rsUser->Fetch();
                if (!empty($arUser["NAME"])) {
                    $mail_name = 'Имя пользователя: ' . $arUser["NAME"];     
                }
                if (!empty($arUser["LAST_NAME"])) {
                    $mail_last_name = 'Фамилия пользователя: ' . $arUser["LAST_NAME"];     
                }
                $ar_event_fields = array(
                    "MESSAGE"   => 'Добавлен подписчик на рассылку',
                    "EMAIL"     => $arFields["EMAIL"],
                    "USER_ID"   => 'ID пользователя:' . $arFields["USER_ID"],
                    "NAME"      => $mail_name,
                    "LAST_NAME" => $mail_last_name,                 
                );
            }            
            CEvent::Send ("NEW_SUBSCRIBE", "s1", $ar_event_fields, "N", 90);
            
        }
        else {
            $popuptitle = 'red';
            $popuptext = $EMAIL .' уже подписан или неправильно набран';
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