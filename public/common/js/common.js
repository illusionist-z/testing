/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var baseUri = '/workManagiment/';
function checktime(i) {
    if (i < 10) {
        i = "0" + i;  // add zero in front of numbers < 10        
    }
    return i;
}
function link_height() {
    //for link border right in link page
    var link_height = $(document).outerHeight() - ($(".main-footer").outerHeight() + $(".navbar").outerHeight());
    $(".link").css({"height": link_height + "px", "border-right": "1px solid #aaa", "background": "#fff"});
}

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
    var offset = n.getTimezoneOffset();
    $.ajax({
        url: url + "?lat=" + position.coords.latitude + "&lng=" + position.coords.longitude + "&offset=" + offset,
        type: 'GET',
        dataType: 'json',
        success: function (d) {
        },
        error: function(d) {

        }
    });
}
/**
 * @4:00pm check absent member
 * @author David JP <david.gnext@gmail.com>
 */
function getAbsentMember() {
    var x = new Date();
    var h = x.getHours();
    if (h = 11) {
        $.ajax({
            url: baseUri + "attendancelist/absent",
            type: 'GET',
            success: function() {
            }
        });
    }
}
/*
 * @author David
 * for error text clean
 */
function repair(val) {
    var cache;
    $(val).focus(function(e) {
        e.preventDefault();
        $(this).css("border", "1px solid #ccc");  // for error border
        $(this).attr("placeholder", "");
        //for focus error text
        if (cache) {
            $(this).val(cache);
        }
        else {
            $(this).val("");
        }
        $(this).css("color", "black");
    });
    $(val).focusout(function() {
        cache = $(this).val();
    });
}

$(document).ready(function() {
    //absent member
    $('body').attr('onload', getAbsentMember());
    // ここに実際の処理を記述します。
    var logout = function() {
        window.location.href = baseUri + 'auth/logout';

    };
//   
    // ユーザーのクリックした時の動作。
    $('#btn_logout').click(function() {
        alert("ログアウトしました。");
        logout();
    });

    $('#btnLogin').click(function() {
        var url = "location_session";
        var n = new Date();


        var offset = n.getTimezoneOffset();

        $.ajax({
            url: url + "?offset=" + offset,
            type: 'GET',
            dataType: 'json',
            success: function(d) {

            },
            error: function(d) {

            }
        });
    });

    var logout = function() {
        window.location.href = baseUri + 'auth/logout';
    };
    /**
     * @author David JP<david.gnext@gmail.com>
     * @version 28/8/2015
     * menu toggle function
     */

    $('.sidebar-toggle').click(function(e) {
        e.stopPropagation();
        //e.preventDefault();
        //get collapse content selector
        var collapse_content_selector = $(this).attr('href');

        //make the collapse content to be shown or hide
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle();
//        if ($(this).css('display') === 'none') {
        //change the button label to be 'Show'
        //$('.content-wrapper').css("margin-left","0");
        //$('.main-footer').css("margin-left","0");
        //toggle_switch.html('Show');
//        } else {                                
//            $('.content-wrapper').css("margin-left","230px");
//            $('.main-footer').css("margin-left","230px");
//            $('body').append("<style type='text/css'>@media(max-width:767px){.main-sidebar{transform:translate3d(0,0,0);}}</style>");
//            //change the button label to be 'Hide'
//            toggle_switch.html('Hide');
//        }
//    });
//    });     
 
      });
         //toggle off or notification off when click body
         $('body').click(function (e) {        
        if (0 === $(e.target).closest('#sidepage').length) {
            $('#sidepage').fadeOut(200);
            //$('.collapse-wrapper').css("margin-left","0");
            //$('.main-footer').css("margin-left","0");
        }
        if(0 === $(e.target).closest('#noti').length){
            $('#notificationContainer').fadeOut(300);            
        }
    });
 $('.datepicker').datepicker(); 
link_height();
});
