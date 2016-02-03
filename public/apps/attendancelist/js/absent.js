var pager = new Paging.Pager();
var Absent = {
    //paging effect
    init: function () {
        $('tfoot').append($('table.listtbl tbody').html());   //for csv 
        pager.perpage = 8;
        pager.para = $('table.listtbl tbody > tr');
        pager.showPage(1);
        $('tbody').show();
    },
    Search: function (id) {
        $.ajax({
            type: 'GET',
            url: baseUri + 'attendancelist/absent/addAbsent?id=' + id,
            success: function (d) {
                alert(d);
            }
        });
    }
};
$(document).ready(function () {
    Absent.init();

    $('.absentcheck').on('click', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        Absent.Search(id);
    });
});

