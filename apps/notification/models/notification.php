
<ul class="dropdown-menu">
                                    <li class="header">You have <i><b style="color:red;font-size: 20px;"><?php echo count($noti);?></b></i> <b>notifications</b></li>
                                       <?php foreach ($noti as $noti) {?>
                                    <li >
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li>
                                                <?php if($this->session->permission_code=="ADMIN"){?>
                                                <a href="#" onclick="return false;" class="adminnotidetail" id="<?php echo  $noti['member_id']; echo","; echo $noti['start_date'];?>">
                                                <!--<img src="../../common/img/notid.png"> -->
                                                 <img src="../../common/img/notid.png"> 
                                                <!--#4682B4-->
                                                <b><i style="color:red"><?php echo $noti['member_login_name'];?></i></b> apply  leave for <?php echo "<b>".date("d-m-Y", strtotime( $noti['start_date']))."</b>";}
                                                    else {?>
                                                <a href="#" onclick="return false;" class="usernotidetail" id="<?php echo  $noti['member_id']; echo","; echo $noti['start_date'];?>">
                                                    <img src="../../common/img/notid.png"> <b>admin</b><?php 
                            switch($noti['leave_status']){
                            
                            case "1" : echo " Confirmed";break;
                            case "2" : echo " Rejected";break;
                               
                        }?> <?php echo "<b>".date("d-m-Y", strtotime( $noti['start_date']))."</b>";}?>
                                                                                         
                                                </a>
                                            </li>
                                           
                                        </ul>
                                </li><?php } ?>
                                    <li class="footer"><a href="../../notification/index/viewall"><b>View All</b></a></li>
                                </ul>