
$(document).ready(function() 
{
	$('a[data-delete="opd"]').on('click', function() 
	{
		var ID = $(this).data('id');

		$('#modal-delete').modal('show');
		$('a#btn-yes').attr('href', base_url + '/opd/delete/' + ID);
	});
});