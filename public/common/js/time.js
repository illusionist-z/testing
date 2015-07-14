function display_c() {
    var refresh = 1000; // Refresh rate in milli seconds
    mytime = setTimeout('display_ct()', refresh)
}
function display_ct() {

    var x = new Date()
    var x1 = +x.getHours( ) + ":" + x.getMinutes() + ":" + x.getSeconds();
    document.getElementById('ct').innerHTML = x1;
    tt = display_c();
}
function geo() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(GEOprocess);
    }
}
window.onload = geo;
function GEOprocess(position) {
    //GET geo location of user
    var url = "location_session";
    $.ajax({
        url: "dashboard/index/" + url + "?lat=" + position.coords.latitude + "&lng=" + position.coords.longitude,
        type: 'GET',
        dataType: 'json',
        success: function (d) {
            
        },
        error: function (d) {
            //alert('dfskf');
            
        }
    });
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
