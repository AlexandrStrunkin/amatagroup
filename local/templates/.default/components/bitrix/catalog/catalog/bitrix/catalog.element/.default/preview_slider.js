function PreviewSlider(config) {
	
	this.config = config || {};
	this.current_position = 0; // ������� �������� ���������
	this.max_slide_distance = 0; // ������������ ���������� ��� ���������
	this.wrapper = {}; // ������ ���������� ��� �������
	
	/**
	 * ���������������� �������
	 * @return void
	 * */
	
	this.init = function() {
		// ���-�� ���������, ������� �� ������
		var hidden_items_count = 0;
		
		this.wrapper = $("#" + this.config.wrapper_id);
		hidden_items_count = this.wrapper.children().length - this.config.items_in_rows;
		// ���� ���� ������������ ��������, �� ���������� �������
		if (hidden_items_count > 0) {
			this.max_slide_distance = (this.config.slide_distance * hidden_items_count) * -1;
			$("." + this.config.arrows_class).show();
			
			$("." + this.config.arrows_class).on("click", function(e) {
				this.slide(
					$(e.target).data("preview-slider-direction")
				);
			}.bind(this));
		}
	}
	
	/**
	 * ������� ���������
	 * 
	 * @param string direction
	 * @return void
	 * 
	 * */
	this.slide = function(direction) {
		var sign = direction == "prev" ? "-" : "";
		if (
			(this.current_position <= 0 && sign == "-" && this.max_slide_distance < this.current_position) 
			|| (this.max_slide_distance <= this.current_position && sign == "" && this.current_position < 0)
		) {
			this.current_position = this.current_position + parseInt(sign + this.config.slide_distance);
			this.wrapper.css("transform", "translateX(" + this.current_position + "px)");
		}
	}
}
