/**
 * @type edit
 * @since 20/7/15
 * @author David
 * @argument {dialog} for edit user profile
 */
var User = {
    isOvl:false,
    Edit: function (id) {
        $.ajax({
            type: 'GET',
            url: 'useredit?data=' + id,
            dataType: 'html',
            success: function (res) {
                User.Dialog(res);     
            }
        });
    },
    Dialog: function (data) {
        if(!this.isOvl){
            this.isOvl=true;
        }
        $ovl = $('#edituser');
        $ovl.dialog({
            autoOpen: false,
            height: 370,
            async:false,
            width: 800,
            modal: true,
            title:"User Edit"
        });                
        $ovl.html(data);
        $ovl.dialog("open");
        this.isOvl=false;
    }    
};
$(document).ready(function () {
    $(".displaypopup").click(function () {
        var id = $(this).attr('id');
        User.Edit(id);
    });
});        