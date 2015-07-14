/* 
 * @davijp
 * @getcontent change
 * @since 20/6/2015 
 */
var Content = {
    View: function (url) {
        if (url == 'checkin') {
            var note = document.getElementById('note').value;
            function GEOprocess(position) {
               //GET geo location of user
                $.ajax({
                    url: "dashboard/index/"+url + "?note=" + note + "&lat=" + position.coords.latitude + "&lng=" + position.coords.longitude,
                    type: 'GET',
                    dataType: 'html',
                    success: function (d) {                        
                        $('body').html(d);
                    }
                });
            }
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(GEOprocess);
            }
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
