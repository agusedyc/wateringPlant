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
                        <?php $atrib = array('id' => 'dtPenyiram', 'class' => 'form-vertical form-label-left'); ?>
                        <?= form_open_multipart($this->uri->segment(1).'/'.$act = (isset($row)) ? 'update' : 'add',$atrib); ?>
                        <input type="hidden" name="id_user" value="<?= (isset($row)) ? $row->id_user : null; ?>" >
                            <div class="form-group col-md-2">
                                <label>Nama <span class="required">*</span></label>
                                <input type="text" name="name" value="<?= (isset($row)) ? $row->name : null; ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Roles <span class="required">*</span></label>
                                <select name="role" class="form-control">
                                <?php if (isset($row)): ?>
                                    <option value="<?= (isset($row)) ? $row->id_role : null; ?>"><?= (isset($row)) ? $row->role_name : null; ?></option>
                                <?php endif ?>
                                <?php foreach ($dd as $value): ?>
                                    <option value="<?= $value['id_role']; ?>"><?= $value['role_name']; ?></option>
                                <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Username <span class="required">*</span></label>
                                <input type="text" name="username" value="<?= (isset($row)) ? $row->username : null; ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Password <span class="required">*</span></label>
                                <input type="password" name="password" placeholder="Isi Jika Diganti" class="form-control">
                            </div>
                            <div class="ln_solid col-md-12"></div>
                            <div class="form-group col-md-12">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <a href="<?= site_url($this->uri->segment(1));?>" type="submit" class="btn btn-primary">Cancel</a>
                                    <button type="submit" class="btn btn-success">Submit</button>
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
                                    <th>Role</th>
                                    <th>username</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($rows->result() as $value): $no++?>
                                <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td><?= $value->name; ?></td>
                                    <td><?= $value->role_name; ?></td>
                                    <td><?= $value->username; ?></td>
                                    <td>
                                      <a href="<?= site_url($this->uri->segment(1).'/select/'.$value->id_user);?>">Edit </a> |
                                      <a href="<?= site_url($this->uri->segment(1).'/delete/'.$value->id_user);?>">Delete </a>
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