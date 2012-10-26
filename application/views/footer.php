<div class="footer_bg"><!-- starting Footer -->
    <div class="container"><!-- starting container -->
        <div class="bottom_box">
            <ul class="bottomlinks">
                <li><a href="<?php echo site_url();?>welcome/underconstruction">Help</a></li>
                <li><a href="<?php echo site_url();?>welcome/underconstruction">Pin It Button</a></li>
                <li><a href="<?php echo site_url();?>welcome/underconstruction">Careers</a></li>
                <li><a href="<?php echo site_url();?>welcome/underconstruction">Team</a></li>
                <li><a href="<?php echo site_url();?>welcome/underconstruction">Blog</a></li>
            </ul>

            <ul class="bottomlinks">
                <li><a href="<?php echo site_url();?>welcome/underconstruction">Terms of Service</a></li>
                <li><a href="<?php echo site_url();?>welcome/underconstruction">Privacy Policy</a></li>
                <li><a href="<?php echo site_url();?>welcome/underconstruction">Copyright</a></li>
                <li><a href="<?php echo site_url();?>welcome/underconstruction">Trademark</a></li>
            </ul>

            <div class="bottomlink-box-right">
                <ul class="bottomlinks">
                    <li><a href="<?php echo site_url();?>invite">Invite Friends</a></li>
                    <li><a href="<?php echo site_url();?>pins/videos">Videos</a></li>
                    <li><a href="<?php echo site_url();?>gift/index/0/100">Gifts</a></li>
                </ul>

                <ul class="bottomlinks-right">
                    <li><a href="<?php echo site_url();?>welcome/mostLiked">Most liked</a></li>
                    <li><a href="<?php echo site_url();?>welcome/mostRepinned">popular</a></li>
                    <?php if($this->session->userdata('login_user_id')):?>
                    <li><a href="<?php echo site_url();?>auth/logout">Logout</a></li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
        <div class="copyright_box">
            <p>Copyright © 2012 </p>
        </div>
    </div><!-- closing container -->
</div><!-- closing Footer -->