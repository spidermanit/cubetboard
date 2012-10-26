<?php $this->load->view('header');?>
<link href="<?php echo base_url(); ?>application/assets/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function deleteBoard()
{
    boardId = '<?php echo $boardId ?>';
    dataString = 'board='+boardId;
    $.ajax({
            url: "<?php echo site_url('board/delete');?>",
            type: "POST",
            data: dataString,
            dataType: 'json',
            cache: false,
            success: function (data) {
        }
        });
}
</script>
<?php $this->load->view('popup_js');?>
<div class="white_strip"></div>
<div class="middle-banner_bg">
    <?php $boardDetails = getBoardDetails($boardId);?>
    <?php if(!empty($boardDetails)): ?>
        <div class="FixedContainer">
            <form id="BoardEdit" class="Form StaticForm"  method="post" accept-charset="utf-8">
                <div class="editprofile_insidebox">
                    <h3>Edit Board / <a href="<?php echo site_url('board/index/'.$boardId);?>"><?php echo $boardDetails->board_name;?></a></h3>
                    <ul>
                        <!-- Board Title -->
                        <input type="hidden" name="boardId" value="<?php echo $boardDetails->id;?>"/>
                        <li>
                            <div class="Left">
                                <label for="id_name">Title</label>
                            </div>
                            <div class="Right">
                                <input type="text" name="name" value="<?php echo $boardDetails->board_name;?>" id="edit_BoardName" />
                                <span id="edit_name_error" class="validation-message"></span>
                            </div>
                        </li>
                        <!-- Board Description -->
                        <li>
                            <div class="Left">
                                <label for="id_description">Description</label>
                            </div>
                            <div class="Right"><textarea id="id_description" rows="3" cols="54" name="description" maxlength="500" style="height: 90px;width:150px"><?php echo $boardDetails->description;?></textarea></div>
                        </li>

                         <li>
                            <div class="Left">
                                <label>Board Category</label>
                            </div>
                            <div class="Right">
                                <select id="id_category" name="category">
                                    <?php $result = getCategoryList();?>
                                    <?php foreach($result as $key=>$value):?>
                                     <?php if($boardDetails->category==$value->field):?>
                                    <option selected value="<?php echo $value->field;?>"><?php echo $value->name;?></option>
                                    <?php else:?>
                                        <option  value="<?php echo $value->field;?>"><?php echo $value->name;?></option>
                                    <?php endif?>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </li>
                        <li class="Delete">
                            <label>Delete</label>
                            <a class="Button WhiteButton Button18 ajax" style="float:left;" href="<?php echo site_url('board/confirmDelete/'.$boardDetails->id);?>"  id="delete_confirm" ><strong>Delete Board</strong><span></span></a>
                        </li>
                        <li>
                            <div style="float: left;">
                                <input type="button" name="submit" id="saveBoard_button" value="Save Settings" onclick="return editBoard()" class="Button2 Button13 WhiteButton"/>
                            </div>
                            <div id="loading" style="display:none"><img src="<?php echo site_url();?>/application/assets/images/admin/loading.gif"/></div>
                            <div id="message" class="validation-message"></div>
                        </li>
                    </ul>
                </div>
            </form>
        </div><!-- .FixedContainer -->
    <?php else:?>
        <div class="alert_messgae">
            <h2>Board not found!!</h2>
        </div>
    <?php endif?>
</div>
<?php $this->load->view('footer');?>
</body>
<div id="SearchAutocompleteHolder"></div>
</html>