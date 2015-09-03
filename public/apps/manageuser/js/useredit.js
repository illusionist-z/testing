/**
 * @type edit
 * @since 20/7/15
 * @author David
 * @desc {dialog} for edit user profile
 */
var User = {
    isOvl:false,
    Edit: function (id) {
        $.ajax({
            type: 'GET',
            url: 'useredit?data=' + id,            
            dataType:'json',                                   
            success: function (res) {                 
                var html = '<form id="edit_user" width="250px" height="200px"><table width="500px" height="300px" align="center">'
                    +'<br><tr><td><small>User ID </small></td>'
                    +'<td><input style="font-size:13px;" type="text" value="'+ res.member_id +'" name="id" id="edit_user_id" disabled></td><td></td></tr>'
		    +'<tr><td><small>User Name </small></td>'
                    +'<td><input style="font-size:13px;" type="text" value="'+ res.member_login_name +'" name="name" id="edit_user_name"></td></tr>'
                    +'<tr><td><small>Department </small></td>'
                    +'<td><input style="font-size:13px;" type="text" value="'+ res.member_dept_name +'" name="dept" id="edit_user_dept"></td><td></td></tr>'
		    +'<tr><td><small>Position </small></td>'
                    +'<td><input style="font-size:13px;" type="text" value="'+ res.position +'" name="position" id="edit_user_pos"></td></tr>'
                    +'<tr><td><small>Email </small></td>'
                    +'<td><input style="font-size:13px;" type="text" value="'+ res.member_mail +'" name="email" id="edit_user_email" ></td><td></td></tr>'
		    +'<tr><td><small>Phone Number </small></td>'
                    +'<td><input style="font-size:13px;" type="text" value="'+ res.member_mobile_tel +'" name="pno" id="edit_user_phone"></td></tr>'
                    +'<tr><td><small>Address </small></td>'
                    +'<td colspan="4"><textarea rows="5" style="font-size:13px;" cols="50" name="address" style="color:black">'+ res.member_address +'</textarea></td></tr>'
		    +'<tr><td></td><td colspan="3"><br><a href="#" class="button" id="edit_edit">Edit</a><a href="#" class="button" id="edit_delete">Delete</a><a href="#" class="button" id="edit_close">Cancel</a></td>'
                    +'</tr></table></form>';                                                   
            User.Dialog(html);
            }            
        });
    },
    Dialog: function (data) {
        if(!this.isOvl){
            this.isOvl=true;
        }
        $ovl = $('#edituser');
        $ovl.css('color','black');
        $ovl.css('background','#F5F5F5');
        $ovl.dialog({
            autoOpen: false,
            height: 450,
            async: false,     
            cache : false,
            width: 530,
            modal: true,
            title:"User Edit",
           /* show:{
                effect:"explode",//effect:"blind",
		duration:200
	    },
            hide:{
		effect:"explode",
		duration:200
	    }*/
        });                
        $ovl.html(data);
        $ovl.dialog("open");
        // user edit button
        $('#edit_edit').click(function(e){
            e.preventDefault();
           User.DataChange($('#edit_user_id').val()); 
        });
        $('#edit_close').click(function(){            
            $ovl.dialog("close");
            this.isOvl=false;                  
        });
        // user delete button
        $('#edit_delete').click(function(e){
            e.preventDefault();
            User.Delete($('#edit_user_id').val());
        });
       
    },
    /**
     * @param {type} user id
     * @desc  update user data
     */
    DataChange: function (id){
        $form = $('#edit_user');
        $.ajax({
            type:"GET",
            url :"userdata_edit?data="+id,              
            data:$form.serialize(),
            dataType:'json',
            success:function(d){
                // check valid mail & phone
                if(true===d.valid){            
                  $('body').load("userlist");
                    }
                else{
                  if(false===d.mail){
                  $('#edit_user_email').val("Incorrect Email format").css("color","red");
                  repair('#edit_user_email');
                  }
              
                  if(false===d.uname){
                  $('#edit_user_name').val("Fill the blank").css("color","red");
                  repair('#edit_user_name');
                  }
              
                  if(false===d.pos){
                  $('#edit_user_pos').val("Fill Position").css("color","red");
                  repair('#edit_user_pos');
                  }
                  
                  if(false===d.dept){
                  $('#edit_user_dept').val("Fill Department name").css("color","red");
                  repair('#edit_user_dept');
                  }
                  
                  if(false===d.pno){
                  $('#edit_user_phone').val("Enter phone number").css("color","red");                 
                  repair('#edit_user_phone');
                  }
                }
            }
        });
    },
    Delete: function (d){
        
        $del = $('#confirm');
        $del.css('color','black');
        $del.css('background','#F5F5F5');
        $del.dialog({
            autoOpen:false,
            height:190,
            width:350,
            closeText:'',
            modal:true,
            
            buttons:{
                Delete:function(){
                    User.Confirm(d);                    
                },
                Cancel:function(){
                    $(this).dialog("close");
                }
                
            }
            
           
        });
        $del.html("<p>Are you sure to <b style='color:red'>delete</b> ?</p>");
        $del.dialog("open");        
    },
    /**     
     * @desc confirmation delete
     */
    Confirm:function(id){
        $.ajax({
            type:'GET',
            url:'deleteuser',
            data:{data:id}            
        }).done(function(){
            $('body').load('userlist');
        });
    }
};

