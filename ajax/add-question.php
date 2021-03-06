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
		
		$mails = array(
			FORM_FROM_EMAIL,
			$form_data["email"]
		);
		$form_types = getFormTypes();
	    $template_fields = array(
	    	"NAME"    => iconv("utf-8", "windows-1251", $form_data["name"]),
	    	"COMPANY" => iconv("utf-8", "windows-1251", $form_data["company_name"]),
	    	"TEXT"    => iconv("utf-8", "windows-1251", $form_data["text"])
		);
		foreach ($mails as $mail) {
			$template_fields['FORM_TYPE'] = $mail == FORM_FROM_EMAIL ? "(" . $form_types[$form_data["form_type"]] . ")" : "";
			$template_fields['EMAIL'] = $mail;
			CEvent::Send("FEEDBACK_FORM", SITE_ID, $template_fields, 'N', QUESTION_FORM_TEMPLATE_ID);
		}
	}
	
	echo json_encode($result);
?>