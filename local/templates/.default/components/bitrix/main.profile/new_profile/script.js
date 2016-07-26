
$(document).ready(function () {
    $('.subscribeInp').on('click', '.subscriptionNews', function(){
       // $(".subscribeInp input[type = 'checkbox']").prop("checked").attr('checked',true)
       if($(this).prop("checked")){
            $(".subscriptionNews").attr("checked", true);
       } else {
            $(".subscriptionNews").attr("checked", false);
       }
    });
    $('.settingsWrap').on('click', '.blockTitle', function(){
        $("#ordersCompleted").load("?show_all #ordersCompleted > *");
        $("#ordersCancelled").load("?show_all #ordersCancelled > *");
    });
});
