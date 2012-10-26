<?php
if (isset($_GET['status']) && $_GET['status'] == 1) {

    $redirect_url = (isset($_SERVER['HTTPS']) &&
            $_SERVER['HTPPS'] == 'on') ? 'https' : 'http';
    $redirect_url = "://" . $_SERVER['HTTP_HOST'];
    $redirect_url = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

    $style_url = $redirect_url;

    $redirect_url = str_replace("install/", '', $redirect_url);

    $status_msg = "<p style='font-size:13px'>Please delete, move or rename the install directory and <a href='" . $redirect_url . "'>click here</a> 
                to complete the installation procedure. While this directory exists, only the Installation Panel will be accessible.</p>";
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Installer</title>

        <link href="<?php echo $style_url; ?>assets/css/style1.css" 
              type="text/css" rel="stylesheet" />
        <link href="<?php echo $style_url; ?>assets/css/style2.css" 
              type="text/css" rel="stylesheet" />

    </head>
    <body>

        <div id="wrap">

            <div id="top"></div>

            <div id="content">

                <div class="header">
                    <h1 style="font-family: Verdana"><a href="#">Installation Status</a></h1>
                    <h2></h2>
                </div>

                <div class="breadcrumbs">

                </div>

                <div class="middle">
                    <?php
                    if (isset($status_msg))
                        echo $status_msg;
                    ?>
                </div>

                <div class="right"></div>
                <div id="clear"></div>
                
            </div>
            <div id="bottom"></div>
        </div>
        <div id="footer">
            <!--Copyright @2012-->
        </div>
    </body>
</html>

