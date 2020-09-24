<?php 
  include_once('config.php');
  userLoggedIn();
  require_once BASE_DIR.'/include/commonCss.php';
?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"
 ng-app="app" 
 ng-controller="profileCtrl"
 ng-init="initProfile()">
<?php
   require_once BASE_DIR.'/include/header.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" ng-src="{{myphoto}}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{info.firstName}} {{info.lastName}}</h3>

                <p class="text-muted text-center">
                 {{ info.userType =='1'?'Admin':'User' }}
                </p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Last Login</b> <a class="float-right">{{ info.lastLogin }}</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
            
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#changePassword" data-toggle="tab">Change Password</a></li>
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="settings">
                    <div class="alert  alert-dismissable {{ proFMsg.class }}"  ng-if="proFMsg.show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">x</button>
                    {{ proFMsg.msg  }}
                    </div>
                    <form class="form-horizontal"
                      name="updateFrm"
                      ng-submit="updateProfile(updateFrm)"
                      ng-validate="validOptPrf" >
                      <div class="form-group row">
                        <label for="fname" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="fname" class="form-control" id="fname"  ng-model="info.firstName" placeholder="Enter First Name">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="lname" ng-model="info.lastName" id="lname" placeholder="Enter Last Name">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="email" ng-readonly="true" placeholder="Email" value="{{info.email}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" ng-disabled="isSubmitPro" class="btn btn-primary">Save</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="changePassword">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="oldPass" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="oldPass" name="oldPass" placeholder="Enter Old Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="newPass" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="newPass" name="newPass" placeholder="Enter New Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="confimPass" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="confimPass" placeholder="Confirm Password" name="confimPass">
                        </div>
                      </div>
                    
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="activity">
                    <!-- lazy loading -->
                    <table class="table">
                      <tr>
                       <th class="w-25">Time</th>
                       <th>Action</th>
                      </tr>
                      <tr ng-repeat="log in logs track by $index">
                       <td> {{ log.ul_time }} </td>
                       <td> {{ log.ul_action }} </td>
                      </tr>
                    </table>
                   
                  </div>
                  <!-- tab end -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<?php
   require_once BASE_DIR.'/include/footer.php';
?>
<script src="<?=ASSETS?>/theme/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?=ASSETS?>/angular/angular-validate.min.js"></script>
<script src="<?=ASSETS?>/angular/ngControllers/profileController.js"></script>
</body>
</html>
