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
               var data ='<form id="edit_tax_table"><table>';               
                   data += '<tr><td>ID :</td><td><input type="text" value="'+result[0]['id']+ '" name="id"></td></tr>'
                        +'<tr><td>Taxs From:</td><td><input type="text" value='+result[0]['taxs_from']+ ' name="taxs_from"></td>'
                        +'<td>Taxs To:</td><td><input type="text" value='+result[0]['taxs_to']+ ' name="taxs_to"></td></tr>'
                        +'<td>Taxs Rate:</td><td><input type="text" value='+result[0]['taxs_rate']+ ' name="taxs_rate"></td></tr>'
                        +'<td>SSC emp:</td><td><input type="text" value='+result[0]['ssc_emp']+ ' name="ssc_emp"></td>'
                        +'<td>SSC comp:</td><td><input type="text" value='+result[0]['ssc_comp']+ ' name="ssc_comp"></td></tr>'
                         +'<tr><td></td></tr>';             
               data +='<tr><td></td><td colspan="3"><a href="#" class="button" id="edit_tax">Save</a><a href="#" class="button" id="edit_close">Cancel</a></td></tr>';
               data +='</table></form>';
               Tax.Dia(data);
           }
        });
        },
    Dia : function (d){
        if(!this.isOvl){
            this.isOvl=true;
        }
        
        $ovl = $('#edit_tax_dia');
        $ovl.dialog({
            autoOpen: false,
            height: 250,
            async:false,            
            width: 700,
            modal: true,
            title:"Tax Edit"
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
             
               
               var data ='<form id="edit_deduct_table"><table>';               
                   data += '<tr><td></td><td><input type="hidden" value="'+result[0]['deduce_id']+ '" name="id" ></td></tr>'
                        +'<tr><td>Deduction Name:</td><td><input type="text" value='+result[0]['deduce_name']+ ' name="deduce_name"></td>'
                        +'<td>Deduction Amount:</td><td><input type="text" value='+result[0]['amount']+ ' name="amount"></td></tr>'
                        
                         +'<tr><td></td></tr>';             
               data +='<tr><td></td><td colspan="3"><a href="#" class="button" id="edit_deduct">Save</a><a href="#" class="button" id="delete_deduct">Delete</a><a href="#" class="button" id="edit_close">Cancel</a></td></tr>';
               data +='</table></form>';
               Deduction.Dia(data);
           }
        });
        },
    Dia : function (d){
        if(!this.isOvl){
            this.isOvl=true;
        }
        
        $ovl = $('#edit_dect_dia');
        $ovl.dialog({
            autoOpen: false,
            height: 250,
            async:false,            
            width: 700,
            modal: true,
            title:"Deduction Edit"
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
       Diaadd : function (d){
        if(!this.isOvl){
            this.isOvl=true;
        }
        
        $ovl = $('#add_new_dt');
        $ovl.dialog({
            autoOpen: false,
            height: 250,
            async:false,            
            width: 700,
            modal: true,
            title:"Deduction Add"
        });                        
        $ovl.html(d);
        $ovl.dialog("open");
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
        
        $.ajax({
            
           url:"",
           type: "POST",
           success:function(){
              
             
               
               var data ='<form id="Add_new_deduct"><table>';               
                   data += '<tr><td></td></tr>'
                        +'<tr><td>Deduction Name:</td><td><input type="text" value="" name="deduce_name"></td>'
                        +'<td>Deduction Amount:</td><td><input type="text" value="" name="amount"></td></tr>'
                        
                         +'<tr><td></td></tr>';             
               data +='<tr><td></td><td colspan="3"><a href="#" class="button" id="Add_deduct">Save</a><a href="#" class="button" id="cancel_deduct">Cancel</a></td></tr>';
               data +='</table></form>';
               Deduction.Diaadd(data);
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
