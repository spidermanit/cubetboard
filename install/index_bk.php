<?php
error_reporting(E_ALL);

$site_config_path = "../application/config/config.php";
$dbConfigPath = "../application/config/database.php";

$redirect_url = (isset($_SERVER['HTTPS']) &&
        $_SERVER['HTPPS'] == 'on') ? 'https' : 'http';
$redirect_url = "://" . $_SERVER['HTTP_HOST'];
$redirect_url = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

$style_url = $redirect_url;

if (!empty($_POST)) {

    require_once 'includes/config.php';

    require_once 'includes/database.php';

    $config = new Config();
    $db = new Database();

    if ($config->checkPostData($_POST)) {

//        if (!$db->createDatabase($_POST)) {
//            $error = "The database could not be created, please verify your settings.";
//        } else 
        if (!$db->createTable($_POST)) {
            $error = "The database tables could not be created, please verify your settings.";
        } else if (!$db->createAdmin($_POST)) {
            $error = "The admin details could not be saved. Please verify.";
        } else if (!$config->writeConfig($_POST)) {
            $error = "The configuration file could not be written, 
                    please chmod the files to 0777";
        } else if(!$config->createExtraction($_POST['base_url'])) {
            $error = "The extraction js file could not be written, 
                    please chmod the files to 0777";
        }

        if (!isset($error)) {

            header('Location: ' . $redirect_url . 'status.php?status=1');
            exit;
        }
    } else {
        $error = "Please fill out all the fields";
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Installer</title>

        <link href="<?php echo $style_url; ?>assets/css/style2.css" 
              type="text/css" rel="stylesheet" />


    </head>
    <body>
        <div id="Header">
            <div class="head_top">
                <div class="head_inner">
                    
                </div>

            </div>
            <div class="head_bttm">
                <div class="head_inner">
                    <h1>Welcome to installation panel</h1>

                </div>
            </div>
        </div>



        <?php
        if (is_writable($dbConfigPath) && is_writable($site_config_path)) {

            if (isset($error)) {
                echo '<p class="error">' . $error . '</p>';
            }
            ?>
            <div  class="clearfix">
                <div class="login_wrapper">
                    <div id="Content_Wrapper">
                        <div class="login_holder">
<!--                            <center><h1>Installer</h1></center>-->
                            <div class="Box_login">
                                <div class="Box_Head_login"></div>
                                <div class="Box_Content_login">
                                    <div id="Shorts_key" class="sub_box">
                                        <span class="hint" style="font-size: 16px">* All fields are mandatory</span>

                                        <form name="install" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" >
                                            <table class="login_table">

                                                
                                                <tr>
                                                    <td id="user_id" >
                                                        <label class="disp">Base Url</label>
                                                    </td>
                                                    <td colspan="2">
                                                        <input class="disp" type="text" name="base_url" id="base_url" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value=""/>
                                                        <span class="hint">* Eg: http://www.example.com or http://localhost/your-project-folder</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td id="pass_id">
                                                        <label class="disp">Host</label>
                                                    </td>
                                                    <td>
                                                        <input class="disp" type="text" name="db_host" id="dbhost" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value="localhost"/>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td id="pass_id">
                                                        <label class="disp">Username</label>
                                                    </td>
                                                    <td>
                                                        <input class="disp" type="text" name="db_user" id="dbuser" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value=""/>
                                                        </span>

                                                </tr>
                                                <tr>
                                                    <td id="pass_id">
                                                        <label class="disp">Password</label>
                                                    </td>
                                                    <td>
                                                        <input class="disp" type="password" name="db_password" id="dbpassword" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value=""/>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td id="pass_id">
                                                        <label class="disp">Database</label>
                                                    </td>
                                                    <td>
                                                        <input class="disp" type="text" name="db_name" id="dbname" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value=""/>
                                                        <span class="hint">* The database must exists in the server</span>
                                                    </td>
                                                    
                                                </tr>
                                                 <tr>
                                                     <td>
                                                         <label class="disp">Install sample data</label>
                                                     </td>
                                                     <td id="checkbox" align="left">
                                                         <input type="checkbox" name="db_sample" id="dbname" value="1" checked />&nbsp;Yes
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td id="user_id" >
                                                        <label class="disp">Admin Username</label>
                                                    </td>
                                                    <td colspan="2">
                                                        <input class="disp" type="text" name="admin_username" id="admin_username"  value=""/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td id="" >
                                                        <label class="disp">Admin Password</label>
                                                    </td>
                                                    <td colspan="2">
                                                        <input class="disp" type="password" name="admin_pass" id="admin_pass"  value=""/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td id="submit_id" colspan="2">
                                                        <input type="submit" name="sumbit" value="submit" id="submit" class="Button2 Button13 WhiteButton"/>
                                                    </td>
                                                </tr>
                                                <tr>

                                                </tr>

                                            </table>
                                        </form>

                                        <?php
                                    } else {
                                        echo '<p class="error">Please make config.php and database.php writable.</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </body>
</html>