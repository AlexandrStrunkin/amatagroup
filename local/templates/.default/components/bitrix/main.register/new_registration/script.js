$(function() {
     $('.btn_prew').click(function(){
        $('.wrap_form_2').hide('slow');
        $('.wrap_form_1').show('slow');
     });
    $('.btn_submit').click(function(){

        var field = new Array('reg_input_NAME');//поля обязательные

        $('#form_register').each(function() {// обрабатываем отправку формы
            var error = 0; // индекс ошибки
            $("form").find(":input").each(function() {// проверяем каждое поле в форме
                for(var i = 0; i < field.length; i++){ // если поле присутствует в списке обязательных
                    if($(this).attr("id") == field[i]){ //проверяем поле формы на пустоту

                        if(!$(this).val()) {// если в поле пустое
                            $(this).css('border', 'red 1px solid');// устанавливаем рамку красного цвета
                            error = 1;// определяем индекс ошибки

                        } else {
                            $(this).css('border', 'gray 1px solid');// устанавливаем рамку обычного цвета
                        }

                    }
                }
           })
           //провека email адреса
            var email = $("#reg_input_EMAIL").val();
               if(!isValidEmailAddress(email)){
                error = 2;
                $("#reg_input_EMAIL").css('border', 'red 1px solid');// устанавливаем рамку красного цвета
            }

            //провека совпадения паролей
            var pas1 = $("#reg_input_PASSWORD").val();
            var pas2 = $("#reg_input_CONFIRM_PASSWORD").val();
               if(pas1 == '' || pas1 != pas2) {
                    error = 3;
                    $("#reg_input_PASSWORD").css('border', 'red 1px solid');// устанавливаем рамку красного цвета
                    $("#reg_input_CONFIRM_PASSWORD").css('border', 'red 1px solid');// устанавливаем рамку красного цвета
                }
            if (error == 0) { // если ошибок нет то отправляем данные
                $('.wrap_form_1').hide('slow');
                $('.wrap_form_2').show('slow');
            } else {
                var err_text = "";
                if(error == 1)  err_text="Не все обязательные поля заполнены!";
                if(error == 2)  err_text="Введен не корректный e-mail!";
                if(error == 3)  err_text="Пароли не совпадают";

                $("#messenger").html(err_text);
                $("#messenger").fadeIn("slow");
                return false; //если в форме встретились ошибки , не  позволяем отослать данные на сервер.
            }

        })
      });
 });
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}
