//$("input[type='image']").click(function() {
//    $("input[id='my_file']").click();
//});

$(document).ready(function(){
document.getElementById('divId').style.display = 'none';
document.getElementById('editinfo').style.display = 'none';

 $('#edit').click(function () {
      //e.preventDefault();
        var content = $("#editinfo").html();
        $('#document').replaceWith('<div class="editinfo"  style="width: 36%;display: inline-block;float: right;margin-right: 62%;">'+content+'</div>');
        document.getElementById('save').disabled = false;
        document.getElementById('divId').style.display = '';
        //document.getElementById('editinfo').style.display = '';
        //document.getElementById('document').style.display = 'none';
        

    });
    
    jQuery(document).ready(function($) {
        $("#word-export").click(function(event) {
            $("#letterhead").wordExport();
        });
    });
     
});

