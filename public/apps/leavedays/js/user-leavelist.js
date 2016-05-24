/** 
 * @type json array {}
 * @desc Apply Leave Form validation
 * @author David JP <david.gnext@gmail.com>
 */
var LeaveList = {
    search: function () {
        var month = document.getElementById('month').value;
        var ltype = document.getElementById('ltype').value;
        if (month === "" && ltype === "") {
            $('tbody').empty();
            var output = "<tr>"
                    + "<td colspan='9'><center>No data to display</center></td>"
                    + "</tr>"
            $("tbody").append(output);
        }
        else {
            window.location.href = baseUri + 'leavedays/user/leavelist?month=' + month + '&ltype=' + ltype;
        }
    }
};
$(document).ready(function () {
    $('#usersearch').on('click', function () {
        LeaveList.search();
    });
});

