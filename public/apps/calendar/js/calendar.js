/** 
 * @author David JP<david.gnext@gmail.com>
 * @desc dialog box ,event edit box
 * @version 2/9/2015 @by David JP<david.gnext@gmail.com>
 */
var $ovl,$selectname;
var Calendar = {
    init : function (json_events) {
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
        
        events:typeof json_events === 'undefined'? '':json_events,
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
            if($('#dialog_create').hasClass('ui-dialog-content')){
                $('#sdate_create_event').val(start);
                $('#edate_create_event').val(end);
                $('#dialog_create').dialog('open');
            }
            else{Calendar.Dialog.new(start, end);}
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
            var str = "<table style='width:300px;height:80px;background:#3c8dbc;' border='1px' class='popup'><thead style='background:#fff;color:#000;'><td>Event</td><td>Description</td></thead>";
            str += "<tr><td>Title</td><td>" + event.title + "</td></tr>";
            str += "<tr><td>Time</td><td>" + start + "  - " + end + "</td></tr></table>";
               $(this).append(str);
            }
        },
        
        eventClick: function (event) {
            //check dialog box exist
            $ovl = $('#dialog');
            if(!$ovl.hasClass('ui-dialog-content')) {
                  $selectname = $('select#show_name').val();
                  $ovl.css('color','black');
                  $ovl.css('background','#F5F5F5'); 
                  $('#submit_edit_event').click(function () {
                            $('.err').text('');
                            $('.err-sdate').text('');
                            Calendar.Dialog.edit(event.id,$selectname,$ovl);
                  });
                  $('#close_create_event').click(function () {
                       $ovl.dialog("close");
                   });
                  $('#del_event').click(function () {
                       Calendar.Dialog.delete(event.id,$selectname,$ovl);
                  });
            }
          Calendar.Dialog.open(event);
        }
    });
    
    },
    event : function(val){
        $.ajax({
            type : "GET",
            url  : "index/showdata",
            async: false,
            data : {event_id:val},
            success : function(d){
                d = JSON.parse(d);
    if(d.length === 0){
    var message = "<div class='message' style='top:30%;left:18%;"
    +"text-align:center;background:#3c8dbc;color:white;position:absolute;"
    +";width:64%;height:10%;z-index:100;font-size:33px;margin-left:115px;'><div style='margin-top:5px;'>No event with that user........</div></div>";
    $('body').append(message);
    setTimeout(function() {
    $('.message').remove();
    }, 2000);
    }
    else{
     $('#calendar').remove();    //remove calendar origin     
     $('.box-body').html('<div id="calendar" class="bg-info" style="width:100%;height:130%;"></div>');//replace a new calendar               
     Calendar.init(d);     
    }
    }
        });
    },
    calenderautolist: function() {                                              
       var dict = [];
       $.ajax({
                url:'index/calenderauto',
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
                //alert(data);    
                var json_obj = $.parseJSON(data);
               // alert(json_obj);
                for (var i in json_obj){
                    //alert(json_obj[i].full_name);
                dict.push(json_obj[i].full_name);
                }
                  //var dict = ["Test User02","Adminstrator"];
                loadIcon(dict);
                        }
                        
                    });
                     function loadIcon(dict) {
                       //alert(dict);
                        $('#select_name').autocomplete({
              source: dict
            });
       // ... do whatever you need to do with icon here
   }
    
    },
    eventcalenderautolist: function() {                                              
       var dict = [];
       $.ajax({
                url:'index/calenderauto',
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
                //alert(data);    
                var json_obj = $.parseJSON(data);
               // alert(json_obj);
                for (var i in json_obj){
                    //alert(json_obj[i].full_name);
                dict.push(json_obj[i].full_name);
                }
                  //var dict = ["Test User02","Adminstrator"];
                loadIcon(dict);
                        }
                        
                    });
                     function loadIcon(dict) {
                       //alert(dict);
                        $('#event_uname').autocomplete({
              source: dict
            });
       
   }
    
    },
    remove_event_member : function() {                                              
        var selectedvalue = [];        
      if($(':checkbox:checked').length > 0){
        $(':checkbox:checked').each(function(i){
          selectedvalue[i] = $(this).val();
          //alert(selectedvalue[i]);
         });
         $.ajax({
             url : "index/removeEventByname",
             data : {remove : selectedvalue},
             type : "POST",
             success : function(){
                // alert(d);
              $('body').load('index');
             }
         });
         }
       else {alert("You must check at least one");}
    },
    /**
     * @author David 9/16/2015
     * @desc    member search adding
     * @returns {json data}
     */
    getmemberevent : function(){                        
         var member = [];
       $.ajax({
                url:'index/getmember',
                method: 'GET',                
                success: function(data) {                
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){                  
                member.push(json_obj[i].full_name);
                }                  
                  Calendar.automember(member);
                        }                        
                    });                
       
        $("#member_event_dialog").dialog({
            autoOpen :false,
            height: 160,
            width : 400,
            title: "Add Member",
            modal :true
        });                
      $("#member_event_dialog_close").on("click",function(){
            $("#member_event_dialog").dialog("close");            
        });
        $("#member_event_dialog").dialog("open");      
    },
    automember : function (d){
             
        $("#member_event").autocomplete({   
           source:      d,          
          minLength: 1,
           select: function(event, ui) {         
               $("#member_event_add").attr("disabled",false);               
               $("#member_event_add").unbind("click").bind("click",function(e){
                   e.preventDefault();
                   $.ajax({
                       type : "GET",
                       data:{permit:ui.item.value},
                       url :"index/addmember",
                       dataType:"json",
                       success:function(d){
                           if( d === 1){
                               alert("Already exist");
                           }
                           else{
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
        $selectname;
        $.ajax({
            url:'index/getid?id='+event.id,
            type:'GET',
            async: false,
            dataType:'json',
            success:function(d){                
                $selectname = d[0].member_name;
            }
        });
        $('#title_edit_event').val(event.title);
        $('#sdate_edit_event').val(event.start.format());
        $('select#show_name').val($selectname);
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
            height: 380,
            width: 450,
            modal: true
        });
        $ovl.dialog("open");
    },
    new : function (start, end) {
        if (!this.isOvl) {
            this.init();
        }
        $dia = $('#dialog_create');
        $dia.css('color','black');
        $dia.css('background','#F5F5F5');
        $sdate = $('#sdate_create_event').val(start);
        $edate = $('#edate_create_event').val(end);
        $title = $('#title_create_event').val();
        $('#sdate_create_event').datepicker({dateFormat: 'yy-mm-dd'});
        $('#edate_create_event').datepicker({dateFormat: 'yy-mm-dd'});
        $dia.dialog({
            autoOpen: false,
            closeText: "",
            height: 380,
            width: 400,
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
    edit: function (id,old_id,dia) {
        $name = $('#show_name option:selected').attr("name");
        $.ajax({
            url: "index/edit/"+id+"/"+$name,
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
        $id = $('#select_name option:selected').attr("name");
        $.ajax({
            url: "index/create/"+$id,
            data: $('#create_event').serialize(),
            async: false,
            dataType: "json",
            success: function (d) {
                if (false == d.cond) {
                    if(d.title){
                        $("#title_create_event").attr("placeholder",d.title).css("border","2px solid red");repair("#title_create_event");
                    }
                    if(d.date) {
                        $("#sdate_create_event").attr("placeholder",d.date).css("border","2px solid red");repair("#sdate_create_event");
                        $("#edate_create_event").attr("placeholder",d.date).css("border","2px solid red");repair("#sdate_create_event");
                    }
                    if(d.name){
                           $("#select_name option:first").text(d.name);
                           $("#select_name").css("border","2px solid red").focus(function(){$("#select_name option:first").text("Name");});
                           repair("#select_name");
                    }
                }
                else {
               $('#calendar').remove(),    //remove calendar origin
               $('.box-body').html('<div id="calendar" class="bg-info" style="width:100%;height:130%;"></div>'),//replace a new calendar
               $('body').load('index');
               dia.dialog("close");
                }
            }

        });
    },
    delete: function (id,member,dia) {
        $.ajax({
            url: "index/delete",
            data: {data: id},
            async: false,
            dataType: 'json'
        }).done(
            $('#calendar').remove(),    //remove calendar origin
            $('.box-body').html('<div id="calendar" class="bg-info" style="width:100%;height:130%;"></div>'),//replace a new calendar
            Calendar.event(member),dia.dialog("close")
            );
    }    
};
$(document).ready(function () {
      Calendar.init();
   //select member event btn
   $('.btn-show-event').click(function(){
      var selectedvalue = [];
      if($(':checkbox:checked').length > 0){
        $(':checkbox:checked').each(function(i){
          selectedvalue[i] = $(this).val();
         });
         Calendar.event(selectedvalue);
         }
      else {alert("You must check at least one");}
   });
   $('#shapbott').click(function(){
       Calendar.getmemberevent();
   });
   $('.disabledevent').click(function(){
       Calendar.remove_event_member();
   });
   //for calender auto complete username
   $('#select_name').click(function(){
       Calendar.calenderautolist();
   });
    //for event calender auto complete username
   $('#event_uname').click(function(){
       Calendar.eventcalenderautolist();
   });
   
});

