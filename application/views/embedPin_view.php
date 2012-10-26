
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
            <h2>Embed Pin on Your Blog</h2>
            <div class="pop_content">
                <div class="Pop_Up_Blk" id="Embed">
                    <div class="static_form">
                        <div class="pop_content">
                            <ul>
                                <li><input type="text" id="height" value="200" maxlength="3" name="height"  onblur="changeAtts(this.value,'height')"><span> px - Image Height</span></li>
                                <li><input type="text" id="width" value="297" maxlength="3" name="width" onblur="changeAtts(this.value,'width')"><span> px - Image Width</span></li>
                                <li><textarea id="embed_script">&lt;div style="padding-bottom: 2px; line-height: 0px"&gt;&lt;a href="<?php echo $pin_link;?>" target="_blank"&gt;&lt;img src="<?php echo $pin_url;?>" border="0" width="200" height ="400"/&gt;&lt;/a&gt;&lt;/div&gt;&lt;div style="float: left; padding-top: 0px; padding-bottom: 0px;"&gt;&lt;p style="font-size: 10px; color: #76838b;"&gt;Source: <?php echo $source_name;?>&lt;a style="text-decoration: underline; font-size: 10px; color: #76838b;" href=""&gt;&lt;/a&gt; via &lt;a style="text-decoration: underline; font-size: 10px; color: #76838b;" href="<?php echo $user_link;?>" target="_blank"&gt;<?php echo $user;?>&lt;/a&gt; on &lt;a style="text-decoration: underline; color: #76838b;" href="<?php echo $site_link;?>" target="_blank"&gt;Visit site&lt;/a&gt;&lt;/p&gt;&lt;/div&gt;</textarea></li>
                           </ul>
                         </div>
                    </div>
                </div>
                <div style="display: none;" id="email_msg">
                    <h2>Email successfully</h2>
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
function changeAtts(value,type)
{   
    var width  = $('input#width').val();
    var height = $('input#height').val();

    pinLink     = '<?php echo $pin_link;?>';
   
    pin_url     = '<?php echo $pin_url;?>';
    siteLink    = '<?php echo $site_link;?>';

    user        = '<?php echo $user;?>';
    user_link   = '<?php echo $user_link;?>';
    source_name = '<?php echo $source_name;?>';
    source_url =  '<?php echo $source_url;?>';

    $("#embed_script").html("&lt;div style='padding-bottom: 2px; line-height: 0px'&gt;&lt;a href='"+pinLink+"' target='_blank'&gt;&lt;img src='"+pin_url+"' border='0' width='"+width+"' height ='"+height+"'/&gt;&lt;/a&gt;&lt;/div&gt;&lt;div style='float: left; padding-top: 0px; padding-bottom: 0px;'&gt;&lt;p style='font-size: 10px; color: #76838b;'&gt;Source: "+source_name+ " &lt;a style='text-decoration: underline; font-size: 10px; color: #76838b;' href=''&gt;&lt;/a&gt; via &lt;a style='text-decoration: underline; font-size: 10px; color: #76838b;' href='"+user_link+"' target='_blank'&gt;"+user+"&lt;/a&gt; on &lt;a style='text-decoration: underline; color: #76838b;' href='"+siteLink+"' target='_blank'&gt;visit site&lt;/a&gt;&lt;/p&gt;&lt;/div&gt;");

}
</script>


