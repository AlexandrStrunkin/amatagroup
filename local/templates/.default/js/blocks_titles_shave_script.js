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
				"z-index": 2,
				"border" : "1px solid #c7c7c7",
				"margin-top": "-1px",
				"margin-left": "-1px"
			});
			
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
			
			name_block.css({
				"overflow" : "hidden",
				"word-wrap": "normal"
			});
			
			name_block.shave(60);
		}
	)
})