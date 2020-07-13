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

ul {
  list-style-type: none;
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
      
        

        <div class="login-box">
          
        

          <!-- </?php echo '<center><span style="color:red">'?> </?php echo $this->session->flashdata('error_msg'); ?> </?php echo '</span></center>'?> -->

             <form method="post" action="<?php echo base_url('registration/register_user')?>" accept-charset="utf-8" > 
              <center>
              <h2 class="text-muted mt-0 font-alt">Director Registration</h2>
            </center>
            <?php echo validation_errors('<div class="alert alert-danger">','</div>');?>
                <hr>
                
               <div class="textbox">                   
                <div class="form-stack has-icon pull-left">
                  <label for="firstname">First Name *:</label>
                  <input name="firstname" type="text" class="form-control input-lg" value="<?php echo set_value('firstname'); ?>" placeholder="First Name" >
                 </div>
                </div>
                 <div class="textbox">
                   <div class="form-stack has-icon pull-left">
                  <label>Middle Name *:</label>
                  <input name="middlename" type="text" class="form-control input-lg" value="<?php echo set_value('middlename'); ?>" placeholder="Middle Name" >
                 </div>
                </div>
                 <div class="textbox">
                   <div class="form-stack has-icon pull-left">
                  <label>Last Name *:</label>
                  <input name="lastname" type="text" class="form-control input-lg"  value="<?php echo set_value('lastname'); ?>" placeholder="Last Name" >
                 </div>
                </div>
                 <div class="textbox">
                   <div class="form-stack has-icon pull-left">
                  <label>Contact Number *:</label>
                  <input name="contactno" type="text" class="form-control input-lg" value="<?php echo set_value('contactno'); ?>"placeholder="Contact Number" >
                 </div>
                </div>
                 <div class="textbox">
                   <div class="form-stack has-icon pull-left">
                  <label>Email *:</label>
                  <input name="email" type="email"  class="form-control input-lg"value="<?php echo set_value('email'); ?>" placeholder="Email" >
                 </div>
                </div>
                 <div class="textbox">
                <div class="form-stack has-icon pull-left">
                  <label>Username *:</label>
                  <input name="username" type="text" class="form-control input-lg"value="<?php echo set_value('username'); ?>" placeholder="Username" >
                 </div>
                </div>
                 <div class="textbox">
                <div class="form-stack has-icon pull-left">
                  <label>Password *:</label>
                  <input name="password" type="password" class="form-control input-lg" value="<?php echo set_value('password'); ?>"placeholder="Password" >
                 </div>
                </div>
                   <div class="textbox">
                <div class="form-stack has-icon pull-left">
                  <label>Confirm Password *:</label>
                  <input name="password1" type="password" class="form-control input-lg" value="<?php echo set_value('password1'); ?>"placeholder="Confirm Password" >
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

  <!-- <script type="text/javascript">
$(document).ready(function() {
  $("form[name=myForm]").parsley();
window.Parsley.addValidator('lastname', {
  validateString: function(value) {
    var patt = new RegExp("^[a-zA-Z\s]+$");
    return patt.test(value);
  },
  messages: {
    en: '<div style="color:red">Please input an appropriate last name</div>'
  
}});

window.Parsley.addValidator('firstname', {
  validateString: function(value) {
    var patt = new RegExp("^[a-zA-Z\s]+$");
    return patt.test(value);
  },
  messages: {
    en: '<div style="color:red">Please input an appropriate first name</div>'
  
}});

window.Parsley.addValidator('middlename', {
  validateString: function(value) {
    var patt = new RegExp("^[a-zA-Z\s]+$");
    return patt.test(value);
  },
  messages: {
    en: '<div style="color:red">Please input an appropriate middle name</div>'
  
}});
});
</script> -->