<!--footer-->
<footer>
    <!--backgroundColor-->
    <div class="backgroundColor">
        <div class="whileWeWrapper">
            <!--hiddenQuestionBlock-->
            <div class="hiddenQuestionBlock">
                <p class="authClose"></p>

                <form method="post" id="leave_question" action="javascript:void(null);" onsubmit="leave_quastion()">
                    <p class="authTitle">�������� ������</p>
                    <input type="text" required placeholder="�������������" name="name" class='nameInput'>
                    <select name="generator">
                        <option value="�������������">�������������</option>
                        <!--������ �������� = -1-->
                        <option value="��������">��������</option>
                        <option value="�����">�����</option>
                    </select>
                    <input type="email" required placeholder="�����" name="email" class="emailInput">
                    <input type="tel" required placeholder="����� ��������" name="phone" class='phoneInput nameInput'>
                    <input type="text" required placeholder="�������� ��������" name="company" class='nameInput'>
                    <textarea required placeholder="����� �������" name="text"></textarea>
                    <input type="submit" class="btn" name="submit" value="��������� ������" >


                    <p class="description">��� ���� ����������� ��� ����������!</p>
                </form>
                <div class="message">
                    ��� ������ ���������. ���� ������������ ��������� � ���� �� ��������� �����������
                </div>
            </div>
            <!--END hiddenQuestionBlock-->

            <!--widthWrapper-->

            <div class="widthWrapper">
                <h2>������ �����?</h2>

                <p class="blockText">�� - ����� �� ����� ������� �������, ������� �� ����� 500 000 ������� �������� ���
                    ����� �
                    ���������, ������� ������� ����� ������!</p>
                <table>
                    <tr>
                        <td class="writeCreatorBlock">
                            <p><a href="#!">�������� �������������</a></p>

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
                            <p><a href="javascript:void(0);">�������� �������� ������</a></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="copyRightBlock">
                            <p>2014-2016 ��������-������� ������� ����� "�����", ��� ����� ��������.</p>
                        </td>
                        <td class="theCreator">
                            <p>�������� ����� - ������ <a href="">WebGK</a></p>
                        </td>
                    </tr>
                </table>
            </div>
            <!--END widthWrapper-->
        </div>
    </div>
    <!--END backgroundColor-->

    <!--popup (�������� ������)-->
        <?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback",
	"back_call",
	array(
		"EMAIL_TO" => "st@webgk.ru",
		"EVENT_MESSAGE_ID" => array(
			0 => "74",
		),
		"OK_TEXT" => "��� ������ ���������. ���� ������������ ��������� � ���� �� ��������� �����������",
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