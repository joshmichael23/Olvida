<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url()?>login/index" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>O</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>O</b>lvida</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          

          <!-- NOTIFICATIONS GO HERE -->
           <?php 


               $CI =& get_instance();
               $CI->load->model('Connect_Db');
               $id = $this->session->userdata('id');
               $status = $this->session->userdata('status');
               $count = $CI->Connect_Db->countNotificationsDirector($id); 
            ?>


         <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>

              <?php if($count>0){ ?>
              <span class="label label-warning">
                    <?php echo $count; ?>
                      
              </span>
              <?php }?>
            </a>


            <ul class="dropdown-menu">
              <li>
                <ul class="menu">
             

              <?php 

              $notifications = $CI->Connect_Db->getNotificationDirector($id);

              if($notifications){

               foreach($notifications->result_array() as $notif){

                  echo "<li>";
                  echo "<a href='" . base_url() . 'Notifications/view/' . $id . '/' . $status . "'>";
                      if($notif['status']==0)
                        echo "<i><small class='label bg-green'>New</small></i>" . '  ' . $notif['subject'];
                      else
                        echo "<i></i>" . $notif['subject'];
                    echo "</a>";
                  echo "</li>";
               }
              }
              else{
                  echo "<li>";
                  echo "<a><i></i>No Notifications</a>";
                  echo "</li>";
              }



              ?>


                </ul>
                  
              </li>
            </ul>
          </li>


         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- <img src="<?php echo base_url()."assets/";?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
              <span class="hidden-xs"><?php $users = $this->session->userdata('user'); echo $users;?> </span>
            </a>

            <ul class="dropdown-menu" style="width: 15px">
              <!-- User image -->
<!--               <li class="user-header">
                <img src="<?php echo base_url()."assets/";?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata('whole_name') ?>
                </p> -->
              
              <!-- Menu Footer-->
                <li class="user-footer" >
<!--                 <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div> -->
                <div class="pull-right">
                  <a href="<?php echo base_url();?>Login/logout" class="btn btn-default btn-block ">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
<!--           <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>