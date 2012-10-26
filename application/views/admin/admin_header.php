<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-EN">
<head>
<link rel="icon" href="<?php echo base_url(); ?>application/assets/images/favicon.ico" type="image/x-icon" />
<script src="http://products.cogzidel.com/pinterest-clone/js/admin/jquery-1.2.1.min.js" type="text/javascript"></script>
<script src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.2.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>application/scripts/jquery-ui-1.8.1.custom.min.js" type="text/javascript"></script>
<!--<script src="http://products.cogzidel.com/pinterest-clone/js/admin/menu.js" type="text/javascript"></script>-->
<script type="text/javascript">
    function initMenu() {
  $('#menu ul').hide();
  $('#menu ul:first').hide();
  $('#menu li a').click(
    function() {
      var checkElement = $(this).next();
      if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
        return false;
        }
      if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
        $('#menu ul:visible').slideUp('normal');
        checkElement.slideDown('normal');
        return false;
        }
      }
    );
  }
$(document).ready(function() {initMenu();});
</script>
<!--<script src="http://products.cogzidel.com/pinterest-clone/js/jquery-latest.js" type="text/javascript"></script>
<script src="http://products.cogzidel.com/pinterest-clone/js/jquery.validate.js" type="text/javascript"></script>
<script src="http://products.cogzidel.com/pinterest-clone/js/admin/kendo.all.js"></script>
<script src="http://products.cogzidel.com/pinterest-clone/js/admin/people.js"></script>
<script type="text/javascript" src="http://products.cogzidel.com/pinterest-clone/js/sankar.js"></script>-->
<script type="text/javascript">
    var baseUrl = '<?php echo base_url() ?>';
</script>
<!--Fancybox-->
<!--<script type="text/javascript" src="http://products.cogzidel.com/pinterest-clone/css/fancybox/jquery.cog.mo-3.0.4.pack.js"></script>
<script type="text/javascript" src="http://products.cogzidel.com/pinterest-clone/css/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="http://products.cogzidel.com/pinterest-clone/css/fancybox/jquery.fancybox-1.3.4.css" media="screen" />-->
<!--Fancybox-->
<!--<link href="http://products.cogzidel.com/pinterest-clone/css/admin/source/kendo.common.css" rel="stylesheet"/>
<link href="http://products.cogzidel.com/pinterest-clone/css/admin/source/kendo.default.css" rel="stylesheet"/>-->
<link href="<?php echo base_url(); ?>application/assets/css/admin.css" rel="stylesheet" type="text/css" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


<!--facebox  -->
<link href="<?php echo base_url(); ?>application/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/assets/css/example.css" media="screen" rel="stylesheet" type="text/css" />
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

<script type='text/javascript' src='<?php echo base_url(); ?>application/scripts/jquery-autocomplete/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/scripts/jquery-autocomplete/jquery.autocomplete.css" />



<title><?php echo $title;?></title>
<!--<script type="text/javascript">
	$(document).ready(function(){

		$("a.fancyboxForm").fancybox();
	})
</script>
<script type="text/javascript">
$(document).ready(function(){

	$("#bar_chat_wrapper").hide();

	$("#show_hide_chart").click(function(){

	$("#bar_chat_wrapper").toggle('slow');
	});


});
</script>-->
<!--reported pins-->
<!--<script>
    function createChart() {
        $("#chart").kendoChart({
            theme: $(document).data("kendoSkin") || "default",
            title: {
                text: "Users Statistics"
            },
            legend: {
                position: "bottom"
            },
            seriesDefaults: {
                type: "column"
            },
            series: [{
                name: "Inactive Users",
                data: [7]
            }, {
                name: "Active Users",
                data: [20]
            }, {
                name: "Blocked users",
                data: ["0"]
            }
            ],
            valueAxis: {
                /*labels: {
                    format: "{0}%"
                }*/
            },
            categoryAxis: {
                categories: ["May"]
            },
            tooltip: {
                visible: true,
               // format: "{0}%"
            }
        });
    }

    $(document).ready(function() {
        setTimeout(function() {
            createChart();

            // create Calendar from div HTML element
            $("#calendar").kendoCalendar();

            // Initialize the chart with a delay to make sure
            // the initial animation is visible
        }, 400);

        $(document).bind("kendo:skinChange", function(e) {
            createChart();
        });

    });
</script>-->
<style scoped>
#background {
    width: 254px;
    height: 250px;
    margin: 30px auto;
    padding: 69px 0 0 11px;
    background: url('../../../css/admin/images/calendar.png') transparent no-repeat 0 0;
}
#calendar {
    width: 241px;
}
</style>
</head>
<body>
<div id="Header">
	<div class="head_top">
    	<div class="head_inner">
    		<ul id="Navigation">
                <li>
                    <a class="nav link1" class="fancyboxForm" href="<?php echo site_url();?>" id="add_pin"> Site Home</a>
                </li>
                <?php if($this->session->userdata('admin_login')):?>
                    <li>
                        <a class="nav link1" class="fancyboxForm" href="<?php echo site_url('administrator/logout');?>" id="add_pin"> Logout</a>
                    </li>
                <?php endif;?>
                 
      </ul>
      	</div>

    </div>
	<div class="head_bttm">
    	<div class="head_inner">
    		<h1>Welcome to admin panel</h1>

        </div>
    </div>
</div>



   