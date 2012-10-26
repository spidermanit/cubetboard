<?php $this->load->view('admin/admin_header');?>
<div id="Main_Wrapper" class="clearfix">
<?php $this->load->view('admin/admin_sidebar');?>
    <div id="Content_Wrapper">
    	<div class="Box">
        	<div class="Box_Head"></div>
                <div class="Box_Content">
                    <div id="Shorts_key" class="sub_box">
                        <h2>SITE MANAGEMENT </h2>
<!--                        search for a user
                        <form method="post" action="<?php //echo site_url('administrator/pin/view') ?>">
                            <input type="text" name="search" id="search" />
                            <input type="submit" name="submit" id="submit" value="submit" />
                        </form>-->

                            <table>
                                <tr>
                                    <td><label>Base url</label></td>
                                    <td><input id="base_url" type="text" name="base_url" value="<?php echo $result['base_url'];?>"/></td>
                                    <td id="required">*</td>
                                </tr>
                                <tr>
                                    <td><label>Encryption Key</label></td>
                                    <td><input id="encryption_key" type="text" name="encryption_key" value="<?php echo $result['encryption_key'];?>"/></td>
                                    <td id="required">*</td>
                                </tr>
                                <tr>
                                    <td><label>Admin email</label></td>
                                    <td><input id="admin_email" type="text" name="admin_email" value="<?php echo $result['admin_email'];?>"/></td>
                                    <td id="required">*</td>
                                </tr>
                                <tr>
                                    <td><label>Facebook Api Id</label></td>
                                    <td><input id="facebook_app_id" type="text" name="facebook_app_id" value="<?php echo $result['facebook_app_id'];?>"/></td>
                                    <td id="required">*</td>
                                </tr>
                                <tr>
                                    <td><label>Facebook Api Key</label></td>
                                    <td><input id="facebook_app_key" type="text" name="facebook_app_key" value="<?php echo $result['facebook_app_key'];?>"/></td>
                                    <td id="required">*</td>
                                </tr>
                                <tr>
                                    <td><label>Facebook Api Secret</label></td>
                                    <td><input id="facebook_app_secret" type="text" name="facebook_app_secret" value="<?php echo $result['facebook_app_secret'];?>"/></td>
                                    <td id="required">*</td>
                                </tr>
                                <tr>
                                    <td><label>Need facebook invite ?</label></td>
                                    <?php $checked1 = ($result['need_invite']==1)?'checked':''?>
                                    <?php $checked0 = ($result['need_invite']==0)?'checked':''?>
                                    <td>
                                        <input type="radio" name="need_invite" id="need_invite" value="1" <?php echo $checked1;?>>Yes
                                        <input type="radio" name="need_invite" value="0" <?php echo $checked0;?>>No
                                    </td>

                                </tr>
                                <tr>
                                    <td><label>Tweet Customer Key</label></td>
                                    <td><input id="tweet_consumer_key" type="text" name="tweet_consumer_key" value="<?php echo $result['tweet_consumer_key'];?>"/></td>
                                    <td id="required">*</td>
                                </tr>
                                 <tr>
                                    <td><label>Tweet Customer Secret</label></td>
                                    <td><input id="tweet_consumer_secret" type="text" name="tweet_consumer_secret" value="<?php echo $result['tweet_consumer_secret'];?>"/></td>
                                    <td id="required">*</td>
                                </tr>
                                <tr>
                                    <td id="error_message" class="validation-message" style="display: none"></td>
                                </tr>
                                <tr>
                                    <td id="process_action" style="display: none;">saving...<div id="loading"></div></td>
                                    <td><input type="submit" class="Button2 Button13 WhiteButton" name="submit" id="settings_submit" value="Save settings" onclick="return validateSettings(<?php echo $result['id'];?>)"/></td>

                                </tr>
                            </table>
                        <div id="message_board"></div>
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
function validateSettings(id)
{
    base_url                = $('input#base_url').val();
    encryption_key          = $('input#encryption_key ').val();
    admin_email             = $('input#admin_email ').val();
    need_invite             = $('input:radio[name=need_invite]:checked').val();
    facebook_app_id         = $('input#facebook_app_id ').val();
    facebook_app_key        = $('input#facebook_app_key ').val();
    facebook_app_secret     = $('input#facebook_app_secret ').val();
    tweet_consumer_key      = $('input#tweet_consumer_key ').val();
    tweet_consumer_secret   = $('input#tweet_consumer_secret ').val();
    

    $('#error_message').html('');

    var failed = 0;
    if((base_url=="")||(encryption_key=="")||(admin_email=="")||(facebook_app_id=="")||(facebook_app_key=="")||(facebook_app_secret=="")||(tweet_consumer_key=="")||(tweet_consumer_secret==""))
    {   $('#error_message').show();
        $('#error_message').html('All fields are required');
       var failed = 1;
    }
    if(failed==1)
    {
        return false;
    }

    val ='id='+id+'&encryption_key='+encryption_key+'&admin_email='+admin_email+'&need_invite='+need_invite+'&facebook_app_id='+facebook_app_id+'&facebook_app_key='+facebook_app_key+'&facebook_app_secret='+facebook_app_secret+'&tweet_consumer_key='+tweet_consumer_key+'&tweet_consumer_secret='+tweet_consumer_secret;
    $('#settings_submit').hide();
    $('#process_action').show();
    $('#loading').show();
    $.ajax({
	        url: baseUrl+"administrator/settings",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
            if(data)
            {
                $('#settings_submit').show('');
                $('#process_action').hide();
                $('#loading').hide();
                $('#error_message').html('');
                $('#error_message').html('saved successfully');
            }
            else{
                $('#error_message').html('');
                $('#error_message').html('Sorry something went wrong ');
            }

        }
    })
}
</script>
