/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    var userUri = baseUri + 'user/';
    
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
    
    /**
     * Users object
     * @author Kohei Iwasa
     * @type 
     */
    var Users = {
            /**
             * Get Users infomation
             * @returns {json} user's data
             */
            get : function(){
                $form = $('#search_user');
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url : userUri + 'user/get',
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
            
            /**
             * Reset condition for user's search
             * @returns {undefined}
             */
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
                url : baseUri + 'user/user/getOne/'+id,
                async: false,
                success: function(data) {
                    if(data.status !== 'OK') return;
                    var user = data.user,
                        id;//input id

                    //set field data in the register form
                    for(var i in user){
                        id = '#reg_'+ i;
                        if($(id).size() === 0) continue;
                        // swich it for the tag name
                        switch($(id)[0].tagName){
                            case 'INPUT':
                                $(id).val(user[i]);
                                break;
                            case 'DIV':
                                $(id).text(user[i]);
                                break;
                        }
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
                    
                    $('#btn_regist_user').click(function(){
                        UserDetail.regist();
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
        
        /**
         * Get the form for a new user
         * @returns {undefined}
         */
        getNewForm : function(){
            
        },
        
        edit : function(){
            var id = $('#reg_id').val();
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url : userUri + 'user/lock/'+id,
                async: false,
                success: function(data) {
                    if(data.status !== 'OK') return;
                },
                error: function() {

                }
            });
            // #TODO: レコードロックを行う。
            $('#regist_user input[type=text]').removeAttr('readonly');
        },
        
        regist : function(){
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url : userUri + 'user/update/'+id,
                async: false,
                success: function(data) {
                    if(data.status !== 'OK') return;
                },
                error: function() {
                    
                }
            });
            
            $('#regist_user input[type=text]').attr('readonly','true');
        }
        
    };
    
    /**
     * set listner on button of filter 'all'
     */
    $('#filter_btn_all').click(function(){
        Users.resetCondition();
        $('#search_dept_code').val('');
        Users.get();
    });
    
    /**
     * set listner on button of filter 'delete'
     */
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
    
    $('#filter_name_box').change(function(){
        Users.resetCondition();
        var wordSearch = $('#filter_name_box').val();
        $('#search_name').val(wordSearch);
        $('#search_kana').val(wordSearch);
        Users.get();
    });
    
    resizeContents();
});
