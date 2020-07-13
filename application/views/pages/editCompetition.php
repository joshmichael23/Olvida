

    <body>

            <section class="content-header">
        <h1>
          Competition
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('login/index'); ?>""><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url('competitions/index'); ?>"">Competitions</a></li>
          <li class="active">Edit Competition</li>
        </ol>
      </section>


 <section class="content">
        <div class="col-md-6 col-md-offset-3">
          <div class="box">
            <div class="box-header with-border">
              <center>
              <h1 class="box-title">Edit Competition</h1>
            </center>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php
              foreach($sample->result_array() AS $sample){
                 $compID = $sample['competition_id'];
                 $compName = $sample['competition_name'];
                 $startdate = $sample['start_date'];
                 $enddate = $sample['end_date'];
              }
              ?>

                    <div class="register-box-body">
                        <form method="post" action="<?php echo base_url() ?>competitions/processEdit/<?php echo $compID;?>" accept-charset="utf-8"> 

                          
                      
                            
                          <label>Competition Name</label>
                            <div class="form-group has-feedback">
                              <input class="form-control" value="<?php echo $compName; ?>" name="CompetitionName" class="form-control" type="text" width="25">
                            </div>
                                        
                            <!-- Date -->
                            <div class="form-group">
                              <label>Start Date:</label>

                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" value="<?php echo $startdate; ?>" id="start" name="startdate" type="date" placeholder="MM/DD/YYYY" data-inputmask="'alias': 'datetime', 'inputFormat': 'mm/dd/yyyy'">
                              </div>
                              <!-- /.input group -->
                            </div>


                           <!-- Date -->
                            <div class="form-group">
                              <label>End Date:</label>

                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="end" value="<?php echo $enddate; ?>" name="enddate" type="date" placeholder="MM/DD/YYYY" data-inputmask="'alias': 'datetime', 'inputFormat': 'mm/dd/yyyy'">
                              </div>
                              <!-- /.input group -->
                            </div>

                            <div class="row">    
                                <div class="col-xs-4 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                                </div>
                            </div>
                                
                                                  
                            
                        </form>
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

