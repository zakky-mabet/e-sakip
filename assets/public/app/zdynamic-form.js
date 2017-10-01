	$(document).ready( function() 
	{
	$('button#btn-add-sasaran').on('click', function()
	{
		var key = $(this).data('key');
		var ID = $(this).data('id');
		var nomor = $('tbody#data-'+ ID ).children().length;

		add_form_sasaran(ID, key, nomor, $(this).data('parent') );
	});

	$('button#btn-add-indikator-sasaran').on('click', function()
	{
		var key = $(this).data('key');
		var ID = $(this).data('id');
		var nomor = $('tbody#data-'+ ID ).children().length;

		add_form_indikator_sasaran(ID, key, nomor, $(this).data('parent') );

	});



     /*!
    * Modal Masalah 
    */
    $('.get-modal-masalah').click( function() 
    {
        $('#modal-masalah'+$(this).data('id-sasaran')).modal('show');

        //$('#tampildata').html( $(this).data('id-sasaran') );
        //console.log($('#modal-masalahtampildata').modal('show'));
       // console.log($(this).data('id-sasaran'));
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
								alert("Terjadi kesalahan saat menghapus data!");
							}
						$(document).ajaxComplete(function(e, xhr, opt)
						{

						});
					});
				});
			break;

			case 'deleteindikator':
				$('a#btn-yes').on('click', function() 
				{
					$.post(base_url + '/sasaran/delete/' + ID + '/' + 'indikator', function(result) 
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


	//DELETE
	 $('.get-delete-akar').click( function() 
    {
        $('#modal-delete').modal('show');

        $('a#btn-yes').attr('href', base_url + '/sasaran/delete_akar/' + $(this).data('id'));
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

	function get_satuan_json(selector) {
		var option = '<option value="">-- pilih satuan -- </option>';
		$.get(base_url + '/sasaran/get_satuan_json', function(resultSatuan) {
			$.each(resultSatuan, function(key, value)
			{                    			
			    option += '<option value="'+value.id+'">'+value.nama+'</option>';
			});

			$(selector).html(option);
		});
	}

	function indikator_program_json(selector) {
		var option = '<option value="">-- PILIH -- </option>';
		$.get(base_url + '/sasaran/indikator_program_json', function(resultIndikatorSasaran) {
			$.each(resultIndikatorSasaran, function(key, value)
			{                    			
			    option += '<option value="'+value.id+'">'+value.deskripsi+'</option>';
			});

			$(selector).html(option);
		});
	}

	
	function add_form_sasaran(data, key, nomor, parent) {

	var html = '<tr id="baris-'+data+'-'+nomor+'"><td>'+'</td>';
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
		html += '<a href="javascript:void(0)" id="delete-form" data-delete="tr#baris-'+data+'-'+nomor+'" title="Hapus sasaran ini?" class="btn btn-default"><i class="fa fa-times"></i></a>';
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

function add_form_indikator_sasaran(data, key, nomor, parent) {

	var html = '<tr id="baris-'+data+'-'+nomor+'"><td>'+ nomor +'</td>';
	html += '<td>';

	for( var tahun = $('tbody#data-' + data).data('tahun-awal'); tahun <= $('tbody#data-' + data).data('tahun-akhir'); tahun++)
	{
		html += '<div class="col-md-6"><label>';
		html += '<input type="checkbox" checked name="create[tahun]['+data+']['+tahun+']" value="'+tahun+'"> ' + tahun;
		html += '</label></div>'
	}
		html += '</td><td>';
		

		html += '<textarea required="required" name="create[deskripsi]['+data+']" class="form-control" rows="2"></textarea>';
		html += '</td><td class="text-center">',
		html += '<select required="required" name="create[id_satuan]['+data+']" id="selectSatuan-'+data+'-'+nomor+'" class="form-control input-sm" >';
		html += '</td><td class="text-center">',
		html+=  '<input name="create[pk]['+data+']" value="yes" type="checkbox" class="minimal" > PK';
		html += '</td><td class="text-center">',
		html+=  '<input name="create[iku]['+data+']" value="yes" type="checkbox" class="minimal" > IKU';
		html += '</td><td class="text-center">',
		html += '<a href="javascript:void(0)" id="delete-form" data-delete="tr#baris-'+data+'-'+nomor+'" title="Hapus sasaran indikator ini?" class="btn btn-default"><i class="fa fa-times"></i></a>';
	    html += '</td>';
	    html += '</tr>';

	$(html).appendTo('tbody#data-' + data).hide().fadeIn(500).addClass('bg-silver');

	indikator_program_json('select#select-' + data + '-' + nomor);

	get_satuan_json('select#selectSatuan-' + data + '-' + nomor);

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


