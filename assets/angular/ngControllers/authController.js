var app = angular.module('app', ['ngValidate']);
app.controller('authCtrl', function($scope,$http,$timeout) {
    $scope.validationOptions = {
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required: "Enter email Id",
                email: "Enter valid email Id"
            },
            password: {
                required: "Enter password"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
           error.addClass('invalid-feedback'); 
           error.css({"margin-top":"-10px","margin-bottom":"5px"});
           error.insertAfter($(element).parents('div.input-group'));
           console.log($(element).attr('name'));
           
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

    $scope.initLogin = function(){
        $timeout(()=>{
            hidePageLoader(); //common.js
        },200);
    }

    $scope.defaultImg =  site_url+'assets/images/defaultUser.png';
    $scope.initLockScreen = function(){
        const userData = {
            action:'lockScreenData'
         };
         $http.post(site_url+'controllers/AuthController.php', userData).then(function(response){
            const res = response.data.msg;
            $scope.firstName = res.firstName;
            $scope.lastName = res.lastName;
            if(res.photo !=""){
                $scope.defaultImg =  site_url+'assets/files/users/'+res.photo;
            }
            hidePageLoader();
             
         },function(error){
             $scope.isSubmit = false;
             $scope.message = {
                 show:true,
                 msg:error.data.msg,
                 class:'alert-danger'
             }
             hidePageLoader();
             redirect(site_url+'login.php');
         });
    }

    $scope.unLock = function(){
        const userData = {
           action:'unLockScreen',
           data:{
               password: $scope.password
           }
        };
        $http.post(site_url+'controllers/AuthController.php', userData).then(function(response){
            const res = response.data;
            redirect(site_url);
        },function(error){
            $scope.isSubmit = false;
            $scope.message = {
                show:true,
                msg:error.data.msg,
                class:'alert-danger'
            }
            if(error.data.code != "inCrtPass"){
                redirect(site_url+'login.php');
            }
            
        });
    }

    $scope.isSubmit = false;
    $scope.message = {
        show:false,
        msg:'',
        class:''
    }
    

    $scope.login = function (form) {
        if(form.validate()) {
           const userData = {
                data: {
                email : $scope.email,
                password: $scope.password,
                rememberMe : $scope.rememberMe
               },
               action:'login'
           };
           $scope.isSubmit = true;
           $http.post(site_url+'controllers/AuthController.php', userData).then(function(response){
            const res = response.data;
            $scope.isSubmit = false;
            $scope.message = {
                show:true,
                msg:res.msg,
                class:'alert-success'
            }
            redirect(site_url);
           },function(error){
                $scope.isSubmit = false;
                $scope.message = {
                    show:true,
                    msg:error.data.msg,
                    class:'alert-danger'
                }
           });
        }
    }

  
});