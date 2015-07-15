/* 
 * @davijp
 * @getcontent change
 * @since 20/6/2015 
 */
var Content = {
    View: function (url) {
        if (url == 'checkin') {
            var note = document.getElementById('note').value;            
               
                $.ajax({
                    url: "dashboard/index/"+url + "?note=" + note,
                    type: 'GET',
                    dataType: 'html',
                    success: function (d) {                        
                        $('body').html(d);
                    }
                });
            
          
        }
//        else if(url =='todaylist'){
//            $.ajax({
//                type:"GET",
//                url:url,
//                success:function(d){
//                      if (history.pushState) {
//                        window.history.replaceState(null, null,url);
//                    }
//                    $('body').html(d);
//                }
//            });
//        }
//        else if (url != undefined) {
//            $.ajax({
//                type: "GET",
//                url: url,
//                success: function (d) {                                        
//                    if (history.pushState) {
//                        window.history.pushState(null, null, url);
//                    }
//                    $('body').html(d);
//                }
//            });
//        }
//        else{
//        return false;}
    }   

};
/*
 * @GEOprocess()
 * @get lat lng
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
        url: "dashboard/index/" + url + "?lat=" + position.coords.latitude + "&lng=" + position.coords.longitude +"&offset=" + offset,
        type: 'GET',
        dataType: 'json',
        success: function (d) {
            
        },
        error: function (d) {
            //alert('dfskf');
            
        }
    });
}
$(function(){
   geo(); 
});