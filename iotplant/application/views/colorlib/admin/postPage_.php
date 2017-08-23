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
                    <h2><i class="fa fa-bars"></i> <?= $form;?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php $atrib = array('id' => 'post', 'class' => 'form-vertical form-label-left'); ?>
                        <?= form_open_multipart($this->uri->segment(1).'/'.$act = (isset($row)) ? 'update' : 'add',$atrib); ?>
                        <input type="hidden" name="id_blog" value="<?= (isset($row)) ? $row->id_blog : NULL; ?>">
                        <input type="hidden" name="fk_user" value="<?php echo $this->session->userdata('userId'); ?>">
                        <div class="form-group">
                          <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Judul Post <span class="required">*</span>
                          </label>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="title" value="<?= (isset($row)) ? $row->title : NULL; ?>" required="required" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                      <br><br><br>
                      <div class="form-group">
                          <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Content <span class="required">*</span>
                          </label>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <textarea id="postTextarea" name="content" rows="6" class="form-control"><?= (isset($row)) ? $row->content : NULL; ?></textarea>
                            <br>
                            
                          </div>
                        </div>
                        <br><br>

                      <div class="form-group">
                        <div class="">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><b>Pinned Post ?</b> 
                              <?php echo form_dropdown('pinned',$option = array('0' => 'Unpinned Post', '1' => 'Pinned Post'),(isset($row)) ? $row->pinned : null, $xtr = array('class' => 'form-control', )); ?>
                              <!-- <input type="checkbox" name="pinned" value="1" <?= (isset($row)) ? $a = ($row->pinned=='1') ? 'checked' : NULL : NULL ; ?>> -->
                            </label>
                          </div>
                      </div>
                    
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-3">
                          <a href="<?= site_url($this->uri->segment(1));?>" type="submit" class="btn btn-primary">Cancel</a>
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
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Post</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      </li>
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
                          <th>Judul</th>
                          <th>Pinned</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($rows as $value): $no++?>
                        <tr>
                          <th scope="row"><?= $no; ?></th>
                          <td><?php echo $value->title; ?></td>
                          <td><?php echo ($value->pinned=='1') ? 'Pinned' : null ; ?></td>
                          <td>
                            <a href="<?= site_url($this->uri->segment(1).'/edit/'.$value->id_blog);?>">Edit </a> |
                            <a href="<?= site_url($this->uri->segment(1).'/delete/'.$value->id_blog);?>">Delete </a>
                          </td>
                        </tr>
                      <?php endforeach ?>
                        
                      </tbody>

                    </table>
                     <!-- <div class="ln_solid col-md-12"></div> -->
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
</div>
 <!-- /page content  -->
 <script src="<?php echo base_url();?>vendor/tinymce/tinymce/tinymce.min.js"></script>
 <!-- <script src='//cdn.tinymce.com/4/tinymce.min.js'></script> -->
 <!-- <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script> -->
 <script type="text/javascript">
  tinymce.init({
    selector: '#postTextarea',
    theme: 'modern',
    height: 300,
    plugins: [
      'advlist autolink link image imagetools lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ]
  });
  </script>