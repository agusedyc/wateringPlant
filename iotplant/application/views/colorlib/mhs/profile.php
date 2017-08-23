<?php 
if ($this->uri->segment(3)=='edit') {
    $visb = null;
    $edt = null;
}else{
    // $edt = '<a class="btn btn-warning btn-xs" href="'.site_url($this->uri->segment(1)."/".$this->uri->segment(2)."/edit").'" ><i class="fa fa-gear">  Ubah </i></a>';
    $edt = '<a class="close-link" href="'.site_url($this->uri->segment(1)."/".$this->uri->segment(2)."/edit").'"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Ubah Data Profile Mahasiswa"> Ubah </i></a>';
    $visb = 'disabled="disabled"';
}

 ?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= $title;?></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $form;?></h2> 
                        <ul class="nav navbar-right panel_toolbox">
                            <li><?php echo $edt; ?></li>
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>

                    </div>
                    <div class="x_content">    
                        <br />
                        <?php $atrib = array('id' => 'profileMhs', 'class' => 'form-horizontal form-label-left'); ?>
                        <?= form_open_multipart($this->uri->segment(1).'/'.$act = (isset($row)) ? 'update' : 'add',$atrib); ?>
                        <?php $flash = $this->session->flashdata('profileMhs');
                        $data = array(
                            'id_mhs'  => (isset($row)) ? $row->id_mhs : null,
                            'fk_user' => (isset($row)) ? $row->fk_user : null
                        );
                        echo form_hidden($data);

                        /*echo "<pre>";
                        print_r($flash);
                        echo "</pre>";*/
                        ?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">NIM <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="nim" value="<?= (isset($row)) ? $row->nim : $input = (isset($flash)) ? $flash->input->nim : NULL; ?>" required="required" class="form-control col-md-7 col-xs-12" disabled="disabled">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama lengkap <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="nama_mhs" value="<?= (isset($row)) ? $row->nama_mhs : $input = (isset($flash)) ? $flash->input->nama_mhs : NULL; ?>" required="required" class="form-control col-md-7 col-xs-12"<?= $visb; ?>>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="email" value="<?= (isset($row)) ? $row->email : $input = (isset($flash)) ? $flash->input->email : NULL; ?>" required="required" class="form-control col-md-7 col-xs-12" disabled="disabled">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="username" value="<?= (isset($row)) ? $row->username : $input = (isset($flash)) ? $flash->input->username : NULL; ?>" required="required" class="form-control col-md-7 col-xs-12" disabled="disabled">
                        </div>
                      </div>
                      <?php if ($this->uri->segment(3)=='edit'): ?>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" name="password" placeholder="Isi kolom password jika akan di ganti" value="" class="form-control col-md-7 col-xs-12" <?= $visb; ?>>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-3">
                          <a href="<?= site_url($this->uri->segment(1).'/'.$this->uri->segment(2));?>" type="submit" class="btn btn-primary">Cancel</a>
                           <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                        <div class="col-md-6">
                            <!-- Flash Data -->
                            <?php if (!empty($flash->notif)): ?>
                            <div class="alert alert-<?php echo $flash->type; ?> alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Alert!</strong> <?php echo $flash->notif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                      </div>
                      <?php endif ?>
                    <?= form_close(); ?>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- /page content  -->