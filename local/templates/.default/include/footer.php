<!--footer-->
<footer>
    <!--backgroundColor-->
    <div class="backgroundColor">
        <div class="whileWeWrapper">
            <!--hiddenQuestionBlock-->
            <div class="hiddenQuestionBlock">
                <p class="authClose"></p>

                <form method="post" id="leave_question" action="javascript:void(null);" onsubmit="leave_quastion()">
                    <p class="authTitle">Оставить вопрос</p>
                    <input type="text" required placeholder="Представьтесь" name="name" class='nameInput'>
                    <select name="generator">
                        <option value="Производитель">Производитель</option>
                        <!--пустое значение = -1-->
                        <option value="Гандылян">Гандылян</option>
                        <option value="Мечта">Мечта</option>
                    </select>
                    <input type="email" required placeholder="Почта" name="email" class="emailInput">
                    <input type="tel" required placeholder="Номер телефона" name="phone" class='phoneInput nameInput'>
                    <input type="text" required placeholder="Название компании" name="company" class='nameInput'>
                    <textarea required placeholder="Текст вопроса" name="text"></textarea>
                    <input type="submit" class="btn" name="submit" value="Отправить вопрос" >


                    <p class="description">Все поля обязательны для заполнения!</p>
                </form>
                <div class="message">
                    Ваш вопрос отправлен. Наши консультанты свяжуться с вами по указанным координатам
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
                            <p><a href="#!">Написать производителю</a></p>

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
                            <p><a href="javascript:void(0);">Заказать обратный звонок</a></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="copyRightBlock">
                            <p>2014-2016 Интернет-магазин детских вещей "Амата", все права защищены.</p>
                        </td>
                        <td class="theCreator">
                            <p>Создание сайта - студия <a href="">WebGK</a></p>
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