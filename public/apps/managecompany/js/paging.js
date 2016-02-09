var pager = new Paging.Pager(),dict =[];   //for pagination


var ManageCompany = {
        init : function (reload){
            $('tfoot').append($('table.listtbl tbody').html());   //for csv 
            pager.perpage = 3;
            pager.para = $('table.listtbl tbody > tr');
            pager.showPage(1);
            $('tbody').show();
            if(reload){
             $.ajax({
                url:baseUri+'managecompany/index/getcomname',
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
                  
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
                 // alert(json_obj[i].member_login_name);
                dict.push(json_obj[i].company_id);
                }
                }                        
              }); 
          }
        }
        };    
 
$(document).ready(function(){              
    ManageCompany.init(1);
    

    

     
});

