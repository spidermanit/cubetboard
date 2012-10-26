<script type="text/javascript">
function handleDesc(type)
{   if(type=='showdiv')
    $('.descriptionText').show('slow');
    if(type=='clear')
    {
         $('textarea#des_textarea').val('');
    }
    if(type=='submit')
    {     if($('textarea#des_textarea').val()=='')
          {
              $('textarea#des_textarea').val('Please provide a value');
              //$('textarea#des_textarea').css({ 'color': 'red'});
          }
          else{
              dataString = 'desc='+$('textarea#des_textarea').val();
              $.ajax({
                        url: "<?php echo site_url('editprofile/addDesc');?>",
                        type: "POST",
                        data: dataString,
                        dataType: 'json',
                        cache: false,
                        success: function (data) {
                            $('input#description_button').hide('slow');
                            $('.descriptionText').hide('slow');
                            //alert(data);
                            $('#desc_div').html(data);
                        }
               });
          }
    }
    if(type=='cancel')
    {
        $('.descriptionText').hide('slow');
    }
        
}

</script>
<div class="white_strip"></div>
<div class="banner_bg"><!-- starting bganner bg -->
    <div class="container"><!-- starting container -->
        <div class="banner-white-bg">
            <div class="banner_bluebg_left">
            <div class="profile_image"><img src="<?php echo $userDetails['image']; ?>?type=large" alt="Profile Picture of <?php echo $userDetails['name']; ?>" width="183" height="189" /></div>
            </div>
            <div class="banner_bluebg_right">
                <div class="profile-details-wrap">
                    <div class="prof-details-left-wrap">
                        <h1><?php echo $userDetails['name']; ?></h1>
                        <p><?php echo $userDetails['description']; ?></p>
                    </div>
                    <div class="prof-details-right-wrap">
                        <div class="pinit_button">
                            <!--<a onclick="alert('Drag me to the bookarks bar'); return false;" href="javascript:(function(){var%20s%20=%20document.createElement('script');s.src%20=%20'http://staging.cubettech.com/ci/pinterest/application/scripts/extractor.js';document.body.appendChild(s);})();">Pin it</a>-->
                            <a onclick="alert('Drag me to the bookarks bar'); return false;" href="javascript:(function(){var%20s%20=%20document.createElement('script');s.src%20=%20'<?php echo site_url()?>application/scripts/extractor.js';document.body.appendChild(s);})();">Pin it</a>
                            <span class="pinit-button-icon"></span>
                        </div>
                    </div>
                <div class="profile-details-buttonbox">
                    <?php $count=0;?>
                    <?php $board = getUserBoard($userDetails['userId']);?>


                    <?php if(is_array($board)):?>
                     <?php  $boardCount = count($board);?>
                        <?php foreach($board as $key=>$value):?>
                            <?php
                            $boardPin = getEachBoardPins($value->id);
                                $count = $count + count($boardPin);
                            ?>
                         <?php endforeach?>
                     <?php endif?>

                    <ul class="pro-details-bottons">
                        <li><div class="pro-blue-button"><a href="<?php echo site_url('/board/boardView/'.$id)?>"><?php echo $boardCount;?> Boards</a></div></li>
                        <li><div class="pro-blue-button"><a href="<?php echo site_url('/pins/index/'.$id)?>"><?php echo $count;?> Pins</a></div></li>
                        <?php $likeCount = pinLikes($userDetails['userId']);?>
                        <li><div class="pro-blue-button"><a href="<?php echo site_url('/like/index/'.$id)?>"><?php echo $likeCount;?> Likes</a></div></li>
                        <?php $activitycount = activityCount($id); ?>
                        <li><div class="pro-blue-button"><a href="<?php echo site_url('/activity/index/'.$id)?>"><?php echo $activitycount;?> Activities</a></div></li>
                        
                        <?php if($this->session->userdata('login_user_id')==$id):?>
                        <li><div class="edit-prof-button"><span class="edit-prof-icon"></span><a href="<?php echo site_url('editprofile')?>">Edit your profile</a></div></li>
                        <?php endif;?>
                    </ul>

                </div>
                </div>
            </div>

        </div>
    </div><!-- closing container -->

</div><!-- closing bganner bg -->
<div class="clear"></div>

<script type="text/javascript">
function followFn(type,id)
{   val = 'id='+id;
    if(type=='follow')
    {
        $.ajax({
	        url: baseUrl+"follow/all",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
                $('#follow_unfollow_'+id).hide();
                $('#ajax_unfollow_btn_'+id).show();
                $('#ajax_follow_btn_'+id).hide();
                count = $('#followers_count').html();
                count = parseInt(count) + parseInt(1);
                $('#followers_count').html(count);
                //alert(count)

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
                $('#follow_unfollow_'+id).hide();
                $('#ajax_follow_btn_'+id).show();
                $('#ajax_unfollow_btn_'+id).hide();
                count = $('#followers_count').html();
                count = parseInt(count) - parseInt(1);
                $('#followers_count').html(count);
                //alert(count)
            }
            })

    }

}
</script>