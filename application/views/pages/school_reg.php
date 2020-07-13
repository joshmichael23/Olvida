<style>


body{
  margin: 0;
  padding:0;

}

ul {
  list-style-type: none;
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
</style>
<body>
  <section id="main" role="main">
    <section class="container">
      
        
          <div style="margin-bottom:10px; ">
            
          <div class="login-box">
          
        

          <!-- </?php echo '<center><span style="color:red">'?> </?php echo $this->session->flashdata('error_msg'); ?> </?php echo '</span></center>'?> -->

             <form method="post" action="<?php echo base_url('registration/register_school')?>" accept-charset="utf-8" data-parsley-validate=""> 
              <div class="text-center">
            <h2 class="text-muted mt-0 font-alt">School Registration</h2>
          </div>
          <?php echo validation_errors('<div class="alert alert-danger">','</div>');?>
              <hr>
              <div class="textbox">   
                   <div class="form-stack has-icon pull-left">
                  <label>School Name *:</label>
                  <input name="school_name" type="text" class="form-control input-lg" value="<?php echo set_value('school_name'); ?>"  placeholder="Name of School" >
                 </div>
                  </div>
                  <div class="textbox">   
                   <div class="form-stack has-icon pull-left">
                  <label>Address *:</label>
                  <input name="address" type="text" class="form-control input-lg"  value="<?php echo set_value('address'); ?>" placeholder="Address of School">
                </div>
                <div class="form-stack has-icon pull-left">
                  <label>Email *: </label>
                  <input name="email" type="email" class="form-control input-lg" value="<?php echo set_value('email'); ?>"placeholder="Email Address" >
                </div>   
                 <div class="textbox">   
                <div class="form-stack has-icon pull-left">
                  <label>Username</label>
                  <input name="user" type="text" class="form-control input-lg" value="<?php echo set_value('user'); ?>" placeholder="Username" >
                 
                </div>
              </div>
              <div class="textbox">   
                <div class="form-stack has-icon pull-left">
                  <label>Password *:</label>
                  <input name="pass" id="password" value="<?php echo set_value('pass'); ?>" type="password" class="form-control input-lg" placeholder="Password" >
                 </div>
                </div>
                   <div class="textbox">   
                <div class="form-stack has-icon pull-left">
                  <label>Confirm Password *:</label>
                  <input name="pass1" type="password" class="form-control input-lg" placeholder="Confirm Password" value="<?php echo set_value('pass1'); ?>" >
                 </div>
                <br>
                 
                 <!--
                </div>
                   <div class="form-stack has-icon pull-left">
                  <label>Email</label>
                  <input name="email" type="text" class="form-control input-lg" placeholder="Email" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your username" data-parsley-required>
                 
                </div>
                -->
                
                 
                </div>
              

         
                <br >
              

                <button type="submit" class="btn btn-block btn-primary" href="$">Register</button>


                  </form>
                  
                   <form method="post" action="<?php echo base_url('login')?>"accept-charset="utf-8"> 
                              <button class="btn btn-block btn-danger" onclick="<?php echo base_url('aw')?>">Cancel</button>
             </form>
             <hr> 
           
          
       </div>
      

    </section>
  </section>  


  <script type="text/javascript">
$(document).ready(function() {
  $("form[name=myForm]").parsley();
window.Parsley.addValidator('schoolname', {
  validateString: function(value) {
    var patt = new RegExp("^[a-zA-Z\s]+$");
    return patt.test(value);
  },
  messages: {
    en: '<div style="color:red">Please input an appropriate School Name</div>'
  
}});

});
</script>