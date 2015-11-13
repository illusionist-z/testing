/**
 * @author David Jor Hpan<david.gnext@gmail.com>
 * @type Edit ,delete for Setting Module
 * 
 */
var Setting = {
    
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
