

    <body>

<!--             <section class="content-header">
        <h1>
          
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('login/index'); ?>""><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url('competitions/index'); ?>"">Competitions</a></li>
          <li class="active">Edit Competition</li>
        </ol>
      </section> -->


 <section class="content">
        <div class="col-md-6 col-md-offset-3">
          <div class="box">
            <div class="box-header with-border">
              <center>
              <h1 class="box-title">Edit Account</h1>
            </center>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                    <?php foreach($result->result_array() as $row){ 
                          $accountID = $row['school_id'];
                          $username = $row['user'];
                          $password = $row['pass'];
                          $email = $row['email'];
                    }?>
                    <div class="register-box-body">
                        <form method="post" action="<?php echo base_url() ?>Account/EditAccountSchool/<?php echo $accountID;?>" accept-charset="utf-8"> 

                          
                      
                            
                          <label>Username</label>
                            <div class="form-group has-feedback">
                              <input class="form-control" name="CompetitionName" disabled value="<?php echo $username; ?>" class="form-control" type="text" width="25">
                            </div>
                                       
                            <div class="form-group">
                              <label>Password</label>
                              <input class="form-control" name="Password" class="form-control" type="password" width="25">
                            </div> 

                            <div class="form-group">
                              <label>Confirm Password</label>
                              <input class="form-control" name="ConfirmPassword" class="form-control" type="password" width="25">
                            </div> 
                            <!-- Date -->
                            <div class="form-group">
                              <label>Email</label>
                              <input class="form-control" name="Email" value="<?php echo $email; ?>" class="form-control" type="text" width="25">
                            </div>
                            


<!--                             <div class="form-group">
                              <label>Confirm Password</label>
                              <input class="form-control" name="CompetitionName" value="<?php echo $username; ?>" disabled class="form-control" type="text" width="25">
                            </div>
                       -->

                            <div class="row">    
                                <div class="col-xs-4 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                                </div>
                                </form>


                            </div>
                                
                                                  
                            
                        
                  </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">

            </div>
          </div>
        </div>

  </section>



</body>


<script>
function doconfirm()
{
    job=confirm("Success!");
    if(job!=true)
    {
        return false;
    }
}

</script>

