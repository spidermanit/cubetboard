<link href="<?php echo base_url(); ?>application/assets/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    function profileEditFn()
    {
        var email           = $("input#id_email").val();
        var first_name      = $("input#id_first_name").val();
        var last_name       = $("input#id_last_name").val();
        var img             = $("input#file").val();
        failed              = 0;

        $('#email_error').html("")
        $('#first_name_error').html("")
        $('#last_name_error').html("")
        $('#username_error').html("")
        $('#img_error').html("")

        if(email=='')
        {   failed=1
            $('#email_error').html("please enter a value!")
        }
        else{
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(email))
            {
                 $('#email_error').html("Invalid email!")
                  var failed= 1;
            }
            var o = <?php echo json_encode($emailList ); ?>;
            for (key in o){
                if(o[key]==email){
                        orginal = '<?php echo $result->email ;?>';
                        if(email==orginal)
                        {

                        }
                        else{
                            $('#email_error').html("Email already exit")
                            var failed= 1;
                        }
                        
                }
            }
        }
        if(first_name=='')
        {   failed=1
            $('#first_name_error').html("please enter a value!")
        }
        if(last_name=='')
        {   failed=1
            $('#last_name_error').html("please enter a value!")
        }
        if(img!='')
        {   
             image = img.toString().split(".");

             if((image[1]!='png')&&(image[1]!='jpg')&&(image[1]!='gif')&&(image[1]!='jpeg')&&(image[1]!='PNG')&&(image[1]!='GIF')&&(image[1]!='JPEG')&&(image[1]!='JPG'))
             {
                $('#img_error').html('Invalid image');
                 failed = 1;
             }
        }
        if(failed==1)
        return false;
        else
            return true;

    }
</script>
</head>
<?php $this->load->view('popup_js');?>
<div class="middle-banner_bg"><!-- staing middlebanner -->
    <div class="FixedContainer">
        <!--<form id="profileEdit" class="Form StaticForm" action="/ci/pinterest/editprofile/save" method="post" onsubmit=" return profileEditFn()"  enctype="multipart/form-data" accept-charset="utf-8" name="profileEdit">-->
        <form id="profileEdit" class="Form StaticForm" action="<?php echo site_url('editprofile/save'); ?>" method="post" onsubmit=" return profileEditFn()"  enctype="multipart/form-data" accept-charset="utf-8" name="profileEdit">
            <div class="editprofile_insidebox">
                <h3>Edit Profile</h3>
                <ul>
                    <!-- Email -->
                    <li>
                        <label for="id_email">Email</label>
                        <div class="Right">
                            <input type="text" name="email" value="<?php echo $result->email ;?>" id="id_email" />
                            <span class="help_text">Not shown publicly</span>
                            <span id="email_error" style="font-size:13px;color:red;"></span>
                        </div>
                    </li>
                    <!-- Notifications -->
        <!--            <li>
                        <label>Notifications</label>
                        <div class="Right">

                            <select id="notifications">
                                <option <?php //echo ($result->notifications =='yes')?'selected':'' ?>>yes</option>
                               <option <?php //echo ($result->notifications =='no')?'selected':'' ?>>no</option>
                            </select>
                            <a href="<?php //echo site_url('notifications')?>" class="Button WhiteButton Button18"><strong>Change Email Settings</strong><span></span></a>
                        </div>
                    </li>-->

                    <!-- Password -->
                    <li>
                        <label>Password</label>
                        <div class="Right">
                            <a href="<?php echo site_url('password/index');?>" class="Button WhiteButton Button18"><strong>Change Password</strong><span></span></a>
                        </div>
                    </li>
                    <!-- First Name -->
                    <li>
                        <label for="id_first_name">First name</label>
                        <div class="Right">
                            <input type="text" name="first_name" value="<?php echo $result->first_name;?>" id="id_first_name" />
                            <span id="first_name_error" style="font-size:13px;color:red;"></span>
                        </div>
                    </li>
                    <!-- Last Name -->
                    <li>
                        <label for="id_last_name">Last name</label>
                        <div class="Right">

                            <input type="text" name="last_name" value="<?php echo $result->last_name;?>" id="id_last_name" />
                            <span id="last_name_error" style="font-size:13px;color:red;"></span>
                        </div>
                    </li>
                    <!-- Username -->
        <!--            <li>
                        <label for="id_username">Username</label>
                        <div class="Right">
                            <input type="text" name="username" value="<?php //echo $result->username;?>" id="id_username" />
                            <span class="help_text username_available"></span>
                            <span id="username_error" style="font-size:13px;color:red;"></span>
                        </div>
                    </li>-->
                    <!-- About -->
                    <li>
                        <label for="id_about">Description</label>
                        <div class="Right">
                            <textarea id="id_description" rows="3" cols="54" name="description" style="height: 111px;width:100px;"><?php echo $result->description;?></textarea>
                        </div>
                    </li>
                    <!-- Location -->
                    <li>
                        <label for="id_location">Location</label>
                        <div class="Right">
                            <input type="text" name="location" id="id_location" value="<?php echo $result->location;?>"/>
                            <span class="help_text">e.g. Palo Alto, CA</span>

                        </div>
                    </li>

                    <!-- Image -->
                    <li>
                        <label for="id_img">Image</label>
                        <div class="Right">

                            <div class="current_avatar_wrapper">
                              <img alt="Loading..." class="spinner" src="" />
                              <img src="<?php echo $result->image;?>?type=large" class="current_avatar floatLeft" alt="Current profile picture" />
                            </div>
                            <div class="floatLeft NoInput" style="padding-left: 12px;">
                                <input type="file" name="img" id="file"/>
                                <span id="img_error" style="font-size:13px;color:red;"></span>
                            </div>
                        </div>
                    </li>
                    <?php if($result->connect_by=='facebook'):?>
                    <!-- Facebook -->
                    <li class="NoInput">
                        <label>Facebook</label>
                        <div>
                            <label class="large" for="facebook_connect" style="width: 174px;">
                                <?php
                                if($result->facebook_post==1){
                                    $checked='checked';
                                }
                                else{
                                    $checked='';
                                }
                                ?>
                                <input id="facebook_connects"  name ="facebook_post" type="checkbox" <?php echo $checked;?>/> Link to Facebook
                            </label>
                        </div>
                    </li>

                    <li class="NoInput">
                        <label>Facebook image</label>
                        <div>
                            <label class="large" for="facebook_image" style="float: left;width: 379px;">
                                <input style="padding-left:5px;" id="facebook_image"  name ="facebook_image" type="checkbox"/> Set current facebook image as profile image
                            </label>
                        </div>
                    </li>
                    <?php endif;?>

                     <?php if($result->connect_by=='twitter'):?>
                    <!-- Twitter -->
                    <li class="NoInput">
                        <label>Twitter</label>
                        <div>
                            <label class="large" for="twitter_connect">
                                <?php
                                if($result->twitter_post==1){
                                    $checked='checked';
                                }
                                else{
                                    $checked='';
                                }
                                ?>
                                <input  id="twitter_connects" type="checkbox" name="twitter_post" <?php echo $checked;?>/> Link to Twitter
                            </label>
                        </div>

                    </li>
                    <li class="NoInput">
                        <label>Twitter image</label>
                        <div>
                            <label class="large" for="twitter_image" style="float: left;width: 379px;">
                                <input style="padding-left: 5px;" id="twitter_image"  name ="twitter_image" type="checkbox"/> Set current twitter image as profile image
                            </label>
                        </div>
                    </li>
                    <?php endif;?>
                    <!-- Delete -->
                    <li class="Delete">
                        <label>Delete</label>
                        <div class="Right">
                            <!-- href="/vishalv/delete/" -->
                            <a href="<?php echo site_url('editprofile/confirmDelete/'.$result->id);?>"  id="delete_user_account" class="Button WhiteButton Button18 ajax" name="delete_user_account"><strong>Delete Account</strong><span></span></a>
                        </div>
                    </li>

                </ul>

                <!-- Button -->
                <div class="Submit">
                    <input type="submit" name="submit" value="save profile" class="Button2 Button13 WhiteButton"/>
                </div>
                <div style='display:none'><input type='hidden' name='csrfmiddlewaretoken' value='c3162537217e8e024bcec791f154a26a' /></div>
         </div>
        </form>
    </div><!-- .FixedContainer -->
</div>
<?php $this->load->view('footer');?>
<div id="SearchAutocompleteHolder"></div>
 </html>