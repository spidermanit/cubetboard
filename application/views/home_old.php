<script type="text/javascript" charset="utf-8">
    BoardLayout.setup();
    //SendMessage.setup();
    $.pageless.settings.complete = function(){
        BoardLayout.newPins();
    };
    $(document).ready(function() {
        if (50 > 0) {
            $('#LoadingPins').hide();
        }

    });
	$.get("/vishalv/activity/", function(data){
		$(document).ready(function(){
			$('.activity').append(data);
		});
	});
</script>
 <div id="SearchAutocompleteHolder"></div>
 <script type="text/javascript">
 function trackGAEvent(category, action, label, value) {
	_gaq = _gaq || []
   // Event
	_gaq.push(['_trackEvent', category, action, label, value]);
	// Virtual Page
    virtual_page = '_event_';
	virtual_page += "/" + category;
	if(!action) action = '_';
        virtual_page+="/" + action;
	if(label) virtual_page+= "/" + label;
	_gaq.push(['_trackPageview', virtual_page]);
    }
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-12967896-1']);
    _gaq.push(['_setCustomVar', 1, 'is_logged_in', 'logged in', 2]);
    _gaq.push(['_setCustomVar', 2, 'page_name', 'user_boards', 1]);
     trackGAEvent('user_board', 'viewed');
     _gaq.push(['_trackPageview', '/profile/?name=vishalv']);
    (function() {
      var ga = document.createElement('script'); ga.type='text/javascript'; ga.async=true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
    })();
</script>
<body id="profile">

    <div id="wrapper" class="BoardLayout">

        <div id="ProfileSidebar">

            <h1><?php echo $fb_data['me']['name'];?><!--<span><fb:like href="http://pinterest.com/vishalv/" layout="button_count" show_faces="false" width="90" action="like" font="lucida grande" colorscheme="light"></fb:like></span>--></h1>
            <p><a href="/vishalv/followers/">1<span> followers</span></a>, <a href="/vishalv/following/">11<span> following</span></a></p>

            <div id="ProfileImage">
                <?php if($fb_data['uid']):?>
                    <a href="" class="ImgLink" target="_blank"> <img src="https://graph.facebook.com/<?php echo $fb_data['uid']; ?>/picture" alt="" class="pic" height="150" width="150"/>  </a>
                <?php elseif($twitter_username):?>
                    <a href="" class="ImgLink" target="_blank"> <img src="http://img.tweetimag.es/i/<?php echo $twitter_username; ?>" alt="" class="pic" height="150" width="150"/>  </a>
                <?php else:?>
                    <a href="/vishalv/" class="nav"><img src="/ci/pinterest/assets/images/<?php echo $imageFile; ?>" alt="" class="pic" />  <?php echo $twitter_username;?><span></span></a>
                <?php endif?>
                <a class="Button13 Button WhiteButton" href="/settings/"><strong>Edit Profile</strong><span></span></a>
            </div>

            <ul id="ProfileLinks">
                <li id="ProfileLinksFacebook">
                    <a href="http://facebook.com/profile.php?id=100000193924861" class="Button Button13 WhiteButton" target="_blank">
                        <strong><img src="http://passets-cdn.pinterest.com/images/ProfileIconFacebook.png" alt="Link to Facebook Account" /></strong>
                        <span></span>
                    </a>
                </li>

                <li id="ProfileLinksRSS">
                    <a href="/vishalv/feed.rss" class="Button Button13 WhiteButton" target="_blank">
                        <strong><img src="http://passets-cdn.pinterest.com/images/ProfileIconRSS.png" alt="Link to RSS Feed" /></strong>
                        <span></span>
                    </a>
                </li>
            </ul
            <ol class="activity"></ol>
        </div><!-- #ProfileSidebar -->

        <div id="ContextBar">
            <a id="slk_sort_boards" class="Button WhiteButton Button13 reArrange" href="#" onclick="BoardSort.start(); return false"><strong>Rearrange Boards</strong><span></span></a>
            <span id="SortStatus"></span>
            <p class="bar-links"><span class="selected">6 Boards</span> &middot; <a href="/vishalv/pins/">4 Pins</a> &middot; <a href="/vishalv/pins/?filter=likes">0 Likes</a></p>
        </div><!-- #ContextBar -->

        
        <div id="ColumnContainer">
            <div id="SortableHelper"><span id="SortableText">Drag around your boards to reorder them &darr;</span><span id="SortableButtons"><a href="#" class="Button WhiteButton Button13" onclick="BoardSort.cancel(); return false"><strong>Cancel</strong><span></span></a>&nbsp;&nbsp;&nbsp;<a id="SortSave" href="/sort_boards/" class="Button RedButton Button13" onclick="BoardSort.save(); return false"><strong>Save Arrangement</strong><span></span></a></span></div>
            <ul class="sortable">
                <?php $board = getUserBoard($userid);?>
                <?php if(is_array($board)):?>
                    <?php foreach($board as $key=>$value):?>
                        <li>
                            <div class="pin pinBoard" id="<?php echo $value->id?>">
                                <h3><?php echo $value->board_name?></h3>
                                <a href="/board/<?php echo $value->id?>" class="link">
                                    <?php $content = explode(',', $value->content);?>
                                    <?php foreach ($content as $value):?>
                                        <img src="<?php echo $value;?>" alt="Photo of a pin" />
                                    <?php endforeach;?>
                                </a>
                                <div class="followBoard">
                                    <a href="/vishalv/favorite-places-spaces/settings/" class="Button13 Button WhiteButton"><strong>Edit</strong><span></span></a>
                                </div>
                             </div>
                        </li>
                    <?php endforeach;?>
                <?php endif?>

                <!--
                <li>
                    <div class="pin pinBoard" id="board18577485901882583">
                        <h3>Favorite Places &amp; Spaces</h3>
                        <a href="/vishalv/favorite-places-spaces/" class="link">
                        <img src="http://pagead2.googlesyndication.com/simgad/4121260150162794002" alt="Photo of a pin" />
                        <img src="http://media-cdn.pinterest.com/upload/18577417182825128_aubIpVTs_t.jpg" alt="Photo of a pin" />
                        </a>
                        <div class="followBoard">
                            <a href="/vishalv/favorite-places-spaces/settings/" class="Button13 Button WhiteButton"><strong>Edit</strong><span></span></a>
                        </div>
                     </div>
                </li>

                <li>
                    <div class="pin pinBoard" id="board18577485901882582">
                        <h3>For the Home</h3>
                        <a href="/vishalv/for-the-home/" class="link"></a>
                        <div class="followBoard">
                            <a href="/vishalv/for-the-home/settings/" class="Button13 Button WhiteButton"><strong>Edit</strong><span></span></a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="pin pinBoard" id="board18577485901882581">
                        <h3>Products I Love</h3>
                        <a href="/vishalv/products-i-love/" class="link"></a>
                        <div class="followBoard">
                            <a href="/vishalv/products-i-love/settings/" class="Button13 Button WhiteButton"><strong>Edit</strong><span></span></a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="pin pinBoard" id="board18577485901882580">
                        <h3>My Style</h3>
                        <a href="/vishalv/my-style/" class="link"></a>
                        <div class="followBoard">
                            <a href="/vishalv/my-style/settings/" class="Button13 Button WhiteButton"><strong>Edit</strong><span></span></a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="pin pinBoard" id="board18577485901882579">
                        <h3>Books Worth Reading</h3>
                        <a href="/vishalv/books-worth-reading/" class="link"></a>
                        <div class="followBoard">
                            <a href="/vishalv/books-worth-reading/settings/" class="Button13 Button WhiteButton"><strong>Edit</strong><span></span></a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="pin pinBoard" id="board18577485901882932">
                        <h3>nature</h3>
                        <a href="/vishalv/nature/" class="link">
                        <img src="http://media-cdn.pinterest.com/upload/18577417182831906_e9JLC9Ja_t.jpg" alt="Photo of a pin" />
                        <img src="http://media-cdn.pinterest.com/upload/18577417182831906_e9JLC9Ja_t.jpg" alt="Photo of a pin" />
                        </a>
                        <div class="followBoard">
                            <a href="/vishalv/nature/settings/" class="Button13 Button WhiteButton"><strong>Edit</strong><span></span></a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="pin pinBoard" id="board18577485901882932">
                        <h3>nature</h3>
                        <a href="/vishalv/nature/" class="link">
                        <img src="http://media-cdn.pinterest.com/upload/18577417182831906_e9JLC9Ja_t.jpg" alt="Photo of a pin" />
                        <img src="http://media-cdn.pinterest.com/upload/18577417182831906_e9JLC9Ja_t.jpg" alt="Photo of a pin" />
                        <img src="http://media-cdn.pinterest.com/upload/18577417182831906_e9JLC9Ja_t.jpg" alt="Photo of a pin" />
                        </a>
                        <div class="followBoard">
                            <a href="/vishalv/nature/settings/" class="Button13 Button WhiteButton"><strong>Edit</strong><span></span></a>
                        </div>
                    </div>
                </li>-->
            </ul>
        </div><!-- #ColumnContainer -->
	</div><!-- #wrapper -->
</body>

</html>