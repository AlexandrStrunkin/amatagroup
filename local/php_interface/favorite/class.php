<?
class Favorite {
	
	/**
	 * 
	 * ���������, ���������� �� ����� ����� � ��������� � ������������,
	 * ���� ��, �� ������ ID ������ ���������� (!!! �� ID ������)
	 * 
	 * @param int $user_id
	 * @param int $product_id
	 * @return int|bool
	 * 
	 * */
	public static function checkIsExists($user_id, $product_id) {
		$product_list = CIBlockElement::GetList(
			array(),
			array(
				'IBLOCK_ID'  => FAVORITE_IBLOCK_ID,
				'NAME'       => $product_id,
				"CREATED_BY" => $user_id
			),
			false,
			array("nPageSize" => 1),
			array('ID')
		);
		
		if ($product = $product_list->Fetch()) {
			return $product['ID'];
		} else {
			return false;
		}
	}
	
	/**
	 * 
	 * �������� ID ������� � ��������� � ������������
	 * 
	 * @return array|bool
	 * 
	 * */
	public static function getListForUser() {
		global $USER;
		$users_favorite = array();
		$product_list = CIBlockElement::GetList(
			array(),
			array(
				'IBLOCK_ID'  => FAVORITE_IBLOCK_ID,
				"CREATED_BY" => $USER->GetID()
			),
			false,
			false,
			array('ID', 'NAME')
		);
		
		while ($product = $product_list->Fetch()) {
			array_push($users_favorite, $product['NAME']);
		}
		
		return empty($users_favorite) ? false : $users_favorite;
	}
    
    /**
     * 
     * @param int $product_id
     * @return string
     * 
     * */
    
    public static function addNewProduct($product_id) {
    	global $USER;
		if (!self::checkIsExists($USER->GetID(), $product_id)) {
	        $new_product = new CIBlockElement;
	        if ($product_id) {
	            $favorite_data = array(
	                "IBLOCK_ID" => FAVORITE_IBLOCK_ID,
	                "NAME"      => $product_id,
	                "ACTIVE"    => "Y"
	            );
	            if ($added_id = $new_product->Add($favorite_data)) {
	                return $added_id;  
	            }
	        } else {
	            return "������� � ����� ID �� ����� ���� ��������, �.�. �� �� ����������";
	        }
		}
    }
	
	/**
     * 
     * @param int $product_id
     * @return void
     * 
     * */
    
    public static function deleteProduct($product_id) {
        CIBlockElement::Delete($product_id);
    }
	
	/**
     * 
     * @return int
     * 
     * */
    
    public static function countFavoriteProducts() {
        $favorite_list_for_user = self::getListForUser();
		return $favorite_list_for_user ? count($favorite_list_for_user) : 0;
    }
}
?>