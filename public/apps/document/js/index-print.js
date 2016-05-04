

$(document).ready(function () {
        var head = $('table thead tr');
    //$("tbody tr:nth-child(5n+5)").after(head.clone());
    $(".printing").on('click',function(){
        window.print();
    });
    
    
    
});
 $('#edit').on('click',function(){
      
        var name = $("#name").html();
        $('#name').replaceWith('<input type="text" id="name" value="'+name+'">');
        var pos = $("#pos").html();
        $('#pos').replaceWith('<input type="text" id="pos" value="'+pos+'">');
        

    });
    
 $('#save').on('click',function(){
      
        var name = document.getElementById('name').value;
        $('#name').replaceWith(name);
        var pos = document.getElementById('pos').value;
        $('#pos').replaceWith(pos);
        //location.reload();
    });



