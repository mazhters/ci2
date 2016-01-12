<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title ?></title>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN PLUGIN CSS -->
    <link href="<?php echo assets_url('assets/plugins/pace/pace-theme-flash.css')?>" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo assets_url('assets/plugins/bootstrapv3/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets_url('assets/plugins/bootstrapv3/css/bootstrap-theme.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets_url('assets/plugins/font-awesome/css/font-awesome.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets_url('assets/plugins/animate.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets_url('assets/plugins/jquery-scrollbar/jquery.scrollbar.css')?>" rel="stylesheet" type="text/css" />
    <!-- END PLUGIN CSS -->
    
    <?php echo $css; ?>
    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="<?php echo assets_url('webarch/css/webarch.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo assets_url('webarch/css/custom.css')?>" rel="stylesheet" type="text/css" />
    <!-- END CORE CSS FRAMEWORK -->


  </head>
  <body class="">

  <?php echo $body; ?>

    <!-- BEGIN CORE JS FRAMEWORK-->
    <script src="<?php echo assets_url('assets/plugins/pace/pace.min.js')?>" type="text/javascript"></script>
    <!-- BEGIN JS DEPENDECENCIES-->
    <script src="<?php echo assets_url('assets/plugins/jquery/jquery-1.11.3.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo assets_url('assets/plugins/bootstrapv3/js/bootstrap.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo assets_url('assets/plugins/jquery-block-ui/jqueryblockui.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo assets_url('assets/plugins/jquery-unveil/jquery.unveil.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo assets_url('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo assets_url('assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js')?>" type="text/javascript"></script>
    <script src="<?php echo assets_url('assets/plugins/jquery-validation/js/jquery.validate.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo assets_url('assets/plugins/bootstrap-select2/select2.min.js')?>" type="text/javascript"></script>
    <!-- END CORE JS DEPENDECENCIES-->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="<?php echo assets_url('webarch/js/webarch.js')?>" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->
        <!-- Extra javascript -->
        <?php echo $js; ?>
        <!-- / -->
  </body>
</html>