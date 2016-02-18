/**
 * @author David Jor Hpan<david.gnext@gmail.com>
 * @type Edit ,delete for Setting Module
 * 
 */
var pager, pager2;
var Setting = {
    init: function () {
        Setting.PageRule.paging();
        Setting.UserRule.paging();
        $('tbody').show();
    }
};

Setting.GroupRule = {
    delete: function (id) {
        $.ajax({
            url : "DelGroupRule",
            data : {group_id : id},
            type : "POST",
            success: function(){
                location.reload();
            }
        });
    }
};
Setting.PageRule = {
    delete: function (id) {
        $.ajax({
            url : "DelPageRule",
            data : {idpage : id},
            type : "POST",
            success: function(){
                location.reload();
            }
        });
    },
    paging: function () {
        pager = new Paging.MultiPager();
        tbody = 'table#page_role > tbody';
        pager.currentpagerobject = 'pager';
        pager.content = 'table#page_role';
        pager.perpage = 4;
        pager.pagingcontainer = tbody;
        pager.para = $(tbody + " > tr ");
        pager.showPage(1);
    }
};
Setting.UserRule = {
    update: function (id, groupid, grouptext) {
        $.ajax({
            url : 'UserRuleSetting',
            data : {rel_member_id : id, group_id :groupid,group_text : grouptext},
            type : "POST",
            success : function(){
                location.reload();
            }
        });
    },
    paging: function () {
        pager2 = new Paging.MultiPager();
        tbody = 'table#user_role > tbody';//current table
        pager2.currentpagerobject = 'pager2';        //current pager object
        pager2.content = 'table#user_role';//current content
        pager2.perpage = 4;
        pager2.pagingcontainer = tbody;
        pager2.para = $(tbody + " > tr ");
        pager2.showPage(1);
    }
};

$(document).ready(function () {
    Setting.init();
});
