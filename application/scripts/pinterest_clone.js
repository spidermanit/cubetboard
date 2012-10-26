/*CREATE A BOARD--- HEADER PAGE */
function createBoard()
{
dataString = $("#create_board").serialize();
var name                 = $("input#BoardName").val();
var category             = $("input#id_category").val();
var collaborator_radio    = $('input:radio[name=change_BoardCollaborators]:checked').val();
var collaborator         = $("input#collaborator_name").val();

failed= 0;
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

/*LIKE A PIN*/
/*ACTIVITY VIEW PAGE, ALL PIN VIEW PAGE ,BOARD VIEW PAGE*/
function pinLike(val)
{
    dataString = val;
    $.ajax({
            url:  baseUrl+ 'pins/saveLikes',
            type: "POST",
            data: dataString,
            dataType: 'json',
            cache: false,
            success: function (data) {
            current =  $('#likecount').html();
            count = parseFloat(current) + parseFloat(1);
            $('#likecount').html(count);
        }
        });
}

/*COMMENT A PIN*/
/*ACTIVITY VIEW PAGE,ALL PIN VIEW PAGE,BOARD VIEW PAGE*/
function addComment(val)
{
    var comment   = $("textarea#"+val+'_comment').val();
    dataString = 'id='+val+'&comment='+comment;
    //alert(dataString);
    if((comment=='')||(comment=='Add a comment...'))
    {
            return false;
    }
    $.ajax({
            url: baseUrl+'board/addComment',
            type: "POST",
            data: dataString,
            dataType: 'json',
            cache: false,
            success: function (data) {
            $('#'+val+'_comment_div').append(data);
            currentComment =  $('.CommentsCount_'+val).html();
            var substr = currentComment.split(' ');
            count = parseFloat(substr[0]) + parseFloat(1);
            $('.CommentsCount_'+val).html(count + ' ' +substr[1]);
            //alert(substr[0]);
        }
        });
}

/*CLEAR A COMMENT*/
/*ACTIVITY VIEW PAGE, ALL PIN VIEW PAGE,BOARD VIEW PAGE*/
function clearComment(value)
{
      $("textarea#"+value).val('');
}





/*EDIT PIN */
/*EDIT PIN VIEW PAGE*/
function pinEdit()
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
            $('#error'+key).html("please enter a value!")
            var failed= true;
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




/*EDIT BOARD*/
/*EDIT BOARD VIEW PAGE*/
function editBoard()
{
   dataString = $("#BoardEdit").serialize();
   //alert(dataString);
   var name                 = $("input#edit_BoardName").val();
   //var category             = $("input#edit_id_category").val();
   //var collaborator_radio    = $('input:radio[name=edit_change_BoardCollaborators]:checked').val();
   //var collaborator         = $("input.edit_collaborator_name").val();

   //var change_BoardCollaborators   = $("input#change_BoardCollaborators").val();
   //alert(category);
   //alert(collaborator_radio);
   //alert('hereeeee');
   failed =0;
   $('#edit_name_error').html(" ") ;
   if(name=="")
   {
       failed = 1
       $('#edit_name_error').html("please enter board name!") ;
   }
   /*
   if(category=='')
   {
       failed = 1
       $('#edit_category_error').html("please select a category!") ;
   }
   if((collaborator=='Name or Email Address')&&(collaborator_radio=='multiple'))
   {
       failed = 1
       $('#edit_collaborator_error').html("please enter collaborator!") ;
   }*/
   //alert(failed)
   if(failed==1)
   {
     return false;
   }
   $('#loading').show('');
   $.ajax({
    url: baseUrl+'board/editSave',
    type: "POST",
    data: dataString,
    dataType: 'json',
    cache: false,
    success: function (data) {
    $('#loading').hide('');
    $('#message').html("updated successfuly!") ;
}
});

}

/*RESET PASSWORD*/
/*NEW PASS VIEW PAGE*/
function resetpass()
{

    var new1   = $("input#id_new_password1").val();
    var new2   = $("input#id_new_password2").val();
    failed= 0;
    $('#reset_pass1_null_error').html("")
    $('#reset_pass2_null_error').html("")
    $('#reset_missmatch_error').html("")
    if(new1=='')
    {
      failed = 1;
      $('#reset_pass1_null_error').html("please enter a value!")
    }
    if(new2=='')
    {
      failed = 1;
      $('#reset_pass2_null_error').html("please enter a value!")
    }
    if(new1!=new2)
    {
     failed = 1;
      $('#reset_missmatch_error').html("password missmatch!")
    }
    if(failed==1)
       return false;
    else
       return true;
}
