$(document).ready(function () {
    
    if($("#loginFrm").length>0){
        $('#loginFrm').validate({
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
               
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    }
   
  });