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
                    <div class="active" data-id='1'>Новинки</div>
                    <div data-id='2'>Хиты продаж</div>
                    <div data-id='3'>Последние поступления</div>
                </div>

                <div class="newsBlock">
                    <p class="showAllLink"><a href="">Посмотреть все</a></p>

                    <p class="blockTitle">Ознакомьтесь со всеми новинками нашей компании. Кроватки, коляски, матрасы и
                        прочие товары, которые вы ждете.</p>


                    <ul class="productList" id="productList1">
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product1.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>

                            </div>
                        </li>
                        <li>
                            <!--productWrapper-->
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product2.jpg" alt=""/></a>
                                <div>
                                    <a href="" class="productName">Кукла-пупс Simba Minnie Mouse </a>
                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>
                            </div>
                            <!--END productWrapper-->
                        </li>
                        <li>
                            <!--productWrapper-->
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product3.jpg" alt=""/></a>
                                <div>
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>
                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>

                            </div>
                            <!--END productWrapper-->
                        </li>
                        <li>
                            <!--productWrapper-->
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product4.jpg" alt=""/></a>
                                <div>
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>
                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>
                            </div>
                            <!--END productWrapper-->
                        </li>
                        <li>
                            <!--productWrapper-->
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product5.jpg" alt=""/></a>
                                <div>
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>
                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>
                            </div>
                            <!--END productWrapper-->
                        </li>
                        <li>
                            <!--productWrapper-->
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product6.jpg" alt=""/></a>
                                <div>
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>
                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>
                            </div>
                            <!--END productWrapper-->
                        </li>
                        <li>
                            <!--productWrapper-->
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product7.jpg" alt=""/></a>
                                <div>
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>
                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a></div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>
                            </div>
                            <!--END productWrapper-->
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product7.jpg" alt=""/></a>
                                <div>
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>
                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a></div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>

                            </div>
                        </li>


                    </ul>
                    <ul class="productList" id="productList2">
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product1.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

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
                                    <a href="" class="productName">Кукла-пупс Simba Minnie Mouse </a>

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
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

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
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

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
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

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
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

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
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

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
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

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
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>
                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product2.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>
                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product3.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>
                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product4.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>
                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product5.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>
                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product6.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>
                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product7.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>
                            </div>
                        </li>
                        <li>
                            <div class="productWrapper">
                                <p class="price">25 800<span class="rub">c</span></p>
                                <a href="" class="productimg"><img src="<?=DEFAULT_TEMPLATE_PATH?>files/product7.jpg" alt=""/></a>

                                <div>
                                    <a href="" class="productName">Детская кроватка Магико поперечный</a>

                                    <div class="productLikeBlock changingLike"><a href="" class="blockLink"></a></div>
                                    <div class="productBasketBlock changingBasket"><a href="" class="blockLink"></a>
                                    </div>
                                </div>
                                <div class="newProductWrapper">Новинка</div>
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
                <p class="brandTitle">Бренды</p>

                <p class="brandText">В нашем магазине только качественная продукция от проверенных производителей.</p>

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
                <p class="partnerTitle">Отзывы партнеров</p>

                <p class="partnerText">За 10 лет работы на рынке мы зарекомендовали себя</p>


                <!--jcarousel-wrapper-->
                <div class="jcarousel-wrapper">
                    <!--jcarousel-->
                    <div class="jcarousel">
                        <ul>
                            <li>
                                <div class="reviesElement">
                                    <p class="reviesCity">Екатеринбург</p>

                                    <p class="reviewsTitle">Отличный магазин, лучшие цены</p>

                                    <p class="reviewsText">Покупаю технику в этом магазине не первый раз. Нравится всё.
                                        Выбор,
                                        обслуживание.</p>

                                    <div class="authorsBlock">
                                        <p class="reviewsAuthor">Виктория Фролова</p>

                                        <p>CEO, Детский Мир</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="reviesElement">
                                    <p class="reviesCity">Екатеринбург</p>

                                    <p class="reviewsTitle">Отличный магазин, лучшие цены</p>

                                    <p class="reviewsText">Покупаю технику в этом магазине не первый раз. Нравится всё.
                                        Выбор,
                                        обслуживание.</p>

                                    <div class="authorsBlock">
                                        <p class="reviewsAuthor">Мария Егорова</p>

                                        <p>Генеральный директор, Lapsi</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="reviesElement">
                                    <p class="reviesCity">Екатеринбург</p>

                                    <p class="reviewsTitle">Отличный магазин, лучшие цены</p>

                                    <p class="reviewsText">Покупаю технику в этом магазине не первый раз. Нравится всё.
                                        Выбор,
                                        обслуживание.</p>

                                    <div class="authorsBlock">
                                        <p class="reviewsAuthor">Константин Федоров</p>

                                        <p>Директор, Enter</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="reviesElement">
                                    <p class="reviesCity">Екатеринбург</p>

                                    <p class="reviewsTitle">Отличный магазин, лучшие цены</p>

                                    <p class="reviewsText">Покупаю технику в этом магазине не первый раз. Нравится всё.
                                        Выбор,
                                        обслуживание.</p>

                                    <div class="authorsBlock">
                                        <p class="reviewsAuthor">Виктория Фролова</p>

                                        <p>CEO, Детский Мир</p>
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
                    <p class="confidensTitle">Нам доверяют</p>
                    <p class="confidensText">За 10 лет работы на рынке мы зарекомендовали себя, как надежного
                        партнера.</p>
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

