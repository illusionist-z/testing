/**
 * 
 * @author Su Zin
 * @desc   Allowance Edit Dial Box
 */
var Allowance = {
    isOvl:false,
    Edit : function (d){
        
        $.ajax({
            
           url:"editallowance?id="+d,
           type: "GET",
           success:function(res){
//               alert(res);alert("aa");
               
               var result = $.parseJSON(res);
               
               var data ='<form id="edit_all"><table>';               
                   data += '<tr><td>Allowance Name :</td><td><input type="text" value="'+result[0]['allowance_name']+ '" name="name"></td>'
                        +'<td>Allowance Amount:</td><td><input type="text" value='+result[0]['allowance_amount']+ ' name="allowance_amount"></td></tr>'
                         +'<tr><td></td><td><input type="hidden" value='+result[0]['allowance_id']+ ' name="id"></td><td></td></td></tr>';             
               data +='<tr><td></td><td colspan="3"><a href="#" class="button" id="edit_allowance_edit">Save</a><a href="#" class="button" id="all_delete">Delete</a><a href="#" class="button" id="edit_close">Cancel</a></td></tr>';
               data +='</table></form>';
               Allowance.Dia(data);
           }
        });
        },
    Dia : function (d){
        if(!this.isOvl){
            this.isOvl=true;
        }
        
        $ovl = $('#edit_all_dia');
        $ovl.dialog({
            autoOpen: false,
            height: 200,
            async:false,            
            width: 650,
            modal: true,
            title:"Allowance Edit"
        });                        
        $ovl.html(d);
        $ovl.dialog("open");
        $('#edit_allowance_edit').click(function(){
            Allowance.BtnEdit($ovl);
        });  
        $('#all_delete').click(function(){
             Allowance.Delete($ovl);
        });   
        $('#edit_close').click(function(){
           $ovl.dialog("close");
        });       
    },
    BtnEdit : function(d){
        var form=$('#edit_all');
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : "edit_data",
            success:function(){
                
                d.dialog("close");
            }
        }).done(function(){
            $('body').load('allowance');
        });
    },
     Delete : function(d){
         $del = $('#confirm');

          $del.dialog({
            autoOpen:false,
            height:190,
            width:350,
            closeText:'',
            modal:true,
            buttons:{
                Delete:function(){
                    Allowance.Confirm(d);
                },
                Cancel:function(){
                    $(this).dialog("close");
                }
            }
           
        });
         $del.html("<p>Are u sure to delete?</p>");
        $del.dialog("open");  
    },
    Confirm :function(d){
                var form=$('#edit_all');
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : "delete_data",
            success:function(){
                
                d.dialog("close");
            }
        }).done(function(){
            $('body').load('allowance');
        });
    }
    
    
};
$(document).ready(function () {

   
     $(".allpopup").click(function () {
       var id = $(this).attr('id');
       Allowance.Edit(id);
    });
});
