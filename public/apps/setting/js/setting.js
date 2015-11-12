   function showDialog()
    {
        
    
        var dia_id = $(this).attr('id'); 
        $("#open"+dia_id).dialog({
                modal: true,
                draggable: false,	 
	resizable: false,
                width: 300,
                height: 300,
                buttons: {
                'Save': function() {
                $("form").submit();
                } ,
                'Delete': function() {
                jQuery( this ) . dialog( 'submit' );
                } ,
               'Cancel': function() {
                jQuery( this ) . dialog( 'close' );
            }
        
        }
        
        
            });
      
          

 }    
        
        
 
          
  function showDialogname()
    {
        var dia_id_name = $(this).attr('id');
        $("#opent"+dia_id_name).dialog({
                modal: true,
                draggable: false,	 
	resizable: false,
                width: 300,
                height: 350,
                buttons: {
                'Save': function() {
                jQuery( this ) . dialog( 'submit' );
                } ,
                'Delete': function() {
                jQuery( this ) . dialog( 'submit' );
                } ,
               'Cancel': function() {
                jQuery( this ) . dialog( 'close' );
            }
        
        }
   
            });
        
        }
        
    
  function showDialoguser()
    {
        var dia_id_name = $(this).attr('id');
        $("#openu"+dia_id_name).dialog({
                modal: true,
                draggable: false,	 
	resizable: false,
                width: 300,
                height: 350,
                buttons: {
                'Save': function() {
                jQuery( this ) . dialog( 'submit' );
                } ,
                'Delete': function() {
                jQuery( this ) . dialog( 'submit' );
                } ,
               'Cancel': function() {
                jQuery( this ) . dialog( 'close' );
            }
        
        }
   
            });       
 }

 $(document).ready(function(){
     $('#changeuser').on('change',function(){
         alert($(this).val());
     });   
 });
