<link href="<?php echo base_url(); ?>application/assets/css/style.css" rel="stylesheet" type="text/css" />
<div class="middle-banner_bg"><!-- staing middlebanner -->
        <div class="container"><!-- staing container -->
            <div class="reset_box">

            <?php if(isset($message)):?>
                <div class="alert_messgae">
                    <div id="message"><h2><?php echo $message?></h2></div>
                </div>
            <?php else:?>

            <div class="editprofile_insidebox">
                <form id="resetEdit" class="Form StaticForm" action="<?php echo site_url('password/reset');?>" method="POST" accept-charset="utf-8">

                    <h3>Reset Password</h3>

                    <ul>

                        <li>
                            <label for="id_email">E-mail</label>
                            <div class="Right">
                                <input id="id_email" type="text" name="email" maxlength="75" />
                                <span class="help_text">Enter your email address and we'll send you instructions.</span>
                            </div>
                            <span id="resetemail_null_error" class="validation-message"></span>
                        </li>

                    </ul>
                    <div class="Submit">
            <!--                <a href="#" class="Button RedButton Button24" onclick="$('#profileEdit').submit(); return false">
                            <strong>Submit</strong>
                            <span></span>
                        </a>-->
                        <input type="submit" name="submit" value="Submit" onclick="return resetfn()" class="Button2 Button13 WhiteButton"/>
                    </div>

                </form>

                <?php endif?>

            </div>
            </div>
    </div><!-- closing container -->
</div><!-- closing middlebanner -->
    <?php $this->load->view('footer');?>


<script language="javascript" type="text/javascript">
function resetfn()
{  
    var email    = $("input#id_email").val();
    failed= 0;
    $('#resetemail_null_error').html("")
    if(email=='')
    {        failed= 1;
            $('#resetemail_null_error').html("Enter a value")
    }
    if(failed==1)
        return false;
    else
        return true;
}
</script>

</body>
</html>


