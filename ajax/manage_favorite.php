<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
$result = array();
// удаляем подписку
if ($_POST['delete_item'] && $_POST['id']) {
    Favorite::deleteProduct($_POST['id']);
} else if ($_POST['id']) { // добавляем новую
	$new_favorite_id = Favorite::addNewProduct($_POST['id']);
	$result['data'] = (int)$new_favorite_id;
}
$result['total'] = Favorite::countFavoriteProducts();
echo json_encode($result);
?>