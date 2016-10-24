<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    //пробуем авторизовать пользователя с введенными данными
    global $USER;
    if (!is_object($USER)) $USER = new CUser;
    $storePass = "N";
    if ($_POST["storepass"] == "Y") {
        $storePass = "Y";
    }

    $return["result"] = "ERROR";
    $arAuthResult = $USER->Login($_POST["email"], $_POST["pass"], $storePass);
    if ($arAuthResult === true) {
        $return["result"] = "OK" ;
    }
    echo json_encode($return);
?>