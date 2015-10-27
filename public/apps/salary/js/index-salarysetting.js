/**
 * 
 * @type Array
 * author Su Zin Kyaw
 * Salary Setting With Two Tabs
 */

var tabLinks = new Array();
    var contentDivs = new Array();

    function init() {

      // Grab the tab links and content divs from the page
      var tabListItems = document.getElementById('tabs').childNodes;
      for ( var i = 0; i < tabListItems.length; i++ ) {
        if ( tabListItems[i].nodeName == "LI" ) {
          var tabLink = getFirstChildWithTagName( tabListItems[i], 'A' );
          var id = getHash( tabLink.getAttribute('href') );
          tabLinks[id] = tabLink;
          contentDivs[id] = document.getElementById( id );
        }
      }

      // Assign onclick events to the tab links, and
      // highlight the first tab
      var i = 0;

      for ( var id in tabLinks ) {
        tabLinks[id].onclick = showTab;
        tabLinks[id].onfocus = function() { this.blur() };
        if ( i == 0 ) tabLinks[id].className = 'selected';
        i++;
      }

      // Hide all content divs except the first
      var i = 0;

      for ( var id in contentDivs ) {
        if ( i != 0 ) contentDivs[id].className = 'tabContent hide';
        i++;
      }
    }

    function showTab() {
      var selectedId = getHash( this.getAttribute('href') );

      // Highlight the selected tab, and dim all others.
      // Also show the selected content div, and hide all others.
      for ( var id in contentDivs ) {
        if ( id == selectedId ) {
          tabLinks[id].className = 'selected';
          contentDivs[id].className = 'tabContent';
        } else {
          tabLinks[id].className = '';
          contentDivs[id].className = 'tabContent hide';
        }
      }

      // Stop the browser following the link
      return false;
    }

    function getFirstChildWithTagName( element, tagName ) {
      for ( var i = 0; i < element.childNodes.length; i++ ) {
        if ( element.childNodes[i].nodeName == tagName ) return element.childNodes[i];
      }
    }

    function getHash( url ) {
      var hashPos = url.lastIndexOf ( '#' );
      return url.substring( hashPos + 1 );
    }

/**
 * 
 * @type type
 * for tax dialogbox & edit data
 * @author Su Zin Kyaw
 */

var Tax = {
    isOvl:false,
    Edit : function (d){
        
        $.ajax({
            
           url:"taxdia?id="+d,
           type: "GET",
           success:function(res){
       
                     
               var result = $.parseJSON(res);
               //edit dialog box
               var data ='<form id="edit_tax_table" width="250px" height="200px"><table width="400px" height="270px" style="font-size:13px;"  align="center" >';               
                   data += '<br><tr><td> <small>ID </small> </td><td><input style="margin-top:10px;font-size:13px;" type="text" value="'+result[0]['id']+ '" name="id"></td></tr>'
                        +'<tr><td> <small>'+result[1]['tax_from']+'</small> </td><td><input style="margin-top:10px;font-size:13px;" type="text" value='+result[0]['taxs_from']+ ' name="taxs_from"></td></tr>'
                        +'<tr><td> <small>'+result[1]['tax_to']+'</small> </td><td><input style="margin-top:10px;font-size:13px;" type="text" value='+result[0]['taxs_to']+ ' name="taxs_to" ></td></tr>'
                        +'<tr><td> <small>'+result[1]['tax_rate']+'</small> </td><td><input style="margin-top:10px;font-size:13px;" type="text" value='+result[0]['taxs_rate']+ ' name="taxs_rate"></td></tr>'
                        +'<tr><td> <small>'+result[1]['ssc_emp']+'</small> </td><td><input style="margin-top:10px;font-size:13px;" type="text" value='+result[0]['ssc_emp']+ ' name="ssc_emp"></td>'
                        +'<tr><td> <small>'+result[1]['ssc_comp']+'</small></td><td><input style="margin-top:10px;font-size:13px;" type="text" value='+result[0]['ssc_comp']+ ' name="ssc_comp"></td></tr>'
                         +'<tr><td></td></tr>';             
               data +='<tr><td></td><td colspan="3" ><a href="#" class="button" id="edit_tax" style="margin-top:10px;">'+result[1]['save']+'</a><a href="#" class="button" id="edit_close" >'+result[1]['cancel']+'</a></td></tr>';
               data +='</table></form>';
               Tax.Dia(data,result[1]['tax_edit']);
           }
        });
        },
    Dia : function (d,title){
        if(!this.isOvl){
            this.isOvl=true;
        }
        
        $ovl = $('#edit_tax_dia');
        $ovl.css('color','black');
        $ovl.css('background','#F5F5F5');
        $ovl.dialog({
            autoOpen: false,
            height: 'auto',
            async:false,  
            resizable:false,
            width: 'auto',
            modal: true,
            title:title,
            /*show:{
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
        $('#edit_tax').click(function(){
            Tax.BtnEdit($ovl);
            
        });  
          
        $('#edit_close').click(function(){
           $ovl.dialog("close");
         
           location.reload();
        });       
    },
    //edit data
    BtnEdit : function(d){
        var form=$('#edit_tax_table');
        
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : "edit_tax",
            success:function(){
                
                d.dialog("close");
               
            }
        }).done(function(){
            location.reload();
        });
    }
     
    
    
    
};
/**
 * 
 * @type type
 * add/edit/delete dialog box for deduction
 * @author Su Zin Kyaw
 */
var Deduction = {
    isOvl:false,
   Edit : function (d){
        
        $.ajax({
            
           url:"dectdia?id="+d,
           type: "GET",
           success:function(res){          
               
               var result = $.parseJSON(res);             
               console.log(result);
               var data ='<form id="edit_deduct_table"><table style="font-size:13px;">';               
                   data += '<tr><td></td><td><input type="hidden" value="'+result[0]['deduce_id']+ '" name="id" ></td></tr>'
                        +'<tr><td><small>'+result[1]['deduct_name']+'</small></td><td><input style="margin-top:10px;font-size:12px;" type="text" value='+result[0]['deduce_name']+ ' name="deduce_name"></td></tr>'
                        +'<tr><td><small>'+result[1]['deduct_amt']+'</small></td><td><input style="margin-top:10px;font-size:12px;" type="text" value='+result[0]['amount']+ ' name="amount"></td></tr>'
                        
                         +'<tr><td></td></tr>';             
               data +='<tr><td></td><td colspan="3"><br><a href="#" class="button" id="edit_deduct">'+result[1]['save']+'</a><a href="#" class="button" id="delete_deduct">'+result[1]['delete']+'</a><a href="#" class="button" id="edit_close">'+result[1]['cancel']+'</a></td></tr>';
               data +='</table></form>';
               Deduction.Dia(data,result[1]['deduce_frm']);
           }
        });
        },
    Dia : function (d,title){
        if(!this.isOvl){
            this.isOvl=true;
        }
        
        $ovl = $('#edit_dect_dia');
        $ovl.css('color','black');
        $ovl.css('background','#F5F5F5');
        $ovl.dialog({
            autoOpen: false,
            height: 'auto',
            async:false,            
            width: 'auto',
            modal: true,
            title:title
        });                        
        $ovl.html(d);
        $ovl.dialog("open");
        $('#edit_deduct').click(function(){
            Deduction.BtnEdit($ovl);
        });  

        $('#delete_deduct').click(function(){
            
            Deduction.Delete($ovl);
        }); 
        $('#edit_close').click(function(){
           $ovl.dialog("close");
           location.reload();

        });       
    },
    BtnEdit : function(d){
        var form=$('#edit_deduct_table');
       //alert(form.serialize());
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : "edit_deduct",
            success:function(){
                
                d.dialog("close");
                

            }
        }).done(function(){
           location.reload();
        });
    },
    Delete : function(d){
        $del = $('#confirm');
        $del.css('color','black');
        $del.css('background','#F5F5F5');
          $del.dialog({
            autoOpen:false,
            height:'auto',
            width:'auto',
            closeText:'',
            resizable:false,
            title:'Confirm Delete',
            modal:true,
            buttons:{
                Yes:function(){
                    Deduction.Confirm(d);
                },
                No:function(){
                    $(this).dialog("close");
                }
            }
           
           
        });
         $del.html("<p>Are u sure to delete?</p>");
        $del.dialog("open"); 

    },
    Confirm:function(d){
                var form=$('#edit_deduct_table');
       
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : "delete_deduct",
            success:function(){
                
                d.dialog("close");
                

            }
        }).done(function(){
           location.reload();
        });
    },
       Diaadd : function (d,title){
        if(!this.isOvl){
            this.isOvl=true;
        }
        
        $ovl = $('#add_new_dt');
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
        $ovl.css('color','black');
        $ovl.css('background','#F5F5F5');
        $('#Add_deduct').click(function(){
            Deduction.AddNew($ovl);
        });  
          
        $('#cancel_deduct').click(function(){
           $ovl.dialog("close");
           location.reload();

        });       
    },
     AddNew : function(d){
        var form=$('#Add_new_deduct');
    
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : "add_dect",
            success:function(){
                
                d.dialog("close");
                

            }
        }).done(function(){
           location.reload();
        });
    },
      Add : function (){
        //alert("add");
        $.ajax({
            
           url:"show_add_dect",
           type: "get",
           success:function(d){          
            var result = $.parseJSON(d); 
               
               var data ='<form id="Add_new_deduct"><table>';               
                   data += '<tr><td></td></tr>'
                        +'<tr><br><td><small>'+result[1]['deduce_name']+'</small> </td><td style="font-size:10px;"><input style="margin-top:10px;" type="text" value="" name="deduce_name" placeholder="'+result[1]['wr_deduce_name']+'"></td></tr>'
                        +'<tr><td><small>'+result[1]['amount']+'</small></td><td style="font-size:10px;"><input style="margin-top:10px;" type="text" value="" name="amount" placeholder="'+result[1]['wr_deduce_amount']+'"></td></tr>'
                        
                         +'<tr><td></td></tr>';             
               data +='<tr><td></td><td colspan="3"><br><a href="#" class="button" id="Add_deduct">'+result[1]['save']+'</a><a href="#" class="button" id="cancel_deduct">'+result[1]['cancel']+'</a></td></tr>';
               data +='</table></form>';
               Deduction.Diaadd(data,result[1]['deduce_frm']);
           }
        });
        },
     
    
    
    
};
$(document).ready(function () {

   
     $(".taxpopup").click(function () {
       var id = $(this).attr('id');
       Tax.Edit(id);
    });
    
     $(".dedtpopup").click(function () {
      var id = $(this).attr('id');
      Deduction.Edit(id);
    });
    
      $(".add").click(function () {
      Deduction.Add();
    });
});
