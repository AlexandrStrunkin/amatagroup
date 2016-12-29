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
                        <?
                            $arSelect = Array("ID", "NAME");
                            $arFilter = Array("IBLOCK_ID"=>MANUFACTURER_IBLOCK_ID);
                            $result = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                            while($manufacturer = $result->Fetch()) { 
                        ?> 
                            <option value="<?=$manufacturer['NAME']?>"><?=$manufacturer['NAME']?></option>                        
                        <?
                            }
                        ?>
                    </select>
                    <input type="email" required placeholder="<?=GetMessage('EMAIL')?>" name="email" class="emailInput">
                    <input type="tel" required placeholder="<?=GetMessage('PHONE')?>" name="phone" class='phoneInput nameInput'>
                    <input type="text" required placeholder="<?=GetMessage('NAME_COMPANY')?>" name="company" class='nameInput'> 
                    <textarea required placeholder="<?=GetMessage('TEXT_QUASTION')?>" name="text"></textarea>
                    <input type="submit" class="btn_company" name="submit" value="<?=GetMessage('SEND_QUASTION')?>" >
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

                <p class="blockText">
                <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/why_Amata.php"
                        )
                    );?>
                </p>
                <table>
                    <tr>
                        <td class="writeCreatorBlock">
                            <p><a href="#!"><?=GetMessage('WRITE_MANUFACTURER')?></a></p>

                        </td>
                        <td class="deliveryBlock">
                            <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => "/ajax/mailing.php",
                                        "EDIT_TEMPLATE" => ""
                                    )
                                );?>
                        </td>
                        <td class="callBackBlock">
                            <p><a href="javascript:void(0);"><?=GetMessage('CALL_BACK')?></a></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="copyRightBlock">
                            <p>                            
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => "/include/copyright_footer.php",
                                    "EDIT_TEMPLATE" => ""
                                )
                            );?>
                            </p>
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
    <div class="back_call_ajax">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.feedback",
            "back_call",
            array(
                "EMAIL_TO" => FORM_FROM_EMAIL,
                "EVENT_MESSAGE_ID" => array(
                    0 => "74",
                ),
                "OK_TEXT" => "Ваш запрос отправлен. Наши консультанты свяжутся с вами по указанным координатам",
                "REQUIRED_FIELDS" => array(
                    0 => "NAME",
                ),
                "USE_CAPTCHA" => "N",
                "COMPONENT_TEMPLATE" => "back_call"
            ),
            false
        );?>
    </div>
    <!--END popup-->



</footer>
<!--END footer-->
<!-- Yandex.Metrika counter --> 
<script type="text/javascript"> 
(function (d, w, c) { 
    (w[c] = w[c] || []).push(function() { 
        try { 
            w.yaCounter38954910 = new Ya.Metrika({ 
                id:38954910, 
                clickmap:true, 
                trackLinks:true, 
                accurateTrackBounce:true, 
                webvisor:true, 
                trackHash:true, 
                ecommerce:"dataLayer" 
            }); 
        } 
        catch(e) { } 
    }); 
    var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { 
        n.parentNode.insertBefore(s, n); 
    }; 
    s.type = "text/javascript"; 
    s.async = true; 
    s.src = "https://mc.yandex.ru/metrika/watch.js"; 
    if (w.opera == "[object Opera]") { 
        d.addEventListener("DOMContentLoaded", f, false); 
    } else { 
        f(); 
    } 
})
(document, window, "yandex_metrika_callbacks"); 
</script> 
<noscript>
    <div>
        <img src="https://mc.yandex.ru/watch/38954910" style="position:absolute; left:-9999px;" alt="" />
    </div>
</noscript> 
<!-- /Yandex.Metrika counter -->