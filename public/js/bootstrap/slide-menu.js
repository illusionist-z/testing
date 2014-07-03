/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    //set slide menu
    var Mmenu = {
        load : function(){
            $('#slidemenu-left').mmenu();
            $('#logo').click(function(){
                $('#slidemenu-left').trigger('open');
            });
            
            // add listner for menu buttons
            $('#apps_menu_list > li').click(function(){
                $('#slidemenu-left').trigger('close');
                var moduleName = $(this).attr('id').split('_')[1];
                window.location.href = '/'+moduleName;
            });
        }
    };    
    
    //load mmenu
    Mmenu.load();

    // logout
    $('#btn_logout').click(function(){
        window.location.href = '/auth/logout';
    });
});