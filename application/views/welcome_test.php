<?php $this->load->view('header');?>
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
                $("#comments_box_"+pinid).append("<div class='convo_blk comments'><a class='convo_img' href='#'><img src="+logImage+" height='50' width='50'/></a><a href="+baseUrl+"'user/index/'"+logId+"><strong>"+commentinfo[0]+" </strong></a>"+commentinfo[1]+"</div> ");
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
<?php $this->load->view('popup_js');?>
    <div class="white_strip"></div>

    <div class="clear"></div>

    <div class="middle-banner_bg"><!-- staing middlebanner -->

        <div class="home_text">
            <?php if(isset($invalid)):?>

            <div id="home_info"><label><h2 style="color: #d20000;font-weight: bold;"><?php echo $invalid?></h2></label></div>
              <?php else:?>
                <div id="home_info"><label><h2>Cubetboard is an online pinboard. Organize and share things you love.</h2></label></div>
            <?php endif;?>
        </div>


<script src="<?php echo base_url(); ?>application/scripts/jquery.lazyloader/jquery.lazyloader.js" type="text/javascript"></script>
<script type="text/javascript" >
$(document).ready( function()
{
    $("pre.pin_item").lazyLoad();
});
</script>

        <div id="Container" style="margin-top:105px;">
        <div class="container Mcenter clearfix transitions-enabled masonry" id="alpha" style="position: relative; height: 6247px; width: 1392px;">

            <?php 
                if(!empty($row))
                    $boardPin = $row;
                else
                    $boardPin = null;
            ?>
            <?php if(is_array($boardPin)):?>
                        <?php foreach($boardPin as $boardPinKey=>$boardPinValue):?>
                            <?php $boardDetails = getBoardDetails($boardPinValue->board_id);?>
                                    <?php $comments =  getPinComments($boardPinValue->id);?>
                                  <div class="pin_item">
                                    <?php if(!$this->session->userdata('login_user_id')):?>
                                      <div class="action">
                                            <span id="like_action">
                                                <a class="act_like ajax" href="<?php echo site_url();?>board/pins/<?php echo $boardDetails->id; ?>/<?php echo $boardPinValue->id;?>/view"><span>Like</span></a>
                                            </span>
                                            <a class="fancyboxForm act_repin ajax" href="<?php echo site_url();?>board/pins/<?php echo $boardDetails->id; ?>/<?php echo $boardPinValue->id;?>/view">Repin</a>
                                            <a class="act_comment ajax" href="<?php echo site_url();?>board/pins/<?php echo $boardDetails->id; ?>/<?php echo $boardPinValue->id;?>/view" ><span>Comment</span></a>
                                        </div>
                                    <?php else:?>
                                        <div class="action">
                                            <?php $likeId = 'like-'.$boardPinValue->id?>
                                            <?php $unlikeId = 'unlike-'.$boardPinValue->id?>
                                            <?php $like =$boardPinValue->user_id ?>
                                            <span id="like_action<?php echo $boardPinValue->id;?>">
                                            <?php if($boardPinValue->user_id==$this->session->userdata('login_user_id')):?>
                                            <a href="<?php echo site_url('board/pinEdit/'.$boardPinValue->board_id.'/'.$boardPinValue->id)?>" class="act_repin"><span>Edit</span></a>
                                            <?php else:?>

                                                <?php if(!isLiked($boardPinValue->id,$this->session->userdata('login_user_id'))):?>
                                                    <a class="act_like" id="<?php echo $likeId?>" href="javascript:;"  onClick="doAction(<?php echo $like;?>,<?php echo $boardPinValue->id;?>,'like')"><span>Like</span></a>
                                                <?php else:?>
                                                    <a class="act_unlike" id="<?php echo $unlikeId?>" href="javascript:;"   onClick="doAction(<?php echo $like;?>,<?php echo $boardPinValue->id;?>,'unlike')"><span>UnLike</span></a>
                                                <?php endif?>
                                            <?php endif?>
                                            </span>
                                            <div id="showLike<?php echo $boardPinValue->id?>" style="display: none;float:left;width: 64px;">
                                                <?php $like =$boardPinValue->user_id ?>
                                                <a class="act_like" id="<?php echo $likeId?>" href="javascript:;"  onClick="doAction(<?php echo $like;?>,<?php echo $boardPinValue->id;?>,'like')"><span>Like</span></a>
                                            </div>
                                            <div id="showUnLike<?php echo $boardPinValue->id?>" style="display: none;float:left;width: 64px;">
                                                <?php $like =$boardPinValue->user_id ?>
                                                <a class="act_unlike" id="<?php echo $unlikeId?>" href="javascript:;"   onClick="doAction(<?php echo $like;?>,<?php echo $boardPinValue->id;?>,'unlike')"><span>UnLike</span></a>
                                            </div>

                                           <a class="ajax" href="<?php echo site_url('repin/load/'.$boardPinValue->id)?>" >Repin</a>


                                            <?php $commentId = 'comment-'.$boardPinValue->id?>
                                            <?php $uncommentId = 'uncomment-'.$boardPinValue->id?>
                                            <a class="act_comment" id="<?php echo $commentId?>" href="javascript:;" onClick="addComment(<?php echo $boardPinValue->id;?>,'comment')" ><span>Comment</span></a>
                                            <a class="act_uncomment" id="<?php echo $uncommentId?>" href="javascript:;" onClick="addComment(<?php echo $boardPinValue->id;?>,'uncomment')" ><span>Uncomment</span></a>
                                        </div>
                                    <?php endif;?>

                                    <div class="pin_img">
                                        <?php if($boardPinValue->type=='video'):?>
                                            <div class="video" style="top:8%;left:7%;"></div>
                                        <?php endif?>
                                        <a href="<?php echo site_url();?>board/pinsTest/<?php echo $boardDetails->id; ?>/<?php echo $boardPinValue->id;?>/view" class="ajax">
                                            <img src="<?php echo $boardPinValue->pin_url; ?>" alt="<?php echo $boardPinValue->description; ?>" class="PinImageImg"  />
                                        </a>
                                    </div>
                                      <div class="comm_des">
                                    <p class="des"><?php echo  strlen($boardPinValue->pin_url);?></p>
                                    <p class="comm_like">
                                        <?php $commentCountId = 'comment_count_'.$boardPinValue->id;?>
                                        <?php $likeCountId   = 'like1-'.$boardPinValue->id;?>
                                        <span id="<?php echo $likeCountId;?>"><?php echo getPinLikeCount($boardPinValue->id);?> Likes</span>
                                        <span id="<?php echo $commentCountId;?>"> <?php echo count($comments)?> Comments</span>

                                        <?php $repinCount = getRepinCount($boardPinValue->id,'from_pin_id');?>
                                        <?php $repinCountId = 'repin_count_'.$boardPinValue->id;?>
                                        <span id="<?php echo $repinCountId;?>"><?php echo $repinCount;?> Repins</span>
                                    </p>
                                </div>

                                <div class="convo_blk attribution">
                                    <?php $userDetails= userDetails($boardPinValue->user_id);?>
                                    <a href="<?php echo site_url('user/index/'.$boardPinValue->user_id)?>" class="convo_img">
                                        <img src="<?php echo $userDetails['image']?>" alt="cogzidel" />
                                    </a>
                                    <p>
                                        <?php $source = GetDomain($boardPinValue->source_url);?>
                                        <?php $boardDetails = getBoardDetails($boardPinValue->board_id);?>
                                        <a href="<?php echo site_url('user/index/'.$boardPinValue->user_id)?>"><?php echo $userDetails['name']?></a>
                                        <?php if($boardPinValue->source_url!=""):?>
                                        Via <a href="<?php echo $boardPinValue->source_url;?>"><?php echo $source;?></a>
                                        <?php endif;?>
                                        onto <a   href="<?php echo site_url('board/index/'.$boardDetails->id)?>">
                                        <?php echo $boardDetails->board_name;?></a>
                                    </p>


                                </div>
                                 <!--comment-->
                                <?php $commentBoxId = 'comments_box_'.$boardPinValue->id;?>
                                <?php if(!empty ($comments)):?>
                                <?php foreach ($comments as $key => $cmt):?>
                                     <?php $commentuser = userDetails($cmt->user_id)?>
                                     <div id="<?php echo $commentBoxId;?>">
                                    <!-- Comment List -->
                                        <div class="convo_blk comments">
                                            <a href="<?php echo site_url('user/index/'.$cmt->user_id)?>" class="convo_img">
                                                <img src="<?php echo $commentuser['image']?>" alt="user" />
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
                               <div class="convo_blk enter_comm" id="<?php echo $boardPinValue->id;?>"></div>


                                  </div>



                     <?php endforeach?>
                 <?php endif?>
        </div> <!-- #alpha -->
        <?php //$offset = 20; ?>
        <nav id="page-nav">
            
            <a href="<?php echo site_url(); ?>test/getAllPins/<?php echo $offset;?>"></a>
        </nav>
    </div>
</div><!-- closing middlebanner -->
    <?php $this->load->view('footer');?>

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
           $("a.act_uncomment").hide();
            $(".enter_comm").hide();

        });
      }
    );

  });

</script>

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->
<!--fixed sidebar-->
<!--<script type="text/javascript">
$(document).ready(function () {
var sidebar = $('#sidebar_content');
var top = sidebar.offset().top - parseFloat(sidebar.css('marginTop'));
    $(window).scroll(function (event) {
                                       var ypos = $(this).scrollTop();
                                       if (ypos >= top) {
                                               sidebar.addClass('fixed');
                                       }
                                       else {
                                               sidebar.removeClass('fixed');
                                       }
                               });
                       });
</script>-->
 <!--End fixed sidebar-->

<!--<div id=i1><span id="e1">Item 1</span></div>
<div id=i2><span id="e2">Item 2</span></div>-->
