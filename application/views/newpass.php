<link rel="icon" href="<?php echo base_url(); ?>application/assets/images/favicon.ico" type="image/x-icon" />
<link href="<?php echo base_url(); ?>application/assets/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/assets/css/cubetboard.css" rel="stylesheet" type="text/css" />
<title>Reset password</title>
<script src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.2.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>application/scripts/jquery-ui-1.8.1.custom.min.js" type="text/javascript"></script>
 <div class="header"><!-- starting Header -->
    <div class="container"><!-- starting container -->
        <div class="header_box">
            <div class="logo"><a href="<?php echo site_url();?>"><img src="<?php echo site_url()?>application/assets/images/cubetboard/logo.png"/></a></div>
        </div>
    </div><!-- closing container -->
</div><!-- closing Header -->
<div class="white_strip"></div>
<div class="middle-banner_bg"><!-- staing middlebanner -->
    <div class="FixedContainer">
            <?php if($success==1):?>
                <div class="alert_messgae">
                    <h2>Your password has been reset successfully..<a href="/ci/pinterest/login/handleLogin">Click <span class="error">here</span> to login</a></h2>
                </div>
            <?php else:?>
                <?php if($emailcheck==1):?>
                <form id="profileEdit" class="Form StaticForm" action="" method="POST" accept-charset="utf-8">
                    <div class="editprofile_insidebox">
                        <div id="newpass_box">
                     <h3>Enter your new password</h3>
                        <ul>
                            <li>
                                <label for="id_new_password1">New password</label>

                                <div class="Right">
                                    <input type="password" name="new_password1" id="id_new_password1" />

                                </div>
                                <span id="reset_pass1_null_error" class="validation-message"></span>
                            </li>

                            <li>
                                <label for="id_new_password2">Confirm</label>
                                <div class="Right">
                                    <input type="password" name="new_password2" id="id_new_password2" />
                                </div>
                                <span id="reset_pass2_null_error" class="validation-message"></span>
                                <span id="reset_missmatch_error" class="validation-message"></span>
                                <input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
                            </li>

                        </ul>

                        <div class="Submit">
                            <input type="submit" name="submit" value="Submit" class="Button2 Button13 WhiteButton" onclick="return resetpass()" />
                        </div>
                    </div>
                    </div>
                </form>
            <?php else:?>
            <div class="alert_messgae">
                <span><h2>your email id is invalid or password reset time expired</h2></span>
            </div>
        <?php endif?>
    <?php endif?>
</div>
</div>
<?php $this->load->view('footer');?>
<script type="text/javascript">
    function resetpass()
{

    var new1   = $("input#id_new_password1").val();
    var new2   = $("input#id_new_password2").val();
    failed= 0;
    $('#reset_pass1_null_error').html("")
    $('#reset_pass2_null_error').html("")
    $('#reset_missmatch_error').html("")
    if(new1=='')
    {
      failed = 1;
      $('#reset_pass1_null_error').html("please enter a value!")
    }
    if(new2=='')
    {
      failed = 1;
      $('#reset_pass2_null_error').html("please enter a value!")
    }
    if(new1!=new2)
    {
     failed = 1;
      $('#reset_missmatch_error').html("password missmatch!")
    }
    if(failed==1)
       return false;
    else
       return true;
}
</script>
</body>
</html>