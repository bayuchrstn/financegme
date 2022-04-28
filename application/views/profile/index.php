<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6>Form Update Profile</h6>
            </div>
            <div class="panel-body">

                <div class="close_this_alert no-border"></div>
                <?php echo show_flash(); ?>

                <form id="form_profile" class="form-horizontal" action="<?php echo base_url(); ?>my_profile/index" method="post">

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Nama</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo my_name(); ?>">
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="">Email</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="email" id="email" value="<?php echo my_email(); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="">Username</label>
                        <div class="col-lg-9">
                            <input readonly type="text" class="form-control" name="username" id="username" value="<?php echo my_username(); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="">Password</label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" name="password" id="password" value="">
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label class="col-lg-3 control-label" for="">Confirm Password</label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
                        </div>
                    </div> -->

                    <div id="foto_div"></div>
                    <div class="text-right">
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
                <!-- <div class="alert alert-info">
                    Akun System Ticket ini terintegrasi dengan APPS, Silahkan update <a href="http://appsjogja.gmedia.net.id">APPS</a> jika ingin merubah data profil anda
                </div> -->
            </div>
        </div>

    </div>

    <!-- <div class="col-lg-4" id="photodiv">
        <div class="thumbnail">
            <div class="thumb thumb-slide">
                <img id="photo" src="<?php echo my_photo(); ?>" alt="">
            </div>

            <div class="caption text-center">
                <span class="btn btn-success btn-file">
                    Photo Profile <input id="fileupload" class="form-control" type="file" name="files">
                </span>
            </div>
        </div>
    </div> -->
</div>
