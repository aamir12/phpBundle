<?php 
  include_once('config.php');
  include_once(BASE_DIR.'/modals/AuthModal.php');
  $db = new Database();
  $UserModal = new AuthModal();
  if(isset($_POST['login'])){
    $data = escapemydata($_POST);
    if(empty($data['username']) || empty($data['password']))
    { setmessage('danger','Please enter all required fields');
      Url::redirect(MAIN_URL.'login.php');
    } 

    $check = $UserModal->user_login($data);

    
    if($check==1)
    {
      Url::redirect(MAIN_URL.'index.php');     
    }else
    {
      setmessage('danger','Invalid Username or Password');
      Url::redirect(MAIN_URL.'login.php');
    }	
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo PROJECT_NAME;?> | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=ASSETS?>/theme/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=ASSETS?>/theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=ASSETS?>/theme/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .form-control.is-invalid{
      background-image:none !important;
    }
  </style>
</head>
<body class="hold-transition login-page" ng-app="app" ng-controller="authCtrl">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>PHP</b>Bundle</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form name="loginFrm" ng-submit="login(loginFrm)" ng-validate="validationOptions">
        <div class="input-group mb-3">
          <input 
            type="email" 
            class="form-control" 
            name="email" 
            placeholder="Email"
            ng-model="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input 
            type="password"
            class="form-control" 
            placeholder="Password"
            name="password"
            ng-model="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input 
                type="checkbox"
                name="rememberMe"
                id="remember"
                ng-model="rememberMe">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" ng-disabled="isSubmit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.php">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=ASSETS?>/theme/plugins/jquery/jquery.min.js"></script>
<!-- jqueryValidation -->
<script src="<?=ASSETS?>/theme/plugins/jquery-validation/jquery.validate.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=ASSETS?>/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=ASSETS?>/theme/dist/js/adminlte.min.js"></script>

<!-- angular -->
<script src="<?=ASSETS?>/angular/angular.min.js"></script>
<script src="<?=ASSETS?>/angular/angular-validate.min.js"></script>
<script src="<?=ASSETS?>/angular/controllers/authController.js"></script>


</body>
</html>
