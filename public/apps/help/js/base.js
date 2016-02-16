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
           
//        <!-- for carousel indicator -->
            $('#myCarousel').bind('slid.bs.carousel', function () {                
                $holder = $( "ol li.btn-color" );
                $holder.removeClass('btn-color');
                var idx = $('div.active').index('div.item');
                $('ol.carousel-indicators li[data-slide-to="'+ idx+'"]').addClass('btn-color');                          
            });

            $('ol.carousel-indicators  li').on("click",function(){ 
                var inx = $(this).attr('data-slide-to');
                $activediv = $('#myCarousel div.active');
                $activediv.removeClass('active');
                $('#myCarousel div.l'+inx).addClass('active');
                $('ol.carousel-indicators li.btn-color').removeClass("btn-color");
                $(this).addClass("btn-color");
            });
   });
