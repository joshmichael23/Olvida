<style>


body{
  margin: 0;
  padding:0;

}
.login-box{
  width:280px;
}
.textbox{
  
  padding: 8px 0;
  margin: 8px 0;
  }
  .textbox input{
    width:320px;
    margin-bottom:20px;
    height:40px;
  }

.btn{
  width:320px;
  border:2px 
  padding:5px;
  font-size:18px;
  cursor:pointer;
  margin-top:10px;
}
</style>
<body>
  <section id="main" role="main">
    <section class="container">
      
        
          <div class="text-center" style="margin-bottom:10px; ">
           
        <div class="login-box">
          
        

          <?php echo '<center><span style="color:red">'?> <?php echo $this->session->flashdata('error_msg'); ?> <?php echo '</span></center>'?>

             <form method="post" action="<?php echo base_url('registration/register_user')?>"accept-charset="utf-8"> 
              <h2 class="text-muted mt-0 font-alt">Director Registration</h2>
                <hr>
               <div class="textbox">                   
                <div class="form-stack has-icon pull-left">
                  <label>First Name</label>
                  <input name="firstname" type="text" class="form-control input-lg" placeholder="First Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your username" value='<?php echo $this->session->flashdata('firstname'); ?>'>
                 </div>
                </div>
                 <div class="textbox">
                   <div class="form-stack has-icon pull-left">
                  <label>Middle Name</label>
                  <input name="middlename" type="text" class="form-control input-lg" placeholder="Middle Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your username" data-parsley-required value='<?php echo $this->session->flashdata('middlename'); ?>'>
                 </div>
                </div>
                 <div class="textbox">
                   <div class="form-stack has-icon pull-left">
                  <label>Last Name</label>
                  <input name="lastname" type="text" class="form-control input-lg" placeholder="Last Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your username" data-parsley-required value='<?php echo $this->session->flashdata('lastname'); ?>'>
                 </div>
                </div>
                 <div class="textbox">
                   <div class="form-stack has-icon pull-left">
                  <label>Contact Number</label>
                  <input name="contactno" type="text" class="form-control input-lg" placeholder="Contact Number" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your username" data-parsley-required value='<?php echo $this->session->flashdata('contactno'); ?>'>
                 </div>
                </div>
                 <div class="textbox">
                   <div class="form-stack has-icon pull-left">
                  <label>Email</label>
                  <input name="email" type="text" class="form-control input-lg" placeholder="Email" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your username" data-parsley-required value='<?php echo $this->session->flashdata('email'); ?>'>
                 </div>
                </div>
                 <div class="textbox">
                <div class="form-stack has-icon pull-left">
                  <label>Username</label>
                  <input name="username" type="text" class="form-control input-lg" placeholder="Username" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your username" data-parsley-required>
                 </div>
                </div>
                 <div class="textbox">
                <div class="form-stack has-icon pull-left">
                  <label>Password </label>
                  <input name="password" type="password" class="form-control input-lg" placeholder="Password" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your password" data-parsley-required>
                 </div>
                </div>
                   <div class="textbox">
                <div class="form-stack has-icon pull-left">
                  <label>Confirm Password </label>
                  <input name="password1" type="password" class="form-control input-lg" placeholder="Password" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your password" data-parsley-required>
                 </div>
                </div>
              
             
         
                

                <button type="submit" class="btn btn-block btn-primary" href="$">Register</button>


                  </form>
                  
                   <form method="post" action="<?php echo base_url('login')?>"accept-charset="utf-8"> 
                  
                <button class="btn btn-block btn-danger" onclick="<?php echo base_url('aw')?>">Cancel</button>
             </form>
             <hr> 
           
          </div>
       </div>
    
       
     
    </section>
  </section>