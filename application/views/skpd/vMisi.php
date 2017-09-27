<div class="row">
   <div class="col-md-12">
  
        <form action="" method="POST" role="form">
        <ul class="timeline">
            <li class="time-label">
                  <span class="bg-green">Entry Misi</span>
            </li>
            <li>
                <i class="fa fa-arrow-down"></i>
                <div class="timeline-item">
                    <div class="timeline-body">
                         <div class="row-fluid">
            <div class="span6">
          
                <form action="<?php echo current_url() ?>" class="form-horizontal" method="post">
                    <table class="table table-bordered ">
                        <thead class="bg-green">
                            <tr>
                                <th width="5px" class="text-center">No</th>
                                <th width="10px" class="text-center">Tahun Aktif</th>
                                <th width="230px" class="text-center"> Misi</th>
                                <th width="10px" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <!--elemet sebagai target append-->

                        <tbody id="itemlist">
                       


                        <?php 
                        $no=1;
                        foreach ($misi as $key => $value) { ?>

                            <tr>
                                <td class="text-center"><?php echo $no++ ?></td>
                                <td width="30px" class="">

                        <?php 
                            $x = $value->periode_awal;
                            while($x <= $value->periode_akhir ){ ?>
                               
                                <button type="button" class="btn btn-md" style="margin-bottom: 4px; margin-bottom: 4px">
                                <input  <?php if (in_array($x,explode(',', $value->tahun) )) {echo 'checked="checked"';
                                    
                                } ?> name="input_tahun[0][tahun]" value="<?php echo $x ?>" type="checkbox" class="minimal" >
                                <span class="em3 text-center"> <?php echo $x ?></span>
                            </button>
                        <?php   $x++; } ?>
                          <p class="help-block"><?php echo form_error('input_tahun[0][tahun]', '<small class="text-red">', '</small>'); ?></p> 
                                </td>
                                <td width="240px">
                                <textarea name="input_misi[0][misi]" class="input-block-level form-control"><?php echo $value->deskripsi ?></textarea>
                                <p class="help-block"><?php echo form_error('input_misi[0][misi]', '<small class="text-red">', '</small>'); ?></p> 
                                </td>
                                <td></td>
                            </tr>

                        <?php } ?>    
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td width="10px">
                                    <button class="btn btn-small btn-default" onclick="additem(); return false">
                                    <i class="fa fa-plus"></i></button>
                                    <button name="submit" class="btn btn-small btn-success"><i class="fa fa-save"></i> Simpan</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
 
 
            </div>
     
        </div>

       

        <script>
            var i = 1;
            function additem() {
//                menentukan target append
                var itemlist = document.getElementById('itemlist');
                
//              membuat element
                var row = document.createElement('tr');
                var no = document.createElement('td');
                var tahun = document.createElement('td');
                var jumlah = document.createElement('td');
                var aksi = document.createElement('td');
 
                // meng append element
                itemlist.appendChild(row);
                row.appendChild(no);
                row.appendChild(tahun);
                row.appendChild(jumlah);
                row.appendChild(aksi);
 
//              membuat element input
                var input_misi = document.createElement('textarea');
                input_misi.setAttribute('name', 'input_misi[' + i + ']');
                input_misi.setAttribute('class', 'input-block-level form-control');
 
                var hapus = document.createElement('span');

                var input_tahun = document.createElement('span');

                
 
//              meng append element input
                tahun.appendChild(input_tahun);
                jumlah.appendChild(input_misi);
                aksi.appendChild(hapus);


                hapus.innerHTML = '<button class="btn btn-small btn-danger"><i class="fa fa-trash"></i></button>';

           

                input_tahun.innerHTML ='<?php
                            $x = $value->periode_awal;
                            while($x <= $value->periode_akhir ){ ?><button type="button" class="btn btn-md" style="margin-bottom:4px; margin-bottom:4px"><input  name="input_tahun[0]" value="<?php echo $x ?>" type="checkbox" class="minimal" ><span class="em3 text-center"> <?php echo $x ?></span></button><?php $x++; } ?>' ;

               
//              membuat aksi delete element
                hapus.onclick = function () {
                    row.parentNode.removeChild(row);
                };
 
                i++;
            }
               
        </script>
        
                    </div>
                </div>
            </li>
            <li class="time-label">
    
                  <i class="fa  fa-circle"></i>
            </li>
        </ul>
        </form>
    </div>
</div>