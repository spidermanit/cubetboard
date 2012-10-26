<?php $this->load->view('popup_js');?>
<script type="text/javascript">
function proceed(type)
{
    if(type=='yes')
    {
           boardId  = '<?php echo $boardId ?>';
           pinId    = '<?php echo $pinId ?>';
           $('#loading_gif').show();
           $('input#delete_yes').hide();
           $('input#delete_no').hide();
           dataString = 'boardId='+boardId+'&pinId='+pinId;
           $.ajax({
                    url: "<?php echo site_url('pins/deletePin');?>",
                    type: "POST",
                    data: dataString,
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                        window.location.replace(baseUrl+"board/index/"+boardId);
                    }
           });
    }
    else{
        $.colorbox.close();
    }
}
</script>

<div id="fancybox-outer">
<div class="fancybox-bg" id="fancybox-bg-n"></div>
<div class="fancybox-bg" id="fancybox-bg-ne"></div>
<div class="fancybox-bg" id="fancybox-bg-e"></div>
<div class="fancybox-bg" id="fancybox-bg-se"></div>
<div class="fancybox-bg" id="fancybox-bg-s"></div>
<div class="fancybox-bg" id="fancybox-bg-sw"></div>
<div class="fancybox-bg" id="fancybox-bg-w"></div>
<div class="fancybox-bg" id="fancybox-bg-nw"></div>
<div style="border-width: 10px; width: 580px; height: 200px;" id="fancybox-content">
    <div style="width: auto; height: auto; overflow: auto; position: relative;">
        <div id="Repin_Pop" class="Pop_Up_Blk">
            <h2>Delete Pins</h2>
            <div class="pop_content">
                <div id="pop_content">
                    <div class="right clsFloatRight" style="float: left;width: auto;padding-top: 19px;">
                        <p>Are you sure to delete this pin !. This action cannot be undo and all data associated with this pin will get deleted!.Do you want to proceed</p>
                        <br clear="all">
                        <input id="delete_yes" class="popup_btn" type="button" class="Button2 Button13 WhiteButton" name="yes" value="yes" onclick="proceed('yes')"/>
                        <input id="delete_no" class="popup_btn" type="button" class="Button2 Button13 WhiteButton" name="no" value="no" onclick="proceed('no')"/>
                        <div id="loading_gif" style="display: none">Deleting..<img src="<?php echo site_url('application/assets/images/loading.gif');?>"/></div>
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
