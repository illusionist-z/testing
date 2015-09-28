/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @GEOprocess()
 * @get @lat @lng
 */
var pager = new Paging.Pager();   //for pagination
var User = {
        init  : function() {
        $("tfoot").html($('tbody').html()); //for csv
        pager.perpage =7;            
        pager.para = $('tbody > tr');
        pager.showPage(1);  
        $("tbody").show();
        },
        search: function(){
        var name = document.getElementById('username').value;
        $.ajax({
        type: 'GET',
        url: "userlist?username="+name,
        success:function(result){
          $('body').html(result);
        },
        error: function (d) {
            alert('error');
        }
        });
        }
};
    
$(document).ready(function(){                 
    
     User.init(); 
    // ここに実際の処理を記述します。   
    $('form').on('click','#userlistsearch',function () {        
        User.search();
    });
    $('form').on('click','#addinguser',function () {        
        Manage.User.Edit('new');
    });
    $("tbody").on('click','.displaypopup',function () {        
        var type = $(this).attr('id');  
        Manage.User.Edit(type);
    });
});


