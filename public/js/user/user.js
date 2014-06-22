/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    /**
     * When window resize , resize to menu list ,too.
     * @returns {undefined}
     */
    var resizeContents = function(){
        var docH  = $(document).height(),
            headH = $('#home_header').outerHeight();
        var targetH = docH - headH;

        $('#group_list').height(targetH);
        $('#users_list').height(targetH);
        
    };
    
    $(window).resize(function() {
        resizeContents();
    });
    
    var Users = {
            get : function(){
                $form = $('#search_user');
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url : '/user/user/get',
                    data: $form.serialize(),
                    async: false,
                    success: function(data) {
                        if(data.status !== 'OK'){
                            return;
                        }
                        
                        var td;
                        $('#user_list_tbody').empty();
                        
                        // set user list
                        for( var i in data.users){
                            td = '<td>' + data.users[i]['name'] +'</td>'
                               + '<td>' + data.users[i]['email01'] +'</td>'
                            $('#user_list_tbody').append('<tr>' + td +'</tr>');
                        }

                    },
                    error: function() {

                    }
                });
            },
            
            resetCondition : function(){
                $('#search_delete_flag').val(0);
                $('#delete_flag').val(0);
            }
        };
    
    $('#filter_btn_all').click(function(){
        Users.resetCondition();
        $('#search_dept_code').val('');
        Users.get();
    });
    
    $('#filter_btn_deleted').click(function(){
        Users.resetCondition();
        $('#search_delete_flag').val(1);
        $('#search_dept_code').val('');
        Users.get();
    });
    
    /**
     * set listner 部署 (dept list)
     */
    $('#select_dept_list li').click(function(){
        Users.resetCondition();
        var dept_code = $(this).attr('id').substring(10);
        $('#search_dept_code').val(dept_code);
        Users.get();
    });
    
    resizeContents();
});
