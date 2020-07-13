<!-- KYLE -->

<body>

    <section class="content-header">
<!--         <h1>
          Upload Scoreboard <small><?php echo $compname ?></small>
        </h1> -->
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('Committies/viewCompScoreboard'); ?>">Upload Scoreboard</a></li>
            <li class="active">Categories</li>
        </ol>
    </section>

    <section id="main" role="main">
        <section class="content">


          <?php if($this->session->flashdata('Success')){ ?>
            <div class="alert alert-success col-xs-11">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('Success'); ?>
            </div>
        <?php }?>
        
            <div class="text-center" style="margin-bottom:10px; ">

                <h1 class="text-muted mt-0 font-alt"></h1>

                <div class="row" id="totoo">
                    <div class="col-md-12">
                        <div class="box">

                            <!-- /.box-header -->

                            <div class="box-body" id="real">

                                <table id="demonyo" class="table table-bordered">

                                    <tr>
                                        <th>Category</th>
                                        <th>Category Type</th>
                                        <th>Require Payment</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <?php
                                        foreach($sample->result_array() AS $sample1){
                                        ?>
                                                <?php $name = $sample1['category_name']; 
                                                $cat_id = $sample1['category_id'];

                                                //I NEED TO GET THE COMPETITION NAME HERE
                                                ?>

                                                <td>
                                                    <?php echo $sample1['category_name']?>
                                                </td>
                                                <td>
                                                    <?php echo $sample1['category_type']?>
                                                </td>
                                                <td>
                                                    <?php echo $sample1['payment'] ?>
                                                </td>

                                                <td>
                                                  <?php if($sample1['file_name']==''): ?>
                                                   <a class="btn btn-primary" data-toggle="modal" data-target="#myModal-<?php echo $cat_id; ?>">Upload</a>
                                                  <?php else: ?>
                                                   <a class="btn btn-primary" href="<?php echo base_url()?>teams/viewTeams/<?php echo $cat_id; ?>">View Scoreboard</a>
                                                   <a class="btn bg-green" data-toggle="modal" data-target="#myModal-<?php echo $cat_id; ?>">Change</a>
                                                   <?php endif; ?>                                                    
                                                </td>


                                                    <div class="modal fade" id="myModal-<?php echo $cat_id;?>" role="dialog">
                                                    <div class="modal-dialog">

                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <div class="register-box">
                                                                <div class="register-logo">
                                                                    <b><?php echo $sample1['category_name']; ?></b>
                                                                </div>

                                                                <div>

                                                                    <center>
                                                                        <?php echo form_open_multipart('committies/upload_scoreboard/'.$cat_id)?>
                                                                            <input type="file" class="form-control" placeholder="Matriculation Form" name="userfile" size="2000">
                                                                             <button type="submit" class="btn btn-primary">Upload</button>
                                                                        </form>
                                                                    </center>
                                                                    <br>

                                                                </div>

                                                                <div class="row">


                                                                      <div class="row">
                                                                        <div class="col-xs-4">
                                                                          
                                                                        </div>
                                                                        <!-- /.col -->
                                                                        <div class="col-xs-4">
                                                                         
                                                                        </div>
                                                                        <!-- /.col -->
                                                                      </div>
                                                                </div>

                                                                <div class="modal-header">

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>





                                    </tr>
                                          <?php
                                          }?>
                                </table>
                            </div>
                            <!-- /.box-body -->

                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- col-md-6 -->

                </div>

            </div>

        </section>
    </section>


</body>


<script>
    function doconfirm() {
        job = confirm("Are you sure to delete permanently?");
        if (job != true) {
            return false;
        }
    }
</script>