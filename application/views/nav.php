
<!-- TOP NAVIGATION-->
<div id="Header">
    <div class="FixedContainer HeaderContainer">
        <a href="/" id="Pinterest"><img src="https://a248.e.akamai.net/passets.pinterest.com.s3.amazonaws.com/images/LogoRed.png" width="100" height="26" alt="Pinterest Logo" /></a>
        <ul id="Navigation">
            <li>
                <a href="#" class="nav" onclick="Modal.show('Add'); return false">Add<span class="PlusIcon"></span></a>
            </li>
            <li>
                <a href="/about/" class="nav">About<span></span></a>
                <ul>
                    <li><a href="/about/help/">Help</a></li>
                    <li class="beforeDivider"><a href="/about/goodies/">Pin It Button</a></li>
                    <li class="divider"><a href="/about/careers/">Careers</a></li>
                    <li><a href="/about/team/">Team</a></li>

                    <li class="beforeDivider"><a href="http://blog.pinterest.com/">Blog</a></li>
                    <li class="divider"><a href="/about/terms/">Terms of Service</a></li>
                    <li><a href="/about/privacy/">Privacy Policy</a></li>
                    <li><a href="/about/copyright/">Copyright</a></li>
                    <li><a href="/about/trademark/">Trademark</a></li>
                </ul>
            </li>

            <li id="UserNav">
                <a href="/vishalv/" class="nav"><img src="https://a248.e.akamai.net/media.pinterest.com.s3.amazonaws.com/avatars/vishalv_1331624317.jpg" alt="img" />Vishal<span></span></a>
                <ul>
                    <li><a href="<?php echo site_url()?>/invite">Invite Friends</a></li>
                    <li class="beforeDivider"><a href="<?php echo site_url()?>/invite">Find Friends</a></li>
                    <li class="divider"><a href="">Boards</a></li>

                    <li><a href="">Pins</a></li>
                    <li><a href="">Likes</a></li>
                    <li class="divider"><a href="<?php echo site_url()?>/editprofile/">Settings</a></li>
                    <li><a href="<?php echo site_url()?>/auth/logout/">Logout</a></li>
                </ul>
            </li>
        </ul>
        <div id="Search" >
            <form action="/search/" method="get" class="text">
                <input type="text" id="query" name="q" size="27" value="Search"/>
                <a id="query_button" href="#" class="lg"><img src="https://a248.e.akamai.net/passets.pinterest.com.s3.amazonaws.com/images/search.gif" alt="" /></a>
            </form>
        </div>
    </div>
</div>
<!--TOP NAVIGATION ENDS HERE -->

<!--ADD MODULE -->
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
            <img src="https://a248.e.akamai.net/passets.pinterest.com.s3.amazonaws.com/images/load2.gif" class="load" alt="Loading Indicator" />
            <div class="Images pin">
                <div class="price"></div>
                <ul>
                    <li><img src="https://a248.e.akamai.net/passets.pinterest.com.s3.amazonaws.com/images/DefaultPin.gif" alt="Media" /></li>
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
                        <li data="18577485901882932"><span>nature</span></li>
                        <li data="18577485901882579"><span>Books Worth Reading</span></li>
                        <li data="18577485901882583"><span>Favorite Places &amp; Spaces</span></li>
                        <li data="18577485901882582"><span>For the Home</span></li>
                        <li data="18577485901882580"><span>My Style</span></li>
                        <li data="18577485901882581"> <span>Products I Love</span></li>
                        <li data="18577485901890347"><span>test</span></li>
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
            <div style='display:none'><input type='hidden' name='csrfmiddlewaretoken' value='a6205adfa022c0c83a09bef29fcda941' /></div>
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
                    <img src="https://a248.e.akamai.net/passets.pinterest.com.s3.amazonaws.com/images/load2.gif" class="load" alt="Loading Indicator" />
                    <a href="#" id="ScrapeButton" class="Button WhiteButton Button18 floatRight"><strong>Find Images</strong><span></span></a>
                    <input id="ScrapePinInput" type="text"/>
                    <label>http://</label>
                    <span class="fff"></span>
                </li>
            </ul>
        </div>

        <div class="PinBottom">
            <div class="ImagePicker">
                <img src="https://a248.e.akamai.net/passets.pinterest.com.s3.amazonaws.com/images/load2.gif" class="load" alt="Loading Indicator" />
                <div class="Images pin">
                    <div class="price"></div>
                    <ul>
                        <li><img src="https://a248.e.akamai.net/passets.pinterest.com.s3.amazonaws.com/images/DefaultPin.gif" alt="Media" /></li>
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
                            <li data="18577485901882932"><span>nature</span></li>
                            <li data="18577485901882579"><span>Books Worth Reading</span></li>
                            <li data="18577485901882583"><span>Favorite Places &amp; Spaces</span></li>
                            <li data="18577485901882582"><span>For the Home</span></li>
                            <li data="18577485901882580"> <span>My Style</span></li>
                            <li data="18577485901882581"><span>Products I Love</span></li>
                            <li data="18577485901890347"><span>test</span></li>
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
            <div style='display:none'><input type='hidden' name='csrfmiddlewaretoken' value='a6205adfa022c0c83a09bef29fcda941' /></div>
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
                <div style='display:none'><input type='hidden' name='csrfmiddlewaretoken' value='a6205adfa022c0c83a09bef29fcda941' /></div>
            </form>
        </div>
        <div class="PinBottom">
            <div class="ImagePicker">
                <img src="https://a248.e.akamai.net/passets.pinterest.com.s3.amazonaws.com/images/load2.gif" class="load" alt="Loading Indicator" />
                <div class="Images pin">
                    <div class="price"></div>
                    <ul>
                        <li><img src="https://a248.e.akamai.net/passets.pinterest.com.s3.amazonaws.com/images/DefaultPin.gif" alt="Media" /></li>
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
                            <li data="18577485901882932"><span>nature</span></li>
                            <li data="18577485901882579"><span>Books Worth Reading</span></li>
                            <li data="18577485901882583"><span>Favorite Places &amp; Spaces</span></li>
                            <li data="18577485901882582"> <span>For the Home</span></li>
                            <li data="18577485901882580"><span>My Style</span></li>
                            <li data="18577485901882581"><span>Products I Love</span></li>
                            <li data="18577485901890347"><span>test</span> </li>
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
                        <input type="text" name="collaborator_name" value="Name or Email Address" id="collaborator_name" /><!--                     <a href="#" id="submit_collaborator" class="Button WhiteButton Button18 collab_button"><strong>Add</strong><span></span></a>-->
                    </div>
                </li>
                <li><span id="name_error"></span></li>
                <li><span id="category_error"></span></li>
                <li><span id="collaborator_error"></span></li>
            </ul>
            <!--<div class="Submit"><a href="#" class="Button RedButton Button18"><strong>Create Board</strong><span></span></a></div>-->
            <input type="submit" name="submit" value="Create Board" onclick="return createBoard()"/>
            <div class="CreateBoardStatus error"></div>
        </form>
     </div><!-- .modal -->
    <div class="overlay"></div>
</div><!-- #CreateBoard.ModalContainer -->



    