<div class="row">
    <div class="col-md-3">
        <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-files-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Misi</span>
                <span class="info-box-number"><?php echo $this->setting->countMisi(); ?></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
            </div>
        </div>
        <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="fa fa-files-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Tujuan</span>
                <span class="info-box-number"><?php echo $this->setting->countTujuan(); ?></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
            </div>
        </div>
        <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-files-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Sasaran</span>
                <span class="info-box-number"><?php echo $this->setting->countSasaran(); ?></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
            </div>
        </div>
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-files-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Indikator</span>
                <span class="info-box-number"><?php echo $this->setting->countIndikatorKinerja() ?></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
            </div>
        </div>
        <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-files-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Program</span>
                <span class="info-box-number"><?php echo $this->setting->countProgram() ?></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-default">
            <div class="box-header">
                <strong class="box-heading">STATUS PENGISIAN RENSTRA : </strong> 
            </div>
            <div class="box-body">
                <span class="badge" style="width: 100%; display: inline-block; padding: 10px; background-color: <?php echo $this->setting->statusWarna() ?>">Status Warna</span>
            </div>
        </div>
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
    </div>


</div>



