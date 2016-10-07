$(function() {
     $('.btn_prew').click(function(){
        $('.wrap_form_2').hide('slow');
        $('.wrap_form_1').show('slow');
     });
    $('.btn_submit').click(function(){

        var field = new Array('reg_input_NAME');//���� ������������

        $('#form_register').each(function() {// ������������ �������� �����
            var error = 0; // ������ ������
            $("form").find(":input").each(function() {// ��������� ������ ���� � �����
                for(var i = 0; i < field.length; i++){ // ���� ���� ������������ � ������ ������������
                    if($(this).attr("id") == field[i]){ //��������� ���� ����� �� �������

                        if(!$(this).val()) {// ���� � ���� ������
                            $(this).css('border', 'red 1px solid');// ������������� ����� �������� �����
                            error = 1;// ���������� ������ ������

                        } else {
                            $(this).css('border', 'gray 1px solid');// ������������� ����� �������� �����
                        }

                    }
                }
           })
           //������� email ������
            var email = $("#reg_input_EMAIL").val();
               if(!isValidEmailAddress(email)){
                error = 2;
                $("#reg_input_EMAIL").css('border', 'red 1px solid');// ������������� ����� �������� �����
            }

            //������� ���������� �������
            var pas1 = $("#reg_input_PASSWORD").val();
            var pas2 = $("#reg_input_CONFIRM_PASSWORD").val();
               if(pas1 == '' || pas1 != pas2) {
                    error = 3;
                    $("#reg_input_PASSWORD").css('border', 'red 1px solid');// ������������� ����� �������� �����
                    $("#reg_input_CONFIRM_PASSWORD").css('border', 'red 1px solid');// ������������� ����� �������� �����
                }
            if (error == 0) { // ���� ������ ��� �� ���������� ������
                $('.wrap_form_1').hide('slow');
                $('.wrap_form_2').show('slow');
            } else {
                var err_text = "";
                if(error == 1)  err_text="�� ��� ������������ ���� ���������!";
                if(error == 2)  err_text="������ �� ���������� e-mail!";
                if(error == 3)  err_text="������ �� ���������";

                $("#messenger").html(err_text);
                $("#messenger").fadeIn("slow");
                return false; //���� � ����� ����������� ������ , ��  ��������� �������� ������ �� ������.
            }

        })
      });
 });
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}
