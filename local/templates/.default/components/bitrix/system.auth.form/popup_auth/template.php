<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>        

<div class="authForm">            
    <form id="auth_form" name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="">

        <p class="authTitle"><?=GetMessage("auth_form_comp_auth")?></p>
        <div class="errorText"><?=GetMessage("AUTH_ERROR")?></div>
        <input type="text" class="authInput" name="email" placeholder="Email" autocomplete="off">
        <input type="password" class="authInputPass" name="pass" placeholder="<?=GetMessage("AUTH_PASSWORD")?>" autocomplete="off">
        <input type="checkbox" class="authInputPass" hidden="" name="storepass" checked="" id="rememberMe" value="Y">

        <label class="rememberMeText" for="rememberMe"><?=GetMessage("AUTH_REMEMBER_SHORT")?></label>

        <a href="javascript:void(0)" class="authEnter"><?=GetMessage("AUTH_LOGIN_BUTTON")?></a>
        <a href="" class="forgotPassword"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>

        <?/*  данный блок понадобится позже для реализации авторизации через соцсети
            <p class="socServises">Войти через социальную сеть:</p>
            <a href="" class="socServImg twitImg"></a>
            <a href="" class="socServImg okImg"></a>
            <a href="" class="socServImg vkImg"></a>
            <a href="" class="socServImg mailImg"></a>
            <a href="" class="socServImg facebookImg"></a>       
            <a href="" class="socServImg yandexImg"></a>
        */?>                 
    </form>   

</div>


<script>
    //ajax authorization data check
    $(function() {
        $(".authEnter").on("click", function(e) {
            $(".errorText").hide();
            e.preventDefault();
            var form = $("#auth_form");
            var formData = form.serialize();             
            $.ajax({
                type: "POST",
                url: "<?=$templateFolder?>/ajax.php",
                data: formData,
                success: function(data){
                    data = JSON.parse(data);
                    if (data.result != "OK") {
                        $(".errorText").show();
                        return false;
                    } else {
                        window.location.reload();                          
                    }
                }
            });
        })
    })   
</script>

   