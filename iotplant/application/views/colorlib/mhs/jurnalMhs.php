<?php 
if ($this->uri->segment(3)=='edit') {
    $visb = null;
    $edt = null;
}else{
    $edt = '<a class="close-link" href="'.site_url($this->uri->segment(1)."/".$this->uri->segment(2)."/edit").'"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Ubah Data Jurnal"> Ubah </i></a>';
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
                            <li><a class="collapse-link" data-toggle="tooltip" data-placement="top" data-original-title="Refresh" href="<?php echo site_url($this->uri->segment(1)."/".$this->uri->segment(2)) ?>"><i class="fa fa-refresh"></i> Refresh</a>
                            </li>
                        	<li><?= $edt; ?></li>
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>

                    </div>
                    <div class="x_content">    
                        <br />
                        <?php $atrib = array('id' => 'jurnalMhs', 'class' => 'form-horizontal form-label-left'); ?>
                        <?= form_open_multipart($this->uri->segment(1).'/update',$atrib); ?>
                        <?php $flash = $this->session->flashdata('jurnalMhs');
                        $data = array(
                            'id_jurnal'  => (isset($row)) ? $row->id_jurnal : null,
                            // 'fk_mhs' => (isset($row)) ? $row->fk_mhs : null
                        );
                        echo form_hidden($data);

                        /*echo "<pre>";
                        print_r($flash);
                        echo "</pre>";*/
                        ?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Judul Jurnal <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" name="judul" value="<?= (isset($row)) ? $row->judul : $input = (isset($flash->input)) ? $flash->input->judul : NULL; ?>" required="required" class="form-control col-md-7 col-xs-12" <?= $visb; ?>>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Abstrak <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12" <?= $visb; ?>>
                          <textarea name="abstrak" rows="6" required="required" class="form-control col-md-7 col-xs-12" <?= $visb; ?>><?= (isset($row)) ? $row->abstrak : NULL; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pembimbing 1<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="pembimbing_1" class="form-control" <?= $visb; ?>>
                        <?php if (isset($row)): ?>
                            <option value="<?= (isset($row->pembimbing_1)) ? $row->pembimbing_1 : null; ?>"><?= (isset($row->pembimbing_1)) ? $this->db->get_where('dosen', array('id_dosen' => $row->pembimbing_1))->row()->nama_dosen : null; ?></option>
                        <?php endif ?>
                        <?php foreach ($p1 as $key => $value):?>
                            <option value="<?= $value['id_dosen']; ?>"><?= $value['nama_dosen']; ?></option>
                        <?php endforeach ?>
                        </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pembimbing 2<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="pembimbing_2" class="form-control" <?= $visb; ?>>
                        <?php if (isset($row)): ?>
                            <option value="<?= (isset($row->pembimbing_2)) ? $row->pembimbing_2 : null; ?>"><?= (isset($row->pembimbing_2)) ? $this->db->get_where('dosen', array('id_dosen' => $row->pembimbing_2))->row()->nama_dosen : null; ?></option>
                        <?php endif ?>
                        <?php foreach ($p2 as $key => $value): ?>
                            <option value="<?= $value['id_dosen']; ?>"><?= $value['nama_dosen']; ?></option>
                        <?php endforeach ?>
                        </select>
                        </div>
                      </div>
                      <?php if ($this->uri->segment(3)=='edit'): ?>
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
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $formUpload;?></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="close-link" href="<?= site_url($this->uri->segment(1).'/bukti');?>" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Cetak Bukti Upload File Jurnal dan Scan Data"><i class="fa fa-print"> <small>Cetak Bukti Upload</small></i></a></li>
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>

                    </div>
                    <div class="x_content">    
                        <br />
                        <?php $atrib = array('id' => 'jurnalUpload', 'class' => 'form-horizontal form-label-left'); ?>
                        <?= form_open_multipart($this->uri->segment(1).'/upload',$atrib); ?>
                        <?php $flash = $this->session->flashdata('jurnalUpload');
                        $data = array(
                            'id_jurnal'  => (isset($row)) ? $row->id_jurnal : null,
                            // 'fk_mhs' => (isset($row)) ? $row->fk_mhs : null
                        );
                        echo form_hidden($data);

                        /*echo "<pre>";
                        print_r($flash);
                        echo "</pre>";*/
                        ?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Upload Scan Bukti <span class="required">*</span> (.jpg)
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="file_bukti" required="required" class="form-control col-md-7 col-xs-12" >
                        <span class="label label-danger">Size Max : 500 KB</span>
                        </div>
                        
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Upload File Jurnal <span class="required">*</span> (.docx)
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="file_jurnal" required="required" class="form-control col-md-7 col-xs-12" >
                          <span class="label label-danger">Size Max : 2 MB</span>
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
                    <?= form_close(); ?>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- /page content  -->