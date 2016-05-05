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
    }
};

Setting.GroupRule = {
    delete: function (id) {
        $.ajax({
            url: "index/DelGroupRule",
            data: {group_id: id},
            type: "POST",
            success: function () {
                location.reload();
            }
        });
    }
};
Setting.PageRule = {
    delete: function (id) {
        $.ajax({
            url: "index/DelPageRule",
            data: {idpage: id},
            type: "POST",
            success: function () {
                location.reload();
            }
        });
    },
    paging: function () {
        
        $('#page_role ul.pagination a').unbind("click").bind("click", function (e) {
            e.preventDefault();
            var link = $(this).attr("href");
             $('#loading').html('<div class=circle></div>');
            $.ajax({
                url: link,
                data: {type: "page"},
                type: "GET",
                dataType: "json",
                success: function (d) {
                     
                    var paging = "",dialog = "";
                     $('#loading').html(d);
                    $('#page_role tbody').empty();
                    $('#page_role ul.pagination').empty();
                    for (var i in d[1].items) {
                        paging += '<tr><td style="text-align:center;">' + d[1].items[i].idpage + '</td>'
                                + '<td style="text-align:left;">' + d[1].items[i].permission_code + '</td>';
                        for (var j in d[0]) {
                            if (d[1].items[i].page_rule_group == d[0][j].group_id) {
                                paging += '<td style="text-align:left;">' + d[0][j].name_of_group + '(' + d[1].items[i].page_rule_group + ')</td>';
                            }
                        }                        
                        paging += '<td><a href="#" onclick="PageRuleSetting.apply(this);return false;" class="insettingedit" type="black" id="' + d[1].items[i].idpage + '"></a></td></tr>';
                           /**
                         * for use dialog 
                         */
                        dialog += '<div id="pageRule'+ d[1].items[i].idpage +'" title="Change Page Rule" style="display:none"><br> Group ID'
                                 +'<input type="text" style="margin-left:50px;" name="permission_group_code" value="'+d[1].items[i].permission_group_code+'" disabled><br> '
                                +'<form method="POST" action="index/User2RuleSetting">'
                                + 'Page  Name <input type="text" style="margin-left:33px;" name="permission_code" value="' + d[1].items[i].permission_code +'">'
                                + '<br><br>Group Rule<input type="hidden" name="idpage" value="'+d[1].items[i].idpage+'"><select type="text" style="margin-left:33px;" name="page_rule_group" id="changeuser">';
                        for (var j in d[0]) {
                            dialog += '<option value="' + d[0][j].group_id + '" ';
                            if (d[1].items[i].page_rule_group == d[0][j].group_id) {
                                dialog += 'selected>';
                            }
                            else{
                                dialog += '>';
                            }
                            dialog += d[0][j].name_of_group + '</option>';
                        }
                        dialog += "</select></form></div>";
                    }
                   
                    
                        var bar =  '<li><a href="index">First</a></li><li><a href="index?page=' + d[1].last + '">Last</a></li>';
                        for (var x = 1; x <= d[1].total_pages; x++) {
                            if ((d[1].current  + 3 ) >= x && (d[1].current  -  3 ) <= x){
                           bar += '<li><a href="index?page='+x+'"><b>'+x+'</b></a></li>';
                             }
                        }
                          var bar2 =  '<li><span>You are in page  <font color="red"> ' + d[1].current + ' </font>of ' + d[1].total_pages +'</span></li>';
                   
                    $('#page_role tbody').append(paging);
                    $('#page_role').append(dialog);
                    $('#page_role ul.pagination').append(bar,bar2);
                    Setting.init();
                 
                }
            });
        });
    }
};
Setting.UserRule = {
    update: function (id, groupid, grouptext) {
        $.ajax({
            url: 'index/UserRuleSetting',
            data: {rel_member_id: id, group_id: groupid, group_text: grouptext},
            type: "POST",
            success: function () {
                location.reload();
            }
        });
    },
    paging: function () {
        $('#user_role ul.pagination a').unbind("click").bind("click", function (e) {
            e.preventDefault();
            var link = $(this).attr("href");
              $('#loading').html('<div class=circle></div>');
            $.ajax({
                url: link,
                data: {type: "user"},
                type: "GET",
                dataType: "json",
                success: function (d) {
                    var paging = "",dialog = "";
                    $('#user_role tbody').empty();
                    $('#user_role ul.pagination').empty();
                    for (var i in d[1].items) {
                        paging += '<tr><td style="text-align:center;">' + d[1].items[i].group_id + '</td>'
                                + '<td style="text-align:left;">' + d[1].items[i].core.member_login_name + '</td>';
                        for (var j in d[0]) {
                            if (d[1].items[i].group_id == d[0][j].group_id) {
                                paging += '<td style="text-align:left;">' + d[0][j].name_of_group + '(' + d[1].items[i].group_id + ')</td>';
                            }
                        }                       
                        paging += '<td><a href="#" onclick="showDialoguser.apply(this);return false;" class="insettingedit" type="black" id="' + d[1].items[i].core.member_id + '"></a></td></tr>';
                         /**
                         * for use dialog 
                         */
                        dialog += '<div id="openu'+ d[1].items[i].core.member_id +'" title="Change User Rule" style="display:none"><form method="POST" action="index/UserRuleSetting">'
                                + 'User Name <input type="text" style="margin-left:50px;" name="member_login_name" value="' + d[1].items[i].core.member_login_name +'" disabled>'
                                + '<br><br>Group Rule<select type="text" style="margin-left:50px;" name="user_rule" id="changeuser'+ d[1].items[i].core.member_id +'">';
                        for (var j in d[0]) {
                            dialog += '<option value="' + d[0][j].group_id + '" ';
                            if (d[1].items[i].group_id == d[0][j].group_id) {
                                dialog += 'selected>';
                            }
                            else{
                                dialog += '>';
                            }
                            dialog += d[0][j].name_of_group + '</option>';
                        }
                        dialog += "</select></form></div>";
                    }
                         var bar =  '<li><a href="index">First</a></li><li><a href="index?page1=' + d[1].last + '">Last</a></li>';
                         
                         for (var x = 1; x <= d[1].total_pages; x++) {
                             if ((d[1].current  + 3 ) >= x && (d[1].current  -  3 ) <= x){
                           bar += '<li><a href="index?page1='+x+'"><b>'+x+'</b></a></li>';
                             }
                             
                          }
                          var bar2 =  '<li><span>You are in page  <font color="red"> ' + d[1].current + ' </font>of ' + d[1].total_pages +'</span></li>';     
                          
                    $('#user_role tbody').append(paging);
                    $('#user_role').append(dialog);
                    $('#user_role ul.pagination').append(bar,bar2);
                    Setting.init();
                }
            });
        });
    }
};
$(document).ready(function () {
    Setting.init();
});

 
