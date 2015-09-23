/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var pager = new Paging.Pager();   //for pagination

/*
 * show today list by return json array
 * @version 24/8/2015 David
 */
var Attendance = {
        init : function (){            
            $('tfoot').html($('tbody').html());   //for csv
            pager.perpage =7;            
            pager.para = $('tbody > tr');
            pager.showPage(1);  
            $('tbody').show();
           
        },
        autolist: function (){                       
        var name = document.getElementById('namelist').value;
            
        //url = baseUri + 'attendancelist/index/'+link+'?namelist='+name;
        $.ajax({
        url: 'autolist' ,
        type: 'GET',
        success: function (d) { 
            alert(d);
            // alert(d);
            
//             var arr=[];
//             for(var i in d){
//                 arr.push(d[i]);
//                 
//             }
//             //alert(arr);
//            // alert(arr);
//             $( ".tags" ).autocomplete({
//                        source: arr
//                      });
                 //var arr=["aye aye","bie bie","sine sine","kyaw kyaw"];
//                  var arr=[d];
//                for(var i in d){
//                        var aa=d[i].full_name;
//                       // alert(aa);
//                       // alert(data[i].full_name);
//                        arr.push(aa);
//                        
//                }
//                
//                 alert(arr);
//            
//           // alert(arr);
//            // alert(arr);
//             $( ".tags" ).autocomplete({
//                        source: arr
//                      }); 
//


                    var JSONString = d; // Replace ... with your JSON String
                      //  alert(JSONString);
                      var JSONObject = $.parseJSON(JSONString);
                     // console.log(JSONObject);      // Dump all data of the Object in the console
                    var aa = JSONObject[0]["full_name"]; // Access Object data
                        alert(aa);
                        //alert(JSONObject);
                       $( ".tags" ).autocomplete({
                                   source: JSONObject
                                 });

//                            var data = eval('(' + d + ')');
//                           // var data = JSON.stringify(eval("(" + d + ")"));
//                          //var data = $.parseJSON('[' + d + ']');
//                            var arr=["zin min tun","mg mg","su su","kyaw kyaw"];
//                            for(var i in data){
//                                var aa=data[i].full_name;
//                               // alert(aa);
//                               // alert(data[i].full_name);
//                                arr.push(aa);
//                            }
//                         // alert(arr);
//                          
//
//
////                          function strToJson(str) {
////                                 eval("var x = " + str + ";");
////                                 return JSON.stringify(x);
////                           }
////
////
////                var str = arr;
//              //  alert( strToJson(str) );
//              var data = arr;
//             // alert(data);
//              data = [data];
//              //alert(data);
//                $( ".tags" ).autocomplete({
//                    source: data
//               });
//               
//               
//                        var bb = eval('(' + d + ')');
//                       // alert(bb);
//                        var data = JSON.stringify(eval("(" + d + ")"));
//                      //var data = $.parseJSON('[' + d + ']');
//                      //alert(data);
//                     // var obj = JSON.parse(data);
//                      var obj = $.parseJSON(d);
//                     // alert(obj);
//                     var jsondata=[];
//                      for (var x in obj){
//                         
//                        if (obj.hasOwnProperty(x)){
//                          // your code
//                            var aa=obj[x].full_name;
//                            jsondata.push(aa);
//                        }
//                         
//                      }
//                      //alert(jsondata);
//                      
//                       var arr=[jsondata,"zin min tun","mg mg","su su","kyaw kyaw"];
//                    
//                   //alert(arr);
//                      $( ".tags" ).autocomplete({
//                                   source: arr
//                                 });
////
//                        var arr=["zin min tun","mg mg","su su","kyaw kyaw"];
//                        for(var i in data){
//                            var aa=data[i].full_name;
//                           // alert(aa);
//                           // alert(data[i].full_name);
//                            arr.push(aa);
//                        }
//                     // alert(arr);
//                       // alert(arr);
//                        $( ".tags" ).autocomplete({
//                                   source: arr
//                                 }); 

//             var data = eval('(' + d + ')');
//            // var data = JSON.stringify(eval("(" + d + ")"));
//           //var data = $.parseJSON('[' + d + ']');
//             var arr=["zin min tun","mg mg","su su","kyaw kyaw"];
//             for(var i in data){
//                 var aa=data[i].full_name;
//                // alert(aa);
//                // alert(data[i].full_name);
//                 arr.push(aa);
//             }
//           alert(arr);
//            // alert(arr);
//             $( ".tags" ).autocomplete({
//                        source: arr
//                      }); 
                      
            
//            //alert(d);
//             var data = JSON.stringify(d);
//            // alert(data);
//             var arr=[];
//             for(var i in data){
//                 arr.push(data[i]);
//             }
//             //alert(arr);
//             $( ".tags" ).autocomplete({
//                        source: arr
//                      });
         //('body').html(d);
//         if(name ==''){
//             alert(d);
//            var json_obj = $.parseJSON(d);//parse JSON   
//            
//            var obj = JSON.parse(json_obj);
//            alert(obj);
//                for (var i in obj)
//                {   
//                    
//                   var availableTags = obj[i].full_name;
//                 $("tbody").append(availableTags);    
//                //alert(availableTags);                
//                      
//                }
//                alert(availableTags);
//                $( ".tags" ).autocomplete({
//                        source: availableTags
//
//                      });
//               
//             $( ".tags" ).autocomplete({
//                        source: availableTags
//                      });
//         }
//         else{
//             alert(name);
//           
//         }
          
           
           // alert(json_obj);exit;
           
           
        },
        error: function (d) {
            alert('error');
        }       
       }); 
        
     
   
    
 
  
                 
       },
        todaylist: function (){                       
        var name = document.getElementById('namelist').value;
        //url = baseUri + 'attendancelist/index/'+link+'?namelist='+name;
        
        $.ajax({
        url: 'todaylist?namelist='+name ,
        type: 'GET',
        success: function (d) {   
         $('body').html(d);
        },
        error: function (d) {
            alert('error');
        }       
       });                 
       },
       monthlylist : function () {
        var month = document.getElementById('month').value;
        var username = document.getElementById('username').value;
        var year = document.getElementById('year').value;
        //$('tbody').empty();
        if(month=="" && username=="" && year==""){
            $('tbody').empty();
            
             var output = "<tr>"
                            + "<td colspan='8'><center>No data to display</center></td>"
                           
                            + "</tr>"
                    $("tbody").append(output);
                    Attendance.init();
        }
        else{
           
     //window.location.href = baseUri + 'attendancelist/search/attsearch?month='+month+'&username='+username+'&year=' +year;
        $.ajax({
            url: baseUri + 'attendancelist/search/attsearch?month=' + month + '&username=' + username + '&year=' + year,
            type: 'GET',
            success: function (d) {  
               //alert(d);exit;
               //alert(d);
                var json_obj = $.parseJSON(d);//parse JSON            
               //alert(json_obj);
               $('tbody').empty();  
               $('tfoot').empty();
              
                for (var i in json_obj)
                {   
                    checkin_place = json_obj[i].location;
                    a = "08:00:00";
                    n = new Date();
                    offset = n.getTimezoneOffset();
                    if (offset<0){
                    sign='-';
                    value=offset*(-1);
                    }
                    else{
                    value=offset*(-1);
                    sign='+';
                    } 

                    checkin = json_obj[i].checkin_time.split(" ");
                    b = checkin[1];
                    ds=b.split(":");
                    total=(ds[0]*3600)+(ds[1]*60)+(ds[2]*1);
                    if (sign==='-'){
                    time_diff=total +(value*60);}
                    else{
                    time_diff=total-(value*60);
                    }
                    hours   = Math.floor(time_diff / 3600);
                    minutes = Math.floor((time_diff - (hours * 3600)) / 60);
                    seconds = time_diff - (hours * 3600) - (minutes * 60);

                    if (hours   < 10) {hours   = "0"+hours;}
                    if (minutes < 10) {minutes = "0"+minutes;}
                    if (seconds < 10) {seconds = "0"+seconds;}
                    localcheckin   = hours+':'+minutes+':'+seconds;
                    //for late 
                    office_stime= "08:00:00";
                    p = json_obj[i].att_date + " ";
                    late=new Date(new Date(p + localcheckin) - new Date(p + office_stime)).toUTCString().split(" ")[4];
                    
                    //for check out time
                    if(json_obj[i].checkout_time!==null ){
                        checkout = json_obj[i].checkout_time.split(" ");
                        out = checkout[1];
                        ds=out.split(":");
                        total=(ds[0]*3600)+(ds[1]*60)+(ds[2]*1);
                        
                        //changing utc time to current timezone
                        if (sign==='-'){
                          time_diff=total +(value*60);}
                        else{
                          time_diff=total-(value*60);
                        }
                        hours   = Math.floor(time_diff / 3600);
                        minutes = Math.floor((time_diff - (hours * 3600)) / 60);
                        seconds = time_diff - (hours * 3600) - (minutes * 60);

                    if (hours   < 10) {hours   = "0"+hours;}
                    if (minutes < 10) {minutes = "0"+minutes;}
                    if (seconds < 10) {seconds = "0"+seconds;}
                    
                    
                    localcheckout  = hours+':'+minutes+':'+seconds;
                        if(checkout[1]>checkin[1]){
                        workinghour=new Date(new Date(p + checkout[1]) - new Date(p + checkin[1])).toUTCString().split(" ")[4];
                        regularworkinghour = "08:00:00";
                            if (workinghour > regularworkinghour) {
                            overtime=new Date(new Date(p + workinghour) - new Date(p + regularworkinghour)).toUTCString().split(" ")[4];
                            }
                            else{
                                overtime="0";
                            }
                        }
                    }
                    else{
                       localcheckout="00:00:00";
                       workinghour="0";
                       overtime="0";
                    }
                    //Calculate Location
                    
                    var output = "<tr>"
                            + "<td>" + json_obj[i].att_date + "</td>"
                            + "<td>" + json_obj[i].full_name + "</td>"
                            + "<td>" + localcheckin+ " </td>"
                            + "<td style='color:red'>" + late + "</td>"
                            + "<td>" + localcheckout + "</td>"
                            + "<td>" + workinghour + "</td>"
                            + "<td>" +overtime+ "</td>"
                            + "<td>" + checkin_place+ "</td>"
                            + "</tr>";
                    
                    $("tbody").append(output); 
                    
                }
                
                //paginatior function    
                 Attendance.init();
              
               
            },
            error: function (d) {
                alert('error');
            } 
            
            });
        }
           }
   };
$(document).ready(function () { 
    Attendance.init();    
     $('.tags').click(function () {
        Attendance.autolist();
    });           
    
    $('#namesearch').click(function () {
        Attendance.todaylist();
    });           
    
     $('#sub').click(function () { 
         Attendance.monthlylist();
    });
    $('.tags').click(function () {
        Attendance.autolist();
    }); 
    
    
});

