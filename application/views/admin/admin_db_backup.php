<?php $this->load->view('admin/admin_header');?>
<div id="Main_Wrapper" class="clearfix">
<?php $this->load->view('admin/admin_sidebar');?>
    <div id="Content_Wrapper">
    	<div class="Box">
        	<div class="Box_Head"></div>
                <div class="Box_Content">
                    <div id="Shorts_key" class="sub_box">
                        <h2>DATABASE MANAGEMENT</h2>
                        <div id="message">
                            <?php if(isset($message)):?>
                            <h2 style="color:#d20000;"><?php echo $message;?></h2>
                            <?php endif;?>
                        </div>
                            <div id ="export">
                                <h3>select tables for export</h3>
                                <form action="<?php echo site_url("administrator/dbBackup") ?>" method=POST>
                                <select multiple name="options[]">
                                 <?php foreach($tables as $value):?>
                                         <option><?php echo $value->Tables_in_cubettec_ci_pinter; ?></option>
                                 <?php endforeach;?>
                                </select>
                                <br><br>
                                <input type=submit class="Button2 Button13 WhiteButton" name=Submit value="export"/>
                                </form>
                            </div>
                            <div id="fileselect">
                                <h3>select file to import</h3>
                                <form method="post" action="<?php echo site_url("administrator/dbBackup")?>" enctype="multipart/form-data">
                                <input type="file" name="file" /><br />
                                <input type="submit" class="Button2 Button13 WhiteButton" name="upload" value="import" />
                                </form>
                            </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<script type="text/javascript">
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
</script>
<script type="text/javascript">
$().ready(function() {
	$("#search").autocomplete(baseUrl+"administrator/autoComplete", {
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
