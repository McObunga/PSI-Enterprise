 //password vsibility-first password
 $(document).on('click', '#togglePassword', function (event) {
  var password = document.getElementById("new_pass");
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
$(document).ready(function () {
    var display = document.getElementsByClassName("passwordStrength")[0];
    display.innerHTML ="<div><strong style='color:#000'>Password Strength</strong></div>";
});
 $(document).on('click', '#newpas', function (event) {
     var new_pass = document.getElementById("new_pass").value;
     var new_pass_con = document.getElementById("new_pass_con").value;
     if(new_pass.length >= 8 && new_pass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) && new_pass.match(/[a-z]/) && new_pass.match(/[A-Z]/) && new_pass.match(/[0-9]/)){
         if (new_pass != new_pass_con)  {
          display.innerHTML ="<div ><strong style='color:#FF6363'>The two passwords are not matching!<strong></div>";
        }else{
          display.innerHTML ="<div ><strong style='color:#0DC152'>The two passwords match perfectly!<strong></div>";
          $('#newpas').prop('type','submit').val('Change Password');//prop or attr
          document.getElementById("newpas").clicked == true
            $('#newpas').html('');
            $('#newpas').html('<i class="sending fa fa-spinner fa-spin"></i>&nbspReseting Password...');
            $('#newpas').prop('disabled', false);
        }
     }else{
          display.innerHTML ="<div ><strong style='color:#FF6363'>Your password is not strong enough!</strong><lable style='font-size:12px;color:#000;font-weight:normal;'>(Please ensure your password contains a special character, capital letter, a number and that its at least 8 characters.)</lable></div>";
     }
     
   
    
});
$(document).on('click', '#togglePassword2', function (event) {
var password = document.getElementById("new_pass_con");
if (password.type === "password") {
$('#hide1').show();
$('#view1').hide();
password.type = "text";
} else {
$('#hide1').hide();
$('#view1').show();
password.type = "password";
}

});

// check on password rules
var code = document.getElementById("new_pass");
var display = document.getElementsByClassName("passwordStrength")[0];
var meter1 = document.getElementsByClassName("strength-meter")[0];
var meter2 = document.getElementsByClassName("strength-meter2")[0];
var meter3 = document.getElementsByClassName("strength-meter3")[0];



// match two passwords
        
$('#new_pass_con').keyup(function () {
var new_pass = document.getElementById("new_pass").value;
var new_pass_con = document.getElementById("new_pass_con").value;
if(new_pass.length >= 8 && new_pass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) && new_pass.match(/[a-z]/) && new_pass.match(/[A-Z]/) && new_pass.match(/[0-9]/)){
if (new_pass != new_pass_con)  {
  display.innerHTML ="<div ><strong style='color:#FF6363'>The two passwords are not matching!<strong></div>";
}else{
  display.innerHTML ="<div ><strong style='color:#0DC152'>The two passwords match perfectly!<strong></div>";
}
}else{
    display.innerHTML ="<div ><strong style='color:#FF6363'>Your password is not strong enough!</strong><lable style='font-size:12px;color:#000;font-weight:normal;'>(Please ensure your password contains a special character, capital letter, a number and that its at least 8 characters.)</lable></div>";
}

})
//check for password srenghth
         let regExpWeak = /[a-z]/;
         let regExpMedium = /\d+/;
         let regExpStrong = /.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/;
         $('#new_pass').keyup(function () {
          var new_pass = document.getElementById("new_pass").value;
           if(new_pass != ""){
            display.innerHTML ="<div ><div style='color:#FF6363'>Your password is too weak!</div><lable style='font-size:12px;font-weight: normal;'>(Please ensure your password contains a special character, capital letter, a number and that its at least 8 characters.)</lable></div>";
             
            document.getElementById('resetpassmeter1').style.backgroundColor = 'RGB(255,99,99)';
            if(new_pass.length <= 1 && (new_pass.match(regExpWeak) || new_pass.match(regExpMedium) || new_pass.match(regExpStrong)))no=1;
             if(new_pass.length <= 5 && ((new_pass.match(regExpWeak) && new_pass.match(regExpMedium)) || (new_pass.match(regExpMedium) || new_pass.match(regExpWeak) ) ))no=2;
             if(new_pass.length >= 8 && new_pass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) && new_pass.match(/[a-z]/) && new_pass.match(/[A-Z]/) && new_pass.match(/[0-9]/))no=3;
             if(no==1){
            
              display.innerHTML ="<div ><strong style='color:#FF6363'>Your password is too weak!</strong><lable style='font-size:12px;font-weight: normal;'>(Please ensure your password contains a special character, capital letter, a number and that its at least 8 characters.)</lable></div>";
              document.getElementById('resetpassmeter1').style.backgroundColor = 'RGB(255,99,99)';
              document.getElementById('resetpassmeter2').style.backgroundColor = 'RGB(248,246,246)';
              document.getElementById('resetpassmeter3').style.backgroundColor = 'RGB(248,246,246)';
             }
             if(no==2){
              display.innerHTML ="<div ><strong style='color:#ffc63d'>Your password strength is medium!</strong><lable style='font-size:12px;font-weight:normal;'>(Please ensure your password contains a special character, capital letter, a number and that its at least 8 characters.)</lable></div>";
              document.getElementById('resetpassmeter2').style.backgroundColor = 'RGB(255, 198, 61)';
              document.getElementById('resetpassmeter1').style.backgroundColor = 'RGB(255,99,99)';
              document.getElementById('resetpassmeter3').style.backgroundColor = 'RGB(248,246,246)';
             }
             if(no==3){
                display.innerHTML ="<div ><strong style='color:#0DC152'>Your password is strong!</strong></div>";
                
                document.getElementById('resetpassmeter1').style.backgroundColor = 'RGB(255,99,99)';
                document.getElementById('resetpassmeter2').style.backgroundColor = 'RGB(255, 198, 61)';
                document.getElementById('resetpassmeter3').style.backgroundColor = 'RGB(13,193,82)';
             }
             if(new_pass.length < 8){
              display.innerHTML ="<div ><strong style='color:#ffc63d'>Your password strength is medium!</strong><lable style='font-size:12px;font-weight:normal;'>(Please ensure your password contains a special character, capital letter, a number and that its at least 8 characters.)</lable></div>";
              
              document.getElementById('resetpassmeter1').style.backgroundColor = 'RGB(255,99,99)';
              document.getElementById('resetpassmeter2').style.backgroundColor = 'RGB(255, 198, 61)';
              document.getElementById('resetpassmeter3').style.backgroundColor = 'RGB(248,246,246)';
             }
             if(new_pass.length >= 5 && new_pass.length < 8){
              display.innerHTML ="<div ><strong style='color:#ffc63d'>Your password strength is medium!</strong><lable style='font-size:12px;font-weight:normal;'>(Please ensure your password contains a special character, capital letter, a number and that its at least 8 characters.)</lable></div>";
              
              document.getElementById('resetpassmeter2').style.backgroundColor = 'RGB(255, 198, 61)';
              document.getElementById('resetpassmeter1').style.backgroundColor = 'RGB(255,99,99)';
              document.getElementById('resetpassmeter3').style.backgroundColor = 'RGB(248,246,246)';
             }
             if(new_pass.length >= 1 && new_pass.length < 5){
              display.innerHTML ="<div ><strong style='color:#FF6363'>Your password is too weak!</strong><lable style='font-size:12px;font-weight:normal;'>(Please ensure your password contains a special character, capital letter, a number and that its at least 8 characters.)</lable></div>";
             
              document.getElementById('resetpassmeter1').style.backgroundColor = 'RGB(255,99,99)';
              document.getElementById('resetpassmeter2').style.backgroundColor = 'RGB(248,246,246)';
              document.getElementById('resetpassmeter3').style.backgroundColor = 'RGB(248,246,246)';
            }
            
           }else{
            display.innerHTML ="<div ><strong style='color:#000'>Password Strength</strong></div>";
            document.getElementById('resetpassmeter1').style.backgroundColor = 'RGB(248,246,246)';
            document.getElementById('resetpassmeter2').style.backgroundColor = 'RGB(248,246,246)';
            document.getElementById('resetpassmeter3').style.backgroundColor = 'RGB(248,246,246)';
           }
         });