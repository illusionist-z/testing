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
        var url = "location_session";
        var n = new Date();
        var offset = n.getTimezoneOffset();
        $.ajax({
        url:  url +"?offset="+offset ,
        type: 'GET',
        dataType: 'json'
    });
    }
}
function GEOprocess(position) {
    //GET geo location of user
    var url = "location_session";
    
    $.ajax({
        url:  url + "?lat=" + position.coords.latitude + "&lng=" +position.coords.longitude,
        type: 'GET',
        dataType: 'json',
        success: function (d) {
            
        },
        error: function (d) {            
            
        }
    });
}
         
$(document).ready(function(){        
    
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
    
    $('#btnLogin').click(function(){        
         var url = "location_session";
    var n = new Date();
    
   
    var offset = n.getTimezoneOffset();
    
    $.ajax({
        url:  url +"?offset="+offset ,
        type: 'GET',
        dataType: 'json',
        success: function (d) {
            
        },
        error: function (d) {            
            
        }
    });
    });
    
      var logout = function(){
        window.location.href = baseUri + 'auth/logout';
        
    };
  
//   
   $('.datepicker').datepicker();        
});
