

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

    <?php if($this->session->flashdata('Success')){ ?>
        <div class="alert alert-success col-xs-12">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Success!</strong>
            <?php echo $this->session->flashdata('Success'); ?>
        </div>
        <?php }?>

      <?php if($this->session->flashdata('Error')){ ?>
      <div class="alert alert-warning col-xs-12">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
          <strong>Oops!</strong>
          <?php echo $this->session->flashdata('Error'); ?>
      </div>
      <?php }?>
 <section class="content">
        <div class="col-md-6 col-md-offset-3">
          <div class="box">
            <div class="box-header with-border">
              <center>
              <h1 class="box-title">Account</h1>
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
                        <form method="post" action="<?php echo base_url() ?>Account/processEdit/<?php echo $accountID;?>" accept-charset="utf-8"> 

                          
                      
                            
                          <label>Username</label>
                            <div class="form-group has-feedback">
                              <input class="form-control" name="CompetitionName" value="<?php echo $username; ?>" disabled class="form-control" type="text" width="25">
                            </div>
                                       
                            <!-- Date -->
                            <div class="form-group">
                              <label>Email</label>
                              <input class="form-control" name="CompetitionName" value="<?php echo $email; ?>" disabled class="form-control" type="text" width="25">
                            </div>



<!--                             <div class="form-group">
                              <label>Confirm Password</label>
                              <input class="form-control" name="CompetitionName" value="<?php echo $username; ?>" disabled class="form-control" type="text" width="25">
                            </div>
                       -->

                            <div class="row">    
                                <div class="col-xs-4 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Edit</button>
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

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })


    // document.getElementById('start').valueAsDate = new Date();

</script>

