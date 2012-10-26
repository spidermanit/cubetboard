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
            <h2>Edit Pins</h2>
            <div class="pop_content">
                <div id="pop_content">
                    <div class="right clsFloatRight" style="float: left;width: auto;">
                        <div id="edit_user">
                            <?php $result =getPinDetails($id);?>
                            <table>
                                <tr>
                                    <td><label>Description</label></td>
                                    <td><textarea rows="2" name="details" maxlength="500" id="description_pin_edit" cols="40" class="expand autocomplete_desc" style="width:316px;height: 31px;"><?php echo $result->description;?></textarea></td>
                                    <td><div id="errordetails" class="validation-message"></div></td>
                                </tr>
                                 <tr>
                                    <td><label>Link</label></td>
                                    <td><input type="text" name="link" value="<?php echo $result->source_url;?>" id="id_link" /></td>
                                    <td><div id="errorlink" class="validation-message"></div></td>
                                </tr>
                                <tr>
                                    <td><label><label for="id_board">Board</label></label></td>
                                    <td>
                                        <?php $userBoards = getUserBoard($result->user_id);?>
                                        <select name="board" id="id_board">
                                            <?php foreach ($userBoards as $boardKey => $boardValues):?>
                                                <?php $selected = ($boardValues->id==$result->board_id)?'selected':'';?>
                                                <option <?php echo $selected;?> value="<?php echo $boardValues->id;?>"><?php echo $boardValues->board_name;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </td>
                                </tr>
                                 <tr>
                                    <td><label>Gift amount</label></td>
                                    <td><input type="text" name="gift" value="<?php echo $result->gift;?>" id="gift" /></td>
                                    <td><div id="errorgift" class="validation-message"></div></td>
                                </tr>

                                <tr>
                                    <td id="process_action" style="display: none;">saving...<div id="loading"></div></td>
                                    <td><input class="Button2 Button13 WhiteButton" type="button" name="submit" value="Save pin" id="pin_submit" onClick=" return pinEdit(<?php echo $result->id;?>);"/></td>
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
function pinEdit(id)
{
    description = $('textarea#description_pin_edit').val();
    source      = $('input#id_link').val();
    board       = $("#id_board option:selected").val();
    gift        = $('input#gift').val();


    $('#errordetails').html('');
    $('#errorlink').html('');
    var failed = 0;
    if(description=="")
    {
        $('#errordetails').html('please enter a value');
       var failed = 1;
    }
    if(source=="")
    {
        $('#errorlink').html('please enter a value');
        var failed = 1;
    }
    if(gift=="")
    {
        $('#errorgift').html('please enter a value, if not a gift item please enter 0');
        var failed = 1;
    }
    if(failed==1)
    {
        return false;
    }
    val ='id='+id+'&description='+description+'&source='+source+'&board='+board+'&gift='+gift;
    $('#process_action').show();
    $('#loading').show();
    $('input#pin_submit').hide();
    $.ajax({
	        url: baseUrl+"administrator/saveEdittedPin",
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
