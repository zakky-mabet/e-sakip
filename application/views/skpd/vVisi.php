<div class="row">
   <div class="col-md-12">
    <?php echo "<pre>";
    print_r ($this->session->userdata());
    echo "</pre>"; ?>
        <form action="" method="POST" role="form">
        <ul class="timeline">
            <li class="time-label">
                  <span class="bg-grey">Entry Visi</span>
            </li>
            <li>
                <i class="fa fa-arrow-down"></i>
                <div class="timeline-item">
                    <div class="timeline-body">
                        <div class="form-group">
                            <label for="">Visi</label>
                            <textarea name="" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Penjabaran Visi</label>
                            <textarea name="sdf" class="form-control summernote "></textarea>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button class="btn btn-app pull-right"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        </form>
    </div>
</div>