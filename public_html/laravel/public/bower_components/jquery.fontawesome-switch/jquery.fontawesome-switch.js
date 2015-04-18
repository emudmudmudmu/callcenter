;(function($) {
	
    $.fn.FASwitch = function(parameters) {

		this.each(function() {

			var iconClasses = ['fa-toggle-off', 'fa-toggle-on'];
			var labels = ($.type(parameters.labels) == 'object') ? parameters.labels : ['', '']
	    	var hidden = $(this);

	    	var spanClass = ($.type(parameters.css.label) == 'string') ? parameters.css.label : '';
			var spanElement = $('<span class="'+ spanClass +'"> '+ labels[hidden.val()] +'</span>');
			hidden.after(spanElement);
	    	
	    	var hiddenId = hidden.attr('id');
	    	var id = hiddenId +'_fa_switch'
	    	var iconElement = $('<i id="'+ id +'" class="fa '+ iconClasses[hidden.val()] +'">')
	    							.css({ cursor: 'pointer' })
	    							.click(function(){

	    								hidden.val(Math.abs(hidden.val() - 1));
	    								var addIndex = hidden.val();
	    								var removeIndex = (addIndex == 1) ? 0 : 1;
										$(this).removeClass(iconClasses[removeIndex])
												.addClass(iconClasses[addIndex]);
										if(parameters.labels[hidden.val()] != '') {

											spanElement.html(' '+ parameters.labels[hidden.val()]);

										}
						
							    	});

			if($.type(parameters.css.icon) == 'string') {

				iconElement.addClass(parameters.css.icon);

			}
	    	hidden.after(iconElement);

		});
	       
    }
    
})(jQuery);