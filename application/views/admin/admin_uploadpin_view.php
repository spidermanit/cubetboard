<?php $this->load->view('admin/admin_header');?>
<div id="Main_Wrapper" class="clearfix">
<?php $this->load->view('admin/admin_sidebar');?>
    <div id="Content_Wrapper">
    	<div class="Box">
        	<div class="Box_Head"></div>
                <div class="Box_Content">
                    <div id="Shorts_key" class="sub_box">
                        <h2>UPLOAD PINS</h2>
                            <?php if($this->session->userdata('success_messgae')):?>
                                <div id="success_messgae"><?php echo $this->session->userdata('success_messgae');?></div>
                                <?php $this->session->unset_userdata('success_messgae'); ?>
                            <?php endif?>
                            <form method="post" action="<?php echo site_url('administrator/saveUploadPin');?>" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return validateUpload()">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Pin description</td>
                                        <td><textarea name="description" id="description" value=""></textarea></td>
                                        <td><span id="error_description" class="validation-message"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Pin user</td>
                                        <td><input type="text"  name="user" id="user" value="" onblur="loadBoards()"/></td>
                                        <td><span id="error_user" class="validation-message"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Board</td>
                                        <td id="user_board"></td>
                                        <td><span id="error_board"></span></td>
                                        <td><div id="loading"></div></td>
                                    </tr>
                                    <tr>
                                        <td>Type</td>
                                        <td>
                                            <select name="type" id="type">
                                                <option value="image">Image</option>
                                                <option value="video">Video</option>
                                            </select>
                                        </td>
                                    </tr>
<!--                                    <tr>
                                        <td>source</td>
                                        <td><input type="text" name="source" id="source" value="" /></td>
                                        <td><span id="error_source"></span></td>
                                    </tr>-->
                                    <tr>
                                        <td>Pin</td>
                                        <td><input type="file" name="pin" id="pin" value=""/></td>
                                        <td><span id="error_pin" class="validation-message"></span></td>
                                    </tr>
                                    <tr>
                                        <td id="save_btn" class="Button2 Button13 WhiteButton" style="display: none;"><input type="submit" name="button" id="submit" value="save" /></td>
                                    </tr>
                                </tbody>

                            </table>
                            </form>

                        
                        <span id="message"></span>
                        <div id="bar_chat_wrapper" class="k-content">
                            <div class="chart-wrapper">
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>


<script type="text/javascript">
/*
function editUser(actionid,userid)
{
    val ='username='+username+'&password='+password;
    $.ajax({
	        url: baseUrl+"administrator/login",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
               if(data==true)
               window.location.replace(baseUrl+"administrator/index");
               else
                  $('#message').html('');
                  $('#message').html('invalid login');
            }
        })

}
*/
function validateUpload()
{
    description = $('textarea#description').val();
    user        = $('input#user').val();
    type        = $("#type option:selected").val();
    board       = $("#board option:selected").val();
    pin         = $('input#pin').val();

    $('#error_description').html('');
    $('#error_user').html('');
    $('#error_board').html('');
    $('#error_pin').html('');

    failed = 0 ;

    if(description=="")
    {
        $('#error_description').html('please provide a value');
        failed = 1;
    }
    if(user=="")
    {
        $('#error_user').html('please provide a value');
        failed = 1;
    }
    if(isNaN(board))
    {
        $('#error_board').html('Invalid board selection');
        failed = 1;
    }
    if(pin=="")
    {
        $('#error_pin').html('please upload a pin');
        failed = 1;
    }
    else{
        image = pin.toString().split(".");
        if((image[1]!='png')&&(image[1]!='jpg')&&(image[1]!='gif')&&(image[1]!='jpeg'))
        {
            $('#error_pin').html('Invalid image');
             failed = 1;
        }
    }
    
    if(failed==1)
    {
        return false;
    }
    else{
        return true;
    }
    /*
    val ='description='+description+'&user='+user+'&source='+source+'&pin='+pin+'&board='+board;
    $.ajax({
	        url: baseUrl+"administrator/saveUploadPin",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
               if(data==true)
               {
                  $('#upload_message').html('');
                  $('#upload_message').html('Pin uploaded successfully!');
               }

               else
               {
                  $('#upload_message').html('');
                  $('#upload_message').html('Sorry some thing went wrong please try again');
               }
                  
            }
        })
        */
}
</script>
<script type="text/javascript">
$().ready(function() {
	$("#user").autocomplete(baseUrl+"administrator/autoComplete", {
		width: 260,
		matchContains: true,
		selectFirst: false,
        formatResult: function (data) {
                    var one = data;
                    var two= one.toString().split("-");
                    return two[1];
                }

	});
});
</script>
<script type="text/javascript">
$().ready(function() {
    setTimeout(function() {
    $('#success_messgae').fadeOut('fast');
}, 1000); // <-- time in milliseconds

});
</script>
<script type="text/javascript">
function loadBoards()
{   
    user = $('input#user').val()
    userId = user.toString().split(" ")[0];

    if(isNaN(userId))
    {
        return false;
    }
    val = 'userId='+userId;
    $('#loading').show();
    $('#user_board').html('')
    $('#save_btn').hide()
    $.ajax({
	        url: baseUrl+"administrator/getUserBoardList",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
               if(data)
               {  $('#loading').hide();
                  $('#user_board').html(data)
                  $('#save_btn').show()

               }

               else
               {
                  $('#user_board').html('sorry no board found')
               }

            }
        })

}
</script>
