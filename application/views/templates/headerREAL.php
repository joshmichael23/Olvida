<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Olvida</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/";?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/";?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/";?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/";?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/";?>dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/";?>bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/";?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/";?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/";?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/";?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Datatables -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/";?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url()."assets/";?>css/style.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?php echo base_url()."assets/";?>https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="<?php echo base_url()."assets/";?>https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php require_once('navbarDirector.php');?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
<!--       <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url()."assets/";?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('whole_name') ?></p>
    
        </div>
      </div>
      <!-- search  -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li class="header">MAIN NAVIGATION</li>

        <?php if($this->session->userdata('header') == 'competitions'){ ?>
        <li class="treeview active">
      <?php }else{?>
        <li class="treeview">
      <?php }?>

          <a href="#">
            <i class="fa fa-th"></i></i> <span>Competitions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          

          <?php if($this->session->userdata('sublevel')=='AllCompetitions'){ ?>
              <li class="active"><a href="<?php echo base_url();?>competitions/index"><i class="fa fa-th"></i>All Competitions</a></li>
          <?php }else{?>
              <li><a href="<?php echo base_url();?>competitions/index"><i class="fa fa-th"></i>All Competitions</a></li>          
          <?php }?>

          <?php $CI =& get_instance(); ?>
        <?php $CI->load->model('compANDcatModel'); ?>
        <?php $result2 = $CI->compANDcatModel->countPendingInAllComp($this->session->userdata('id')); ?>
        <?php $result3 = $CI->compANDcatModel->countPendingInCompNotSentEmail($this->session->userdata('id')); ?>

        <?php if($result2 != false):?>


              <?php if($this->session->userdata('sublevel')=='PendingRequests'){ ?>
                  <li class="active"><a href="<?php echo base_url();?>competitions/pendingrequests"><i class="fa fa-files-o"></i>
              <?php }else{?>
                  <li><a href="<?php echo base_url();?>competitions/pendingrequests"><i class="fa fa-files-o"></i>
              <?php }?>
                <span>Pending Requests</span>
                <span class="pull-right-container">
                    
                    <?php
                    date_default_timezone_set('Asia/Manila');
                    ?>

                    <?php if($result3 == 0): ?>
                      <span class="label label-primary pull-right"></span>
                  <?php else: ?>
                      <span class="label label-primary pull-right">
                          <?php if( date('F j, Y g:i:a  ') ): ?> <!-- check date pag lampas na dai na pag i echo -->
                            <?php echo $result3; ?>
                          <?php endif; ?>
                      </span>
                  <?php endif; ?>

                </span>
                  </a>
              </li>

        <?php else: ?>
              <li><a disabled"><i class="fa fa-files-o"></i>
                <span>Pending Requests</span>
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">0</span>
                </span>
                  </a>
              </li>
        <?php endif; ?> 
          <?php if($this->session->userdata('sublevel')=='CheckAttendance'){ ?>
              <li class="active"><a href="<?php echo base_url();?>competitions/chooseAttendance"><i class="fa fa-edit"></i>Check Attendance</a></li>
          <?php }else{?>
              <li><a href="<?php echo base_url();?>competitions/chooseAttendance"><i class="fa fa-edit"></i>Check Attendance</a></li>
          <?php }?>
           

          <?php if($this->session->userdata('sublevel')=='UploadScoreboard'){ ?>
  
         
  <li class="active"><a href="<?php echo base_url();?>Committies/viewCompScoreboard"><i class="fa fa-upload"></i>Upload Scoreboard</a></li>
<?php }else{?>
<li><a href="<?php echo base_url();?>Committies/viewCompScoreboard"><i class="fa fa-upload"></i>Upload Scoreboard</a></li>
<?php }?>
            

                                                <?php if($this->session->userdata('sublevel')=='generateCertificate'){ ?>

             <li class="active"><a href="<?php echo base_url();?>competitions/generateCertificate"><i class="fa fa-book"></i><span>Generate Certificate</span></a></li>
               <?php }else{?>
                            <li><a href="<?php echo base_url();?>competitions/generateCertificate"><i class="fa fa-book"></i><span>Generate Certificate</span></a></li>
           <?php }?>

           
 <?php if($this->session->userdata('sublevel')=='Feedbacks'){ ?>


<li class="active"><a href="<?php echo base_url();?>Feedbacks/viewCompFeedback"><i class="fa fa-edit"></i><span>Feedbacks</span></a></li>
       <?php }else{?>
       <li><a href="<?php echo base_url();?>Feedbacks/viewCompFeedback"><i class="fa fa-edit"></i><span>Feedbacks</span></a></li>
                     <?php }?>
          </ul>
        </li>

       



                    <?php if($this->session->userdata('header') == 'Teams'){ ?>
                           <li class="active"><a href="<?php echo base_url();?>All_teams/index"><i class="fa fa-group"></i><span>Teams</span></a></li>
      <?php }else{?>
             <li><a href="<?php echo base_url();?>All_teams/index"><i class="fa fa-group"></i><span>Teams</span></a></li>
      <?php }?>

        

             <?php if($this->session->userdata('header') == 'Committees'){ ?>
             <li class="active"><a href="<?php echo base_url();?>committies/index"><i class="fa fa-group"></i><span>Committees</span></a></li>
      <?php }else{?>
      <li><a href="<?php echo base_url();?>committies/index"><i class="fa fa-group"></i><span>Committees</span></a></li>
      <?php }?>

       
         

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section> -->

    <!-- Main content -->
   
  <!-- /.content-wrapper -->
  

  <!-- Control Sidebar -->

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url()."assets/";?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url()."assets/";?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()."assets/";?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url()."assets/";?>bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url()."assets/";?>bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url()."assets/";?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url()."assets/";?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url()."assets/";?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url()."assets/";?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url()."assets/";?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url()."assets/";?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url()."assets/";?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url()."assets/";?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url()."assets/";?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()."assets/";?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()."assets/";?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url()."assets/";?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()."assets/";?>dist/js/demo.js"></script>

<!-- Datatables -->
<script src="<?php echo base_url()."assets/";?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()."assets/";?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


</body>
</html>
