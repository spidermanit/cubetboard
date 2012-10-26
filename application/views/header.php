<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
    .header_links-box , .pinit_button , .pro-blue-button , .edit-prof-button , .banner-white-bg , .banner_bluebg_left , .banner_bluebg_right, .latest-updates_heddbox , .latest-updates_box, .Following_heddbox , .Following_box , .profile_image , .sortboard_right-corn , .pin_no , .sortboard-blue-button , .editprofile_insidebox , .pin_item , .action , .buttonLogin , .info_bar , .popup_login , .form-field-input  .more {
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


                    <div class="logo"><a href="<?php echo site_url();?>"><img src="<?php echo site_url()?>/application/assets/images/cubetboard/logo.png"/></a></div>

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
                                <li style="width:60px;">
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
                            <li style="width: 60px;">
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









    