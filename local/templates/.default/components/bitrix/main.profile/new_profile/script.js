
$(document).ready(function () {
    $('.subscribeInp').on('click', '.subscriptionNews', function(){
       if($(this).prop("checked")){
            $(".subscriptionNews").attr("checked", true);
            $(".subscriptionNews").val('1');
       } else {
            $(".subscriptionNews").attr("checked", false);
            $(".subscriptionNews").val('');
       }
    });
    $('.settingsWrap').on('click', '.blockTitle', function(){
        $("#ordersCompleted").load("?show_all #ordersCompleted > *");
        $("#ordersCancelled").load("?show_all #ordersCancelled > *");
    });
});

