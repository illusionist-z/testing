/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @GEOprocess()
 * @get @lat @lng
 */
function geo() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(GEOprocess);
    }
}
function GEOprocess(position) {
    //GET geo location of user
    var url = "location_session";
      var n = new Date();
      var offset = n.getTimezoneOffset(); 
    $.ajax({
        url: "dashboard/index/" + url + "?lat=" + position.coords.latitude + "&lng=" +position.coords.longitude+"&offset=" + offset ,
        type: 'GET',
        dataType: 'json',
        success: function (d) {
            
        },
        error: function (d) {            
            
        }
    });
}
 
        
$(document).ready(function(){        
    
     $('.dashboard').ready(function(){
        geo();
         });   
    //set slide menu
    if(document.getElementById("id") !== null){
        $('#slidemenu-left').mmenu();
        $('#logo').click(function(){
            $('#slidemenu-left').trigger('open');
        });
        $('#slidemenu-left').trigger('open');
    }
    // ここに実際の処理を記述します。
    var logout = function(){
        window.location.href = baseUri + 'auth/logout';
        
    };
    
    var search=function(){
       var month = document.getElementById('month').value;   
         window.location.href = baseUri + 'attendancelist/user/attendancelist?month='+month;
    };
    
     var sub=function(){
       var month = document.getElementById('month').value;  
       var username = document.getElementById('username').value; 
       var year = document.getElementById('year').value; 
         window.location.href = baseUri + 'attendancelist/index/monthlylist?month='+month+'?username='+username+'?year=' +year;
    };
    
     var namesearch=function(){
       var namelist = document.getElementById('namelist').value;  
      
         window.location.href = baseUri + 'attendancelist/index/todaylist?namelist='+namelist;
    };
    // ユーザーのクリックした時の動作。
    $('#btn_logout').click(function(){
        alert("ログアウトしました。");
        logout();
    });
    
    $('#search').click(function(){
        search();
    });
    
      $('#sub').click(function(){
        sub();
    });
    
     $('#namesearch').click(function(){
        namesearch();
    });
});
