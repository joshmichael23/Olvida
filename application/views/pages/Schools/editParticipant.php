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

 

                  <div class="register-box">
                        <div class="register-logo">
                          <a href="../../index2.html">Edit  Participant</a>
                        </div>

                  <div class="register-box-body">
                   <?php echo form_open_multipart('School_teams/processEdit/' . $sample1->participant_id)?>
                              <div class="form-group has-feedback">
                              <input type="text" name="firstname" value="<?php echo $sample1->first_name; ?>" class="form-control" placeholder="First Name">
                              <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>

                              <div class="form-group has-feedback">
                                <input type="text" name="middlename" value="<?php echo $sample1->middle_name; ?>"class="form-control" placeholder="Middle Name">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                              </div>
                              <div class="form-group has-feedback">
                                <input type="text" name="lastname" class="form-control" value="<?php echo $sample1->last_name; ?>" placeholder="Last Name">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                              </div>
                              <div class="form-group has-feedback">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $sample1->email; ?>">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                              </div>
                              <div class="form-group has-feedback">
                                <input type="text" name="address" value="<?php echo $sample1->address; ?>" class="form-control" placeholder="Address">
                                <span class="fa fa-fw fa-map-pin form-control-feedback" style="margin-right:8px"></span>
                              </div>
                              <div class="form-group has-feedback">
                                <input type="text" name="contactno" class="form-control" value="<?php echo $sample1->contact_no; ?>" placeholder="Contact Number">
                                <span class="fa fa-fw fa-phone form-control-feedback" style="margin-right:8px"></span>
                              </div>
                          

                              <div class="form-group has-feedback">
                                <label>Matriculation Form</label>
                                <input type="file" class="form-control" placeholder="Picture" name="userfile" size="2000">


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
                </div>
            </div>

            <?php endforeach; ?>   

</body>

<?php echo "&nbsp;"; ?>

<script>
        $('form').attr('autocomplete', 'off');
</script>