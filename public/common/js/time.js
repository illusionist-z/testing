function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}
function display_ct() {

var x = new Date()
var x1 =  + x.getHours( )+ ":" + x.getMinutes() + ":" + x.getSeconds();
document.getElementById('ct').innerHTML = x1;

tt=display_c();
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
