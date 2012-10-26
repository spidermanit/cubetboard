<div id="top"</div>
<div class="white_strip"></div>
<div class="middle-banner_bg"><!-- staing middlebanner -->
<div class="info_bar">
    <div class="left">
        <div class="right">
            <div class="mid">
                <div id="info"><label>
                        <?php if($searchItem !=''):?>
                        <h3>Search result for <?php echo $searchItem;?></h3>
                        <?php else:?>
                        <h3>Open search</h3>
                        <?php endif;?>

                    </label></div>
                <div id="info_center">
                    <h3>Filter the search by</h3>
                    <a href="<?php echo site_url('search/filter/pin/'.$searchItem)?>">Pins</a> | <a style="color:#CB2027;">Board</a> | <a href="<?php echo site_url('search/filter/user/'.$searchItem)?>">People</a>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="container">
                        <?php $board = $result;?>

                            <?php if(is_array($board)):?>
                                <?php foreach($board as $key=>$value):?>
                                    <div class="search_board">
                                        <div class="pinBoard" style="margin-right: 15px;">
                                            <div class="pin_inner_container">
                                                <div class="name-container">
                                                    <p class="name"><?php echo $value->board_name?></p>
                                                    <span class="pin_no">
                                                    <p>
                                                        <?php
                                                        $content    = getEachBoardPins($value->id,$limit=4);
                                                        $allcontent = getEachBoardPins($value->id);
                                                        if(!empty($allcontent)){
                                                           //get pins in array
                                                            //$content = explode(',', $value->content);
                                                            echo count($allcontent).' pins';
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

                                                <a href="<?php echo site_url() ?>board/index/<?php echo $value->id?>" class="link">
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
                                                                     <?php if($pinValue->type=='video'):?>
                                                                        <div class="video"></div>
                                                                    <?php endif;?>
                                                                    <img src="<?php echo $pinValue->pin_url;?>" style="width: 195px;height: 130px;"/>
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
                                                    <?php $userDetails = userDetails($value->user_id);?>
                                                    <span class="board_user">
                                                        <a  href="<?php echo site_url('user/index/'.$value->user_id)?>"><img src="<?php echo $userDetails['image'];?>" width="35px" height="35px"/></a>
                                                   </span>
                                                    <?php if($this->session->userdata('login_user_id')==$value->user_id):?>
                                                            <a href="<?php echo site_url('board/edit/'.$value->id)?>">Edit</a>
                                                     <?php else:?>
                                                        <?php $id_ref =$value->id;?>
                                                            <div id="follow_unfollow_<?php echo $id_ref;?>">
                                                            <?php if(!isFollowAll($value->user_id)):?>
                                                                <a id="follow_btn_<?php echo $id_ref;?>" onclick="follow_unfollow('follow',<?php echo $id_ref;?>,<?php echo $value->user_id;?>);" class="Button13 Button RedButton followuserbutton" style="cursor: pointer;"><strong >Follow</strong><span></span></a>
                                                            <?php else:?>
                                                                <a id="unfollow_btn_<?php echo $id_ref;?>" onclick="follow_unfollow('unfollow',<?php echo $id_ref;?>,<?php echo $value->user_id;?>);" class="Button13 Button RedButton followuserbutton" style="cursor: pointer;"><strong>Unfollow</strong><span></span></a>
                                                            <?php endif?>
                                                            </div>

                                                            <span id="ajax_follow_btn_<?php echo $id_ref;?>" style="display: none;cursor: pointer;"><a onclick="follow_unfollow('follow',<?php echo $id_ref;?>,<?php echo $value->user_id;?>);" class="Button13 Button RedButton followuserbutton"><strong>Follow</strong><span></span></a></span>
                                                            <span id="ajax_unfollow_btn_<?php echo $id_ref;?>" style="display: none;cursor: pointer;"><a onclick="follow_unfollow('unfollow',<?php echo $id_ref;?>,<?php echo $value->user_id;?>);" class="Button13 Button RedButton followuserbutton"><strong>Unfollow</strong><span></span></a></span>
                                                     <?php endif;?>
                                                     
                                                     
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                                    <?php else:?>
            <div class="alert_messgae">
                <h2 style="margin-left:96px;">No items found</h2>
            </div>
                            <?php endif;?>
    </div>
</div>
<?php $this->load->view('footer');?>
</body>
</html>
<div class="scroll_top" style="display: none;">
	<a href="#top">Back to Top</a>
</div>
<script type="text/javascript">

$(function() {
	$(window).scroll(function() {
		if($(this).scrollTop() != 0) {
			$('.scroll_top').fadeIn();
		} else {
			$('.scroll_top').fadeOut();
		}
	});
});
</script>
<script type="text/javascript">
function follow_unfollow(type,id,user_id)
{

    val = 'is_following_board_id='+id+'&is_following='+user_id+'&action='+type;
    //alert(val)
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