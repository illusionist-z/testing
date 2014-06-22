/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    var resizeWindow = function(){
        var docH  = $(document).height(),
            headH = $('#home_header').outerHeight();
        var targetH = docH - headH;

        $('#group_list').height(targetH);
        $('#users_list').height(targetH);
        
    };
    
    $(window).resize(function() {
        resizeWindow();
    });
    
    resizeWindow();
});
