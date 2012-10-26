<?php $this->load->view('header');?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
<?php $this->load->view('popup_js');?>
<?php $this->load->view('profile_header');?>
<div class="clear"></div>

<div class="middle-banner_bg"><!-- staing middlebanner -->
    <div class="container"><!-- staing container -->
        
        <div class="middle-banner_wrap_left">

            <!-- Latest feeds from friends-->
            <?php if($this->session->userdata('login_user_id')==$id):?>
            <div class="latest-updates_heddbox">
                <span class="latest-updates_icon"></span>
                <h1>Latest updates</h1>
            </div>
           <div class="latest-updates_box" id="latest-updates_box">
                <ul class="latest-updates">
                    <?php $activityList = getFollowingsActivity($id,$limit=10);?>
                    <?php if(!empty($activityList)):?>
                        <?php foreach($activityList as $activityListKey=>$activityListValue):?>
                            <?php if( ($activityListValue->activity_type=='pin') || ($activityListValue->activity_type=='like') || ($activityListValue->activity_type=='repin')|| ($activityListValue->activity_type=='image')|| ($activityListValue->activity_type=='video')|| ($activityListValue->activity_type=='follow')|| ($activityListValue->activity_type=='follow_board')):?>
                                <?php $activityValue = getPinDetails($activityListValue->activity_action_id);?>
                                <?php if(($activityValue)):?>
                                    <?php $userDetails = userDetails($activityListValue->activity_user);?>
                                      <li>
                                          <?php if(($activityListValue->activity_type=='follow')):?>
                                            <a href="<?php echo site_url();?>user/index/<?php echo $activityListValue->activity_action_id?>">
                                          <?php elseif(($activityListValue->activity_type=='follow_board')):?>
                                            <a href="<?php echo site_url();?>board/index/<?php echo $activityListValue->activity_action_id?>">
                                          <?php else:?>
                                            <a href="<?php echo site_url();?>board/pins/<?php echo $activityValue->board_id?>/<?php echo $activityValue->id?>">
                                          <?php endif;?>
                                          
                                            
                                              <div class="latest-updates_content">
                                                <div class="latest-updates_thumb"><img src="<?php echo $userDetails['image'];?>" width="32" height="32" /></div>
                                                <div class="latest-upd-matter-box">
                                                    <p class="latest-upd-name"><?php echo $userDetails['name'].' '.$activityListValue->activity_log;?></p>
                                                    <p class="latest-upd-post">Posted on<span class="latest-upd-date"><?php echo $activityListValue->activity_timestamp;?></span></p>
                                                </div>
                                            </div>
                                          </a>
                                    </li>
                                 <?php endif;?>
                             <?php endif;?>
                         <?php endforeach;?>
                    <?php else:?>
                     <li>
                        <div class="latest-updates_content">
                            <p>No feeds available</p>
                        </div>
                    </li>
                    <?php endif;?>
                </ul>
            </div>
            <?php endif;?>

            <!--people following -->
            <div class="Following_heddbox">
                <span class="Following_icon"></span>
                <h1>Following</h1>
            </div>
            <div class="Following_box">
                <ul class="Following">
                    <?php $userFollows = getUserFollowing($id); ?>
                    <?php if(is_array($userFollows)):?>
                        <?php foreach($userFollows as $userFollowsKey=>$userFollowsValue):?>
                            <?php $userDetails  = userDetails($userFollowsValue->is_following);?>
                        <li>
                            <div class="following-content_box">
                                <div class="following_thumb"><a href="<?php echo site_url('user/index/'.$userDetails['userId']);?>"><img src="<?php echo $userDetails['image'];?>" width="32" height="32" /></a></div>
                                <div class="following-matter-box">
                                    <p><a href="<?php echo site_url('user/index/'.$userDetails['userId']);?>"><?php echo $userDetails['name'];?></a></p>
                                </div>
                            </div>
                        </li>
                        <?php endforeach;?>
                    <?php else:?>
                    <li>
                        <div class="following-content_box">
                            <p class="p_text">Not following any one</p>
                        </div>
                    </li>
                    <?php endif;?>
                </ul>
            </div>

            <!--people follows -->
            <div class="Following_heddbox">
                <span class="Followers_icon"></span>
                <h1>Followers</h1>
            </div>
            <div class="Following_box">
                <ul class="Following">
                    <?php $userFollows = getUserFollowers($id); ?>
                    <?php if(is_array($userFollows)):?>
                        <?php foreach($userFollows as $userFollowsKey=>$userFollowsValue):?>
                            <?php $userDetails  = userDetails($userFollowsValue->user_id);?>
                        <li>
                            <div class="following-content_box">
                                <div class="following_thumb"><a href="<?php echo site_url('user/index/'.$userDetails['userId']);?>"><img src="<?php echo $userDetails['image'];?>" width="32" height="32" /></a></div>
                                <div class="following-matter-box">
                                    <p><a href="<?php echo site_url('user/index/'.$userDetails['userId']);?>"><?php echo $userDetails['name'];?></a></p>
                                </div>
                            </div>
                        </li>
                        <?php endforeach;?>
                    <?php else:?>
                    <li>
                        <div class="following-content_box">
                                <p class="p_text">No followers</p>
                        </div>
                    </li>
                    <?php endif;?>
                </ul>
            </div>
        </div>

        <div class="middle-banner_wrap_right"><!-- starting middle-banner_wrap_right -->

            <!--News feeds/follow/unfollow/sort board buttons -->
            <div class="sortboard_box_right">
                <div class="sortboard_left-corn"></div>
                <div class="sortboard_right-corn">
                    <ul class="sortboard-button">
                        <?php if($this->session->userdata('login_user_id')==$id):?>
                            <li><div class="sortboard-blue-button"><a href="<?php echo site_url('activity/latestFeeds/'.$id)?>">New Feeds</a></div></li>
                            <li><span class="arrow"></span></li>
                         <?php endif;?>
                        <?php $userDetails = userDetails($id)?>
                        <?php $id_ref =$id;?>
                         <?php if($this->session->userdata('login_user_id')==$id):?>
                            <li id="rearrangeButton"><div class="sortboard-blue-button"><a  href="#" onclick="showSort();">Sort board</a></div></li>
                            <li id="button" style="display:none;margin-top: 0px;"><div class="sortboard-blue-button"><a  href="#" onclick="saveSort();">Save sort</a></div></li>
                            <li><span class="arrow"></span></li>
                         <?php else:?>
                            <li><span class="arrow"></span></li>
                            <?php if(!isFollowAll($id)):?>
                                <li id="follow_btn_<?php echo $id_ref;?>"><div class="sortboard-blue-button"><a onclick="followFn('follow',<?php echo $id_ref;?>);">Follow All</a></div></li>
                                <li id="loader" style="display:none;"><div class="sortboard-blue-loader"><img src="<?php echo site_url();?>/application/assets/images/admin/loading.gif"</div></li>
                            <?php else:?>
                                <li id="unfollow_btn_<?php echo $id_ref;?>"><div class="sortboard-blue-button"><a onclick="followFn('unfollow',<?php echo $id_ref;?>);">Unfollow All</a></div></li>
                                <li id="loader" style="display:none;"><div class="sortboard-blue-loader"><img src="<?php echo site_url();?>/application/assets/images/admin/loading.gif"</div></li>
                             <?php endif?>
                             <li id="ajax_follow_btn_<?php echo $id_ref;?>" style="display: none;"><div class="sortboard-blue-button"><a onclick="followFn('follow',<?php echo $id_ref;?>);">Follow All</a></div></li>
                             <li id="ajax_unfollow_btn_<?php echo $id_ref;?>" style="display: none;"><div class="sortboard-blue-button"><a onclick="followFn('unfollow',<?php echo $id_ref;?>);">Unfollow All</a></div></li>
                             <li id="loader" style="display:none;"><div class="sortboard-blue-loader"><img src="<?php echo site_url();?>/application/assets/images/admin/loading.gif"</div></li>
                             <li><span class="arrow"></span></li>
                         <?php endif;?>

                        <li><div class="sortboard-blue-button"><a  href="<?php echo site_url('follow/followers/'.$id);?>" title="The people who watch <?php echo $userDetails['name'];?>'s status"><strong id="followers_count_<?php echo $id_ref;?>"><?php echo getUserFollowersCount($id);?></strong> Followers</a></div></li>
                        <li><span class="arrow"></span></li>
                        <li><div class="sortboard-blue-button"><a  href="<?php echo site_url('follow/following/'.$id);?>" title="The people <?php echo $userDetails['name'];?> is watching"><strong id="following_count_<?php echo $id_ref;?>"><?php echo getUserFollowingCount($id);?></strong> Following</a></div></li>
                    </ul>
                </div>
            </div>

            <div class="ColumnContainer">

                <!--Rearrange board text-->
                <div id="SortableButtons" style="margin-right: 250px;display:none">
                    <h2 class="colorless">Rearrange Boards</h2>
                    <h3 class="colorless">Drag around your boards to reorder them.</h3>

                </div>

                <!-- Board display-->
                <ul class="pin-box" id="categoryorder">

                    <?php $board = getUserBoard($id);?>
                        <?php if(is_array($board)):?>
                            <?php foreach($board as $key=>$value):?>
                                 <li id="ID_<?php echo $value->id; ?>" class="move">
                                    <div class="pinBoard">
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
                                                                    <a href="<?php echo site_url() ?>board/index/<?php echo $value->id?>">
                                                                     <?php if($pinValue->type=='video'):?>
                                                                        <div class="video"></div>
                                                                    <?php endif;?>
                                                                    <img src="<?php echo $pinValue->pin_url;?>" style="width: 195px;height: 130px;"/>
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

                                                                        <li>
                                                                            <span class="cover-thumbs-pic">
                                                                                <?php if($pinValue->type=='video'):?>
                                                                                    <div class="video_small"></div>
                                                                                <?php endif?>
                                                                                <img src="<?php echo $pinValue->pin_url;?>" alt="Photo of a pin" width="64" height="74"/>
                                                                            </span>
                                                                        </li>
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
                                                        <?php if(!isFollow($this->session->userdata('login_user_id'),$value->id)):?>
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
                                </li>
                            <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </div>
            </div><!-- closing middle-banner_wrap_right -->
        </div><!-- closing container -->
    </div><!-- closing middlebanner -->

<script type="text/javascript">
function showSort()
{
$("ul#categoryorder").sortable("enable");
$("ul#categoryorder").sortable({
	opacity: 0.6,
	cursor: 'move',
	scrollSensitivity: 40,
    start: '#categoryorder',
	update: function(){$('#message').html('Changes not saved');
	}
});
$('#button').click(function(event){
	var order = $("ul#categoryorder").sortable("serialize");
	$('#message').html('Saving changes..');
	$.post(baseUrl+"board/rearrange",order,function(theResponse){
			$('#message').html(theResponse);
			});
	event.preventDefault();
});
 $('#SortableButtons').show('slow');
 $('#rearrangeButton').hide('slow');
 $('#button').show('slow');


 //$('.sortable').attr('id', 'categoryorder');


}
function saveSort()
{
 $("ul#categoryorder").sortable("disable");
 $('#SortableButtons').hide('slow');
 $('#rearrangeButton').show('slow');
 $('#button').hide('slow');

 //$('.sortable').removeAttr("id");
}
</script>
<script type="text/javascript">
function followFn(type,id)
{
    val = 'id='+id;
    if(type=='follow')
    {
        $('#follow_btn_'+id).hide();
        $('#ajax_follow_btn_'+id).hide();
        $('#loader').show();
        $.ajax({
	        url: baseUrl+"follow/all",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
                $('#loader').hide();

                $("a[id^='follow_btn_']").hide();
               ("a[id^='unfollow_btn_']").hide();

                $("span[id^='ajax_follow_btn_']").hide();
                $("span[id^='ajax_unfollow_btn_']").show();

                $('#ajax_unfollow_btn_'+id).show();
                count = $('#followers_count_'+id).html();
                count = parseInt(count) + parseInt(1);
                $('#followers_count_'+id).html(count);
                
            }
            })

    }
    else{
        $('#unfollow_btn_'+id).hide();
        $('#ajax_unfollow_btn_'+id).hide();
        $('#loader').show();
        $.ajax({
	        url: baseUrl+"follow/unFollowAll",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
                $('#loader').hide();

                
                $("a[id^='unfollow_btn_']").hide();
                $("a[id^='follow_btn_']").hide();

                $("span[id^='ajax_follow_btn_']").show();
                $("span[id^='ajax_unfollow_btn_']").hide();


                $('#ajax_follow_btn_'+id).show();
                count = $('#followers_count_'+id).html();
                count = parseInt(count) - parseInt(1);
                $('#followers_count_'+id).html(count);
               
            }
            })

    }

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
<?php $this->load->view('footer'); ?>
</body>
</html>