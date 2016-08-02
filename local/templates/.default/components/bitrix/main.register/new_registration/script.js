$(function() {

  $('#form_register').each(function(){
    // Объявляем переменные (форма и кнопка отправки)
    var form = $(this),
        btn = form.find('.btn_submit');

    // Добавляем каждому проверяемому полю, указание что поле пустое
    form.find('.authInput').addClass('empty_field');

    // Функция проверки полей формы
    function checkInput(){
      form.find('.authInput').each(function(){
        if($(this).val() != ''){
          // Если поле не пустое удаляем класс-указание
        $(this).removeClass('empty_field');
        } else {
          // Если поле пустое добавляем класс-указание
        $(this).addClass('empty_field');
        }
      });
    }

    // Функция подсветки незаполненных полей
    function lightEmpty(){
      form.find('.empty_field').css({'border-color':'#d8512d'});
      // Через полсекунды удаляем подсветку
 /*     setTimeout(function(){
        form.find('.empty_field').removeAttr('style');
      },500);*/
    }

    // Проверка в режиме реального времени
    setInterval(function(){
      // Запускаем функцию проверки полей на заполненность
      checkInput();
      // Считаем к-во незаполненных полей
      var sizeEmpty = form.find('.empty_field').size();
      // Вешаем условие-тригер на кнопку отправки формы
      if(sizeEmpty > 0){
        if(btn.hasClass('disabled')){
          return false
        } else {
          btn.addClass('disabled')
        }
      } else {
        btn.removeClass('disabled')
      }
    },500);

    // Событие клика по кнопке отправить
    btn.click(function(){
      if($(this).hasClass('disabled')){
        // подсвечиваем незаполненные поля и форму не отправляем, если есть незаполненные поля
        lightEmpty();
      } else {
        // Все хорошо, все заполнено, отправляем форму
        $('.wrap_form_1').hide('slow');
        $('.wrap_form_2').show('slow');

      }
    });
  });
});
