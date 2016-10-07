$(document).ready(function () {



    /****************************************/
    //ГЛАВНАЯ
    //скрыть/показать левое меню (на главной странице) при клике на каталог товаров
    var isMainPage = ($("body").hasClass("mainPage"));
    $('.menuControle').on("click", function (e) {
    	e.preventDefault();
        var el = $(this),
        menu = isMainPage ? $('.thirdLevel .mainLeftMenu') : $('.thirdLevel .mainLeftMenu,.thirdLevel'),
        banner = $('.thirdLevel .mainBigBanner');
        if (el.hasClass("activeBlock")) {
            el.removeClass("activeBlock").removeAttr('id').attr('id', 'secondLvlBlocks4');
            if (isMainPage) {

                banner.css('width', '880px');
                banner.find("li").css('width', '880px');
                $(".mainLeftMenu").hide();
            } else {
                menu.fadeOut(300);
            }

        } else {
            menu.fadeIn(300);
            el.addClass("activeBlock").removeAttr('id').attr('id', 'secondLvlBlocks1');
            if (isMainPage) {

                banner.css('width', '580px');
                $(".mainLeftMenu").show();
                banner.find("li").css('width', '580px');
            } else {
                menu.fadeIn(300);
            }
        }
        var index = banner.find(".jcarousel-pagination .active").attr("item");
        index = parseInt(index.replace("#", ""), 10) - 1;
        banner.find('.jcarousel').jcarousel('scroll', index, false);
        setTimeout(function () {
            banner.find('.jcarousel').jcarousel('scroll', index, false);
            }, 300);


        $('.mainLeftMenu>ul>div>div>li').each(function () {
            var el = $(this);
            el.find("ul .activeFirstLclLi").removeClass("activeFirstLclLi");
            $('.secondLvlCatalog').hide();
            el.removeClass('activeLiTopMenuFirstLvl');
            $('.mainLeftMenu>ul>div>div>li').not(el[0]).show();
            el.css("top", 0);
            $(".bottomBlockMailLeft").hide();
            el.find(".secondLvl").hide();

        });

    });

    //кастом скролбар меню в шапке
    var els = $('.secondLvlLeftMenu ul, .secondLvlCatalog, .mainLeftMenu>ul, .locationWrapper .list, .productInfo');
    if (els.length > 0) {
        els.mCustomScrollbar({
            theme: "dark-thin"
        });
    }
    $(".hidingMenu").show().mCustomScrollbar({
        theme: "dark-thin"
    });
    $(".hidingMenu").hide();

    $('.mainLeftMenu>ul>div>div>li').on("mouseenter", function () {
        var el = $(this);

        if (!el.hasClass("activeLiTopMenuFirstLvl")) {
            el.addClass("hover");
        }
    }).on("mouseleave", function () {
        $(this).removeClass("hover");
    });

    //меню каталог товаров на главной
    $(".secondLvl a").on("click", function (e) {
    	e.preventDefault();
        window.location.href = $(this).attr("href");
    });
    $('.mainLeftMenu>ul>div>div>li').on("click", function () {
        var el = $(this);
        el.removeClass("hover");
        if (el.find("ul").length > 0) {
            if (!el.hasClass('activeLiTopMenuFirstLvl')) {
                var position = el.position();


                $('.mainLeftMenu>ul>div>div>li').not(el[0]).hide();
                el.css({'top': position.top});
                setTimeout(animateLiMoving, 0, el[0], position);
            }

        }


    });
    $('.mainLeftMenu>ul>div>div>li>a').on("click", function (e) {
    	e.preventDefault();
        var el = $(this).parent();
        el.removeClass("hover");
        if (el.find("ul").length > 0) {

            if (el.hasClass('activeLiTopMenuFirstLvl')) {
                $('.secondLvlCatalog .mCSB_draggerContainer').css("visibility", "hidden");

                $('.secondLvlCatalog').slideUp(500);
                setTimeout(function () {
                    el.removeClass('activeLiTopMenuFirstLvl');

                    setTimeout(function () {
                        el.animate({'top': el.attr("data-pos")}, 300, function () {
                            $('.mainLeftMenu>ul>div>div>li').not(el[0]).show();
                            el.css("top", 0);

                            $(".bottomBlockMailLeft").hide();
                            el.find(".secondLvl").hide();
                            $('.secondLvlCatalog .mCSB_draggerContainer').css("visibility", "visible");
                        });
                        }, 300);

                    }, 500);


                el.find("ul .activeFirstLclLi").removeClass("activeFirstLclLi");


            } else {
                el.click();
            }


        }
    });
    $(".bottomBlockMailLeft .link1").on("click", function (e) {
    	e.preventDefault();
        var el = $(this).closest(".mainLeftMenu");
        el.find(".firstLvlLi").addClass("activeFirstLclLi");
        el.find(".firstLvlLi").find(".secondLvl").slideDown(300);
        el.find(".link2").show();
        $(this).hide();
    });
    $(".bottomBlockMailLeft .link2").on("click", function (e) {
    	e.preventDefault();
        var el = $(this).closest(".mainLeftMenu");
        el.find(".firstLvlLi").removeClass("activeFirstLclLi");
        el.find(".firstLvlLi").find(".secondLvl").slideUp(300);
        el.find(".link1").show();
        $(this).hide();

    });

    $(".firstLvlLi>a").on("click", function (e) {
		e.preventDefault();
        var el = $(this).closest(".mainLeftMenu").find(".activeFirstLclLi");
        if (el.length == 0) {
            $(".bottomBlockMailLeft .link1").show();
            $(".bottomBlockMailLeft .link2").hide();
        } else {
            $(".bottomBlockMailLeft .link2").show();
            $(".bottomBlockMailLeft .link1").hide();
        }

    });


    //верхнее меню переключение
    $('#secondLvlBlocks2 li a').on("click", function (e) {
        $('#secondLvlBlocks2 li a').removeClass('active');
        $(this).addClass('active');
    });
    //скрывать выпадающее меню select по клику на вне области

    var customFilters = [{c: 'firstFilter', p: '#activeFirstFilt'},
        {c: 'secondFilter', p: '#activeSecondFilt'},
        {c: 'quantOnPageFilt', p: '#activeQuantOnPage'},
        {c: 'quantOnPageFiltBot', p: '#activeQuantOnPageBot'},
        {c: 'goToPageFilter', p: '#nowPageBlock'}];
    for (var i = 0; i < customFilters.length; i++) {
        pullDownMenu('.' + customFilters[i].c, customFilters[i].p);
    }

    $(document).on("click", function (e) {
        var el = $(e.target), menu = $(".hidingMenu"), flag = false;
        for (var i = 0; i < customFilters.length; i++) {
            if (el.hasClass(customFilters[i].c) || el.closest("." + customFilters[i].c).length > 0) {

                var el1 = el.closest("." + customFilters[i].c).find('.hidingMenu');
                if (el1.css("display") == "none") {
                    menu.parent().removeClass("active");
                    menu.hide();

                } else {
                    menu.parent().removeClass("active");
                    menu.hide();
                    el.closest("." + customFilters[i].c).find('.hidingMenu').show();
                    el.closest("." + customFilters[i].c).find('.hidingMenu').parent().addClass("active");

                }
                flag = true;
            }
        }
        if (!flag) {
            menu.parent().removeClass("active");
            menu.hide();

        }

    });


    //подклюдчение плагина кастомизированного селекта
    if ($('select').length > 0) {
        $('select').selectric({
            onChange: function (e) {
                var el = $(this).parent().parent(), val = el.find("select").val();
                if (el.closest(".hiddenQuestionBlock").length > 0) {
                    if (val == -1) {
                        el.removeClass("no-empty");
                    } else {
                        el.addClass("no-empty");
                    }
                }

                $(e).change();
            }
        });
        $(".selectric").on("click", function () {
            var el = $(this);
            el.removeClass("error");
            el.find(".label").text(el.find(".label").attr("data-value"));


            $(".hidingMenu").parent().removeClass("active");
            $(".hidingMenu").hide();
        });

    }



    function changeCount(el, plus) {
        var el1 = el, el = el.parent().find(".quantityText"),
        count = parseFloat(el.val()),
        price = parseFloat(el.closest("tr").find(".price").val()),
        genPrice = el.closest("tr").find(".elementFinalPrice p") || el.closest("tr").find(".elementPrice p"),
        plus = el.parent().find(".quantityPlus"), minus = el.parent().find(".quantityMinus");
        plus.removeClass("inactive");
        minus.removeClass("inactive");

        if (el1.hasClass("quantityPlus")) count++; else count--;

        if (count <= 0) {
            count = 0;
            minus.addClass("inactive");
        }
        if (count >= 999) {
            count = 999;
            plus.addClass("inactive");
        }
        el.val(count);
        genPrice.text((count * price).toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));

    }

    $(".elementFinalPrice p").each(function () {
        var el = $(this), text = el.text();
        text = text.replace(/ /g, "");
        el.text((text).toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));
    });


    $(".quantityPlus").on("click", function (e) {
    	e.preventDefault();
        changeCount($(this), 1);

    });
    $(".quantityMinus").on("click", function (e) {
    	e.preventDefault();
        changeCount($(this), 0);
    });


    $(".quantityText").on("keydown", function () {
        // Разрешаем: backspace, delete, tab и escape
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 ||
            // Разрешаем: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Разрешаем: home, end, влево, вправо
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // Ничего не делаем
            return;
        } else {
            // убеждаемся, что это цифра, и останавливаем событие keypress
            if (event.shiftKey) event.preventDefault();
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();

            } else {
                return;
            }
        }
    }).change(function () {
        var el = $(this), plus = el.parent().find(".quantityPlus"), minus = el.parent().find(".quantityMinus"), count = parseFloat(el.val());

        plus.removeClass("inactive");
        minus.removeClass("inactive");
        if (count <= 0) {
            count = 0;
            minus.addClass("inactive");
        }
        if (count >= 999) {
            count = 999;
            plus.addClass("inactive");
        }
        el.val(count);
    });


    //elementPrice


    //блоки товаров на главной
    $('.productBlockMenu div').on("click", function () {
        $('.productBlockMenu div').removeClass('active');
        $(this).addClass('active');
        $('.productList').hide();
        $('#productList' + $(this).attr('data-id')).show();
    });
    $('#productList1').show();


    //кружочек корзина смена картинки при клике
    $('.changingBasket').on("click", function (e) {
        $(this).toggleClass("active");
    });

    //кружочек лайк смена картинки при клике
    $('.changingLike:not(.js_favorite_need_auth)').on("click", function () {
    	if (!$(this).children("a").hasClass("js_favorite_need_auth")) {
    		$(this).children("a").toggleClass("active");
    	}
    });


    //слайдер на главной отзывы партнеров
    ///карусель
    $('.jcarousel-wrapper').each(function () {
        var el = $(this);
        if (el.find(".jcarousel").children().length) {
	        el.find(".jcarousel").jcarousel({
	            wrap: 'circular', animation: 300
	        });
        }

        /*  el.find('.jcarousel-control-prev')
        .on('jcarouselcontrol:active', function () {
        $(this).removeClass('inactive');
        })
        .on('jcarouselcontrol:inactive', function () {
        $(this).addClass('inactive');
        })
        .jcarouselControl({
        target: '-=1'
        });*/
        el.find('.jcarousel-control-prev').off("click").on("click", function (e) {
        	e.preventDefault();
            el.find(".jcarousel ul").stop(true, true);
            el.find(".jcarousel").jcarousel('scroll', '-=1');
        });
        el.find('.jcarousel-control-next').off("click").on("click", function (e) {
        	e.preventDefault();
            el.find(".jcarousel ul").stop(true, true);
            el.find(".jcarousel").jcarousel('scroll', '+=1');
        });
        /*  el.find('.jcarousel-control-next')
        .on('jcarouselcontrol:active', function () {
        $(this).removeClass('inactive');
        refreshTimer();
        })
        .on('jcarouselcontrol:inactive', function () {
        $(this).addClass('inactive');
        })
        .jcarouselControl({
        target: '+=1'
        });*/


        el.find('.jcarousel-pagination').on('jcarouselpagination:active', 'a', function () {
            $(this).addClass('active');
            refreshTimer();
        }).on('jcarouselpagination:inactive', 'a', function () {
            $(this).removeClass('active');
        }).jcarouselPagination({
            item: function (page, carouselItems) {
                return '<a item="#' + page + '"></a>';
            }
        });

    });
    var time;

    function refreshTimer() {
        clearInterval(time);
        time = setInterval(function () {
            var el = $(".mainBigBanner .jcarousel");
            if (el.length > 0 && el.css("display") !== "none")
                el.jcarousel('scroll', '+=1');
            }, 7000);
    }

    refreshTimer();
    if (!$("body").hasClass("mainPage")) $(".thirdLevel").hide();


    //попапы


    var popupMask = $("<div />");
    popupMask.addClass("overflowMask");
    $("body").append(popupMask);
    popupMask.click(function () {
        //скрыть попапы
        popupMask.fadeOut(300);
        $('.hiddenQuestionBlock,.authHiddenBlock,.regHiddenBlock, .locationWrapper .list, .popup, .hiddenProductComment, .hidingFormNewTreatment, .hiddenOform').fadeOut(300);
    });


    //попап авторизация/восстановление пароля
    if ($('.authorisationLink').length > 0) {
        $('.authorisationLink a').on("click", function (e) {
			e.preventDefault();
            //показать попап
            $('.authHiddenBlock').show();

            //по умолчанию расрыта форма логина
            $('.authForm').show();
            $('.authorisationLink form').show();
            $('.forgotForm').hide();
            //скрыть сообщение после заполнения формы
            $('.authHiddenBlock .message').hide();

            //очисить все поля
            $('.authHiddenBlock form').each(function () {
                $(this).find("input,textarea").each(function () {
                    $(this).focus().blur();
                });
                this.reset();
            });
            $(".selectric").each(function () {
                var el = $(this);
                el.removeClass("error");
                var text = el.find(".label").text();
                el.find(".label").attr("data-value", el.find(".label").text());
            });


            //удалить выделение полей (ошибок заполнения)
            $('.authHiddenBlock .error').removeClass(".error");

            //показать маску
            popupMask.show();
        });
        $('.authHiddenBlock .authClose').on("click", function () {
            //скрыть попап авторизация/восстановление пароля
            $('.authHiddenBlock').hide();
            popupMask.fadeOut(300);
        });
    }

    //попап регистрация
    if ($('.registrationLink_fly').length > 0) {
        $('.registrationLink_fly a').on("click", function (e) {
        	e.preventDefault();
            //показать попап
            $('.regHiddenBlock').show();
            //по умолчанию расрыта форма
            $('.regHiddenBlock form').show();
            //скрыть сообщение после заполнения формы
            $('.regHiddenBlock .message').hide();
            //очисить все поля
            $('.regHiddenBlock form').each(function () {
                $(this).find("input,textarea").each(function () {
                    $(this).focus().blur();
                });
                this.reset();
            });
            //удалить выделение полей (ошибок заполнения)
            $('.regHiddenBlock form .error').removeClass(".error");
            //показать маску
            popupMask.show();
        });
        $('.regHiddenBlock .authClose').on("click", function () {
            $('.regHiddenBlock').hide();
            popupMask.fadeOut(300);
        });
    }
    //поиск
    $("#linkBlock1 a").on("click", function (e) {
    	e.preventDefault();
        $(".searchForm, .searchFormClose").fadeIn(300);
        $(".searchForm input,.searchForm textarea").each(function () {
            $(this).focus().blur();
        });
        $(".searchForm form")[0].reset();
    });
    $(".searchFormClose").on("click", function () {
        $(".searchForm, .searchFormClose").fadeOut(300);
    });


    $(".searchForm input").on("focus", function () {
        $(this).closest(".searchForm").addClass("focus");
    }).blur(function () {
        $(this).closest(".searchForm").removeClass("focus");

    });

    //скрипты для всплывайки "оставить вопрос"

    $(".cancelInp").on("click", function(){
        $(this).closest("form").find("input,textarea").removeClass("error");
        $(this).closest("form")[0].reset();

    });


    var popups = [{popupEl: $('.hiddenQuestionBlock'), btnEl: $('.writeCreatorBlock p')},
        {popupEl: $('.hiddenProductComment'), btnEl: $('.productComment a')}];
    for (var i = 0; i < popups.length; i++) {
        popups[i].btnEl.each(function () {
            var el = $(this), popup = popups[i].popupEl, win = $(window);
            el.on("click", function () {

                //показать форму
                popup.show();


                if (popup.hasClass('hiddenProductComment')) {
                    var top = (win.height() - popup.height() ) ;
                    popup.css({top: win.scrollTop() - top});
                }


                //по умолчанию расрыта форма
                $('.hiddenQuestionBlock form').show();
                //скрыть сообщение после заполнения формы
                $('.hiddenQuestionBlock .message').hide();
                //очисить все поля
                $('.hiddenQuestionBlock form').each(function () {
                    $(this).find("input,textarea").each(function () {
                        $(this).focus().blur();
                    });
                    this.reset();
                });
                popup.find("select").each(function () {
                    var el = $(this), val = el.val();
                    if (val == -1) {
                        var label = el.parent().parent().find(".selectric .label");

                        label.attr("data-value", label.text());
                        el.parent().parent().find(".selectric").addClass("error");
                        el.closest(".selectric").css("border", "1px solid #ddd");
                        el.closest(".selectric .label").css("color", "#5a5a5a");
                    }
                });
                popup.find(".selectric").each(function () {
                    var el = $(this);
                    el.removeClass("error");

                    el.parent().find("li[data-index=0]").click();
                });
                //удалить выделение полей (ошибок заполнения)
                $('.hiddenQuestionBlock .error').removeClass(".error");
                $(".hiddenQuestionBlock .selectric").css("border", "1px solid #d9d9d9");
                $(".hiddenQuestionBlock .selectric .label").css("color", "#5a5a5a");
                $(".hiddenQuestionBlock .no-empty").removeClass("no-empty");
                //показать маску
                popupMask.show();


            });

        });
    }


    $('.authClose').on('click', function () {
        $(this).parent().hide();
        popupMask.fadeOut(300);
    });

    $('body').on('blur', 'input, textarea', function () {
        var el = $(this);
        if (el.val() != '') {
            el.css({'border-color': '#818181', 'color': '#000'});
        } else {
            el.css({'border-color': 'rgb(217, 217, 217)', 'color': '#A6A6A6'});
        }
        if (el.hasClass("quantityText")) {
            el.css({'border-color': '#ddd', 'color': '#000'})
        }
        if (el.hasClass("selectric-input")) {
            el.closest(".selectric").css("border", "1px solid #ddd");
            el.closest(".selectric .label").css("color", "#5a5a5a");
            //   el.closest(".selectric-open").click();

        }
    });

    $('body').on('focus', 'input, textarea', function () {
        $(this).css({'border-color': '#83D0F5', 'color': '#000'});
        //удалить выделение полей (ошибок заполнения)
        // $('.hiddenQuestionBlock .error').removeClass(".error");

        $(".hiddenQuestionBlock .selectric").css("border", "1px solid #d9d9d9");
        $(".hiddenQuestionBlock .selectric .label").css("color", "#5a5a5a");
        //$(".hiddenQuestionBlock .no-empty").removeClass("no-empty");
    });

    $("input[type=text], textarea").on('focus', function () {
        $(".selectric-open").removeClass("selectric-open");
    });

    $('.hiddenQuestionBlock .selectric').on('click', function () {
        $(this).css({'border-color': '#83D0F5', 'color': '#48AAD8'});
        $('.hiddenQuestionBlock .selectric .label').css({'border-color': '#83D0F5', 'color': '#48AAD8'});
    })
    $('.hiddenQuestionBlock .selectric-items li').on('click', function () {
        $('.hiddenQuestionBlock .selectric').css({'border-color': '#818181', 'color': '#000'});
        $('.hiddenQuestionBlock .selectric .label').css({'border-color': '#818181', 'color': '#000'});
    });

    $('.questionInfoForm .selectric-items li').on('click', function () {
        $('.questionInfoForm .selectric').css({'border-color': '#818181', 'color': '#000'});
        $('.questionInfoForm .selectric .label').css({'border-color': '#818181', 'color': '#000'});
    });

    $(".callBackBlock a, .callBackBut").on("click", function () {
        var popup = $('#callBackPopup');
        //показать форму
        popup.show();
        var win = $(window);
        popup.css({top: win.scrollTop() + (win.height() - popup.height()) / 2});

        //по умолчанию расрыта форма
        popup.find('form').show();
        //скрыть сообщение после заполнения формы
        popup.find('.message').hide();
        //очисить все поля
        popup.find('form').each(function () {
            popup.find("input,textarea").each(function () {
                $(this).focus().blur();
            });
            this.reset();
        });
        $(".selectric").each(function () {
            var el = $(this);
            el.removeClass("error");
            var text = el.find(".label").text();
            if (text.indexOf("не запол") !== -1) {
                el.find(".label").attr("data-value", el.find(".label").text());
            }
        });
        //удалить выделение полей (ошибок заполнения)
        popup.find('.error').removeClass(".error");


        //показать маску
        popupMask.show();


    });

    $(".popup .close").on("click", function (e) {
    	e.preventDefault();
        $(this).parent().fadeOut(300);
        //показать маску
        popupMask.hide();
    });

    //валидация формы
    var el = $("input[name=phone]");
    if (el.length > 0) el.mask("(999) 999-9999");
    $("input,textarea").on("focus", function () {
        var el = $(this);
        if (el.hasClass("error")) {
            el.removeClass("error");
            var datav = el.attr("data-value") || "";

            // if (datav.indexOf("не запол") !== -1)
            el.val(datav);
        }

        //  el.attr("placeholder", el.attr("data-placeholder"));
    });

    // форма вопроса в /about
    $("#ask_question").on("submit", function(e) {
    	e.preventDefault();
		$.post("/ajax/add-question.php", {
			form: $(this).serialize()
		}, function(result) {
			data = JSON.parse(result);
			$(".form_result").html(data.text);
			if (!data.success) {
				$(".form_result").addClass("form_validation_failed");
			} else {
				$(".hiddenProductComment").fadeIn();
				document.getElementById("ask_question").reset();
			}
			$(".form_result").fadeIn(200);
			setTimeout(function(){
				$(".form_result").fadeOut(200);
				$(".form_result").removeClass("form_validation_failed");
			}, 5500);
	    });
    })

    // форма вопроса в /question
    $("#faq_question").on("submit", function(e) {
    	e.preventDefault();
		$.post("/ajax/add-faq-question.php", {
			form: $(this).serialize()
		}, function(result) {
			data = JSON.parse(result);
			$(".form_result").html(data.text);
			if (!data.success) {
				$(".form_result").addClass("form_validation_failed");
			} else {
				$(".hiddenProductComment").fadeIn();
				document.getElementById("faq_question").reset();
			}
			$(".form_result").fadeIn(200);
			setTimeout(function(){
				$(".form_result").fadeOut(200);
				$(".form_result").removeClass("form_validation_failed");
			}, 5500);
	    });
    })


    $("body").on('click', ".btn", function (e) {
        var el = $(this).parent('form'), input = el.find("input,textarea"), dataError = 0;

        input.each(function () {
            var el = $(this), val = el.val();
            var emailPattern = /^[\w\d-_]+[\w\.\d-_]+@[\w\.\d-_]+\.\w{2,4}$/i;

            if (el.hasClass("selectric-input")) return;

            el.removeClass("error");
            if ((val == "")) {
                el.addClass("error").attr("placeholder", "Поле не заполнено");
                dataError = 1;
            } else
                //имя
                /*if (!(/^[_\-a-zA-Z0-9а-яА-Я ]{2,100}$/.test(val.trim())) && el.attr("name") == "name") {
                el.addClass("error");
                dataError = 1;

                } else */

                if (!emailPattern.test(el.val()) && (el.attr('name') == 'email')) {
                    el.addClass('error').attr("data-value", el.val()).attr("placeholder", "Поле заполнено не верно").val("");
                    dataError = 1;

                } else if (el.attr('name') == 'confirmpass' && el.closest("form").find("[name='pass']").val() != val) {
                    el.addClass('error').attr("data-value", el.val()).attr("placeholder", "Поле заполнено не верно").val("");
                    dataError = 1;
                }


        });
        $("select").each(function () {
            var el = $(this), val = el.val();
            if (val == -1) {
                var label = el.parent().parent().find(".selectric .label");
                label.attr("data-value", label.text());
                //label.text("Поле не заполнено");
                el.parent().parent().find(".selectric").addClass("error");
            }
        });

        if (!dataError) {
            //сабмит
            var form_id = $(this).attr('id');
            if(form_id == 'leave_question_catalog'){
                var form = $('#leave_question_catalog').serialize();
                $.ajax({
                    url: '/ajax/leave_question_catalog.php', //the URL to your node.js server that has data
                    type: 'POST',
                    data:  form,
                    success:function(data){
                    }
                }).done(function(data){});
            };
            //это пока, чтобы  не попадать на 405 ошибку
            var mes = el.parent().find(".message");

            if (mes.length > 0) {
                el.hide();
                mes.show();
            } else {

            }


        } else {
            return false;
        }

        e.preventDefault();
    });
    $(".couponInputBlock input").on("keydown keypress keyup", function () {
        var el = $(this), v = el.val(), button = el.parent().find("button");
        button.removeAttr("disabled");
        if (v.length == 0) button.attr("disabled", true);
    });

	$(document).on("click", ".altasib_geobase_yc_btn", function(){
		var detected_city = $(".altasib_geobase_your_city").html();
		$(".sityName").html(detected_city);
	});

    $(".locationWrapper .list a").on("click", function (e) {
    	e.preventDefault();
        var el = $(this), w = el.closest(".locationWrapper");
        w.find(".sityName").text(el.text());
        w.find(".list").fadeOut(300);
        popupMask.hide();
    });


    //открытие попапа в рекламациях
    var treatment = $('.hidingFormNewTreatment');

    $('.newTreatmentBlock').on('click', function () {
        var winH = $(window).height();
        treatment.css({top: 20, height: winH - 40}).fadeIn(300);
        treatment.find(".hidTreatmentBody").css({height: winH - 250 }).fadeIn(300, function(){
            treatment.find(".hidTreatmentBody").mCustomScrollbar({
                theme: "dark-thin"
            });
            //   $(".hidTreatmentBody").mCustomScrollbar("update");
        });
        $(".overflowMask").show();

    });
    $('.closeHidBlock, .bootomMenuHiddenBlock .cancelButton').on('click', function (e) {
        e.preventDefault();
        treatment.fadeOut(300);
        $(".overflowMask").hide();
    });
    var file_api = ( window.File && window.FileReader && window.FileList && window.Blob ) ? true : false;
    $("input[type=file]").on('change', function () {
        var i, files = this.files, fileName = "";
        for (i = 0; i < files.length; i++) {
            if (file_api && this.files[i])
                fileName = this.files[i].name + " ";
            else
                fileName = $(this).val().replace("C:\\fakepath\\", '');
        }
        $(".downloadText").text(fileName);

    });


    //В корзинеблок скидок обводка круглая (ри насадке наверняка понядобится https://github.com/kottenator/jquery-circle-progress)
    if ($('.discountValueBlock').length > 0) {
        $('.discountValueBlock').each(function () {
            var el = $(this), col = el.parent().find("input[name=color]").val();
            el.circleProgress({
                value: el.parent().find("input[name=value]").val(),
                size: 70,
                startAngle: -Math.PI / 2,
                thickness: 2,
                fill: {
                    color: col
                }
            });
            el.parent().find(".discountTextBlock span").css("color", col);
        });

    }


    //замена картинок в корзине "действия"

    $('.elementActions .likedButton').on("click", function (e) {
    	e.preventDefault();
        $(this).toggleClass('activeLikeBut');
    });
    /*
    $(".elementActions .deleteButton").on("click", function () {
        var el = $(this);
        el.closest("tr").hide();

    });
    */
    $('body').on("click", ".elementActions .productBasketBlock, .productWrapper .productBasketBlock", function (e) {
    	e.preventDefault();
        if (!$(this).hasClass("active")) {
            $(this).addClass('active');
        }
    });


    //меню в шапке (раскрытие/скрытие списка)
    $('.firstLvlLi>a').click(function () {
        var el = $(this).parent('li'), second = el.children('.secondLvl');
        if (el.hasClass('activeFirstLclLi')) {
            el.removeClass('activeFirstLclLi');
            el.children('.secondLvl').hide();
        } else {
            el.addClass('activeFirstLclLi');
            second.show();
        }
    });
    $('.bottomBlockMailLeft').on("click", function () {
        var second = $('.secondLvl');
        second.show();
        second.parent('li').addClass('activeFirstLclLi');
    });

    /********************************/
    //КАТАЛОГ
    /*
    var blockType = $(".blockType"), listType = $(".listType"), blockTypeC = $(".elmentsList, .basketBlock"), listTypeC = $(".elementsTable, .basketBlock");
    //блочный вид
    blockType.click(function () {

    listType.removeClass("checked");
    listTypeC.hide();
    blockType.addClass("checked");
    blockTypeC.fadeIn(300);

    });
    //табличный вид
    listType.click(function () {

    blockType.removeClass("checked");
    blockTypeC.hide();
    listType.addClass("checked");
    listTypeC.fadeIn(300);

    });
    blockType.click();
    */

    //карусель скидки в корзине
    nowBasketDiscountSlide = 1;
    if ($('.discountsBlock .rightArrow').length > 0) {
        var slidesOnBasketPage = 2;
        var elementCount = $('.discountsBlock .discountSlideBlock').length;
        var elementWidth = $('.discountsBlock .discountSlideBlock').css('width').slice(0, -2);
        elementWidth = +$('.discountsBlock .discountSlideBlock').css('margin-right').slice(0, -2) + +elementWidth + 4;//4 - магическое число что бы ровно было
        $('.discountsBlock .rightArrow').click(function () {
            if (nowBasketDiscountSlide == elementCount - slidesOnBasketPage) {


            } else {
                //console.log(elementWidth);
                $('.discountsSliderWrap ul').animate({left: '-=' + elementWidth + 'px'});
                nowBasketDiscountSlide++;
            }
        })
    }
    if ($('.discountsBlock .leftArrow').length > 0) {
        var elementCount = $('.discountsBlock .discountSlideBlock').length;
        var elementWidth = $('.discountsBlock .discountSlideBlock').css('width').slice(0, -2);
        elementWidth = +$('.discountsBlock .discountSlideBlock').css('margin-right').slice(0, -2) + +elementWidth + 4;//4 - магическое число что бы ровно было
        $('.discountsBlock .leftArrow').click(function () {
            if (nowBasketDiscountSlide == 1) {

            } else {
                //console.log(elementWidth);
                $('.discountsSliderWrap ul').animate({left: '+=' + elementWidth + 'px'});
                nowBasketDiscountSlide--;
            }

        })
    }

    //Переключение блоко в корзине

    $('.basketBodyMenu p').on("click", function () {

        $('.basketBodyMenu p').removeClass('active');
        $(this).addClass('active');

    })

    $('.basketBodyMenu p:nth-child(1)').addClass('active');


    //открытие блоков в личном кабинете

    $('.settingsWrap .blockTitle').on("click", function () {
        var el = $(this), top = el.offset().top-20;
        if (el.hasClass('active')) {
            el.removeClass('active');
            el.find(".activeOrder").removeClass("activeOrder");
            el.parent().children('.settingsBlock').slideToggle(150);

            $(".ordersMenu a").removeClass("activeElement");
            $(".ordersMenu a:first").addClass("activeElement");
            el.parent().find(".activeOrder").removeClass("activeOrder");
            el.parent().find(".orderContainer .orderBodyWrap").hide();
            el.parent().find("#ordersActive").show();
            //

        } else {
            el.addClass('active');
            el.parent().children('.settingsBlock').slideToggle(150);
        }


    });

    //открытие блоков детального заказа в ЛК

    $(document).on("click", '.settingsWrap .orderContainer .activeOrderTitle', function () {
        var el = $(this).parent(), top = el.offset().top-15;
        if (el.hasClass('activeOrder')) {
            $('.orderBodyWrap').slideUp(0);
            setTimeout(function () {
                el.closest('.settingsBlock').find(".orderContainer").removeClass('activeOrder').addClass("disableOrder");
                },0);
        } else {
            $('.orderBodyWrap').hide();
            el.closest('.settingsBlock').find(".orderContainer").removeClass('activeOrder').addClass("disableOrder");

            el.addClass('activeOrder').removeClass("disableOrder");
            el.children('.orderBodyWrap').slideDown(0);
        }
        /*setTimeout(function(){*/
        $("html, body").animate({scrollTop: el.offset().top-15}, 200);
        /*}, 400);*/

    });


    if ($('.js-range').length > 0) {
        var el = $(".js-range");
        el.each(function(){
            var el = $(this);
            var minRange = fromRange =  parseFloat(el.siblings(".js-range-min").val());
            var maxRange = toRange = parseFloat(el.siblings(".js-range-max").val());

            //если задан фильтр, берем значения для текущего диапазона
            if (parseInt($(this).siblings(".min-price").val()) >=0 ) {
                fromRange = parseInt(el.siblings(".min-price").val());
            }

            if (parseInt($(this).siblings(".max-price").val()) >=0 ) {
                toRange = parseInt(el.siblings(".max-price").val());
            }

            if (minRange >= 0 && maxRange > minRange) {

                el.ionRangeSlider({
                    hide_min_max: true,
                    min: minRange,
                    max: maxRange,
                    from: fromRange,
                    to: toRange,
                    type: 'double',
                    step: 1,
                    prefix: "",
                    grid: false,
                    onChange: function () {
                        var activeFrom = $(".irs-slider.from").hasClass("state_hover"), activeTo = $(".irs-slider.to").hasClass("state_hover"),
                        elFrom = $(".irs-from"), elTo = $(".irs-to");
                        width_price = $(".irs-bar").css('width').substring(0, $(".irs-bar").css('width').length - 2);
                        if(width_price < 60){
                            $('.irs-single').css('left', '0'); // ограничим движение цены за край блока
                        }
                        if (activeFrom) {
                            elFrom.addClass("active");
                        } else {
                            elFrom.removeClass("active");
                        }
                        if (activeTo) {
                            elTo.addClass("active");
                        } else {
                            elTo.removeClass("active");
                        }
                        el.closest(".typeBlockFilter close");

                        //подстановка текущих значений в нужные поля фильтра
                        var valueFrom = elFrom.html();
                        var minPriceContainer = elFrom.parents(".optionContain").find(".min-price");
                        minPriceContainer.val(valueFrom.replace(" ", ""));
                        minPriceContainer.keyup();

                        var valueTo = elTo.html();
                        var maxPriceContainer = elTo.parents(".optionContain").find(".max-price")
                        maxPriceContainer.val(valueTo.replace(" ", ""));
                        maxPriceContainer.keyup();

                    }
                });
                // делаем его глобальным, чтобы потом получить к нему доступ
                window.price_slider = el.data("ionRangeSlider");
            }
        })


        $(".irs-slider.from").on("mouseenter", function () {
            $(".irs-from").addClass("active");
        }).on("mouseleave", function () {
            $(".irs-from").removeClass("active");
        });

        $(".irs-slider.to").on("mouseenter", function () {
            $(".irs-to").addClass("active");
        }).on("mouseleave", function () {
            $(".irs-to").removeClass("active");
        });
    }

    //$(".typeBlockFilter .optionContain").removeClass("active");


    $('.ordersContainer').hide();
    $('.ordersContainer1').show();

    //---------------------------
    if ($('.hidingMenu p').length > 0) {
        $('.hidingMenu p').on("click", function () {
            $(this).closest(".hidingMenu").hide();


        });
    }
    //--------------------------------
    if ($('.leftFiltersBlock .leftFilterName').length > 0) {
        $('.leftFiltersBlock .leftFilterName').on("click", function () {
            if ($(this).hasClass('activeFilter')) {
                $(this).removeClass('activeFilter');
                $(this).parent().children('.optionContain').slideUp(500, function (){$(this).removeClass("active")});
            } else {
                $(this).addClass('activeFilter');
                $(this).parent().children('.optionContain').slideDown(500, function (){$(this).addClass("active");});
                // хак для сдвига надписей у фильтра по ценам
                setTimeout(function() {
					window.price_slider.update({
					    from: parseInt($(".min-price").val() ? $(".min-price").val() : $(".js-range-min").val()),
					    to: parseInt($(".max-price").val() ? $(".max-price").val() : $(".js-range-max").val())
					});
                }, 3);
            }
        });




        $(".typeBlockFilter label,.irs").on("click", function () {
            var el = $(this).closest(".typeBlockFilter"), close = el.find(".close");
            setTimeout(function(){
                var l = el.find("input:checked").length;
                if (l == 0) {
                    close.hide();
                } else {
                    close.show();
                }

                }, 5);


        });
        
        // перемещаем плашку в то место, где была отмечена последняя галка
        $(".typeBlockFilter .countryText").on("click", function() {
        	var element_offset = $(this).parent().position();
        	$("#modef").css("top", parseInt(element_offset.top) + parseInt(5) + "px");
        })
        
        $(".typeBlockFilter .close").on("click", function () {
            var el = $(this).parent();
            el.find("input").each(function () {
                var el = $(this), type = el.attr("type");
                if (type == "checkbox" || type == "radio") {
                    el.removeAttr("checked");
                }
                if (type == "text") {
                    el.val("");
                }
            });
            if (el.find("#range").length > 0) {
                var slider = $("#range").data("ionRangeSlider");
                slider.reset();
            }
            $(this).hide();

        });

        $(".typeBlockFilter .clear").on("click", function () {
            $('.typeBlockFilter .close').hide();

        });

        $(".typeBlockFilter .accept").off("submit").on("submit", function () {
            return true;
        });

        $(".turnButton").on("click", function (e) {
        	e.preventDefault();
            $('.horizontalFilterWrap .productFilterWrap p').click();
        });
    }

    /***************************/

    //Меню в личном кабинете счета
    if ($('.billingsListMenu').length > 0) {
        $('.billingsListMenu a').on('click', function (e) {
        	e.preventDefault();
            var el = $(this), id = el.attr("href");
            $('.billingsListMenu a').removeClass('activeBillingMenu');
            el.addClass('activeBillingMenu');
            el.closest(".settingsWrap").find(".activeBillingsBlock").hide();
            $(id).fadeIn(700);
        });
    }


    //Меню в личном кабинете аакты
    if ($('.actsListMenu').length > 0) {
        $('.actsListMenu a').on('click', function (e) {
        	e.preventDefault();
            var el = $(this), id = el.attr("href");
            $('.actsListMenu a').removeClass('activeActsMenu');
            el.addClass('activeActsMenu');
            el.closest(".settingsWrap").find(".activeBillingsBlock").hide();
            $(id).fadeIn(700);
        });
    }


    $(".ordersMenu a").on('click', function (e) {
    	e.preventDefault();
        var el = $(this), id = el.attr("href");
        el.parent().find("a").removeClass('activeElement');
        el.addClass('activeElement');
        el.closest(".settingsWrap").find(".activeBillingsBlock, .ordersContainer").hide();
        $(id).fadeIn(700);
        el.closest(".settingsBlock").find(".activeOrder").removeClass("activeOrder");
        el.closest(".settingsBlock").find(".orderContainer .orderBodyWrap").hide();
    });


    //в каталоге открытие левого фильтра

    $('.productFilterWrap p').on("click", function () {
        var el = $(this), menu = $('.leftFiltersBlock'), block = $(".elementBlocksWrap");
        el.toggleClass('activeTopLeftBut');
        block.toggleClass("smallElementList");
        if (block.hasClass("smallElementList")) {
        	menu.css("visibility", "visible");
            menu.animate({"margin-left": 0, "opacity": 1}, 300);
            block.animate({"margin-left": 302}, 300);
        } else {
            menu.animate({"margin-left": -300, "opacity": 0}, 300);
            menu.css("visibility", "hidden");
            block.animate({"margin-left": 0}, 300);
        }



    });
    $(".listType").click();

    //табы
    $(".infoBlocksMenu a").on("click", function (e) {
    	e.preventDefault();
        var el = $(this), id = el.attr("href");
        $(".infoBlocksMenu a").removeClass("activeInfoBlock");
        $(".infoBlocksContent").hide();
        el.addClass("activeInfoBlock");
        $(id).fadeIn(500);
    });
    //табы корзина
    $("body").on("click", ".basketBody .basketBodyMenu a.js_tabs", function (e) {
    	e.preventDefault();
        var el = $(this), id = el.attr("href"), delivery_id = el.data("delivery-button-id");
        $(".dataPayer").length ? $("input#" + delivery_id).click() : ""; // если мы в оформлении заказа
        $(".basketBody .basketBodyMenu a").removeClass("active");
        $(".basketBlock").hide();
        el.addClass("active");
        $(id).fadeIn(500);
    });
    //табы табы гугловых карт
    $("body").on("click", ".js_google_tabs", function (e) {
    	e.preventDefault();
        var el = $(this),
        	id = el.attr("href");
        el.parent().find("a").removeClass("active");
        el.closest("div.basketBody").find(".basketBlock").hide();
        el.addClass("active");
        el.closest("div.basketBody").find(id).fadeIn(500);
    });

    $(".smallPreviewImg a").on("click", function (e) {
    	e.preventDefault();
        var el = $(this),
        	id = el.attr("href"), // непережатая фотка
        	preview_path = el.data("preview-image"); // фотка для показа в окошке главного превью
        $(".previewImg img").hide().attr("src", preview_path).fadeIn(700);
        $(".previewImg a").attr("href", id);
        $(".smallPreviewImg a").removeClass("active");
        el.addClass("active");
    });

    $(".productCardDesc .elementQuant").on("click", function (e) {
    	e.preventDefault();
        $(this).closest(".middleSelectBlock").addClass("active");
    });
    $(".productCardDesc .elementQuant input").on("focus", function () {
        $(this).closest(".middleSelectBlock").addClass("active");
    }).on("blur", function () {
        $(this).closest(".middleSelectBlock").removeClass("active");
    });


    $(".productCardDesc .elementQuant input, .productCardDesc .quantityMinus, .productCardDesc .quantityPlus").on("mouseenter", function () {
        $(this).closest(".middleSelectBlock").addClass("active");
    }).on("mouseleave", function () {
        $(this).closest(".middleSelectBlock").removeClass("active");
    });

    $(".contactsWindow .close").on("click", function (e) {
    	e.preventDefault();
        var el = $(this);
        el.parent().fadeOut(300);
    });

    //убирать placeholder по клику на  input,textarea
    /*$('input,textarea').on("focus", function () {
    var el = $(this);
    el.data('placeholder', el.attr('placeholder'));
    el.attr('placeholder', '');
    }).on("blur", function () {
    var el = $(this);
    el.attr('placeholder', el.data('placeholder'));
    });*/

    /*$(".hidMenuBlockTitle").on("click", function () {
    var top = $(this).position().top, block = $(this).parent().children();

    if (top == $(".hidTreatmentBody").find(".mCSB_dragger").position().top) {
    $(block[block.length -1]).slideUp(150);
    } else {
    $(block[block.length -1]).slideDown(150, function(){
    $(".hidTreatmentBody").mCustomScrollbar("scrollTo", top);
    });
    }


    });*/

    //стрелки личный кабинет
    $(".settingsWrap .productCarousel").each(function(){
        var el = $(this), l = el.find("li").length, limit = 4;
        if (el.closest(".complaints").length > 0) {
            limit = 3;
        }
        if (l <= limit) {
            el.find(".jcarousel-control-prev,.jcarousel-control-next").hide();
        }
    });

    //
    $(".dataPayer .btn1").on("click", function (e) {
    	e.preventDefault();
        $(".hiddenOform").fadeIn(300);
        //показать маску
        popupMask.show();

        $(".hidTreatmentBody").hide();
    });


    $(".sendButton").on("click", function (e) {
		e.preventDefault();
        $(".hidTreatmentBody").hide();
        $(".hidingFormNewTreatment .message").fadeIn(300);
        setTimeout(function(){
            $(".hidingFormNewTreatment").fadeOut(300);
            }, 2000);

    });

    //обработка клика по элементам выпадающего списка
    $(".hidingMenu p").on("click", function(){
        if ($(this).data('href')) {
            document.location.href = $(this).data('href');
        }
    });
    $(".avalibleFilter label").on("click", function(){
        if ($(this).data('href')) {
            document.location.href = $(this).data('href');
        }
    });

	// Функционал избранного

	// Если пользователь не авторизован
	$(".js_favorite_need_auth").on("click", function(e) {
		e.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, "slow");
		$(".authorisationLink a").click();
	});

	// Если пользователь авторизован, то добавим новую подписку
	$("body").on("click", ".js_add_to_favorite", function() {
		$.post("/ajax/manage_favorite.php", {
			id: $(this).data("favorite-product-id")
		}, function(result) {
			result = JSON.parse(result);
	        if (result.data) {
	        	$(this).removeClass("js_add_to_favorite");
	        	$(this).addClass("already_in_favorite");
	        	$(this).data("favorite-delete", "Y");
	        	$(this).data("favorite-item-id", result.data);
	        	$(this).hasClass("list_favorite") ? "" : $(this).html("В избранном");
	        	refreshFavoriteIcon(result.total);
	        }
	    }.bind(this));
	})

	// Если пользователь уже имеет подписку на товар, то удалим ее
	$("body").on("click", ".already_in_favorite", function() {
		$.post("/ajax/manage_favorite.php", {
			id: $(this).data("favorite-item-id"),
			delete_item: $(this).data("favorite-delete")
		}, function(result) {
			result = JSON.parse(result);
	        $(this).addClass("js_add_to_favorite");
        	$(this).removeClass("already_in_favorite");
        	$(this).data("favorite-delete", "");
        	$(this).data("favorite-item-id", 0);
        	$(this).hasClass("list_favorite") ? "" : $(this).html("В избранное");
        	refreshFavoriteIcon(result.total);
	    }.bind(this));
	})

	// Удаление подписки со страницы избранного
	$("body").on("click", ".js_delete_from_favorite_list", function() {
		$.post("/ajax/manage_favorite.php", {
			id: $(this).data("favorite-item-id"),
			delete_item: $(this).data("favorite-delete")
		}, function(result) {
			result = JSON.parse(result);
			if ($(".deleteButton ").length > 1) {
				$(this).closest(".js_favorite_block").remove();
			} else {
				$(".elementsTable").remove();
				$(".no_items_in_favorite").show();
			}

        	refreshFavoriteIcon(result.total);
	    }.bind(this));
	})

    // торговые предложения в карточке товара
    $(".firstFilter p.js-offer-option").on("click", function() {
        var current_offer_buy_link = $(this).data("offer-buy-link"),
        current_offer_id = $(this).data("offer-id"),
        current_offer_can_buy = $(this).data("item-can-buy");

        if (current_offer_can_buy) {
            $(".addBtn").show();
            $(".bx_notavailable").hide();
        } else {
            $(".addBtn").hide();
            $(".bx_notavailable").show();
        }
        // если для предложения есть превьюха, то переключаемся на нее
        if ($("a[data-preview-offer-id='" + current_offer_id + "']").length && !$("a[data-preview-offer-id='" + current_offer_id + "']").hasClass("active")) {
        	$("a[data-preview-offer-id='" + current_offer_id + "']").click();
        }
        $(".productPrice").hide();
        $(".discountLogoWrapper").hide();
        $('.productPrice[data-price-offer-id="' + current_offer_id + '"]').show();
        $("#discount_label_" + current_offer_id).show();
        $(".js-add-to-basket").attr("href", current_offer_buy_link);
        $(".js-add-to-basket").data("offer-id", current_offer_id);
        return false;
    });

    //обработка нажатия кнопки добавления в корзину из шаблона списка товаров каталога и карточки
    $(".js-add-to-basket").on("click", function(e){
        e.preventDefault();
        var ulr = $(this).attr("href");

        var itemId = $(this).data("item-id");

        // раскрываем список предложений, если ни одно из них не выбрано. Только дя карточки
        if ($(this).data("main-item-id") && !$(this).data("offer-id") && $(this).data("item-have-offers")) {
            !$(".item_card_offers").hasClass("active") ? $(".item_card_offers").click() : "";
        }

        //поле ввода количества товара
        if (parseInt(itemId) > 0) { // для секции
            var quantityField = $(".js-item-quantity[data-item-id= " + itemId + "]");
        } else { // для карточки
            var quantityField = $(".quantityText");
        }

        if (quantityField.length > 0) {
            var itemQuantity = parseInt(quantityField.val()); //количество
            var quantityVariable = quantityField.data("quantity-variable");  //имя переменной, в которой передается количество
        }

        //если есть поле ввода количества и имя переменной для передачи количества
        if (itemQuantity > 0 && quantityVariable != "" && ulr != "") {
            ulr = ulr + "&" + quantityVariable + "=" + itemQuantity;
        }

        if (ulr) {
            //делаем запрос на нужный урл и преезагружаем область с маленькой корзиной
            $(".js-small-basket").load(ulr + " .js-small-basket > * ");
            $(".add_basket").html('Товар добавлен в корзину');
            $(".add_basket").fadeIn('medium');
            setTimeout(function(){
                $(".add_basket").fadeOut('medium');
            },2000);
        }
    })

    $(".js-offer-select").on("change", function(){
        var item_id = parseInt($(this).data("item-id"));
        var href = $(this).val();
        var offerId = parseInt($(this).find("option:selected").data("offer-id"));
		$("a.table_previews[data-preview-offer-id='" + offerId + "']").css("display", "block");
		$("a.table_previews[data-preview-offer-id='" + offerId + "']").siblings("a").css("display", "none");
        if (item_id > 0 && href != "" && offerId > 0) {
            $("a[data-item-id = " + item_id + "]").parent().removeClass("basketButtonInvisible");
            $("a[data-item-id = " + item_id + "]").attr("href", href);
            $(".js-item-price[data-item-id = " + item_id + "]").hide();
            $(".js-item-price[data-offer-id = " + offerId + "]").show();
            $(this).closest("tr").find(".statusInStock").show();
        }
        else if (parseInt(item_id) > 0) {
            $("a[data-item-id = " + item_id + "]").parent().addClass("basketButtonInvisible");
            $("a[data-item-id = " + item_id + "]").removeAttr("href");
            $(".js-item-price[data-item-id = " + item_id + "]").hide();
            $(".js-item-price[data-item-id = " + item_id + "]:first").show();
            $(this).closest("tr").find(".statusInStock").hide();
        }
    })

    // обратная связь, кликаем по картинке, выбирается ТП
    $("#previews_slider_wrapper a").on("click", function(){
    	if ($(this).data("preview-offer-id")) {
    		$(".horizontalFilterWrap p.js-offer-option[data-offer-id='" + $(this).data("preview-offer-id") + "']").click();
    	}
    })


    //смена шаблона отображения списка разделов
    $(".displayTypeWrap > div").on("click", function() {
        if ($(this).data("href")) {
            document.location.href = $(this).data("href");
        }
    })

    // добавление знака "звёздочки", если поле формы "Задать вопрос" обязательное

    $("#form_container .leftBlock input").each(function(){
        if ($(this).prop("required")) {
            $(this).attr("placeholder", $(this).attr("placeholder") + " *");
        }
    });

    $("#form_container .rightBlock textarea").each(function(){
        if ($(this).prop("required")) {
            $(this).attr("placeholder", $(this).attr("placeholder") + " *");
        }
    })

});

//перезагрузка малой корзины
function smallBasketRefresh() {
    $.post("/ajax/smallBasket.php", {}, function(data){
        $(".js-small-basket").html(data);
    });
}

//в каталоге выпадающие менюшки
function pullDownMenu(filterName, activeOptionId) {

    $(filterName).on("click", function () {
        var el = $(this);
        setTimeout(function () {
            var els = $(".firstFilter, .secondFilter").not(el);

            els.removeClass("active");
            els.find(".hidingMenu").hide();

            if (el.hasClass('active')) {
                el.removeClass('active');
                $(filterName + ' .hidingMenu').hide();
            } else {
                el.addClass('active');
                $(filterName + ' .hidingMenu').show();
            }
            }, 5);

    });

    $(filterName + ' .hidingMenu p').on("click", function () {
        var sortId = $(this).attr('data-sort');

        var temp = $(this).html();
        //$(this).html($(activeOptionId).html());
        $(activeOptionId).html(temp);
        /*
        var tempSort = $(this).attr('data-sort');
        $(this).attr('data-sort', $(activeOptionId).attr('data-sort'));
        $(activeOptionId).attr('data-sort', tempSort);

        var tempClass = $(this).attr('class');
        $(this).attr('class', $(activeOptionId).attr('class'));
        $(activeOptionId).attr('class', tempClass);*/

        $(this).closest(".active").removeClass("active");


    });


    $(".elementsTable .basketBody tr").on("mouseenter", function () {
        $(this).closest("tr").next().addClass("trHover");
    }).on("mouseleave", function () {
        $(this).closest("tr").next().removeClass("trHover");
    });
}

/**
 *
 * Обновляем иконку в хедере
 *
 * @param int total
 * @return void
 **/
function refreshFavoriteIcon(total) {
	$(".quantityOfLiked").html(total);
}

//функция анимации в выпадающем верхнем каталоге
function animateLiMoving(elem, position) {
    $(elem).attr("data-pos", position.top).css({'top': position.top});
    $(elem).animate({'top': '0'}, 300);
    setTimeout(function () {
        $(elem).addClass('activeLiTopMenuFirstLvl');
        }, 300);
    setTimeout(animateSecondLvl, 600);
}
//Функция анимации выпадающего меню каталога
function animateSecondLvl() {
    $('.secondLvlCatalog .mCSB_draggerContainer').css("visibility", "hidden");
    $('.secondLvlCatalog').slideDown('700', function () {
        $('.secondLvlCatalog .mCSB_draggerContainer').css("visibility", "visible");
    });
    $('.bottomBlockMailLeft').show();
}


function leave_quastion(){
    var form = $('#leave_question').serialize();

    $.ajax({
        url: '/ajax/send_quastion.php', //the URL to your node.js server that has data
        type: 'POST',
        data:  form,
        success:function(data){
            $('#leave_question').hide();
            $('.hiddenQuestionBlock .message').show();
        }
    }).done(function(data){
       $('#leave_question .message').show();
       $('#leave_question .message').html('Заполните все поля!')
    });
};

//  компонент main.register шаблон new_registration
$(function() {
     $("#reg_input_PERSONAL_PHONE").mask(8 + "(999) 999-9999");
     $('.btn_prew').click(function(){
        $('.wrap_form_2').hide('slow');
        $('.wrap_form_1').show('slow');
     });
    $('.btn_submit').click(function(){

        var field = new Array('reg_input_NAME');//поля обязательные

        $('#form_register').each(function() {// обрабатываем отправку формы
            var error = 0; // индекс ошибки
            $("form").find(":input").each(function() {// проверяем каждое поле в форме
                for(var i = 0; i < field.length; i++){ // если поле присутствует в списке обязательных
                    if($(this).attr("id") == field[i]){ //проверяем поле формы на пустоту

                        if(!$(this).val()) {// если в поле пустое
                            $(this).addClass('input_error');// устанавливаем рамку красного цвета
                            error = 1;// определяем индекс ошибки
                        } else {
                            $(this).removeClass('input_error');// устанавливаем рамку обычного цвета
                        }

                    }
                }
           })
           //провека email адреса
            var email = $("#reg_input_EMAIL").val();
               if(!isValidEmailAddress(email)){
                    error = 2;
                    $("#reg_input_EMAIL").addClass('input_error');// устанавливаем рамку красного цвета
                    $("#reg_input_EMAIL").attr('placeholder','Ошибка ввода e-mail');// устанавливаем рамку красного цвета
               } else {
                    $("#reg_input_EMAIL").removeClass('input_error');// устанавливаем рамку красного цвета
               };

            //провека совпадения паролей
            var pas1 = $("#reg_input_PASSWORD").val();
            var pas2 = $("#reg_input_CONFIRM_PASSWORD").val();
               if(pas1 == '' || pas1 != pas2) {
                    error = 3;
                    $("#reg_input_PASSWORD").addClass('input_error');// устанавливаем рамку красного цвета
                    $("#reg_input_CONFIRM_PASSWORD").addClass('input_error');// устанавливаем рамку красного цвета
                } else{
                    $("#reg_input_PASSWORD").removeClass('input_error');// устанавливаем рамку красного цвета
                    $("#reg_input_CONFIRM_PASSWORD").removeClass('input_error');// устанавливаем рамку красного цвета
                }

            //провека формы собственности
            var face = $(".bx-user-field-enum").val();
               if($.isNumeric(face) == false) {
                    error = 4;
                    $(".selectric").addClass('input_error');// устанавливаем рамку красного цвета
                } else{
                    $(".selectric").removeClass('input_error');// устанавливаем рамку красного цвета
                }
            if (error == 0) { // если ошибок нет то отправляем данные
                $('.wrap_form_1').hide('slow');
                $('.wrap_form_2').show('slow');
                if(face == 4){
                    $('.face_1').show();
                    $('.face_2').hide();
                    $('.face_1 input').addClass('active_face');
                    $('.face_2 input').removeClass('active_face');
                } else {
                    $('.face_2').show();
                    $('.face_1').hide()
                    $('.face_2 input').addClass('active_face');
                    $('.face_1 input').removeClass('active_face');
                }
            } else {
                return false; //если в форме встретились ошибки , не  позволяем отослать данные на сервер.
            }

        })
      });

    $('.fields.files input[type="file"]').attr('accept', 'image/jpeg,image/png,application/msword,application/excel,application/x-excel,application/pdf,text/xml,application/vnd.ms-excel');
    $('.bx-input-file-desc').html('Выберите файл');
    $(".fields.files input[type='file']").change(function(){
         var filename = $(this).val().replace(/.*\\/, "");
         if(filename){
            $(this).next().html(filename);
         } else {
            $(this).next().html('Выберите файл');
         }
    });
    $(".additional_fields label").click(function() {
        $(this).next('.reset').css('z-index', 2);
    })
    $(".reset").click(function() {
        $(this).prev().addClass('reset_input');
        $('.reset_input input[type="file"]').val('');
        $('.reset_input .bx-input-file-desc').html('Выберите файл');
        $(this).prev().removeClass('reset_input');
        $(this).css('z-index', 0);
    });
    $('#form_register .wrap_form_2 .authEnter').click(function(){
        var error = 0;
        $("#form_register").find("input[type='file']").each(function() {// проверяем каждое поле в форме
            if(!$(this).val() && $(this).hasClass("active_face")) {
                $(this).parent().addClass('error_file');
                error = 1;
            } else {
                $(this).parent().removeClass('error_file');
            }
       })
        if (error == 0) { // если ошибок нет то отправляем данные
           $("#form_register input[type='submit']").click();
        } else {
            return false; //если в форме встретились ошибки , не  позволяем отослать данные на сервер.
        }
    });
 });

$(function() {
   $('.firstLvlLi').find(".secondLvl").parent().addClass('Level_next');
});
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}


//  компонент main.register шаблон new_registration

/* Function for ours ajax inquiry  */
/* Подписка  */
function ajaxpostshow(urlres, datares, wherecontent){
       $.ajax({
           type: "POST",
           url: urlres,
           data: datares,
           dataType: "html",
           success: function(fillter){
                $(wherecontent).html(fillter);
           }
      });
}
$(function() {
   /* For subscribe */
  $(".deliveryBlock form").on("click", '.mailing-submit', function(){
        var formsubscrube = $(this).parents("form").serialize();
        formsubscrube = formsubscrube + '&action=ajax';
        ajaxpostshow("/ajax/mailing.php", formsubscrube, ".deliveryBlock" );
        return false;
   });
});

$(function() {
   $('body').on('click', '.text_popup', function(){
         $('.productText_popup').fadeIn();
   })
   $('body').on('click', '.close_popup', function(){
         $('.productText_popup').fadeOut();
   })
});

$(function() {
   $('body').on('click', '.show_property', function(){
         $('.optionContain .hide').css('display', 'block');
         $(this).removeClass('show_property');
         $(this).addClass('hide_property');
         $(this).html('Свернуть');
   })
   $('body').on('click', '.hide_property', function(){
         $('.optionContain .hide').css('display', 'none');
         $(this).removeClass('hide_property');
         $(this).addClass('show_property');
         $(this).html('Показать все');
   })
});