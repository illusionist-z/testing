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
                $("form").submit();
            },
             'Cancel': function () {
                $(this).dialog('close');
            }

        }

    });

}

 /**
 * @author Yan Lin Pai  <> <wizardrider@gmail.com>
 * @PageRuleSetting
 */
function PageRuleSetting()
{
    var dia_page_rule = $(this).attr('id');
    $("#pageRule" + dia_page_rule).dialog({
        modal: true,
        draggable: false,
        resizable: false,
        width: 300,
        height: 350,
        buttons: {
            'Save': function () {
               $("form").submit();
            },
             'Delete': function () {
                Setting.PageRule.delete(dia_page_rule);
            },
            'Cancel': function () {
                $(this).dialog('close');
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
    
    $("#addGroup").dialog({
        modal: true,
        draggable: false,
        resizable: false,
        width: 300,
        height: 200,
        buttons: {
            'Save': function () {
                   $("form").submit();
            },
            'Cancel': function () {
                $(this).dialog('close');
            }
        }
    });
}


function addPage()
{
    
    $("#addPage").dialog({
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
                $(this).dialog('close');
            }
        }
    });
}
 