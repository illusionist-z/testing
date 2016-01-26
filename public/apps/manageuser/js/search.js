/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @GEOprocess()
 * @get @lat @lng
 */
var pager = new Paging.Pager(),dict = [];   //for pagination
var User = {
        init  : function(reload) {
        $("tfoot").html($('tbody').html()); //for csv
        pager.perpage = 7;            
        pager.para = $('tbody > tr');
        pager.showPage(1);  
        $("tbody").show();         
        if(reload){
       $.ajax({
                url:baseUri+'manageuser/index/usernameautolist',
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
                //alert(data);    
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
                   // alert(json_obj[i].full_name);
                dict.push(json_obj[i].member_login_name);
                }                  
                        }                        
                    });     
                }
       },
        search: function(){
        var name = document.getElementById('username').value;
        if(name === ''){
            $('tbody').empty();           
             var output = "<tr>"
                                + "<td colspan='9'><center>No data to display</center></td>"                           
                                 + "</tr>";
                    $("tbody").append(output);
                    $('div#content').empty();        
        }
        else{
              $.ajax({
                    type: 'GET',
                    url: "index?username="+name,
                    success:function(result){       
                      $('body').html(result);
                       $('.dropdown-toggle').dropdown();
                    },
                    error: function (d) {
                        alert('error');
                    }
                    });
        }
      
        }
};
    
$(document).ready(function(){                 
    
     User.init('reload'); 
    // ここに実際の処理を記述します。   
    $('form').on('click','#userlistsearch',function () {        
        User.search();
    });
    $('form').on('click','#addinguser',function () {      
       
        Manage.User.Edit('new');
    });
    $("tbody").on('click','.displaypopup',function () {        
        var type = $(this).attr('id');  
       // alert("aa");
        Manage.User.Edit(type);
    });
     $('.userauto').click(function () {
               $(this).autocomplete({
                       source: function( request, response ) {                                       
                            var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" ); 
                            var result = $.grep( dict, function( item ){                 
                                       return matcher.test( item);
                                      });
                                response(result.slice(0, 10));
                         },
                          minLength :1
                });
    }); 
       
});


