<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?	
	$form_data = array();
	parse_str($_POST['form'], $form_data);
	$result = array(
		"success" => false,
		"text"    => "Извините, произошла ошибка, попробуйте позже."
	);
	
	$new_question = new CIBlockElement;
	$properties = array(
		USER_QUESTIONS_EMAIL_PROPERTY    => $form_data["email"],
		USER_QUESTIONS_COMPANY_PROPERTY  => iconv("utf-8", "windows-1251", $form_data["company_name"]),
		USER_QUESTIONS_QUESTION_PROPERTY => iconv("utf-8", "windows-1251", $form_data["text"])
	);
    $data = array(
        "IBLOCK_ID"       => USER_QUESTIONS_IBLOCK_ID,
		"NAME"            => iconv("utf-8", "windows-1251", $form_data["name"]),
		"ACTIVE"          => "Y",
		"PROPERTY_VALUES" => $properties,
	);
	
	if ($added_id = $new_question->Add($data)) {
	    $result = array(
			"success" => true,
			"text"    => "Ваш вопрос принят"
		);
	}
	
	echo json_encode($result);
?>