<?php $this->load->view('admin/admin_header');?>
<div id="Main_Wrapper" class="clearfix">
<?php $this->load->view('admin/admin_sidebar');?>
    <div id="Content_Wrapper">
    	<div class="Box">
        	<div class="Box_Head"></div>
                <div class="Box_Content">
                    <div id="Shorts_key" class="sub_box">
                        <h2>CATEGORY MANAGEMENT </h2>
<!--                        search for a user
                        <form method="post" action="<?php //echo site_url('administrator/pin/view') ?>">
                            <input type="text" name="search" id="search" />
                            <input type="submit" name="submit" id="submit" value="submit" />
                        </form>-->
                        <table>
                                <tr>
                                    <td><label>Field</label></td>
                                    <td><input type="text" name="field" value="" id="field" /></td>
                                    <td><div id="error_field" class="validation-message"></div></td>
                                </tr>
                                 <tr>
                                    <td><label>Name</label></td>
                                    <td><input type="text" name="name" value="" id="name" /></td>
                                    <td><div id="error_name" class="validation-message"></div></td>
                                </tr>
                                <tr>
                                    <td><input type="button" class="Button2 Button13 WhiteButton" name="submit" value="Save pin" id="submit" onClick=" return categoryAdd();"/></td>
                                    <td id="saving" style="display: none;">saving....<div id="loading"></div></td></tr>
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
function categoryAdd()
{
    name         = $('input#name').val();
    field        = $('input#field').val();
    $('#error_name').html('');
    $('#error_field').html('');
    var failed = 0;
    if(name=="")
    {
        $('#error_name').html('please enter a value');
       var failed = 1;
    }
    if(field=="")
    {
        $('#error_field').html('please enter a value');
        var failed = 1;
    }
    if(failed==1)
    {
        return false;
    }
    val ='name='+name+'&field='+field;
    $('#submit').hide();
    $('#saving').show();
    $('#loading').show();
    $.ajax({
	        url: baseUrl+"administrator/saveNewCategory",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
            if(data)
            {
                name         = $('input#name').val('');
                field        = $('input#field').val('');
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
