/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function display_ct() {
    var x = new Date();
    var h = x.getHours();
    var m = x.getMinutes();
    var s = x.getSeconds();
    h = checktime(h);
    m = checktime(m);
    s = checktime(s);
    document.getElementById('ct').innerHTML = h + ":" + m + ":" + s;
    var t = setTimeout(function() {
        display_ct()
    }, 500);    
}
