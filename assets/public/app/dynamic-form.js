$(document).ready( function() 
{
	/* ADD FORM TUJUAN */
	$('button#btn-add-tujuan').on('click', function()
	{
		var key = $(this).data('key');
		var ID = $(this).data('id');
		var nomor = $('tbody#data-'+ ID ).children().length;

		add_form_tujuan(ID, key, ++nomor, $(this).data('parent') );
	});

	$('button#btn-')

	/* DELETE FUNGSI */
	$('a#btn-delete').on('click', function()
	{
		var ID =  $(this).data('id'),
			remove =  $(this).data('remove');

		$('#modal-delete').modal('show');

		switch($(this).data('key'))
		{
			case 'delete-tujuan':
				$('a#btn-yes').on('click', function() 
				{
					$.post(base_url + '/tujuan/delete/' + ID + '/' + 'tujuan', function(result) 
					{
						$('#modal-delete').modal('hide');
							if( result.status === 'success')
							{
								$(remove).addClass('bg-red').fadeOut(300, function() {
									$(this).remove();
								});
							} else {
								alert("Terjadi kesalahan saat menhapus data!");
							}
						$(document).ajaxComplete(function(e, xhr, opt)
						{

						});
					});
				});
			break;
		}

		return true;
	});

	/* DELETE FUNGSI */
	$('a#btn-delete').on('click', function()
	{
		var ID =  $(this).data('id'),
			remove =  $(this).data('remove');

		$('#modal-delete').modal('show');

		switch($(this).data('key'))
		{
			case 'delete-sasaran':
				$('a#btn-yes').on('click', function() 
				{
					$.post(base_url + '/sasaran/delete/' + ID + '/' + 'sasaran', function(result) 
					{
						$('#modal-delete').modal('hide');
							if( result.status === 'success')
							{
								$(remove).addClass('bg-red').fadeOut(300, function() {
									$(this).remove();
								});
							} else {
								alert("Terjadi kesalahan saat menhapus data!");
							}
						$(document).ajaxComplete(function(e, xhr, opt)
						{

						});
					});
				});
			break;
		}

		return true;
	}); 

});


function add_form_tujuan(data, key, nomor, parent) {

	var penomoran;

	if( key === 1) {
		penomoran = parent +'.'+ nomor;
	} else {
		penomoran = parent +'.'+(nomor-key);
	}

	var html = '<tr id="baris-'+parent+'-'+nomor+'"><td>'+ penomoran +'</td>';
	html += '<td>';

	for( var tahun = $('tbody#data-' + data).data('tahun-awal'); tahun <= $('tbody#data-' + data).data('tahun-akhir'); tahun++)
	{
		html += '<div class="col-md-6"><label>';
		html += '<input type="checkbox" name="create[tahun]['+data+']['+tahun+']" value="'+tahun+'"> ' + tahun;
		html += '</label></div>'
	}
		html += '</td><td>';
		html += '<textarea name="create[deskripsi]['+data+']" class="form-control" rows="4"></textarea>';
		html += '</td><td class="text-center">',
		html += '<a href="javascript:void(0)" id="delete-form" data-delete="tr#baris-'+parent+'-'+nomor+'" title="Hapus tujuan ini?" class="btn btn-default"><i class="fa fa-times"></i></a>';
	    html += '</td>';
	    html += '</tr>';

	$(html).appendTo('tbody#data-' + data).hide().fadeIn(500).addClass('bg-silver');

	setInterval(function() {
		$('tr#baris-'+parent+'-'+nomor).fadeIn(500).removeClass('bg-silver');
	}, 400);

	$('a#delete-form').on('click', function()
	{
		key--;
		nomor--;
		$($(this).data('delete')).addClass('bg-red').fadeOut(300, function() {
			$(this).remove();
		});
	});
}