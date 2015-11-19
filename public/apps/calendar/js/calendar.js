/** 
 * @author David JP<david.gnext@gmail.com>
 * @desc dialog box ,event edit box
 * @version 2/9/2015
 */
var $ovl, $selectname, dict = [];
var Calendar = {
    init: function (json_events) {                
        
        if (!json_events) {
            $.ajax({
                url: 'index/calenderauto',
                method: 'GET',
                //dataType: 'json',
                success: function (data) {
                    //alert(data);    
                    var json_obj = $.parseJSON(data);
                    // alert(json_obj);
                    for (var i in json_obj) {
                        //alert(json_obj[i].full_name);
                        dict.push(json_obj[i].full_name);
                    }
                }
            });
        }
        /* initialize the calendar
         -----------------------------------------------------------------*/
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            },
            events: typeof json_events === 'undefined' ? '' : json_events,
            //Random default events
            selectable: true,
            resizable: true,
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            eventResize: function (event) {
                var start = event.start.format("YYYY-MM-DD");
                var end = event.end.format("YYYY-MM-DD");
                var shr = event.start.format("HH:mm:ss");
                var ehr = event.end.format("HH:mm:ss");
                //var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");  
                Calendar.Dialog.drag(start, end, event.id, event.title);
            },
            eventDrop: function (event) {
                var start = event.start.format("YYYY-MM-DD"), end;
                if (event.end == null) {
                    end = event.start.format("YYYY-MM-DD");
                }
                else {
                    end = event.end.format("YYYY-MM-DD");
                }
                Calendar.Dialog.drag(start, end, event.id, event.title);
            },
            select: function (start, end, allDay) {
                var start = start.format("YYYY-MM-DD");
                var end = end.format("YYYY-MM-DD");
                //check if dialog is exist
                if ($('#dialog_create').hasClass('ui-dialog-content')) {
                    $('#sdate_create_event').val(start);
                    $('#title_create_event').val("");
                    $('#select_name').val("");
                    $('#edate_create_event').val(end);
                    $('#dialog_create').dialog('open');
                }
                else {
                    Calendar.Dialog.new(start, end);
                }
            },
            eventMouseout: function (calEvent, domEvent) {
                $('table').remove('.popup');                
            },
            eventMouseover: function (event) {
                var start = event.start.format(), end;
                if (event.end == null) {
                    end = event.start.format();
                } else {
                    end = event.end.format();
                }
                
                if ($(this).hasClass('popup')) {
                    deselect($(this));
                } else {                    
                    var str = "<table style='width:300px;height:80px;background:#3c8dbc;z-index:9999;position:relative;' border='1px' class='popup'><thead style='background:#fff;color:#000;'><td>Event</td><td>Description</td></thead>";
                    str += "<tr><td>Title</td><td>" + event.title + "</td></tr>";
                    str += "<tr><td>Time</td><td>" + start + "  - " + end + "</td></tr></table>";
                    $(this).append(str);         
            }
            },
            eventClick: function (event) {
                //check dialog box exist
                $ovl = $('#dialog');
                Calendar.Dialog.open(event);
            }
        });
        
        $('.fc-today').css("opacity","0.319");
    },
    event: function (val,reload) {
        $.ajax({
            type: "GET",
            url: "index/showdata",
            async: false,
            data: {event_id: val},
            success: function (d) {
                d = JSON.parse(d);
                if (d.length === 0) {
                    var message = "<div class='message' style='top:30%;left:18%;"
                            + "text-align:center;background:#3c8dbc;color:white;position:absolute;"
                            + ";width:64%;height:10%;z-index:100;font-size:33px;margin-left:115px;'><div style='margin-top:5px;'>No event with that user........</div></div>";
                    $('body').append(message);
                    setTimeout(function () {
                        $('.message').remove();
                    }, 2000);
                    if(reload){
                        Calendar.init({0:0}); //for calendar blank event
                    }
                }
                else {
                    $('#calendar').remove();    //remove calendar origin 
                    $('.box-body').html('<div id="calendar" class="bg-info" style="width:100%;height:130%;"></div>');//replace a new calendar
                    Calendar.init(d);
                }
            }
        });
    },
    getmemid: function (name) {
        //var name = document.getElementById('namelist').value;
        // alert("aaa");
        //url = baseUri + 'attendancelist/index/'+link+'?namelist='+name;
        var dict = [];
        $.ajax({
            url: 'index/getcalmemberid?uname=' + name,
            method: 'GET',
            //dataType: 'json',
            success: function (data) {
                //alert(data);    
                var json_obj = $.parseJSON(data);
                //alert(json_obj);
                for (var i in json_obj) {
                    //alert(json_obj[i].member_id);
                    // var aa = json_obj[i].member_id;
                    //alert(aa);
                    //$('#formemberid').text(json_obj[i].member_id);
                    // $(".salusername").text(aa);
                    dict.push(json_obj[i].member_id);
                }
                //var dict = ["Test User02","Adminstrator"];
                // alert(dict);
                loadIcon(dict);
            }

        });
        function loadIcon(dict) {
            //alert(dict);
            $('#formemberid').val(dict);
        }

    },
    remove_event_member: function () {
        var selectedvalue = [];
        if ($(':checkbox:checked').length > 0) {
            $(':checkbox:checked').each(function (i) {
                selectedvalue[i] = $(this).val();
                //alert(selectedvalue[i]);
            });
            $.ajax({
                url: "index/removeEventByname",
                data: {remove: selectedvalue},
                type: "POST",
                success: function () {
                    // alert(d);
                    $('body').load('index');
                }
            });
        }
        else {
            alert("You must check at least one");
        }
    },
    /**
     * @author David 9/16/2015
     * @desc    member search adding
     * @returns {json data}
     */
    getmemberevent: function () {
        $("#member_event_dialog").dialog({
            autoOpen: false,
            height: 'auto',
            width: 'auto',
            resizable: false,
            title: "Add Member",
            modal: true
        });
        $("#member_event_dialog_close").on("click", function () {
            $("#member_event_dialog").dialog("close");
        });

        $("#member_event_dialog").dialog("open");
        //add member autocomplete @dialog box
        $("#member_event").autocomplete({
            source: dict,
            minLength: 1,
            select: function (event, ui) {
                $("#member_event_add").attr("disabled", false);
                $("#member_event_add").unbind("click").bind("click", function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: "GET",
                        data: {permit: ui.item.value},
                        url: "index/addmember",
                        dataType: "json",
                        success: function (d) {
                            if (d === 1) {
                                alert("Already exist");
                            }
                            else {
                                location.reload();
                            }
                        }
                    });
                    return false;
                });
            }
        });
    }
};
Calendar.Dialog = {
    isClick: false,
    isOvl: false,
    init: function () {
        this.isOvl = true;
    },
    //dialog box data sync
    open: function (event) {
        if (!this.isOvl) {
            this.init();
        }
        /**
         * get current name
         * @type @arr member_id
         */
        $.ajax({
            url: 'index/getid?id=' + event.id,
            type: 'GET',
            async: false,
            dataType: 'json',
            success: function (d) {
                $selectname = d[0].member_name;
            }
        });

        $('#title_edit_event').val(event.title);
        $('#sdate_edit_event').val(event.start.format());
        $('#show_name').val($selectname);
        /* event.end date is empty ,put start date */
        if (event.end == null) {
            $('#edate_edit_event').val(event.start.format());
        }
        else {
            $('#edate_edit_event').val(event.end.format());
        }
        $('#sdate_edit_event').datepicker({dateFormat: 'yy-mm-dd'});
        $('#edate_edit_event').datepicker({dateFormat: 'yy-mm-dd'});
        $ovl.dialog({
            autoOpen: false,
            closeText: "",
            height: 'auto',
            width: 'auto',
            modal: true
        });
        $ovl.css('color', 'black');
        $ovl.css('background', '#F5F5F5');
        /**
         * edit ,delete action button
         */
        $('#submit_edit_event').unbind('click').bind('click', function () {
            $('.err').text('');
            $('.err-sdate').text('');
            Calendar.Dialog.edit(event.id, $selectname, $ovl);
        });
        $('#close_create_event').click(function () {
            $ovl.dialog("close");
        });
        $('#del_event').unbind('click').bind('click', function () {
            Calendar.Dialog.delete(event.id, $selectname, $ovl);
        });
        $ovl.dialog("open");
    },
    new : function (start, end) {
        if (!this.isOvl) {
            this.init();
        }
        $dia = $('#dialog_create');
        $dia.css('color', 'black');
        $dia.css('background', '#F5F5F5');
        $sdate = $('#sdate_create_event').val(start);
        $edate = $('#edate_create_event').val(end);
        $title = $('#title_create_event').val();
        $('#sdate_create_event').datepicker({dateFormat: 'yy-mm-dd'});
        $('#edate_create_event').datepicker({dateFormat: 'yy-mm-dd'});
        $dia.dialog({
            autoOpen: false,
            closeText: "",
            height: 'auto',
            width: 'auto',
            resizable: false,
            modal: true
        });
        $('#reset_create_event').click(function () {
            $dia.dialog("close");
        });
        $('#create_dialog').click(function () {
            Calendar.Dialog.create($dia);
        });
        $dia.dialog("open");
    },
    edit: function (id, old_id, dia) {
        $name = $('#show_name option:selected').attr("name");
        $.ajax({
            url: "index/edit/" + id + "/" + $name,
            data: $('#edit_event').serialize(),
            async: false,
            dataType: 'json',
            success: function (d) {
                if (false == d.cond) {
                    $('.err').text(d.res).css("color", "red");
                    $('.err-sdate').text(d.date).css("color", "red");
                }
                else {
                    Calendar.event(old_id);
                    $('.dropdown-toggle').dropdown();
                    dia.dialog("close");
                }
            }
        });
    },
    //drag & resize event 
    drag: function (start, end, id, title) {
        $.ajax({
            url: "index/edit",
            data: {sdate: start, edate: end, id: id, title: title},
            async: false,
            dataType: 'json'
        });
    },
    //create new event
    create: function (dia) {
        $.ajax({
            url: "index/create",
            data: $('#create_event').serialize(),
            async: false,
            dataType: "json",
            success: function (d) {
                if (false == d.cond) {
                    if (d.title) {
                        $("#title_create_event").attr("placeholder", d.title).css("border", "2px solid red");
                        repair("#title_create_event");
                    }
                    if (d.date) {
                        $("#sdate_create_event").attr("placeholder", d.date).css("border", "2px solid red");
                        repair("#sdate_create_event");
                        $("#edate_create_event").attr("placeholder", d.date).css("border", "2px solid red");
                        repair("#sdate_create_event");
                    }
                    if (d.name) {
                        $("#select_name option:first").text(d.name);
                        $("#select_name").css("border", "2px solid red").focus(function () {
                            $("#select_name option:first").text("Name");
                        });
                        repair("#select_name");
                    }
                }
                else {
                     var selectedvalue = [];                            
                    $('#calendar').remove(), //remove calendar origin
                    $('.box-body').html('<div id="calendar" class="bg-info" style="width:100%;height:130%;"></div>'), //replace a new calendar                            
                    dia.dialog("close");
                    if ($(':checkbox:checked').length > 0) {
                                $(':checkbox:checked').each(function (i) {
                                    selectedvalue[i] = $(this).val();
                                });                                            
                     }
                    if(selectedvalue != ""){
                        Calendar.event(selectedvalue,"none");
                        //Calendar.Dialog.auto();
                    }
                    else{
                        $('body').load('index');
                    }
                    }                    
                }            
        });
    },
    delete: function (id, member, dia) {
        $.ajax({
            url: "index/delete",
            data: {data: id},
            async: false,
            dataType: 'json'                                                         
        }).done(reload(member,dia));
    },
    auto : function (){
            $('#select_name').click(function () {
        $(this).autocomplete({
            source: dict
        });
    });
    //for event calender auto complete username
    $('#event_uname,#show_name').click(function () {
        $(this).autocomplete({
            source: dict
        });
    });
    }
};
$(document).ready(function () {
    Calendar.init();
    //select member event btn
    $('.btn-show-event').click(function () {
        var selectedvalue = [];
        if ($(':checkbox:checked').length > 0) {
            $(':checkbox:checked').each(function (i) {
                selectedvalue[i] = $(this).val();
            });
            Calendar.event(selectedvalue,"none");
        }
        else {
            alert("You must check at least one");
        }
    });
    $('#shapbott').click(function () {
        Calendar.getmemberevent();
    });
    $('.disabledevent').click(function () {
        Calendar.remove_event_member();
    });
    //for calender auto complete username
    $('#select_name').click(function () {
        $(this).autocomplete({
            source: dict
        });
    });
    //for event calender auto complete username
    $('#event_uname,#show_name').click(function () {
        $(this).autocomplete({
            source: dict
        });
    });
    $("#create_dialog").mouseenter(function () {

        var name = document.getElementById('select_name').value;
        //alert(name);
        //Calendar.getmemid(name);

    });
});

function reload(member,dia){
    $('#calendar').remove();//remove calendar origin
                $('.box-body').html('<div id="calendar" class="bg-info" style="width:100%;height:130%;"></div>'); //replace a new calendar
                
                var selectedvalue = [];
                 if ($(':checkbox:checked').length > 1) {
                                $(':checkbox:checked').each(function (i) {
                                    selectedvalue[i] = $(this).val();
                                });                                            
                     }
                    if(selectedvalue != ""){
                        Calendar.event(selectedvalue,"none");
                        //Calendar.Dialog.auto();
                    }
                    else{
                        Calendar.event(member,"none")
                    }
                 
               dia.dialog("close");
               $('.dropdown-toggle').dropdown();
}