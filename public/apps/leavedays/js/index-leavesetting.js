
var Categories = {
    isOvl:false,
     DeleteDia : function (d){
        $.ajax({
            
           url:"ltypedia?id="+d,
           type: "GET",
           success:function(res){               
               var result = $.parseJSON(res);
               
               var data ='<form id="edit_ltype_table"><table>';               
                   data += '<tr><td></td><td><input type="hidden"  value="'+result[0]['leavetype_id']+ '" name="id" ></td></tr>'
                        +'<tr><td>'+result[1]['delete_confirm']+'"'+result[0]['leavetype_name']+ '"?</td>'
                        +'<tr></tr><br>'
                         +'<tr><td></td></tr>';             
               data +='<tr><td style="padding-top: 13px;"><a href="#" class="button" id="delete_ltype">'+result[1]['yes']+'</a><a href="#" class="button" id="edit_close">'+result[1]['no']+'</a></td></tr>';
               data +='</table></form>';
               Categories.Dia(data,result[1]['del_title']);
           }
        });
        },
    Dia : function (d,title){
        if(!this.isOvl){
            this.isOvl=true;
        }
        
        $ovl = $('#edit_ltype_dia');
        $ovl.css('color','black');
        $ovl.css('background','#F5F5F5');
        $ovl.dialog({
            autoOpen: false,
            height: 'auto',
            async:false,
            resizable:false,
            width: 'auto',
            modal: true,
            title:title
        });                        
        $ovl.html(d);
        $ovl.dialog("open");
         

        $('#delete_ltype').on('click',function(){
            Categories.Delete($ovl);
        }); 
        $('#edit_close').on('click',function(){
           $ovl.dialog("close");
            //$('body').load('leavedays');
        });       
    },
 
    Delete : function(d){
        var form=$('#edit_ltype_table');
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : "deleteListType",
            success:function(){
                
                d.dialog("close");             

            }
        }).done(function(){
            location.reload();
        });
    },
     Add : function (){
      
        $.ajax({
            
           url:"add_ltype",
           type: "get",
           success:function(d){   
              var result = $.parseJSON(d);
               var data ='<form id="Add_new_ltype"><table>';               
                   data += '<tr><td></td></tr>'
                        +'<tr><td> '+result[1]['leave_category']+'</td><td><input type="text"   value="" name="ltype_name" placeholder="'+result[1]['enterltp']+'"></td>'
                        +'<tr><td></td></tr>';             
               data +='<tr><td></td><td colspan="3"><a href="#" class="button" id="Add_ltype">'+result[1]['yes']+'</a><a href="#" class="button" id="cancel_ltype">'+result[1]['no']+'</a></td></tr>';
               data +='</table></form>';
               Categories.Diaadd(data,result[1]['addleavetype']);
           }
        });
        },
       Diaadd : function (d,title){
        if(!this.isOvl){
            this.isOvl=true;
        }        
        
        $ovl = $('#add_new_ltype');
        $ovl.css('color','black');
        $ovl.css('background','#F5F5F5');
        $ovl.dialog({
            autoOpen: false,
            height: 'auto',
            async:false, 
            resizable:false,
            width: 'auto',
            modal: true,
            title:title
        });                        
        $ovl.html(d);
        $ovl.dialog("open");
        $('#Add_ltype').on('click',function(){
            Categories.AddNew($ovl);
//            location.reload();
        });  
          
        $('#cancel_ltype').on('click',function(){
           $ovl.dialog("close");
            location.reload();
        });       
    },
     AddNew : function(d){
        var form=$('#Add_new_ltype');
        var data=form.serialize();
        alert(data);
        $.ajax({
            type:'POST',
            data: form.serialize(),
          //  url : "addListType",
            success:function(){                
                d.dialog("close");                
            }
        }).done(function(){
            location.reload();
        });
    }

};
$(document).ready(function () {

   
     $(".ltypepopup").on('click',function(){
       var id = $(this).attr('id');
       Categories.DeleteDia(id);
    });
        
    
      $(".add").on('click',function(){         
      Categories.Diaadd();
    });
    
       $('.editsetting').on('click',function(){
        
        document.getElementById('max_leavedays').disabled=false;
        document.getElementById('savesetting').disabled=false;
    });
});
