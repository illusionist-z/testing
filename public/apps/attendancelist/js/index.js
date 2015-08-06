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
$(document).ready(function () {

    // ユーザーのクリックした時の動作。    

    $('#search').click(function () {
        search();
    });       
    
    $('#sub').click(function () {
        sub();
    });

    $('#namesearch').click(function () {
        namesearch();
    });           
});

var search = function () {
    var month = document.getElementById('month').value;

    window.location.href = baseUri + 'attendancelist/user/attendancelist?month=' + month;
};

var sub = function () {
    var month = document.getElementById('month').value;
    var username = document.getElementById('username').value;
    var year = document.getElementById('year').value;
    // window.location.href = baseUri + 'attendancelist/index/monthlylist?month='+month+'&username='+username+'&year=' +year;
    $.ajax({
        url: baseUri + 'attendancelist/search/attsearch?month=' + month + '&username=' + username + '&year=' + year,
        type: 'GET',
        success: function (d) {                       
            var json_obj = $.parseJSON(d);//parse JSON            
            //a = "10:22:57";
            //b = "10:30:00";
            //p = "2015-06-17 ";
             $("tbody").empty();
            for (var i in json_obj)
            {   
                a = "08:00:00";
                //b=json_obj[i].checkin_time;
                 n = new Date();
                 offset = n.getTimezoneOffset();
                   if (offset<0){
                 sign='-';
                value=offset*(-1);
              }
            else{
            value=offset*(-1);
             sign='+';
            } 
            
                checkin = json_obj[i].checkin_time.split(" ");
                
                //for late 
                b = checkin[1];
                p = json_obj[i].att_date + " ";
                late = new Date(new Date(p + b) - new Date(p + a)).toUTCString().split(" ")[4];

                //for check out time
                checkout = json_obj[i].checkout_time.split(" ");;
                
                //for working hours
                if(checkout[1]>checkin[1]){
                workinghour=new Date(new Date(p + checkout[1]) - new Date(p + checkin[1])).toUTCString().split(" ")[4];}
                else{
                    workinghour="0";
                }

                //Calcute overtime time
                wh = "08:00:00";
                
                if (workinghour > wh) {
                    overtime=new Date(new Date(p + workinghour) - new Date(p + wh)).toUTCString().split(" ")[4];
                            
                }
                else{
                    overtime="0";
                }
                //Calculate Location
                 ll = json_obj[i].location;
               
                
               
                var output = "<tr>"
                        + "<td>" + json_obj[i].att_date + "</td>"
                        + "<td>" + json_obj[i].member_login_name + "</td>"
                        + "<td>" + checkin[1] + "</td>"
                        + "<td>" + late + "</td>"
                        + "<td>" + checkout[1] + "</td>"
                        + "<td>" + workinghour + " Hours </td>"
                        + "<td>" +overtime+ " Hours </td>"
                        + "<td>" + ll+ "</td>"
                        + "</tr>"
                $("tbody").append(output);                
            }
            //paginatior function
            pager.perpage =3;            
            pager.para = $('tbody > tr');
            pager.showPage(1);   
            //pager.showNavi(1);
        },
        error: function (d) {
            alert('error');
        }       
    });                 
};

var namesearch = function () {
    var namelist = document.getElementById('namelist').value;

    window.location.href = baseUri + 'attendancelist/index/todaylist?namelist=' + namelist;
};
