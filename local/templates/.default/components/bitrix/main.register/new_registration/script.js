$(function() {

  $('#form_register').each(function(){
    // ��������� ���������� (����� � ������ ��������)
    var form = $(this),
        btn = form.find('.btn_submit');

    // ��������� ������� ������������ ����, �������� ��� ���� ������
    form.find('.authInput').addClass('empty_field');

    // ������� �������� ����� �����
    function checkInput(){
      form.find('.authInput').each(function(){
        if($(this).val() != ''){
          // ���� ���� �� ������ ������� �����-��������
        $(this).removeClass('empty_field');
        } else {
          // ���� ���� ������ ��������� �����-��������
        $(this).addClass('empty_field');
        }
      });
    }

    // ������� ��������� ������������� �����
    function lightEmpty(){
      form.find('.empty_field').css({'border-color':'#d8512d'});
      // ����� ���������� ������� ���������
 /*     setTimeout(function(){
        form.find('.empty_field').removeAttr('style');
      },500);*/
    }

    // �������� � ������ ��������� �������
    setInterval(function(){
      // ��������� ������� �������� ����� �� �������������
      checkInput();
      // ������� �-�� ������������� �����
      var sizeEmpty = form.find('.empty_field').size();
      // ������ �������-������ �� ������ �������� �����
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

    // ������� ����� �� ������ ���������
    btn.click(function(){
      if($(this).hasClass('disabled')){
        // ������������ ������������� ���� � ����� �� ����������, ���� ���� ������������� ����
        lightEmpty();
      } else {
        // ��� ������, ��� ���������, ���������� �����
        $('.wrap_form_1').hide('slow');
        $('.wrap_form_2').show('slow');

      }
    });
  });
});
