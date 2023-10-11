$(document).ready(function () {
    $("#addaccountform").validate({
        rules: {
            name: {
                required: true,
            },
            accountnumber: {
                required: true,
            },
            phone: {
                minlength: 10,
                maxlength: 10,
            },
            email: {
                required: true,
                email: true,
            },
        },
        messages: {
            name: "Please enter account holder name",
            accountnumber: {
                required: "Please enter account number",
            },
            phone: {
                minlength: "Please enter valid phone number",
                maxlength: "Please enter valid phone number",
            },
            email: {
                required: "Please enter your email",
                email: "Please enter valid email",
            },
        },
        submitHandler: function (form) {
            form.submit();
        },
    });

    $('#addothersaccountform').validate({
        rules:{
            email:{
                required:true,
                email:true
            },
        },
        messages:{
            email:{
                required:"Please enter your email",
                email:"Please enter valid email"
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    })

    $('#receiveraccount').hide();
    $("#category").change(function() {
        if($('option:selected', this).val()==3){
            $('#receiveraccount').show();
        }
        else{
            $('#receiveraccount').hide();
        }
    });


    $('#editaccountform').validate({
        rules:{
            name:{
                required:true
            },
            accountnumber:{
                required:true
            },
            phone:{
                minlength:10,
            },
            email:{
                required:true,
                email:true
            },
        },
        messages:{
            name:"Please enter account holder name",
            accountnumber:{
                required:"true"
            },
            phone:{
                minlength:"Please enter password greater than or equal to 8 characters",
            },
            email:{
                required:"Please enter your email",
                email:"Please enter valid email"
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    })

    $('#loginform').validate({
        rules:{
            email:{
                required:true,
                email:true
            },
            password:{
                required:true,
                minlength:8,
            },
        },
        messages:{
            email:{
                required:"Please enter your email",
                email:"Please enter valid email"
            },
            password:{
                required:"Please enter password",
                minlength:"Please enter password greater than or equal to 8 characters",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    })

    $('#signupform').validate({
        rules:{
            name:{
                required:true
            },
            email:{
                required:true,
                email:true
            },
            password:{
                required:true,
                minlength:8,
            },
        },
        messages:{
            name:"Please enter your name",
            email:{
                required:"Please enter your email",
                email:"Please enter valid email"
            },
            password:{
                required:"Please enter password",
                minlength:"Please enter password greater than or equal to 8 characters",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    })

    $('#forgetpasswordform').validate({
        rules:{
            email:{
                required:true,
                email:true
            },
        },
        messages:{
            email:{
                required:"Please enter your email",
                email:"Please enter valid email"
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    })
    $('#message').delay(3000).fadeOut();

});
