/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @GEOprocess()
 * @get @lat @lng
 */
function geo() {
    if (navigator.geolocation) { 
        var url = "location_session";
        var n = new Date();
        var offset = n.getTimezoneOffset();
       
        $.ajax({
            url: url + "?offset=" + offset,
            type: 'GET',
            dataType: 'json'
        });
       
         navigator.geolocation.getCurrentPosition(GEOprocess);
    }
}
function GEOprocess(position) {
    //GET geo location of user
   
    var url = "location_session";
    var n = new Date();
    var offset = n.getTimezoneOffset();alert(offset);
    $.ajax({
        url: url + "?lat=" + position.coords.latitude + "&lng=" + position.coords.longitude+ "&offset=" + offset,
        type: 'GET',
        dataType: 'json',
        success: function (d) {

        },
        error: function (d) {

        }
    });
}
/**
 * @4:00pm check absent member
 * @author David
 */
function getAbsentMember() {
    var x = new Date();
    var h = x.getHours();
    if (h == 16) {
        $.ajax({
            url: baseUri + "attendancelist/absent",
            type: 'GET',
            success: function (d) {
            }
        });
    }
}

$(document).ready(function () {
    //absent member
    $('body').attr('onload', getAbsentMember());
    // ここに実際の処理を記述します。
    var logout = function () {
        window.location.href = baseUri + 'auth/logout';

    };
//   
    // ユーザーのクリックした時の動作。
    $('#btn_logout').click(function () {
        alert("ログアウトしました。");
        logout();
    });

    $('#btnLogin').click(function () {
        var url = "location_session";
        var n = new Date();


        var offset = n.getTimezoneOffset();

        $.ajax({
            url: url + "?offset=" + offset,
            type: 'GET',
            dataType: 'json',
            success: function (d) {

            },
            error: function (d) {

            }
        });
    });

    var logout = function () {
        window.location.href = baseUri + 'auth/logout';

    };


    $('.sidebar-toggle').click(function (e) {
        e.stopPropagation();
        //get collapse content selector
        var collapse_content_selector = $(this).attr('href');

        //make the collapse content to be shown or hide
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle(function () {
            if ($(this).css('display') == 'none') {
                //change the button label to be 'Show'
                $('.content-wrapper').css("margin-left","0");
                $('.main-footer').css("margin-left","0");
                toggle_switch.html('Show');
            } else {                                
                $('.content-wrapper').css("margin-left","230px");                
                $('.main-footer').css("margin-left","230px");      
                $('body').append("<style type='text/css'>@media (max-width:767px){.main-sidebar{transform:translate3d(0,0,0);}}</style>");
                //change the button label to be 'Hide'
                toggle_switch.html('Hide');
            }
        });

    });
    //
    $('body').click(function (e) {       
        if (0 == $(e.target).closest('#sidepage').length) {
            $('#sidepage').fadeOut(200);
            $('.content-wrapper').css("margin-left","0");
            $('.main-footer').css("margin-left","0");
        }
    });
//   
    $('.datepicker').datepicker();
});
  
