//��������� ����� �� �������
$(function(){
   $(".js-catalog-menu a").on("click" , function() {
       //���� � ������� ��� �����������, �� ����� ����������� ������� �� ������
       if ($(this).siblings("ul").length < 1) {
           document.location.href = $(this).attr("href");
       }
   })
}) 