<div class="container">
  <div class="row login-container animated fadeInUp">
    <div class="col-md-7 col-md-offset-2 tiles white no-padding">
      <div class="p-t-30 p-l-40 p-b-20 xs-p-t-10 xs-p-l-10 xs-p-b-10">
        <h2 class="normal">
          Sign in to web
        </h2>
        <div role="tablist">
          
        </div>
      </div>
      <div class="tiles grey p-t-20 p-b-20 no-margin text-black tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab_login">
          <!--<form method="post" id="form" action="" class="animated fadeIn validate">-->
          <form method="post" id="form" action="<?php echo base_url('login/cek_login')?>" class="animated fadeIn validate">
            <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
              <div <?php (! empty($message)) && print('class="alert alert-danger text-center" role="alert"'); ?> id="infoMessage"><?php echo $message;?></div>
              <div class="col-md-6 col-sm-6">
                <input class="form-control" id="login_username" name="username" placeholder="Username" type="text" required>
              </div>
              <div class="col-md-6 col-sm-6">
                <input class="form-control" id="login_pass" name="password" placeholder="Password" type="password" required>
              </div>
              <div class="col-md-6 col-sm-6">
              </div>
              <div class="col-md-6 col-sm-6">
                <button type="submit" class="btn btn-primary btn-cons pull-right">Login</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END CONTAINER -->
