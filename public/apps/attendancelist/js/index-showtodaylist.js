/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @GEOprocess()
 * @get @lat @lng
 */
var pager = new Paging.Pager();   //for pagination

/*
 * show today list by return json array
 * @author David
 */
var todaylist = function (link,n){
    
        var url;
        if(1 == n){
        var name = document.getElementById('namelist').value;
        url = baseUri + 'attendancelist/index/'+link+'?namelist='+name;
            }
        else{
        url = baseUri + 'attendancelist/index/'+link;
        }
        $.ajax({
        url: url ,
        type: 'GET',
        success: function (d) {   
            var json_obj = $.parseJSON(d);//parse JSON            
            $('tbody').empty();
            for (var i in json_obj)
            {   
               
                 a = "08:00:00";
                //b=json_obj[i].checkin_time;
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
                  if (sign=='-'){
                  tt=total +(value*60);}
                  else{
                      tt=total-(value*60);
                  }
                  hours   = Math.floor(tt / 3600);
                 minutes = Math.floor((tt - (hours * 3600)) / 60);
                 seconds = tt - (hours * 3600) - (minutes * 60);

                if (hours   < 10) {hours   = "0"+hours;}
                if (minutes < 10) {minutes = "0"+minutes;}
                if (seconds < 10) {seconds = "0"+seconds;}
                 localcin   = hours+':'+minutes+':'+seconds;
                //for late 
               office_stime= "08:00:00";
               p = json_obj[i].att_date + " ";
//                late = new Date(new Date(p + b) - new Date(p + a)).toUTCString().split(" ")[4];
                  late=new Date(new Date(p + localcin) - new Date(p + office_stime)).toUTCString().split(" ")[4];

                //for check out time
                checkout = json_obj[i].checkout_time.split(" ");
                 out = checkout[1];
                 if(out!="00:00:00" ){
                  ds=out.split(":");
                  total=(ds[0]*3600)+(ds[1]*60)+(ds[2]*1);
                  if (sign=='-'){
                  tt=total +(value*60);}
                  else{
                      tt=total-(value*60);
                  }
                  hours   = Math.floor(tt / 3600);
                 minutes = Math.floor((tt - (hours * 3600)) / 60);
                 seconds = tt - (hours * 3600) - (minutes * 60);

                if (hours   < 10) {hours   = "0"+hours;}
                if (minutes < 10) {minutes = "0"+minutes;}
                if (seconds < 10) {seconds = "0"+seconds;}
                 localcout   = hours+':'+minutes+':'+seconds;}
             else{
                 localcout="00:00:00";
             }
               
                //for working hours
                if(checkout[1]>checkin[1]){
                workinghour=new Date(new Date(p + checkout[1]) - new Date(p + checkin[1])).toUTCString().split(" ")[4];}
                else{
                    workinghour="0";
                }

                //Calcute overtime time
                wh = "08:00:00";
                
                if (workinghour > wh) {
                    overtime=new Date(new Date(p + workinghour) - new Date(p + wh)).toUTCString().split(" ")[4];
                            
                }
                else{
                    overtime="0";
                }
                //Calculate Location
                 ll = json_obj[i].location;
               
                
               
                var output = "<tr>"
                        + "<td>" + json_obj[i].att_date + "</td>"
                        + "<td>" + json_obj[i].member_login_name + "</td>"
                        + "<td>" + localcin+ "</td>"
                        + "<td>" + late + "</td>"
                        + "<td>" + localcout + "</td>"
                        + "<td>" + workinghour + "</td>"
                        + "<td>" +overtime+ "</td>"
                        + "<td>" + ll+ "</td>"
                        + "</tr>"
                $("tbody").append(output);                
            }
            //paginatior function
            pager.perpage =3;            
            pager.para = $('tbody > tr');
            pager.showPage(1);   
            //pager.showNavi(1);
        },
        error: function (d) {
            alert('error');
        }       
    });                 
};
$(document).ready(function () { 

    // ユーザーのクリックした時の動作。    

   
    //monthlylist
   
//   if($('section').is('#showtodaylist')){
//       todaylist($('.content-header').attr('id'),0);
//   }
//    $('#namesearch').click(function () {        
//        todaylist($('.content-header').attr('id'),1);
//    });           
});


