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
                 html = '<form id="edit_user" width="250px" height="200px"><table width="500px" height="300px" align="center" >'
                    +'<br><tr><td><b>User ID </b></td>'
                    +'<td><input type="text" value="'+ res.member_id +'" name="id" id="edit_user_id" disabled></td><td></td></tr>'
		    +'<tr><td><b>User Name </b></td>'
                    +'<td><input type="text" value="'+ res.member_login_name +'" name="name" id="edit_user_name"></td></tr>'
                    +'<tr><td><b>Department </b></td>'
                    +'<td><input type="text" value="'+ res.member_dept_name +'" name="dept" id="edit_user_dept"></td><td></td></tr>'
		    +'<tr><td><b>Position </b></td>'
                    +'<td><input type="text" value="'+ res.job_title +'" name="position" id="edit_user_pos"></td></tr>'
                    +'<tr><td><b>Email </b></td>'
                    +'<td><input type="text" value="'+ res.member_mail +'" name="email" id="edit_user_email" ></td><td></td></tr>'
		    +'<tr><td><b>Phone Number </b></td>'
                    +'<td><input type="text" value="'+ res.member_mobile_tel +'" name="pno" id="edit_user_phone"></td></tr>'
                    +'<tr><td><b>Address </b></td>'
                    +'<td colspan="4"><textarea rows="5" cols="50" name="address" style="color:black">'+ res.member_address +'</textarea></td></tr>'
		    +'<tr><td></td><td colspan="3"><br><a href="#" class="button" id="edit_edit">Edit</a><a href="#" class="button" id="edit_delete">Delete</a><a href="#" class="button" id="edit_close">Cancel</a></td>'
                    +'</tr></table></form>'; 
                  title = "Edit User";
                    }
                    else{
                 html ='<form id="saveuser" method="post" enctype="multipart/form-data">'
                   +'<table class="row-fluid"><tr><td class="col-sm-8"><b>User Name </b></td><td>'
                   +'<input type="text" name="username" id="uname" class="col-sm-10" placeholder="Write User Name"></td></tr>'
                   +'<tr><td class="col-sm-8"><b>Password </b></td><td><input type="password" name="password" class="col-sm-10" id="pass" placeholder="Write Password"></td></tr>'
                   +'<tr><td class="col-sm-8"><b>Confirm Password </b></td><td><input type="password" name="confirm" class="col-sm-10" id="confirmpass" placeholder="Password Again"></td></tr>'
	           +'<tr><td class="col-sm-8"><b>Department </b></td><td><input type="text" name="dept" id="dept" class="col-sm-10" placeholder="Write Department"></td></tr>'
                   +'<tr><td class="col-sm-8"><b>Position</b></td><td><input type="text" name="position" id="pos" class="col-sm-10" placeholder="Write Position"></td></tr>'
	           +'<tr><td class="col-sm-8"><b>Email </b></td><td><input type="email" name="email" id="mail" class="col-sm-10" placeholder="Write Email"></td></tr>'
                   +'<tr><td class="col-sm-8"><b>Phone Number </b></td><td><input type="text" name="phno" id="pno" class="col-sm-10" placeholder="Write Phone Number"></td></tr>'
                   +'<tr><td class="col-sm-8"><b>Address </b></td><td><textarea rows="5" name="address" class="col-sm-10" placeholder="Write Address"></textarea></td></tr>'
                   +'<tr><td class="col-sm-8"><br><b>User Role </b></td><td><select class="col-sm-10" data-toggle="select" name="user_role" id="member[user_role]">'
                   +'<option value="USER,user">User</option><option value="ADMIN,adminstrator">Admin</option></select></td></tr>'
                   +'<tr class="jumbotron alert"><td><img src="../../common/img/profile.png" ></td><td><input type="file" name="fileToUpload" id="fileToUpload"></td></tr>'
                   +'<tr><td></td><td><input type="submit" onclick="return false;" class="buttonn submit_useradd" value="Add User"><input type="reset" class="buttonn" id="addinguser_close" value="Cancel"></td>'
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
                        height: 650,
                        async: false,     
                        cache : false,
                        width: 600,
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
                        height: 460,
                        async: false,     
                        cache : false,
                        width: 530,
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

