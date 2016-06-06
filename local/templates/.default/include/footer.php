<!--footer-->
<footer>
    <!--backgroundColor-->
    <div class="backgroundColor">
        <div class="whileWeWrapper">
            <!--hiddenQuestionBlock-->
            <div class="hiddenQuestionBlock">
                <p class="authClose"></p>

                <form method="post">
                    <p class="authTitle">Оставить вопрос</p>
                    <input type="text" placeholder="Представьтесь" name="name" class='nameInput'>
                    <select name="generator">
                        <option value="-1">Производитель</option>
                        <!--пустое значение = -1-->
                        <option value="1">Гандылян</option>
                        <option value="2">Мечта</option>
                    </select>
                    <input type="text" placeholder="Почта" name="email" class="emailInput">
                    <input type="text" placeholder="Номер телефона" name="phone" class='phoneInput nameInput'>
                    <input type="text" placeholder="Название компании" name="company" class='nameInput'>
                    <textarea placeholder="Текст вопроса" name="text"></textarea>
                    <a href="#!" class="btn">Отправить вопрос</a>

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
                            <form method="post">
                                <input type="text" name="email" placeholder="Введите свою почту для получения рассылки">
                                <input type="submit" value="Подписаться">
                            </form>

                        </td>
                        <td class="callBackBlock">
                            <p><a href="">Заказать обратный звонок</a></p>
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
    <div class="popup" id="callBackPopup">
        <p class="close"></p>
        <form method="post">
            <p class="title">Заказать звонок</p>
            <input type="text" placeholder="Представьтесь" name="name" class='input'>
            <input type="text" placeholder="Телефон" name="phone" class='input'>
            <a href="#!" class="btn">Отправить запрос</a>
        </form>
        <div class="message">
            Ваш запрос отправлен. Наши консультанты свяжуться с вами по указанным координатам
        </div>
    </div>
    <!--END popup-->
</footer>
<!--END footer-->