<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    //если страниц не более 10, то выводим их все
    if ($arResult["NavPageCount"] <= 10) {
        $arResult["nEndPage"] = $arResult["NavPageCount"];
    } else {    
        //увеличиваем количество видимых страниц на 5
        $arResult["nEndPage"] = $arResult["nEndPage"] + 5;
        //если получилось число, большее, чем последняя страница, 
        if ($arResult["nEndPage"] > $arResult["NavPageCount"]) {
            //то считаем разницу, на сколько получивсшееся число больше чем номер последней страницы
            $diff = $arResult["nEndPage"] - $arResult["NavPageCount"];
            //и устанавливаем последнюю видимую страницу = общему числу страниц
            $arResult["nEndPage"] = $arResult["NavPageCount"];

            //потом вычитаем из первой видимой страницы получившуюся выше разницу и делаем аналогичные проверки
            $arResult["nStartPage"] = $arResult["nStartPage"] - $diff;
            if ($arResult["nStartPage"] < 1) {
                $arResult["nStartPage"] = 1;
            }         
        }             
    }
?>