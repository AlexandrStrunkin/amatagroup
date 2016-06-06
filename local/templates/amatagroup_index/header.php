<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    IncludeTemplateLangFile(__FILE__);
    CJSCore::Init(array("fx"));
    $curPage = $APPLICATION->GetCurPage(true);    
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>

    <?include($_SERVER["DOCUMENT_ROOT"].DEFAULT_TEMPLATE_PATH."/include/meta.php")?>

</head>
<body class="<?if ($curPage == SITE_DIR."index.php"){?>mainPage<?}?>">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>

<?include($_SERVER["DOCUMENT_ROOT"].DEFAULT_TEMPLATE_PATH."/include/header.php")?>

<!--main-->
<main>
    <!--backgroundColor-->
    <div class="backgroundColor">
        <!--widthWrapper-->
        <div class="widthWrapper">
            <!--productBlockWrapper-->
            <div class="productBlockWrapper">
                <div class="productBlockMenu">
                    <div class="active" data-id='1'>�������</div>
                    <div data-id='2'>���� ������</div>
                    <div data-id='3'>��������� �����������</div>
                </div>

                <div class="newsBlock">
                    <p class="showAllLink"><a href="">���������� ���</a></p>

                    <p class="blockTitle">������������ �� ����� ��������� ����� ��������. ��������, �������, ������� �
                        ������ ������, ������� �� �����.</p>


                    <ul class="productList" id="productList1">
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product1.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">�������</div>

                            </div>
                        </li>
                        <li>
                            <!--productWrapper-->
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product2.jpg" alt=""/></a>
                                <div>
                                    <a href="" class="productName">�����-���� Simba Minnie Mouse </a>
                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">�������</div>
                            </div>
                            <!--END productWrapper-->
                        </li>
                        <li>
                            <!--productWrapper-->
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product3.jpg" alt=""/></a>
                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>
                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">�������</div>

                            </div>
                            <!--END productWrapper-->
                        </li>
                        <li>
                            <!--productWrapper-->
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product4.jpg" alt=""/></a>
                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>
                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">�������</div>
                            </div>
                            <!--END productWrapper-->
                        </li>
                        <li>
                            <!--productWrapper-->
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product5.jpg" alt=""/></a>
                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>
                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">�������</div>
                            </div>
                            <!--END productWrapper-->
                        </li>
                        <li>
                            <!--productWrapper-->
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product6.jpg" alt=""/></a>
                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>
                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">�������</div>
                            </div>
                            <!--END productWrapper-->
                        </li>
                        <li>
                            <!--productWrapper-->
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product7.jpg" alt=""/></a>
                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>
                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a></div>
                                </div>
                                <div class="newProductWrapper">�������</div>
                            </div>
                            <!--END productWrapper-->
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product7.jpg" alt=""/></a>
                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>
                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a></div>
                                </div>
                                <div class="newProductWrapper">�������</div>

                            </div>
                        </li>


                    </ul>
                    <ul class="productList" id="productList2">
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product1.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="logosContainer">
                                    <div class="discountLogoWrapper">-25%</div>
                                    <div class="bestLogoWrapper">BEST</div>
                                    <div class="newLogoWrapper">NEW</div>
                                    <div class="freshLogoWrapper">FRESH</div>
                                    <div class="saleLogoWrapper">SALE</div>
                                </div>

                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product2.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">�����-���� Simba Minnie Mouse </a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="logosContainer">
                                    <div class="discountLogoWrapper">-25%</div>
                                    <div class="bestLogoWrapper">BEST</div>
                                    <div class="newLogoWrapper">NEW</div>
                                    <div class="freshLogoWrapper">FRESH</div>
                                    <div class="saleLogoWrapper">SALE</div>
                                </div>

                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product3.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="logosContainer">
                                    <div class="discountLogoWrapper">-25%</div>
                                    <div class="bestLogoWrapper">BEST</div>
                                    <div class="newLogoWrapper">NEW</div>
                                    <div class="freshLogoWrapper">FRESH</div>
                                    <div class="saleLogoWrapper">SALE</div>
                                </div>

                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product4.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="logosContainer">
                                    <div class="discountLogoWrapper">-25%</div>
                                    <div class="bestLogoWrapper">BEST</div>
                                    <div class="newLogoWrapper">NEW</div>
                                    <div class="freshLogoWrapper">FRESH</div>
                                    <div class="saleLogoWrapper">SALE</div>
                                </div>

                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product5.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="logosContainer">
                                    <div class="discountLogoWrapper">-25%</div>
                                    <div class="bestLogoWrapper">BEST</div>
                                    <div class="newLogoWrapper">NEW</div>
                                    <div class="freshLogoWrapper">FRESH</div>
                                    <div class="saleLogoWrapper">SALE</div>
                                </div>

                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product6.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="logosContainer">
                                    <div class="discountLogoWrapper">-25%</div>
                                    <div class="bestLogoWrapper">BEST</div>
                                    <div class="newLogoWrapper">NEW</div>
                                    <div class="freshLogoWrapper">FRESH</div>
                                    <div class="saleLogoWrapper">SALE</div>
                                </div>

                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product7.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="logosContainer">
                                    <div class="discountLogoWrapper">-25%</div>
                                    <div class="bestLogoWrapper">BEST</div>
                                    <div class="newLogoWrapper">NEW</div>
                                    <div class="freshLogoWrapper">FRESH</div>
                                    <div class="saleLogoWrapper">SALE</div>
                                </div>

                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product7.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="logosContainer">
                                    <div class="discountLogoWrapper">-25%</div>
                                    <div class="bestLogoWrapper">BEST</div>
                                    <div class="newLogoWrapper">NEW</div>
                                    <div class="freshLogoWrapper">FRESH</div>
                                    <div class="saleLogoWrapper">SALE</div>
                                </div>

                            </div>
                        </li>


                    </ul>
                    <ul class="productList" id="productList3">
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product1.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">�������</div>
                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product2.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">�������</div>
                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product3.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">�������</div>
                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product4.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">�������</div>
                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product5.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">�������</div>
                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product6.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">�������</div>
                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product7.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">�������</div>
                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product7.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">������� �������� ������ ����������</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">�������</div>
                            </div>
                        </li>


                    </ul>

                </div>

                <div class="hitsBlock">

                </div>

                <div class="lastProdBlock">

                </div>


            </div>
            <!--END productBlockWrapper-->
            <!--brandsWrapper-->
            <div class="brandsWrapper">
                <p class="brandTitle">������</p>

                <p class="brandText">� ����� �������� ������ ������������ ��������� �� ����������� ��������������.</p>

                <div class="brandPhotoWrapper">
                    <a href=""><img src="<?=DEFAULT_TEMPLATE_PATH?>files/brand1.jpg" alt=""/></a>
                    <a href=""><img src="<?=DEFAULT_TEMPLATE_PATH?>files/brand2.jpg" alt=""/></a>
                    <a href=""><img src="<?=DEFAULT_TEMPLATE_PATH?>files/brand3.jpg" alt=""/></a>
                    <a href=""><img src="<?=DEFAULT_TEMPLATE_PATH?>files/brand4.jpg" alt=""/></a>
                    <a href=""><img src="<?=DEFAULT_TEMPLATE_PATH?>files/brand5.jpg" alt=""/></a>
                    <a href=""><img src="<?=DEFAULT_TEMPLATE_PATH?>files/brand6.jpg" alt=""/></a>
                    <a href=""><img src="<?=DEFAULT_TEMPLATE_PATH?>files/brand7.jpg" alt=""/></a>
                    <a href=""><img src="<?=DEFAULT_TEMPLATE_PATH?>files/brand8.jpg" alt=""/></a>
                </div>
            </div>
            <!--END brandsWrapper-->
            <!--partnerReviews-->
            <div class="productCarousel partnerReviews">
                <!-- <div class="rightArrow"></div>
                <div class="leftArrow"></div>-->
                <p class="partnerTitle">������ ���������</p>

                <p class="partnerText">�� 10 ��� ������ �� ����� �� ��������������� ����</p>


                <!--jcarousel-wrapper-->
                <div class="jcarousel-wrapper">
                    <!--jcarousel-->
                    <div class="jcarousel">
                        <ul>
                            <li>
                                <div class="reviesElement">
                                    <p class="reviesCity">������������</p>

                                    <p class="reviewsTitle">�������� �������, ������ ����</p>

                                    <p class="reviewsText">������� ������� � ���� �������� �� ������ ���. �������� ��.
                                        �����,
                                        ������������.</p>

                                    <div class="authorsBlock">
                                        <p class="reviewsAuthor">�������� �������</p>

                                        <p>CEO, ������� ���</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="reviesElement">
                                    <p class="reviesCity">������������</p>

                                    <p class="reviewsTitle">�������� �������, ������ ����</p>

                                    <p class="reviewsText">������� ������� � ���� �������� �� ������ ���. �������� ��.
                                        �����,
                                        ������������.</p>

                                    <div class="authorsBlock">
                                        <p class="reviewsAuthor">����� �������</p>

                                        <p>����������� ��������, Lapsi</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="reviesElement">
                                    <p class="reviesCity">������������</p>

                                    <p class="reviewsTitle">�������� �������, ������ ����</p>

                                    <p class="reviewsText">������� ������� � ���� �������� �� ������ ���. �������� ��.
                                        �����,
                                        ������������.</p>

                                    <div class="authorsBlock">
                                        <p class="reviewsAuthor">���������� �������</p>

                                        <p>��������, Enter</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="reviesElement">
                                    <p class="reviesCity">������������</p>

                                    <p class="reviewsTitle">�������� �������, ������ ����</p>

                                    <p class="reviewsText">������� ������� � ���� �������� �� ������ ���. �������� ��.
                                        �����,
                                        ������������.</p>

                                    <div class="authorsBlock">
                                        <p class="reviewsAuthor">�������� �������</p>

                                        <p>CEO, ������� ���</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <a href="" class="jcarousel-control-prev"></a>
                    <a href="" class="jcarousel-control-next"></a>

                </div>
                <!--END jcarousel-wrapper-->
                <!--confidenceWrapper-->
                <div class="confidenceWrapper">
                    <p class="confidensTitle">��� ��������</p>
                    <p class="confidensText">�� 10 ��� ������ �� ����� �� ��������������� ����, ��� ���������
                        ��������.</p>
                    <a href=""><img src="<?=DEFAULT_TEMPLATE_PATH?>files/confidPhoto1.png" alt=""/></a>
                    <a href=""><img src="<?=DEFAULT_TEMPLATE_PATH?>files/confidPhoto2.png" alt=""/></a>
                    <a href=""><img src="<?=DEFAULT_TEMPLATE_PATH?>files/confidPhoto3.png" alt=""/></a>
                    <a href=""><img src="<?=DEFAULT_TEMPLATE_PATH?>files/confidPhoto4.png" alt=""/></a>
                </div>
                <!--END confidenceWrapper-->
            </div>
            <!--END partnerReviews-->
        </div>
        <!--END widthWrapper-->
    </div>
    <!--END backgroundColor-->
    </main>
    <!--END main-->

