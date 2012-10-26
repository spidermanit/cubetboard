<link href="<?php echo base_url(); ?>application/assets/css/style.css" rel="stylesheet" type="text/css" />
<div id="fancybox-outer">
<div class="fancybox-bg" id="fancybox-bg-n"></div>
<div class="fancybox-bg" id="fancybox-bg-ne"></div>
<div class="fancybox-bg" id="fancybox-bg-e"></div>
<div class="fancybox-bg" id="fancybox-bg-se"></div>
<div class="fancybox-bg" id="fancybox-bg-s"></div>
<div class="fancybox-bg" id="fancybox-bg-sw"></div>
<div class="fancybox-bg" id="fancybox-bg-w"></div>
<div class="fancybox-bg" id="fancybox-bg-nw"></div>
<div style="border-width: 10px; width: 580px; height: auto;" id="fancybox-content">
    <div style="width: auto; height: auto; overflow: auto; position: relative;">
        <div id="Repin_Pop" class="Pop_Up_Blk">
            <h2 id="h2_heading">Email this pin </h2>
            <div class="pop_content">
                <div id="pop_content">
                    <div class="right clsFloatRight" style="float: left;padding: 20px;width: 300px;">
                        <form  method="post" class="Form FancyForm" id="emailForm">
                            <ul>
                                <li>
                                    <label></label>
                                    <input type="text" id="name" name="name" maxlength="180" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value="Recipient Name" style="color: #D7D7D7;"/>
                                    <span class="fff"></span>
                                    <span class="helper red"></span>
                                </li>
                                <li>
                                    <label></label>
                                    <input type="text" id="email" name="email" maxlength="180" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value="Email" style="color: #D7D7D7;"/>
                                    <span class="fff"></span>
                                    <span class="helper red"></span>
                                </li>
                                <li class="optional">
                                    <label></label>
                                    <textarea id="MessageBody"  name="MessageBody" maxlength="180" style="height:100px;color:#D7D7D7;" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">Message</textarea>
                                    <span class="fff"></span>
                                </li>
                                <input type="hidden" id="pinLink"  name="pinLink" value="<?php echo site_url('board/pins/'.$boardId.'/'.$pinId);?>" />
                            </ul>
                            <div style='display:none'><input type='hidden' name='csrfmiddlewaretoken' value='87ab12bfdf1ccaaea1080f7789cd8ff4' /></div>
                            <div><a href="#" class="Button2 Button13 WhiteButton" data-form="EmailModal" onClick="emailFn()"><strong>Send Email</strong><span></span></a></div>
                            <div id="error"></div>
                        </form>
                    </div>
                    <div class="clear"></div>
                </div>
                <div style="display: none;" id="email_msg">
                    <h2>Email successfully send</h2>
                </div>
            </div>
            <div id="success" style="display: none"></div>
        </div>
    </div>
</div>
<a style="display: inline;" id="fancybox-close" onclick="close()"></a>
<div style="display: none;" id="fancybox-title"></div>
<a style="display: none;" href="javascript:;" id="fancybox-left">
<span class="fancy-ico" id="fancybox-left-ico"></span>
</a>
<a style="display: none;" href="javascript:;" id="fancybox-right">
<span class="fancy-ico" id="fancybox-right-ico"></span>
</a>
</div>
<script type="text/javascript">
function emailFn()
{
  name = $('#name').val();
  email = $('#email').val();
  if((name=='')||(email=='')||(email=='Email'))
  {
    $('#error').html('please provide the details');
    return false;
  }
  dataString = $("#emailForm").serialize();
  $.ajax({
            url: "<?php echo site_url('board/email');?>",
            type: "POST",
            data: dataString,
            dataType: 'json',
            cache: false,
            success: function (data) {
            $('#pop_content').hide('slow');
            $('#email_msg').show('slow');
            $('#h2_heading').hide('slow');
        }
        });
}
</script>