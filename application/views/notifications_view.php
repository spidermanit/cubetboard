<?php $this->load->view('header');?>
<link href="<?php echo base_url(); ?>application/assets/css/style.css" rel="stylesheet" type="text/css" />
<div class="white_strip"></div>
<div class="middle-banner_bg"><!-- staing middlebanner -->
<div id="message_added"></div>
    <div class="FixedContainer">
        <form id="profileEdit" class="Form StaticForm" method="post" action="<?php echo site_url('notifications/save');?>" accept-charset="utf-8">
            <div class="editprofile_insidebox">
            <h3>Email Settings</h3>
            <ul>
                <li>
                    <label>Email</label>
                    <div class="Right NoInput">
                        <?php echo $email;?>&nbsp;&middot;&nbsp;<a class="user_edit" href="/ci/pinterest/editprofile">Change Email</a>
                    </div>
                </li>
                <li>
                    <label for="id_email_notification">All</label>
                    <div class="Right NoInput">
                        <label><input <?php echo $all; ?> type="checkbox" name="all" id="id_email_notification" /> Any email</label>
                    </div>
                </li>
                <li>
                    <label for="id_email_collaboration">Group Pins</label>
                    <div class="Right NoInput">
                        <label><input <?php echo $group_pins; ?> type="checkbox" name="group_pins" id="id_email_collaboration" /> When a new pin is added to a group board</label>
                    </div>
                </li>
                <li>
                    <label for="id_email_comments">Comments</label>
                    <div class="Right NoInput">
                        <label><input <?php echo $comments; ?> type="checkbox" name="comments" id="id_email_comments" /> When someone comments on your pin</label>
                    </div>
                </li>
                <li>
                    <label for="id_email_likes">Likes</label>
                    <div class="Right NoInput">
                        <label><input <?php echo $likes; ?> type="checkbox" name="likes" id="id_email_likes" /> When someone likes your pin</label>
                    </div>
                </li>
                <li>
                    <label for="id_email_repins">Repins</label>
                    <div class="Right NoInput">
                        <label><input <?php echo $repins ?> type="checkbox" name="repins" id="id_email_repins" /> When your pin is repinned</label>
                    </div>
                </li>
                <li>
                    <label for="id_email_follows">Follows</label>
                    <div class="Right NoInput">
                        <label><input <?php echo $follows; ?> type="checkbox" name="follows" id="id_email_follows" /> When a new person follows you</label>
                    </div>
                </li>

                
                <li>
                    <label>Frequency</label>
                    <div class="Right NoInput" style="padding-bottom:0;">
                        <label id="radio" style="padding-bottom: 0;">
                            <span style="display: block; margin-bottom: 8px;">How often you receive emails about likes, repins, &amp; follows:</span>
                            
                                <label for="id_email_interval_0">
                                    <input <?php echo $frequency_1; ?> type="radio" id="id_email_interval_0" value="1" name="frequency" /> Immediately
                                </label>
                           
                           
                                <label for="id_email_interval_1">
                                    <input <?php echo $frequency_2; ?>  type="radio" id="id_email_interval_1" value="2" name="frequency" /> Once Daily
                                </label>

                           
                        </label>
                    </div>
                </li>


                <li>
                    <label for="id_email_digest">Digest</label>
                    <div class="Right NoInput">
                        <label><input <?php echo $digest; ?> type="checkbox" name="digest" id="id_email_digest" /> Emails summarizing your weekly activity</label>

                    </div>
                </li>

                <li>
                    <label for="id_email_news">News</label>
                    <div class="Right NoInput">
                        <label><input <?php echo $news; ?> type="checkbox" name="news" id="id_email_news" /> Occasional Pinterest news and updates</label>
                    </div>
                </li>

            </ul>

            <div style='display:none'><input type='hidden' name='csrfmiddlewaretoken' value='c3162537217e8e024bcec791f154a26a' /></div>
              <div style='display:none'><input type='hidden' name='email' value='<?php echo $email;?>' /></div>
            <!-- Button -->
            <div class="Submit">
                <input type="submit" name="submit" value="Save Settings" class="Button2 Button13 WhiteButton" />
<!--                <a href="#" class="Button RedButton Button24" onclick="emailSettings()"><strong>Save Settings</strong><span></span></a>-->


            </div>
            </div>
        </form>
    </div><!-- .FixedContainer -->
</div>
<?php $this->load->view('footer');?>
<script language="javascript" type="text/javascript">
    function emailSettings()
    {
         dataString = $("#profileEdit").serialize();
         //alert(dataString)
         return false;
         //send ajax form submit
      $.ajax({
            //this is the php file that processes the data and send mail
            url: "/ci/pinterest/notifications/save/",
            //POST method is used
            type: "POST",
            //pass the data
            data: dataString,
            dataType: 'json',
            //Do not cache the page
            cache: false,
            //success
            success: function (data) {
                if(data){
                    $('#message_added').html(" submitted successfully!") ;
                 }
                else
                  $('#message_added').html("Error occured!") ;
                setTimeout(function() {
                    $('#message_added').fadeOut("slow");
                }, 1000);
            }
    });
    }
    </script>

    
</html>