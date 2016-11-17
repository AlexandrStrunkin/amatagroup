<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $USER;

$users_saved_addresses = getUsersSavedLocations($USER->GetID());

if (count($users_saved_addresses)) {
	$arResult['USERS_SAVED_ADDRESSES'] = $users_saved_addresses;
}

// тит организации пользователя, ооо или ип
$user_result = CUser::GetList(
	($by = "ID"),
	($order = "ASC"),
	Array (
		"ID" => $USER->GetID()
	),
	array(
		"SELECT" => array("UF_FACE"),
		"FIELDS" => array("ID")
	)
);
if ($user = $user_result->Fetch()) {
	$arResult['USER_ORGANIZATION_TYPE'] = $user['UF_FACE'];
}
?>