
$(document).ready(function(){


    
    $('#checkin').click(function(){
            var note = document.getElementById('note').value; 
            window.location.href = baseUri + 'dashboard/index/checkin?note='+note;
            

    });
    
     
});

