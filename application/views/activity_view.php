<?php $this->load->view('header');?>

<!--Following functions to handle the comments/like/unlike functions -->
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
                $("div[id=comments_box_"+pinid+"]:last").append("<div class='convo_blk comments'><a class='convo_img' href='#'><img src="+logImage+" height='50' width='50'/></a><a href="+baseUrl+"'user/index/'"+logId+"><strong>"+commentinfo[0]+" </strong></a>"+commentinfo[1]+"</div> ");
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
        $('#'+board_id).html("<a href='#' class='convo_img'><img src="+logImage+" alt='image' /></a><textarea name='comment_"+board_id+"' id='comment_"+board_id+"' onkeyup='showbutton("+board_id+")'  cols=20 rows=1 ></textarea><p class='txt_right_align'><button class='button4' type='button' name='comment_button' id='comment_button_"+board_id+"' onclick='comment("+board_id+")'><span class='counter'><span>Comment</span></span></button> </p>");
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

<?php $this->load->view('profile_header');?>
<?php $this->load->view('popup_js');?>

<div class="white_strip"></div>
<div class="middle-banner_bg"><!-- staing middlebanner -->
    <div id="Container">
        <div class="clear"></div>
        <div class="container Mcenter clearfix transitions-enabled masonry" id="alpha" style="position: relative; height: 4727px; width: 1380px;">
        <?php $activityList = getActivity($id);?>
        <?php if(!empty($activityList)):?>
            <?php foreach($activityList as $activityListKey=>$activityListValue):?>
                <?php if( ($activityListValue->type=='pin') || ($activityListValue->type=='like') || ($activityListValue->type=='repin') || ($activityListValue->type=='video')||($activityListValue->type=='image')):?>
                    <?php $activityValue = getPinDetails($activityListValue->action_id);?>
                    <?php if(($activityValue)):?>
                        <?php $comments =  getPinComments($activityValue->id);?>
                        <div class="pin_item">
                            
                            <!--Display the activity of the user -->
                            <div class="convo_blk comments">
                                <p><?php echo $activityListValue->log.' on '.$activityListValue->timestamp?></p>
                            </div>
                            
                            <!--Like comment repin action -->
                            <!--
                            <div class="action">
                                <?php //$likeId = 'like-'.$activityValue->id?>
                                <?php //$unlikeId = 'unlike-'.$activityValue->id?>
                                <?php //$like =$activityValue->user_id ?>
                                <span id="like_action<?php //echo $activityValue->id;?>">
                                <?php //if($activityValue->user_id==$this->session->userdata('login_user_id')):?>
                                    <a href="<?php //echo site_url('board/pinEdit/'.$boardId.'/'.$activityValue->id)?>" class="act_repin"><span>Edit</span></a>
                                <?php //else:?>
                                    <?php //if(!isLiked($activityValue->id,$this->session->userdata('login_user_id'))):?>
                                        <a class="act_like" id="<?php //echo $likeId?>" href="javascript:;"  onClick="doAction(<?php //echo $like;?>,<?php //echo $activityValue->id;?>,'like')"><span>Like</span></a>
                                    <?php //else:?>
                                        <a class="act_unlike" id="<?php //echo $unlikeId?>" href="javascript:;"   onClick="doAction(<?php //echo $like;?>,<?php //echo $activityValue->id;?>,'unlike')"><span>UnLike</span></a>
                                    <?php //endif?>
                                <?php //endif?>
                                </span>
                                <div id="showLike<?php //echo $activityValue->id?>" style="display: none;">
                                    <?php //$like =$activityValue->user_id ?>
                                    <a class="act_like" id="<?php //echo $likeId?>" href="javascript:;"  onClick="doAction(<?php //echo $like;?>,<?php //echo $activityValue->id;?>,'like')"><span>Like</span></a>
                                </div>
                                <div id="showUnLike<?php //echo $activityValue->id?>" style="display: none;">
                                    <?php //$like =$activityValue->user_id ?>
                                    <a class="act_unlike" id="<?php //echo $unlikeId?>" href="javascript:;"   onClick="doAction(<?php //echo $like;?>,<?php //echo $activityValue->id;?>,'unlike')"><span>UnLike</span></a>
                                </div>

                                <a href="" class="fancyboxForm act_repin"><span>Repin</span></a>
                                <?php //$commentId = 'comment-'.$activityValue->id?>
                                <?php //$uncommentId = 'uncomment-'.$activityValue->id?>
                                <a class="act_comment" id="<?php //echo $commentId?>" href="javascript:;" onClick="addComment(<?php //echo $activityValue->id;?>,'comment')" ><span>Comment</span></a>
                                <a class="act_uncomment" id="<?php //echo $uncommentId?>" href="javascript:;" onClick="addComment(<?php //echo $activityValue->id;?>,'uncomment')" ><span>Uncomment</span></a>
                            </div>
                            -->

                            <!--Display the pin image-->
                            <div class="pin_img">
                                <?php if($activityValue->type=='video'):?>
                                        <div class="video"></div>
                                <?php endif?>
                                <a href="<?php echo site_url()?>board/pins/<?php echo $activityValue->board_id.'/'. $activityValue->id;?>/view" class="fancyboxForm1 ajax">
                                    <img src="<?php echo $activityValue->pin_url;?>"  />
                                </a>
                            </div>

                             <!--Display the comment / repin/like counts-->
                            <div class="comm_des">
                                <p class="des"><?php echo $activityValue->description;?></p>
                                <p class="comm_like">
                                    <?php $commentCountId = 'comment_count_'.$activityValue->id;?>
                                    <?php $likeCountId   = 'like1-'.$activityValue->id;?>
                                    <span id="<?php echo $likeCountId;?>"><?php echo getPinLikeCount($activityValue->id);?> Likes</span>
                                    <span id="<?php echo $commentCountId;?>"> <?php echo count($comments)?> Comments</span

                                    <?php $repinCount = getRepinCount('from_pin_id',$activityValue->id);?>
                                    <?php $repinCountId = 'repin_count_'.$activityValue->id;?>
                                    <span id="<?php echo $repinCountId;?>"><?php echo $repinCount;?> Repins</span>
                                </p>
                            </div>

                            <!--Display user name, board name, source name-->
                            <div class="convo_blk attribution">
                                <?php $userDetails= userDetails($activityValue->user_id);?>
                                <a href="<?php echo site_url('user/index/'.$activityValue->user_id)?>" class="convo_img">
                                    <img src="<?php echo $userDetails['image']?>" alt="cogzidel" />
                                </a>
                                <p>
                                    <?php $source = GetDomain($activityValue->source_url);?>
                                    <?php $boardDetails = getBoardDetails($activityValue->board_id);?>
                                    <a href="<?php echo site_url('user/index/'.$activityValue->user_id)?>"><?php echo $userDetails['name']?></a>
                                     <?php if($activityValue->source_url!=""):?>
                                        Via <a href="<?php echo $activityValue->source_url;?>"><?php echo $source;?></a>
                                    <?php endif;?>
                                    onto <a   href="<?php echo site_url('board/index/'.$boardDetails->id)?>">
                                    <?php echo $boardDetails->board_name;?></a>
                                </p>
                            </div>

                            <!--Display the comments of the user-->
                            <?php $commentBoxId = 'comments_box_'.$activityValue->id;?>
                            <?php if(!empty ($comments)):?>
                                <?php foreach ($comments as $key => $cmt):?>
                                    <?php $commentuser = userDetails($cmt->user_id)?>
                                     <div id="<?php echo $commentBoxId;?>">
                                        <!-- Comment List -->
                                        <div class="convo_blk comments">
                                            <a href="<?php echo site_url('user/index/'.$cmt->user_id)?>" class="convo_img">
                                                <img src="<?php echo $commentuser['image']?>" alt="cogzidel" />
                                            </a>
                                            <p>
                                                <a href="<?php echo site_url('user/index/'.$cmt->user_id)?>"><?php echo $commentuser['name']?></a> <?php echo $cmt->comments?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            <?php else:?>
                                 <div id="<?php echo $commentBoxId;?>"></div>
                            <?php endif?>
                        </div>

                    <?php endif?>
                <?php endif?>
            <?php endforeach;?>
        <?php else:?>
            <div class="alert_messgae">
                <h2>No activity found</h2>
            </div>
        <?php endif?>
    </div> <!-- #alpha -->

    <nav id="page-nav"><a href=""></a> </nav>
</div>
</div>
<script type="text/javascript">
  $(function(){
   // alert($('.pin_item').length);
    var $alpha = $('#alpha');
	$alpha.imagesLoaded( function(){
    $alpha.masonry({
      itemSelector: '.pin_item',
	  isFitWidth: true,
	  isAnimatedFromBottom: true
	  //isAnimated: true
    });
	});
    $alpha.infinitescroll({
      navSelector  : '#page-nav',    // selector for the paged navigation
      nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
      itemSelector : '.pin_item',     // selector for all items you'll retrieve
      loading: {
          finishedMsg: 'No more pages to load.',
          img: 'http://i.imgur.com/6RMhx.gif'
        }
      },
      // trigger Masonry as a callback
      function( newElements ) {
        // hide new items while they are loading
        var $newElems = $( newElements ).css({ opacity: 0 });
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
          // show elems now they're ready
          $newElems.animate({ opacity: 1 });
          $alpha.masonry( 'appended', $newElems, true );
        });
      }
    );

  });
</script>

<?php $this->load->view('footer');?>
</body>
</html>
<div class="scroll_top">
	<a href="#top">Back to Top</a>
</div>