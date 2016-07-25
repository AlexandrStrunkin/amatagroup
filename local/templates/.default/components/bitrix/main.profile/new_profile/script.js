
$(document).ready(function () {
    $('.subscribeInp').on('click', '.subscriptionNews', function(){
       // $(".subscribeInp input[type = 'checkbox']").prop("checked").attr('checked',true)
       if($(this).prop("checked")){
            $(".subscriptionNews").attr("checked", true);
       } else {
            $(".subscriptionNews").attr("checked", false);
       }
    })
})