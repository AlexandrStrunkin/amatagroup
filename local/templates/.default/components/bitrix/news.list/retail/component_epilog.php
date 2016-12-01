<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script>
//ќткрытие всплывающего окна
$(".where_to_buy_button_city, .where_to_buy_current_city").on("click", function(){
    $(".where_to_buy_popup").show();        
})

//«акрытие всплывающего окна при клике вне его 
$(document).click(function (e){
    var div = $(".where_to_buy_popup, .where_to_buy_change_city");
    if (!div.is(e.target) && div.has(e.target).length === 0) { 
        $('.where_to_buy_popup').hide(); 
    }
});

//«акрытие всплывающего окна при клике на крестик
$(".close_where_to_buy_popup").on("click", function(){
    $(".where_to_buy_popup").hide();        
}) 

//ќбработка клика при нажатие кнопки сворачивани€ списка магазинов
$(".where_to_buy_toggle_button, .where_to_buy_toggle_list").on("click", function(){
    if ($(".where_to_buy_toggle_button").hasClass('reverted')) {
        $(".where_to_buy_toggle_button").removeClass('reverted');
        $(".where_to_buy_toggle_list").text('<?= GetMessage("HIDE_STORES")?>');
        $(".where_to_buy_toggle_list").css("width", "160px");          
    }  else {
        $(".where_to_buy_toggle_button").addClass('reverted');
        $(".where_to_buy_toggle_list").text('<?= GetMessage("SHOW_STORES")?>');
        $(".where_to_buy_toggle_list").css("width", "260px");                                                         
    }
    $(".where_to_buy_table").each(function(){
        if(!($(this).hasClass("internet"))) {
            $(this).slideToggle("slow");
        }     
    })
})
</script>