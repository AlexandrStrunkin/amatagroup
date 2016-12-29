$(document).ready(function(){
    //�������� ����� �� ������� �����
    $("body").on("click", "#input_file", function(){     
        if($(this).hasClass('clickable')) {
            $(this).siblings('input[type="file"]').click();            
        }
        
    });    
    //����������� �������� �� ���� ��� �������� ��������� ������ ������� ��������  
    $('input[type="file"]').on('change', function(){
        $('#input_file').addClass('drop');
        $('#input_file').removeClass('clickable');                          
        $('#input_file .deleteFile').show();
        var fileName = $(this).val().split('/').pop().split('\\').pop();   
        $('#input_file .uploadBarText').html(fileName);                     
    });    
    //������� ���� � ������ ������ ������ ������� ��������
    $('.workWithUs .deleteFile').on('click', function(){
        var input = $('#input_file');                                                   
        $('#input_file').removeClass('drop');            
        $('.workWithUs .deleteFile').hide();      
        input.replaceWith(input = input.val('').clone(true));
        $('#input_file').addClass('clickable');   
        $('#input_file .uploadBarText').html('��������� ���� ������');
    });
    //���� ����� ���� ���������� ���������� ����
    if ($('.hiddenPopup').hasClass('hasMessage')) { 
        $('.overflowMask, .hiddenPopup').fadeIn();
        $('.hiddenPopup').removeClass('hasMessage');
    };    
    $('.overflowMask, .hiddenPopup .closeButton').on("click", function(){
        $('.overflowMask, .hiddenPopup').fadeOut();      
        var url = "/work-with-us/";
        $(location).attr('href',url);
    });                                      
})    