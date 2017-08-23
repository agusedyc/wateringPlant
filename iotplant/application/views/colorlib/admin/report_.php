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

                    <div class="col-xs-3">
                      <!-- required for floating -->
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs tabs-left">
                        <li class=""><a href="#home" data-toggle="tab" aria-expanded="false">Data Jurnal Mahasiswa</a>
                        </li>
                        <li class="active"><a href="#" data-toggle="tab" aria-expanded="true">Data Mahasiswa <span class="label label-warning pull-right">Coming Soon</span></a> 
                        </li>
                        <li class=""><a href="#" data-toggle="tab" aria-expanded="false">Data Dosen <span class="label label-warning pull-right">Coming Soon</span></a>
                        </li>
                      </ul>
                    </div>

                    <div class="col-xs-9">
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div class="tab-pane  active" id="home">
                            <h3>laporan Data Jurnal Mahasiswa</h3>
                            <br>
                            <!-- <div class="well"> -->
                              <!-- <form class="form-horizontal" _lpchecked="1"> -->
                              <?php 
                                // $hidden = array('id_jurnal' => $value->id_jurnal);
                                $atrib = array('id' => 'downloadLaporan', 'class' => 'form-horizontal', '_lpchecked' => '1', 'target'=>'_blank');
                                $flash = $this->session->flashdata('reportDate');
                              ?>
                              <?= form_open_multipart($this->uri->segment(1).'/ctkLapByDate',$atrib/*,$hidden*/); ?>
                                <!-- <fieldset> -->
                                <div class="col-md-4 col-sm-4">
                                  <div class="control-group">
                                    <div class="controls">
                                      <div class="input-prepend input-group">
                                        <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                        <input type="text" name="lap_by_date" id="reservation" class="form-control" value="" placeholder="Pick date">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                  <button type="submit" class="btn btn-sucess">Cetak</button>  
                                </div>
                                <!-- </fieldset> -->
                                
                              <!-- </form> -->
                              <?php echo form_close(); ?>
                            <!-- </div> -->

                        <!-- Flash Data -->
                            <?php if (!empty($flash->notif)): ?>
                            <div class="alert alert-<?php echo $flash->type; ?> alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Alert!</strong> <?php echo $flash->notif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane" id="profile">Profile Tab.</div>
                        <div class="tab-pane" id="messages">Messages Tab.</div>
                        <div class="tab-pane" id="settings">Settings Tab.</div>
                      </div>
                    </div>

                    <div class="clearfix"></div>

                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- /page content  -->

 <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {
        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reservation span').html(start.format('D/MM/YYYY') + ' - ' + end.format('D/MM/YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2014',
          dateLimit: {
            days: 120
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'right',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'DD/MM/YYYY',
          separator: ' - ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };

        
        $('#reservation').daterangepicker(optionSet1,cb, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });

      });
    </script>