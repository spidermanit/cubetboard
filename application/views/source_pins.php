<?php $this->load->view('header');?>
<script language="JavaScript" type="text/javascript"><!--
function addToFav() {
    if(window.sidebar){
    window.sidebar.addPanel(document.title, this.location,"");
    }
    else{
    window.external.AddFavorite(this.location,document.title);
    }
    }
    if(window.external) {
    document.write('<a href="javascript:addToFav()"></a>');
    }
    /*else {
    document.write('<div>Bookmark (Ctrl+D)</div>');
    }*///-->
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
<?php $data['id'] = $userDetails['userId'];?>
<div class="white_strip"></div>
<div class="middle-banner_bg"><!-- staing middlebanner -->
    <div class="info_bar">
        <div class="left">
            <div class="right">
                <div class="mid">
                    <div id="info">
                        <label>
                            <?php
                                if($source=='')
                                    echo 'User uploaded pins';
                                else {
                                    echo 'Pins from '.$source;
                                }
                            ?>
                                    
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div id="Container">
    <div id="alpha" class="container Mcenter clearfix transitions-enabled">
        <?php $sourcePin = getPinsBySource($source);?>
        <?php if(is_array($sourcePin)):?>
            <?php foreach($sourcePin as $sourcePinKey=>$sourcePinValue):?>
                        <?php $comments =  getPinComments($sourcePinValue->id);?>
                        <div class="pin_item">
                            <div class="action">
                                <?php $likeId = 'like-'.$sourcePinValue->id?>
                                <?php $unlikeId = 'unlike-'.$sourcePinValue->id?>
                                <?php $like =$sourcePinValue->user_id ?>
                                <span id="like_action<?php echo $sourcePinValue->id;?>">
                                <?php if($sourcePinValue->user_id==$this->session->userdata('login_user_id')):?>
                                <a href="<?php echo site_url('board/pinEdit/'.$sourcePinValue->board_id.'/'.$sourcePinValue->id)?>" class="act_repin"><span>Edit</span></a>
                                <?php else:?>

                                    <?php if(!isLiked($sourcePinValue->id,$this->session->userdata('login_user_id'))):?>
                                        <a class="act_like" id="<?php echo $likeId?>" href="javascript:;"  onClick="doAction(<?php echo $like;?>,<?php echo $sourcePinValue->id;?>,'like')"><span>Like</span></a>
                                    <?php else:?>
                                        <a class="act_unlike" id="<?php echo $unlikeId?>" href="javascript:;"   onClick="doAction(<?php echo $like;?>,<?php echo $sourcePinValue->id;?>,'unlike')"><span>UnLike</span></a>
                                    <?php endif?>
                                <?php endif?>
                                </span>
                                <div id="showLike<?php echo $sourcePinValue->id?>" style="display: none;float:left;width: 64px;">
                                    <?php $like =$sourcePinValue->user_id ?>
                                    <a class="act_like" id="<?php echo $likeId?>" href="javascript:;"  onClick="doAction(<?php echo $like;?>,<?php echo $sourcePinValue->id;?>,'like')"><span>Like</span></a>
                                </div>
                                <div id="showUnLike<?php echo $sourcePinValue->id?>" style="display: none;float:left;width: 64px;">
                                    <?php $like =$sourcePinValue->user_id ?>
                                    <a class="act_unlike" id="<?php echo $unlikeId?>" href="javascript:;"   onClick="doAction(<?php echo $like;?>,<?php echo $sourcePinValue->id;?>,'unlike')"><span>UnLike</span></a>
                                </div>

                                <a class="fancyboxForm act_repin ajax" href="<?php echo site_url('repin/load/'.$sourcePinValue->id)?>">Repin</a>
                                
                                <?php $commentId = 'comment-'.$sourcePinValue->id?>
                                <?php $uncommentId = 'uncomment-'.$sourcePinValue->id?>
                                <a class="act_comment" id="<?php echo $commentId?>" href="javascript:;" onClick="addComment(<?php echo $sourcePinValue->id;?>,'comment')" ><span>Comment</span></a>
                                <a class="act_uncomment" id="<?php echo $uncommentId?>" href="javascript:;" onClick="addComment(<?php echo $sourcePinValue->id;?>,'uncomment')" ><span>Uncomment</span></a>
                            </div>


                            <div class="pin_img">
                                <?php if($sourcePinValue->type=='video'):?>
                                    <div class="video" style="top:21%;left:5%;"></div>
                                 <?php endif?>
                                <a href="<?php echo site_url()?>board/pins/<?php echo $sourcePinValue->board_id.'/'. $sourcePinValue->id;?>/view" class="fancyboxForm1 ajax"><img src="<?php echo $sourcePinValue->pin_url;?>"  /></a>
                            </div>

                            <div class="comm_des">
                                <p class="des"><?php echo $sourcePinValue->description;?></p>
                                <p class="comm_like">
                                    <?php $commentCountId = 'comment_count_'.$sourcePinValue->id;?>
                                    <?php $likeCountId   = 'like1-'.$sourcePinValue->id;?>
                                    <span id="<?php echo $likeCountId;?>"><?php echo getPinLikeCount($sourcePinValue->id);?> Likes</span>
                                    <span id="<?php echo $commentCountId;?>"> <?php echo count($comments)?> Comments</span>

                                    <?php $repinCount = getRepinCount('from_pin_id',$sourcePinValue->id);?>
                                    <?php $repinCountId = 'repin_count_'.$sourcePinValue->id;?>
                                    <span id="<?php echo $repinCountId;?>"><?php echo $repinCount;?> Repins</span>
                                </p>
                            </div>

                            <div class="convo_blk attribution">
                                <?php $userDetails= userDetails($sourcePinValue->user_id);?>
                                <a href="<?php echo site_url('user/index/'.$sourcePinValue->user_id)?>" class="convo_img">
                                    <img src="<?php echo $userDetails['image']?>" alt="cogzidel" />
                                </a>
                                <p>
                                    <?php $source = GetDomain($sourcePinValue->source_url);?>
                                    <?php $boardDetails = getBoardDetails($sourcePinValue->board_id);?>
                                    <a href="<?php echo site_url('user/index/'.$sourcePinValue->user_id)?>"><?php echo $userDetails['name']?></a>
                                    <?php if($sourcePinValue->source_url!=""):?>
                                    Via <a href="<?php echo $sourcePinValue->source_url;?>"><?php echo $source;?></a>
                                    <?php endif;?>
                                    onto <a   href="<?php echo site_url('board/index/'.$boardDetails->id)?>">
                                    <?php echo $boardDetails->board_name;?></a>
                                </p>
                            </div>

                            <!--comment-->
                            <?php $commentBoxId = 'comments_box_'.$sourcePinValue->id;?>
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
                           <div class="convo_blk enter_comm" id="<?php echo $sourcePinValue->id;?>"></div>
                        </div>

        <?php endforeach;?>
        <?php else:?>
            <div class="alert_messgae">
                <h2>No items found</h2>
            </div>
        <?php endif?>
    </div> <!-- #alpha -->

    <nav id="page-nav">
        <a href=""></a>
    </nav>
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
</div>
<?php $this->load->view('footer');?>
</body>
</html>
<div class="scroll_top">
	<a href="#top">Back to Top</a>
</div>