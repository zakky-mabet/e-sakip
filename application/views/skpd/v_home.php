<div class="row">
    <div class="col-md-3">
        <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-files-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Misi</span>
                <span class="info-box-number"><?php echo $this->db->get_where('misi', array('id_kepala' => $this->kepala))->num_rows(); ?></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                </div>
            </div>
        </div>
        <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="fa fa-files-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Tujuan</span>
                <span class="info-box-number"><?php echo $this->db->get_where('tujuan', array('id_kepala' => $this->kepala))->num_rows(); ?></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                </div>
            </div>
        </div>
        <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-files-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Sasaran</span>
                <span class="info-box-number"><?php echo $this->db->get_where('sasaran', array('id_kepala' => $this->kepala))->num_rows(); ?></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                </div>
            </div>
        </div>
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-files-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Indikator</span>
                <span class="info-box-number">3</span>
                <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                </div>
            </div>
        </div>
        <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-files-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Program</span>
                <span class="info-box-number">3</span>
                <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-default">
            <div class="box-body no-padding">
                <table class="table table-striped">
                    <thead>
                        <tr class="bg-gray">
                            <th class="text-center">TAHUN</th>
                            <th class="text-center">NO</th>
                            <th class="text-center">DOKUMEN</th>
                            <th class="text-center">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4">Data belum tersedia!</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border bg-blue">
                <h3 class="box-title">Alur Pengisian Data</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
                </div>
            </div>
            <div class="box-body" style="padding-left: 12px;">
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">1</span>
                    <span>Visi</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">2</span>
                    <span>Misi</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">3</span>
                    <span>Tujuan</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">4</span>
                    <span>Sasaran</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">5</span>
                    <span>Indikator Kinerja dan Sasaran</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">6</span>
                    <span>Target</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">7</span>
                    <span>Program dan Anggaran</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">8</span>
                    <span>Kegiatan</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">9</span>
                    <span>Anggaran Kegiatan</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">10</span>
                    <span>Kegiatan</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">11</span>
                    <span>Target</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">12</span>
                    <span>Program dan Anggaran</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">13</span>
                    <span>Kegiatan</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">14</span>
                    <span>Anggaran Kegiatan</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">15</span>
                    <span>Kegiatan</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">16</span>
                    <span>Anggaran Kegiatan</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">17</span>
                    <span>Kegiatan</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">18</span>
                    <span>Target</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">19</span>
                    <span>Program dan Anggaran</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">20</span>
                    <span>Kegiatan</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">21</span>
                    <span>Anggaran Kegiatan</span>
                </a>
                <a class="csurat hvr-pulse-grow" href="">
                    <span class="number">22</span>
                    <span>Kegiatan</span>
                </a>
            </div>

        </div>
    </div>


</div>



