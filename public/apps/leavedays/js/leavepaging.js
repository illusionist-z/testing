/** 
 * @author David<david.gnext@gmail.com>
 * @version 24/8/2015 David
 * @LeaveList
 */

this.pager = new Paging.Pager();
var Leave = {};

Leave.init = function (reload) {
    $("tfoot").html($('tbody').html()); //for csv           
    pager.perpage = 9;
    pager.para = $('tbody > tr');
    pager.showPage(1);
    $("tbody").show();

};


$(document).ready(function () {
    //intialize paging
    Leave.init('reload');

});


