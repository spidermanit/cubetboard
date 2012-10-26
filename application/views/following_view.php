<?php $this->load->view('header');?>
<script type="text/javascript">
function followingFn(type,id)
{
    val = 'id='+id;
    if(type=='follow')
    {   
        $.ajax({
	        url: baseUrl+"follow/all",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
                $('#follow_btn_'+id).hide();
                $('#ajax_unfollow_btn_'+id).show();
                $('#ajax_follow_btn_'+id).hide();
                count = $('#following_count_'+id).html();
                count = parseInt(count) + parseInt(1);
                $('#following_count_'+id).html(count);
               
            }
            })
    }
    else{
        $.ajax({
	        url: baseUrl+"follow/unFollowAll",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
                $('#unfollow_btn_'+id).hide();
                $('#ajax_follow_btn_'+id).show();
                $('#ajax_unfollow_btn_'+id).hide();
                count = $('#following_count_').html();
                count = parseInt(count) - parseInt(1);
                $('#following_count_').html(count);
               
            }
            })
    }
}
</script>

<div class="white_strip"></div>
<div class="middle-banner_bg">

     <!-- Display the information about the page-->
    <div class="info_bar">
        <div class="left">
            <div class="right">
                <?php $userDetails = userDetails($id)?>
                <div class="mid">
                    <div id="image"> <label><img src="<?php echo $userDetails['image']?>" width="50px" height="50px"></label></div>
                    <div id="info"><label>people, <?php echo $userDetails['name'] ?> is following</label></div>
                </div>
            </div>
        </div>
    </div>

    <?php $userFollows = getUserFollowing($id); ?>


    <div id="Container" style="margin-left: 250px;">
        <div id="alpha" class="container Mcenter clearfix transitions-enabled">
            <?php if(is_array($userFollows)):?>
                <?php foreach($userFollows as $userFollowsKey=>$userFollowsValue):?>
                    <?php $userDetails  = userDetails($userFollowsValue->is_following);?>
                    <?php $pinCount     = getAllPins($userFollowsValue->is_following);?>

                    <div class="pin_item">

                        <!--Follow/un follow button -->
                        <?php $id_ref =$userFollowsValue->is_following;?>
                        <div id="follow_unfollow_<?php echo $id_ref;?>" class="follow_unfollow">
                        <?php if($this->session->userdata('login_user_id')!=$id):?>
                            <?php if(!isFollowAll($userFollowsValue->is_following)):?>
                                <?php if($userFollowsValue->is_following!=$this->session->userdata('login_user_id')):?>
                                    <a id="follow_btn_<?php echo $id_ref;?>" onclick="followingFn('follow',<?php echo $id_ref;?>);" class="Button2 Button13 WhiteButton"><strong>Follow All</strong><span></span></a>
                                 <?php endif?>
                            <?php else:?>
                                <a id="unfollow_btn_<?php echo $id_ref;?>" onclick="followingFn('unfollow',<?php echo $id_ref;?>);" class="Button2 Button13 WhiteButton"><strong>Un follow All</strong><span></span></a>
                            <?php endif?>
                        <?php endif?>
                        </div>
                        <div class="follow_unfollow">
                            <span id="ajax_follow_btn_<?php echo $id_ref;?>" style="display: none;"><a onclick="followingFn('follow',<?php echo $id_ref;?>);" class="Button2 Button13 WhiteButton"><strong>Follow All</strong><span></span></a></span>
                            <span id="ajax_unfollow_btn_<?php echo $id_ref;?>" style="display: none;"><a onclick="followingFn('unfollow',<?php echo $id_ref;?>);" class="Button2 Button13 WhiteButton"><strong>Un follow All</strong><span></span></a></span>
                        </div>

                        <!--user image -->
                        <div class="pin_img">
                            <a href="<?php echo site_url()?>user/index/<?php echo $userFollowsValue->is_following;?>" class="fancyboxForm1"><img src="<?php echo $userDetails['image'].'?type=large';?>"  style="width: 180px;height: 135px;"/></a>
                        </div>

                        <!--like/comment/repins/followers/following counts -->
                        <div class="comm_des">
                            <p class="des"><?php echo $userDetails['name'];?></p>
                            <p class="comm_like">
                                <span><a href="<?php echo site_url('pins/index/'.$userFollowsValue->is_following);?>" title="pins of <?php echo $userDetails['name'];?>"><?php echo count($pinCount)?> pins</a></span>
                                <span><a href="<?php echo site_url('like/index/'.$userFollowsValue->is_following);?>" title="pins liked by <?php echo $userDetails['name'];?>"><?php echo pinLikes($userFollowsValue->is_following)?> Likes</a></span>
                                <span><a href="<?php echo site_url('activity/index/'.$userFollowsValue->is_following);?>" title="activities of <?php echo $userDetails['name'];?>"><?php echo activityCount($userFollowsValue->is_following)?> Activities</a></span>
                            </p>
                            <p class="comm_like">
                                <span><a href="<?php echo site_url('follow/followers/'.$userFollowsValue->is_following);?>" title="followers of <?php echo $userDetails['name'];?>"><strong id="followers_count_<?php echo $id_ref;?>"><?php echo getUserFollowersCount($userFollowsValue->is_following)?></strong> Followers</a></span>
                                <span><a href="<?php echo site_url('follow/following/'.$userFollowsValue->is_following);?>" title="<?php echo $userDetails['name'];?> following"><strong id="following_count_<?php echo $id_ref;?>"><?php echo getUserFollowingCount($userFollowsValue->is_following)?></strong> Following</a></span>
                            </p>
                        </div>

                          <!--Display some pins of that user-->
                        <div class="convo_blk attribution">
                            <?php $i=0;?>
                            <?php if(is_array($pinCount)):?>
                                <?php foreach ($pinCount as $key => $value):?>
                                     <?php if($i<=9):?>
                                     <span style="width:36px;height:36px"><img src='<?php echo $value->pin_url;?>' style="width:36px;height:36px;"/></span>
                                     <?php endif;?>
                                     <?php $i++;?>
                                 <?php endforeach;?>
                             <?php endif;?>
                        </div>

                    </div>
                <?php endforeach;?>
            <?php else:?>
                <div class="alert_messgae">
                    <h2><?php echo $userDetails['name'] ?> is not following any one</h2>
                </div>
            <?php endif?>
        </div> <!-- #alpha -->
    </div>
</div>
<?php $this->load->view('footer');?>
</body>
</html>
<div class="scroll_top">
	<a href="#top">Back to Top</a>
</div>