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
               //alert(res);
               
               var result = $.parseJSON(res);
               
               var data ='<form id="edit_all" width="250px" height="200px"><table width="450px" height="150px"   align="center" style="font-size:13px;" >';               
                   data += '<br><tr><td >'+result[1]['allowance_name']+'</td><td><input style="margin-top:10px;font-size:13px;" type="text" value="'+result[0]['allowance_name']+ '" name="name"></td></tr>'
                        +'<tr><td >'+result[1]['allowance_amt']+'</b></td><td><input style="margin-top:10px;font-size:13px;" type="text" value='+result[0]['allowance_amount']+ ' name="allowance_amount"></td></tr>'
                         +'<tr><td></td><td><input type="hidden" value='+result[0]['allowance_id']+ ' name="id"></td></td></tr>';             
               data +='<tr><td></td><td colspan="3" ><a href="#" class="button" id="edit_allowance_edit" >'+result[1]['save']+'</a><a href="#" class="button" id="all_delete" >'+result[1]['delete']+'</a><a href="#" class="button" id="edit_close" >'+result[1]['cancel']+'</a></td></tr>';
               data +='</table></form>';
               Allowance.Dia(data,result[1]['allowance_edit']);
           }
        });
        },
    Dia : function (d,title){
        if(!this.isOvl){
            this.isOvl=true;
        }
        
        $ovl = $('#edit_all_dia');
        $ovl.css('color','black');
        $ovl.css('background','#F5F5F5');
        $ovl.dialog({
            autoOpen: false,
            height: 260,
            resizable:false,
            async:false,            
            width: 500,
            modal: true,
            title:title,
           /* show:{
                effect:"explode",//effect:"blind",
		duration:200
	    },
            hide:{
		effect:"explode",
		duration:200
	    }*/
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
        $del.css('color','black');
        $del.css('background','#F5F5F5');
          $del.dialog({
            autoOpen:false,
            height:190,
            width:350,
            closeText:'',
            modal:true,
            title:"Confirm Delete",
            buttons:{
                Delete:function(){
                    Allowance.Confirm(d);
                },
                Cancel:function(){
                    $(this).dialog("close");
                }
            }
           
        });
         $del.html("<p>Are u sure to <b style='color:red'>delete</b> ?</p>");
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
