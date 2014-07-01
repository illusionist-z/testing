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
            headH = $('#home_header').outerHeight(),
            userSearchH = $('#user_list_search_box').outerHeight(),
            userListHd_h = $('#user_list_hd').outerHeight();
        var targetH = docH - headH;

        $('#group_list').height(targetH);
                
        //set the height to user_list_bd
        $('#user_list_bd').height(docH-userSearchH-userListHd_h);
        
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
                        
                        var td,i,i2,user,field;
                        $('#user_list_tbody').empty();
                        
                        // get list header classes
                        var ths = $('#ulh-thead').children();
                        
                        // set user list
                        for( i in data.users){
                            user = data.users[i];
                            td = '';
                            for (i2 in ths){
                                // set date by templete's order
                                if(!$.isNumeric(i2)) break;
                                field = ths[i2].className.split('-')[1];
                                td += '<td class="'+ths[i2].className+'"><div>' + user[field] +'<div></td>'
                            }
                            $('#user_list_tbody').append('<tr id="useid_'+user['id']+'">' + td +'</tr>');
                            
                        }
                        // set listner for show detail of an user
                        $('#user_list_tbody tr').dblclick(function(){
                            var id = $(this).attr('id').split('_')[1];
                            UserDetail.get(id);
                            $('#users_info').show();
                        });
                        
                        // create empty tr tag
                        td = '';
                        for (i2 in ths){
                            // set date by templete's order
                            if(!$.isNumeric(i2)) break;
                            td += '<td class="'+ths[i2].className+'"><div>&nbsp;<div></td>'
                        }
                        $('#user_list_tbody').append('<tr class="ult-empty-tag">' + td +'</tr>');

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
        
        
    /**
     * an user controller
     * @type type
     */
    var UserDetail = {
        get : function(id)
        {
            $form = $('#search_user');
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url : '/user/user/getOne/'+id,
                async: false,
                success: function(data) {
                    if(data.status !== 'OK') return;
                    var user = data.user,
                        id;//input id

                    //set field data in the register form
                    for(var i in user){
                        id = '#reg_'+ i;
                        $(id).val(user[i]);
                    }

                    //disable user list
                    $('#users_list').hide();

                    //add listner
                    $('#backto_list').click(function(){
                        UserDetail.backToList();
                    });
                    
                    $('#btn_edit_user').click(function(){
                        UserDetail.edit();
                    });

                },
                error: function() {

                }
            });
        },
        
        backToList : function(){
            $('#users_list').show();
            $('#users_info').hide();
        },
        
        edit : function(){
            
            // #TODO: レコードロックを行う。
            $('#regist_user input[type=text]').removeAttr('readonly');
        },
        
        regist : function(mode){
            
        }
        
    };
    
    /**
     * add listners
     */
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
