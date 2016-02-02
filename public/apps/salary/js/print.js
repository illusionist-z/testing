

$(document).ready(function () {
    
    $(".print").click(function () { 
        var member_id = [];
        var printid=document.getElementsByClassName('print_id');
        var paydate=document.getElementById('paydate').value;

        for (var i =0; i < printid.length ; i++){
                 member_id.push(printid[i].value);
        }
       
        
          $.ajax({
                url:'memberidforprint',
                method: 'GET',
                data:{member_id:member_id,paydate:paydate},
               // dataType: 'json',
                success: function(d) {  
                    data= JSON.parse(d);
                if(data === "success"){
                    window.print();                        
                }
                else{
                    alert("no success");
                }
                        }
                       
                    });
    });
    
});



