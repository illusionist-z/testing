var Absent = {
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
}
$(document).ready(function () {

    $('.absentcheck').click(function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        Absent.Search(id);
    });
});

