$(function() {
	$.fn.verticalMiddle = function() {
		this.each(function(){
			var $this = $(this);
			var _height = $this.height();
			var _parent_height = $this.parent().height();
			$this.css('marginTop',(_parent_height/2) - (_height/2));
		});
		return this;
	};
});