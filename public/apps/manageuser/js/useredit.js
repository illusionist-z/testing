/**
 * @type edit
 * @since 20/7/15
 * @author David
 * @desc {dialog} for edit user profile
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
        // user edit button
        $('#edit_user_edit').click(function(e){
            e.preventDefault();
           User.DataChange($('#edit_user_id').val()); 
        });
        $('#edit_user_close').click(function(e){
            e.preventDefault();
            $ovl.dialog("close");
            this.isOvl=false;
        });
        // user delete button
        $('#edit_user_delete').click(function(e){
            e.preventDefault();
            User.Delete($('#edit_user_id').val());
        });
    },
    /**
     * @param {type} user id
     * @desc  update user data
     */
    DataChange: function (id){
        $form = $('#edit_user');
        $.ajax({
            type:"GET",
            url :"userdata_edit?data="+id,
            data:$form.serialize()            
        }).done(function(){
            $('body').load('userlist');
        });
    },
    Delete: function (d){
        
        $del = $('#confirm');
        $del.dialog({
            autoOpen:false,
            height:190,
            width:350,
            closeText:'',
            modal:true,
            buttons:{
                Delete:function(){
                    User.Confirm(d);
                },
                Cancel:function(){
                    $(this).dialog("close");
                }
            }
           
        });
        $del.html("<p>Are u sure to delete?</p>");
        $del.dialog("open");        
    },
    /**     
     * @desc confirmation delete
     */
    Confirm:function(id){
        $.ajax({
            type:'GET',
            url:'deleteuser',
            data:{data:id}            
        }).done(function(){
            $('body').load('userlist');
        });
    }
};
$(document).ready(function () {
    $(".displaypopup").click(function () {
        var id = $(this).attr('id');
        User.Edit(id);
    });    
});        
