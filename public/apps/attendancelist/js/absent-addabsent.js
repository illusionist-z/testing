var Absent = {
    //paging effect
    init: function () {
      $('.listtbl tbody').has("tr").length > 0 ? null : MsgDisplay() ;
    },
    Search: function (id) {
        //alert($('#add_salary').serialize());
        $.ajax({
            type: 'GET',
            url: baseUri + 'attendancelist/absent/addAbsent?id=' + id,
            success: function (d) {
                alert(d);
                //cond = JSON.parse(); 
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

