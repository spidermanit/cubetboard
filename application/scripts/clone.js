/*
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

/*


    $(document).ready(function(){
                $("a.act_uncomment").hide();
                $(".enter_comm").hide();

    });

*/

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

    


