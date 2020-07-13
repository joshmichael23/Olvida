<?php require_once('headerorig.php'); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
 <div class="row">
  <div class="bg-landpage col-sm-8">
      <div class="container">
      <h1 class="olvida-title" style="font-size:100px;">  Olvida  </h1>

      <h1 class="welcome"> Welcome! </h1>
      <h3 class="home-h3"> Register for an Olvida account here. </h3>

      <p class="p1 home-p3">OLVIDA, a web-based programming contest management system which utilizes PC^2. We're dedicated to helping you join the most 
          recent  </p>
      <p class="part1 home-p3">and up coming programming competitions created by your school or university with no hassle at all.</p>
      

      <a class="btn button btn-info btn-lg" href="<?php echo base_url('signup')?>"><span>REGISTER HERE</span></a>
      <p class="p2 home-p3"> or </p>
      <p class="p3 home-p3"> If you already have an account and is already approved by the admin, enter the code here.</p>

     
      <!-- Trigger the modal with a button -->
<a type="button" class="btn button btn-info btn-lg" data-toggle="modal" data-target="#myModal">Enter Code</a>


      
</div>
  </div>
  <div class="col-sm-4">

          <div class="text-center" style="margin-bottom:10px; ">
            <div class="login-box">
             
           
        
          
   
         
          
         
             <form autocomplete="off" name="login" method="post" action="<?php echo site_url(); ?>Login/process" accept-charset="utf-8" data-parsley-validate=""> 
             <h4 class="mt-0 font-alt login">Welcome to Olvida</h4>
              <hr>
            <?php if($this->session->flashdata('error')): ?>
            <?php echo '<span style="color:red">'?> <?php echo $this->session->flashdata('error'); ?> <?php echo '</span>'?>
            <?php endif; ?>
            <?php if($this->session->flashdata('success')):?>

              <?php '<span style="color:green">' ?> <?php echo $this->session->flashdata('success'); ?> <?php echo '</span>'?>

            <?php endif;?>
                <div class="form-stack has-icon pull-left">
                   <div class="textbox">
                   <i class="fa fa-user"></i>
                  <label class="username">Username</label>
                  <input autocomplete="off" name="username" type="text" class="form-control input-lg" style="width: 315px;" placeholder="Username"  data-parsley-required>
                 </div>
                </div>

                <div class="form-stack has-icon pull-left">

                  <div class="textbox">
                  <i class="fa fa-lock"></i>
                  <label class="password"> Password </label>
                  <input autocomplete="off" name="password" type="password" class="form-control input-lg" style="width: 315px; margin-bottom:20px;" placeholder="Password" data-parsley-required>
                 </div>
                </div>

            
             <br>
                  
                  
                  
            
            
                         
            <br>
             
                <button type="submit" class="btn btn-block btn-login btn-primary"><span class="semibold">Sign In</span></button>
              
            </div>
                      </div>
          </form>
        <hr>
      

  </div>
</div>







</body>
<script>
  function hideMessage() {
    document.getElementById("connectMsg").style.display = "none";
};
setTimeout(hideMessage, 5000);
</script>
</html>
