/**
 * 
 * @param {type} param
 * edit user profile
 * @author Su Zin Kyaw
 */

$(document).ready(function () {
    $('#edit').click(function () {
        document.getElementById('username').disabled=false;
        document.getElementById('password').disabled=false;
        document.getElementById('temp_password').disabled=false;
        document.getElementById('temp_file').disabled=false;
        document.getElementById('dept').disabled=false;
        document.getElementById('position').disabled=false;
        document.getElementById('email').disabled=false;
        document.getElementById('phno').disabled=false;
        document.getElementById('timezone').disabled=false;
        document.getElementById('save').disabled=false;
        document.getElementById('add').readOnly=false;
    });
   
});


