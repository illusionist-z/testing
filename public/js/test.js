
$("#form_dove").submit(function(e){
    search();
    });
    $("#click_dove").click(function(){
      //put some validation in here if you want
    });
    
    $('#unOrderedList li').click(function(){
      var value = $(this).attr('value');
      search_module(value);
  });
function search(){
	var $form = $('#test').val();
	//alert($form);
    Core.ajax({
        type: "GET",
        url: "functions.php",
        dataType: 'json'
    },
    //call back
    function(d){
    	alert("aa");
    });
}
function search_module(aa){
    spge = '<?php echo "test" ;?>';
    alert(spge);
}
