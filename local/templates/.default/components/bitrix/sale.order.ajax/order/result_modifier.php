<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $USER;

$users_saved_addresses = getUsersSavedLocations($USER->GetID());

if (count($users_saved_addresses)) {
	$arResult['USERS_SAVED_ADDRESSES'] = $users_saved_addresses;
}
?>