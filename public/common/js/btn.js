/* 
 * @davijp
 * @getcontent change
 * @since 20/6/2015 
 */
//var Content = {
//    View: function(url) {
//
//        if (url == 'checkin') {
//            var note = document.getElementById('note').value;
//           
//            $.ajax({
//                url: url + "?note=" + note,
//                type: 'GET',
//                dataType: 'html',
//                success: function(d) {
//                    $('body').html(d);
//                }
//            });
//
//        }
//
//    }
//
//};


/**
 * getting user late reason when click checkin
 * @author Su Zin Kyaw<gnext.suzin@gmail.com>
 */
$(document).ready(function(){
    var location="-";
    jQuery(document).ready(function($) {
         location=geoplugin_city()+","+geoplugin_countryName();
});
    $('.checkin').on('click',function(){
//    $('.geolocation').ready(function() {
//    geo();
//});
    
        var url = "location_session";
        var n = new Date();
        var offset = n.getTimezoneOffset();
        
        $.ajax({
            url: url + "?offset=" + offset+"&location="+ location,
            type: 'GET',
            dataType: 'json'
        });
        
        var note = document.getElementById('note').value;

         $.ajax({
           type : 'POST',
           url  : baseUri + 'dashboard/index/checkin?note='+note,
           data : $('#apply_form').serialize(),
           success: function(d){
               msg = JSON.parse(d);
               alert(msg);
               window.location.href = baseUri + 'dashboard/index/direct';
           }
        });
       
    }),
      $('.checkout').on('click',function(){
         $.ajax({
           type : 'POST',
           url  : baseUri + 'dashboard/index/checkout',
           success: function(d){
               msg = JSON.parse(d);
               alert(msg);
               window.location.href = baseUri + 'dashboard/index/direct';
           }
        });
       
    });
});
