<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php if($this->session->userdata('login_user_id')):?>
        <?php $loggedUserDetails = userDetails();?>
    <?php endif;?>
    <title><?php echo (isset($title))?$title:'Cubetboard ';?></title>

    <!-- For facebook like button-og meta tags -->
    <?php if((isset($pinId))&&(isset($boardId))):?>
        <?php $pinDetails = getPinDetails($pinId,$boardId)?>
        <?php if(!empty($pinDetails)):?>
            <meta property="og:title" content="<?php echo $pinDetails->description;?>"/>
            <meta property="og:image" content="<?php echo $pinDetails->pin_url;?>"/>
            <meta property="og:site_name" content="Cubetboard"/>
            <meta property="og:type" content="album"/>
            <meta property="og:url" content="<?php echo current_url();?>"/>
            <meta property="og:description" content="<?php echo $pinDetails->description;?>"/>
            <meta property="fb:app_id" content="<?php echo  $this->config->item('facebook_app_id')?>"/>
        <?php endif;?>
        <?php else:?>
             <meta property="og:title" content="Cubetboard"/>
            <meta property="og:image" content="<?php echo site_url('application/assets/images/logo_big.png');?>"/>
            <meta property="og:site_name" content="Pinterest"/>
            <meta property="og:type" content="album"/>
            <meta property="og:url" content="<?php echo current_url();?>"/>
            <meta property="og:description" content="Cubetboard "/>
            <meta property="fb:app_id" content="<?php echo  $this->config->item('facebook_app_id')?>"/>
    <?php endif;?>
    <!--[if IE]>
     <style>
        .form-field-input , .header_links-box,.nav ul , .pinit_button , .pro-blue-button , .edit-prof-button , .banner-white-bg , .banner_bluebg_left , .banner_bluebg_right, .latest-updates_heddbox , .latest-updates_box, .Following_heddbox , .Following_box , .profile_image , .sortboard_right-corn , .pin_no , .sortboard-blue-button , .editprofile_insidebox , .pin_item , .action , .buttonLogin , .info_bar , .popup_login  .more {
                     behavior: url(<?php echo base_url(); ?>application/assets/css/PIE.htc);
     }
     </style>
     <![endif]-->

    <link rel="icon" href="<?php echo base_url(); ?>application/assets/images/favicon.ico" type="image/x-icon" />
    <link href="<?php echo base_url(); ?>application/assets/css/cubetboard.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>application/assets/css/style1.css" rel="stylesheet" type="text/css" />

    <script src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.2.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>application/scripts/jquery-ui-1.8.1.custom.min.js" type="text/javascript"></script>
    <script type="text/javascript">if (window.location.hash == '#_=_')window.location.hash = '';</script>

    <?php if($this->session->userdata('login_user_id')):?>
    <script type="text/javascript">
        var baseUrl = '<?php echo base_url() ?>';
        var logName = '<?php echo $loggedUserDetails['name'] ?>';
        var logImage = '<?php echo $loggedUserDetails['image'] ?>';
        var logId = '<?php echo $loggedUserDetails['userId'] ?>';
    </script>
    <?php endif;?>


    <script src="<?php echo base_url(); ?>application/scripts/pinterest_clone.js" type="text/javascript" ></script>

    <script src="<?php echo base_url(); ?>application/scripts/jquery.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>application/src/facebox.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
          $('a[rel*=facebox]').facebox({
            loadingImage : '<?php echo base_url(); ?>application/src/loading.gif',
            closeImage   : '<?php echo base_url(); ?>application/src/closelabel.png'
          })
        })
    </script>

    <script src="<?php echo base_url(); ?>application/scripts/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>application/scripts/jquery/jquery-1.7.1.min.js"></script>
    <script src="<?php echo base_url(); ?>application/scripts/jquery/jquery.cog.infi.min.js"></script>
    <script src="<?php echo base_url(); ?>application/scripts/jquery/jquery.livequery.js"></script>
    <script src="<?php echo base_url(); ?>application/scripts/jquery/jquery.cog.mass.min.js"></script>

     <!--facebox  -->
    <link href="<?php echo base_url(); ?>application/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>application/assets/css/example.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
  app_id   = '<?php echo $this->config->item('facebook_app_id');?>';
  FB.init({
    //appId  : '399160855575',
     appId    : app_id,
    frictionlessRequests:true
  });

  function sendRequestToRecipients() {
    var user_ids = document.getElementsByName("user_ids")[0].value;
    FB.ui({method: 'apprequests',
      message: 'My Great Request',
      to: user_ids
    }, requestCallback);
  }

  function sendRequestViaMultiFriendSelector() {
   inviting = '<?php echo $inviting_user.'/'.base64_encode(time());?>'
    FB.ui({
        method:'send',
        name: 'Cubetboard',
        link: baseUrl+'fb/invite/'+inviting
      });
       /*
    FB.ui({
        method: 'apprequests',
        name: 'Pinterest clone',
        message: 'My Great Request'
        }, requestCallback);
    */
   //Step2 of inviting user. (step 1 in invite controller)
   //encode the inviting user fb id and current time stamp and pass the request.
   //step3 is in invite fb controller invite function
  }

  function requestCallback(response) {
      //alert("myObject is " + response.toSource());
      var output = '';
        for (property in response) {
            //output += property + ': ' + response[property]+'; ';
            if(property=='to')
            {
                output = response[property]
                //alert(output);
                insertInvitedId(output);

            }

        }
    // Handle callback here
  }
  function insertInvitedId(id)
  {   dataString = 'ids='+id;
      $.ajax({
        url: "<?php echo site_url('login/insertInvitedId');?>",
        type: "POST",
        data: dataString,
        dataType: 'json',
        cache: false,
        success: function (data) {
        //alert(data);

    }
    });
  }
</script>
<link href="<?php echo base_url(); ?>application/assets/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    function invite()
    {
        dataString = $("#invite_form").serialize();
        var email1                 = $("input#email1").val();
        var email2                 = $("input#email2").val();
        var email3                 = $("input#email3").val();
        var email4                 = $("input#email4").val();
        $('#error').html("") ;
        if((email1=='')&&(email2=='')&&(email3=='')&&(email4==''))
        {
                $('#error').html("Please provide atleast one email!") ;
                return false;
        }
        $("#loading").show();
        $.ajax({
            //this is the php file that processes the data and send mail
            url: "<?php echo site_url('/invite/submit/');?>/",
            //POST method is used
            type: "POST",
            //pass the data
            data: dataString,
            dataType: 'json',
            //Do not cache the page
            cache: false,
            //success
            success: function (data) {
                //if success, show success message, hide errors and reset form
                $("#message_added").show();
                if(data){
                    $("#loading").hide();
                    $('#message_added').html("invited successfully!") ;
                    $('.error').html("")
                    document.getElementById('invite_form').reset()
                 }
                else
                  $('#message_added').html("Error occured!") ;
                 //hide the success message after 3 secs
                 setTimeout(function() {
                    $('#message_added').fadeOut("slow");
                }, 5000);
            }
    });
    }

</script>


</head>


<body>
    <!-- TOP NAVIGATION-->
    <!--TOP NAVIGATION ENDS HERE -->
    <div class="outer">
        <div class="header_home"><!-- starting Header -->
            <div class="container"><!-- starting container -->
                <div class="header_box">


                    <!--Search box-->
                    <?php if($this->session->userdata('login_user_id')):?>
                    <div class="search_box">
                        <form action="<?php echo site_url('search/filter')?>" method="post">
        <!--                    search by
                            <select name="filter">
                                <option>pins</option>
                                <option>boards</option>
                                <option>users</option>
                            </select>-->
        <!--                    <a id="query_button" href="#" class="lg"><img src="https://a248.e.akamai.net/passets.pinterest.com.s3.amazonaws.com/images/search.gif" alt="" /></a>-->
                            <input name="q" type="text" class="form-field-input" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value="Search...."/>

                            <input name="Search" class="search_button" type="submit" src="images/search_icon.png" value=""/>
                        </form>
                    </div>
                    <?php endif;?>


                    <div class="logo" style="margin-right: 47px;"><a href="<?php echo site_url();?>"><img src="<?php echo site_url()?>/application/assets/images/cubetboard/logo.png"/></a></div>

                    <!--Login button -->
                    <?php if(!$this->session->userdata('login_user_id')):?>
                        <span class="buttonLogin">
                            <a href="<?php echo site_url();?>login/handleLogin">Login</a>
                        </span>
                    <?php endif;?>

                    <?php if(!$this->session->userdata('login_user_id')):?>
                        <?php $style ="style='width:325px'";?>
                    <?php else:?>
                        <?php $style ="";?>
                    <?php endif;?>

                    <?php $this->load->view('popup_js');?>
                    <div class="header_links-box" <?php echo $style;?>>
                        <ul class="nav">
                            <!-- Menu if not login -->
                            <?php if(!$this->session->userdata('login_user_id')):?>
                                <li>
                                    <a href="<?php echo site_url('welcome/index')?>">Everything</a></li>
                                <li>
                                    <a href="<?php echo site_url('welcome/mostLiked')?>">Most Liked</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('welcome/mostRepinned')?>">Most Repined</a>
                                </li>
                             <?php endif;?>

                            <!-- Menu if  login -->
                            <?php if($this->session->userdata('login_user_id')):?>
                                <li>
                                    <a class="nav-about" href="<?php echo site_url('welcome/index')?>">Home</a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo site_url('welcome/mostLiked')?>">Most Liked</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('welcome/mostRepinned')?>">Most Repinned</a>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('pins/videos')?>">Videos</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('gift/index/0/100')?>">Gifts</a>
                                    <ul>
                                        <li><a href="<?php echo site_url('gift/index/0/100')?>">$0 - $100</a></li>
                                        <li><a href="<?php echo site_url('gift/index/100/500')?>">$100 - $500</a></li>
                                        <li><a class="divider" href="<?php echo site_url('gift/index/500/1000')?>">$500 - $1000</a></li>
                                        <li><a href="<?php echo site_url('gift/index/1000/10000')?>">$1000 - $10000</a></li>
                                        <li><a href="<?php echo site_url('gift/index/10000/50000')?>">$10000 - $50000</a></li>
                                        <li><a class="divider" href="<?php echo site_url('gift/index/50000/100000')?>">$50000 - $100000</a></li>
                                        <li><a href="<?php echo site_url('gift/index/100000/above')?>">$100000 above</a></li>
                                    </ul>
                                </li>
                            <li>
                                <a class="nav-add" href="#">Add</a>
                                <ul>
                                    <li><a href="<?php echo site_url('board/add')?>" class="ajax" >New board</a></li>
                                    <li class="beforeDivider"><a href="<?php echo site_url('pins/uploadPins')?>" class="ajax" >Upload a pin</a></li>
                                </ul>
                            </li>

<!--                        <li>
                                <a class="nav-about" href="<?php //echo site_url();?>welcome/underconstruction">About</a>
                                <ul>
                                    <li><a href="<?php //echo site_url();?>welcome/underconstruction">Help</a></li>
                                    <li><a href="<?php //echo site_url();?>welcome/underconstruction">Pin it button</a></li>
                                    <li><a href="<?php //echo site_url();?>welcome/underconstruction">Team</a></li>
                                    <li><a href="<?php //echo site_url();?>welcome/underconstruction">Blog</a></li>

                                </ul>
                            </li>-->

                            <li class="float-right">
                                <span class="profile-thumb-nav">
                                    <a href="<?php echo site_url('user/index/'.$loggedUserDetails['userId']);?>"><img src="<?php echo $loggedUserDetails['image']; ?>?type=large" alt="Profile Picture of <?php echo $loggedUserDetails['name']; ?>" width="24" height="24" />
                                    </a>
                                </span>
                            </li>
                            <a href="<?php echo site_url('user/index/'.$loggedUserDetails['userId']);?>"><?php $first_name = explode(' ', $loggedUserDetails['name']);?></a>
                            <li>
                                <a class="nav-about" href="<?php echo site_url('user/index/'.$loggedUserDetails['userId']);?>"><?php echo $first_name[0]; ?></a>
                                <ul>
                                    <li><a href="<?php echo site_url()?>invite">Invite Friends</a></li>
<!--                                    <li class="beforeDivider"><a href="<?php //echo site_url()?>invite">Find Friends</a></li>-->
                                    <li class="divider"><a href="<?php echo site_url('user/index/'.$loggedUserDetails['userId']);?>">Boards</a></li>

                                    <li><a href="<?php echo site_url()?>pins">Pins</a></li>
                                    <li><a href="<?php echo site_url()?>like">Likes</a></li>
                                    <li class="divider"><a href="<?php echo site_url()?>editprofile/">Settings</a></li>
                                    <li><a href="<?php echo site_url()?>auth/logout/">Logout</a></li>
                                </ul>
                            </li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </div><!-- closing container -->
    </div><!-- closing Header -->

    <!--TOP NAVIGATION ENDS HERE -->












<div id="fb-root"></div>

<div class="white_strip"></div>
<div class="middle-banner_bg"><!-- staing middlebanner -->
    <div class="container">
        <div class="invite_box" style="margin-top: 94px;">
            <div class="invite_insidebox">
                <div class="invite_form">
                    
        <!--        <p>
                      <input type="button"  onclick="sendRequestToRecipients(); return false;" value="Send Request to Facebook Users Directly"/>
                      <input type="text" value="User ID" name="user_ids" />
                    </p>-->

                    <h3>Invite Your Friends to Cubetboard</h3>

                    <table>

                        <tr>
                            <td>Invite from facebook</td>
                            <td><input type="button" onclick="sendRequestViaMultiFriendSelector(); return false;" value="Facebook" class="Button2 Button13 WhiteButton"/></td>
                        </tr>
                        <!--<form id="invite_form" method="post" action="/ci/pinterest/invite/submit">-->
                        <form id="invite_form" method="post" action="<?php echo site_url(); ?>invite/submit">
                            <tr>
                                <td><label>Email Address 1</label></td>
                                <td><input type="text" class="email inputform-field" id="email1" name="email1" style="margin-top: 5px;width:250px;"/></td>
                            </tr>
                            <tr>
                                 <td><label>Email Address 2</label></td>
                                <td> <input type="text" class="email inputform-field" id="email2" name="email2" style="margin-top: 5px;width:250px;"/></td>
                            </tr>

                            <tr>
                                <td><label>Email Address 3</label></td>
                                <td><input type="text" class="email inputform-field" id="email3" name="email3" style="margin-top: 5px;width:250px;"/></td>
                            </tr>
                            <tr>
                                <td><label>Email Address 4</label></td>
                                <td><input type="text" class="email inputform-field" id="email4" name="email4" style="margin-top: 5px;width:250px;"/></td>
                            </tr>
                            <tr>
                                <td><label>note (optional):</label></td>
                                <td><textarea name="message"  name="description" class="inputform_field_textarea"></textarea></td>
                            </tr>
                            <tr>
                                <td><input type="button" name="submit"  value="Invite" id="SendInvites" class="Button2 Button13 WhiteButton" onclick="invite()"/></td>
                            </tr>
                    </form>
                 </table>
                 <div id="message_added" style="color: #d20000;"></div>
                 <div id="error" style="color: #d20000;"></div>
                 <div id="loading" style="display:none"><img src="<?php echo site_url();?>/application/assets/images/admin/loading.gif"/></div>
            </div>
        </div>
    </div>
</div>
</div>
    </div>
<?php $this->load->view('footer');?>

</body>
</html>


<!--<p><fb:login-button autologoutlink="true"></fb:login-button></p>
    <p><fb:like></fb:like></p>
<div id="fb-root"></div>

<script>
  window.fbAsyncInit = function() {FB.init({appId: '399160855575', status: true, cookie: true,xfbml: true});FB.Event.subscribe('auth.sessionChange', function(response) {if (response.session) {FB.ui({method: 'apprequests', title:'Invite your friends to my cool site!', message: 'You have been invited to this cool site'});} else {}}); };(function() {
    var e = document.createElement('script');
    e.type = 'text/javascript';
    e.src = document.location.protocol +
      '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
  }());
</script>-->

<!--<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <body>
    <script src="http://connect.facebook.net/en_US/all.js"></script>
    <div id="fb-root"></div>
    <script>
      // assume we are already logged in
      FB.init({appId: '399160855575', xfbml: true, cookie: true});

      FB.ui({
          method: 'send',
          name: 'Pinterest clone',
          link: 'http://staging.cubettech.com/ci/pinterest/login'
          });
     </script>
  </body>
</html>-->
 

