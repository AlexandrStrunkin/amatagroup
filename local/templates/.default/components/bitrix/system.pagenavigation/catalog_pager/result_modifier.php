<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    //���� ������� �� ����� 10, �� ������� �� ���
    if ($arResult["NavPageCount"] <= 10) {
        $arResult["nEndPage"] = $arResult["NavPageCount"];
    } else {    
        //����������� ���������� ������� ������� �� 5
        $arResult["nEndPage"] = $arResult["nEndPage"] + 5;
        //���� ���������� �����, �������, ��� ��������� ��������, 
        if ($arResult["nEndPage"] > $arResult["NavPageCount"]) {
            //�� ������� �������, �� ������� ������������� ����� ������ ��� ����� ��������� ��������
            $diff = $arResult["nEndPage"] - $arResult["NavPageCount"];
            //� ������������� ��������� ������� �������� = ������ ����� �������
            $arResult["nEndPage"] = $arResult["NavPageCount"];

            //����� �������� �� ������ ������� �������� ������������ ���� ������� � ������ ����������� ��������
            $arResult["nStartPage"] = $arResult["nStartPage"] - $diff;
            if ($arResult["nStartPage"] < 1) {
                $arResult["nStartPage"] = 1;
            }         
        }             
    }
?>