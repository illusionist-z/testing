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
/*
 * show monthly list by return json array
 * @author David
 */
var monthlylist = function (link){
        $.ajax({
        url: baseUri + 'attendancelist/index/'+link,
        type: 'GET',
        success: function (d) {   
            var json_obj = $.parseJSON(d);//parse JSON            
            $('tbody').empty();
            for (var i in json_obj)
            {   
                a = "08:00:00";
                //b=json_obj[i].checkin_time;
                checkin = json_obj[i].checkin_time.split(" ");
                b = checkin[1];
                p = json_obj[i].att_date + " ";
                late = new Date(new Date(p + b) - new Date(p + a)).toUTCString().split(" ")[4];

                //for chcek out time
                checkout = json_obj[i].checkout_time.split(" ");

                //Calcute overtime time
                office_endtime = "05:00:00";
                if (checkout[1] > office_endtime) {
                    overtime = new Date(new Date(p + checkout[1]) - new Date(p + office_endtime)).toUTCString().split(" ")[4];
                }
                var output = "<tr>"
                        + "<td>" + json_obj[i].att_date + "</td>"
                        + "<td>" + json_obj[i].member_login_name + "</td>"
                        + "<td>" + checkin[1] + "</td>"
                        + "<td>" + late + "</td>"
                        + "<td>" + checkout[1] + "</td>"
                        + "<td>" + json_obj[i].overtime + "</td>"
                        + "<td>" + json_obj[i].checkin_time + "</td>"
                        + "<td>" + json_obj[i].checkin_time + "</td>"
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
/*
 * show today list by return json array
 * @author David
 */
var todaylist = function (link,n){
        var url;
        if(1 == n){
        var name = document.getElementById('namelist').value;
        url = baseUri + 'attendancelist/index/'+link+'?namelist='+name;
            }
        else{
        url = baseUri + 'attendancelist/index/'+link;
        }
        $.ajax({
        url: url ,
        type: 'GET',
        success: function (d) {   
            var json_obj = $.parseJSON(d);//parse JSON            
            $('tbody').empty();
            for (var i in json_obj)
            {   
                a = "08:00:00";
                //b=json_obj[i].checkin_time;
                checkin = json_obj[i].checkin_time.split(" ");
                b = checkin[1];
                p = json_obj[i].att_date + " ";
                late = new Date(new Date(p + b) - new Date(p + a)).toUTCString().split(" ")[4];

                //for chcek out time
                checkout = json_obj[i].checkout_time.split(" ");

                //Calcute overtime time
                office_endtime = "05:00:00";
                if (checkout[1] > office_endtime) {
                    overtime = new Date(new Date(p + checkout[1]) - new Date(p + office_endtime)).toUTCString().split(" ")[4];
                }
                var output = "<tr>"
                        + "<td>" + json_obj[i].att_date + "</td>"
                        + "<td>" + json_obj[i].member_login_name + "</td>"
                        + "<td>" + checkin[1] + "</td>"
                        + "<td>" + late + "</td>"
                        + "<td>" + checkout[1] + "</td>"
                        + "<td>" + json_obj[i].overtime + "</td>"
                        + "<td>" + json_obj[i].checkin_time + "</td>"
                        + "<td>" + json_obj[i].checkin_time + "</td>"
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
$(document).ready(function () { 

    // ユーザーのクリックした時の動作。    

    $('#search').click(function () {
        search();
    });       
    
    $('#sub').click(function () {
        sub();
    });
    //monthlylist
    if($('section').is('#showmonthlylist')){
        monthlylist($('.content-header').attr('id'));        
    }
   if($('section').is('#showtodaylist')){
       todaylist($('.content-header').attr('id'),0);
   }
    $('#namesearch').click(function () {        
        todaylist($('.content-header').attr('id'),1);
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
           $('tbody').empty();
            for (var i in json_obj)
            {   
                a = "08:00:00";
                //b=json_obj[i].checkin_time;
                checkin = json_obj[i].checkin_time.split(" ");
                b = checkin[1];
                p = json_obj[i].att_date + " ";
                late = new Date(new Date(p + b) - new Date(p + a)).toUTCString().split(" ")[4];

                //for chcek out time
                checkout = json_obj[i].checkout_time.split(" ");

                //Calcute overtime time
                office_endtime = "05:00:00";
                if (checkout[1] > office_endtime) {
                    overtime = new Date(new Date(p + checkout[1]) - new Date(p + office_endtime)).toUTCString().split(" ")[4];
                }
                var output = "<tr>"
                        + "<td>" + json_obj[i].att_date + "</td>"
                        + "<td>" + json_obj[i].member_login_name + "</td>"
                        + "<td>" + checkin[1] + "</td>"
                        + "<td>" + late + "</td>"
                        + "<td>" + checkout[1] + "</td>"
                        + "<td>" + overtime + "</td>"
                        + "<td>" + json_obj[i].checkin_time + "</td>"
                        + "<td>" + json_obj[i].checkin_time + "</td>"
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
