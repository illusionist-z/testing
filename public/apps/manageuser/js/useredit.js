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
                
                var html,title,id;
                if( res[0] !== 'new' ){
                 html = '<form id="edit_user" width="250px" height="200px"><table width="420px" height="100px" align="center" style="font-size:13px;">'
                    +'<br><tr><td>'+res[1]['id']+' </td>'
                    +'<td><input style="margin-top:10px;" type="text" value="'+ res[0].member_id +'" name="id" id="edit_user_id" disabled></td><td></td></tr>'
		    +'<tr><td>'+res[1]['name']+' </td>'
                    +'<td><input style="margin-top:10px;" type="text" value="'+ res[0].member_login_name +'" name="name" id="edit_user_name"></td></tr>'
                    +'<tr><td>Working Start Date: </td>'
                    +'<td><input style="margin-top:10px;" class="datepicker" type="text" value="'+ res[0].working_start_dt+'" name="work_sdate" id="edit_work_sdate"></td></tr>'
                    +'<tr><td>'+res[1]['dept']+'</td>'
                    +'<td><input style="margin-top:10px;" type="text" value="'+ res[0].member_dept_name +'" name="dept" id="edit_user_dept"></td><td></td></tr>'
		    +'<tr><td>'+res[1]['pos']+'</td>'
                    +'<td><input style="margin-top:10px;" type="text" value="'+ res[0].position +'" name="position" id="edit_user_pos"></td></tr>'
                    +'<tr><td>'+res[1]['mail']+' </td>'
                    +'<td><input style="margin-top:10px;" type="text" value="'+ res[0].member_mail +'" name="email" id="edit_user_email" ></td><td></td></tr>'
		    +'<tr><td>'+res[1]['pno']+'</td>'
                    +'<td><input style="margin-top:10px;" type="text" value="'+ res[0].member_mobile_tel +'" name="pno" id="edit_user_phone"></td></tr>'
                    +'<tr><td>'+res[1]['address']+' </td>'
                    +'<td colspan="4"><textarea style="margin-top:10px;"  rows="5" cols="50" name="address" style="color:black">'+ res[0].member_address +'</textarea></td></tr>'
		    +'<tr><td></td><td colspan="3"><br><a href="#" class="button" id="edit_edit">Edit</a><a href="#" class="button" id="edit_delete">Delete</a><a href="#" class="button" id="edit_close">Cancel</a></td>'
                    +'</tr></table></form>'; 
                  title = res[1]['edit'];
                  id = 0;
                    }
                    else{
                 html ='<form id="saveuser" method="post" enctype="multipart/form-data">'
                   +'<table class="row-fluid" style="font-size:13px;"><tr><td class="">'+res[1]['name']+'</td><td>'
                   +'<input style="margin-top:10px" type="text" name="username" id="uname" class="col-sm-10" placeholder="Write User Name"></td></tr>'
                   +'<tr><td> Name: </td><td><input style="margin-top:10px" type="text" name="full_name" class="col-sm-10" id="full_name" placeholder="Write your full name"></td></tr>'
                   +'<tr><td>Password </td><td><input style="margin-top:10px" type="password" name="password" class="col-sm-10" id="pass" placeholder="Write Password"></td></tr>'
                   +'<tr><td>Confirm Password </td><td><input style="margin-top:10px" type="password" name="confirm" class="col-sm-10" id="confirmpass" placeholder="Password Again"></td></tr>'
	           +'<tr><td>Working Start Date </td><td><input style="margin-top:10px" type="text" name="work_sdate" id="work_sdate" class="col-sm-10 datepicker" placeholder="Enter the first date of working"></td></tr>'
                   +'<tr><td>Department </td><td><input style="margin-top:10px" type="text" name="dept" id="dept" class="col-sm-10" placeholder="Write Department"></td></tr>'
                   +'<tr><td>Position</td><td><input style="margin-top:10px" type="text" name="position" id="pos" class="col-sm-10" placeholder="Write Position"></td></tr>'
	           +'<tr><td>Email </td><td><input style="margin-top:10px"  type="email" name="email" id="mail" class="col-sm-10" placeholder="Write Email"></td></tr>'
                   +'<tr><td>Phone Number </td><td><input style="margin-top:10px" type="text" name="phno" id="pno" class="col-sm-10" placeholder="Write Phone Number"></td></tr>'
                   +'<tr><td>Address </td><td><textarea rows="5" name="address" class="col-sm-10" placeholder="Write Address"></textarea></td></tr>'
                   +'<tr><td><br>User Role </td><td><select style="margin-top:10px" class="col-sm-10" data-toggle="select" name="user_role" id="member[user_role]">'
                   +'<option value="USER,user">User</option><option value="ADMIN,adminstrator">Admin</option></select></td></tr>'
                   +'<tr><td>'+res[1]['profile']+'</td><td><input style="margin-top:10px" type="file" name="fileToUpload" id="fileToUpload"></td></tr>'
                   +'<tr><td></td><td ><input style="margin-top:10px" type="submit" onclick="return false;" class="buttonn submit_useradd" id="add_user" value="Add User"> <input style="margin-top:10px" type="reset" class="buttonn" id="addinguser_close" value="Cancel"></td>'
                   +'</tr></table></form>';	
                   title = res[1]['add'];
                   id = 1;
                    }
            Manage.User.Dialog(html,title,id);
            }            
        });
    },
    Dialog: function (data,title,id) {
        if(!this.isOvl){
            this.isOvl=true;
           $ovl = $('#edituser');
           $ovl.css('color','black');
           $ovl.css('background','#F5F5F5');
        }
        if(id === 1){
                        $ovl.dialog({
                        autoOpen: false,
                         resizable:false,
                        height: 'auto',
                        async: false,
                        cache : false,
                        width: 'auto',
                       position: ['center', 80],
                        modal: true,
                        position:"bottom",
                        title: title
                    });                
                    $ovl.html(data);
                    $ovl.dialog("open");
                  $('.datepicker').on('click',function(e){
                          e.preventDefault();                                                    
                         $(this).removeClass('datepicker').datepicker( { dateFormat:"yy-mm-dd",                                                                                           
                            }).focus();                               
                     }); 
                    $('.submit_useradd').click(function(){
                       UserAdd.Submit();
                    });
                    $('#addinguser_close').unbind().bind('click',function(){
                        $ovl.dialog("close");
                        this.isOvl=false;
                    });                    
        }
        else{
                    $ovl.dialog({
                        autoOpen: false,
                        height: 'auto',
                        async: false,     
                        cache : false,
                        resizable:false,
                        width: 'auto',
                        position:'center',
                        modal: true,
                        title: title
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
                    $('.datepicker').on('click',function(e){
                          e.preventDefault();                                                    
                         $(this).removeClass('datepicker').datepicker( { dateFormat:"yy-mm-dd",                                                                                           
                            }).focus();                               
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
             resizable:false,
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

