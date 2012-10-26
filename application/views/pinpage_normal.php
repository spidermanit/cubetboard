<?php $this->load->view('header')?>
<link href="<?php echo base_url(); ?>application/assets/css/popup.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    function addPinComment()
    {
        var comment   = $("textarea#CloseupComment").val();
        dataString = 'id='+<?php echo $pinId?>+'&comment='+comment;
        $.ajax({
                url: "<?php echo site_url('board/addComment/induvidual');?>",
                type: "POST",
                data: dataString,
                dataType: 'json',
                cache: false,
                success: function (data) {
                $('.PinComments').append(data);

            }
            });
    }
    </script>
    <script type="text/javascript">
    function clearComment(value)
    {
          $("textarea#"+value).val('');
    }
    </script>
    <script type="text/javascript">
    function deleteComment(value)
    {
          //var substr = value.split('_');
          //alert(value)
          dataString = 'id='+value;
          $.ajax({
                url: "<?php echo site_url('board/deleteComment');?>",
                type: "POST",
                data: dataString,
                dataType: 'json',
                cache: false,
                success: function (data) {
                  $('#comment_id_'+value).remove();
                //currentComment =  $('.CommentsCount_'+val).html();
                //var substr = currentComment.split(' ');
                //count = parseFloat(substr[0]) + parseFloat(1);
                //$('.CommentsCount_'+val).html(count + ' ' +substr[1]);
                //alert(substr[0]);
            }
            });

    }
    </script>



<script type="text/javascript">
    $(document).ready(function(){
                $("a.act_uncomment").hide();
                $(".enter_comm").hide();

    });

	function comment(pinid)
	{
        var $alpha = $('#alpha');
        var $alpha = $('#Container'+'#alpha');
		$alpha.masonry({
		itemSelector: '.pin_item',
		isFitWidth: true,
		isAnimatedFromBottom: true
		});
        //$('#comment_'+pinid).hide();
        var getComment=$('#comment_'+pinid).val();
        $('#'+pinid).hide();
        $('a#uncomment-'+pinid).hide();
        $('a#comment-'+pinid).show();

        val = 'id='+pinid+'&comment='+getComment;
        $.ajax({
	        url: baseUrl+"board/addComment",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
                //alert(data)
                var commentinfo=new Array();
                $('#comment_'+pinid).val('');
                //commentinfo=data.split("_");
                commentinfo[0] = logName;
                commentinfo[1] =getComment;
                if(commentinfo[1]!=0)
                {
                    //comment count
                    $("#comment_count_"+pinid).empty();
                    $("#comment_count_"+pinid).html(data[0]+" Comment");

                    $("#count_comment_"+pinid).empty();
                    $("#count_comment_"+pinid).html("<a href=http://products.cogzidel.com/pinterest-clone/con_home/viewpin/"+pinid+">All "+commentinfo[4]+" Comments...</a>");
                    //$("#comments_box_"+pinid+':last-child').append("<div class='convo_blk comments width_class'><a class='convo_img' href='#'><img src="+logImage+" height='50' width='50'/></a><a href="+baseUrl+"'user/index/'"+logId+"><strong>"+commentinfo[0]+" </strong></a>"+commentinfo[1]+"</div> ");
                    $("div[id=comments_box_"+pinid+"]:last").append("<div class='convo_blk comments width_class' id='comment_id_"+data[1]+"'><a class='convo_img' href='#'><img src="+logImage+" height='50' width='50'/></a><a href="+baseUrl+"'user/index/'"+logId+"><strong>"+commentinfo[0]+" </strong></a>"+commentinfo[1]+"<a style='cursor: pointer;float:right;margin-right:5px;'  onclick='deleteComment("+data[1]+")' title='Remove Comment' class='DeleteComment floatRight tipsyHover'>X</a></div> ");
            }
            }
        })

	}
	 function showbutton(board_id)
	 {

	   $comment = $('#comment_'+board_id).val();
	   if($comment!="" && $('#comment_'+board_id).val().length >=1)
	   {
	   $('#comment_button_'+board_id).show();
	   }
	   else
	   {
	     $('#comment_button_'+board_id).hide();
	   }

	}
	function addComment(board_id,type)
	{
		if(type=="comment")
		{
			//$("textarea.coment_"+board_id).textlimit(20);
			$('#'+board_id).html("<a href='#' class='convo_img'><img src="+logImage+" alt='image' /></a><textarea name='comment_"+board_id+"' id='comment_"+board_id+"' onkeyup='showbutton("+board_id+")'  cols=20 rows=1 style='width:516px;'></textarea><p class='txt_right_align'><button class='button4' type='button' name='comment_button' id='comment_button_"+board_id+"' onclick='comment("+board_id+")'><span class='counter'><span>Comment</span></span></button> </p>");
	        $('#comment_button_'+board_id).hide();
			$('a#comment-'+board_id).hide();
			$('a#uncomment-'+board_id).show();
			$('#'+board_id).show();
	   }
		else
		{
		 	$(".enter_comm").hide();
			$('#'+board_id).empty();
			$('a#comment-'+board_id).show();
			$('a#uncomment-'+board_id).hide();

		}
		$('#comment_'+board_id).focus();
		var $alpha = $('#alpha');
		$alpha.imagesLoaded( function(){
		$alpha.masonry({
		itemSelector: '.pin_item',
		isFitWidth: true,
		isAnimatedFromBottom: true

		//isAnimated: true
		});
		});
	 	}


	function doAction(userid,pinid,type)
	{   val = 'pin_id='+pinid+'&source_user_id='+userid+'&like_user_id='+logId;
        if(type=="like")
		{
		 $.ajax({
	        url: baseUrl+"pins/saveLikes",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(datas){
			//var status=parseInt(data);
            var status=parseInt(datas)
            $('#like1-'+pinid).html(status+' Likes');
			if(status)
			{
                $('a#unlike-'+pinid).show();
				$('a#like-'+pinid).hide();
				$('#showUnLike'+pinid).show();
                $('#showLike'+pinid).hide();
                $('#like_action'+pinid).hide();
			}
			else
			{
				$('a#unlike-'+pinid).hide();
				$('a#like-'+pinid).show();
                $('#showUnLike'+pinid).hide();
                $('#showLike'+pinid).show();
                $('#like_action'+pinid).hide();

			}
		}	    })
	}
		if(type=="unlike")
		{
		$.ajax({
	        url: baseUrl+"pins/unLike",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){

			$('#like1-'+pinid).html(data+' Likes');
			if(data)
			{
				$('a#unlike-'+pinid).hide();
				$('a#like-'+pinid).show();
                 $('#showUnLike'+pinid).hide();
                $('#showLike'+pinid).show();
                $('#like_action'+pinid).hide();
			}
			else
			{
				$('a#unlike-'+pinid).show();
				$('a#like-'+pinid).hide();
                $('#showUnLike'+pinid).show();
                $('#showLike'+pinid).hide();
                $('#like_action'+pinid).hide();
			}
		}
		})
        }
    }

</script>
<?php $pinDetails = getPinDetails($pinId, $boardId) ?>
<?php $userDetails = userDetails($pinDetails->user_id);?>
<?php $data['userDetails'] = $userDetails;?>
<?php $data['id']       = $userDetails['userId'];?>
<?php $source = GetDomain($pinDetails->source_url);?>
<?php if($pinDetails->source_url!=""):?>
    <?php $source = $sourceName = GetDomain($pinDetails->source_url);?>
<?php else:?>
    <?php
        $sourceName = 'User uploaded pin';
        $source =false;
    ?>
<?php endif;?>
<?php $sourcePins = getPinsBySource($source,$random=true);?>
 <?php $encode_source =  base64_encode($source);?>
<?php $this->load->view('popup_js')?>
<div class="clear"></div>

<div class="middle-banner_bg"><!-- staing middlebanner -->
    <div id="Wout_log_popup" style="margin-top:5px">
        <div class="left">
            <div class="right">
                <div class="mid">
                    <div id="info"><label>Pin board</label></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container"><!-- staing container -->
        <div class="insi-middle-wrap">
            <div class="pin-left-wrap">
                <div class="inside-pinBoard">
                    <div class="pin_inner_container">
                        <?php  $boardDetails = getBoardDetails($boardId);?>
                        <div class="name-container">
                            <p class="name"><?php echo $boardDetails->board_name;?></p>
                            <span class="pin_no">
                                <p>
                                    <?php
                                    $content = getEachBoardPins($boardId,$limit=4);
                                    if(!empty($content)){
                                       //get pins in array
                                       //$content = explode(',', $value->content);
                                       echo count($content).' pins';
                                    }
                                    else{
                                        $content =array();
                                        echo '0 pins';
                                    }
                                  ?>
                                </p>
                            </span>
                        </div>
                        <?php $i=1; $k=0; $count= count($content);?>

                        <a href="<?php echo site_url() ?>board/index/<?php echo $boardId;?>" class="link">
                                <?php
                                  $i=1;
                                  $k=0;
                                  $count= count($content);
                                ?>
                                <!-- manipulate pin array to display the pins -->
                                <?php if(!empty ($content)):?>
                                    <?php foreach ($content as $key=>$pinValue):?>
                                        <!--set first image as cover image-->
                                        <?php if($i==1):?>
                                        <div class="cover">
                                             <a href="<?php echo site_url() ?>board/index/<?php echo $boardId;?>" class="link">
                                             <?php if($pinValue->type=='video'):?>
                                                <div class="video"></div>
                                            <?php endif;?>
                                            <img src="<?php echo $pinValue->pin_url;?>" style="width: 199px;height: 130px;"/>
                                             </a>
                                        </div>
                                        <?php $count--;?>



                                          <!-- if only one image available then set the rest of thumb images as null-->
                                          <?php if($count==0):?>
                                            <?php for($h=1;$h<=(3);$h++):?>
                                                <ul class="cover-thumbs">
                                                    <li><span class="cover-thumbs-pic_none"></span></li>
                                                </ul>
                                            <?php endfor?>
                                          <?php endif?>

                                        <!-- if morethan one image,arrange it in thumb nails-->
                                        <?php else:?>
                                            <!--arrange the rest of available images as thumb -->
                                            <ul class="cover-thumbs">
                                                <?php if($pinValue->type=='video'):?>
                                                    <div class="video_small"></div>
                                                <?php endif?>
                                                    <li><span class="cover-thumbs-pic"><img src="<?php echo $pinValue->pin_url;?>" alt="Photo of a pin" width="64" height="74"/></span></li>
                                                <?php $k++;
                                                      $count--;
                                                ?>
                                            </ul>



                                                <!--fill the rest of the thumb nail space with null, if no more images to display  -->
                                                <?php if($count==0):?>
                                                    <?php for($j=1;$j<=(3-$k);$j++):?>
                                                        <ul class="cover-thumbs">
                                                             <li><span class="cover-thumbs-pic_none"></span></li>
                                                        </ul>
                                                    <?php endfor?>
                                                <?php endif?>

                                        <?php endif?>
                                        <?php $i++;?>
                                    <?php endforeach;?>

                                 <!--Fill the board with empty cells if no pins to display -->
                                 <?php else:?>
                                      <div class="cover_none"></div>
                                      <ul class="cover-thumbs">
                                        <li><span class="cover-thumbs-pic_none"></span></li>
                                        <li><span class="cover-thumbs-pic_none"></span></li>
                                        <li><span class="cover-thumbs-pic_none"></span></li>
                                    </ul>
                                 <?php endif?>


                            </a>
                        <div class="clear"></div>
                        <div class="edit_button">
                            <?php if($this->session->userdata('login_user_id')==$pinDetails->user_id):?>
                                    <a href="<?php echo site_url('board/edit/'.$pinDetails->board_id)?>">Edit</a>
                             <?php else:?>
                                <?php $id_ref =$pinDetails->board_id;?>
                                    <div id="follow_unfollow_<?php echo $id_ref;?>">
                                    <?php if(!isFollow($this->session->userdata('login_user_id'),$pinDetails->board_id)):?>
                                        <a id="follow_btn_<?php echo $id_ref;?>" onclick="follow_unfollow('follow',<?php echo $id_ref;?>,<?php echo $pinDetails->user_id;?>);" class="Button13 Button RedButton followuserbutton" style="cursor: pointer;"><strong >Follow</strong><span></span></a>
                                    <?php else:?>
                                        <a id="unfollow_btn_<?php echo $id_ref;?>" onclick="follow_unfollow('unfollow',<?php echo $id_ref;?>,<?php echo $pinDetails->user_id;?>);" class="Button13 Button RedButton followuserbutton" style="cursor: pointer;"><strong>Unfollow</strong><span></span></a>
                                    <?php endif?>
                                    </div>

                                    <span id="ajax_follow_btn_<?php echo $id_ref;?>" style="display: none;cursor: pointer;"><a onclick="follow_unfollow('follow',<?php echo $id_ref;?>,<?php echo $pinDetails->user_id;?>);" class="Button13 Button RedButton followuserbutton"><strong>Follow</strong><span></span></a></span>
                                    <span id="ajax_unfollow_btn_<?php echo $id_ref;?>" style="display: none;cursor: pointer;"><a onclick="follow_unfollow('unfollow',<?php echo $id_ref;?>,<?php echo $pinDetails->user_id;?>);" class="Button13 Button RedButton followuserbutton"><strong>Unfollow</strong><span></span></a></span>
                             <?php endif;?>
                        </div>
                    </div>
                </div>

                <div class="inside-pinsours-board">
                    <div class="inside-pinsours_container">
                       
                            <?php $source = GetDomain($pinDetails->source_url);?>
                            <div class="inside-pinname-container">
                                 <?php if($pinDetails->source_url!=""):?>
                                    <a ><h3>Also from <a href="<?php echo $pinDetails->source_url;?>" class="colorless"><?php echo $sourceName;?></a></h3></a>
                                 <?php else:?>
                                    <a ><h3><a  class="colorless">Other uploaded pins</a></h3></a>
                                <?php endif;?>
                            </div>
                            <!-- Get pins from pin tables with same source.random parameter is used for feteching random pins and for display all pins of same source the random parameter is not used.-->
                           

                            <a href="<?php echo site_url('pins/source/'.$encode_source) ?>" class="link">
                                <?php foreach ($sourcePins as $sourceKey => $sourcePin) :?>
                                    <ul class="cover-thumbs">
                                        <?php if($sourcePin->type=='video'):?>
                                            <div class="video_small"></div>
                                         <?php endif?>
                                        <li><span class="cover-thumbs-pic"><img src="<?php echo $sourcePin->pin_url;?>" width="50px" height="50px"/></span></li>
                                    </ul>
                                <?php endforeach;?>
                            </a>
                       
                    </div>

                </div>
            </div>

            <div class="pin-right-wrap">
                <div class="pin-prof-box">
                    <div class="pin-prof-picbox">
                        <div class="pin-prof-img"><a href="<?php echo site_url('user/index/'.$pinDetails->user_id);?>"><img src="<?php echo $userDetails['image']?>" width="50" height="50" /></a></div>
                    </div>
                    <div class="pin-prof-name-box">
                        <div class="pin-name-insi">
                            <p><?php echo $pinDetails->description;?></p>
                        </div>
                        <p>Pinned on <?php echo $pinDetails->time;?></p>
                        <script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId='<?php echo $this->config->item('facebook_app_id')?>'";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));
                        </script>

                        <ul class="pinboard-share-bottons">
                            <li><a title="Share this article/post/whatever on Facebook" href="http://www.facebook.com/sharer.php?s=100&p[url]=<?php echo current_url();?>&p[images][0]=<?php echo $pinDetails->pin_url;?>&p[title]=<?php echo $pinDetails->description;?>&p[summary]=<?php echo "share from my cubetboard application";?>"target="_blank"><img src="<?php echo site_url('application/assets/images/facebook_button.png')?>" width='75px' height='30px'</a></li>
                            <li><a href="http://twitter.com/share" class="twitter-share-button" data-count="none" data-size="large" data-via="Cubet board" data-text="<?php echo $pinDetails->description; ?>">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></li>
                            <li><a href="<?php echo site_url('action/email/'.$boardId.'/'.$pinId)?>"  id="EmailShare" class="Button2 Button13 WhiteButton ajax"><strong>@ Email</strong><span></span></a></li>
                            <li><a href="<?php echo site_url('action/report/'.$boardId.'/'.$pinId)?>" id="PinReport" class="Button2 Button13 WhiteButton ajax"><strong>&#9872; Report Pin</strong><span></span></a></li>
                            <li><a href="<?php echo site_url('action/embed/'.$boardId.'/'.$pinId)?>"  id="PinEmbed" class="Button2 Button13 WhiteButton ajax"><strong>&lt;&gt; Embed</strong><span></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="PinActionButtons-box">
                    <div class="PinActionButtons-left">
                        <ul>
                            <li class="repin-button">
                                <a  href="<?php echo site_url('repin/load/'.$pinDetails->id)?>"  class="Button2 Button13 WhiteButton ajax">
                                    <strong><em></em>Repin</strong>
                                </a>
                            </li>

                            <?php if($this->session->userdata('login_user_id')==$pinDetails->user_id):?>
                                <li class="edit-button">
                                    <a href="<?php echo site_url('board/pinEdit/'.$boardId.'/'.$pinId);?>" class="Button2 Button13 WhiteButton">
                                        <strong>Edit</strong><span></span>
                                    </a>
                                </li>
                             <?php else:?>
                                <?php if(!isLiked($pinId,$this->session->userdata('login_user_id'))):?>
                                    <li class="like-button">
                                    <?php $likeid ='pin_id='.$pinId.'&source_user_id='.$pinDetails->user_id.'&like_user_id='.$this->session->userdata('login_user_id') ?>
                                    <a href="#" id="<?php echo $likeid;?>" class="Button2 Button13 WhiteButton" onClick="pinLike(id)" >
                                            <strong>Like</strong><span></span>
                                    </a>
                                    </li>
                                <?php else:?>
                                    <li class="unlike-button">
                                    <?php $likeid ='pin_id='.$pinId.'&source_user_id='.$pinDetails->user_id.'&like_user_id='.$this->session->userdata('login_user_id') ?>
                                    <a href="#" id="<?php echo $likeid;?>" class="Button2 Button13 WhiteButton" onClick="pinUnlike(id)" >
                                            <strong>Unlike</strong><span></span>
                                    </a>
                                    </li>
                                <?php endif?>
                                    <li class="like-button_ajax" style="display: none">
                                    <?php $likeid ='pin_id='.$pinId.'&source_user_id='.$pinDetails->user_id.'&like_user_id='.$this->session->userdata('login_user_id') ?>
                                    <a href="#" id="<?php echo $likeid;?>" class="Button2 Button13 WhiteButton" onClick="pinLike(id)" >
                                            <strong>Like</strong><span></span>
                                    </a>
                                    </li>
                                    <li class="unlike-button_ajax" style="display: none">
                                    <?php $likeid ='pin_id='.$pinId.'&source_user_id='.$pinDetails->user_id.'&like_user_id='.$this->session->userdata('login_user_id') ?>
                                    <a href="#" id="<?php echo $likeid;?>" class="Button2 Button13 WhiteButton" onClick="pinUnlike(id)" >
                                            <strong>Unlike</strong><span></span>
                                    </a>
                                    </li>

                            <?php endif?>
                        </ul>
                    </div>
                    <div class="PinActionName-right">
                        <?php if($pinDetails->source_url!=""):?>
                            <p id="PinSource" class="colorlight">From <a href="<?php echo $pinDetails->source_url;?>" target="_blank" ><?php echo $source;?></a></p>
                        <?php else:?>
                            <?php $userDetails = userDetails($pinDetails->user_id);?>
                            <p id="PinSource" class="colorlight"> <a>Uploaded by <?php echo $userDetails['name'];?></a></p>
                        <?php endif;?>
                    </div>



                </div>

                <div class="PinImageHolder">
                    <?php if($pinDetails->type=='image'):?>
                            <a href=""  data-id="<?php echo $pinDetails->id?>"><img src="<?php echo $pinDetails->pin_url?>" id="pinCloseupImage" alt="Pinned Image" /></a>
                       <?php else:?>
                            <?php $video = explode('=', $pinDetails->source_url);?>
                                <iframe title="YouTube video player" width="500" height="390" src="http://www.youtube.com/embed/<?php echo $video[1];?>?wmode=opaque" frameborder="0" allowfullscreen></iframe>
                       <?php endif;?>
                    <div class="pinitem-commentbox"></div>
                </div>
                <div class="clear"></div>
<!--                <div class="">
                    <div id="PinLikes" class="PinActivity hidden">
                        <?php //$pinLikeCount = getPinLikeCount($pinDetails->id)?>
                        <h4 id="likecount"><?php echo $pinLikeCount;?> Likes</h4>
                    </div>

                    <div id="PinRepins" class="PinActivity hidden">
                        <?php //$pinRepinCount = getRepinCount('from_pin_id',$pinDetails->id)?>
                        <h4 id="repin_count_<?php //echo $pinDetails->id;?>"><?php //echo $pinRepinCount;?> Repins</h4>
                    </div>
                </div>-->

                <div class="pin_item" style="width: 610px;background:none;border: none;">
                        <?php $commentBoxId = 'comments_box_'.$pinId;?>
                        <?php if(!empty ($comments)):?>
                        <?php foreach ($comments as $key => $cmt):?>
                             <?php $commentuser = userDetails($cmt->user_id)?>
                             <div id="<?php echo $commentBoxId;?>">
                            <!-- Comment List -->
                                <div class="convo_blk comments width_class" id="comment_id_<?php echo $cmt->id;?>">
                                    <a href="<?php echo site_url('user/index/'.$cmt->user_id)?>" class="convo_img">
                                        <img src="<?php echo $commentuser['image']?>" alt="user" />
                                    </a>
                                    <p>
                                        <a href="<?php echo site_url('user/index/'.$cmt->user_id)?>"><?php echo $commentuser['name']?></a> <?php echo $cmt->comments?>
                                    </p>
                                    <?php if($cmt->user_id==$this->session->userdata('login_user_id')):?>
                                    <a data="<?php echo $cmt->id;?>" id="<?php echo "delete_".$cmt->id ?>" style="cursor: pointer;float: right;margin-right: 5px;"  onclick="deleteComment(<?php echo $cmt->id;?>)" title="Remove Comment" class="DeleteComment floatRight tipsyHover">X</a>
                                    <?php endif?>
                                </div>
                            </div>
                        <?php endforeach;?>
                        <?php else:?>
                             <div id="<?php echo $commentBoxId;?>"></div>
                        <?php endif?>
                         <br clear="all">
                         <div class="convo_blk enter_comm" style="width:589px;margin-top: -17px" id="<?php echo $pinId;?>"></div>
                         <div class="action" style="display: block;float:left;left:0;position:relative;top:0;">
                         <?php $commentId = 'comment-'.$pinId?>
                         <a class="act_comment" id="<?php echo $commentId?>" href="javascript:;" onClick="addComment(<?php echo $pinId ;?>,'comment')" ><span>comment</span></a>
                         </div>

                         <div class="inside_artlike_box">
                            <?php $content = getEachBoardPins($pinDetails->board_id,$limit=10);?>
                            <?php $boardDetails = getBoardDetails($pinDetails->board_id);?>
                            <span class="inside_artlike_box_text">Pinned onto the board</span>
                            <div class="clear"></div>
                            <h2><a href="<?php echo site_url('board/index/'.$boardDetails->id);?>"><?php echo $boardDetails->board_name;?></a></h2>
                            <ul class="artlike_style">
                                <?php if(!empty ($content)):?>
                                    <?php foreach ($content as $key=>$pinValue):?>
                                        <li>
                                            <div class="artlike_thumb"><img src="<?php echo $pinValue->pin_url;;?>" width="49" height="49" /></div>
                                         </li>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </ul>
                        </div>
                        <div class="pinned_box">
                            <div class="pinned_box_left_wrap">
                                <div class="pinned_member_box">
                                    <?php $allPins = getAllPins($pinDetails->user_id);?>
                                    <?php $userDetails = userDetails($pinDetails->user_id);?>
                                    <span class="inside_artlike_box_text">Pinned by </span>
                                    <h2><a href="<?php echo site_url('user/index/'.$userDetails['userId']);?>"><?php echo $userDetails['name'];?></a></h2>
                                    <ul class="artlike_style">
                                        <?php if(!empty($allPins)): ?>
                                            <?php $i=0;?>
                                            <?php foreach($allPins as $allPinsKey=>$allPinsValue):?>
                                                <?php if($i<5):?>
                                                    <li>
                                                        <div class="artlike_thumb"><img src="<?php echo $allPinsValue->pin_url; ?>" width="49" height="49" /></div>
                                                    </li>
                                                <?php endif;?>
                                                <?php $i++;?>

                                            <?php endforeach;?>
                                        <?php endif;?>

                                    </ul>
                                </div>
                            </div>

                            <div class="pinned_box_right_wrap">
                                <div class="pinned_member_box">
                                    <span class="inside_artlike_box_text">Pinned from</span>
                                    <?php if($pinDetails->source_url!=""):?>
                                        <?php
                                           $source = $sourceName = GetDomain($pinDetails->source_url);?>
                                    <?php else:?>
                                        <?php
                                            $sourceName = 'User uploaded pin';
                                            $source =false;
                                        ?>
                                    <?php endif;?>
                                    <?php $sourcePins = getPinsBySource($source,$random=true);?>
                                     <?php $encode_source =  base64_encode($source);?>
                                    <h2><a href="<?php echo site_url('pins/source/'.$encode_source);?>"><?php echo $sourceName;?></a></h2>

                                    <ul class="artlike_style">
                                        <!-- Get pins from pin tables with same source.random parameter is used for feteching random pins and for display all pins of same source the random parameter is not used.-->

                                        <?php if(!empty($sourcePins)):?>
                                            <?php foreach ($sourcePins as $sourceKey => $sourcePin) :?>
                                                <li>
                                                    <div class="artlike_thumb"><img src="<?php echo $sourcePin->pin_url;?>" width="49" height="49" /></div>
                                                </li>
                                            <?php endforeach;?>
                                        <?php endif;?>

                                    </ul>
                                </div>
                            </div>

                            <div class="all_repinsbox">
                                <?php $repinUsers = getRepinUsers($pinDetails->id,$limit=10);?>
                                <?php $pinRepinCount = getRepinCount('from_pin_id',$pinDetails->id)?>
                                <h3><?php echo $pinRepinCount;?> Repins </h3>
                                <ul class="repin_itembox_style">
                                    <?php if($repinUsers):?>
                                        <?php foreach ($repinUsers as $key => $value): ?>
                                            <?php $userDetails = userDetails($value->repin_user_id);?>
                                            <?php $repinDetails = getPinDetails($value->new_pin_id);?>
                                            <?php $repinBoardDetails = getBoardDetails($repinDetails->board_id);?>
                                            <li>
                                                <div class="repin_itembox">
                                                    <div class="inside_repin_thumbs"><a href="<?php echo site_url('user/index/'.$userDetails['userId']);?>"><img src="<?php echo $userDetails['image'];?>" width="49" height="49" /></a></div>
                                                    <div class="onto_div">
                                                        <p><a href="<?php echo site_url('user/index/'.$userDetails['userId']);?>"><?php echo $userDetails['name'];?></a> onto <a href="<?php echo site_url('board/index/'.$repinBoardDetails->id);?>"><?php echo $repinBoardDetails->board_name;?></a></p>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach;?>

                                    <?php else:?>
                                            <p>No repins</p>
                                    <?php endif;?>
                                </ul>
                            </div>

                            <div class="inside_like_bx">
                                <?php $likeUsers = getLikeUsers($pinDetails->id,$limit=10);?>
                                <h3 id="likecount"><?php echo $likeUsers?count($likeUsers):'0';?> Likes </h3>
                                <ul class="inside_like_style">
                                    <?php if($likeUsers):?>
                                        <?php foreach ($likeUsers as $key => $value): ?>
                                            <?php $userDetails = userDetails($value->like_user_id);?>
                                            <li id='addlike_<?php echo $value->like_user_id;?>'>
                                                <div class="inside_like_thumbs"><a href="<?php echo site_url('user/index/'.$userDetails['userId']);?>"><img src="<?php echo $userDetails['image'];?>" width="49" height="49" /></a></div>
                                            </li>
                                        <?php endforeach;?>
                                    <?php else:?>
                                          <p id="no_like">No likes</p>
                                    <?php endif;?>


                                </ul>
                            </div>
                        </div>

                    </div>




                
            </div>
        </div>
    </div><!-- closing container -->
</div><!-- closing middlebanner -->
<?php $this->load->view('footer');?>
<script type="text/javascript">
function pinLike(val)
{

    dataString = val;
    $.ajax({
            url:  baseUrl+ 'pins/saveLikes',
            type: "POST",
            data: dataString,
            dataType: 'json',
            cache: false,
            success: function (data) {
            current =  $('#likecount').html();
            var substr = current.split(' ');
            count = parseFloat(substr[0]) + parseFloat(1);
            $('#likecount').html(count+' like');

            $('.like-button').hide();
            $('.like-button_ajax').hide();
            $('.unlike-button_ajax').show();
             $(".inside_like_bx ul").append("<li id='addlike_"+logId+"'><div class='inside_like_thumbs'><a href='"+baseUrl+"user/index/"+logId+"'><img src='"+logImage+"' width='49px' height='49px' /></a></div></li>");
            $('#no_like').html('');
        }
        });
}
function pinUnlike(val)
{
    dataString = val;
    $.ajax({
            url:  baseUrl+ 'pins/unLike',
            type: "POST",
            data: dataString,
            dataType: 'json',
            cache: false,
            success: function (data) {
            current =  $('#likecount').html();
            var substr = current.split(' ');
            count = parseFloat(substr[0]) - parseFloat(1);
            $('#likecount').html(count+' like');
            $('.unlike-button').hide();
            $('.unlike-button_ajax').hide();
            $('.like-button_ajax').show();
            $('#addlike_'+logId).remove();
            if(count=='0')
            {
               $('#no_like').html('No likes');
            }
        }
        });
}
</script>
<script type="text/javascript">
function follow_unfollow(type,id,user_id)
{

    val = 'is_following_board_id='+id+'&is_following='+user_id+'&action='+type;
    if(type=='follow')
    {
        $.ajax({
	        url: baseUrl+"follow/saveFollowUnfollow",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
                $('#follow_btn_'+id).hide();
                $('#ajax_unfollow_btn_'+id).show();
                $('#ajax_follow_btn_'+id).hide();
                count = $('#followers_count_'+id).html();
                count = parseInt(count) + parseInt(1);
                $('#followers_count_'+id).html(count);

            }
            })

    }
    else{
        $.ajax({
	        url: baseUrl+"follow/saveFollowUnfollow",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
                $('#unfollow_btn_'+id).hide();
                $('#ajax_follow_btn_'+id).show();
                $('#ajax_unfollow_btn_'+id).hide();
                count = $('#followers_count_'+id).html();

                count = parseInt(count) - parseInt(1);
                $('#followers_count_'+id).html(count);
                //alert(count)
            }
            })

    }

}
</script>
</html>