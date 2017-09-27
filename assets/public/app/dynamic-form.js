$(document).ready( function() 
{
	var key = 1;
	$('button#btn-add-tujuan').on('click', function()
	{
		var ID = $(this).data('id');
		var nomor = $('tbody#data-'+ ID ).children().length;

		add_form(ID, key, ++nomor, $(this).data('parent') );
	});
});


function add_form(data, key, nomor, parent) {
	var html = '<tr id="baris-'+parent+'-'+nomor+'"><td>'+ parent +'.'+nomor+'</td>';
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

		console.log(parent + '-' + nomor);
		console.log(html);

		$('a#delete-form').on('click', function()
		{
			key--;
			nomor--;
			$($(this).data('delete')).addClass('bg-red').fadeOut(300, function() {
				$(this).remove();
			});
		});
}