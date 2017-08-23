        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Daftar Jurnal Mahasiswa</h3>
              </div>
              
              <div class="title_right">
              <!-- Flash Data -->
              <?php 
              $flash = $this->session->flashdata('jurnalPub');
              if (!empty($flash->notif)): 
              ?>
              <div class="alert alert-<?php echo $flash->type; ?> alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <strong>Alert!</strong> <?php echo $flash->notif; ?>
              </div>
              <?php endif; ?>
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <?= form_open($this->uri->segment(1).'/searchJurnal'); ?>
                  <div class="input-group">
                    <input type="text" name="searchJurnal" class="form-control" placeholder="<?php echo $varS = (!empty($this->uri->segment(3))) ? "You search : ".urldecode($this->uri->segment(3)) : "Search for..." ; ?>">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                  <?= form_close(); ?>
                </div>
              </div>
            </div>

            <!-- <div class="clearfix"></div> -->
            <?php foreach ($rows as $key => $value): ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="x_panel" >
                      <div class="x_title">
                      <div class="row">
                          <div class="col-md-11 col-xs-11">
                              <h5 wrap="hard"><?php echo $value->judul; ?> <small><?php echo $value->nama_mhs; ?></small></h5>
                          </div>
                              <div class="col-md-1 col-xs-1" align="right">
                                  <ul class="nav navbar-right panel_toolbox">
                              <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                              </li>
                              <li><a class="close-link"><i class="fa fa-close"></i></a>
                              </li>
                            </ul>
                          </div>
                      </div>
                        <!-- <div class="clearfix"></div> -->
                      </div>
                      <div class="x_content" style="display: none;">
                          <div class="row">
                              <div class="col-md-12">
                              <?php 
                                $hidden = array('id_jurnal' => $value->id_jurnal);
                                $atrib = array('id' => 'jurnalUpload', 'class' => 'form-horizontal form-label-left'); 
                              ?>
                              <?= form_open_multipart($this->uri->segment(1).'/updatePub',$atrib,$hidden); ?>
                           
                             <div class="form-group col-md-4 col-xs-3">
                                <label>Vol Jurnal</label>
                                <?php echo form_input('vol_jurnal', $value->vol_jurnal, ['class'=>'form-control']); ?>
                            </div>
                            <div class="form-group col-md-4 col-xs-3">
                                <label>No Jurnal</label>
                                <?php echo form_input('no_jurnal', $value->no_jurnal, ['class'=>'form-control']); ?>
                            </div>
                            <div class="input-group col-md-4 col-xs-6">
                                <label>Tgl Jurnal</label>
                                <?php echo form_input('tgl_jurnal', $value->tgl_jurnal, ['class'=>'form-control','id'=>'cal_jurnal'.str_replace('.','',$value->nim)]); ?>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 24px;">Submit</button>
                                </span>
                            </div>
                             <?php echo form_close(); ?>
                              </div>
                          </div>
                        <hr>
                        <div class="row">
                        <div class="col-sm-4 col-xs-4">
                         Pembimbing 1
                         <br><strong><?php echo $value->pembimbing_1; ?></strong>
                         <br>Pembimbing 2
                         <br><strong><?php echo $value->pembimbing_2; ?></strong>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 col-xs-4">
                          Scan Bukti 
                         <br><strong><?php echo (empty($value->file_bukti)) ? "Belum Upload Bukti" : "<a data-toggle='modal' data-target='#pictModal".str_replace(".","",$value->nim)."'>Sudah Upload Bukti</a>" ; ?></strong>
                         <br>File Jurnal
                         <br><strong><?php echo (empty($value->file_jurnal)) ? "Belum Upload Jurnal" : "<a target='_blank' href='https://docs.google.com/viewerng/viewer?url=".base_url('/uploads/jurnal/'.$value->nim.'/'.$value->file_jurnal)."&embedded=true' >Sudah Upload Jurnal</a>" ; ?>
                           <?php (empty($value->file_jurnal)) ? "Belum Upload Jurnal" : "Sudah Upload Jurnal" ; ?>
                         </strong>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 col-xs-4">
                          <!-- <strong>Abstrak</strong>
                          <br><p>
                            <?php //echo $value->abstrak; ?>
                          </p> -->
                          NIM
                         <br><strong><?php echo $value->nim; ?></strong>
                        <br>Upload Ke <strong><?php echo (empty($value->try_upload)) ? "-" : $value->try_upload; ?></strong> Pada Tanggal
                         <br><strong><?php echo ($value->upload_date=="0000-00-00 00:00:00") ? "Belum Upload" : nice_date($value->upload_date, 'd-m-Y H:m:s'); ?></strong>
                        </div>
                        <!-- /.col -->
                      </div>
                      <hr>
                      <div class="row">
                          <div class="col-sm-12">
                              <strong>Abstrak</strong>
                              <br><p align="justify"><?php echo $value->abstrak; ?></p>
                          </div>
                      </div>
                      
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Image -->
                <div id="pictModal<?php echo str_replace(".","",$value->nim); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="<?php echo $retVal = (!empty($value->file_bukti)) ? base_url('uploads/jurnal/'.$value->nim.'/'.$value->file_bukti) : null ; ?>" class="img-responsive">
                        </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->
                <script>
                  $(document).ready(function() {
                    $('#<?php echo "cal_jurnal".str_replace(".","",$value->nim) ?>').daterangepicker({
                      singleDatePicker: true,
                      format: 'DD-MM-YYYY',
                      calender_style: "picker_2"
                    }, function(start, end, label) {
                      console.log(start.toISOString(), end.toISOString(), label);
                    });       
                  });
                </script>
            <?php endforeach ?>
            <!-- <div class="ln_solid col-md-12"></div> -->
            <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 dataTables_paginate paging_simple_numbers">
              <?php echo $pagination; ?>
              </div>
            </div>
            
            
          </div>
        </div>
        <script type="text/javascript" charset="utf-8" async defer>
          function centerModal() {
              $(this).css('display', 'block');
              var $dialog = $(this).find(".modal-dialog");
              var offset = ($(window).height() - $dialog.height()) / 2;
              // Center modal vertically in window
              $dialog.css("margin-top", offset);
          }

          $('.modal').on('show.bs.modal', centerModal);
          $(window).on("resize", function () {
              $('.modal:visible').each(centerModal);
          });
        </script>
        <style type="text/css" media="screen">
            .wrap{
                width: 100px;
                white-space: pre-wrap; /* css-3 */    
                white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
                white-space: -pre-wrap; /* Opera 4-6 */    
                white-space: -o-pre-wrap; /* Opera 7 */    
                word-wrap: break-word; /* Internet Explorer 5.5+ */
            }
            .x_panel {
                padding: 3px 8px;
            }
            .x_title{
                margin-bottom: 5px;
            }

            .h4, .h5, .h6, h4, h5, h6 {
                margin-top: 5px;
                margin-bottom: 5px;
            }
            hr{
                margin-top: 5px; 
                margin-bottom: 5px; 
            }
            .clearfix:after, form:after {
                /*content: ".";*/
                /*display: block;*/
                /*height: 0;*/
                 clear: none; 
                /*visibility: hidden;*/
            }
            .navbar-right {
                margin-right: -20;
            }
        </style>
<!-- /page content