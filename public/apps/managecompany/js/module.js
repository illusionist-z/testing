/**
 * @type edit
 * @since 20/7/15
 * @author David
 * @desc {dialog} for edit user profile
 */
    var Manage = {};
    Manage.Module = {
    Edit : function (type) {
        
     
                    if(type=="new"){
                           
                   
                 html ='<form id="savemodule" method="post" >'
                   +'<table class="row-fluid" style="font-size:13px;"><tr><td class="">Company ID</td><td>'
                   +'<input style="margin-top:10px" type="text" name="mid" id="uname" class="col-sm-10" placeholder="Write Module ID"></td></tr>'
                   +'<tr><td></td><td id="existId"></td></tr>'
                   +'<tr><td>Company Name</td><td><input style="margin-top:10px" type="text" name="mname" class="col-sm-10" id="full_name" placeholder="Wirte Module Name"></td></tr>'
                   +'<tr><td></td><td ><input style="margin-top:10px" type="submit" onclick="return false;" class="buttonn submit_useradd" id="add_user" value="Add"> <input style="margin-top:10px" type="reset" class="buttonn" id="addinguser_close" value="Cancel"></td>'
                   +'</tr></table></form>';
                
    
                   title = "Add New Module";
                   id = 1;
                    Manage.Module.Dialog(html,title,id);
                    }
                       else{
                         
              $.ajax({
                  
              type: 'GET',
            url: baseUri+'managecompany/module/editmodule?id=' + type,
            success:function(res){
            
                   var result = $.parseJSON(res);
                  
              html = '<form id="savemodule" method="post" enctype="multipart/form-data">'
              +'<input type="hidden" id="edit_id" value="'+ result['module_id'] +'"> '
                   +'<table class="row-fluid" style="font-size:13px;"><tr><td class="">Company ID</td><td>'
                   
                   +'<input style="margin-top:10px" type="text" name="mid" id="uname" value="'+ result['module_id'] +'" class="col-sm-10" placeholder="Write Module ID" disabled></td></tr>'
                   +'<tr><td></td><td id="existId"></td></tr>'
                   +'<tr><td>Company Name</td><td><input style="margin-top:10px" value="'+ result['module_name'] +'"  type="text" name="mname" class="col-sm-10" id="full_name" placeholder="Wirte Module Name"></td></tr>'
                   +'<tr><td></td><td ><input style="margin-top:10px" type="submit" onclick="return false;" class="buttonn submit_useradd" id="edit_module" value="Edit"><input style="margin-top:10px" type="submit" class="buttonn" id="delete" value="Delete"> <input style="margin-top:10px" type="reset" class="buttonn" id="edit_close" value="Cancel"></td>'
                   +'</tr></table></form>'; 
                  title ="Edit Module  ";
                  id = 0;
                
        Manage.Module.Dialog(html,title,id);
            }
        });
   
                 
                    }
            
                      
        
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
                 
                    $('.submit_useradd').on('click',function(){
                       Manage.Module.ModuleAdd($ovl);
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
                    
                    $('#edit_module').on('click',function(e){
                       
                       Manage.Module.DataChange($('#edit_id').val()); 
                    });
                    $('#edit_close').on('click',function(){          
                        $ovl.dialog("close");
                        this.isOvl=false;                  
                    });
                    // user delete button
                    $('#delete').on('click',function(e){
                        e.preventDefault();
                        Manage.Module.Delete($('#edit_id').val());
                    });
                    $('.datepicker').on('click',function(e){
                          e.preventDefault();                                                    
                         $(this).removeClass('datepicker').datepicker( { dateFormat:"yy-mm-dd",                                                                                           
                            }).focus();                               
                     }); 
     }
    },
    ModuleAdd :function (d){
        
        var form=$('#savemodule');
  
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : "module/add_module",
            success:function(){
                
              d.dialog("close");
                

            }
        }).done(function(){
           //location.reload();
        });
   
    },
    DataChange: function (id){
  
        $form = $('#savemodule');
        $.ajax({
            type:"GET",
            url : baseUri+"managecompany/module/updatemodule?id="+id,
            data:$form.serialize(),
           
            success:function(d){
               location.reload();
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
                   Manage.Module.Confirm(d);                    
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
            type:"GET",
            url : baseUri+"managecompany/module/deletemodule?id="+id,
     
           
            success:function(d){
               location.reload();
            }
        });
    }
};


    
$(document).ready(function(){      
         dict= [];
             $.ajax({
                url:'module/getmodulename',
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
                
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
                 // alert(json_obj[i].member_login_name);
                dict.push(json_obj[i].module_id);
                }   
                }                        
              }); 
         
  document.getElementById('confirm').style.display = 'none';

 $('#msearch').on('click',function(){
        $(this).autocomplete({
                      source: function( request, response ) {                                       
                            var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" ); 
                            var result = $.grep( dict, function( item ){                 
                                       return matcher.test( item);
                                      });
                                response(result.slice(0, 10));
                         },
                          minLength :1
        });
    });

$('.addnewmodule').click(function () {
    type="new";
        Manage.Module.Edit(type);
    }); 
    
 $('.editnewmodule').click(function () {
    type="edit";
 var id = $(this).attr('id');  
 
        Manage.Module.Edit(id);
    }); 
  
       
});


