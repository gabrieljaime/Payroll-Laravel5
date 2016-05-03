<script type="text/javascript">

	// CONFIRMATION SAVE MODEL
	$('#confirmSave').on('show.bs.modal', function (e) {
		var message = $(e.relatedTarget).attr('data-message');
		var title = $(e.relatedTarget).attr('data-title');
		var form = $(e.relatedTarget).closest('form');
		$(this).find('.modal-body p').text(message);
		$(this).find('.modal-title').text(title);
		$(this).find('.modal-footer #confirm').data('form', form);
	});
	$('#confirmSave').find('.modal-footer #confirm').on('click', function(){
	  	$(this).data('form').submit();
	});

	// CONFIRMATION DELETE MODAL
	$('#confirmDelete').on('show.bs.modal', function (e) {
		var message = $(e.relatedTarget).attr('data-message');
		var title = $(e.relatedTarget).attr('data-title');
		var form = $(e.relatedTarget).closest('form');
		$(this).find('.modal-body p').text(message);
		$(this).find('.modal-title').text(title);
		$(this).find('.modal-footer #confirm').data('form', form);
	});
	$('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
	  	$(this).data('form').submit();
	});
	// CONFIRMATION DELETE MODAL
	$('#confirmDeletegr').on('show.bs.modal', function (e) {
		var message = $(e.relatedTarget).attr('data-message');
		var title = $(e.relatedTarget).attr('data-title');
		var form = $(e.relatedTarget).closest('form');
		var href = $(e.relatedTarget).attr('data-id');
		$(this).find('.modal-body p').text(message);
		$(this).find('.modal-title').text(title);
		$(this).find('a').attr('href' ,href );
		$(this).find('.modal-footer #confirm').data('form', form);
	});
	$('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
		$(this).data('form').submit();
	});

	// CONFIRMATION edit MODAL
	$('#confirmEdit').on('show.bs.modal', function (e) {
		var message = $(e.relatedTarget).attr('data-message');
		var title = $(e.relatedTarget).attr('data-title');
		var href= $(e.relatedTarget).attr('data-id');
		var option = $(e.relatedTarget).attr('data-option');
		var description = $(e.relatedTarget).attr('data-description');
		$(this).find('.modal-body p').text(message);
		$(this).find('.modal-title').text(title);
		$('#description').val(description);
		$('#type_id').val(option);
		$('#update').attr('action',href);


	});
	$('#confirmEdit').find('.modal-footer #confirm').on('click', function(){
		$(this).data('form').submit();
	});

</script>