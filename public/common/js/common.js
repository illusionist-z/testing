/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var baseUri = '/salts/';
function checktime(i) {
    if (i < 10) {
        i = "0" + i;  // add zero in front of numbers < 10        
    }
    return i;
}
//for special character string
function isValid(str){
 return !/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
}
/**
 * sidebar menu link height resize()
 * @author David JP<gnext>
 */
function link_height() {
    //for link border right in link page
    var link_width = $(document).outerWidth();
    var link_height = $(document).outerHeight()-($(".main-footer").outerHeight()+$("#fixedheader").outerHeight());
    var link_ht = $(document).outerHeight()-($(".main-footer").outerHeight()+$("#fixedheader").outerHeight());
     if(link_width > 983){
           $("#showhelp").css({"height":link_ht+"px","background":"#fff"});
           $(".link").css({"height":link_height+"px","border-right":"1px solid #aaa","background":"#fff"});
    }
   
    else if(link_width > 423){  
        $(".link").css({"height":link_height/10.5+"px","border-right":"1px solid #aaa","background":"#fff"});
      // $("#showhelp").css({"height":link_ht+"px","background":"#fff"});
    }
}

function geo() {  
   
    if (navigator.geolocation) {
        var url = "location_session";
        var n = new Date();
        var offset = n.getTimezoneOffset();
        var location=geoplugin_city()+","+geoplugin_countryName();
        
        $.ajax({
            url: url + "?offset=" + offset+"&location="+ location,
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
    var location=geoplugin_city()+","+geoplugin_countryName();
    $.ajax({
        url: url + "?lat=" + position.coords.latitude + "&lng=" + position.coords.longitude + "&offset=" + offset+"&location="+ location,
        type: 'GET',
        dataType: 'json'    
    });
}
///**
// * @4:00pm{optional time} check absent member
// * @author David JP <david.gnext@gmail.com>
// */
function getAbsentMember() {
    var x = new Date();
    var h = x.getHours();
    var m = x.getMinutes();
    var s  = x.getSeconds();
    if (h === 8 && m === 15 && s === 0) {
        $.ajax({
            url: baseUri + "attendancelist/absent/addAbsent",
            type: 'GET',
            success: function() {
            }
        });
    }
    setTimeout(function(){
        getAbsentMember();
    },1000);
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
    $('#btn_logout').on('click',function(){
         $.ajax({
            
           url:baseUri+"auth/logout/gettranslate",
           type: "GET",
           success:function(res){
               var result = $.parseJSON(res);
               var logout=result['logout'];
               alert(logout);
           }
        });
      
        logout();
    });

    $('#btnLogin').on('click',function(){
       // var url = "location_session";
        var n = new Date();


        var offset = n.getTimezoneOffset();

        $.ajax({
            url: baseUri + "dashboard/index/location_session?offset=" + offset,
            type: 'GET',
            dataType: 'json',
            success: function(d) {

            },
            error: function(d) {

            }
        });        
//        var name = $('#form_login :input[name=member_login_name]').val();
//        //var pass  = $('#form_login :input[name=password]').val();
//        if(isValid(name)){
//            $('#form_login').submit();
//        }
//        else{
//            alert("Don't allow special character in username box");
//            return false;
//        }    
    });
  
    /**
     * @author David JP<david.gnext@gmail.com>
     * @version 28/8/2015
     * menu toggle function
     */

    $('.sidebar-toggle').on('click',function(e){
        e.stopPropagation();        
        //get collapse content selector
        var collapse_content_selector = $(this).attr('href');

        //make the collapse content to be shown or hide
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle();
 
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
 
});
$(window).load(function(){
    link_height();
});
$(window).resize(function(){
    link_height();
});
