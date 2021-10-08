
$(document).on('click', '#fort-passs', function (event) {
    $('.fade').removeClass("fade");
    $('#slider-dots').removeClass("slider-dots");
    
});
$('#modal').on('hide.bs.modal', function (e) {
    // location.reload()
  })
$(document).on('click', '#loginBtn', function (e) {
$('#email_adress').prop('type','email').val();
 var password = document.getElementById('password').value;
 var email = document.getElementById('email_adress').value;
 if(password !== '' && email !== ''){
     if(email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)){
        $('#email_adress').prop('type','text').val();
         $('#loginBtn').html('');
        $('#loginBtn').html('<i class="sending fa fa-spinner fa-spin"></i>&nbspSigning In...');
        $('#loginBtn').prop('disabled', false);
     }
 }else{
    $('#email_adress').prop('type','text').val();
 }
});
$(document).on('click', '#submit_bt', function (event) {
 var email = document.getElementById('password_reset_email').value;
 if(email !==''){
      if(email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)){
         $('#submit_bt').html('');
        $('#submit_bt').html('<i class="sending fa fa-spinner fa-spin"></i>&nbspSubmitting...');
        $('#submit_bt').prop('disabled', false);
      }
 }


});
  $(document).on('click', '#togglePassword', function (event) {
    var password = document.getElementById("password");
    if (password.type === "password") {
    $('#hide').show();
    $('#view').hide();
    password.type = "text";
    } else {
    $('#hide').hide();
    $('#view').show();
    password.type = "password";
    }
    
    });
  
     $(document).ready(function() {
    var ftrm = $('#forgotpassw');
    ftrm.submit(function(e) {
        e.preventDefault();
        var ftrmData = ftrm.serialize();
        ftrmData += '&' + $('#submit_bt').attr('name') + '=' + $('#submit_bt').attr('value');
        $.ajax({
            type: ftrm.attr('method'),
            url: ftrm.attr('action'),
            data: ftrmData,
            success: function(response) {
                if (response == 200) {
                    $('#forgotpassw').hide('500')
                        .delay(3000).fadeOut(3000);
                    $('#forgotpassw')[0].reset();
                     $('#submit_bt').html('');
                    $('#submit_bt').html('Reset Password');
                    $('#submit_bt').prop('disabled', false);
                    setTimeout(function() {
                    $('#hiddenForm').show('500')
                    }, 100);
                    // setTimeout(function() {
                    //     location.reload()
                    // }, 5000);
                } else if (response == 500) {
                    $('#forgotpassw')[0].reset();
                     $('#submit_bt').html('');
                    $('#submit_bt').html('Reset Password');
                    $('#submit_bt').prop('disabled', false);
                    $("#forgotpassw").prepend('<div id="errormessage"><h4 style="color:red; text-align:center;font-size:16px">Oops! we couldnt send your message. Please try again later.</h4></div>');
                    $('#error').html("<div id='errormessage'></div>");
                    $('#errormessage').html("<h4 style='color:red; text-align:center;font-size:16px'>Oops! we couldn't send your reset email. Please try again later.</h4>")
                        .delay(3000).fadeOut(3000);
                    setTimeout(function() {
                        $('#errormessage2').remove;
                    }, 5000);
                } else if (response == 403) {
                    $('#forgotpassw')[0].reset();
                    $('#submit_bt').html('');
                    $('#submit_bt').html('Reset Password');
                    $('#submit_bt').prop('disabled', false);
                    $("#forgotpassw").prepend('<div id="errormessage"><h4 style="color:red; text-align:center;font-size:16px">Oops! Submition problem. Please try again later.</h4></div>');
                    $('#error').html("<div id='errormessage'></div>");
                    $('#errormessage').html("<h4 style='color:red; text-align:center;font-size:16px'>Oops! Submition problem. Please try again later.</h4>")
                        .delay(3000).fadeOut(3000);
                    setTimeout(function() {
                        $('#errormessage').remove;
                    }, 5000);
                } else if (response == 600) {
                    $('#forgotpassw')[0].reset();
                    $('#submit_bt').html('');
                    $('#submit_bt').html('Reset Password');
                    $('#submit_bt').prop('disabled', false);
                    $("#forgotpassw").prepend('<div id="errormessage"><h4 style="color:red; text-align:center;font-size:16px;">Sorry, no user exists on our system with that email.</h4></div>');
                    $('#error').html("<div id='errormessage'></div>");
                    $('#errormessage').html("<h4 style='color:red; text-align:center;font-size:16px;'>Sorry, no user exists on our system with that email.</h4>")
                        .delay(3000).fadeOut(3000);
                    setTimeout(function() {
                        $('#errormessage').remove;
                    }, 5000);
                }


            },
            error: function(request, status, error) {
                alert('oh, errors here. The call to the server is not working.');
            }
        });
    });
});