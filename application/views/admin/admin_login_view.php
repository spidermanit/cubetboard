<?php $this->load->view('admin/admin_header');?>
<div  class="clearfix">
    <div class="login_wrapper">
        <div id="Content_Wrapper">
            <div class="login_holder">
                <div class="Box_login">
                    <div class="Box_Head_login"></div>
                        <div class="Box_Content_login">
                            <div id="Shorts_key" class="sub_box">
                                <span class="heading">
                                     <h2>LOGIN</h2>
                                </span>
                                <form>
                                    <ul class="login_ul">
                                        <li>
                                            <span id="user_id" >
                                               <label>username</label>
                                               <input type="text" name="username" id="username" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value="username"/>
                                           </span>
                                        </li>
                                        <li>
                                            <span id="pass_id">
                                               <label>password</label>
                                               <input type="password" name="password" id="password" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value="password"/>
                                           </span>

                                        </li>
                                        <li>
                                            <span id="submit_id">
                                                <input type="button" name="sumbit" value="submit" id="submit" class="Button2 Button13 WhiteButton" onclick="return validateLogin()"/>
                                            </span>
                                        </li>
                                        <li>
                                            <div id="loading" style="display:none"></div>
                                            <div id="message" class="validation-message"></div>
                                        </li>
                                    </ul>
                                </form>

                                <div id="bar_chat_wrapper" class="k-content">
                                    <div class="chart-wrapper">
                                        <div id="chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>
</div>
 
<script type="text/javascript">
function validateLogin()
{   
    username = $('input#username').val()
    password = $('input#password').val()
    if((username=="")||(password==""))
    {     
            $('#message').html('Enter input details');
            return false;
    }
    val ='username='+username+'&password='+password;
    $('#submit_id').hide();
    $('#loading').show();
    $('#message').html('');
    $.ajax({
	        url: baseUrl+"administrator/login",
	        type: "POST",
	        data: val,
            dataType: 'json',
	        success: function(data){
               if(data==true)
               window.location.replace(baseUrl+"administrator/index");
               else
                   {
                       $('#submit_id').show();
                       $('#loading').hide();
                       $('#message').html('');
                       $('#message').html('invalid login');
                   }
                  
            }
        })
    
}
</script>