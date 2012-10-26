<?php $this->load->view('admin/admin_header');?>
<div id="Main_Wrapper" class="clearfix">
<?php $this->load->view('admin/admin_sidebar');?>
    <div id="Content_Wrapper">
    	<div class="Box">
        	<div class="Box_Head"></div>
                <div class="Box_Content">
                    <div id="Shorts_key" class="sub_box">
                        <h2>CATEGORY MANAGEMENT</h2>
<!--                        search for a user
                        <form method="post" action="<?php //echo site_url('administrator/pin/view') ?>">
                            <input type="text" name="search" id="search" />
                            <input type="submit" name="submit" id="submit" value="submit" />
                        </form>-->

                        <div id="pin_pagination">
                        <?php echo $this->pagination->create_links(); ?>
                        </div>
                        <?php ?>
                        <?php if(!empty ($category)):?>
                            <table>
                                <thead>
                                    <th>Id</th>
                                    <th>Field</th>
                                    <th>Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($category as $key => $value):?>
                                        <tr id="tr_<?php echo $value->id;?>">

                                            <td><?php echo $value->id;?></td>

                                            <td><?php echo $value->field;?></td>

                                            <td><?php echo $value->name;?></td>
   
                                            <td id="edit_<?php echo $value->id;?>"><a href="<?php echo site_url('administrator/editCategory/'.$value->id);?>" rel="facebox"><img src="<?php echo site_url('application/assets/images/admin/edit.png');?>"/></a></td>
                                            <td id="remove_<?php echo $value->id;?>"><a href="<?php echo site_url('administrator/confirmDeleteCategory/'.$value->id);?>" rel="facebox"><img src="<?php echo site_url('application/assets/images/admin/delete.png');?>"/></a></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>

                            </table>
                        <?php endif?>
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
<!--<script type="text/javascript">
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
</script>-->
