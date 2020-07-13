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

ul {
  list-style-type: none;
}


input.parsley-error {
    border: 1px solid red;
}
.parsley-errors-list li.parsley-required {
    background: white;
    padding: 10px;
    color: red;
}

li.data-parsley-error-message{
    padding: 10px;
    color: red;
}

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
             
                
   
         
          
         
             <form autocomplete="off" name="login" method="post" action="<?php echo site_url(); ?>Login/process" accept-charset="utf-8" data-parsley-validate=""> 
             <h4 class="text-muted mt-0 font-alt">Welcome to Olvidaaa</h4>
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
                  <label>Username</label>
                  <input autocomplete="off" name="username" type="text" class="form-control input-lg" style="width: 315px;" placeholder="Username"  data-parsley-required>
                 </div>
                </div>

                <div class="form-stack has-icon pull-left">

                  <div class="textbox">
                  <i class="fa fa-lock"></i>
                  <label> Password </label>
                  <input autocomplete="off" name="password" type="password" class="form-control input-lg" style="width: 315px; margin-bottom:20px;" placeholder="Password" data-parsley-required>
                 </div>
                </div>

            
             <br>
                  
                  <small>DON'T HAVE AN ACCOUNT YET? </small> <small><a href="<?php echo base_url('signup')?>">SIGN UP NOW!</a></small> <br>
                  
            
            
                         
            <br>
             
                <button type="submit" class="btn btn-block btn-primary"><span class="semibold">Sign In</span></button>
              
            </div>
                      </div>
          </form>
        <hr>
      
      
    </section>
  </section>

<script>
  function hideMessage() {
    document.getElementById("connectMsg").style.display = "none";
};
setTimeout(hideMessage, 5000);
</script>