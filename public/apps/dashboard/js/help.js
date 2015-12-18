$(document).ready(function(){
            //show and hide for dashboard 
            $("#dashboard").click(function(){ 
                 $("#attlistsmenu,#managemenu,#leavemenu,#salarymenu,#documentmenu,#calendermenu").hide();
                var parent=$(this).parent();
	$("#dashboardmenu",parent).slideToggle("fast");
                $(this).toggleClass("up");
//                $("#maindashboard").css("background","gray");
//                $("#maindashboard").css("color","white");               
            });
             //show and hide for attendance lists  
            $("#attlists").click(function(){   
                $("#dashboardmenu,#managemenu,#leavemenu,#salarymenu,#documentmenu,#calendermenu").hide();
                var parent=$(this).parent();
	$("#attlistsmenu",parent).slideToggle("fast");
                $(this).toggleClass("up");
//                $("#mainattlists").css("background","gray");
//                $("#mainattlists").css("color","white");               
            });
             //show and hide for manage user lists  
            $("#manage").click(function(){   
                $("#dashboardmenu,#attlistsmenu,#leavemenu,#salarymenu,#documentmenu,#calendermenu").hide();
                var parent=$(this).parent();
	$("#managemenu",parent).slideToggle("fast");
                $(this).toggleClass("up");             
            });
            //show and hide for leave days
            $("#leave").click(function(){   
                $("#dashboardmenu#attlistsmenu,#managemenu,#salarymenu,#documentmenu,#calendermenu").hide();
                var parent=$(this).parent();
	$("#leavemenu",parent).slideToggle("fast");
                $(this).toggleClass("up");             
            });
             //show and hide for calender
            $("#calender").click(function(){   
                $("#dashboardmenu,#attlistsmenu,#managemenu,#leavemenu,#salarymenu,#documentmenu").hide();
                var parent=$(this).parent();
	$("#calendermenu",parent).slideToggle("fast");
                $(this).toggleClass("up");             
            });
            //show and hide for salary
            $("#salary").click(function(){   
                $("#dashboardmenu,#attlistsmenu,#managemenu,#leavemenu,#documentmenu,#calendermenu").hide();
                var parent=$(this).parent();
	$("#salarymenu",parent).slideToggle("fast");
                $(this).toggleClass("up");             
            });
             //show and hide for document
            $("#document").click(function(){   
                $("#dashboardmenu,#attlistsmenu,#managemenu,#leavemenu,#salarymenu,#calendermenu").hide();
                var parent=$(this).parent();
	$("#documentmenu",parent).slideToggle("fast");
                $(this).toggleClass("up");             
            });
            /*Start For Dashboard*/
                                    //show and hide for staffs attended link (dashboard)
                                    $("#showatt").click(function(){ 
                                         $("#showabsentmenu,#showmanagemenu,#showattlistsmenu,#showleavemenu,#showsalarymenu,#showcheckmenu,#shownewsmenu,#showmembersmenu").hide();
                                        
                                      var parent=$(this).parent();
                                             $("#showattmenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                     //show and hide for staffs absent  link (dashboard)
                                    $("#showabsent").click(function(){ 
                                         $("#showattmenu,#showmanagemenu,#showattlistsmenu,#showleavemenu,#showsalarymenu,#showcheckmenu,#shownewsmenu,#showmembersmenu").hide();
                                        var parent=$(this).parent();
                                             $("#showabsentmenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                      //show and hide for manage user link (dashboard)
                                    $("#showmanage").click(function(){ 
                                            $("#showattmenu,#showabsentmenu,#showattlistsmenu,#showleavemenu,#showsalarymenu,#showcheckmenu,#shownewsmenu,#showmembersmenu").hide();
                                         var parent=$(this).parent();
                                             $("#showmanagemenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                       //show and hide for attendance lists link (dashboard)
                                    $("#showattlists").click(function(){ 
                                            $("#showattmenu,#showabsentmenu,#showmanagemenu,#showleavemenu,#showsalarymenu,#showcheckmenu,#shownewsmenu,#showmembersmenu").hide();
                                        var parent=$(this).parent();
                                             $("#showattlistsmenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                         //show and hide for leave days link (dashboard)
                                    $("#showleave").click(function(){ 
                                            $("#showattmenu,#showabsentmenu,#showmanagemenu,#showattlistsmenu,#showsalarymenu,#showcheckmenu,#shownewsmenu,#showmembersmenu").hide();
                                        var parent=$(this).parent();
                                             $("#showleavemenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                           //show and hide for Salary Lists link (dashboard)
                                    $("#showsalary").click(function(){ 
                                            $("#showattmenu,#showabsentmenu,#showmanagemenu,#showattlistsmenu,#showleavemenu,#showcheckmenu,#shownewsmenu,#showmembersmenu").hide();
                                         var parent=$(this).parent();
                                             $("#showsalarymenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                              //show and hide for Check In / Out link (dashboard)
                                    $("#showcheck").click(function(){ 
                                            $("#showattmenu,#showabsentmenu,#showmanagemenu,#showattlistsmenu,#showleavemenu,#showsalarymenu,#shownewsmenu,#showmembersmenu").hide();
                                           var parent=$(this).parent();
                                             $("#showcheckmenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                                //show and hide for Latest News link (dashboard)
                                    $("#shownews").click(function(){ 
                                            $("#showattmenu,#showabsentmenu,#showmanagemenu,#showattlistsmenu,#showleavemenu,#showsalarymenu,#showcheckmenu,#showmembersmenu").hide();
                                          var parent=$(this).parent();
                                             $("#shownewsmenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                                  //show and hide for Latest Members link (dashboard)
                                    $("#showmembers").click(function(){ 
                                            $("#showattmenu,#showabsentmenu,#showmanagemenu,#showattlistsmenu,#showleavemenu,#showsalarymenu,#showcheckmenu,#shownewsmenu").hide();
                                             var parent=$(this).parent();
                                             $("#showmembersmenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                /*End For Dashboard*/
                
                /*Start For Attendance Lists*/
                                   //show and hide for Today Attendance Link (attendance lists)
                                    $("#showtoday").click(function(){ 
                                            $("#showmonthlymenu").hide();                                            
                                            var parent=$(this).parent();
                                             $("#showtodaymenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                       //show and hide for Monthly Attendance link (attendance lists)
                                    $("#showmonthly").click(function(){ 
                                            $("#showtodaymenu").hide();                                            
                                            var parent=$(this).parent();
                                             $("#showmonthlymenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                /*End For Attendance Lists*/
                
                /*Start For Manage Users*/
                                   //show and hide for Manage Users Link (Manage Users)
                                    $("#showmanageuser").click(function(){ 
                                            $("#showmonthlymenu").hide();                                            
                                            var parent=$(this).parent();
                                             $("#showmanageusermenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                     
                /*End For Manage Users*/
                
                 /*Start For Leave Days*/
                                   //show and hide for Leave Lists Link (Lave Days)
                                    $("#showleavelists").click(function(){ 
                                            $("#showapplyleavelistsmenu,#showleavesettingmenu").hide();  
                                            var parent=$(this).parent();
                                             $("#showleavelistsmenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                       //show and hide for Apply Leave Link (Lave Days)
                                    $("#showapplyleavelists").click(function(){ 
                                            $("#showleavelistsmenu,#showleavesettingmenu").hide(); 
                                            var parent=$(this).parent();
                                             $("#showapplyleavelistsmenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                        //show and hide for  Leave Setting Link (Lave Days)
                                    $("#showleavesetting").click(function(){ 
                                            $("#showleavelistsmenu,#showapplyleavelistsmenu").hide(); 
                                            var parent=$(this).parent();
                                             $("#showleavesettingmenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                     
                /*End For Leave Days*/
                
                  /*Start For Salary*/
                                   //show and hide for Add Salary Link (Salary)
                                    $("#showaddsalary").click(function(){ 
                                            $("#showsalarylistsmenu,#showmonthlysalarylistsmenu,#showsalarysettingmenu,#showallowancemenu").hide();  
                                            var parent=$(this).parent();
                                             $("#showaddsalarymenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                       //show and hide for Salary  Lists Link (Salary)
                                    $("#showsalarylists").click(function(){ 
                                            $("#showaddsalarymenu,#showmonthlysalarylistsmenu,#showsalarysettingmenu,#showallowancemenu").hide();  
                                            var parent=$(this).parent();
                                             $("#showsalarylistsmenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                         //show and hide for Monthly Salary Lists Link (Salary)
                                    $("#showmonthlysalarylists").click(function(){ 
                                            $("#showaddsalarymenu,#showsalarylistsmenu,#showsalarysettingmenu,#showallowancemenu").hide();  
                                            var parent=$(this).parent();
                                             $("#showmonthlysalarylistsmenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                          //show and hide for  Salary Setting Lists Link (Salary)
                                    $("#showsalarysetting").click(function(){ 
                                            $("#showaddsalarymenu,#showsalarylistsmenu,#showmonthlysalarylistsmenu,#showallowancemenu").hide();  
                                            var parent=$(this).parent();
                                             $("#showsalarysettingmenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                            //show and hide for  Allowance Link (Salary)
                                    $("#showallowance").click(function(){ 
                                            $("#showaddsalarymenu,#showsalarylistsmenu,#showmonthlysalarylistsmenu,#showsalarysettingmenu").hide();  
                                            var parent=$(this).parent();
                                             $("#showallowancemenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                     
                /*End For Salary*/
                
                  /*Start For Document*/
                                   //show and hide for Letterhead Link (Document)
                                    $("#showletter").click(function(){ 
                                            $("#showssbmenu,#showtaxmenu").hide();  
                                            var parent=$(this).parent();
                                             $("#showlettermenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                       //show and hide for SSB Document Link (Document)
                                    $("#showssb").click(function(){ 
                                            $("#showlettermenu,#showtaxmenu").hide(); 
                                            var parent=$(this).parent();
                                             $("#showssbmenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                        //show and hide for Text Document Link (Document)
                                    $("#showtax").click(function(){ 
                                            $("#showlettermenu,#showssbmenu").hide(); 
                                            var parent=$(this).parent();
                                             $("#showtaxmenu",parent).slideToggle("fast");
                                             $(this).toggleClass("up");             
                                      });
                                     
                /*End For Document*/
   });
