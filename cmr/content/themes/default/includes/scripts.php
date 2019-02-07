
		<script src="<?php echo path_home; ?>js/sb-admin.min.js"></script>
<script>
$('#myModal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget);
	var recipient = button.data('src');
	var modal = $(this);
	modal.find('.modal-body img').attr('src', '');
	var urlTemp = location.protocol + '//' + location.host + recipient;
	modal.find('#myModalLabelURL').text(urlTemp);
	modal.find('#myModalLabelURL').attr('href', urlTemp);
	modal.find('.modal-body img').attr('src', recipient);
});
</script>