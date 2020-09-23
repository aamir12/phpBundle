<?php 
  include_once('config.php');
  isLockScreen();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;?> | Lockscreen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=ASSETS?>/theme/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=ASSETS?>/theme/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?=ASSETS?>/css/loader.css">
  <script>
    var site_url = "<?=MAIN_URL?>";
  </script>
</head>
<body class="hold-transition lockscreen" ng-app="app" ng-controller="authCtrl"
 ng-init="initLockScreen('<?=$_SESSION['USERID']?>')">
<div id="loading-wrapper">
  <div id="loading-text">LOADING</div>
  <div id="loading-content"></div>
</div>

<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="#"><b><?php echo PROJECT_NAME;?></b></a>
  </div>

  <div class="alert  alert-dismissable {{ message.class }}"  ng-if="message.show">
       <button type="button" class="close" data-dismiss="alert" aria-label="close">x</button>
       {{ message.msg  }}
  </div>

  <!-- User name -->
  <div class="lockscreen-name">{{ firstName }} {{ lastName }}</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img ng-src="{{defaultImg}}" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" name="lockScreen"
        ng-submit="unLock()"
      >
      <div class="input-group">
        <input type="password" name="password" required ng-model="password" class="form-control" placeholder="password">
        <div class="input-group-append">
          <button type="submit" class="btn"><i class="fas fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Enter your password to retrieve your session
  </div>
  <div class="text-center">
    <a href="login.php">Or sign in as a different user</a>
  </div>
  <div class="lockscreen-footer text-center">
    Copyright &copy; 2014-2025 <b><a href="#" class="text-black"><?php echo PROJECT_NAME;?></a></b><br>
    All rights reserved
  </div>
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="<?=ASSETS?>/theme/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=ASSETS?>/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=ASSETS?>/theme/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?=ASSETS?>/js/common.js"></script>
<script src="<?=ASSETS?>/angular/angular.min.js"></script>
<script src="<?=ASSETS?>/angular/angular-validate.min.js"></script>
<script src="<?=ASSETS?>/angular/ngControllers/authController.js"></script>
</body>
</html>
