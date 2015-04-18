$('.multi_delete').on('submit', function(e){

	if(!confirm('{{ trans('versatile.destroy_confirm') }}')) {

		return false;

	}

	var deleteIds = [];
	var selector = $(e.target).data('selector');
	$.each($(selector), function(index, element){

		if($(element).prop('checked')) {

			deleteIds.push($(element).val());

		}

	});
	var joinedDeleteIds = deleteIds.join(',');

	if(joinedDeleteIds == '') {
	
		alert('{{ trans('versatile.no_selected') }}');
		return false;
	
	}
	
	$(e.target).find('[name=joined_delete_ids]').val(joinedDeleteIds);

});