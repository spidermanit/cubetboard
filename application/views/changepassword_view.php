<?php $this->load->view('header');?>
<link href="<?php echo base_url(); ?>application/assets/css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
   function change()
   {
       var password = '<?php echo $password?>'
       var oldpass    = $("input#id_old_password").val();
       var new1   = $("input#id_new_password1").val();
       var new2   = $("input#id_new_password2").val();
       $('#old_null_error').html("")
       $('#new1_null_error').html("")
       $('#new2_null_error').html("")
       $('#missmatch_error').html("")
       failed = 0;
       if(oldpass=='')
       {
          failed = 1;
          $('#old_null_error').html("please enter a value!")
       }
       if(new1=='')
       {
          failed = 1;
          $('#new1_null_error').html("please enter a value!")
       }
       if(new2=='')
       {
          failed = 1;
          $('#new2_null_error').html("please enter a value!")
       }
       if(new1!=new2)
       {
         failed = 1;
          $('#missmatch_error').html("password missmatch!")
       }
       if(failed==1)
           return false;
       else
           return true;
   }
</script>
<div class="white_strip"></div>
<div class="middle-banner_bg"><!-- staing middlebanner -->
<div class="FixedContainer">
    <div id="message"><?php echo $message; ?></div>
    <!--<form id="passwordEdit" class="Form StaticForm" action="/ci/pinterest/password" method="POST" accept-charset="utf-8">-->
    <form id="passwordEdit" class="Form StaticForm" action="<?php echo site_url('password');?>" method="POST" accept-charset="utf-8">
        <div class="editprofile_insidebox">
        <h3>Change Password</h3>
        <ul class="change_pass">
            <li>
                <label for="id_old_password">Old</label>
                 <div class="Right">
                    <input type="password" name="old_password" id="id_old_password" value=" "/>
                    <span class="validation-message" id="old_null_error"></span>
                    <span class="validation-message" id="old_error"><?php echo $olderror;?></span>
                 </div>
                 <span class="help_text"><a href="<?php echo site_url();?>password/reset/" tabindex="-1">Reset Password</a></span>
            </li>
            <li>
                <label for="id_new_password1">New</label>
                <div class="Right">
                     <span class="help_text"></span>
                    <span class="validation-message" id="new1_null_error"></span>
                    <input type="password" name="new_password1" id="id_new_password1" />
                </div>
                 <span class="help_text">Be tricky!</span>
            </li>
            <li>
                <label for="id_new_password2">New, Again</label>
                <div class="Right">
                    <input type="password" name="new_password2" id="id_new_password2" />
                    <span class="validation-message" id="missmatch_error"></span>
                    <span class="validation-message" id="new2_null_error"></span>
                </div>
                <span class="help_text">Confirm password</span>
            </li>
             <li>
                <input type="submit" name="submit" value="Change password" class="Button2 Button13 WhiteButton" onclick="return change()" />
            </li>
        </ul>
        </div>
    </form>
</div><!-- FixedContainer-->
</div>
<?php $this->load->view('footer');?>
</body>
</html>