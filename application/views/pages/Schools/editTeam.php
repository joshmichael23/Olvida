<link rel="stylesheet" href="<?php echo base_url()."assets/";?> bower_components/select2/dist/css/select2.min.css">
 <!-- SELECT 2 -->
<script src="<?php echo base_url()."assets/";?>bower_components/select2/dist/js/select2.full.min.js"></script>



<?php echo "&nbsp;"; ?>


<div class="container">
   <div class="left">
        <a class="btn btn-primary" onclick="javascript:history.go(-1)" class="btn btn primary">Back</a>
        </div> 
</div>

<body>

            <?php $i=0; ?>
            <?php foreach($sample AS $sample1):?>
              <?php $i++; ?>
              
                        <?php endforeach; ?> 



                  <div class="register-box">
                        <div class="register-logo">
                          <a href="../../index2.html">Edit Team</a>
                        </div>

                  <div class="register-box-body">
                   <?php echo form_open_multipart('School_teams/EditTeamz/' . $sample1->team_id)?>

                   <label>Team Name</label>
                      <div class="form-group has-feedback">
                          <input type="text" name="teamname" value="<?php echo $sample1->team_name; ?>" class="form-control" placeholder="First Name">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                      </div>

                    <!-- <?php echo $sample[0]->participant_id; ?>

                    <?php echo $sample[1]->participant_id; ?>
                     -->

                    <label>Member/s</label>
                    <div class="form-group">

                                <select class="form-control select2" multiple name="members[]" multiple data-placeholder="Select Members" style="width: 100%;">
                                    <?php
                                    foreach($sample as $row)
                                    { 
                                      echo '<option selected value="'.$row->participant_id.'">'.$row->Name.'</option>';

                                    }
                                    ?>

                                    <?php
                                    foreach($sample3 as $row)
                                    { 
                                      echo '<option value="'.$row->participant_id.'">'.$row->Name.'</option>';

                                    }
                                    ?>

                                </select>  
                    </div>

                    <label>Coach</label>
                    <div class="form-group">

                                <select class="form-control select2" multiple name="coach[]" id="coach" multiple data-placeholder="Select Coach" style="width: 100%;">


                                    <?php
                                    if($sample4!='false'){
                                      foreach($sample4 as $row)
                                       
                                        echo '<option selected value="'.$row->coach_id.'">'.$row->Name.'</option>';
                                      
                                      foreach($sample2 as $row)
                                        echo '<option selected value="'.$row->coach_id.'">'.$row->Name.'</option>';
                                    }
                                    else{
                                     foreach($sample5 as $row)
                                          echo '<option value="'.$row->coach_id.'">'.$row->Name.'</option>';
                                    }
                                    ?>

                                </select>  
                    </div>

                      <div class="row">
                          <div class="col-xs-4">                  
                          </div>
                                        <!-- /.col -->
                          <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
                          </div>
                                        <!-- /.col -->
                      </div>
                   </form>
                  </div
                >
            </div>


</body>


<script>

    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2(
    // {
    //   maximumSelectionLength: 3
    // }
    )

    $('#coach').select2(
    {
      maximumSelectionLength: 1
    }
    )

  })

</script>


<?php echo "&nbsp;"; ?>