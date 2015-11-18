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
    $('.checkin').on('click',function(){
$('.geolocation').ready(function() {
    geo();
});
        
       var note = document.getElementById('note').value;
       window.location.href = baseUri + 'dashboard/index/checkin?note='+note;
       
       //alert("Successfully Checked In");

    });
});
