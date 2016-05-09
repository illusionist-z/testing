//$("input[type='image']").click(function() {
//    $("input[id='my_file']").click();
//});

$(document).ready(function(){

    
    jQuery(document).ready(function($) {
        $("#word-export").on('click',function(event){
            $("#print").wordExport();
        });
    });
     
});

