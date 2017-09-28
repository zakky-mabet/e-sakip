	$(document).ready( function() 
	{

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
								alert("Terjadi kesalahan saat menghapus data!");
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

	function get_sasaran_json(selector) {
		var option = '<option value="">-- PILIH -- </option>';
		$.get(base_url + '/sasaran/get_sasaran_json', function(resultSasaran) {
			$.each(resultSasaran, function(key, value)
			{                    			
			    option += '<option value="'+value.id+'">'+value.deskripsi+'</option>';
			});

			$(selector).html(option);
		});
	}

	
	function add_form_sasaran(data, key, nomor, parent) {

	var html = '<tr id="baris-'+data+'-'+nomor+'"><td>'+ nomor +'</td>';
	html += '<td>';

	for( var tahun = $('tbody#data-' + data).data('tahun-awal'); tahun <= $('tbody#data-' + data).data('tahun-akhir'); tahun++)
	{
		html += '<div class="col-md-6"><label>';
		html += '<input type="checkbox" name="create[tahun]['+data+']['+tahun+']" value="'+tahun+'"> ' + tahun;
		html += '</label></div>'
	}
		html += '</td><td>';
		html += '<select name="create[opsi_sasaran]['+data+']" id="select-'+data+'-'+nomor+'" class="form-control input-sm" required="required">';

	    html +=	'</select><br>';
		html += '<textarea name="create[deskripsi]['+data+']" class="form-control" rows="4"></textarea>';
		html += '</td><td class="text-center">',
		html += '<a href="javascript:void(0)" id="delete-form" data-delete="tr#baris-'+data+'-'+nomor+'" title="Hapus tujuan ini?" class="btn btn-default"><i class="fa fa-times"></i></a>';
	    html += '</td>';
	    html += '</tr>';

	$(html).appendTo('tbody#data-' + data).hide().fadeIn(500).addClass('bg-silver');

	get_sasaran_json('select#select-' + data + '-' + nomor);

	setInterval(function() {
		$('tr#baris-'+data+'-'+nomor).fadeIn(500).removeClass('bg-silver');
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

