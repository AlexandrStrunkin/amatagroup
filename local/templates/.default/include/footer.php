<!--footer-->
<footer>
    <!--backgroundColor-->
    <div class="backgroundColor">
        <div class="whileWeWrapper">
            <!--hiddenQuestionBlock-->
            <div class="hiddenQuestionBlock">
                <p class="authClose"></p>

                <form method="post">
                    <p class="authTitle">�������� ������</p>
                    <input type="text" placeholder="�������������" name="name" class='nameInput'>
                    <select name="generator">
                        <option value="-1">�������������</option>
                        <!--������ �������� = -1-->
                        <option value="1">��������</option>
                        <option value="2">�����</option>
                    </select>
                    <input type="text" placeholder="�����" name="email" class="emailInput">
                    <input type="text" placeholder="����� ��������" name="phone" class='phoneInput nameInput'>
                    <input type="text" placeholder="�������� ��������" name="company" class='nameInput'>
                    <textarea placeholder="����� �������" name="text"></textarea>
                    <a href="#!" class="btn">��������� ������</a>

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
                            <form method="post">
                                <input type="text" name="email" placeholder="������� ���� ����� ��� ��������� ��������">
                                <input type="submit" value="�����������">
                            </form>

                        </td>
                        <td class="callBackBlock">
                            <p><a href="">�������� �������� ������</a></p>
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
    <div class="popup" id="callBackPopup">
        <p class="close"></p>
        <form method="post">
            <p class="title">�������� ������</p>
            <input type="text" placeholder="�������������" name="name" class='input'>
            <input type="text" placeholder="�������" name="phone" class='input'>
            <a href="#!" class="btn">��������� ������</a>
        </form>
        <div class="message">
            ��� ������ ���������. ���� ������������ ��������� � ���� �� ��������� �����������
        </div>
    </div>
    <!--END popup-->
</footer>
<!--END footer-->