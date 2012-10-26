<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to cubetboard..</title>
<link href="<?php echo base_url(); ?>application/assets/css/cubetboard.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/assets/css/style.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.2.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>application/scripts/jquery-ui-1.8.1.custom.min.js" type="text/javascript"></script>
</head>

<body>
<div class="outer">
    <div class="header"><!-- starting Header -->
        <div class="container"><!-- starting container -->
            <div class="header_box">
                <div class="logo"><a href="<?php echo site_url();?>"><img src="<?php echo site_url()?>/application/assets/images/cubetboard/logo.png"/></a></div>
            </div>
        </div><!-- closing container -->
    </div><!-- closing Header -->
    <div class="white_strip"></div>
    <div class="clear"></div>
    <div class="middle-banner_bg"><!-- staing middlebanner -->
        <div class="container"><!-- staing container -->
            <div class="alert_messgae">
              <h2>CONGRAGULATION. YOU HAVE INVITED TO JOIN THE CUBETBOARD APPLICATION</h2><br/>
              <h2><a href="<?php echo site_url();?>/login/handleLogin/" target="blank">CLICK HERE TO JOIN</a></h2>
            </div>
        </div><!-- closing container -->
    </div><!-- closing middlebanner -->
    <?php $this->load->view('footer');?>
</div>
</body>
</html>