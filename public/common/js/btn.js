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


$('.geolocation').ready(function() {
    geo();
});
/**
 * getting user late reason when click checkin
 * @author Su Zin Kyaw<gnext.suzin@gmail.com>
 */
$(document).ready(function(){
    $('.checkin').click(function () {
       var note = document.getElementById('note').value;
       window.location.href = baseUri + 'dashboard/index/checkin?note='+note;

    });
});
