<?php $this->load->view('admin/admin_header');?>
<div id="Main_Wrapper" class="clearfix">
<?php $this->load->view('admin/admin_sidebar');?>
    <div id="Content_Wrapper">
    	<div class="Box">
        	<div class="Box_Head"></div>
                <div class="Box_Content">
                    <div id="Shorts_key" class="sub_box">
                        <h2>ADMIN MANAGEMENT </h2>
<!--                        search for a user
                        <form method="post" action="<?php //echo site_url('administrator/pin/view') ?>">
                            <input type="text" name="search" id="search" />
                            <input type="submit" name="submit" id="submit" value="submit" />
                        </form>-->
                        <table>
                                <tr>
                                    <td><label>user name</label></td>
                                    <td><input type="text" name="name" value="<?php echo $result->username;?>" id="name" /></td>
                                </tr>
                                 <tr>
                                    <td><label>New password</label></td>
                                    <td><input type="password" name="pass1" value="" id="pass1" /></td>
                                    
                                </tr>
                                <tr>
                                    <td><label>Confirm pass</label></td>
                                    <td><input type="password" name="pass2" value="" id="pass2" /></td>
                                    <td><div id="missmatch_error" class="validation-message"></div></td>

                                </tr>
                                <tr>
                                    <td><input type="button" class="Button2 Button13 WhiteButton" name="submit" value="Save" id="submit" onClick=" return adminManage();"/></td>
                                    <td id="saving" style="display: none;">saving....<div id="loading"></div></td>
                                </tr>
                                <tr><td><div id="error" class="validation-message"></div></td>
                            </table>

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
function adminManage()
{
    name         = $('input#name').val();
    pass1        = $('input#pass1').val();
    pass2        = $('input#pass2').val();

    $('#error').html('');
    $('#missmatch_error').html('');

    var failed = 0;
    if(name=="")
    {  $('#error').html('Input field are request');
       var failed = 1;
    }
    if(pass1=="")
    {   $('#error').html('Input field are request');
        var failed = 1;
    }
    if(pass2=="")
    {   $('#error').html('Input field are request');
        var failed = 1;
    }
    if(pass1!=pass2)
    {
        $('#missmatch_error').html('Password missmatch');
        var failed = 1;
    }
    if(failed==1)
    {
        return false;
    }
    val ='username='+name+'&password='+pass1;
    $('#submit').hide();
    $('#saving').show();
    $('#loading').show();
    $.ajax({
	        url: baseUrl+"administrator/saveAdminDetails",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
            if(data)
            {
                $('input#name').val('');
                $('input#pass1').val('');
                $('input#pass2').val('');
                $('#submit').show();
                $('#saving').hide();
                $('#loading').hide();
                $('#message').html('');
                $('#message').html('saved successfully');
            }
            else{
                $('#message').html('');
                $('#message').html('Sorry something went wrong ');
            }

        }
    })
}
</script>
