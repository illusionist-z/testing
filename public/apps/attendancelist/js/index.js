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

/*
 * show today list by return json array
 * @author David
 */
var todaylist = function (){               
        
        var name = document.getElementById('namelist').value;
        //url = baseUri + 'attendancelist/index/'+link+'?namelist='+name;
        
        $.ajax({
        url: 'todaylist?namelist='+name ,
        type: 'GET',
        success: function (d) {   
         $('body').html(d);
        },
        error: function (d) {
            alert('error');
        }       
    });                 
};
$(document).ready(function () { 
         $("tfoot").html($('tbody').html()); //for csv
            pager.perpage =3;            
            pager.para = $('tbody > tr');
            pager.showPage(1);   
    $('#namesearch').click(function () {           
        todaylist();
    });           
});


