/**
 * @author David Jor Hpan<david.gnext@gmail.com>
 * @type Edit ,delete for Setting Module
 * 
 */
var pager = new Paging.Pager();
var Setting = {    
    init  : function () {        
           tbody = 'table#user_role > tbody';
            pager.perpage =4;
            pager.pagingcontainer = tbody;
            pager.para = $(tbody+" > tr ");
            pager.showPage(1);
            $('tbody').show();
    }
};
 
Setting.GroupRule = {
    delete : function(id){
        $.ajax({
            url : " DelGroupRule",
            data : {group_id : id},
            type : "POST",
            success: function(){
                location.reload();
            }
        });
    } 
 };
 Setting.UserRule = {
    update : function(id,groupid,grouptext){
        $.ajax({
            url : 'UserRuleSetting',
            data : {rel_member_id : id, group_id :groupid,group_text : grouptext},
            type : "POST",
            success : function(){
                location.reload();
            }
        });
    } 
 };
 
$(document).ready(function(){
    Setting.init();
});