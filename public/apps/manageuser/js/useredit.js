/**
 * @type edit
 * @since 20/7/15
 * @author David
 * @desc {dialog} for edit user profile
 */
    var Manage = {}; 
    Manage.User = {
    Edit : function (type) {
        $.ajax({
            type: 'GET',
            url: 'manageuser?data=' + type,
            dataType:'json',
            success: function (res) {
                var html,title;
                if( res !== 'new' ){
                 html = '<form id="edit_user" width="250px" height="200px"><table width="400px" height="100px" align="center"  >'
                    +'<br><tr><td style="font-size:13px;">User ID </td>'
                    +'<td><input style="font-size:13px;margin-top:10px;" type="text" value="'+ res.member_id +'" name="id" id="edit_user_id" disabled></td><td></td></tr>'
		    +'<tr><td style="font-size:13px;">User Name </td>'
                    +'<td><input style="font-size:13px;margin-top:10px;" type="text" value="'+ res.member_login_name +'" name="name" id="edit_user_name"></td></tr>'
                    +'<tr><td style="font-size:13px;">Department </td>'
                    +'<td><input style="font-size:13px;margin-top:10px;"  type="text" value="'+ res.member_dept_name +'" name="dept" id="edit_user_dept"></td><td></td></tr>'
		    +'<tr><td style="font-size:13px;">Position </td>'
                    +'<td><input style="font-size:13px;margin-top:10px;"  type="text" value="'+ res.job_title +'" name="position" id="edit_user_pos"></td></tr>'
                    +'<tr><td style="font-size:13px;">Email </td>'
                    +'<td><input style="font-size:13px;margin-top:10px;" type="text" value="'+ res.member_mail +'" name="email" id="edit_user_email" ></td><td></td></tr>'
		    +'<tr><td style="font-size:13px;">Phone Number </td>'
                    +'<td><input style="font-size:13px;margin-top:10px;" type="text" value="'+ res.member_mobile_tel +'" name="pno" id="edit_user_phone"></td></tr>'
                    +'<tr><td style="font-size:13px;">Address </td>'
                    +'<td colspan="4"><textarea style="font-size:13px;" rows="5" cols="50" name="address" style="color:black">'+ res.member_address +'</textarea></td></tr>'
		    +'<tr><td></td><td colspan="3"><br><a href="#" class="button" id="edit_edit">Edit</a><a href="#" class="button" id="edit_delete">Delete</a><a href="#" class="button" id="edit_close">Cancel</a></td>'
                    +'</tr></table></form>'; 
                  title = "Edit User";
                    }
                    else{
                 html ='<form id="saveuser" method="post" enctype="multipart/form-data">'
                   +'<table class="row-fluid"  style="width:550px;height:300px;" ><tr><td class="col-sm-8" style="font-size:13px;"><b>User Name </b></td><td>'
                   +'<input style="font-size:13px;margin-top:10px;width:200px;" type="text" name="username" id="uname" class="col-sm-10" placeholder="Write User Name"></td></tr>'
                   +'<tr><td class="col-sm-8" style="font-size:13px;"><b>Password </b></td><td><input style="font-size:13px;margin-top:10px;width:200px;" type="password" name="password"  id="pass" placeholder="Write Password"></td></tr>'
                   +'<tr><td class="col-sm-8" style="font-size:13px;"><b>Department </b></td><td><input style="font-size:13px;margin-top:10px;width:200px;" type="text" name="dept" id="dept"  placeholder="Write Department"></td></tr>'
                   +'<tr><td class="col-sm-8" style="font-size:13px;"><b>Position</b></td><td><input style="font-size:13px;margin-top:10px;width:200px;" type="text" name="position" id="pos"  placeholder="Write Position"></td></tr>'
	           +'<tr><td class="col-sm-8" style="font-size:13px;" ><b>Email </b></td><td><input style="font-size:13px;margin-top:10px;width:200px;" type="email" name="email" id="mail"  placeholder="Write Email"></td></tr>'
                   +'<tr><td class="col-sm-8" style="font-size:13px;" ><b>Phone Number </b></td><td><input style="font-size:13px;margin-top:10px;width:200px;" type="text" name="phno" id="pno"  placeholder="Write Phone Number"></td></tr>'
                   +'<tr><td class="col-sm-8" style="font-size:13px;" ><b>Address </b></td><td><textarea style="font-size:13px;width:200px;" rows="3" name="address"  placeholder="Write Address"></textarea></td></tr>'
                   +'<tr><td class="col-sm-8" style="font-size:13px;" ><br><b>User Role </b></td><td><select style="font-size:13px;margin-top:10px;width:200px;"  data-toggle="select" name="user_role" id="member[user_role]">'
                   +'<option value="USER,user" style="font-size:13px;" >User</option><option value="ADMIN,adminstrator">Admin</option></select></td></tr>'
                   +'<tr><td style="font-size:13px;">User Picture</td><td><input type="file" name="fileToUpload" id="fileToUpload"></td></tr>'
                   +'<tr><td></td><td><br><input style="font-size:13px;" type="submit" onclick="return false;" class="buttonn submit_useradd" value="Add User"> <input style="font-size:13px;" type="reset" class="buttonn" id="addinguser_close" value="Cancel"></td>'
                   +'</tr></table></form>';	
                   title = "Add User";
                    }
            Manage.User.Dialog(html,title);
            }            
        });
    },
    Dialog: function (data,type) {
        if(!this.isOvl){
            this.isOvl=true;
           $ovl = $('#edituser');
           $ovl.css('color','black');
           $ovl.css('background','#F5F5F5');
        }
        if(type === 'Add User'){
                        $ovl.dialog({
                        autoOpen: false,
                        height: 520,
                        async: false,     
                        cache : false,
                        width: 580,
                        modal: true,
                        position:"bottom",
                        title: type
                    });                
                    $ovl.html(data);
                    $ovl.dialog("open");
                    $('.submit_useradd').click(function(){
                       UserAdd.Submit();
                    });
                    $('#addinguser_close').click(function(){
                        $ovl.dialog("close");
                        this.isOvl=false;
                    });
        }
        else{
                    $ovl.dialog({
                        autoOpen: false,
                        resizable:false,
                        height: 500,
                        async: false,     
                        cache : false,
                        width: 500,
                        position:'center',
                        modal: true,
                        title: type
                    });                
                    $ovl.html(data);
                    $ovl.dialog("open");
                    // user edit button
                    $('#edit_edit').click(function(e){
                        e.preventDefault();
                       Manage.User.DataChange($('#edit_user_id').val()); 
                    });
                    $('#edit_close').click(function(){            
                        $ovl.dialog("close");
                        this.isOvl=false;                  
                    });
                    // user delete button
                    $('#edit_delete').click(function(e){
                        e.preventDefault();
                        Manage.User.Delete($('#edit_user_id').val());
                    });
    }
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
                  location.replace('userlist');
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
                   Manage.User.Confirm(d);                    
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

