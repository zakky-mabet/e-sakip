<div class="row">
   <div class="col-md-12">
  
        <form action="" method="POST" role="form">
        <ul class="timeline">
            <li class="time-label">
                  <span class="bg-grey">Entry Misi</span>
            </li>
            <li>
                <i class="fa fa-arrow-down"></i>
                <div class="timeline-item">
                    <div class="timeline-body">
                         <div class="row-fluid">
            <div class="span6">
                <form action="" method="post">
                    <table class="table table-bordered ">
                        <thead class="bg-green">
                            <tr>
                                <th width="10px">No</th>
                                <th width="40px">Tahun Aktif</th>
                                <th width="80px"> Misi</th>
                                <th width="80px"> </th>
                            </tr>
                        </thead>
                        <!--elemet sebagai target append-->
                        <tbody id="itemlist">
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td><input name="jumlah_input[0]" class="input-block-level form-control" /></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-small btn-default" onclick="additem(); return false"><i class="fa fa-plus"></i></button>
                                    <button name="submit" class="btn btn-small btn-success"><i class="fa fa-save"></i> Simpan</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
 
 
            </div>
            <div class="span6">
               
                <p>
                    <?php
                    if (isset($_POST['submit'])) {
                        $jenis = $_POST['jenis_input'];
                        $jumlah = $_POST['jumlah_input'];
 
                        foreach ($jenis as $key => $j) {
                            echo "<p>". $j . " : " . $jumlah[$key] . "</p>";
                        }
                    }
                    ?>
                </p>
            </div>
        </div>
        <script>
            var i = 1;
            function additem() {
//                menentukan target append
                var itemlist = document.getElementById('itemlist');
                
//                membuat element
                var row = document.createElement('tr');
                var jenis = document.createElement('td');
                var jumlah = document.createElement('td');
                var aksi = document.createElement('td');
 
//                meng append element
                itemlist.appendChild(row);
                row.appendChild(jenis);
                row.appendChild(jumlah);
                row.appendChild(aksi);
 
//                membuat element input
                var jenis_input = document.createElement('input');
                jenis_input.setAttribute('name', 'jenis_input[' + i + ']');
                jenis_input.setAttribute('class', 'input-block-level');
 
                var jumlah_input = document.createElement('input');
                jumlah_input.setAttribute('name', 'jumlah_input[' + i + ']');
                jumlah_input.setAttribute('class', 'input-block-level');
 
                var hapus = document.createElement('span');
 
//                meng append element input
                jenis.appendChild(jenis_input);
                jumlah.appendChild(jumlah_input);
                aksi.appendChild(hapus);
 
                hapus.innerHTML = '<button class="btn btn-small btn-default"><i class="icon-trash"></i></button>';
//                membuat aksi delete element
                hapus.onclick = function () {
                    row.parentNode.removeChild(row);
                };
 
                i++;
            }
        </script>
                    </div>
                </div>
            </li>
        </ul>
        </form>
    </div>
</div>