$(document).ready(function(){
    //Имитация клика по загруке файла
    $("body").on("click", "#input_file", function(){     
        if($(this).hasClass('clickable')) {
            $(this).siblings('input[type="file"]').click();            
        }
        
    });    
    //Отслеживаем добавлен ли файл что поменять состоянии мнимой области загрузки  
    $('input[type="file"]').on('change', function(){
        $('#input_file').addClass('drop');
        $('#input_file').removeClass('clickable');                          
        $('#input_file .deleteFile').show();
        var fileName = $(this).val().split('/').pop().split('\\').pop();   
        $('#input_file .uploadBarText').html(fileName);                     
    });    
    //Удаляем файл и меняем статус мнимой области загрузки
    $('.workWithUs .deleteFile').on('click', function(){
        var input = $('#input_file');                                                   
        $('#input_file').removeClass('drop');            
        $('.workWithUs .deleteFile').hide();      
        input.replaceWith(input = input.val('').clone(true));
        $('#input_file').addClass('clickable');   
        $('#input_file .uploadBarText').html('Загрузите файл резюме');
    });
    //Если форма была отправлена показываем окно
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