<script>
//�������� ������������ ����
$(".where_to_buy_button_city, .where_to_buy_current_city").on("click", function(){
    $(".where_to_buy_popup").show();        
})

//�������� ������������ ���� ��� ����� ��� ��� 
$(document).click(function (e){
    var div = $(".where_to_buy_popup, .where_to_buy_change_city");
    if (!div.is(e.target) && div.has(e.target).length === 0) { 
        $('.where_to_buy_popup').hide(); 
    }
});

//�������� ������������ ���� ��� ����� �� �������
$(".close_where_to_buy_popup").on("click", function(){
    $(".where_to_buy_popup").hide();        
}) 

//��������� ����� ��� ������� ������ ������������ ������ ���������
$(".where_to_buy_toggle_button, .where_to_buy_toggle_list").on("click", function(){
    if ($(".where_to_buy_toggle_button").hasClass('reverted')) {
        $(".where_to_buy_toggle_button").removeClass('reverted');
        $(".where_to_buy_toggle_list").text('�������� ���');
        $(".where_to_buy_toggle_list").css("width", "160");          
    }  else {
        $(".where_to_buy_toggle_button").addClass('reverted');
        $(".where_to_buy_toggle_list").text('�������� �������� � ���� ������');
        $(".where_to_buy_toggle_list").css("width", "260");                                                         
    }
    $(".where_to_buy_table").slideToggle("slow");        
})
</script>