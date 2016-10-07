<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["ERRORS"] as $key => $ar_error){
  if(stristr($ar_error, 'Пользователь с логином') == true) {
    $arResult["ERRORS"][$key] = $ar_error.' Вы можите авторизоваться под этим e-mail.';
  }
}
?>