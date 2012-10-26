<?php $this->load->view('header');?>

<!--<script type="text/javascript">
$('a.fancyboxForm1').livequery(function() {
	$("a.fancyboxForm1").fancybox({
	 onStart : function() {
        $("body").addClass("hidden");
		$("#fancybox-wrap").wrap('<div class="fancybox_ovp" />');
      },
	 onClosed : function()
	 {
	 	$("body").removeClass("hidden");
	 	$("#fancybox-wrap").unwrap();
	 },
	 onCleanup : function()
	 {
	 	//$("body").removeClass("hidden");
	 	$("#fancybox-wrap").unwrap();
	 }
});
});

$('a.fancyboxForm').livequery(function() {
	$("a.fancyboxForm").fancybox({
	hideOnOverlayClick:	false,
	  onComplete : function()
	  {
         $("body").addClass("hidden");
      },
	  onClosed : function()
	  {
	  	$("body").removeClass("hidden");
	  }

	});
});
$('a.fancyboxForm2').livequery(function() {
	$("a.fancyboxForm2").fancybox({
	hideOnOverlayClick:	false
	});
	});
$(document).ready(function() {
$('a[href=#top]').fadeOut();
	$(window).scroll(function() {

		if($(this).scrollTop() != 0) {
			$('a[href=#top]').fadeIn();
		} else {
			$('a[href=#top]').fadeOut();
		}
	});

	$('a[href=#top]').click(function() {
		$('body,html').animate({scrollTop:0},800);
		return false;
	});
});
</script>-->
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

</head>

<body id="CategoriesBarPage">

<!--Header begin-->
<!--Header End-->
<!--Inner Header beging-->
<div id="main_content">
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
		isAnimatedFromBottom: true,
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
                    $("#comment_count_"+pinid).html(data+" Comment");

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
		isAnimatedFromBottom: true,

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
<div id="Wout_log_popup">
    <div class="left">
        <div class="right">

            <div class="mid">
                <p>
                    <label class="tittle">Pinderful is an online pinboard organize and share things you love</label>
                                            <label><a class="link2" href="http://products.cogzidel.com/pinterest-clone/con_home/invitefrnd"><span>Invite Friends</span></a></label>
                    <label><a href="javascript:(function(){var s = document.createElement('script');s.src = 'http://products.cogzidel.com/pinterest-clone/js/pinmarklet.js';document.body.appendChild(s);})();" id="create_new_board" class="link3 pin_button_book"><span>Pin it</span></b></a></label>
                                        </p>
            </div>

        </div>
    </div>
</div>

<div id="BoardTitle">
<?php $boardDetails = getBoardDetails($boardId);?>
<h1 class="serif"><strong><?php echo $boardDetails->board_name;?><span id="BoardLikeButton"><fb:like colorscheme="light" font="lucida grande" action="like" width="90" show_faces="false" layout="button_count" href="http://pinterest.com/vishalv/favorite-places-spaces/" class=" fb_edge_widget_with_comment fb_iframe_widget"><span><iframe scrolling="no" id="f19dfc989bbe68e" name="f17339d4cc532ba" style="border: medium none; overflow: hidden; height: 20px; width: 90px;" title="Like this content on Facebook." class="fb_ltr" src="http://www.facebook.com/plugins/like.php?action=like&amp;api_key=274266067164&amp;channel_url=https%3A%2F%2Fs-static.ak.fbcdn.net%2Fconnect%2Fxd_proxy.php%23cb%3Dff72e9fda8d444%26origin%3Dhttp%253A%252F%252Fpinterest.com%252Ffb394ab366e754%26relation%3Dparent.parent%26transport%3Dpostmessage&amp;colorscheme=light&amp;extended_social_context=false&amp;font=lucida%20grande&amp;href=http%3A%2F%2Fpinterest.com%2Fvishalv%2Ffavorite-places-spaces%2F&amp;layout=button_count&amp;locale=en_US&amp;node_type=link&amp;sdk=joey&amp;show_faces=false&amp;width=90"></iframe></span></fb:like></span></strong></h1>
<p class="serif" id="BoardDescription"<?php echo $boardDetails->description;?></p>
<div id="BoardMeta">
    <div id="BoardUsers">
        <?php $userDetails = userDetails($boardDetails->user_id);?>
        <a class="ImgLink" href="<?php echo site_url('user/index/'.$boardDetails->user_id)?>"><img alt="Photo of user" src="<?php echo $userDetails['image']?>"></a>
        <span id="BoardUserName"><a title="<?php echo $userDetails['name']?>" href="<?php echo site_url('user/index/'.$boardDetails->user_id)?>"><?php echo $userDetails['name']?></a></span>
    </div>
    <div id="BoardStats"><strong>6</strong> <span>followers</span>, <strong><?php echo count($result); ?></strong> pins </div>
    <div id="BoardButton">
        <?php if($this->session->userdata('login_user_id')==$boardDetails->user_id):?>
         <a class="Button Button13 WhiteButton" href="<?php echo site_url('board/edit/'.$boardId)?>"><strong>Edit Board</strong><span></span></a>
        <?php endif?>
    </div>
</div><!-- #BoardMeta -->
</div><!-- #BoardTitle -->

<div id="Container">
    <div id="alpha" class="container Mcenter clearfix transitions-enabled">
        <?php foreach($result as $key=>$value):?>
        <?php $comments =  getPinComments($value->id);?>
        <div class="pin_item">
            <div class="action">
                <?php $likeId = 'like-'.$value->id?>
                <?php $unlikeId = 'unlike-'.$value->id?>
                <?php $like =$value->user_id ?>
                <span id="like_action<?php echo $value->id;?>">
                <?php if($value->user_id==$this->session->userdata('login_user_id')):?>
                <a href="<?php echo site_url('board/pinEdit/'.$boardId.'/'.$value->id)?>" class="act_repin"><span>Edit</span></a>
                <?php else:?>

                    <?php if(!isLiked($value->id,$this->session->userdata('login_user_id'))):?>
                        <a class="act_like" id="<?php echo $likeId?>" href="javascript:;"  onClick="doAction(<?php echo $like;?>,<?php echo $value->id;?>,'like')"><span>Like</span></a>
                    <?php else:?>
                        <a class="act_unlike" id="<?php echo $unlikeId?>" href="javascript:;"   onClick="doAction(<?php echo $like;?>,<?php echo $value->id;?>,'unlike')"><span>UnLike</span></a>
                    <?php endif?>
                <?php endif?>
                </span>
                <div id="showLike<?php echo $value->id?>" style="display: none;">
                    <?php $like =$value->user_id ?>
                    <a class="act_like" id="<?php echo $likeId?>" href="javascript:;"  onClick="doAction(<?php echo $like;?>,<?php echo $value->id;?>,'like')"><span>Like</span></a>
                </div>
                <div id="showUnLike<?php echo $value->id?>" style="display: none;">
                    <?php $like =$value->user_id ?>
                    <a class="act_unlike" id="<?php echo $unlikeId?>" href="javascript:;"   onClick="doAction(<?php echo $like;?>,<?php echo $value->id;?>,'unlike')"><span>UnLike</span></a>
                </div>

                <a href="" class="fancyboxForm act_repin"><span>Repin</span></a>
                <?php $commentId = 'comment-'.$value->id?>
                <?php $uncommentId = 'uncomment-'.$value->id?>
                <a class="act_comment" id="<?php echo $commentId?>" href="javascript:;" onClick="addComment(<?php echo $value->id;?>,'comment')" ><span>Comment</span></a>
                <a class="act_uncomment" id="<?php echo $uncommentId?>" href="javascript:;" onClick="addComment(<?php echo $value->id;?>,'uncomment')" ><span>Uncomment</span></a>
            </div>


            <div class="pin_img">
                <a href="<?php echo site_url()?>board/pins/<?php echo $boardId.'/'. $value->id;?>" class="fancyboxForm1"><img src="<?php echo $value->pin_url;?>"  /></a>
            </div>

            <div class="comm_des">
                <p class="des"><?php echo $value->description;?></p>
                <p class="comm_like">
                    <?php $commentCountId = 'comment_count_'.$value->id;?>
                    <?php $likeCountId   = 'like1-'.$value->id;?>
                    <span id="<?php echo $likeCountId;?>"><?php echo getPinLikeCount($value->id);?> Likes</span>
                    <span id="<?php echo $commentCountId;?>"> <?php echo count($comments)?> Comments</span>
                    <span>0	Repins</span>
                </p>
            </div>

            <div class="convo_blk attribution">
                <?php $userDetails= userDetails($value->user_id);?>
                <a href="<?php echo site_url('user/index/'.$value->user_id)?>" class="convo_img">
                    <img src="<?php echo $userDetails['image']?>" alt="cogzidel" />
                </a>
                <p>
                    <?php $source = GetDomain($value->source_url);?>
                    <?php $boardDetails = getBoardDetails($value->board_id);?>
                    <a href="<?php echo site_url('user/index/'.$value->user_id)?>"><?php echo $userDetails['name']?></a>
                    Via <a href="<?php echo $value->source_url;?>"><?php echo $source;?></a>
                    onto <a   href="<?php echo site_url('board/index/'.$boardDetails->id)?>">
                    <?php echo $boardDetails->board_name;?></a>
                </p>


            </div>

            <!--comment-->
            <?php foreach ($comments as $key => $cmt):?>
                 <?php $commentuser = userDetails($cmt->user_id)?>
                 <?php $commentBoxId = 'comments_box_'.$value->id;?>
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
           <div class="convo_blk enter_comm" id="<?php echo $value->id;?>"></div>
        </div>
        <?php endforeach;?>
    </div> <!-- #alpha -->

    <nav id="page-nav">
        <a href="http://products.cogzidel.com/pinterest-clone/con_home/scroll/2"></a>
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
	  isAnimatedFromBottom: true,

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

</body>
</html>
<div class="scroll_top">
	<a href="#top">Back to Top</a>
</div>