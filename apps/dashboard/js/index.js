
 function GetOffset(position) {
               //GET geo location of user
               var url="location_session";
               var n = new Date();
               var offset = n.getTimezoneOffset(); 
                $.ajax({
                    url: url +"&offset=" + offset,
                    type: 'GET',
                    dataType: 'json',
                    success:function(d){
                        
                    }
                });
            }
$(document).ready(function(){           
            if (navigator.geolocation) {                
                navigator.geolocation.getCurrentPosition(GEOprocess);
            } 
 });

