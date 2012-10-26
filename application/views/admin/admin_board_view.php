<?php $this->load->view('admin/admin_header');?>
<div id="Main_Wrapper" class="clearfix">
<?php $this->load->view('admin/admin_sidebar');?>
    <div id="Content_Wrapper">
    	<div class="Box">
        	<div class="Box_Head"></div>
                <div class="Box_Content">
                    <div id="Shorts_key" class="sub_box">
                        <h2>BOARD MANAGEMENT</h2>
                        <!--search for a user -->
                        <form method="post" action="<?php echo site_url('administrator/board/view') ?>">
                            <input type="text" name="search" id="search" />
                            <input type="submit" name="submit" id="submit" value="submit" />
                        </form>

                        <div id="pin_pagination">
                        <?php echo $this->pagination->create_links(); ?>
                        </div>
                        <?php ?>
                        <?php if(!empty ($result)):?>
                            <table>
                                <thead>
                                    <th>Board id</th>
                                    <th>Board name</th>
                                    <th>Category name</th>
                                    <th>user id</th>
                                    <th>User name</th>
                                    <th>Pins count</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </thead>
                                <tbody>
                                    <?php foreach ($result as $key => $value):?>
                                        <tr id="tr_<?php echo $value->id;?>">

                                            <td><?php echo $value->id;?></td>

                                            <td><?php echo $value->board_name;?></td>

                                            <?php $categoryName = getCategoryByField($value->category);?>
                                            <td><?php echo $categoryName->name;?></td>

                                            <td><?php echo $value->user_id;?></td>

                                            <?php $userDetails = userDetails($value->user_id);?>
                                            <td><?php echo $userDetails['name']?></td>

                                            <?php $pinCount = getEachBoardPins($value->id);?>
                                             <td><?php echo count($pinCount)?></td>


                                            <td id="edit_<?php echo $value->id;?>"><a href="<?php echo site_url('administrator/editBoard/'.$value->id);?>" rel="facebox"><img src="<?php echo site_url('application/assets/images/admin/edit.png');?>"/></a></td>
                                            <td id="remove_<?php echo $value->id;?>"><a href="<?php echo site_url('administrator/confirmDeleteBoard/'.$value->id);?>" rel="facebox"><img src="<?php echo site_url('application/assets/images/admin/delete.png');?>"/></a></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>

                            </table>
                            <?php $current=current_url();?>
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
