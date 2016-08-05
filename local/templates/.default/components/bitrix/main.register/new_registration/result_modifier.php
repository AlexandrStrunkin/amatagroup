<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["ERRORS"] as $key => $ar_error){
  if(stristr($ar_error, 'ѕользователь с логином') == true) {
    $arResult["ERRORS"][$key] = $ar_error.' ¬ы можите авторизоватьс€ под этим e-mail.';
  }
}

// мен€ем пор€док следовани€ полей
$arResult['SHOW_FIELDS'] = array(
	'NAME',
	'PERSONAL_PHONE',
	'LOGIN',
    'EMAIL',
	'PASSWORD',
	'CONFIRM_PASSWORD',
);
?>