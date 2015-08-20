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
var userlist = function (){            
        var name = document.getElementById('username').value;        
        $.ajax({
        url: "showuserlist?username="+name ,
        type: 'GET',
        success: function (d) {                         
            var json_obj = $.parseJSON(d);//parse JSON                        
            $('tbody').empty();
            //$('tfoot').empty();
            for (var i in json_obj)
            {   
                var output = "<tr>"
                        + "<td>" + json_obj[i].member_id + "</td>"
                        + "<td>" + json_obj[i].member_login_name + "</td>"
                        + "<td>" + json_obj[i].member_dept_name + "</td>"
                        + "<td>" + json_obj[i].job_title + "</td>"
                        + "<td>" + json_obj[i].member_mail + "</td>"
                        + "<td>" + json_obj[i].member_mobile_tel + " </td>"
                        + "<td>" + json_obj[i].member_address + '<a href="#" onclick="return false;" style="float:right;" class="button displaypopup" id="'+json_obj[i].member_login_name +'">Edit</a></td>'                          
                        + "</tr>";                
                $("tbody").html(output);
                //$("tfoot").append(output); 
            }     
            pager.perpage =3;            
            pager.para = $('tbody > tr');
            pager.showPage(1);                     
        },
        error: function (d) {
            alert('error');
        }       
    });                 
};
    
$(document).ready(function(){                 
    
        $("tfoot").html($('tbody').html()); //for csv
        pager.perpage =3;            
        pager.para = $('tbody > tr');
        pager.showPage(1);  
    // ここに実際の処理を記述します。   
    $('form').on('click','#userlistsearch',function () {        
        userlist();
    });          
     
});


