<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../functions.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> My Health Africa OneMed Pro| Doctor Sign In</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/reset-password.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js?v=<?php echo $inclusions_version; ?>"></script>
    <link href="../assets/bundles/simple-line-icons/simple-line-icons.min.css?v=<?php echo $inclusions_version; ?>" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php
        if (isset($_GET["token"])) {
            $key = $_GET["token"];
            $curDate = date("Y-m-d H:i:s");
            $query = mysqli_query($db, "SELECT * FROM `password_reset_temp` WHERE `key` = ' $key'" );
            //$row = mysqli_num_rows($query);
            if (mysqli_num_rows($query) === 0 ){ 
                echo 'hfgd';
               ?>
            <div class="container-fluid h-100">
                <div class="row no-margin h-100">
                    <div class="col-sm-12 no-padding login-box h-100">
                        <div class="no-margin w-100">
                            <div style="margin-top:30px;">
                                <center>
                                <img src="images/PSI Kenya - Tunza.png" height="50px">
                                </center>
                            </div>
                            <div class="col-lg-5 col-md-5 log-det" style="margin-top:10px;border:none">
                                <div class="text-box-cont">
                                    <form>
                                    <div class="login-header-text" style="margin-top:5%;">
                                       <div class="col-md-12">
                                           <center>
                                               <div><i class="fa fa-exclamation-circle" style="color:#ffc63d;font-size:100px"></i></div>
                                            </center>
                                       </div>
                                       <center>
                                       <label style="margin-top:5%;">
                                           <label style="font-family:Segoe UI;font-size:30px;font-weight:semi-bold;">Password Reset Link Expired</label>
                                       </label>
                                       <label style="margin-bottom:5%;margin-top:5%;">
                                           <label style="font-weight:normal;font-size:13px;text-align:center;">
                                               This link is invalid or has expired. Please make sure you copied the right link from your email.
                                               If the link is invalid, you can request for another using the link below.
                                           </label>
                                       </label>
                                        <div class="input-group mb-sm-3" style="margin-left:5%;">
                                        <a href="https://www.myhealthafrica.com/myonemedpro/tunza-login" class="btn btn-primary" name="new_password" id="newpas" value="Change Password"  style="width:100%;font-size:15px;font-weight: normal;">Request Another Link</a>

                                        </div>
                                        
                                        <div>
                                            <img src="images/MHA - PSI.png" style="height:70px">
                                        </div>
                                    </center>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <?php
               echo $email;
         } else{
            $row = mysqli_fetch_assoc($query);
            $email = $row['email'];
            $expDate = $row['expDate'];
            if ($expDate >= $curDate){
            ?>
                <div class="container-fluid h-100">
                   
                        <div class="row no-margin h-100">
                            <div class="col-sm-12 no-padding login-box h-100">
                                <div class="reset no-margin w-100">
                                <div class="reseltLogo" style="margin-top:30px;">
                                    <center>
                                    <img src="images/PSI Kenya - Tunza.png" height="50px">
                                    </center>
                                </div>
                                    <div class="col-lg-5 col-md-5 log-det" style="margin-top:10px;">
                                        <div class="text-box-cont">
                                            <center>
                                            <form name="newpassw" id="newpassw" class="form sign-in" action="" method="post" onSubmit="return valid();" >
                                                <input type="hidden" name="action" value="update" />
                                            <div class="login-header-text" style="margin-top:10px;margin-bottom:20px">
                                               Set New Password
                                            </div>
                                            <!-- <div class="input-group mb-sm-3">-->
                                            <!--    <input type="password" name="new_pass" id="new_pass" class="inputFiled" placeholder="New Password" aria-label="Password" aria-describedby="basic-addon1">-->
                                            <!--    <span class="showBtn" id="togglePassword"><i class="fas fa-eye" id="view"></i><i class="fas fa-eye-slash" id="hide" style="display:none"></i></span>-->
                                            <!--</div>-->
                                            <!-- <div class="input-group mb-sm-3">-->
                                            <!--    <input type="password" name="new_pass_con" id="new_pass_con" class="inputFiled" placeholder="Confirm New Password" aria-label="Password" aria-describedby="basic-addon1">-->
                                                
                                            <!--    <span class="showBtn" id="togglePassword2" disabled><i class="fas fa-eye" id="view1"></i><i class="fa fa-eye-slash" id="hide1" style="display:none;"></i></i></span>-->
                                            <!--</div>-->
                                            
                                            <div class="input-group mb-sm-3">
                                                <label>
                                                    <input type="password" name="new_pass" id="new_pass" class="inputFiled" style="font-size:12px;font-weight:normal" value=""  placeholder="" required>
                                                        <span>New Password</span>
                                                    <div class="showBtn" id="togglePassword"><i class="fas fa-eye" id="view"></i><i class="fas fa-eye-slash" id="hide" style="display:none"></i></div>
                                                </label>
                                            </div>
                                            <div class="input-group mb-sm-3">
                                                <label>
                                                    <input type="password" name="new_pass_con" id="new_pass_con" class="inputFiled" style="font-size:12px;font-weight:normal" value=""  placeholder="" required>
                                                        <span>Confirm New Password</span>
                                                    <div class="showBtn" id="togglePassword2" disabled><i class="fas fa-eye" id="view1"></i><i class="fa fa-eye-slash" id="hide1" style="display:none;"></i></i></div>
                                                </label>
                                            </div>
                                            <div class="input-group mb-sm-3">
                                                    <button type="button" class="btn btn-primary" name="new_password" id="newpas" value="Change Password"  style="width:100%;font-size:15px" >Change Password</button>
                                            </div>  
                                            </center>
            
                                            <div class="input-group mb-sm-3 metercheck" style="margin-left:50px">
                                                    <div style="width:100%;"> 
                                                    <div><div style="color:#000;font-size:14px;" class="passwordStrength"></div></div><br>
                                                    </div>
                                                    <div class="strength-meter" id="resetpassmeter1">
                                                    </div>
                                                    <div class="strength-meter2" id="resetpassmeter2" >
                                                    </div>
                                                    <div class="strength-meter3" id="resetpassmeter3" >
                                                    </div>
                                            </div> 
                                            
                                            </form>
                                            <form  id="successalert" style="display:none;">
                                                <center>
                                            <div class="login-header-text" style="margin-top:15%;">
                                               <div class="col-md-12">
                                                   <center>
                                                       <div><i class="fa fa-check" style="color:#0DC152;font-size:120px"></i></div>
                                                    </center>
                                               </div>
                                               <label style="margin-top:9%;margin-bottom:15%;">
                                                   <strong style="font-size:20px;font-weight:semi-bold;">Password Reset Successful</strong>
                                               </label>
                                            </div>
                                            </form>
                                    </center>
                                        </div>
                                    </div>
                                    
                                <div style="margin-top:10px;">
                                    <center>
                                    <img src="images/MHA - PSI.png" style="height:70px">
                                    </center>
                                </div>
                                </div>
                            </div>
                             
                        </div>
                    </div>
                <?php
            } else{
                                           ?>
         <div class="container-fluid h-100">
                   
                        <div class="row no-margin h-100">
                            <div class="col-sm-12 no-padding login-box h-100">
                                <div class="no-margin w-100">
                                <div style="margin-top:30px;">
                                    <center>
                                    <img src="images/PSI Kenya - Tunza.png" height="50px">
                                    </center>
                                </div>
                                    <div class="col-lg-5 col-md-5 log-det" style="margin-top:10px;border:none">
                                        <div class="text-box-cont">
                                            <form>
                                            <div class="login-header-text" style="margin-top:5%;">
                                               <div class="col-md-12">
                                                   <center>
                                                       <div><i class="fa fa-exclamation-circle" style="color:#ffc63d;font-size:100px"></i></div>
                                                    <!--<img src="images/warn.svg" style="height:100px">-->
                                                    </center>
                                               </div>
                                               <center>
                                               <label style="margin-top:5%;">
                                                   <strong style="font-family:Segoe UI;font-size:20px;font-weight:bold;color:#000">Password Reset Link Expired</strong>
                                               </label>
                                               <label style="margin-bottom:5%;margin-top:5%;">
                                                   <label style="font-weight: normal;font-size:12px;text-align:center:color:#504E4D;">
                                                       This link is invalid or has expired. Please make sure you copied the right link from your email.
                                                       If the link is invalid, you can request for another using the link below.
                                                   </label>
                                               </label>
                                                <div class="input-group mb-sm-3" style="margin-left:5%;">
                                                <a href="https://www.myhealthafrica.com/myonemedpro/tunza-login" class="btn btn-primary" name="new_password" id="newpas" value="Change Password"  style="width:100%;font-size:15px;font-weight: normal;">Request Another Link</a>
                                            </div>
                                            
                                            <div style="margin-top:20px;">
                                                <center>
                                                <img src="images/MHA - PSI.png" style="height:70px">
                                                </center>
                                            </div>
                                            </center>
                                            </div>
                                            </form>
            
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
                    </div>
               <?php
                        
                            }
                      }
                        } // isset email key validate end
                if(isset($_POST["action"]) && ($_POST["action"]=="update")){
                    $pass1 = mysqli_real_escape_string($db,$_POST["new_pass"]);
                    $pass2 = mysqli_real_escape_string($db,$_POST["new_pass_con"]);
                    $curDate = date("Y-m-d H:i:s");
                    $hasher = new PasswordHash(8, false);
                    $hash = $hasher->HashPassword($pass1);
                    
			        $statement = mysqli_query($db,"UPDATE wp_users SET user_pass = '$hash' WHERE user_email ='$email'");
			        if(!empty($statement)){
			            mysqli_query($db,"DELETE FROM `password_reset_temp` WHERE `email`='$email'");
			            echo "<script type = 'text/javascript'>
                            $('#newpassw').hide('500')
                            $('#successalert').show('500')
                            setTimeout(()=>window.location.href = 'https://www.myhealthafrica.com/myonemedpro/tunza-login', 5000);
                        </script>";
			        }          
                        
               } 
                    
            ?>
   
</body>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/reset-password.js"></script>
<!-- start js include path -->
<script src="../forgot/jquery.min.js?v=<?php echo $inclusions_version; ?>"></script>
<!-- bootstrap -->
<script src="../forgot/bootstrap.min.js?v=<?php echo $inclusions_version; ?>"></script>


</html>
