$(document).ready(function(){
            //show and hide for dashboard 
            $(".tog").click(function(){ 
                // $("#attlistsmenu,#managemenu,#leavemenu,#salarymenu,#documentmenu,#calendermenu").hide();
                var parent=$(this).closest('li').find('.togshow');            
                $('.helpcenter li .togshow').not(parent).slideUp();  	
                 parent.slideToggle("fast");
                
//                $("#maindashboard").css("background","gray");
//                $("#maindashboard").css("color","white");               
            });
           $('.linkhover').hover(function(){
               $('.collapse-wrapper').animate({'background-color':'#aaaecf'},"slow");
               $(this).mouseleave(function(){
                   $('.collapse-wrapper').animate({'background-color':'#ecf0f5'},"fast");
               });
           });
   });
