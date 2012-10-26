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
<div style="border-width: 10px; width: 800px; height: 900;" id="fancybox-content">
    <div style="width: auto; height: auto; overflow: auto; position: relative;">
        <div id="Repin_Pop" class="Pop_Up_Blk">
            <h2>Upload a pin</h2>
            <div class="pop_content">
                <div id="pop_content">
                    <form method="post" action="<?php echo site_url('pins/saveUploadPin');?>" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return validateUpload()">
                        <ul class="upload_pin_ul">
                            <li>
                                <label>Pin description</label>
                                <textarea name="description" id="description" style="width:255px;height:54px;float: left;"value=""></textarea>
                                 <span id="error_description" class="validation-message"></span>
                            </li>

                            <li>
                                <label>Board</label>
                                <select id="board_id" name="board_id" class="Button2 Button13 WhiteButton" style="float:left">
                                <?php  $userId  = $this->session->userdata('login_user_id');?>
                                <?php $userBoards   = getUserBoard($userId);?>
                                <?php foreach ($userBoards as $boardKey => $boardValues):?>
                                <option  value="<?php echo $boardValues->id;?>"><?php echo $boardValues->board_name;?></option>
                                <?php endforeach;?>
                                </select>
                            </li>

                            <li>
                                <label>Type</label>
                                <select name="type" id="type" class="Button2 Button13 WhiteButton" style="float:left">>
                                    <option value="image">Image</option>
                                </select>
                            </li>
                            <li>
                                <label>Pin</label>
                                <input type="file" name="pin" id="pin" value="" class="Button2 Button13 WhiteButton" style="float:left"/>
                                <span id="error_pin" class="validation-message"></span>
                            </li>
                            <li id="save_btn">
                               <input type="submit" name="button" id="submit" value="save" class="Button2 Button13 WhiteButton" style="float:left"/>
                            </li>
                        </ul>
                      </form>
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
function validateUpload()
{
    description = $('textarea#description').val();
    pin         = $('input#pin').val();

    $('#error_description').html('');
    $('#error_pin').html('');

    failed = 0 ;

    if(description=="")
    {
        $('#error_description').html('please provide a value');
        failed = 1;
    }
    if(pin=="")
    {
        $('#error_pin').html('please upload a pin');
        failed = 1;
    }
    else{
        image = pin.toString().split(".");
        if((image[1]!='png')&&(image[1]!='jpg')&&(image[1]!='gif')&&(image[1]!='jpeg')&&(image[1]!='PNG')&&(image[1]!='GIF')&&(image[1]!='JPEG')&&(image[1]!='JPG'))
        {
            $('#error_pin').html('Invalid image');
             failed = 1;
        }
    }

    if(failed==1)
    {
        return false;
    }
    else{
        return true;
    }
    /*
    val ='description='+description+'&user='+user+'&source='+source+'&pin='+pin+'&board='+board;
    $.ajax({
	        url: baseUrl+"administrator/saveUploadPin",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
               if(data==true)
               {
                  $('#upload_message').html('');
                  $('#upload_message').html('Pin uploaded successfully!');
               }

               else
               {
                  $('#upload_message').html('');
                  $('#upload_message').html('Sorry some thing went wrong please try again');
               }

            }
        })
        */
}
</script>
