<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Welcome to cubetboard</title>
        <link rel="icon" href="<?php echo base_url(); ?>application/assets/images/favicon.ico" type="image/x-icon" />
        <link href="<?php echo base_url(); ?>application/assets/css/cubetboard.css" rel="stylesheet" type="text/css" />
        <script src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.2.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>application/scripts/jquery-ui-1.8.1.custom.min.js" type="text/javascript"></script>
    </head>

    <body>
        <div class="outer">
            <div class="header"><!-- starting Header -->
                <div class="container"><!-- starting container -->
                    <div class="header_box">
                        <div class="logo"><a href="<?php echo site_url(); ?>"><img src="<?php echo site_url() ?>/application/assets/images/cubetboard/logo.png"/></a></div>  
                    </div>
                </div><!-- closing container -->
            </div><!-- closing Header -->
            <div class="white_strip"></div>
            <div class="clear"></div>

            <div class="middle-banner_bg"><!-- staing middlebanner -->
                <div class="container"><!-- staing container -->
                    <div id="login_div">
                        <div class="editprofile_insidebox">
                            <span id="login_links">
                                <div class="inset">
                                    <?php if ((isset($fb_data['uid'])) && ($fb_data['uid'] != 0)): ?>
                                        <a class="fb login_button" href="<?php echo site_url(); ?>"></a>
                                    <?php else: ?>
                                        <a class="fb login_button" href="<?php echo $fb_data['loginUrl']; ?>">
                                        <?php endif ?>
                                        <span>Login/Sign up with Facebook</span>
                                    </a>
                                </div>
                                <div class="inset">
                                    <!--                            <a class="tw login_button" href="/ci/pinterest/auth_other/twitter_signin">-->
                                    <a class="tw login_button" href="<?php echo site_url(); ?>auth_other/twitter_signin">
                                        <span>Login/Sign up with Twitter</span>
                                    </a>
                                </div>
                                <div class="login_box">
                                    <!--                            <form class="login_normal" action="/ci/pinterest/login/normal" method="POST" accept-charset="utf-8">-->
                                    <form class="login_normal" action="<?php echo site_url(); ?>login/normal" method="POST" accept-charset="utf-8">
                                        <ul class="login_form">
                                            <li>
                                                <h2>Normal Login</h2>
                                            </li>
                                            <li>
                                                <a href="<?php echo site_url('invite/entry'); ?>" class="Button2 Button13 WhiteButton"><strong>Register</strong><span></span></a>
                                            </li>

                                            <li>
                                                <input id="id_email" name="email" type="text" class="inputform-field" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value=""/>
                                                <label>Email Address</label>
                                                <span id="email_error" class="error"></span>

                                            </li>

                                            <li id="password_li">
                                                <input id="id_password" name="password" type="password" class="inputform-field" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value=""/>
                                                <label>Password</label>
                                                <span class="pass_error"></span>
                                            </li>

                                        </ul>

                                        <div class="non_inputs">
                                            <input type="submit" name="submit" value="Login" id="login" class="Button2 Button13 WhiteButton"/>
                                            <a id="resetPass" class="colorless" href="#" onclick="forgetPass('show')">Forgot your password?</a>
                                            <a href="#" class="Button2 Button13 WhiteButton" id="reset" onclick="forgetPass('save')" style="display: none"><strong>Reset</strong><span></span></a>
                                            <a id="back" style="display: none;" href="#" class="colorless" onclick="forgetPass('back')">Back to Login?</a>
                                            <div id="loading" style="display:none"><img src="<?php echo site_url(); ?>/application/assets/images/admin/loading.gif"/></div>
                                            <div id="reset_message"></div>
                                        </div>

                                    </form><!-- .Form.FancyForm.AuthForm -->
                                </div>
                            </span>
                        </div><!-- closing container -->

                    </div>
                </div><!-- closing middlebanner -->
            </div>
        </div>
        <?php $this->load->view('footer'); ?>
    </body>
</html>
<script type="text/javascript">
    function forgetPass(type)
    {   $('#email_error').html('')
        $('#reset_message').html('')
        if(type=='show')
        {
            $('#password_li').hide();
            $('#login').hide();
            $('#resetPass').hide();

            $('#reset').show();
            $('#back').show();

        }
        if(type=='back')
        {
            $('#password_li').show();
            $('#login').show();
            $('#resetPass').show();

            $('#reset').hide();
            $('#back').hide();
        }
        if(type=='save')
        {
            email = $('input#id_email').val()
            if(email=='')
            {
                $('#email_error').html('Please enter email')
                return false;
            }
            else{
                $('#loading').show()
                dataString = 'email='+email+'&type=ajax';
                $.ajax({
                    url: "<?php echo site_url('password/reset/'); ?>/",
                    type: "POST",
                    data: dataString,
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                   
                        $('#loading').hide()
                        $('#reset_message').html('reset email link is send to your email id')
                    }
                });
            }
        }

    }
</script>