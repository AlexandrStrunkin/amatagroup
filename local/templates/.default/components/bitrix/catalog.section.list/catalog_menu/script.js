//обработка клика по ссылкам
$(function(){
   $(".js-catalog-menu a").on("click" , function() {
       //если у раздела нет подразделов, то нужно осуществить переход по ссылке
       if ($(this).siblings("ul").length < 1) {
           document.location.href = $(this).attr("href");
       }
   })
}) 