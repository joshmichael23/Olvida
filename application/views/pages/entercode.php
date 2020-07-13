<style>


body{
  margin: 0;
  padding:0;

}
.login-box{
  width:280px;
}
.textbox{
  overflow: hidden;
  padding: 8px 0;
  margin: 8px 0;
  }
.btn{
  width:320px;
  border:2px 
  padding:5px;
  font-size:18px;
  cursor:pointer;
}
</style>
<body>

  <section id="main" role="main">
    <section class="container">
      
        <br />
        <br />
        <br />

          <div class="text-center" style="margin-bottom:10px; ">
            <div class="login-box">
             
           
        
          
   
         
          
         
             <form name="login" method="post" action="<?php echo site_url(); ?>Login/entercode" accept-charset="utf-8"> 
             <!-- <h4 class="text-muted mt-0 font-alt">Welcome to Olvida</h4> -->
              <hr>
            <?php echo '<span style="color:red">'?> <?php echo $this->session->flashdata('error'); ?> <?php echo '</span>'?>
             
                <div class="form-stack has-icon pull-left">
                   <div class="textbox">
                   <i class="fa fa-user"></i>
                  <label>Code</label>
                  <input name="code" type="text" class="form-control input-lg" style="width: 315px;" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your username" data-parsley-required>
                 </div>
                </div>

<!--             
             <br>
                  
                  <small>DON'T HAVE AN ACCOUNT YET? </small> <small><a href="<?php echo base_url('signup')?>">SIGN UP NOW!</a></small> <br>
                  
             -->
            
                         
            <br>
             
                <button type="submit" class="btn btn-block btn-primary"><span class="semibold">Enter Code</span></button>
              
            </div>
                      </div>
          </form>
        <hr>
      
      
    </section>
  </section>
