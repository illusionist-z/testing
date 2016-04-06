/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @GEOprocess()
 * @get @lat @lng
 */
var dict = [];   //for pagination
var User = {
        Ctrl : baseUri+"manageuser/index",
        
        init  : function(reload) {
        $('.listtbl tbody').has("tr").length > 0 ? null : MsgDisplay() ;
        if(reload){
         
       $.ajax({
          
                url: baseUri+"manageuser/index/usernameautolist",
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
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
                    url: baseUri+"manageuser/index?username="+name,
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
    
$(document).ready( function() {
    
     User.init('reload'); 
    // ここに実際の処理を記述します。   
    $('form').on('click','#userlistsearch',function () {        
        User.search();
    });
    $('form').on('click','#addinguser',function () {     
       
           var type="new";
                    $.ajax({
                    type:'GET',
                    url : baseUri+"manageuser/index/getpermit",
                    data : {data : type},
                    success: function(d){
                        
                    var json_obj = $.parseJSON(d);                    
                    var opt='',option="";
                    for (var i in json_obj){
                   if(json_obj[i].name_of_group=='USER'){ opt="selected"}else{opt=''}
                       option += "<option value='"+json_obj[i].name_of_group+","+json_obj[i].group_id+"'"+opt+">"+json_obj[i].name_of_group+"</option>";                        
                    }
                    Manage.User.Edit('new',option);
                    }
                   });
        
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


