
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
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>

                    </div>
                    <div class="x_content">                    
                        <br />
                        <?php $atrib = array('id' => 'dtDosen', 'class' => 'form-vertical form-label-left'); ?>
                        <?= form_open_multipart($this->uri->segment(1).'/'.$act = (isset($row)) ? 'update' : 'add',$atrib); ?>
                        <?php $flash = $this->session->flashdata('dataDosen');
                        $data = array(
                            'id_dosen'  => (isset($row)) ? $row->id_dosen : null,
                            'fk_user' => (isset($row)) ? $row->fk_user : null
                        );
                        echo form_hidden($data);
                        ?>
                            <div class="form-group col-md-2">
                                <label>NIS Dosen <span class="required">*</span></label>
                                <input type="text" name="nis" value="<?= (isset($row)) ? $row->nis : $input = (isset($flash)) ? $flash->input->nis : NULL; ?>" id="first-name" required="required" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Nama Dosen <span class="required">*</span></label>
                                <input type="text" name="nama_dosen" value="<?= (isset($row)) ? $row->nama_dosen : $input = (isset($flash)) ? $flash->input->nama_dosen : NULL; ?>" id="first-name" required="required" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Status Pembimbing <span class="required">*</span></label>
                                <select name="status" class="form-control">
                                <?php if (isset($row)): ?>
                                    <option value="<?= (isset($row)) ? $row->status : null; ?>"><?= (isset($row)) ? $row->status : null; ?></option>
                                <?php endif ?>
                                <?php foreach ($dd as $key => $value): ?>
                                    <option value="<?= $value; ?>"><?= $value; ?></option>
                                <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Username <span class="required">*</span></label>
                                <input type="text" name="username" value="<?= (isset($row)) ? $row->username : NULL; ?>" id="first-name" required="required" class="form-control" <?php echo $retVal = (isset($row)) ? 'disabled="disabled"' :null ; ?>>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Password <span class="required">*</span></label>
                                <input type="password" name="password" placeholder="Isi Jika Diganti" class="form-control">
                            </div>
                            <div class="ln_solid col-md-12"></div>
                            <div class="form-group col-md-12">
                                <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-3">
                                    <a href="<?= site_url($this->uri->segment(1));?>" type="submit" class="btn btn-primary">Cancel</a>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="col-md-6">
                                    <!-- Flash Data -->
                                    <?php if (!empty($flash)): ?>
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
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $table;?></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIS Dosen</th>
                                    <th>Nama Dosen</th>
                                    <th>Status Pembimbing</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($rows->result() as $value): $no++?>
                                <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td><?= $value->nis; ?></td>
                                    <td><?= $value->nama_dosen; ?></td>
                                    <td><?= $value->status; ?></td>
                                    <td>
                                      <a href="<?= site_url($this->uri->segment(1).'/select/'.$value->id_dosen);?>">Edit </a> <!-- |
                                      <a href="<?= site_url($this->uri->segment(1).'/delete/'.$value->id_dosen);?>">Delete </a> -->
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="ln_solid col-md-12"></div>
                    <div class="row">
                      <div class="col-md-12" align="center">
                        <?php echo $pagination; ?>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- /page content  -->