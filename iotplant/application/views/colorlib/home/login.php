<a class="hiddenanchor" id="signup"></a>
<a class="hiddenanchor" id="signin"></a>
<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <?php $atrib = array('id' => 'login', 'class' => 'form-vertical form-label-left'); ?>
            <?= form_open_multipart($this->uri->segment(1).'/verify',$atrib); ?>
                <h1>Login Form</h1>
                <div>
                    <input type="text" name="username" class="form-control" placeholder="Username" required="" />
                </div>
                <div>
                    <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                </div>
                <div>
                    <!-- Flash Data -->
                    <?php 
                    $info = $this->session->flashdata('login');
                    if (!empty($info)): ?>
                    <div class="alert alert-<?php echo $info->type; ?> alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Alert!</strong> <?php echo $info->notif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div>
                    <button class="btn btn-default submit" type="submit">Log in</button>
                    <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
                </div>
                <div class="clearfix"></div>
                <div class="separator">                    
                    <!-- <p class="change_link">New to site?
                        <a href="#signup" class="to_register"> Create Account </a>
                    </p> -->
                   <!--  <p class="change_link">Go to 
                        <a href="<?= site_url('home') ?>" class="to_register"> Home </a>
                    </p> -->
                    <div class="clearfix"></div>
                    <br />
                    <div>
                        <h1><i class="fa fa-check"></i> <?php echo $appName; ?></h1>
                        <p>©2016 <a href="http://agusedyc.github.io/">Agus Edy Cahyono</a> Theme By :  Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a> is a <a href="http://getbootstrap.com">Bootstrap 3</a> template. Privacy and Terms</p>
                    </div>
                </div>
            <?= form_close(); ?>
        </section>
    </div>
    <div id="register" class="animate form registration_form">
        <section class="login_content">
            <!-- <form> -->
            <?php $atrib = array('id' => 'register', 'class' => 'form-vertical form-label-left'); 
            $flash = $this->session->flashdata('register');
            ?>
            <?= form_open_multipart('mahasiswa/add',$atrib); ?>
                <h1>Create Account</h1>
                <div>
                    <input type="text" name="nim" id="nim" class="form-control" placeholder="NIM" value="<?= (!empty($flash->input)) ? $flash->input->nim : NULL; ?>" />
                </div>    
                <div>
                    <input type="text" name="nama_mhs" class="form-control" placeholder="Nama lengkap" value="<?= (!empty($flash->input)) ? $flash->input->nama_mhs : NULL; ?>" />
                </div>    
                <div>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?= (!empty($flash->input)) ? $flash->input->email : NULL; ?>" />
                </div>
                <div>
                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?= (!empty($flash->input)) ? $flash->input->username : NULL; ?>" />
                </div>                
                <div>
                    <input type="password" name="password" class="form-control" placeholder="Password" value="" />
                </div>
                <div>
                    <input type="password" name="repass" class="form-control" placeholder="Re - Password" value="" />
                </div>
                <div>
                    <!-- Flash Data -->
                    <?php if (!empty($flash)): ?>
                    <div class="alert alert-<?php echo $flash->type; ?> alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Alert!</strong> <?php echo $flash->notif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div>
                    <button class="btn btn-default" type="submit">Submit</button>
                </div>
                <div class="clearfix"></div>
                <div class="separator">
                    <p class="change_link">Already a member ?
                        <a href="#signin" class="to_register"> Log in </a>
                    </p>
                    <p class="change_link">Go to 
                        <a href="<?php echo site_url('home') ?>" class="to_register"> Home </a>
                    </p>
                    <div class="clearfix"></div>
                    <br />
                    <div>
                        <h1><i class="fa fa-check"></i> <?php echo $appName; ?></h1>
                        <p>©2016 <a href="http://agusedyc.github.io/">Agus Edy Cahyono</a> Theme By :  Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a> is a <a href="http://getbootstrap.com">Bootstrap 3</a> template. Privacy and Terms</p>
                    </div>
                </div>
            <!-- </form> -->
            <?= form_close(); ?>
        </section>
    </div>
</div>
<!-- custom -->
<script>
$(document).ready(function() {
     $("#nim").inputmask("G.999.99.9999");
 });
</script>

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript">
$(".body").toggleClass('login');
$(".body").removeClass('nav-md');
$("#a").removeClass('container body');
$("#b").removeClass('main_container');
</script>