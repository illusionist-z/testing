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
        url:  url + "?lat=" + position.coords.latitude + "&lng=" +position.coords.longitude+"&offset="+offset ,
        type: 'GET',
        dataType: 'json',
        success: function (d) {
            
        },
        error: function (d) {            
            
        }
    });
}
/**
 * @4:00pm check absent member
 * @author David
 */
function getAbsentMember(){
    var x = new Date();
    var h = x.getHours();    
    if(h==16){
    $.ajax({
        url:baseUri+"attendancelist/absent",
        type:'GET',
        success:function(d){            
        }
    });
    }
}

$(document).ready(function(){        
    //absent member
    $('body').attr('onload',getAbsentMember());
    // ここに実際の処理を記述します。
    var logout = function(){
        window.location.href = baseUri + 'auth/logout';
        
    };
//   
    // ユーザーのクリックした時の動作。
    $('#btn_logout').click(function(){        
        alert("ログアウトしました。");
        logout();
    });
    
      var logout = function(){
        window.location.href = baseUri + 'auth/logout';
        
    };
//   
   $('.datepicker').datepicker();        
});
