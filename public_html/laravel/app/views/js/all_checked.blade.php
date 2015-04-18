$('.all_checked').on('ifChanged', function(e){

	var checkedValue = ($(e.target).prop('checked')) ? 'check' : 'uncheck';
	var selector = $(e.target).data('target');
	$(selector).iCheck(checkedValue);

});