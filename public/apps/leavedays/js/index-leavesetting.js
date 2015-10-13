
var Categories = {
    isOvl:false,
    DeleteDia : function (d){
        
        $.ajax({
            
           url:"ltypedia?id="+d,
           type: "GET",
           success:function(res){
               
                
               var result = $.parseJSON(res);
               
              
               var data ='<form id="edit_ltype_table"><table>';               
                   data += '<tr><td></td><td><input type="hidden" value="'+result[0]['leavetype_id']+ '" name="id" ></td></tr>'
                        +'<tr><td>Are You Sure To Delete "'+result[0]['leavetype_name']+ '"?</td>'
                       
                        +'<tr></tr><br>'
                         +'<tr><td></td></tr>';             
               data +='<tr><td style="padding-top: 13px;"><a href="#" class="button" id="delete_ltype">Yes</a><a href="#" class="button" id="edit_close">No</a></td></tr>';
               data +='</table></form>';
               Categories.Dia(data);
           }
        });
        },
    Dia : function (d){
        if(!this.isOvl){
            this.isOvl=true;
        }
        
        $ovl = $('#edit_ltype_dia');
        $ovl.dialog({
            autoOpen: false,
            height: 200,
            async:false,
            resizable:false,
            width: 400,
            modal: true,
            title:"Delete Leave Categories"
        });                        
        $ovl.html(d);
        $ovl.dialog("open");
         

        $('#delete_ltype').click(function(){
            Categories.Delete($ovl);
        }); 
        $('#edit_close').click(function(){
           $ovl.dialog("close");
            //$('body').load('leavedays');

        });       
    },
 
    Delete : function(d){
        var form=$('#edit_ltype_table');
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : "delete_ltype",
            success:function(){
                
                d.dialog("close");
                

            }
        }).done(function(){
            $('body').load('leavesetting');
        });
    },
     Add : function (){
      
        $.ajax({
            
           url:"",
           type: "POST",
           success:function(){
              
             
               
               var data ='<form id="Add_new_ltype"><table>';               
                   data += '<tr><td></td></tr>'
                        +'<tr><td>Leave Type:</td><td><input type="text" value="" name="ltype_name" placeholder="Enter Leave type"></td>'
                       
                         +'<tr><td></td></tr>';             
               data +='<tr><td></td><td colspan="3"><a href="#" class="button" id="Add_ltype">Save</a><a href="#" class="button" id="cancel_ltype">Cancel</a></td></tr>';
               data +='</table></form>';
               Categories.Diaadd(data);
           }
        });
        },
       Diaadd : function (d){
        if(!this.isOvl){
            this.isOvl=true;
        }
        
        
        $ovl = $('#add_new_ltype');
        $ovl.dialog({
            autoOpen: false,
            height: 155,
            async:false, 
            resizable:false,
            width: 400,
            modal: true,
            title:"Leave Categories Add"
        });                        
        $ovl.html(d);
        $ovl.dialog("open");
        $('#Add_ltype').click(function(){
            Categories.AddNew($ovl);
        });  
          
        $('#cancel_ltype').click(function(){
           $ovl.dialog("close");
           $('body').load('leavesetting');

        });       
    },
     AddNew : function(d){
        var form=$('#Add_new_ltype');
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : "add_ltype",
            success:function(){
                
                d.dialog("close");
                

            }
        }).done(function(){
           $('body').load('leavesetting');
        });
    }

};
$(document).ready(function () {

   
     $(".ltypepopup").click(function () {
       var id = $(this).attr('id');
       Categories.DeleteDia(id);
    });
        
    
      $(".add").click(function () {
          
      Categories.Add();
    });
    
       $('.editsetting').click(function () {
        
        document.getElementById('max_leavedays').disabled=false;
        document.getElementById('fine_amount').disabled=false;
        document.getElementById('savesetting').disabled=false;
    });
});
