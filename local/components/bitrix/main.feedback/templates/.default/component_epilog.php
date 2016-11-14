<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<script>    
//Форма заказа обратного звонка
$(document).ready(function(){
    $(document).on("submit", "#call_back_form", function(e){
        e.preventDefault();
        var temp_style = $(this).parent().attr("style");
        $.ajax({
            url: '/ajax/call_back.php',
            type: 'POST',
            data:  $(this).serialize() + "&submit=Y",
            success:function(data){
            }
        }).done(function(data){
            $(".back_call_ajax").html(data);  
            $('#call_back_form').parent().attr("style", temp_style);
            $('#call_back_form').parent().addClass("call_back_reload");
        });
    })
})
</script>