<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
IncludeTemplateLangFile(__FILE__);
$templateLibrary = array('popup');
$currencyList = '';
if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = array(
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_sticker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
	'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'BASIS_PRICE' => $strMainID.'_basis_price',
	'BUY_LINK' => $strMainID.'_buy_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
	'BASKET_ACTIONS' => $strMainID.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	: $arResult['NAME']
);
$strAlt = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	: $arResult['NAME']
);
?>
<?
if ('Y' == $arParams['DISPLAY_NAME'])
{
?>
<div class="bx_item_title"><h1><span><?
	echo (
		isset($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != ''
		? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
		: $arResult["NAME"]
	); ?>
</span></h1></div>
<?
}
reset($arResult['MORE_PHOTO']);
$arFirstPhoto = current($arResult['MORE_PHOTO']);

?>
	<!--productCardImg-->

    <div class="productCardImg">
        <!--logosContainer-->
        <div class="logosContainer">
        	<?
        	if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']) {
				if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS'])) {
					if (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF']) { ?>
						<div class="discountLogoWrapper" id="<? echo $arItemIDs['DISCOUNT_PICT_ID'] ?>"><? echo -$arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>
				<?	}
				} else {
					foreach ($arResult['OFFERS'] as $offer) {
						if (0 < $offer['MIN_PRICE']['DISCOUNT_DIFF']) { ?>
							<div class="discountLogoWrapper" style="display: none" id="discount_label_<?= $offer['ID'] ?>"><? echo -$arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>
						<? } ?>
					<? } ?>
			<?	}
			} ?>
            <!--<div class="bestLogoWrapper">BEST</div>-->
            <?//шильдик новинки. Если товар  создан менее 2 недель назад
               if (date("U") - 86400 * NEW_PRODUCT_STATUS_LENGTH <= MakeTimeStamp($arResult["DATE_CREATE"], "DD.MM.YYYY HH:MI:SS")) {
            ?>
                <div class="newLogoWrapper" title="<?=GetMessage("NEW_PRODUCT")?>">NEW</div>
            <?}?>
            <!-- <div class="freshLogoWrapper">FRESH</div>
            <div class="saleLogoWrapper">SALE</div>-->
        </div>
        <!--END logosContainer-->
        <!--previewImg-->
        <div class="previewImg">

        	<a class="fancybox" href="<?= $arFirstPhoto['SRC'] ?>">
            	<img id="<? echo $arItemIDs['PICT']; ?>" src="<?= getResizedImage($arFirstPhoto['ID'], ELEMENT_CARD_MAIN_WIDTH, ELEMENT_CARD_MAIN_HEIGHT, BX_RESIZE_IMAGE_PROPORTIONAL_ALT) ?>" alt="<? echo $strAlt; ?>" title="<? echo $strTitle; ?>">
        	</a>
        </div>
        <!--END previewImg-->
        <!--smallPreviewImg-->
        <div class="smallPreviewImg">
        	<div class="previews_slider_navigation_arrow" data-preview-slider-direction="prev"><span></span></div>
        	<div class="previews_slider_navigation_arrow" data-preview-slider-direction="next"><span></span></div>
        	<div id="previews_slider_wrapper">
	        <? if (is_array($arResult['MORE_PHOTO'])) { ?>
	        	<? foreach ($arResult['MORE_PHOTO'] as &$arOnePhoto) { ?>
					<a href="<?= $arOnePhoto['SRC'] ?>" data-preview-image="<?= getResizedImage($arOnePhoto['ID'], ELEMENT_CARD_MAIN_WIDTH, ELEMENT_CARD_MAIN_HEIGHT, BX_RESIZE_IMAGE_PROPORTIONAL_ALT) ?>">
						<img src="<?= getResizedImage($arOnePhoto['ID'], ELEMENT_CARD_PREVIEW_WIDTH, ELEMENT_CARD_PREVIEW_HEIGHT, BX_RESIZE_IMAGE_PROPORTIONAL_ALT) ?>" alt=""/>
					</a>
				<? } ?>
			<? }
				if (is_array($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])) {
					foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $photo_id) { ?>
						<a href="<?= CFile::GetPath($photo_id) ?>" data-preview-image="<?= getResizedImage($photo_id, ELEMENT_CARD_MAIN_WIDTH, ELEMENT_CARD_MAIN_HEIGHT, BX_RESIZE_IMAGE_PROPORTIONAL_ALT) ?>">
							<img src="<?= getResizedImage($photo_id, ELEMENT_CARD_PREVIEW_WIDTH, ELEMENT_CARD_PREVIEW_HEIGHT, BX_RESIZE_IMAGE_PROPORTIONAL_ALT) ?>" alt=""/>
						</a>
				<? 	}
				}
				unset($arOnePhoto);
				// фотки предложений
				if (isset($arResult['OFFERS']) || !empty($arResult['OFFERS'])) {
					foreach ($arResult['OFFERS'] as $offer) { ?>
						<?
						// если фото в поле превью
						if (isset($offer['DETAIL_PICTURE']) || !empty($offer['DETAIL_PICTURE'])) {
						?>
							<a data-preview-offer-id="<?= $offer["ID"] ?>" href="<?= $offer['DETAIL_PICTURE']['SRC'] ?>" data-preview-image="<?= getResizedImage($offer['DETAIL_PICTURE']['ID'], ELEMENT_CARD_MAIN_WIDTH, ELEMENT_CARD_MAIN_HEIGHT, BX_RESIZE_IMAGE_PROPORTIONAL_ALT) ?>">
								<img src="<?= getResizedImage($offer['DETAIL_PICTURE']['ID'], ELEMENT_CARD_PREVIEW_WIDTH, ELEMENT_CARD_PREVIEW_HEIGHT, BX_RESIZE_IMAGE_PROPORTIONAL_ALT) ?>" alt=""/>
							</a>
						<? } ?>
				<? 	}
				}
			?>
			</div>
		</div>
        <!--END smallPreviewImg-->
    </div>
    <!--END productCardImg-->
     <!--productCardDesc-->
    <div class="productCardDesc">
        <div class="productTitle">
			<ul>
				<li class="active" data-product-tab="1">О товаре</li>
				<li data-product-tab="2">Описание</li>
			</ul>
        </div>
        <div class="product_card_tabs_wrapper">
        	<div class="product_info_tab_content" data-product-tab="1">
        		<div class="productInfo">
		            <div class="brandText">
		            	<strong>Бренд:</strong>
		            	            	<a href="/brands/68368/">
		            		SKV company            	</a>
					</div>
		            <div class="productArticle">
		            	<strong>Артикул:</strong>
		            	 SKV_5500            
					</div>
					<div class="productColor horizontalFilterWrap">
			            <strong>Цвет:</strong>
			            <div class="firstFilter item_card_offers">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <p data-sort="" data-offer-id="66783" id="activeFirstFilt" data-item-can-buy="47" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66783" class="firstFiltElement1"><span class="col"><img src="/img/offers_mini.png"></span>Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка</p>
			                <div class="hidingMenu" style="display: none;">
	                			<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
								<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
								<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
								<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option active_offer_option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
	                			<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
								<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
								<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
								<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
	                			<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
								<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
								<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
								<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
	                			<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
								<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
								<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
								<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
	                			<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
								<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
								<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
								<p data-offer-id="66786" data-item-can-buy="27" data-offer-buy-link="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66786" class="js-offer-option"><span class="col_offer"><img src="/img/offers_mini.png"></span><span class="offer_option_text">Кровать детская СКВ-5 Жираф, опуск.бокю.,маятник,полка,3</span><span class="offer_option_status"></span></p>
							</div>
			            </div>
			        </div>

				</div>
				<table class="product_info_table">
					<tr class="product_info_table_headers">
						<td>Количество</td>
						<td>Стоимость</td>
					</tr>
					<tr class="quantity_price_row">
						<td>
							<div class="productCount">
					            <div class="middleSelectBlock">
					                <div class="elementQuant">
					                    <div>
											<input id="bx_117848907_66482_quantity" type="text" class="quantityText" data-quantity-variable="quantity" value="1" disabled>
					                        <span class="quantity_container">
					                        	<a href="" class="quantityMinus"></a>
					                        	<a href="" class="quantityPlus"></a>
					                        </span>
					                    </div>
					                </div>
					            </div>
					        </div>
						</td>
						<td>
							<div class="productPrice">
								<span class="actual_price">6 160 <span class="rub">c</span></span>
					        </div>
		                    <div class="productPrice" data-price-offer-id="66783" style="display: none">
								<span class="actual_price">6 160 <span class="rub">c</span></span>
					        </div>
		        	        <div class="productPrice" data-price-offer-id="66784" style="display: none">
								<span class="actual_price">6 160 <span class="rub">c</span></span>
					        </div>
		        	        <div class="productPrice" data-price-offer-id="66785" style="display: none">
								<span class="actual_price">6 160 <span class="rub">c</span></span>
					        </div>
		        	        <div class="productPrice" data-price-offer-id="66786" style="display: none">
								<span class="actual_price">6 160 <span class="rub">c</span></span>
					        </div>
						</td>
					</tr>
					<tr class="buttons_row">
						<td>
							<div class="productComment">
            					<a href="javascript:void(0);">Задать вопрос</a>
        					</div>
        				</td>
						<td>
							<div class="productFavorites">
            					<a href="javascript:void(0)" class="js_add_to_favorite" data-favorite-product-id="66482" data-favorite-delete="" data-favorite-item-id="">
            						В избранное
            					</a>
        					</div>
						</td>
					</tr>
				</table>
				<a href="/catalog/krovatki_i_komody/krovatki/krovat_detskaya_skv_5_zhiraf_opusk_bokyu_mayatnik_polka_3_yashchika/?action=ADD2BASKET&amp;id=66783" data-offer-id="66783" data-item-have-offers="1" data-main-item-id="66482" class="js-add-to-basket addBtn"><span></span>Добавить в корзину</a>
				<span id="bx_117848907_66482_not_avail" class="bx_notavailable" style="display: none;">Нет в наличии</span>
        	</div>
        	<div class="product_info_tab_content" data-product-tab="2">
				<div class="product_card_description">
					Натуральный материал, привлекательный дизайн и демократичная цена - вот главные преимущества кроваток Кубаньлесстрой. Кроватка изготовлена из массива бука, древесина которого долговечна и не боится влаги. Для покрытия используются только нетоксичные краски и лаки. Благодаря отсутствию острых углов и расстоянию между рейками в 80 мм кроватка будет безопасна для малыша. Рейки в кровати овального сечения, чтобы ручки ребенка не прокручивались, когда он держится за них.
        			
        			В первые месяцы кроватку, можно использовать как качалку. Позже, когда необходимость в этом исчезнет, установите колесики, зафиксировав этим кроватку.
        			Натуральный материал, привлекательный дизайн и демократичная цена - вот главные преимущества кроваток Кубаньлесстрой. Кроватка изготовлена из массива бука, древесина которого долговечна и не боится влаги. Для покрытия используются только нетоксичные краски и лаки. Благодаря отсутствию острых углов и расстоянию между рейками в 80 мм кроватка будет безопасна для малыша. Рейки в кровати овального сечения, чтобы ручки ребенка не прокручивались, когда он держится за них.
        			
        			В первые месяцы кроватку, можно использовать как качалку. Позже, когда необходимость в этом исчезнет, установите колесики, зафиксировав этим кроватку.
        		</div>
        	</div>
        </div>
    </div>
    <!--LAYOUT END-->
    <!--END productCardDesc-->
    <div class="basketBody tabs">
    <div class="basketBodyMenu tabsLinks">
        <a href="#characters" class="active js_tabs"><?= GetMessage("CT_CHARACTERISTICS") ?></a>
        <? if (is_array($arResult['PROPERTIES']['FILES']['VALUE']) && !empty($arResult['PROPERTIES']['FILES']['VALUE'])) { ?>
        	<a href="#docs" class="js_tabs"><?= GetMessage("CT_DOCS") ?></a>
        <? } ?>
        <!--<a href="#video">Видео</a>-->
    </div>
    <div id="characters" class="basketBlock productSlider" style="display: block">
		<div id="characteristics_wrapper">

			<? foreach ($arResult['DISPLAY_PROPERTIES'] as $property_code => $property) { ?>

				<? if ($property['VALUE'] && !is_array($property['VALUE'])) { ?>
				    <div class="characteristics_block">
					    <div class="characteristic_title"><?= $property['NAME'] ?>:</div>
					    <div class="characteristic_value"><?= $property['VALUE'] ?></div>
				    </div>
				<? } ?>
                <?if($property["VALUE"][2] && is_array($property['VALUE'])){?>
                    <div class="characteristics_block">
                        <div class="characteristic_title"><?= $property["DESCRIPTION"][2] ?>:</div>
                        <div class="characteristic_value"><?= $property['VALUE'][2] ?></div>
                    </div>
                <?}?>
			<? } ?>
		</div>
    </div>
    <? if (is_array($arResult['PROPERTIES']['FILES']['VALUE']) && !empty($arResult['PROPERTIES']['FILES']['VALUE'])) { ?>
    <div id="docs" class="basketBlock productSlider" style="display: none">
        <!--jcarousel-wrapper-->
        <div class="jcarousel-wrapper">
            <!--jcarousel-->
            <div class="jcarousel">
                <ul>
                <?
			    $files_count = count($arResult['PROPERTIES']['FILES']['VALUE']);
			    foreach ($arResult['PROPERTIES']['FILES']['VALUE'] as $file_id) {
			    	$file = CFile::GetFileArray($file_id);
					$file_name = array_shift(explode(".", $file['FILE_NAME']));?>
					<li>
                        <div class="reviesElement">
                            <div class="productWrapper">
                                <a href="<?= $file['SRC'] ?>" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="<?= $file['SRC'] ?>" class="infoDocDownload" download></a>
                                <p class="infoDocName"><?= $file_name ?></p>
                            </div>
                        </div>
                    </li>
			    <? } ?>
                </ul>
            </div>
            <? if ($files_count > 4) { ?>
	            <a href="" class="jcarousel-control-prev"></a>
	            <a href="" class="jcarousel-control-next"></a>
            <? } ?>
        </div>
        <!--END jcarousel-wrapper-->
    </div>
    <? } ?>
    <div id="video" class="basketBlock productSlider" style="display: none">
        <!--jcarousel-wrapper-->
        <div class="jcarousel-wrapper">
            <!--jcarousel-->
            <div class="jcarousel">
                <ul>
                    <li>
                        <div class="reviesElement">
                            <div class="productWrapper">

                                <a href="" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="" class="infoDocDownload"></a>
                                <p class="infoDocName">Инструкция по сборке</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="reviesElement">
                            <div class="productWrapper">
                                <a href="" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="" class="infoDocDownload"></a>
                                <p class="infoDocName">Инструкция по сборке</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="reviesElement">
                            <div class="productWrapper">
                                <a href="" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="" class="infoDocDownload"></a>
                                <p class="infoDocName">Инструкция по сборке</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="reviesElement">
                            <div class="productWrapper">
                                <a href="" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="" class="infoDocDownload"></a>
                                <p class="infoDocName">Инструкция по сборке</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="reviesElement">
                            <div class="productWrapper">
                                <a href="" class="productimg"><img src="/img/pdf.png" alt=""></a>
                                <a href="" class="infoDocDownload"></a>
                                <p class="infoDocName">Инструкция по сборке</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <a href="" class="jcarousel-control-prev"></a>
            <a href="" class="jcarousel-control-next"></a>
        </div>
        <!--END jcarousel-wrapper-->
    </div>
</div>
    <!--Catalog form-->
    <div class="hiddenProductComment" style="display: none;">
        <p class="authClose"></p>
        <form method="post" id="leave_question_catalog">
            <p class="authTitle"><?= GetMessage("FORM_TITLE") ?></p>
            <input type="text" placeholder="Представьтесь" name="name" class="nameInput">
            <input type="text" placeholder="Почта" name="email" class="emailInput">
            <input type="text" placeholder="Телефон" name="phone" class="emailInput phoneInput">
            <input type="text" placeholder="Название компании" name="company" class="nameInput">
            <textarea placeholder="Текст вопроса" name="text"></textarea>
            <input type="hidden" name="product_id" value="<?=$arResult["ID"]?>" >
            <input type="hidden" name="product_href" value="<?= isset($_SERVER["HTTPS"]) ? 'https' : 'http' .  "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" >
            <input type="hidden" name="form_type" value="<?= QUESTION_PRODUCT_CARD ?>" >
            <input type="submit" class="btn" name="submit" value="<?= GetMessage("FORM_SEND_QUESTION") ?>" >
            <p class="description"><?= GetMessage("FORM_FIELDS_REQUIRED") ?></p>
        </form>
        <div class="message">
            <?= GetMessage("FORM_QUESTION_ACCEPTED") ?>
        </div>
    </div>
     <!--END Catalog form-->
