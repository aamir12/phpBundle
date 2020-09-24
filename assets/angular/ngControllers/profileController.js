var app = angular.module('app', ['ngValidate']);
app.controller('profileCtrl', function($scope,$http,$timeout) {
    $scope.validOptPrf = {
        rules: {
            fname: {
                required: true
            },
            lname: {
                required: true
            }
        },
        errorPlacement: function (error, element) {
           error.addClass('invalid-feedback');
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    };

    $scope.validLSOpt = {
        rules: {
            password: {
                required: true
            }
        }
    };

    

    
    $scope.myphoto = site_url+'assets/images/defaultUser.png';
    $scope.initProfile = function(){
        const userData = {
            action:'myProfile'
         };
         $http.post(site_url+'controllers/ProfileController.php', userData).then(function(response){
            const data = response.data.msg;
            $scope.info = data.info;
            $scope.logs = data.logs;
           
            if($scope.info.photo !=""){
                $scope.myphoto =  site_url+'assets/files/users/'+$scope.info.photo;
            }
           
            hidePageLoader();
             
         },function(error){
             $scope.message = {
                 show:true,
                 msg:error.data.msg,
                 class:'alert-danger'
             }
             hidePageLoader();
             redirect(site_url+'login.php');
         });
    }

    
    $scope.isSubmitPro = false;
    $scope.proFMsg = {
        show:false,
        msg:'',
        class:''
    }
    
    $scope.updateProfile = function (form) {
        if(form.validate()) {
           const userData = {
                data: {
                firstName : $scope.info.firstName,
                lastName: $scope.info.lastName
               },
               action:'updateProfile'
           };
           $scope.isSubmitPro = true;
           $http.post(site_url+'controllers/ProfileController.php', userData).then(function(response){
            const res = response.data;
            $scope.isSubmitPro = false;
            $scope.proFMsg = {
                show:true,
                msg:res.msg,
                class:'alert-success'
            }
            $("#sideUserName").html($scope.info.firstName);
            $timeout(()=>{
                $scope.proFMsg.show=false;
            },1500)
           },function(error){
                $scope.isSubmitPro = false;
                $scope.proFMsg = {
                    show:true,
                    msg:error.data.msg,
                    class:'alert-danger'
                }
                $timeout(()=>{
                    $scope.proFMsg.show=false;
                },1500)

                if(error.data.code == "sessExp"){
                    redirect(site_url+'login.php');
                }

           });
        }
    }

  
});