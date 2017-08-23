<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><i class="fa fa-leaf"></i> <span><?= $appName; ?></span></a>
        </div>
        <div class="clearfix"></div>
        <!-- menu profile quick info -->
        <!-- <div class="profile">
            <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
            </div>
        </div> -->
        <!-- /menu profile quick info -->
        <br />
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li>
                    	<a href="<?= site_url('dashboard');?>">
                    		<i class="fa fa-laptop"></i> Dashboard <span class="label label-success pull-right"> Penyiram <?= $this->session->userdata('role'); ?></span>
                    	</a>
                    </li>
                <?php //if ($this->session->userdata('slug')=='admin'): ?>
                    <!-- <li><a><i class="fa fa-table"></i> Kelola Pengguna<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= site_url('pengguna');?>">Data Pengguna</a></li>
                        </ul>
                    </li> -->
                <?php //endif ?>
                <?php //if ($this->session->userdata('slug')=='admin'): ?>
                    <li><a><i class="fa fa-table"></i> Kelola Penyiraman<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= site_url('devices');?>">Data Alat</a></li>
                            <li><a href="<?= site_url('tanaman');?>">Data Tanaman</a></li>
                        </ul>
                    </li>
                <?php //endif ?>
                <?php if ($this->session->userdata('slug')=='admin'||$this->session->userdata('slug')=='dosen'): ?>
                    <li><a><i class="fa fa-table"></i> Data Jurnal<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= site_url('jurnal');?>">Jurnal Mahasiswa</a></li>
                            <li><a href="<?= site_url('report');?>">Laporan Jurnal</a></li>
                        </ul>
                    </li>
                <?php endif ?>
                <?php if ($this->session->userdata('slug')=='mhs'): ?>
                    <li><a><i class="fa fa-table"></i> Data <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= site_url('mahasiswa/profile');?>">Data Mahasiswa</a></li>
                            <li><a href="<?= site_url('jurnal/data');?>">Data Jurnal</a></li>
                        </ul>
                    </li>
                <?php endif ?>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" href="<?= site_url('dashboard/logout');?>" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
