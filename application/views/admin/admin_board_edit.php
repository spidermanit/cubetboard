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
            <h2>Edit Board</h2>
            <div class="pop_content">
                <div id="pop_content">
                    <div class="right clsFloatRight" style="float: left;width: auto;">
                        <div id="edit_user">
                            <?php $result =getBoardDetails($id);?>
                            <table>
                                <tr>
                                    <td><label>Name</label></td>
                                    <td><input type="text" name="board_name" value="<?php echo $result->board_name;?>" id="board_name" /></td>
                                    <td><div id="error_name" class="validation-message"></div></td>
                                </tr>
                                <tr>
                                    <td><label>Description</label></td>
                                    <td><textarea rows="2" name="description" maxlength="500" id="description" cols="40" class="expand autocomplete_desc" style="width:316px;height: 31px;"><?php echo $result->description;?></textarea></td>
                                    <td><div id="error_description" class="validation-message"></div></td>
                                </tr>
                                <tr>
                                    <td><label><label for="category">Category</label></label></td>
                                    <td>
                                        <?php $category = getcategoryList();?>
                                        <select name="category" id="category">
                                            <?php foreach ($category as $categoryKey => $categoryValues):?>
                                                <?php $selected = ($categoryValues->field==$result->category)?'selected':'';?>
                                                <option <?php echo $selected;?> value="<?php echo $categoryValues->field;?>"><?php echo $categoryValues->name;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="deleting" style="display: none;">saving...<div id="loading"></div></td>
                                    <td><input type="button" class="Button2 Button13 WhiteButton" name="submit" value="Save pin" id="edit_submit" onClick=" return categoryEdit(<?php echo $result->id;?>);"/></td>
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
function categoryEdit(id)
{
    description = $('textarea#description').val();
    name      = $('input#board_name').val();
    category       = $("#category option:selected").val();



    //$('#error_description').html('');
    $('#error_name').html('');
    var failed = 0;
    
    if(name=="")
    {
        $('#error_name').html('please enter a value');
        var failed = 1;
    }
    if(failed==1)
    {
        return false;
    }
    val ='id='+id+'&description='+description+'&board_name='+name+'&category='+category;
    $('#deleting').show();
    $('#loading').show();
    $('input#edit_submit').hide();
    $.ajax({
	        url: baseUrl+"administrator/saveEdittedBoard",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
               if(data)
               {
                $.facebox.close();
                window.location.reload()
               }

               else
                  $('#message').html('');
                  //$('#message').html('Sorry something went wrong ');
            }
    })
}
</script>
