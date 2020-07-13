<style>

.column {
    float: left;
    width: 50%;
    margin-bottom:20px;
    /* Should be removed. Only for demonstration */
}

#tcol{
    float: left;
    width: 33.33%;
    padding:8px;

}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

.btn{
  width:600px;
}


</style>
<script>
  function myFunction() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }

}
  </script>
<body>
  <section id="main" role="main">
    <section class="container">
      
        
          <div class="text-left" style="margin-bottom:10px; ">
            
        
          
          
             <form method="post" action="<?php echo base_url('team_registration/team_name')?>" accept-charset="utf-8" name="form1"> 
              <?php
              if($this->uri->segment(2) == "inserted")
              {
                echo '<p class="text-success">Data Inserted </p>';
              }
              ?>

              <?php echo '<center><span style="color:red">'?> <?php echo $this->session->flashdata('error_msg'); ?> <?php echo '</span></center>'?>
<hr>
            <div class="container">
                 <div class="row" style="margin-bottom:20px">
            <h1>Team Registration</h1>
         
             <div class="column">
          
                   <div class="form-stack has-icon pull-left">
                      
                  <br>
                  <h2>Team</h2>
                  <br>
                  <label>Team Name</label>
                  <input name="teamname" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your team name" data-parsley-required>
                  <span class="text-danger"> </span>
                  

                   <input type="checkbox" onclick="myFunction()"> Enable Coaches<br>
                </div>
        </div>
      
       
            <div class="column" id="coach">
           
                  <div style="display:none" id="myDIV">
                  <br>
                  <h2>Coach</h2>
                  <label> First Name </label>
                  <input name="coach_fname" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your first name" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Middle Name </label>
                  <input name="coach_mname" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your middle name" data-parsley-required >
                  <span class="text-danger"> </span>

                  <label> Last Name </label>
                  <input name="coach_lname" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your last name" data-parsley-required >
                  <span class="text-danger"> </span>

                  <label> Contact Number </label>
                  <input name="coach_contactno" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your contact number" data-parsley-required >
                  <span class="text-danger"> </span>

                  <label> Email </label>
                  <input name="coach_email" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your email" data-parsley-required >
                  <span class="text-danger"> </span>

                  <label> Address </label>
                  <input name="coach_address" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your address" data-parsley-required >
                  <span class="text-danger"></span>
                </div>
              </div>
               
              </div>
          
                
                
                  <div class="row">
                        
                        
                <h2>Participants</h2>
                    <div class="column" id="tcol">
              
                 
                  <h3>Participant 1</h3>
                  <label> First Name </label>
                  <input name="part_fname" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your first name" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Middle Name </label>
                  <input name="part_mname" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your middle name" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Last Name </label>
                  <input name="part_lname" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your last name" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Contact Number </label>
                  <input name="part_contactno" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your contact number" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Email </label>
                  <input name="part_email" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your email" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Address </label>
                  <input name="part_address" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your address" data-parsley-required>
                  <span class="text-danger"></span>

                  <br> 
                  <div class="form-group">
                  <label for="exampleInputFile">Matriculation Form</label>
                  <input type="file" id="exampleInputFile">

                  </div>

                </div>
                
               
                <div class="column" id="tcol">
                   <h3> Participant 2 </h3>
                     <label> First Name </label>
                  <input name="part_fname1" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your first name" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Middle Name </label>
                  <input name="part_mname1" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your middle name" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Last Name </label>
                  <input name="part_lname1" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your last name" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Contact Number </label>
                  <input name="part_contactno1" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your contact number" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Email </label>
                  <input name="part_email1" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your email" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Address </label>
                  <input name="part_address1" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your address" data-parsley-required>
                  <span class="text-danger"></span>
                </div>
                <div class="column" id="tcol">
                  <h3> Participant 3 </h3>
                     <label> First Name </label>
                  <input name="part_fname2" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your first name" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Middle Name </label>
                  <input name="part_mname2" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your middle name" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Last Name </label>
                  <input name="part_lname2" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your last name" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Contact Number </label>
                  <input name="part_contactno2" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your contact number" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Email </label>
                  <input name="part_email2" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your email" data-parsley-required>
                  <span class="text-danger"> </span>

                  <label> Address </label>
                  <input name="part_address2" type="text" class="form-control input-lg" placeholder="Team Name" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your address" data-parsley-required>
                  <span class="text-danger"></span>
                </div>
              </div>
           
            
                 
         
                <br >
                <center>
                
                <input type="submit" style="width:600px" class="btn btn-block btn-primary" value="Register" href="$">

                  </form>
                  
                   <form method="post" action="<?php echo base_url('login')?>" accept-charset="utf-8"> 
              
                <button class="btn btn-block btn-danger" onclick="<?php echo base_url('aw')?>">Cancel</button>
             </form>
           </center>
             <hr> 
          

          
       
        </div>
  
    </section>
  </section>