<link href="<?php echo base_url(); ?>application/assets/css/style.css" rel="stylesheet" type="text/css" />
<div id="fancybox-outer">
    <div class="fancybox-bg" id="fancybox-bg-n">
    </div>
    <div class="fancybox-bg" id="fancybox-bg-ne"></div>
    <div class="fancybox-bg" id="fancybox-bg-e"></div>
    <div class="fancybox-bg" id="fancybox-bg-se"></div>
    <div class="fancybox-bg" id="fancybox-bg-s"></div>
    <div class="fancybox-bg" id="fancybox-bg-sw"></div
    ><div class="fancybox-bg" id="fancybox-bg-w"></div>
    <div class="fancybox-bg" id="fancybox-bg-nw"></div>
    <div style="border-width: 10px; width: 580px; height: auto;" id="fancybox-content">
        <div style="width: auto; height: auto; overflow: auto; position: relative;">
            <div id="Repin_Pop" class="Pop_Up_Blk">
                <h2 id="h2_heading">Report this pin</h2>
                <div class="pop_content">
                    <div id="pop_content">
                        <div class="right clsFloatRight" style="float: left;padding: 20px;width: 300px;">
                            <form action="#" method="post"  id="reportForm">
                            <input id="pinId" name="pinId" type="hidden" value="<?php echo $pinId ?>">
                            <input id="boardId" name="boardId" type="hidden" value="<?php echo $boardId ?>">
                            <p id="ReportLabel">Why are you reporting this pin?</p>
                            <ul class="report_ul">
                                <li>
                                    <div class="option">
                                        <input id="nudity" name="reason" type="radio" value="nudity" checked="checked" onclick="giveReason('hide')">
                                        <label for="nudity">Nudity or Pornography</label>
                                    </div>
                                 </li>
                                 <li>
                                     <div class="option">
                                        <input id="attacks" name="reason" type="radio" value="attacks" onclick="giveReason('hide')">

                                        <label for="attacks">Attacks a group or individual</label>
                                    </div>
                                 </li>
                                 <li>
                                     <div class="option">
                                        <input id="graphic-violence" name="reason" type="radio" value="graphic-violence" onclick="giveReason('hide')">
                                        <label for="graphic-violence">Graphic Violence</label>
                                    </div>
                                 </li>
                                 <li>
                                     <div class="option">
                                        <input id="hate-speech" name="reason" type="radio" value="hate-speech" onclick="giveReason('hide')">

                                        <label for="hate-speech">Hateful Speech or Symbols</label>
                                    </div>
                                 </li>
                                 <li>
                                     <div class="option">
                                        <input id="spam" name="reason" type="radio" value="spam" onclick="giveReason('hide')">
                                        <label for="spam">Spam</label>
                                    </div>
                                 </li>
                                 <li>
                                      <div class="option">
                                        <input id="other" name="reason" type="radio" value="other" onclick="giveReason('show')">
                                        <label for="other">Other</label>
                                    </div>
                                 </li>
                                 <li>
                                     <div id="other_reason" style="display: none">
                                        <textarea name="other_reason_text" id="other_reason_text" style="width:250px;height:36px;"></textarea>
                                        <div id="error" class="validation-message"></div>
                                    </div>
                                 </li>
                                 <li>
                                     <div class="option">
                                        <a href="#" class="Button2 Button13 WhiteButton"   onClick="report()">
                                            <strong>Report Pin</strong>
                                            <span></span>
                                        </a>
                                    </div>
                                     
                                 </li>
                            </ul>

                            </form>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <br><br><br><br><br><br>

                <div style="display: none;" id="repin_msg">
                        Repinned to <a href="#" id="board_view">beatuy.</a><br>
                        Shared with your followers. <a href="#" id="repin_view">See it now.</a>
                </div>
            </div>
                <div id="success" style="display: none">
                    <h2>Reported successfully</h2>
                </div>
        </div>
    </div>
</div>
    <a style="display: inline;" id="fancybox-close" onclick="close()"></a>
<div style="display: none;" id="fancybox-title"></div>
<a style="display: none;" href="javascript:;" id="fancybox-left">
    <span class="fancy-ico" id="fancybox-left-ico"></span>
</a>
<a style="display: none;" href="javascript:;" id="fancybox-right">
    <span class="fancy-ico" id="fancybox-right-ico"></span>
</a>
</div>
<script type="text/javascript">
function report()
{

  //dataString = $("#reportForm").serialize();
  radio = $('input:radio[name=reason]:checked').val();
  //other_reason = $("FORM TEXTAREA[name='other_reason_text']").val();
  if((radio=='other')&&($("FORM TEXTAREA[name='other_reason_text']").val()==''))
  {
          $('#error').html('Please provide a reason');
          return false;
  }
  pinId = $('#pinId').val();
  boardId = $('#boardId').val();
  dataString ='pinId='+pinId+'&boardId='+boardId+'&reason='+radio+'&ReportPin='+$("FORM TEXTAREA[name='other_reason_text']").val();

  $.ajax({
            url: "<?php echo site_url('board/reportPin');?>",
            type: "POST",
            data: dataString,
            dataType: 'json',
            cache: false,
            success: function (data) {
                $('#pop_content').hide('slow');
                $('#success').show('slow');
                $('#h2_heading').hide('slow');
        }
        });
}
function giveReason(action)
{    if(action=='show')
        $('#other_reason').show('slow');
    else
         $('#other_reason').hide('slow');

}
</script>