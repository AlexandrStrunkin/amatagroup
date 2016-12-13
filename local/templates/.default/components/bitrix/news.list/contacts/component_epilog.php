<script>
//���� � ��������

//�������� hover �� ��� ������
$(this).parents('.contacts_table').find('.equal_symbol, .contacts_table .department_block .department_name, .contacts_table ul li a').on("mouseover", function(){
    $(this).siblings('.contacts_table .equal_symbol, .contacts_table .department_block .department_name, .contacts_table ul li a').addClass('jshover');
    $(this).parents('.contacts_table ul li').addClass('jshover');       
});

$(this).parents('.contacts_table').find('.equal_symbol, .contacts_table .department_block .department_name, .contacts_table ul li a').on("mouseleave", function(){
    $(this).siblings('.contacts_table .equal_symbol, .contacts_table .department_block .department_name, .contacts_table ul li a').removeClass('jshover');
    $(this).parents('.contacts_table ul li').removeClass('jshover');           
});

//������� �� ������ ��� ����� �� �������� � ���������
$(this).parents('.contacts_table').find('.equal_symbol, .contacts_table .department_block .department_name').on("click", function(e){
    $(this).siblings('.mailto')[0].click();
    e.preventDefault();
});

//������� � �������
//���������� ������ ��������
$(window).on('load', function(){
    var visible_table = 0;
    $('.contacts_table').each(function(){
        $(this).find('.personal_card_customer .personal_card').first().fadeIn().addClass('visible');
        $(this).find('.personal_card_operational .personal_card').first().fadeIn().addClass('visible');   
    })  
    $('.contacts_table').each(function(){
        if($(this).is(':visible')) {
            visible_table = visible_table + 1;   
        }        
    })                 
    if (visible_table == 0) {
        $('.contacts_table').first().show();        
    }  
})

//������ ������ ������ � ���������
$('.contacts_table .personal_cell_customer .personal_cell_buttons .button_right').on("click", function() {  
    if ($(this).parents('.contacts_table').find('.personal_card_customer .personal_card.visible').prev().is('.personal_card') || $(this).parents('.contacts_table').find('.personal_card_customer .personal_card.visible').next().is('.personal_card')) {
        if ($(this).parents('.contacts_table').find('.personal_card_customer .personal_card.visible').next().is('.personal_card')) {
            $(this).parents('.contacts_table').find('.personal_card_customer .personal_card.visible').removeClass('visible').hide().next('.personal_card').addClass('visible').fadeIn();            
        } else {  
            $(this).parents('.contacts_table').find('.personal_card_customer .personal_card.visible').removeClass('visible').hide().siblings('.personal_card').first().addClass('visible').fadeIn();    
        }                                                                                     
    }     
});
//����� ������ ������ � ���������
$('.contacts_table .personal_cell_customer .personal_cell_buttons .button_left').on("click", function() {
    if ($(this).parents('.contacts_table').find('.personal_card_customer .personal_card.visible').prev().is('.personal_card') || $(this).parents('.contacts_table').find('.personal_card_customer .personal_card.visible').next().is('.personal_card')) {
        if ($(this).parents('.contacts_table').find('.personal_card_customer .personal_card.visible').prev().is('.personal_card')) {
            $(this).parents('.contacts_table').find('.personal_card_customer .personal_card.visible').removeClass('visible').hide().prev('.personal_card').addClass('visible').fadeIn();            
        } else {  
            $(this).parents('.contacts_table').find('.personal_card_customer .personal_card.visible').removeClass('visible').hide().siblings('.personal_card').last().addClass('visible').fadeIn();    
        }                                                                                     
    } 
});

//������ ������ ������������ ���������
$('.contacts_table .personal_cell_operational .personal_cell_buttons .button_right').on("click", function(){  
    if ($(this).parents('.contacts_table').find('.personal_card_operational .personal_card.visible').prev().is('.personal_card') || $(this).parents('.contacts_table').find('.personal_card_operational .personal_card.visible').next().is('.personal_card')) {
        if ($(this).parents('.contacts_table').find('.personal_card_operational .personal_card.visible').next().is('.personal_card')) { 
            $(this).parents('.contacts_table').find('.personal_card_operational .personal_card.visible').removeClass('visible').hide().next('.personal_card').addClass('visible').fadeIn();            
        } else {  
            $(this).parents('.contacts_table').find('.personal_card_operational .personal_card.visible').removeClass('visible').hide().siblings('.personal_card').first().addClass('visible').fadeIn();    
        }                                                                                     
    }     
});
//����� ������ ������������ ���������
$('.contacts_table .personal_cell_operational .personal_cell_buttons .button_left').on("click", function(){  
    if ($(this).parents('.contacts_table').find('.personal_card_operational .personal_card.visible').prev().is('.personal_card') || $(this).parents('.contacts_table').find('.personal_card_operational .personal_card.visible').next().is('.personal_card')) {
        if ($(this).parents('.contacts_table').find('.personal_card_operational .personal_card.visible').prev().is('.personal_card')) {
            $(this).parents('.contacts_table').find('.personal_card_operational .personal_card.visible').removeClass('visible').hide().prev('.personal_card').addClass('visible').fadeIn();            
        } else {  
            $(this).parents('.contacts_table').find('.personal_card_operational .personal_card.visible').removeClass('visible').hide().siblings('.personal_card').last().addClass('visible').fadeIn();    
        }                                                                                       
    }     
});
</script>