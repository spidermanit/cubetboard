<title><?php echo $title;?></title>
<link href="<?php echo base_url(); ?>application/assets/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
function extractPin(id)
{   
    $.ajax({
            url: "<?php echo site_url('extractor/save');?>",
            type: "POST",
            data: id,
            dataType: 'json',
            cache: false,
            success: function (data) {
        }
        });
}
</script>
<script type="text/javascript">
function addGift()
{   gifted = true
    if(gifted)
        slow="slow";
    else
        slow=null;
    if($('textarea#description').val()==null)
    {
        $(".PriceContainer").hide();
    }
    else{
        if($('textarea#description').val()=='')
        {
              $(".PriceContainer").hide();
        }
        else{
                str = $('textarea#description').val();
                dollor = str.lastIndexOf("$");
                pound   = str.lastIndexOf("\u00A3");
                if(dollor>pound)
                {
                    symbol = "$";

                }
                else{
                    symbol = "\u00A3";
                }
                if(str.lastIndexOf(symbol) != -1)
                {
                    var myString = str.substr(str.lastIndexOf(symbol) + 1)
                    if(myString!='')
                    {
                       splitString =  myString.split(" ");
                       if(splitString[0])
                       {
                          if(!isNaN(splitString[0])){
                               $(".PriceContainer").show(slow);
                               $('.PriceContainer').html(symbol+ ' '+splitString[0]);
                               $('input#gift').val(splitString[0]);
                           }
                           else{
                                $(".PriceContainer").hide(slow);
                            }
                       }
                       else{
                            $(".PriceContainer").hide(slow);
                        }

                    }
                    else{
                        $(".PriceContainer").hide(slow);
                    }
                }
                else{
                        $(".PriceContainer").hide(slow);
                    }
        }
    }

}
</script>
<!--FOR DISPLAY ALL IMAGES AVAILABLE FOR PINNING -->
<?php
if(!empty($result))
{
 foreach($result as $key=>$value) {
    $id             = 'pin_url='.$value['pin_url'].'&source_url='.$value['source_url'];
    $encode_pin     = base64_encode($value['pin_url']);
    $encode_source  = base64_encode($value['source_url']);
    $img_src        = $value['pin_url'];
    $link           = site_url('extractor/getSaveImage/'.$encode_pin.'/'.$encode_source);
    echo "<a id='$id' href='$link'><img style='border:5px solid white' src ='$img_src' width='100px' height='100px'/></a>";
}
}
?>
<?php if(isset($no_result)):?>
    <h2 style="padding-top:100px;padding-left:250px;" >Sorry no pinable image found!!</h2>
<?php endif?>

<!--TO DISPLAY THE SELECTED PIN IMAGE PREVIEW AND BOARD SELECTION OPTION FOR SAVING THE PIN -->
<?php if(isset($url)):?>
    <h2 style="top:21px;left:25px;">Pin it</h2>
    <form method="post" action="<?php echo site_url('extractor/submit')?>" >
        <div id="PinEditPreview" class="pin" style="float:left;width:582px;height:200px;top:-90px;">
            <div id="PinEditPreview_left2"  style="float:left;">
                <strong class="PriceContainer" id="priceDiv" style="top:121px;"></strong>
                <img  style="border:5px solid white;width:155px;height:131px;border:1px solid #D2D2D2;" src="<?php echo $url?>"/>
            </div>
            <div id="PinEditPreview_left2"  style="float:right;margin-right:106px;margin-top: 33px;">
                <input type="hidden" name="gift" value="0" id="gift"/>
                <input type="hidden" name="pin_url" id="pin_url" value="<?php echo $url?>" >
                <input type="hidden" name="source_url" id="source_url" value="<?php echo $source?>" >
                <input type="hidden" name="is_video" id="is_video" value="<?php echo $is_video?>" >
                <span id="extra_text" style="float:left;">
                    <textarea id="description" name="description" onkeyup="addGift()" style="width:284px;height: 95px;margin-bottom: 10px;"><?php echo $title?></textarea>
                </span>
                <br clear="all">
                <span class="extra_select" style="float: left;">
                    <select id="board_id" name="board_id">
                    <?php echo $userId  = $this->session->userdata('login_user_id');?>
                    <?php $userBoards   = getUserBoard($userId);?>
                    <?php foreach ($userBoards as $boardKey => $boardValues):?>
                    <option  value="<?php echo $boardValues->id;?>"><?php echo $boardValues->board_name;?></option>
                    <?php endforeach;?>
                    </select>
                    <input type="submit" name="submit" value="submit" class="Button2 Button13 WhiteButton">
                </span>
            </div>
         </div>   
</form>
<?php endif?>


<!--TO DISPLAY THE SUCCESS MESSAGE -->
<?php if(isset($insertId)):?>
<h2 style="padding-top:100px;padding-left:115px" >Pinned successfully!!</h2>
<?php
$sitelink= site_url('board/pins/'.$board_id.'/'.$insertId);
$url = rawurlencode("{$sitelink}&via=cubet board&text={$description}");
//echo "<a href='http://twitter.com/share?url=$url' class='twitter-share-button'>Tweet</a>";
?>
<div style="padding-left:150px">
<a href="http://twitter.com/share" class="twitter-share-button" data-count="none" data-url="<?php echo $sitelink;?>" data-text="<?php echo $description;?>" data-via="pininterest clone" data-size="large">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<a style="border:none;" title="Share this article/post/whatever on Facebook" href="http://www.facebook.com/sharer.php?s=100&p[url]=<?php echo $sitelink;?>&p[images][0]=<?php echo $pin_url;?>&p[title]=<?php echo $description;?>&p[summary]=<?php echo "share from my cubetboard application";?>"target="_blank"><img src="<?php echo site_url('application/assets/images/facebook_button.png')?>" width='75px' height='27px'</a>
</div>
<?php endif?>

<?php if(isset($message)):?>
<h2 style="padding-top:100px;padding-left:150px"><?php echo $message;?></h2>
<?php endif?>
