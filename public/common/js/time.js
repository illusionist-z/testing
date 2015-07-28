/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function checktime(i) {
    if(i<10){
        i = "0"+i;  // add zero in front of numbers < 10        
    }
    return i;
}
function display_ct() {
    var x = new Date();
    var h = x.getHours();
    var m = x.getMinutes();
    var s = x.getSeconds();
    h = checktime(h);
    m = checktime(m);
    s = checktime(s);        
    document.getElementById('ct').innerHTML = h+":"+m+":"+s;    
     var t = setTimeout(function(){display_ct()},500);
}

//function gettimezone(){
//            var tz = jstz.determine();
//        var timezone = tz.name();
//
//        alert(timezone);
//        $("#tz").html(timezone);
//        
//        // display current time based on user location
//        var current_time =  moment().tz(timezone).format('MMMM Do YYYY, h:mm:ss a');
//        $("#time").html(current_time);
//        
//     
//}
