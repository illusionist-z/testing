/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    
    //set slide menu
    if(document.getElementById("id") !== null){
        $('#slidemenu-left').mmenu();
        $('#logo').click(function(){
            $('#slidemenu-left').trigger('open');
        });
        $('#slidemenu-left').trigger('open');
    }
    // ここに実際の処理を記述します。
    var logout = function(){
        window.location.href = baseUri + 'auth/logout';
    };
    
    // ユーザーのクリックした時の動作。
    $('#btn_user').click(function(){
        logout();
    });
});