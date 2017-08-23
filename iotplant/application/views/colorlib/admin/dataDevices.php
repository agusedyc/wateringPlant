
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
                        <?php $atrib = array('id' => 'dtDevice', 'class' => 'form-vertical form-label-left'); ?>
                        <?= form_open_multipart($this->uri->segment(1).'/'.$act = (isset($row)) ? 'update' : 'add',$atrib); ?>
                        <?php $flash = $this->session->flashdata('dataDevices');
                        $data = array(
                            'id_device'  => (isset($row)) ? $row->id_device : null,
                            // 'fk_user' => (isset($row)) ? $row->fk_user : null
                        );
                        echo form_hidden($data);
                        ?>
                            <div class="form-group col-md-4">
                                <label>Nama <span class="required">*</span></label>
                                <input type="text" name="name" value="<?= (isset($row)) ? $row->name : $input = (isset($flash)) ? $flash->input->name : NULL; ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Alat <span class="required">*</span></label>
                                <input type="text" name="device" value="<?= (isset($row)) ? $row->device : $input = (isset($flash)) ? $flash->input->device : NULL; ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Token <span class="required">*</span></label>
                                <input type="text" name="device_token" value="<?= (isset($row)) ? $row->device_token : $input = (isset($flash)) ? $flash->input->device_token : NULL; ?>" class="form-control">
                            </div>
                            <!-- <div class="form-group col-md-4">
                                <label>Nama Tanaman <span class="required">*</span></label>
                                <input type="text" name="plant_name" value="<?= (isset($row)) ? $row->plant_name : $input = (isset($flash)) ? $flash->input->plant_name : NULL; ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Waktu Siram Pagi <span class="required">*</span></label>
                                <input type="text" name="watering_am" value="<?= (isset($row)) ? $row->watering_am : $input = (isset($flash)) ? $flash->input->watering_am : NULL; ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Waktu Siram Sore <span class="required">*</span></label>
                                <input type="text" name="watering_pm" value="<?= (isset($row)) ? $row->watering_pm : $input = (isset($flash)) ? $flash->input->watering_pm : NULL; ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Weight C1 <span class="required">*</span></label>
                                <input type="text" name="weight_c1" value="<?= (isset($row)) ? $row->weight_c1 : $input = (isset($flash)) ? $flash->input->weight_c1 : NULL; ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Weight C2 <span class="required">*</span></label>
                                <input type="text" name="weight_c2" value="<?= (isset($row)) ? $row->weight_c2 : $input = (isset($flash)) ? $flash->input->weight_c2 : NULL; ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Weight C3 <span class="required">*</span></label>
                                <input type="text" name="weight_c3" value="<?= (isset($row)) ? $row->weight_c3 : $input = (isset($flash)) ? $flash->input->weight_c3 : NULL; ?>" class="form-control">
                            </div> -->
                            <!-- <div class="form-group col-md-2">
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
                            </div> -->
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
                                    <th>Nama</th>
                                    <th>Alat</th>
                                    <th>Status</th>
                                    <th>Token</th>
                                    <!-- <th>Tanaman</th>
                                    <th>Siram Pagi</th>
                                    <th>Siram Sore</th>
                                    <th>Weight C1</th>
                                    <th>Weight C2</th>
                                    <th>Weight C3</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
<!-- data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip top" -->
                            <?php foreach ($rows->result() as $value): $no++?>
                                <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo "Device Status ".$retVal = ($value->status=='1') ? "Online" : "Offline" ; ?>">
                                            <?= $value->name; ?>
                                        </a>                                        
                                    </td>
                                    <td><?= $value->device; ?></td>
                                    <td><?php echo $retVal = ($value->status=='1') ? "Online" : "Offline" ; ?></td>
                                    <td><?= $value->device_token; ?></td>
                                    <!-- <td><?= $value->plant_name; ?></td>
                                    <td><?= $value->watering_am; ?></td>
                                    <td><?= $value->watering_pm; ?></td>
                                    <td><?= $value->weight_c1; ?></td>
                                    <td><?= $value->weight_c2; ?></td>
                                    <td><?= $value->weight_c3; ?></td> -->
                                    <td>
                                      <a href="<?= site_url($this->uri->segment(1).'/select/'.$value->id_device);?>">Edit </a>
                                      <!-- |
                                      <a href="<?= site_url($this->uri->segment(1).'/delete/'.$value->id_device);?>">Delete </a> -->
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