<!--footer-->
<footer>
    <!--backgroundColor-->
    <p class="add_basket"></p>
    <div class="backgroundColor">
        <div class="whileWeWrapper">
            <!--hiddenQuestionBlock-->
            <div class="hiddenQuestionBlock">
                <p class="authClose"></p>
                <form method="post" id="leave_question" action="javascript:void(null);" onsubmit="leave_quastion()">
                    <p class="authTitle"><?=GetMessage('SEND_QUASTION')?></p>
                    <input type="text" required placeholder="<?=GetMessage('REPRESENTATIVE')?>" name="name" class='nameInput'>
                    <select name="generator">
                        <option value="<?=GetMessage('MANUFACTIRER')?>"><?=GetMessage('MANUFACTIRER')?></option>
                        <!--пустое значение = -1-->
                        <option value="<?=GetMessage('GANDULIAN')?>"><?=GetMessage('GANDULIAN')?></option>
                        <option value="<?=GetMessage('DREAM')?>"><?=GetMessage('DREAM')?></option>
                    </select>
                    <input type="email" required placeholder="<?=GetMessage('EMAIL')?>" name="email" class="emailInput">
                    <input type="tel" required placeholder="<?=GetMessage('PHONE')?>" name="phone" class='phoneInput nameInput'>
                    <input type="text" required placeholder="<?=GetMessage('NAME_COMPANY')?>" name="company" class='nameInput'>
                    <textarea required placeholder="<?=GetMessage('TEXT_QUASTION')?>" name="text"></textarea>
                    <input type="submit" class="btn" name="submit" value="<?=GetMessage('SEND_QUASTION')?>" >
                    <p class="description"><?=GetMessage('REQUIRED_FIELDS');?></p>
                </form>
                <div class="message">
                    <?=GetMessage('MESSAGE_YES');?>
                </div>
            </div>
            <!--END hiddenQuestionBlock-->

            <!--widthWrapper-->

            <div class="widthWrapper">
                <h2>Почему Амата?</h2>

                <p class="blockText">Мы - лидер на рынке детских товаров, наличие из более 500 000 товаров порадует вас
                    ценой и
                    качеством, начните покупки прямо сейчас!</p>
                <table>
                    <tr>
                        <td class="writeCreatorBlock">
                            <p><a href="#!"><?=GetMessage('WRITE_MANUFACTURER')?></a></p>

                        </td>
                        <td class="deliveryBlock">
                        <?$APPLICATION->IncludeComponent(
	                        "bitrix:subscribe.form",
	                        "subscription_form",
	                        array(
		                        "USE_PERSONALIZATION" => "Y",
		                        "PAGE" => "#SITE_DIR#personal/subscribe/subscr_edit.php",
		                        "SHOW_HIDDEN" => "N",
		                        "CACHE_TYPE" => "A",
		                        "CACHE_TIME" => "3600",
		                        "COMPONENT_TEMPLATE" => "subscription_form"
	                        ),
	                        false
                        );?>

                        </td>
                        <td class="callBackBlock">
                            <p><a href="javascript:void(0);"><?=GetMessage('CALL_BACK')?></a></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="copyRightBlock">
                            <p><?=GetMessage('COPYRIGHT')?></p>
                        </td>
                        <td class="theCreator">
                            <p><?=GetMessage('CREATED_SITE')?></p>
                        </td>
                    </tr>
                </table>
            </div>
            <!--END widthWrapper-->
        </div>
    </div>
    <!--END backgroundColor-->

    <!--popup (обратный звонок)-->
        <?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback",
	"back_call",
	array(
		"EMAIL_TO" => "st@webgk.ru",
		"EVENT_MESSAGE_ID" => array(
			0 => "74",
		),
		"OK_TEXT" => "Ваш запрос отправлен. Наши консультанты свяжуться с вами по указанным координатам",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
		),
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => "back_call"
	),
	false
);?>
    <!--END popup-->



</footer>
<!--END footer-->