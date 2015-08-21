/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @GEOprocess()
 * @get @lat @lng
 */
var pager = new Paging.Pager();   //for pagination

$(document).ready(function () { 
         $("tfoot").html($('tbody').html()); //for csv
            pager.perpage =3;            
            pager.para = $('tbody > tr');
            pager.showPage(1);   
    // ユーザーのクリックした時の動作。        
             
});


