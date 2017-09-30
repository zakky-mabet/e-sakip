<div class="row">
<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
   <div class="col-md-12">
    
        <ul class="timeline">
            <li class="time-label">
                  <span class="bg-blue">Entry Misi</span>
            </li>
            <li>
                <i class="fa fa-pencil"></i>
                <div class="timeline-item">
                    <div class="timeline-body">
                         <div class="row-fluid">
            <div class="span6">
          
                <form action="<?php echo site_url('skpd/misi/createorupdate') ?>" class="form-horizontal" method="post">
                    <table class="table table-bordered ">
                        <thead class="bg-blue">
                            <tr>
                                <th width="5" class="text-center">No</th>
                                <th width="100" class="text-center">Tahun Aktif</th>
                                <th width="430" class="text-center"> Misi</th>
                                <th width="10" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <!--elemet sebagai target append-->

                        <tbody id="itemlist">

                        <?php 

                        $no=1;
                        foreach ($misi as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?php echo $no++ ?></td>
                                <td class="">
                        <?php 
                            $x = $value->periode_awal;
                            while($x <= $value->periode_akhir ){ ?>
                               
                                <button type="button" class="btn btn-md" style="margin-bottom: 4px; margin-bottom: 4px">
                                <input  <?php if (in_array($x,explode(',', $value->tahun) )) {echo 'checked="checked"';
                                    
                                } ?> name="update[tahun][<?php echo $value->id_misi ?>][]" value="<?php echo $x ?>" type="checkbox" class="minimal" >
                                <span class="em3 text-center"> <?php echo $x ?></span>
                            </button>

                        <?php echo form_hidden("update[ID][]", $value->id_misi);   $x++; } ?>
                         
                                </td>
                                <td >
                                <textarea required="required" name="update[deskripsi][<?php echo $value->id_misi ?>]" class="input-block-level form-control"><?php echo $value->deskripsi ?></textarea>
                               
                                </td>
                                <td><a href="#" class="get-delete-misi" data-id="<?php echo $value->id_misi; ?>" data-toggle="tooltip" data-placement="top" title="Hapus"><span class="btn btn-small btn-danger"><i class="fa fa-trash"></i></td>
                            </tr>
                          
                            
                        <?php } ?>

                        <?php if (count($misi) == 0): ?>
                                <tr>
                                <td class="text-center"><?php echo $no++ ?></td>
                                <td class="">
                                    <?php 
                                $x = $this->m_misi->get_periode()->periode_awal;
                                while($x <= $this->m_misi->get_periode()->periode_akhir ){ ?>
                               
                                <button type="button" class="btn btn-md" style="margin-bottom: 4px; margin-bottom: 4px">
                                <input  name="create[tahun]['<?php echo $this->session->userdata('SKPD')->kepala ?>'][]" value="<?php echo $x ?>" type="checkbox" class="minimal" >
                                <span class="em3 text-center"> <?php echo $x ?></span>
                            </button>

                        <?php  $x++; } ?>                    
                                </td>
                                
                                <td >
                                <textarea required="required" name="create[deskripsi]['<?php echo $this->session->userdata('SKPD')->kepala ?>']" class="input-block-level form-control"></textarea>

                                </td>
                                <td></td>
                            </tr>
                            <?php endif ?>
                        

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td width="10px">
                                    <button class="btn btn-small btn-default" onclick="additem(); return false">
                                    <i class="fa fa-plus"></i></button>
                                    <button class="btn btn-small btn-success"><i class="fa fa-save"></i> Simpan</button>
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
                input_misi.setAttribute('name', 'create[deskripsi][<?php echo $this->session->userdata('SKPD')->kepala ?>]');
                input_misi.setAttribute('class', 'input-block-level form-control');
                input_misi.setAttribute('required', 'required');
 
                var hapus = document.createElement('span');

                var input_tahun = document.createElement('span');

//              meng append element input
                tahun.appendChild(input_tahun);
                jumlah.appendChild(input_misi);
                aksi.appendChild(hapus);

                hapus.innerHTML = '<button class="btn btn-small btn-danger"><i class="fa fa-trash"></i></button>';

           

                input_tahun.innerHTML ='<?php
                            $x = $this->m_misi->get_periode()->periode_awal;
                            while($x <= $this->m_misi->get_periode()->periode_akhir ){ ?><button type="button" class="btn btn-md" style="margin-bottom:4px;  margin-bottom:4px"><input  name="create[tahun][<?php  echo $this->session->userdata('SKPD')->kepala ?>][]" value="<?php echo $x ?>"  type="checkbox" <?php if ($x==date('Y')) {echo 'required="required"';} ?>class="minimal" ><span class="em3 text-center"> <?php echo $x ?></span></button><?php $x++; } ?>' ;

               
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

<script>
                         /*!
    * Modal Delete 
    */
    $('.get-delete-misi').click( function() 
    {
        $('#modal-delete').modal('show');

        $('a#btn-delete').attr('href', base_url + '/misi/delete/' + $(this).data('id'));
    });
                </script>


<div class="modal animated fadeIn modal-danger" id="modal-delete" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-question-circle"></i> Hapus!</h4>
                <span>Hapus data ini dari sistem?</span>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
                <a href="#" id="btn-delete" class="btn btn-outline"> Hapus </a>
            </div>
        </div>
    </div>
</div>