<?php $this->load->view('header')?>
<link href="<?php echo base_url(); ?>application/assets/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function deletePin()
{
    pinId = '<?php echo $pinId ?>';
    dataString = 'pinId='+pinId;
    $.ajax({
            url: "<?php echo site_url('board/deletePin');?>",
            type: "POST",
            data: dataString,
            dataType: 'json',
            cache: false,
            success: function (data) {
        }
        });
}
</script>
<script type="text/javascript">
function addGift()
{
    gifted = '<?php echo $result->gift;?>';
    if(gifted==0)
        slow="slow";
    else
        slow=null;
    if($('textarea#description_pin_edit').val()==null)
    {
        $(".PriceContainer").hide();
    }
    else{
        if($('textarea#description_pin_edit').val()=='')
        {
              $(".PriceContainer").hide();
        }
        else{
                str = $('textarea#description_pin_edit').val();
                dollor = str.lastIndexOf("$");
                pound   = str.lastIndexOf("\u00A3");
                if(dollor>pound)
                {
                    symbol = "$";
                }
                else{
                    symbol = "\u00A3";
                }
                if(str.lastIndexOf(symbol) != -1)
                {
                    var myString = str.substr(str.lastIndexOf(symbol) + 1)
                    if(myString!='')
                    { 
                       splitString =  myString.split(" ");
                       if(splitString[0])
                       {
                          if(!isNaN(splitString[0])){
                               $(".PriceContainer").show(slow);
                               $('.PriceContainer').html(symbol+ ' '+splitString[0]);
                               $('input#gift').val(splitString[0]);
                           }
                           else{
                                $(".PriceContainer").hide(slow);
                            }
                       }
                       else{
                            $(".PriceContainer").hide(slow);
                        }
                    }
                    else{
                        $(".PriceContainer").hide(slow);
                    }
                }
                else{
                        $(".PriceContainer").hide(slow);
                    }
        }
        $("#postDescription").html(str);
    }
}
</script>
<?php $this->load->view('popup_js');?>
<div class="middle-banner_bg"><!-- staing middlebanner -->
<div class="FixedContainer">
    <div class="editPin_div" style="margin-top: 135px;">
        <div class="editprofile_insidebox">
            <?php if(!empty($result)):?>

               <!-- Show gift ribbon-->
                <div id="PinEditPreview" class="pin" style="margin-top: 105px; margin-right:25px;">
                    <strong class="PriceContainer" id="priceDiv"></strong>
                    <?php if($result->gift!=0):?>
                        <strong class="PriceContainer_gift" id="priceDiv_gift">$ <?php echo $result->gift;?></strong>
                    <?php endif?>
                    <a href="<?php echo site_url('board/pins/'.$boardId.'/'.$pinId)?>"><img style="height: 144px;width:190px;" src="<?php echo $result->pin_url;?>" /></a>
                    <div class="editDescription">
                        <p id="postDescription" class="desc_preview"><?php echo $result->description;?></p>
                    </div>
                    <span id="gift_span"></span>
                </div>

                <form id="PinEdit" style="margin-top: 6px;" class="Form StaticForm" action="<?php echo site_url('board/savePin');?>" method="POST" accept-charset="utf-8">
                    <h3>Edit Pin</h3>
                    <ul>
                        <input type="hidden" name="gift" value="0" id="gift"/>
                        <input type="hidden" name="type" value="<?php echo $result->type;?>" id="type"/>
                        <li>
                            <label>Description</label>
                            <div class="Right">
                                <div id="ta_holder" class="editable_shadow pin_edit">
                                    <textarea rows="2" name="details" maxlength="500" id="description_pin_edit" cols="40" class="expand autocomplete_desc" onkeyup="addGift()" style="width:150px;height: 100px;"><?php echo $result->description;?></textarea>
                                </div>
                                <div id="errordetails" style="color:red;font-size:15px;"></div>
                                <span class="CharacterCount colorless hidden">500</span>
                            </div>
                        </li>
                        <li>
                            <label for="id_link">Link</label>
                            <div class="Right">
                                <input type="text" name="link" value="<?php echo $result->source_url;?>" id="id_link" />
                                <div id="errorlink" style="color:red;font-size:15px;"></div>
                            </div>
                        </li>
                        <li>
                            <label for="id_board">Board</label>
                            <div class="Right">
                                <?php $userBoards = getUserBoard($userId);?>
                                <select name="board" id="id_board">
                                    <?php foreach ($userBoards as $boardKey => $boardValues):?>
                                    <?php $selected = ($boardValues->id==$boardId)?'selected':'';?>
                                    <option <?php echo $selected;?> value="<?php echo $boardValues->id;?>"><?php echo $boardValues->board_name;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </li>
                        <li>
                            <label>Delete</label>
                            <div class="Right">
                                <a href="<?php echo site_url('pins/confirmDelete/'.$result->board_id.'/'.$result->id);?>"  id="delete" class="Button WhiteButton Button18 deleteButton ajax" ><strong>Delete Pin</strong><span></span></a>
                            </div>
                        </li>
                    </ul>
                    <input type="hidden" name="oldBoardId" value="<?php echo $boardId;?>" id="oldBoardId" />
                    <input type="hidden" name="pinId" value="<?php echo $pinId;?>" id="pinId" />
                    <div class="Submit">
                        <p>
                            <input type="submit" name="submit" value="Save pin" id="submit" class="Button2 Button13 WhiteButton" onClick=" return pinEditFn();"/>
                        </p>
                    </div>
                </form>
            <?php else:?>
               <div class="alert_messgae">
                   <h2>No pins found</h2>
                </div>
            <?php endif;?>
        </div>
    </div>
    </div>
</div>
<?php $this->load->view('footer');?>
<script type="text/javascript">
function pinEditFn()
{
    dataString = $("#PinEdit").serialize();
    //get the each input values of the form in an array
    var o = {};
        var a = $("#PinEdit").serializeArray();
        $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    //check for validation
    for (key in o){
        if(o[key]==""){
            if(key=='link')
            {
                source =   '<?php echo $result->source_url;?>';
                if(source=='')
                {
                }
                else{
                    $('#error'+key).html("please enter a value!")
                    var failed= true;
                }
            }
            else{
                $('#error'+key).html("please enter a value!")
                var failed= true;
            }
            
        }else{
           $('#error'+key).html("")
        }

    }
    //return false on validation failure
    if(failed==true)
        return false;
    else
        return true;
}
</script>