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
<div style="border-width: 10px; width: 650px; height: 300px;" id="fancybox-content">
    <div style="width: auto; height: auto; overflow: auto; position: relative;">
        <div id="Repin_Pop" class="Pop_Up_Blk">
            <h2>Create Board</h2>
            <div class="pop_content">
                <div id="pop_content">
                    <div class="right clsFloatRight" style="float:left;margin-left: 50px;">
                        <form action="<?php echo site_url('board/create');?>/" method="post" id="create_board" >
                            <ul class="create_board_ul">
                                <li><label>Board Name</label></li>
                                <li><input id="BoardName" type="text" name="name" value=""/></li>
                                <li><label>Board Category</label></li>
                                <li>
                                    <select id="id_category" name="category">
                                        <?php $result = getCategoryList();?>
                                        <?php foreach($result as $key=>$value):?>
                                        <option  value="<?php echo $value->field;?>"><?php echo $value->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </li>
                                <li>
                                    <input type="submit" name="submit" value="Create" class="Button2 Button13 WhiteButton" onclick="return createBoard()"/>
                                </li>
                                <li><span id="name_error" class="validation-message"></span></li>
                            </ul>
                            <br clear="all">
                            <!--<div class="Submit"><a href="#" class="Button RedButton Button18"><strong>Create Board</strong><span></span></a></div>-->
                            
                            <div class="CreateBoardStatus error"></div>
                        </form>
                    </div>
                    <div class="clear"></div>
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
function boardAction(type)
{   if(type=='create')
    $('#newboard').show('slow');
if(type=='cancel')
    $('#newboard').hide('slow');
if(type=='save')
{
    var boardName=$('#new_board').val();
    if(boardName=='')
    {
        $('#errorBoardName').html('Please enter a board name');
        return false
    }
    else{
        $('#board_id').append('<option value="foo" selected="selected">'+boardName+'</option>');
    }
}
}
function submit()
{
 newBoard = $("#board_id option:selected").text();
}
function test()
{
    window.close();
}

</script>