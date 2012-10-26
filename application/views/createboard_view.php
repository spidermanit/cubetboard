<body id="profile">
    <div id="Header">
        <div class="FixedContainer HeaderContainer">
            <a href="/" id="Pinterest"><img src="http://passets-cdn.pinterest.com/images/LogoRed.png" width="100" height="26" alt="Pinterest Logo" /></a>
            <ul id="Navigation">
                <li><a href="#" class="nav" onclick="Modal.show('Add'); return false">Add<span class="PlusIcon"></span></a></li>
                <li>
                    <a href="/about/" class="nav">About<span></span></a>
                    <ul>
                        <li><a href="/about/help/">Help</a></li>
                        <li><a href="/about/goodies/">Pin It Button</a></li>
                        <li class="beforeDivider"><a href="/about/terms/">Legal & Copyright</a></li>
                        <li class="divider"><a href="/about/careers/">Careers</a></li>
                        <li><a href="/about/team/">Team</a></li>
                        <li><a href="http://blog.pinterest.com/">Blog</a></li>
                    </ul>
                </li>

                <li id="UserNav">
                    <a href="/vishalv/" class="nav"><img src="http://media-cache6.pinterest.com/avatars/vishalv_1331624317.jpg" alt="img" />Vishal<span></span></a>

                    <ul>
                        <li><a href="/invites/">Invite Friends</a></li>
                        <li class="beforeDivider"><a href="/invites/facebook/">Find Friends</a></li>
                        <li class="divider"><a href="/vishalv/">Boards</a></li>
                        <li><a href="/vishalv/pins/">Pins</a></li>
                        <li><a href="/vishalv/pins/?filter=likes">Likes</a></li>

                        <li class="divider"><a href="/settings/">Settings</a></li>
                        <li><a href="/logout/">Logout</a></li>
                    </ul>
                </li>
            </ul>

            <div id="Search" >
                <form action="/search/" method="get" class="text">
                    <input type="text" id="query" name="q" size="27" value="Search"/>
                    <a id="query_button" href="#" class="lg"><img src="http://passets-cdn.pinterest.com/images/search.gif" alt="" /></a>
                </form>
            </div>
        </div>
    </div>

    <div id="Add" class="ModalContainer">

    <div class="modal wide PaddingLess">

        <div class="header lg">
            <a href="#" class="close" onclick="Modal.close('Add'); return false"><strong>Close</strong><span></span></a>
            <h2>Add</h2>
        </div>

        <p id="PinIt">Pin images from any website as you browse the web with the <a href="/about/goodies/#pinmarklet" onclick="load_url(); return false">&ldquo;Pin It&rdquo; button</a>.</p>

        <div id="OpenLinks">

            <a href="#" id="OpenScrapePin" class="cell" onclick="AddDialog.close('Add', 'ScrapePin'); return false">
                <div class="icon" id="scrape"></div>
                <span>Add a Pin</span>

            </a>

            <a id="OpenUploadPin" class="cell" onclick="AddDialog.close('Add', 'UploadPin'); return false">
                <div class="icon" id="upload"></div>
                <span>Upload a Pin</span>
            </a>

            <a id="OpenCreateBoard" class="cell" onclick="AddDialog.close('Add', 'CreateBoard'); CreateBoardDialog.reset(); return false">
                <div class="icon" id="board"></div>

                <span>Create a Board</span>
            </a>

        </div><!-- #OpenLinks -->

    </div><!-- .modal.wide.PostSetup -->

    <div class="overlay"></div>

</div><!-- #Add.ModalContainer -->
<div id="Repin" class="ModalContainer">

    <div class="modal wide PostSetup">

        <div class="header lg">
            <a href="#" class="close" onclick="RepinDialog.reset(); return false"><strong>Close</strong><span></span></a>
            <h2>Repin</h2>
        </div>

        <div class="ImagePicker">

    <img src="http://passets-cdn.pinterest.com/images/load2.gif" class="load" alt="Loading Indicator" />
    <div class="Images pin">
        <div class="price"></div>

        <ul>

                <li><img src="http://passets-cdn.pinterest.com/images/DefaultPin.gif" alt="Media" /></li>

        </ul>
    </div>
    <div class="Arrows">
        <a href="#" class="imagePickerNext picker">Next&nbsp;&rarr;<span class="imagePickerNextArrow"></span></a>

        <a href="#" class="imagePickerPrevious picker">&larr;&nbsp;Prev<span class="imagePickerPreviousArrow"></span></a>
    </div>
</div>

<div class="PinForm">

    <div class="BoardListOverlay"></div>

<div class="BoardSelector BoardPicker">
    <div class="current">
        <span class="CurrentBoard">nature</span>

        <span class="DownArrow"></span>
    </div>
    <div class="BoardList">
        <ul>

                <li data="18577485901882932">
                    <span>nature</span>

                </li>

                <li data="18577485901882579">

                    <span>Books Worth Reading</span>

                </li>

                <li data="18577485901882583">
                    <span>Favorite Places &amp; Spaces</span>

                </li>

                <li data="18577485901882582">
                    <span>For the Home</span>


                </li>

                <li data="18577485901882580">
                    <span>My Style</span>

                </li>

                <li data="18577485901882581">
                    <span>Products I Love</span>

                </li>

        </ul>

        <div class="CreateBoard">
            <input type="text" value="Create New Board"/>
            <a href="#" class="Button WhiteButton Button18 noFloat"><strong>Create</strong><span></span></a>
            <div class="CreateBoardStatus"></div>
        </div>
    </div>
</div>

    <div class="InputArea">
        <ul class="Form FancyForm">

            <li class="noMarginBottom ">
                <textarea class="DescriptionTextarea" rows="2" name="caption"></textarea>
                <label>Describe your pin&hellip;</label>
                <span class="fff"></span>
            </li>
        </ul>
        <p class="CharacterHelp">Type <strong>@</strong> to mention people, <strong>$</strong> or <strong>£</strong> to add price.</p>

    </div>

    <div class="CreateBoardStatus error mainerror"></div>

    <div class="Buttons">
        <a href="#" class="Button Button18 RedButton"><strong>Pin It</strong><span></span></a>
        <span class="CharacterCount colorless">500</span>




    </div>

</div>

        <form action="" id="repinform" method="post">
            <input type="hidden" name="board" id="repin_board" value="18577485901882932" />
            <input type="hidden" name="id" id="repin_pin_id" />
            <input type="hidden" name="tags" id="repin_tags" />
            <input type="hidden" name="replies" id="repin_comment_replies" />
            <input type="hidden" name="details" id="repin_details" value="" />
            <input type="hidden" name="buyable" id="repin_currency_holder" />




            <div style='display:none'><input type='hidden' name='csrfmiddlewaretoken' value='46b733a162f921f1a053f88d70f6585c' /></div>

        </form>

    </div><!-- .modal.wide.PostSetup -->

    <div class="modal wide PostSuccess">

        <div class="header lg" style="text-align: left;">
            <h2><a href="#" class="close" onclick="RepinDialog.reset(); return false"><strong>Close</strong><span></span></a>Repin</h2>
        </div>

        Repinned to <span><a href="#" class="BoardLink"></a></span>.
        <br/>Shared with your followers. <a href="#" class="PinLink">See it now</a>.

    </div><!-- .modal.wide.PostSuccess -->

    <div class="overlay"></div>

</div><!-- #Repin.ModalContainer -->
<div id="ScrapePin" class="ModalContainer">

    <div class="modal wide">

        <div class="header lg">
            <a href="#" class="close" onclick="AddDialog.childClose('Add','ScrapePin'); return false"><strong>Close</strong><span></span></a>
            <h2>Add a Pin</h2>
        </div>

        <div class="PinTop inputHolder scrapePin">
            <ul class="Form FancyForm">
                <li>

                    <img src="http://passets-cdn.pinterest.com/images/load2.gif" class="load" alt="Loading Indicator" />
                    <a href="#" id="ScrapeButton" class="Button WhiteButton Button18 floatRight"><strong>Find Images</strong><span></span></a>
                    <input id="ScrapePinInput" type="text"/>
                    <label>http://</label>
                    <span class="fff"></span>
                </li>
            </ul>
        </div>

        <div class="PinBottom">
            <div class="ImagePicker">
    <img src="http://passets-cdn.pinterest.com/images/load2.gif" class="load" alt="Loading Indicator" />
    <div class="Images pin">
        <div class="price"></div>

        <ul>

                <li><img src="http://passets-cdn.pinterest.com/images/DefaultPin.gif" alt="Media" /></li>

        </ul>

    </div>
    <div class="Arrows">
        <a href="#" class="imagePickerNext picker">Next&nbsp;&rarr;<span class="imagePickerNextArrow"></span></a>
        <a href="#" class="imagePickerPrevious picker">&larr;&nbsp;Prev<span class="imagePickerPreviousArrow"></span></a>
    </div>
</div>

<div class="PinForm">

    <div class="BoardListOverlay"></div>


<div class="BoardSelector BoardPicker">
    <div class="current">
        <span class="CurrentBoard">nature</span>
        <span class="DownArrow"></span>
    </div>
    <div class="BoardList">
        <ul>

                <li data="18577485901882932">

                    <span>nature</span>

                </li>

                <li data="18577485901882579">
                    <span>Books Worth Reading</span>

                </li>

                <li data="18577485901882583">
                    <span>Favorite Places &amp; Spaces</span>


                </li>

                <li data="18577485901882582">
                    <span>For the Home</span>

                </li>

                <li data="18577485901882580">
                    <span>My Style</span>

                </li>

                <li data="18577485901882581">

                    <span>Products I Love</span>

                </li>

        </ul>
        <div class="CreateBoard">
            <input type="text" value="Create New Board"/>
            <a href="#" class="Button WhiteButton Button18 noFloat"><strong>Create</strong><span></span></a>
            <div class="CreateBoardStatus"></div>
        </div>

    </div>
</div>

    <div class="InputArea">
        <ul class="Form FancyForm">
            <li class="noMarginBottom ">
                <textarea class="DescriptionTextarea" rows="2" name="caption"></textarea>
                <label>Describe your pin&hellip;</label>
                <span class="fff"></span>

            </li>
        </ul>
        <p class="CharacterHelp">Type <strong>@</strong> to mention people, <strong>$</strong> or <strong>£</strong> to add price.</p>
    </div>

    <div class="CreateBoardStatus error mainerror"></div>

    <div class="Buttons">
        <a href="#" class="Button Button18 RedButton"><strong>Pin It</strong><span></span></a>
        <span class="CharacterCount colorless">500</span>




    </div>

</div>
        </div>

        <form method="POST">
            <input type="hidden" name="board" id="id_board" value="18577485901882932" />
            <input type="hidden" name="details" value="" id="id_details" />
            <input type="hidden" name="link" value="" id="id_link" />
            <input type="hidden" name="img_url" id="id_img_url" />
            <input type="hidden" name="tags" id="id_tags" />
            <input id="peeps_holder" type="hidden" name="replies" />
            <input id="currency_holder" type="hidden" name="buyable" />





            <div style='display:none'><input type='hidden' name='csrfmiddlewaretoken' value='46b733a162f921f1a053f88d70f6585c' /></div>
        </form>

    </div><!-- .modal.wide -->

    <div class="overlay"></div>

</div><!-- #ScrapePin.ModalContainer -->
<div id="UploadPin" class="ModalContainer">

        <div class="modal wide">

            <div class="header lg">
                <a href="#" class="close" onclick="AddDialog.childClose('Add','UploadPin'); return false"><strong>Close</strong><span></span></a>
                <h2>Upload a Pin</h2>
            </div>

            <div class="PinTop">
                <form action="/post/" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="board" id="id_board" value="18577485901882932" />

                    <input type="hidden" name="details" value="" id="id_details" />
                    <input type="hidden" name="link" value="" id="id_link" />
                    <input type="hidden" name="img_url" id="id_img_url" />
                    <input type="hidden" name="tags" id="id_tags" />
                    <input id="peeps_holder" type="hidden" name="replies" />
                    <input id="currency_holder" type="hidden" name="buyable" />
                    <input type="file" name="img" />




                    <div style='display:none'><input type='hidden' name='csrfmiddlewaretoken' value='46b733a162f921f1a053f88d70f6585c' /></div>
                </form>

            </div>

            <div class="PinBottom">
                <div class="ImagePicker">
    <img src="http://passets-cdn.pinterest.com/images/load2.gif" class="load" alt="Loading Indicator" />
    <div class="Images pin">
        <div class="price"></div>

        <ul>

                <li><img src="http://passets-cdn.pinterest.com/images/DefaultPin.gif" alt="Media" /></li>


        </ul>
    </div>
    <div class="Arrows">
        <a href="#" class="imagePickerNext picker">Next&nbsp;&rarr;<span class="imagePickerNextArrow"></span></a>
        <a href="#" class="imagePickerPrevious picker">&larr;&nbsp;Prev<span class="imagePickerPreviousArrow"></span></a>
    </div>
</div>

<div class="PinForm">

    <div class="BoardListOverlay"></div>

<div class="BoardSelector BoardPicker">
    <div class="current">
        <span class="CurrentBoard">nature</span>
        <span class="DownArrow"></span>
    </div>
    <div class="BoardList">
        <ul>


                <li data="18577485901882932">
                    <span>nature</span>

                </li>

                <li data="18577485901882579">
                    <span>Books Worth Reading</span>

                </li>

                <li data="18577485901882583">
                    <span>Favorite Places &amp; Spaces</span>


                </li>

                <li data="18577485901882582">
                    <span>For the Home</span>

                </li>

                <li data="18577485901882580">
                    <span>My Style</span>

                </li>

                <li data="18577485901882581">

                    <span>Products I Love</span>

                </li>

        </ul>
        <div class="CreateBoard">
            <input type="text" value="Create New Board"/>
            <a href="#" class="Button WhiteButton Button18 noFloat"><strong>Create</strong><span></span></a>
            <div class="CreateBoardStatus"></div>
        </div>

    </div>
</div>

    <div class="InputArea">
        <ul class="Form FancyForm">
            <li class="noMarginBottom ">
                <textarea class="DescriptionTextarea" rows="2" name="caption"></textarea>
                <label>Describe your pin&hellip;</label>
                <span class="fff"></span>

            </li>
        </ul>
        <p class="CharacterHelp">Type <strong>@</strong> to mention people, <strong>$</strong> or <strong>£</strong> to add price.</p>
    </div>

    <div class="CreateBoardStatus error mainerror"></div>

    <div class="Buttons">
        <a href="#" class="Button Button18 RedButton"><strong>Pin It</strong><span></span></a>
        <span class="CharacterCount colorless">500</span>




    </div>

</div>
            </div>

        </div><!-- .modal.wide -->

    <div class="overlay"></div>

</div><!-- #UploadPin.ModalContainer -->
<div id="CreateBoard" class="ModalContainer">

    <div class="modal wide">

        <div class="header lg">
            <a href="#" class="close" onclick="AddDialog.childClose('Add','CreateBoard'); return false"><strong>Close</strong><span></span></a>

            <h2>Create a Board</h2>
        </div>

        <form action="<?php echo site_url('board/create');?>/" method="post" id="create_board" class="Form StaticForm noMargin">

            <ul>
                <li class="noBorderTop">
                    <input id="BoardName" type="text" name="name" value=""/>
                    <label>Board Name</label>

                    <span class="fff"></span>
                </li>
                <li>
                    <input id="id_category" type="hidden" name="category" value="" />

                    <div class="BoardListOverlay"></div>

                    <div id="CategoryPicker" class="BoardSelector BoardPicker">

                        <div class="current">

                            <span class="CurrentBoard">Select a Category</span>
                            <span class="DownArrow"></span>
                        </div>

                        <div class="BoardList">
                            <ul>
                                <?php $result = getCategoryList();?>
                                <?php foreach($result as $key=>$value):?>
                                <li class="BoardCategory" name="BoardCategory" data="<?php echo $value->field?>"><span><?php echo $value->name?></span></li>
                                <?php  endforeach;?>
                            </ul>

                        </div><!-- .BoardList -->

                    </div><!-- #CategoryPicker.BoardSelector.BoardPicker -->

                    <label>Board Category</label>
                </li>

                <li>
                    <label class="radio">Who can pin?</label>

                    <div class="Right">
                        <div style="display:none; border-top: 0;"></div>
                        <ul class="pinability">
                            <li>
                                <label>
                                    <input type="radio" name="change_BoardCollaborators"  value="me" checked="checked" />
                                    <span>Just Me</span>
                                </label>

                            </li>
                            <li class="last-child">
                                <label>
                                    <input type="radio" name="change_BoardCollaborators"  value="multiple" />
                                    <span>Me + Contributors</span>
                                </label>
                            </li>
                        </ul>

                    </div>

                    <div style='display:none'><input type='hidden' name='csrfmiddlewaretoken' value='46b733a162f921f1a053f88d70f6585c' /></div>

                    <div id="add_collaborators" style="display: none;">
                        <span ></span>
                        <input type="text" name="collaborator_name" value="Name or Email Address" id="collaborator_name" />
<!--                        <a href="#" id="submit_collaborator" class="Button WhiteButton Button18 collab_button"><strong>Add</strong><span></span></a>-->
                       

                    </div>
                </li>
                <li><span id="name_error"></span></li>
               <li><span id="category_error"></span></li>
                <li><span id="collaborator_error"></span></li>


            </ul>

<!--            <div class="Submit"><a href="#" class="Button RedButton Button18"><strong>Create Board</strong><span></span></a></div>-->
            <input type="submit" name="submit" value="Create Board" onclick="return createBoard()"/>
            <div class="CreateBoardStatus error"></div>

        </form>

    </div><!-- .modal -->

    <div class="overlay"></div>

</div><!-- #CreateBoard.ModalContainer -->
<script type="text/javascript">
   function createBoard()
   {
       dataString = $("#create_board").serialize();
       //alert(dataString);
       var name                 = $("input#BoardName").val();
       var category             = $("input#id_category").val();
       var collaborator_radio    = $('input:radio[name=change_BoardCollaborators]:checked').val();
       var collaborator         = $("input#collaborator_name").val();
       
       //var change_BoardCollaborators   = $("input#change_BoardCollaborators").val();
       //alert(name);
       //alert(category);
       //alert(collaborator_radio);
       //alert(collaborator);
       if(name=="")
       {  
           failed = 1
           $('#name_error').html("please enter board name!") ;
       }
       if(category=='')
       { 
           failed = 1
           $('#category_error').html("please select a category!") ;
       }
       if((collaborator=='Name or Email Address')&&(collaborator_radio=='multiple'))
       {   
           failed = 1
           $('#collaborator_error').html("please enter collaborator!") ;
       }
       if(failed==1)
       {
         return false;
       }
       
   }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        ScrapePinDialog.setup();
        UploadPinDialog.setup();
        CreateBoardDialog.setup();
        FancyForm.setup();
    });
</script>


<div id="ProfileHeader">

        <div class="FixedContainer row clearfix">
            <div class="info">


                <a href="http://media-cache2.pinterest.com/avatars/vishalv_1331624317_o.jpg" class="ProfileImage" target="_blank">
                    <img src="http://media-cache2.pinterest.com/avatars/vishalv_1331624317_o.jpg" alt="Profile Picture of Vishal Vijayan" />
                </a>

                <div class="content">

                    <h1>Vishal Vijayan</h1>



                        <p class="colorless noDescription"><em>You have no description right now. Write a little bit about yourself!</em><img src="http://passets-cdn.pinterest.com/images/ProfileEditIcon.png"></p>



                    <ul id="ProfileLinks" class="icons">








                            <li>
                                <ul class="addIcons">

                                        <li>
                                            <a class="Button Button11 WhiteButton addFacebook" href="#">
                                                <strong><img src="http://passets-cdn.pinterest.com/images/LinkNag-Facebook.png"></strong>
                                                <span></span>
                                            </a>
                                        </li>



                                        <li>

                                            <a class="Button Button11 WhiteButton addTwitter" href="#">
                                                <strong><img src="http://passets-cdn.pinterest.com/images/LinkNag-Twitter.png"></strong>
                                                <span></span>
                                            </a>
                                        </li>



                                        <li>
                                            <a class="Button Button11 WhiteButton addWebsite" href="#">
                                                <strong><img src="http://passets-cdn.pinterest.com/images/LinkNag-Website.png"></strong>
                                                <span></span>

                                            </a>
                                        </li>



                                        <li>
                                            <a class="Button Button11 WhiteButton addLocation" href="#">
                                                <strong><img src="http://passets-cdn.pinterest.com/images/LinkNag-Location.png"></strong>
                                                <span></span>
                                            </a>
                                        </li>

                                </ul>

                            </li>

                    </ul>
                </div>
            </div>


            <div class="repins">
                <h3>Repins from</h3>
                <ul>

                    <li>

                        <a href="/chicabellacc/?d">
                            <img src="http://media-cache8.pinterest.com/avatars/chicabellacc_1328621694.jpg" alt="Profile Picture of Natasha Moroney" />
                            <strong>Natasha Moroney</strong>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

    </div>

    <div id="ContextBar" class="container sticky">
        <div class="FixedContainer">





            <ul class="links">
                <li><a href="/vishalv/" class="selected"><strong>6</strong> Boards</a></li>
                <li><a href="/vishalv/pins/"><strong>7</strong> Pins</a></li>

                <li><a href="/vishalv/pins/?filter=likes"><strong>0</strong> Likes</a></li>
                <li>
                    <a href="/vishalv/activity/">Activity</a>
                </li>
            </ul>

            <ul class="follow">

                <li><a href="/vishalv/followers/"><strong>2</strong> followers</a></li>
                <li><a href="/vishalv/following/"><strong>12</strong> following</a></li>
            </ul>


                <div class="action">

                    <a class="Button13 Button WhiteButton Left Tab" href="/settings/"><strong>Edit Profile</strong><span></span></a>

                    <a id="RearrangeButton" class="Button13 Button WhiteButton Right Tab" href="/sort_boards/" tooltip="<strong>Rearrange Boards</strong>"><strong></strong><span></span></a>
                    <a id="RearrangeCancel" class="close" tooltip="<strong>Cancel</strong>" href="#">close</a>

                </div>

        </div>
    </div>
    <script type="text/javascript">



    $(document).ready(function() {
        var bar = $('#ContextBar');
        var offset = bar.offset();
        var shim = $('<div/>').insertAfter(bar).css({height:bar.height(), display:'none', width:10});
        var offset = bar.offset().top;
        var fixed = false;

        $(window).scroll(function() {
            var threshold = $(this).scrollTop() >= offset;
            if (threshold && !fixed) {
                shim.show();
                bar.addClass('fixed');
                fixed = true;
            } else if (!threshold && fixed) {
                shim.hide();
                bar.removeClass('fixed');
                fixed = false;
            }
        });

        $('#RearrangeButton').tipsy({
            title: 'tooltip',
            gravity: 'n',
            fade: true,
            html: true
        });

        $('#RearrangeCancel').tipsy({
            title: 'tooltip',
            gravity: 'n',
            fade: true,
            html: true
        });

        $('.noDescription').live('click', function() {
            var form = $('<div class="Form" id="editDescription"></div>');
            var textarea = $('<textarea></textarea>');
            var charCount = $('<div class="CharacterCount"></div>');
            var button = $('<a class="Button11 Button RedButton editDescription" href="#"><strong>Save Description</strong><span></span></a>');

            trackGAEvent('about_field', 'expanded', 'profile');
            form.append(textarea).append(button).append(charCount);
            $('.noDescription').replaceWith(form);

            collapseEditWebsite();
            collapseEditLocation();

            // Character count
            CharacterCount.truncateData("#editDescription textarea", 200);
            CharacterCount.setup('#editDescription textarea', '#editDescription .CharacterCount', '#editDescription .Button', 200);
            textarea.focus();

            button.click(function() {
                if (!button.hasClass('disabled')) {
                    var about = $('#editDescription textarea').val();
                    trackGAEvent('about_field', 'clicked', 'profile');
                    $.post('/settings/about/',
                        { about : about },
                        function(data) {
                            if (data.status == 'ok') {
                                trackGAEvent('about_field', 'success', 'profile');
                                $('#editDescription').replaceWith('<p class="colormuted">' + about + '</p>');
                            }
                        }
                    );
                }
            });
        });

        // Connect a Facebook account to a user account
        $(".addFacebook").click(function() {
            Facebook.startFacebookConnect(''); // reloads window
            (function(error) {
                trackGAEvent('fb_btn', 'clicked', 'profile');
                $.post("/facebook/connect/", function(data) {
                    if (data == "success") {
                        trackGAEvent('fb_btn', 'success', 'profile');
                        // Don't do anything, auto-refreshes.
                    } else {
                        error();
                    }
                }).error(error);
            })(function() {
                alert("Oops! Something went wrong disconnecting your Facebook account. Please try again.");
            });
        });

        $(".addTwitter").click(function() {
            Twitter.startTwitterConnect(''); // reloads window
            (function(error) {
                trackGAEvent('twitter_btn', 'clicked', 'profile');
                $.post("/twitter/connect/", function(data) {
                    if (data == "success") {
                        trackGAEvent('twitter_btn', 'success', 'profile');
                        // Show Twitter icon
                    } else {
                        error();
                    }
                }).error(error);
            })(function() {
                alert("Oops! Something went wrong disconnecting your Twitter account. Please try again.");
            });
        });

        $(".addIcons").on('click', '.addWebsite', function() {
            collapseEditDescription();
            collapseEditLocation();

            var form = $('<div class="Form" id="editWebsite"></div>');
            var icon = $('<img class="inputIcon" src="http://passets-cdn.pinterest.com/images/Input-Website.png">');
            var input = $('<input class="SplitInput" id="websiteInput" type="text">');
            var button = $('<a class="Button11 Button RedButton SplitButton editWebsite" href="#"><strong><img src="http://passets-cdn.pinterest.com/images/Rearrange-Confirm.png"></strong><span></span></a>');

            form.append(icon).append(input).append(button);
            $(this).replaceWith(form);
            input.focus();

            trackGAEvent('website_btn', 'expanded', 'profile');

            var submit = function() {
                if (!button.hasClass('disabled')) {
                    var website = $('#editWebsite input').val();
                    $.post('/settings/website/',
                        { website : website },
                        function(data) {
                            trackGAEvent('website_btn', 'clicked', 'profile');
                            if (data.status == "ok") {
                                trackGAEvent('website_btn', 'success', 'profile');

                                if ($('#ProfileLocation').length != 0) {
                                    $('#ProfileLocation').before('<li><a href="' + website + '" class="icon website" target="_blank"></a></li>');

                                } else {
                                    $('.addIcons').parent().before('<li><a href="' + website + '" class="icon website" target="_blank"></a></li>');
                                }

                                $('.addIcons').addClass('Existing');
                                $('#editWebsite').remove();
                            } else {
                                error();
                            }
                        }
                    );
                }
            }

            input.keypress(function(e) {
                if (e.which == 13) {
                    submit();
                }
            });

            button.click(function() {
                submit();
            });
        });

        $(".addIcons").on('click', '.addLocation', function() {
            collapseEditDescription();
            collapseEditWebsite();

            var form = $('<div class="Form" id="editLocation"></div>');
            var icon = $('<img class="inputIcon" src="http://passets-cdn.pinterest.com/images/Input-Location.png">');
            var input = $('<input class="SplitInput" id="locationInput" type="text">');
            var button = $('<a class="Button11 Button RedButton SplitButton editLocation" href="#"><strong><img src="http://passets-cdn.pinterest.com/images/Rearrange-Confirm.png"></strong><span></span></a>');

            form.append(icon).append(input).append(button);
            $(this).replaceWith(form);
            input.focus();

            trackGAEvent('location_btn', 'expanded', 'profile');
            var submit = function() {
                if (!button.hasClass('disabled')) {
                    var location = $('#editLocation input').val();
                    $.post('/settings/location/',
                        { location : location },
                        function(data) {
                            trackGAEvent('location_btn', 'clicked', 'profile');
                            if (data.status == "ok") {
                                trackGAEvent('location_btn', 'success', 'profile');

                                var icon = '<li id="ProfileLocation"><span class="icon location"></span>' + location + '</li>';

                                $('.addIcons').parent().before(icon);
                                $('.addIcons').addClass('Existing');
                                $('#editLocation').remove();
                            } else {
                                // Error
                            }
                        }
                    );
                }
            }

            input.keypress(function(e) {
                if (e.which == 13) {
                    submit();
                }
            });

            button.click(function() {
                submit();
            });
        });

        var collapseEditDescription = function() {
            if ($('#editDescription').length != 0) {
                $('#editDescription').replaceWith('<p class="colorless noDescription"><em>You have no description right now. Write a little bit about yourself!</em><img src="http://passets-cdn.pinterest.com/images/ProfileEditIcon.png"></p>');
            }
        }

        var collapseEditWebsite = function() {
            if ($('#editWebsite').length != 0) {
                var btn = '';
                btn += '<a class="Button Button11 WhiteButton addWebsite" href="#">';
                btn += '<strong><img src="http://passets-cdn.pinterest.com/images/LinkNag-Website.png"></strong><span></span></a>';

                $('#editWebsite').replaceWith(btn);
            }
        }

        var collapseEditLocation = function() {
            if ($('#editLocation').length != 0) {
                var btn = '';
                btn += '<a class="Button Button11 WhiteButton addLocation" href="#">';
                btn += '<strong><img src="http://passets-cdn.pinterest.com/images/LinkNag-Location.png"></strong><span></span></a>';

                $('#editLocation').replaceWith(btn);
            }
        }

        // New sortable
        var sorting = false;
        var sortButton = $('#RearrangeButton');
        var sortCancel = $("#RearrangeCancel");
        var sortHelper = $("#SortableButtons").find('h2, h3').css({opacity:0})

        sortButton.click(function() {
            trackGAEvent('rearrange_boards', 'clicked', 'profile');
            if (sorting) {
                trackGAEvent('rearrange_boards', 'success', 'profile');
                sorting = false;
                BoardSort.save();
                setTimeout(function() { sortHelper.animate({opacity:0}) }, 500);
                sortButton.attr('tooltip', '<strong>Rearrange Boards</strong>');
                sortButton.removeClass("RedButton").addClass("WhiteButton");
                sortCancel.hide();
            } else {
                sorting = true;
                BoardSort.start();
                setTimeout(function() { sortHelper.animate({opacity:1}) }, 300);
                sortButton.attr('tooltip', '<strong>Save Arrangement</strong>');
                sortButton.addClass("RedButton").removeClass("WhiteButton");
                sortCancel.show();
            }
            return false;
        });

        sortCancel.click(function() {
            trackGAEvent('rearrange_boards', 'cancelled', 'profile');
            BoardSort.cancel();
            return false;
        });

    });

    </script>


        <div id="wrapper" class="BoardLayout">




        <div id="ColumnContainer">

            <div id="SortableButtons">
                <h2 class="colorless">Rearrange Boards</h2>
                <h3 class="colorless">Drag around your boards to reorder them.</h3>
            </div>
            <ul class="sortable">






            <li>










    <div class="pin pinBoard" id="board18577485901882583">

        <h3 class="serif"><a href="/vishalv/favorite-places-spaces/">Favorite Places &amp; Spaces</a></h3>



            <h4>
                2 pins

            </h4>


        <div class="board">

            <a href="/vishalv/favorite-places-spaces/" class="link">




                    <span class="cover" style="background-image:url(http://media-cache5.pinterest.com/upload/18577417182825133_aS6BqDMb_b.jpg)"></span>
                    <span class="thumbs">


                            <img src="http://media-cache9.pinterest.com/upload/18577417182825128_aubIpVTs_t.jpg" alt="Photo of a pin" />



                            <span class="empty"></span>




                            <span class="empty"></span>



                            <span class="empty"></span>


                    </span>

            </a>



            <div class="followBoard">



                       <a href="/vishalv/favorite-places-spaces/settings/" class="Button13 Button WhiteButton InlineButton"><strong>Edit</strong><span></span></a>


            </div>



        </div>

    </div>





            </li>





            <li>










    <div class="pin pinBoard" id="board18577485901882582">

        <h3 class="serif"><a href="/vishalv/for-the-home/">For the Home</a></h3>


            <h4>
                1 pin

            </h4>



        <div class="board">

            <a href="/vishalv/for-the-home/" class="link">




                    <span class="cover" style="background-image:url(http://media-cache6.pinterest.com/upload/18577417182831920_0Aki4t6A_b.jpg)"></span>
                    <span class="thumbs">


                            <span class="empty"></span>



                            <span class="empty"></span>



                            <span class="empty"></span>



                            <span class="empty"></span>


                    </span>


            </a>



            <div class="followBoard">



                       <a href="/vishalv/for-the-home/settings/" class="Button13 Button WhiteButton InlineButton"><strong>Edit</strong><span></span></a>


            </div>



        </div>

    </div>





            </li>





            <li>










    <div class="pin pinBoard" id="board18577485901882581">

        <h3 class="serif"><a href="/vishalv/products-i-love/">Products I Love</a></h3>


            <h4>
                0 pins

            </h4>


        <div class="board">

            <a href="/vishalv/products-i-love/" class="link">


                    <span class="cover empty"></span>
                    <span class="thumbs">
                        <span class="empty"></span>
                        <span class="empty"></span>
                        <span class="empty"></span>
                        <span class="empty"></span>
                    </span>

            </a>



            <div class="followBoard">




                       <a href="/vishalv/products-i-love/settings/" class="Button13 Button WhiteButton InlineButton"><strong>Edit</strong><span></span></a>


            </div>



        </div>

    </div>





            </li>





            <li>











    <div class="pin pinBoard" id="board18577485901882580">

        <h3 class="serif"><a href="/vishalv/my-style/">My Style</a></h3>


            <h4>
                0 pins

            </h4>


        <div class="board">

            <a href="/vishalv/my-style/" class="link">

                    <span class="cover empty"></span>
                    <span class="thumbs">

                        <span class="empty"></span>
                        <span class="empty"></span>
                        <span class="empty"></span>
                        <span class="empty"></span>
                    </span>

            </a>



            <div class="followBoard">



                       <a href="/vishalv/my-style/settings/" class="Button13 Button WhiteButton InlineButton"><strong>Edit</strong><span></span></a>



            </div>



        </div>

    </div>





            </li>





            <li>
    <div class="pin pinBoard" id="board18577485901882579">

        <h3 class="serif"><a href="/vishalv/books-worth-reading/">Books Worth Reading</a></h3>
            <h4>
                1 pin

            </h4>

        <div class="board">

            <a href="/vishalv/books-worth-reading/" class="link">
                    <span class="cover" style="background-image:url(http://media-cache0.pinterest.com/upload/18577417182831957_RhRh6yRq_b.jpg)"></span>
                    <span class="thumbs">
                            <span class="empty"></span>
                            <span class="empty"></span>
                            <span class="empty"></span>
                            <span class="empty"></span>
                    </span>
            </a>
            <div class="followBoard">
                       <a href="/vishalv/books-worth-reading/settings/" class="Button13 Button WhiteButton InlineButton"><strong>Edit</strong><span></span></a>
            </div>
        </div>
    </div>
            </li>
            <li>
    <div class="pin pinBoard" id="board18577485901882932">
        <h3 class="serif"><a href="/vishalv/nature/">nature</a></h3>
            <h4>
                3 pins
                &middot;&nbsp;<img src="http://passets-cdn.pinterest.com/images/collaborators.png">
            </h4>
        <div class="board">
            <a href="/vishalv/nature/" class="link">
                    <span class="cover" style="background-image:url(http://media-cache2.pinterest.com/upload/18577417182837738_xz8l3t9U_b.jpg)"></span>
                    <span class="thumbs">
                            <img src="http://media-cache7.pinterest.com/upload/237776055296243610_JGn8ABUy_t.jpg" alt="Photo of a pin" />
                            <img src="http://media-cache1.pinterest.com/upload/18577417182831906_e9JLC9Ja_t.jpg" alt="Photo of a pin" />
                            <span class="empty"></span>
                            <span class="empty"></span>
                    </span>
            </a>
            <div class="followBoard">
                       <a href="/vishalv/nature/settings/" class="Button13 Button WhiteButton InlineButton"><strong>Edit</strong><span></span></a>
            </div>
        </div>
    </div>





            </li>






            </ul>
        </div><!-- #ColumnContainer -->

	</div><!-- #wrapper -->

</body>
<script type="text/javascript" charset="utf-8">

    BoardLayout.setup();

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

	// Create board for empty profiles
	$('.createBoardSubmit').click(function() {
        //alert('here');
        var name = $(this).siblings('.FancyContainer').children('input').val();
        var parent = $(this).parents('.createBoard');
        //alert(name)
        $.post('/ci/pinterest/board/createeee/', {
            'name': name
        }, function(data) {
            if (data.status == "success") {
                var board = '';
                board += '<div class="pin pinBoard" id="board' + data.id + '">';
                    board += '<h3 class="serif"><a href="' + data.url + '">' + data.name + '</a></h3>';
                    board += '<h4>0 pins</h4>';
                    board += '<div class="board">';
                        board += '<a href="' + data.url + '" class="link">';
                            board += '<span class="cover empty"></span>';
                            board += '<span class="thumbs">';
                                board += '<span class="empty"></span>';
                                board += '<span class="empty"></span>';
                                board += '<span class="empty"></span>';
                                board += '<span class="empty"></span>';
                            board += '</span>';
                        board += '</a>';
                        board += '<div class="followBoard">';
                            board += '<a href="' + data.url + 'settings/" class="Button13 Button WhiteButton"><strong>Edit</strong><span></span></a>';
                        board += '</div>';
                    board += '</div>';
                board += '</div>';

                parent.replaceWith(board);
            }
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





        trackGAEvent('user_board', 'viewed', (window.location.search === "?d") ? 'discover' : 'direct');
        _gaq.push(['_trackPageview', '/profile/?name=vishalv']);


    (function() {
      var ga = document.createElement('script'); ga.type='text/javascript'; ga.async=true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
    })();

</script>



</html>