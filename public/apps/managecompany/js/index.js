/**
 * @type edit
 * @since 20/7/15
 * @author David
 * @desc {dialog} for edit user profile
 */
    var Manage = {};
    Manage.Company = {
    Edit : function (type) {
        
        if(type=="edit"){
       
                 html = '<form id="saveuser" method="post" enctype="multipart/form-data">'
                   +'<table class="row-fluid" style="font-size:13px;"><tr><td class="">Company ID</td><td>'
                   +'<input style="margin-top:10px" type="text" name="uname" id="uname" value="com1" class="col-sm-10" placeholder="Write Company ID"></td></tr>'
                   +'<tr><td></td><td id="existId"></td></tr>'
                   +'<tr><td>Company Name</td><td><input style="margin-top:10px" value="gnext"  type="text" name="full_name" class="col-sm-10" id="full_name" placeholder="Wirte Company Name"></td></tr>'
                   +'<tr><td>Starting Date</td><td><input style="margin-top:10px" type="text" value="2016-01-01"name="password" class="datepicker col-sm-10" id="pass" placeholder="Write Company Starting Date"></td></tr>'
                   +'<tr><td>Email</td><td><input style="margin-top:10px" type="text" name="" value="gnext@mail.com" class=" col-sm-10" id="pass" placeholder="Write Email "></td></tr>'
                   +'<tr><td>Phone Number</td><td><input style="margin-top:10px" type="text" name="" value="35366373" class=" col-sm-10" id="pass" placeholder="Write Phone Number "></td></tr>'
                   +'<tr><td>Database Name</td><td><input style="margin-top:10px" type="text" name="" value="attsys_db" class=" col-sm-10" id="pass" placeholder="Write Database Name "></td></tr>'
                   +'<tr><td>DB UserName</td><td><input style="margin-top:10px" type="text" name="" class=" col-sm-10" value="root" id="pass" placeholder="Write Database Username "></td></tr>'
                   +'<tr><td>DB Password</td><td><input style="margin-top:10px" type="text" name="" class=" col-sm-10" value="root" id="pass" placeholder="Write Database Password"</td></tr>'
                   +'<tr><td>Host</td><td><input style="margin-top:10px" type="text" name="" class=" col-sm-10" id="pass" value="localhost" placeholder="Write Host Name "></td></tr>'
                   +'<tr><td>User Limit</td><td><input style="margin-top:10px" type="text" name="" class=" col-sm-10" id="pass" value="400" placeholder="Write User Limit "></td></tr>'
                   +'<tr><td>Module Flag</td><td><input style="margin-top:10px" type="text" name="" class=" col-sm-10" id="pass" value=" "placeholder="Module Flag "></td></tr>'
                   +'<tr><td></td><td ><input style="margin-top:10px" type="submit" onclick="return false;" class="buttonn submit_useradd" id="add_user" value="Add Company"> <input style="margin-top:10px" type="reset" class="buttonn" id="edit_close" value="Cancel"></td>'
                   +'</tr></table></form>'; 
                  title ="Edit Company  ";
                  id = 0;
                    }
                    else{
                           
                     
                 html ='<form id="saveuser" method="post" enctype="multipart/form-data">'
                   +'<table class="row-fluid" style="font-size:13px;"><tr><td class="">Company ID</td><td>'
                   +'<input style="margin-top:10px" type="text" name="uname" id="uname" class="col-sm-10" placeholder="Write Company ID"></td></tr>'
                   +'<tr><td></td><td id="existId"></td></tr>'
                   +'<tr><td>Company Name</td><td><input style="margin-top:10px" type="text" name="full_name" class="col-sm-10" id="full_name" placeholder="Wirte Company Name"></td></tr>'
                   +'<tr><td>Starting Date</td><td><input style="margin-top:10px" type="text" name="password" class="datepicker col-sm-10" id="pass" placeholder="Write Company Starting Date"></td></tr>'
                   +'<tr><td>Email</td><td><input style="margin-top:10px" type="text" name="password" class=" col-sm-10" id="pass" placeholder="Write Email "></td></tr>'
                   +'<tr><td>Phone Number</td><td><input style="margin-top:10px" type="text" name="password" class=" col-sm-10" id="pass" placeholder="Write Phone Number "></td></tr>'
                   +'<tr><td>Database Name</td><td><input style="margin-top:10px" type="text" name="password" class=" col-sm-10" id="pass" placeholder="Write Database Name "></td></tr>'
                   +'<tr><td>DB UserName</td><td><input style="margin-top:10px" type="text" name="password" class=" col-sm-10" id="pass" placeholder="Write Database Username "></td></tr>'
                   +'<tr><td>DB Password</td><td><input style="margin-top:10px" type="text" name="password" class=" col-sm-10" id="pass" placeholder="Write Database Password"</td></tr>'
                   +'<tr><td>Host</td><td><input style="margin-top:10px" type="text" name="password" class=" col-sm-10" id="pass" placeholder="Write Host Name "></td></tr>'
                   +'<tr><td>User Limit</td><td><input style="margin-top:10px" type="text" name="password" class=" col-sm-10" id="pass" placeholder="Write User Limit "></td></tr>'
                   +'<tr><td>Module Flag</td><td><input style="margin-top:10px" type="text" name="password" class=" col-sm-10" id="pass" placeholder="Module Flag "></td></tr>'
                   +'<tr><td></td><td ><input style="margin-top:10px" type="submit" onclick="return false;" class="buttonn submit_useradd" id="add_user" value="Add Company"> <input style="margin-top:10px" type="reset" class="buttonn" id="addinguser_close" value="Cancel"></td>'
                   +'</tr></table></form>';
                
    
                   title = "Add New Company";
                   id = 1;
                    }
            Manage.Company.Dialog(html,title,id);
                      
        
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
                        //position:"bottom",
                        title: title
                    });                
                    $ovl.html(data);
                    $ovl.dialog("open");
                  $('.datepicker').on('click',function(e){
                          e.preventDefault();                                                    
                         $(this).removeClass('datepicker').datepicker( { dateFormat:"yy-mm-dd",                                                                                           
                            }).focus();                               
                     }); 
                    $('.submit_useradd').on('click',function(){
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
                    $('#edit_edit').on('click',function(e){
                        e.preventDefault();
                       Manage.User.DataChange($('#edit_user_id').val()); 
                    });
                    $('#edit_close').on('click',function(){          
                        $ovl.dialog("close");
                        this.isOvl=false;                  
                    });
                    // user delete button
                    $('#edit_delete').on('click',function(e){
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
            url : baseUri+"manageuser/index/userdata_edit?data="+id,
            data:$form.serialize(),
            dataType:'json',
            success:function(d){
                // check valid mail & phone
                if(true===d.valid){
                  location.replace('index');
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
            height:'auto',
            width:'auto',
            closeText:'',
            modal:true,
            
            buttons:{
                Yes:function(){
                   Manage.User.Confirm(d);                    
                },
                No:function(){
                    $(this).dialog("close");
                }
                
            }
            
           
        });
        $del.html("<p>Are you sure to delete ?</p>");
        $del.dialog("open");        
    },
    /**     
     * @desc confirmation delete
     */
    Confirm:function(id){
        $.ajax({
            type:'GET',
            url:baseUri+'manageuser/index/deleteuser',
            data:{data:id}            
        }).done(function(){
            $('body').load('index');
        });
    }
};


    
$(document).ready(function(){                 
$('.addnewcom').click(function () {
    type="new";
        Manage.Company.Edit(type);
    }); 
    
 $('.editnewcom').click(function () {
    type="edit";
 
        Manage.Company.Edit(type);
    }); 
  
       
});


