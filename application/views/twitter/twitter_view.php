    <!DOCTYPE html>
    <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link media="screen" rel="Stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css" />
    <title>Using the Twitter API with CodeIgniter</title>
    </head>

    <body>

    <div id="wrapper">

    <div id="main">
	<h3>
	<?php echo $heading; ?>
    <span>
    	( account: <?php echo anchor('http://twitter.com/' . $active_user, $active_user); ?> )
    </span>
    </h3>
    <?php //echo form_error('message'); ?>
    <?php echo form_open('twitter/update', array('id' => 'update_form')); ?>
    <?php echo form_input(array('name' => 'message', 'maxlength' => '140')); ?>
    <?php echo form_submit('submit', 'update'); ?>
    <?php echo form_close(); ?>
    <div id="last_message">
        <fieldset>
            <legend>Last <span>sent by <b><?php echo $active_user ?></b></span></legend>
            <p><?php echo $last_message; ?></p>
        </fieldset>
    </div><!--end last_message-->
	</div><!--end main-->

    </div><!--end wrapper-->

    </body>
    </html>
