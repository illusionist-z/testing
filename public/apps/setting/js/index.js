function showDialog()
{
    var dia_id = $(this).attr('id');
    $("#open" + dia_id).dialog({
        modal: true,
        draggable: false,
        resizable: false,
        width: 300,
        height: 300,
        buttons: {
            'Save': function () {
                $("form").submit();
            },
            'Delete': function () {
                Setting.GroupRule.delete(dia_id);
            },
            'Cancel': function () {
                $(this).dialog('close');
            }
        }
    });



}




function showDialogname()
{
    var dia_id_name = $(this).attr('id');
    $("#opent" + dia_id_name).dialog({
        modal: true,
        draggable: false,
        resizable: false,
        width: 300,
        height: 350,
        buttons: {
            'Save': function () {
                jQuery(this).dialog('submit');
            },
            'Delete': function () {
                jQuery(this).dialog('submit');
            },
            'Cancel': function () {
                jQuery(this).dialog('close');
            }

        }

    });

}


function showDialoguser()
{
    var dia_id_name = $(this).attr('id');
    $("#openu" + dia_id_name).dialog({
        modal: true,
        draggable: false,
        resizable: false,
        width: 300,
        height: 350,
        buttons: {
            'Save': function () {
                var group_id = $('#changeuser'+dia_id_name+' option:selected').val();
                var group_text = $('#changeuser'+dia_id_name+' option:selected').text();
                Setting.UserRule.update(dia_id_name,group_id,group_text);
            },          
            'Cancel': function () {
                $(this).dialog('close');
            }

        }

    });
}
function addGroup()
{
    // var dia_id = $(this).attr('id'); 
    $("#addGroup").dialog({
        modal: true,
        draggable: false,
        resizable: false,
        width: 300,
        height: 300,
        buttons: {
            'Save': function () {
                $("form").submit();
            },
            'Cancel': function () {
                jQuery(this).dialog('close');
            }
        }
    });
}


