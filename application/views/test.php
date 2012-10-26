<style>
    #scrollbar1 { width: 520px; clear: both; margin: 20px 0 10px; }
#scrollbar1 .viewport { width: 500px; height: 200px; overflow: hidden; position: relative; }
#scrollbar1 .overview { list-style: none; position: absolute; left: 0; top: 0; }
#scrollbar1 .thumb .end,
#scrollbar1 .thumb { background-color: #003D5D; }
#scrollbar1 .scrollbar { position: relative; float: right; width: 15px; }
#scrollbar1 .track { background-color: #D8EEFD; height: 100%; width:13px; position: relative; padding: 0 1px; }
#scrollbar1 .thumb { height: 20px; width: 13px; cursor: pointer; overflow: hidden; position: absolute; top: 0; }
#scrollbar1 .thumb .end { overflow: hidden; height: 5px; width: 13px; }
#scrollbar1 .disable{ display: none; }

</style>
<?php $this->load->view('popup_js');?>
 <script type="text/javascript">
  $(document).ready(function(){
                //$.fn.colorbox.resize()

    });
</script>

<link href="<?php echo base_url(); ?>application/assets/css/style1.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/assets/css/popup.css" rel="stylesheet" type="text/css" />
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

<div class="inside_midd_wrap" >
        <div class="inside_left_items_box">
            <div class="insde_pin_topbox">
                <div class="inside_pin_prof_pic"><img src="<?php echo $userDetails['image'];?>" width="49px" height="49px" /></div>
                <h2><a href="<?php echo site_url('user/index/'.$userDetails['userId'])?>"><?php echo $userDetails['name'];?></a></h2>
                <span class="pin_date">
                    <p>Pinned on <?php echo $pinDetails->time;?> from <a href="<?php echo site_url('pins/source/'.$encode_source);?>"><?php echo $sourceName;?></a></p>
                </span>
                <?php if(!$this->session->userdata('login_user_id')):?>
                    <span class="popup_login">
                        <span class="buttonLogin">
                            <a style="color:#ffffff;" href="<?php echo site_url('login/handleLogin/?next=board/pins/'.$boardId.'/'.$pinId);?>">Login</a></span>
                        </span>

                <?php endif;?>
            </div>

            <?php if($this->session->userdata('login_user_id')):?>
<!--            <div class="PinActionButtons-box">
                <div class="PinActionButtons-left">
                    <ul></ul>
                </div>
            </div>-->
                <div class="inside_right_socialnet_links" style="float:left;">
                    <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId='<?php echo $this->config->item('facebook_app_id')?>'";
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));
                    </script>

                    <ul class="pinboard-share-bottons">

                        <li class="repin-button">
                            <a  onclick ="loadRepin(<?php echo $pinDetails->id;?>,'repin' )" href="#"  class="Button2 Button13 WhiteButton">
                                <strong><em></em>Repin</strong>
                            </a>
                        </li>
                        <li class="cancel-repin-button" style="display:none">
                            <a  onclick ="loadRepin(<?php echo $pinDetails->id;?>,'close' )" href="#"  class="Button2 Button13 WhiteButton">
                                <strong><em></em>Close</strong>
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

                        <li><a href="#" onclick ="loadEmail(<?php echo $pinDetails->id;?>,<?php echo $pinDetails->board_id;?>,'email' )" id="EmailShare" class="Button2 Button13 WhiteButton"><strong>@ Email</strong><span></span></a></li>
                        <li><a href="#" onclick ="loadEmail(<?php echo $pinDetails->id;?>,<?php echo $pinDetails->board_id;?>,'close' )" id="CloseEmailShare" class="Button2 Button13 WhiteButton" style="display:none;"><strong>@ Close</strong><span></span></a></li>

                        <li><a href="#" onclick ="loadReport(<?php echo $pinDetails->id;?>,<?php echo $pinDetails->board_id;?>,'report' )" id="PinReport" class="Button2 Button13 WhiteButton"><strong>&#9872; Report Pin</strong><span></span></a></li>
                        <li><a href="#" onclick ="loadReport(<?php echo $pinDetails->id;?>,<?php echo $pinDetails->board_id;?>,'close' )"  id="ClosePinReport" class="Button2 Button13 WhiteButton" style="display:none;"><strong>&#9872; Close</strong><span></span></a></li>

                        <li><a href="#" onclick ="loadEmbed(<?php echo $pinDetails->id;?>,<?php echo $pinDetails->board_id;?>,'embed' )" id="PinEmbed" class="Button2 Button13 WhiteButton"><strong>&lt;&gt; Embed</strong><span></span></a></li>
                        <li><a href="#" onclick ="loadEmbed(<?php echo $pinDetails->id;?>,<?php echo $pinDetails->board_id;?>,'close' )" id="ClosePinEmbed" class="Button2 Button13 WhiteButton" style="display:none;"><strong>&lt;&gt;Close</strong><span></span></a></li>
                    </ul>

                </div>
                <div style="float:right;">
                        <ul class="social_right">
                            <li><a href="http://twitter.com/share" class="twitter-share-button" data-count="none" data-size="large" data-via="Cubet board" data-text="<?php echo $pinDetails->description; ?>">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></li>
                            <li><a title="Share this article/post/whatever on Facebook" href="http://www.facebook.com/sharer.php?s=100&p[url]=<?php echo current_url();?>&p[images][0]=<?php echo $pinDetails->pin_url;?>&p[title]=<?php echo $pinDetails->description;?>&p[summary]=<?php echo "share from my cubetboard application";?>"target="_blank"><img src="<?php echo site_url('application/assets/images/facebook_button.png')?>" width='75px' height='27px'/></a></li>
                        </ul>
                </div>
            <div class="clear"></div>
            <?php endif;?>
            <div class="clear"></div>
            <div id="loading_gif" style="display: none"><img src="<?php echo site_url('application/assets/images/loading.gif');?>" width="75px" height="75px;"/></div>
            <div id="load_view" style="display: none"></div>

            <div class="insi_pin_bigimage">
                <?php if($pinDetails->type=='image'):?>
                <img src="<?php echo $pinDetails->pin_url;?>" />
               <?php else:?>
                    <?php $video = explode('=', $pinDetails->source_url);?>
                        <iframe title="YouTube video player" width="500px" height="390px" src="http://www.youtube.com/embed/<?php echo $video[1];?>?wmode=opaque" frameborder="0" allowfullscreen></iframe>
               <?php endif;?>
                <div style="margin-left:2px;margin-top:-27px;position:relative;z-index:9000;">
                    <strong class="PriceContainer" id="priceDiv"></strong>

                        <strong class="PriceContainer_gift" id="priceDiv_gift" style="color: #fff;">$ <?php echo $pinDetails->gift;?></strong>
                    
                </div>
            </div>
            <span class="desc_text">
                <p><?php echo $pinDetails->description;?></p>
            </span>
            <div class="clear"></div>
            <?php if($this->session->userdata('login_user_id')):?>

                <div class="pin_item" style="width: 610px;background:none;border: none;">
                    <?php $commentBoxId = 'comments_box_'.$pinDetails->id;?>
                    <?php $comments = getPinComments($pinDetails->id);?>
                    <?php if(!empty ($comments)):?>
                    <?php foreach ($comments as $key => $cmt):?>
                         <?php $commentuser = userDetails($cmt->user_id)?>
                         <div id="<?php echo $commentBoxId;?>">
                        <!-- Comment List -->
                            <div class="convo_blk comments width_class individual" id="comment_id_<?php echo $cmt->id;?>">
                                <a href="<?php echo site_url('user/index/'.$cmt->user_id)?>" class="convo_img individual">
                                    <img src="<?php echo $commentuser['image']?>" alt="user" width="49px" height="49px" />
                                </a>
                                <p>
                                    <a href="<?php echo site_url('user/index/'.$cmt->user_id)?>"><?php echo $commentuser['name']?></a> <?php echo $cmt->comments?>
                                </p>
                                <?php if($this->session->userdata('login_user_id')):?>
                                    <?php if($cmt->user_id==$this->session->userdata('login_user_id')):?>
                                    <a data="<?php echo $cmt->id;?>" id="<?php echo "delete_".$cmt->id ?>" style="cursor: pointer;float: right;margin-right: 5px;"  onclick="deleteComment(<?php echo $cmt->id;?>)" title="Remove Comment" class="DeleteComment floatRight tipsyHover">X</a>
                                    <?php endif?>
                                <?php endif?>


                            </div>
                        </div>
                    <?php endforeach;?>
                    <?php else:?>
                         <div id="<?php echo $commentBoxId;?>"></div>
                    <?php endif?>

                     <br clear="all">
                     <div class="convo_blk enter_comm" style="width:589px;margin-top: -17px" id="board_<?php echo $pinDetails->id;?>"></div>
                     <div class="action" style="display: block;float:left;left:0;position:relative;top:0;">
                     <?php $commentId = 'comment-individual-'.$pinId?>
                      <?php if($this->session->userdata('login_user_id')):?>
                         <a class="act_comment" id="<?php echo $commentId?>" href="javascript:;" onClick="addComment(<?php echo $pinDetails->id ;?>,'comment')" ><span>comment</span></a>
                     <?php endif?>
                     </div>
                    </div>


            <?php else:?>
                <div class="pin_item_default" style="width: 610px;background:none;border: none;"></div>
            <?php endif;?>


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
                                <div class="artlike_thumb"><img src="<?php echo $pinValue->pin_url;;?>" width="49px" height="49px" /></div>
                             </li>
                        <?php endforeach;?>
                    <?php endif;?>
                </ul>
            </div>
                <div class="pinned_box">
                <div class="pinned_box_left_wrap">
                    <div class="pinned_member_box" style="height: 100px">
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
                                            <div class="artlike_thumb"><img src="<?php echo $allPinsValue->pin_url; ?>" width="49px" height="49px" /></div>
                                        </li>
                                    <?php endif;?>
                                    <?php $i++;?>

                                <?php endforeach;?>
                            <?php endif;?>

                        </ul>
                    </div>
                </div>

                <div class="pinned_box_right_wrap">
                    <div class="pinned_member_box" style="height: 100px">
                        <span class="inside_artlike_box_text">Pinned from</span>

                        <h2><a href="<?php echo site_url('pins/source/'.$encode_source);?>"><?php echo $sourceName;?></a></h2>

                        <ul class="artlike_style">
                            <!-- Get pins from pin tables with same source.random parameter is used for feteching random pins and for display all pins of same source the random parameter is not used.-->

                            <?php if(!empty($sourcePins)):?>
                                <?php foreach ($sourcePins as $sourceKey => $sourcePin) :?>
                                    <li>
                                        <div class="artlike_thumb"><img src="<?php echo $sourcePin->pin_url;?>" width="49px" height="49px" /></div>
                                    </li>
                                <?php endforeach;?>
                            <?php endif;?>

                        </ul>
                    </div>
                </div>

                <div class="all_repinsbox" style="min-height: 59px">
                    <?php $repinUsers = getRepinUsers($pinDetails->id,$limit=10);?>
                    <h3><?php echo $repinUsers?count($repinUsers):'0';?> Repins </h3>
                    <ul class="repin_itembox_style">
                        <?php if($repinUsers):?>
                            <?php foreach ($repinUsers as $key => $value): ?>
                                <?php $userDetails = userDetails($value->repin_user_id);?>
                                <?php $repinDetails = getPinDetails($value->new_pin_id);?>
                                <?php $repinBoardDetails = getBoardDetails($repinDetails->board_id);?>
                                <li>
                                    <div class="repin_itembox">
                                        <div class="inside_repin_thumbs"><a href="<?php echo site_url('user/index/'.$userDetails['userId']);?>"><img src="<?php echo $userDetails['image'];?>" width="49px" height="49px" /></a></div>
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

                <div class="inside_like_bx" style="min-height: 100px">
                    <?php $likeUsers = getLikeUsers($pinDetails->id,$limit=10);?>
                    <h3 id="likecount"><?php echo $likeUsers?count($likeUsers):'0';?> Likes </h3>
                    <ul class="inside_like_style">
                        <?php if($likeUsers):?>
                            <?php foreach ($likeUsers as $key => $value): ?>
                                <?php $userDetails = userDetails($value->like_user_id);?>
                                <li>
                                    <div class="inside_like_thumbs"><a href="<?php echo site_url('user/index/'.$userDetails['userId']);?>"><img src="<?php echo $userDetails['image'];?>" width="49px" height="49px" /></a></div>
                                </li>
                            <?php endforeach;?>
                        <?php else:?>
                              <p>No likes</p>
                        <?php endif;?>


                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>

 <script type="text/javascript">
 function colorboxResize()
 {
     var x = $('.inside_left_items_box').height();
     newheight = parseInt(x) + parseInt(100);
     $.colorbox.resize({height:newheight});
 }
 function loadRepin(id,action)
 {
       
        if(action=='repin')
        {
            dataString = 'id='+id;

            $('#EmailShare').hide();
            $('#PinReport').hide();
            $('#PinEmbed').hide();


            $('#loading_gif').show();
            $('.insi_pin_bigimage').hide();

            $('#load_view').html('');

            $('.repin-button').hide();
            $('.cancel-repin-button').show();

            //$('#load_view').show();

            $.ajax({
                    url: "<?php echo site_url('repin/ajaxLoad');?>",
                    type: "POST",
                    data: dataString,
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                    $('#loading_gif').hide();
                    $('#load_view').show();
                    $('#load_view').html(data);
                    var x = $('.inside_left_items_box').height();
                    newheight = parseInt(x) + parseInt(300);
                    $.colorbox.resize({height:newheight});

                }
                });
        }
        else{
            $('#loading_gif').hide();

            $('#load_view').html('');
            $('#load_view').hide();

            $('.insi_pin_bigimage').show();

            $('.cancel-repin-button').hide();
            $('.repin-button').show();

            $('#EmailShare').show();
            $('#PinReport').show();
            $('#PinEmbed').show();
            colorboxResize();
        }

 }
</script>

<script type="text/javascript">
 function loadEmail(id,board_id,action)
 {
        if(action=='email')
        {
            dataString = 'pin_id='+id+'&board_id='+board_id;

            $('.repin-button').hide();
            $('#PinReport').hide();
            $('#PinEmbed').hide();
             $('#EmailShare').hide();

            $('#loading_gif').show();
            $('.insi_pin_bigimage').hide();

            $('#load_view').html('');

            $('.repin-button').hide();
            $('#CloseEmailShare').show();

            //$('#load_view').show();

            $.ajax({
                    url: "<?php echo site_url('action/ajaxEmail');?>",
                    type: "POST",
                    data: dataString,
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                    $('#loading_gif').hide();
                    $('#load_view').show();
                    $('#load_view').html(data);
                    colorboxResize();
                }
                });
        }
        else{
            $('#loading_gif').hide();

            $('#load_view').html('');
            $('#load_view').hide();

            $('.insi_pin_bigimage').show();

            $('#CloseEmailShare').hide();
            $('#EmailShare').show();

            $('.repin-button').show();
            $('#PinReport').show();
            $('#PinEmbed').show();
            colorboxResize();

        }

 }
</script>

<script type="text/javascript">
 function loadReport(id,board_id,action)
 {
        if(action=='report')
        {
            dataString = 'pin_id='+id+'&board_id='+board_id;

            $('.repin-button').hide();
            $('#PinEmbed').hide();
             $('#EmailShare').hide();

            $('#loading_gif').show();
            $('.insi_pin_bigimage').hide();

            $('#load_view').html('');

             $('#PinReport').hide();
            $('#ClosePinReport').show();

            //$('#load_view').show();

            $.ajax({
                    url: "<?php echo site_url('action/ajaxReport');?>",
                    type: "POST",
                    data: dataString,
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                    $('#loading_gif').hide();
                    $('#load_view').show();
                    $('#load_view').html(data);
                    colorboxResize();
                }
                });
        }
        else{
            $('#loading_gif').hide();

            $('#load_view').html('');
            $('#load_view').hide();

            $('.insi_pin_bigimage').show();

            $('#ClosePinReport').hide();

            $('#PinReport').show();

            $('#EmailShare').show();
            $('.repin-button').show();
            $('#PinEmbed').show();
            colorboxResize();

        }

 }
</script>
<script type="text/javascript">
 function loadEmbed(id,board_id,action)
 {
        if(action=='embed')
        {
            dataString = 'pin_id='+id+'&board_id='+board_id;

            $('.repin-button').hide();
             $('#PinReport').hide();
             $('#EmailShare').hide();

            $('#loading_gif').show();
            $('.insi_pin_bigimage').hide();

            $('#load_view').html('');


             $('#PinEmbed').hide();
            $('#ClosePinEmbed').show();

            //$('#load_view').show();

            $.ajax({
                    url: "<?php echo site_url('action/ajaxEmbed');?>",
                    type: "POST",
                    data: dataString,
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                    $('#loading_gif').hide();
                    $('#load_view').show();
                    $('#load_view').html(data);
                    colorboxResize();
                }
                });
        }
        else{
            $('#loading_gif').hide();

            $('#load_view').html('');
            $('#load_view').hide();

            $('.insi_pin_bigimage').show();

            $('#ClosePinEmbed').hide();

            $('#PinReport').show();
            $('#EmailShare').show();
            $('.repin-button').show();
            $('#PinEmbed').show();
            colorboxResize();

        }

 }
</script>



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

          dataString = 'id='+value;
          $.ajax({
                url: "<?php echo site_url('board/deleteComment');?>",
                type: "POST",
                data: dataString,
                dataType: 'json',
                cache: false,
                success: function (data) {
                  $('#comment_id_'+value).remove();
                  colorboxResize();
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
        $('a#uncomment-individual-'+pinid).hide();
        $('a#comment-individual-'+pinid).show();

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
                    $(".enter_comm").hide();
                    $("#count_comment_"+pinid).empty();
                    $("#count_comment_"+pinid).html("<a href=http://products.cogzidel.com/pinterest-clone/con_home/viewpin/"+pinid+">All "+commentinfo[4]+" Comments...</a>");
                    //$("#comments_box_"+pinid+':last-child').append("<div class='convo_blk comments width_class'><a class='convo_img' href='#'><img src="+logImage+" height='50' width='50'/></a><a href="+baseUrl+"'user/index/'"+logId+"><strong>"+commentinfo[0]+" </strong></a>"+commentinfo[1]+"</div> ");
                    $("div[id=comments_box_"+pinid+"]:last").append("<div class='convo_blk comments width_class individual' id='comment_id_"+data[1]+"'><a class='convo_img individual' href='#'><img src="+logImage+" height='50px' width='50px'/></a><a href="+baseUrl+"'user/index/'"+logId+"><strong>"+commentinfo[0]+" </strong></a>"+commentinfo[1]+"<a style='cursor: pointer;float:right;margin-right:5px;'  onclick='deleteComment("+data[1]+")' title='Remove Comment' class='DeleteComment floatRight tipsyHover'>X</a></div> ");
                    colorboxResize();
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
			$('#board_'+board_id).html("<a href='#' class='convo_img individual'><img src="+logImage+" alt='image' /></a><textarea name='comment_"+board_id+"' id='comment_"+board_id+"' onkeyup='showbutton("+board_id+")'  cols=20 rows=1 style='width:516px;'></textarea><p class='txt_right_align'><button class='button4' type='button' name='comment_button' id='comment_button_"+board_id+"' onclick='comment("+board_id+")'><span class='counter'><span>Comment</span></span></button> </p>");
	        $('#comment_button_'+board_id).hide();
			$('a#comment-individual-'+board_id).hide();
			$('a#uncomment-individual-'+board_id).show();
			$('#board_'+board_id).show();
                        colorboxResize();
	   }
		else
		{
		 	$(".enter_comm").hide();
			$('#board_'+board_id).empty();
			$('a#comment-individual-'+board_id).show();
			$('a#uncomment-individual-'+board_id).hide();
                        colorboxResize();

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