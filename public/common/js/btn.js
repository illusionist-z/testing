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
                    url: url + "?note=" + note,
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
$('.geolocation').ready(function(){
        geo();
         });    
