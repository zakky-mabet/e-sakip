<div class="row">
   <div class="col-md-12">
        <form action="" method="POST" role="form">
        <ul class="timeline">
            <li class="time-label">
                  <span class="bg-grey">Entry Visi</span>
            </li>
            <li>
                <i class="fa fa-arrow-down"></i>
                <div class="timeline-item">
                    <div class="timeline-body">
                    <?php if( $visi == FALSE) : ?>
                        <div class="form-group">
                            <label>Visi</label>
                            <textarea name="visi" class="form-control" rows="2"><?php echo set_value('visi') ?></textarea>
                            <p class="help-block"><?php echo form_error('visi', '<small class="text-red">', '</small>'); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Penjabaran Visi</label>
                            <p class="help-block"><?php echo form_error('penjabaran', '<small class="text-red">', '</small>'); ?></p>
                            <textarea name="penjabaran" class="form-control summernote"><?php echo set_value('penjabaran') ?></textarea>
                        </div>
                    <?php else : ?>
                        <div class="form-group">
                            <label>Visi</label>
                            <textarea name="visi" class="form-control" rows="2"><?php echo (set_value('visi')) ? set_value('visi') : $visi->deskripsi ?></textarea>
                            <p class="help-block"><?php echo form_error('visi', '<small class="text-red">', '</small>'); ?></p>
                        </div>
                        <div class="form-group">
                            <label>Penjabaran Visi</label>
                            <p class="help-block"><?php echo form_error('penjabaran', '<small class="text-red">', '</small>'); ?></p>
                            <textarea name="penjabaran" class="form-control summernote"><?php echo (set_value('penjabaran')) ? set_value('penjabaran') : $visi->penjabaran ?></textarea>
                        </div>
                    <?php endif; ?>
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