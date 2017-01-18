$(document).ready(function(){
	// образаем длинные названия
	$(".productName").shave(60);
	// показываем скрытую часть названия в отображении блоками
	$(".productWrapper").hover(
		function(){
			var outer_block = $(this).parent(), // внешний блок, его высота эталонная
				name_block = $(this).find(".productName"), // блок названия
				additional_height = 0, // добавляемая скрытая разница в высоте
				full_name = name_block.data("element-full-name");
				
			outer_block.css("border-color", "transparent");
		
			$(this).css({
				"z-index": 33,
				"border" : "1px solid #c7c7c7",
				"margin-top": "-1px",
				"margin-left": "-1px"
			});
			
			$(this).find(".blocks_operations").css("border-bottom", "1px solid #c7c7c7");
			
			name_block.html(full_name);
			
			name_block.css({
				"overflow" : "visible",
				"word-wrap": "break-word"
			});
			
			// добавляем высоту только после показа скрытой части
			additional_height = parseInt(name_block[0].scrollHeight - name_block.height() - 20);
			
			$(this).css({
				"height" : outer_block.height() + additional_height + "px",
			});
			
			if (parseInt(additional_height) > 0) {
				$(this).find(".blocks_element_main_title").css("margin-bottom", parseInt(additional_height + 20) + "px");
			}
		},
		function(){
			var outer_block = $(this).parent(),
				name_block = $(this).find(".productName");
			
			outer_block.css("border-color", "#e6e6e6");
			
			$(this).css({
				"height" : outer_block.height() + "px",
				"z-index": 0,
				"border" : "none",
				"margin-top": "0px",
				"margin-left": "0px"
			});
			
			$(this).find(".blocks_operations").css("border-bottom", "none");
			
			name_block.css({
				"overflow" : "hidden",
				"word-wrap": "normal"
			});
			
			$(this).find(".blocks_element_main_title").css("margin-bottom", "20px");
			
			name_block.shave(60);
		}
	)
})