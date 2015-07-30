/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @GEOprocess()
 * @get @lat @lng
 */


$(document).ready(function () {

    // ユーザーのクリックした時の動作。


    $('#edit').click(function () {
        document.getElementById('username').disabled=false;
        document.getElementById('password').disabled=false;
        document.getElementById('temp_password').disabled=false;
        document.getElementById('dept').disabled=false;
        document.getElementById('position').disabled=false;
        document.getElementById('email').disabled=false;
        document.getElementById('phno').disabled=false;
        document.getElementById('add').readOnly=false;
    });

    $('#sub').click(function () {
        sub();
    });

    $('#namesearch').click(function () {
        namesearch();
    });
});


