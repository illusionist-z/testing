/* 
 * @davijp
 * @getcontent change
 * @since 20/6/2015 
 */
var Content = {
    View: function(url) {

        if (url == 'checkin') {
            var note = document.getElementById('note').value;
           
            $.ajax({
                url: url + "?note=" + note,
                type: 'GET',
                dataType: 'html',
                success: function(d) {
                    $('body').html(d);
                }
            });

        }

    }

};
$('.geolocation').ready(function() {
    geo();
});

