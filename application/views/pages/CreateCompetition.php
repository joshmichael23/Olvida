<br>
<body>



                    <!-- </?php if($this->session->flashdata('error')){ ?>
                        <center>
                            <div class="alert alert-danger col-xs-12" style="margin-top: 20px">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <strong>Creation failed!</strong>
                                </?php echo $this->session->flashdata('error'); ?>

                            </div>
                        </center> -->
                        <!-- </?php }?> -->
                        
                   
                    
                        
  <section id="main" role="main" style="margin-top: 30px">
    <section class="container">



        <center>
        <div class="row">
          <div class="col-md-3">

          </div>

          <div style="align-content: " class="col-md-5">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                              <div class="box-body">
                  <div class="progress-group">
                    <span class="progress-text">Step 1: Competition Details</span>
<!--                     <span class="progress-number"><b>160</b>/200</span> -->

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-#3c8dbc" style="width: 30%"></div>
                    </div>
                  </div>
            </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="post" class="form-horizontal" action="<?php echo base_url('competitions/process')?>" accept-charset="utf-8"> 
                  <div class="box-body">
                  <?php $this->load->library('form_validation'); ?>
                    <?php echo validation_errors('<div class="alert alert-danger" style="width:80%;">','</div>');?>
                    <div class="form-group" style="margin-left: 40px">
                    
                        <label class="col-sm-5">Competition Name</label>
                        
                        <div class="col-sm-10">
                            <input name="competitionname" type="text" class="form-control" value="<?php echo set_value('competitionname'); ?>" placeholder="Competition Name">
                        </div>

                        
                        
                        <label class="col-sm-4" style="margin-top:20px">Starting Date</label>
                        <div class="col-sm-10">
                            <input type="date" name="startdate" value="<?php echo set_value('startdate'); ?>" class="form-control"><br>
                        </div>
                        
                        
                        <label class="col-sm-4" style="margin-top: 10px">Ending Date</label>
                        <div class="col-sm-10">
                            <input type="date" name="endingdate" value="<?php echo set_value('endingdate'); ?>" class="form-control"><br>
                        </div>

                        <label class="col-sm-4" style="margin-top:10px" >PC^2 Account Number  </label>
                        <small class="col-sm-4">(Enter the Site Number you used in PC^2)</small>
                        <div class="col-sm-10">
                            <input type="text" name="siteno" class="form-control" value="<?php echo set_value('siteno'); ?>" maxlength="1">
                        </div>
                      </div>
                  
                    <div class="box-footer">
                    
                      <button type="submit" class="btn btn-primary pull-right" href="$">Next</button>
                </form>
                  <a class="btn btn-danger pull-left" href="<?php echo base_url('competitions/index'); ?>">Cancel</a>

                    </div>
                  </div>

              </div>
          </div>
          <div class="col-md-5">
          </div>  
          </div>       
    </section>
  </section>
</body>

<script>
  $(document).ready(function(){

 aww();

 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data(); 
  }
 });
});
</script>