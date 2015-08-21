/** 
 * @author David
 * @desc dialog box ,event edit box   
 */

var Dialog = {
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
        var selectname;
        $.ajax({
            url:'index/getid?id='+event.id,
            type:'GET',
            async: false,
            dataType:'json',
            success:function(d){                
                selectname = d[0].member_id; 
            }
        });
        $ovl = $('#dialog');
        $('#title_edit_event').val(event.title);
        $('#sdate_edit_event').val(event.start.format());
        $('select#show_name').val(selectname);    
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
            height: 420,
            width: 450,
            modal: true
        });
       
        $('#submit_edit_event').click(function () {
             $('.err').text('');
             $('.err-sdate').text('');
             Dialog.edit(event.id);
        });
         $('#close_create_event').click(function () {
            $ovl.dialog("close");
        });
        $('#del_event').click(function () {
            Dialog.delete(event.id);
        });
        $ovl.dialog("open");
    },
    new : function (start, end) {
        if (!this.isOvl) {
            this.init();
        }
        $dia = $('#dialog_create');
        $sdate = $('#sdate_create_event').val(start);
        $edate = $('#edate_create_event').val(end);
        $title = $('#title_create_event').val();
        $('#sdate_create_event').datepicker({dateFormat: 'yy-mm-dd'});
        $('#edate_create_event').datepicker({dateFormat: 'yy-mm-dd'});
        $dia.dialog({
            autoOpen: false,
            closeText: "",
            height: 420,
            width: 450,
            modal: true
        });
        $('#reset_create_event').click(function () {
            $dia.dialog("close");
        });
        /*for edit box value err clear */
        $('.err').text('');
        $('.err-sdate').text('');
        $('#create_dialog').click(function () {
            Dialog.create();
        });
        $dia.dialog("open");
    },
    edit: function (id) {
        $.ajax({
            url: "index/edit?id=" + id,
            data: $('#edit_event').serialize(),
            async: false,
            dataType: 'json',
            success: function (d) {
                if (false == d.cond) {
                    $('.err').text(d.res).css("color", "red");
                    $('.err-sdate').text(d.date).css("color", "red");
                }
                else {
                    $('body').load("index");
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
    create: function () {
        $.ajax({
            url: "index/create",
            data: $('#create_event').serialize(),
            async: false,
            dataType: "json",
            success: function (d) {
                if (false == d.cond) {
                    $(".err").text(d.res).css("color", "red");
                    $(".err-sdate").text(d.date).css("color", "red");
                }
                else {
                    $('body').load("index");
                }
            }

        });
    },
    delete: function (id) {
        $.ajax({
            url: "index/delete",
            data: {data: id},
            async: false,
            dataType: 'json'
        }).
                done(
                        $('body').load('index')
                        );
    }
};
$(document).ready(function () {

    //get event from database
    $.ajax({
        url: 'index/showdata',
        type: 'POST',
        datyType: 'json',
        async: false,
        success: function (response) {
            json_events = response;
        }
    });

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
//        var date = new Date();
//        var d = date.getDate(),
//                m = date.getMonth(),
//                y = date.getFullYear();
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
        events: json_events,
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
            Dialog.drag(start, end, event.id, event.title);
        },
        eventDrop: function (event) {
            var start = event.start.format("YYYY-MM-DD"), end;
            if (event.end == null) {
                end = event.start.format("YYYY-MM-DD");
            }
            else {
                end = event.end.format("YYYY-MM-DD");
            }
            Dialog.drag(start, end, event.id, event.title);
        },
        select: function (start, end, allDay) {
            var start = start.format("YYYY-MM-DD");
            var end = end.format("YYYY-MM-DD");
            Dialog.new(start, end);
        },
        eventMouseout: function (calEvent, domEvent) {
           $('table').remove('.popup');
        },
        eventMouseover: function (event) {
            var start = event.start.format(),end;           
            if(event.end == null){
                 end = event.start.format();
            }else{
                end =event.end.format();
            }
            
            if ($(this).hasClass('popup')) {
                deselect($(this));
            } else {
            var str = "<table style='width:500px;height:100px;background:#aaa999;' border='1px' class='popup'><thead style='background:#fff;color:#000;'><td>Event</td><td>Description</td></thead>";
            str += "<tr><td>Title</td><td>" + event.title + "</td></tr>";
            str += "<tr><td>Time</td><td>" + start + "  - " + end + "</td></tr></table>";                              
               $(this).append(str);               
            }                                    
        },
        eventClick: function (event) {
            Dialog.open(event);
            //$ovl.dialog("open");
        }
    });
});

