<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule("subscribe");
    // ���� ���� post ������ � ������ �� ��������� ���
    if($_POST["email"]) {
        $EMAIL = $_POST["email"];
        /* ������� �������� ������������ */
        if ($USER->IsAuthorized()) {
            global $USER;
            $USER = $USER->GetID() ;
        }
        else {
            $USER = NULL ;
        }
        /* ��������� ������� �������� ������� �������� */
        $RUB_ID = array();
        $rub = CRubric::GetList(array(), array("ACTIVE"=>"Y"));
        while($rub->ExtractFields("r_")):
            $RUB_ID = array($r_ID) ;
            endwhile;

        /* �������� ������ �� �������� */
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
            $popuptext = $EMAIL . ' ������� �������� �� ��������';
            
            //���������� ������ � ������������ � ��� ��� ������������ �������� � ��������
            if (empty($arFields["USER_ID"])) {
                $arEventFields = array(
                    "MESSAGE" => '�������� ��������� ��������� �� ��������',
                    "EMAIL"   => $arFields["EMAIL"],                   
                );        
            } else {
                $rsUser = CUser::GetByID($arFields["USER_ID"]);
                $arUser = $rsUser->Fetch();
                if (!empty($arUser["NAME"])) {
                    $mail_name = '��� ������������: ' . $arUser["NAME"];     
                }
                if (!empty($arUser["LAST_NAME"])) {
                    $mail_last_name = '������� ������������: ' . $arUser["LAST_NAME"];     
                }
                $ar_event_fields = array(
                    "MESSAGE"   => '�������� ��������� �� ��������',
                    "EMAIL"     => $arFields["EMAIL"],
                    "USER_ID"   => 'ID ������������:' . $arFields["USER_ID"],
                    "NAME"      => $mail_name,
                    "LAST_NAME" => $mail_last_name,                 
                );
            }            
            CEvent::Send ("NEW_SUBSCRIBE", "s1", $ar_event_fields, "N", 90);
            
        }
        else {
            $popuptitle = 'red';
            $popuptext = $EMAIL .' ��� �������� ��� ����������� ������';
        }
        $ajax_color = $popuptitle;
        /* ���� ajax �� ��������� */
        if ($_POST["action"] != "ajax") {
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }

?>

<form action="" name="subscribe" method="post">
    <input type="text" class="<?=$ajax_color?>" value="" title="��� e-mail" placeholder="<?=($popuptext)? $popuptext: '������� ���� ����� ��� ��������� ��������'?>" class="mailing-text" name="email"/>
    <input type="submit" value="�����������" title="" class="mailing-submit" /><br />
</form>