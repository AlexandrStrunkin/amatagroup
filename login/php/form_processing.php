<?php
/* Осуществляем проверку вводимых данных и их защиту от враждебных 
скриптов */

function check_var($var) {
	if (isset($_POST[$var])) {
		return strip_tags(trim($_POST[$var]));
	}
	return '';
}

if (isset($_POST['submit1'])) {
    // получение переданного имени
	$your_name = check_var("email1");

	
	$message = "Новая заявка с сайта AMATA! <br/>";
	$message .="Текст заявки: <br/><br/>";
	$message .="Электронный адрес: $your_name <br/>";
	       
} /* else if (isset($_POST['submit4'])) {

	$your_name = check_var("your_name4");
	$telephone = check_var("telephone4");

	$message ="Текст заявки: <br/><br/>";
	$message .="Имя отправителя: $your_name <br/>";
	$message .="Телефонный номер: $telephone <br/>";

} else if (isset($_POST['submit5'])) {
    // получение переданного имени
	$your_name = check_var("your_name5");
	$telephone = check_var("telephone5");
	$date = check_var("date5");
	$message = check_var("people5");
	$radio = check_var("Radio1");

	if ($radio == "0") 
		$ras = "Организация"; 
	else if ($radio == "1")
		$ras = "Частное лицо";
	else
		$ras = "Не указано";

	$message = "Новая заявка с сайта dprent.ru! <br/>";
	$message .="Текст заявки: <br/><br/>";
	$message .="Имя отправителя: $your_name <br/>";
	$message .="Статус заявителя: $ras <br/>";
	$message .="Телефонный номер: $telephone <br/>";
	$message .="Дата мероприятия: $date <br/>";
	$message .="Количество человек: $people <br/>";
	       
} */else {
    echo "0";
    die();
}

// $message = include("../mail_tpl.php");

//$to = 'elena.klimkina.oneischool@mail.ru';
//$to = 'maks-sapronov@yandex.ru';
$to = 'maks-sapronov@yandex.ru';
$subject = 'Новая заявка с сайта AMATA';

$headers = "From: " . $your_name . "\r\n";
// $headers .= "CC: susan@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$mail = mail($to, $subject, $message, $headers);
if ($mail) {
	echo '1'; 
} else {
	echo $message; 
}

?>
