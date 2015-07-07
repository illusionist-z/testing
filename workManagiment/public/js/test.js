    $("#form_dove").submit(function(e){
    search();
    });
    $("#click_dove").click(function(){
      //put some validation in here if you want
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
