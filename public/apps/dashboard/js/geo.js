
$(document).ready(function(){           
            if (navigator.geolocation) {                
                navigator.geolocation.getCurrentPosition(GEOprocess);
            } 
 });