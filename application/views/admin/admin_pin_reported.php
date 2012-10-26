<?php $this->load->view('admin/admin_header');?>
<div id="Main_Wrapper" class="clearfix">
<?php $this->load->view('admin/admin_sidebar');?>
    <div id="Content_Wrapper">
    	<div class="Box">
        	<div class="Box_Head"></div>
                <div class="Box_Content">
                    <div id="Shorts_key" class="sub_box">
                        <h2>Reported pins</h2>
                        <!--search for a user -->
                        <form method="post" action="<?php echo site_url('administrator/pin/view') ?>">
                            <input type="text" name="search" id="search" />
                            <input type="submit" name="submit" id="submit" value="submit" />
                        </form>

                        
                        <?php ?>
                        <?php if(!empty ($result)):?>
                            <table>
                                <thead>
                                    <th>Pin id</th>
                                    <th>Pin name</th>
                                    <th>Board id</th>
                                    <th>Board name</th>
                                    <th>Owner user</th>
                                    <th>Reported by</th>
                                    <th>Reason</th>
                                    <th>View</th>
                                    <th>Delete</th>

                                </thead>
                                <tbody>
                                    <?php foreach ($result as $key => $value):?>
                                        <tr id="tr_<?php echo $value->pin_id;?>">


                                            <?php $pinDetails = getPinDetails($value->pin_id);?>

                                            <td><?php echo $pinDetails->id;?></td>
                                            

                                            <td><?php echo $pinDetails->description;?></td>

                                            <td><?php echo $value->board_id;?></td>

                                            <?php $boardDetails = getBoardDetails($value->board_id);?>
                                            <td><?php echo $boardDetails->board_name?></td>

                                            <?php $userDetails = userDetails($pinDetails->user_id);?>
                                            <td><?php echo $userDetails['name']?></td>

                                            <?php $userDetails = userDetails($value->user_id);?>
                                            <td><?php echo $userDetails['name']?></td>

                                             <td><?php echo $value->reason;?></td>

                                              <td><a href="<?php echo site_url('board/pins/'.$value->board_id.'/'.$value->pin_id);?>"/>view</a></td>

                                            
                                            <td id="remove_<?php echo $value->pin_id;?>"><a href="<?php echo site_url('administrator/confirmDeletePin/'.$value->pin_id);?>" rel="facebox"><img src="<?php echo site_url('application/assets/images/admin/delete.png');?>"/></a></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>

                            </table>
                            <?php $current=current_url();?>
                        <?php else:?>
                            <h1>No pins reported</h1>
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
