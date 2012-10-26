<script src="<?php echo base_url(); ?>application/scripts/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>application/src/facebox.js" type="text/javascript"></script>
<div id="fancybox-outer">
<div class="fancybox-bg" id="fancybox-bg-n">
</div>
<div class="fancybox-bg" id="fancybox-bg-ne"></div>
<div class="fancybox-bg" id="fancybox-bg-e"></div>
<div class="fancybox-bg" id="fancybox-bg-se"></div>
<div class="fancybox-bg" id="fancybox-bg-s"></div>
<div class="fancybox-bg" id="fancybox-bg-sw"></div
><div class="fancybox-bg" id="fancybox-bg-w"></div>
<div class="fancybox-bg" id="fancybox-bg-nw"></div>
<div style="border-width: 10px; width: 580px; height: auto;" id="fancybox-content">
    <div style="width: auto; height: auto; overflow: auto; position: relative;">
        <div id="Repin_Pop" class="Pop_Up_Blk">
            <h2>Edit User</h2>
            <div class="pop_content">
                <div id="pop_content">
                    <div class="right clsFloatRight" style="float: left;width: auto;">
                        <div id="edit_user">
                            <table>
                                <tr>
                                    <td><label>Name</label></td>
                                    <td><input type="text" name="first_name" id="first_name" value="<?php echo $result->first_name;?>"/></td>
                                </tr>
                                <tr>
                                    <td><label>User name</label></td>
                                    <td><input type="text" name="username" id="username" value="<?php echo $result->username;?>"/></td>
                                </tr>
                                <tr>
                                    <td><label>Email</label></td>
                                    <td><input type="text" name="email" id="email" value="<?php echo $result->email;?>"/></td>
                                    
                                </tr>
                               
                                <tr>
                                    <td id="process_action" style="display: none;">saving...<div id="loading"></div></td>
                                    <td><input type="button" name="submit" id="user_submit" class="Button2 Button13 WhiteButton" value="submit" onclick="validate(<?php echo $result->id;?>)"/></td>
                                </tr>
                                <tr>
                                    <td><span id="error_message" class="validation-message"></span></td>
                                    <td><span id="email_exist" class="validation-message"></span></td>
                                </tr>

                            </table>
                        </div>
                        
                    </div>
                    <div class="clear"></div>
                </div>

            <div style="display: none;" id="repin_msg">
                    Repinned to <a href="#" id="board_view">beatuy.</a><br>
                    Shared with your followers. <a href="#" id="repin_view">See it now.</a>
            </div>
        </div>
    </div>
</div>
</div>
<a style="display: inline;" id="fancybox-close" ></a>
<div style="display: none;" id="fancybox-title"></div>
<a style="display: none;" href="javascript:;" id="fancybox-left">
<span class="fancy-ico" id="fancybox-left-ico"></span>
</a>
<a style="display: none;" href="javascript:;" id="fancybox-right">
<span class="fancy-ico" id="fancybox-right-ico"></span>
</a>
</div>
<script type="text/javascript">
function checkEmail()
{   alert('here')
    email   = $('input#email').val();
    orginal = '<?php echo $result->email?>'

    var o= <?php echo json_encode($emailList ); ?>;
    $('#email_exist').html("")
    for (key in o){
        if(o[key]==email){
            if(orginal==o[key])
            {
            }
            else{
                $('#email_exist').html("Email already exit")
                return false
            }
        }else{
        }

    }
}
</script>
<script type="text/javascript">
function validate(id)
{
    name = $('input#first_name').val();
    username = $('input#username').val();
    email = $('input#email').val();
    if((name=="")||(username=="")||(email==""))
    {   $('#email_exist').html("")
        $('#error_message').html('Please enter all inputs');
        return false;
    }
    
    orginal = '<?php echo $result->email?>'
    var o= <?php echo json_encode($emailList ); ?>;
    $('#email_exist').html("")
    for (key in o){
        if(o[key]==email){
            if(orginal==o[key])
            {
            }
            else{
                $('#email_exist').html("Email already exit")
                return false
            }
        }else{
        }

    }

    val = 'id='+id+'&name='+name+'&username='+username+'&email='+email;
    $('#process_action').show();
    $('#loading').show();
    $('input#user_submit').hide();
    $.ajax({
	        url: baseUrl+"administrator/saveEditUser",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
               if(data==true)
               window.location.replace(baseUrl+"administrator/users");
               else
                  
                  $('#error_message').html('something went wrong!. Please try again');
            }
    })
}
</script>