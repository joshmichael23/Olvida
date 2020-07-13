<body>
<section id="main" role="main">
    <section class="content">

             <div class="row" id="totoo" style="margin-top:40px">
                        <div class="col-md-12 col-md-offset-0">
                            <div class="box">


<?php if($director): ?>
                                <div class="box-header with-border">
                                    <h3 class="box-title">Director Requests</h3>
                                </div>
                                <!-- /.box-header -->

                                <div class="box-body" id="real">
                                    <table id="demonyo" class="table table-bordered">

                                        <tr>
                                            <th style="width: 200px">Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>

                                        </tr>


                                        <?php

                                        foreach($director->result_array() AS $sample1){
                                        ?>
                                        <tr>
                                            <td><?php echo $sample1['Name']?></td>
                                            <td><?php echo $sample1['email']?></td>
                                            <td><?php echo $sample1['contact_no']?></td>
                                            <td>
                                              <center>

                                              <?php if($sample1['sent_email']=='yes'):?>
                                              <a class="btn btn-success" href="<?php echo base_url() ?>home/approve/<?php echo $sample1['role'] ?>/<?php echo $sample1['target_id']; ?>">ReApprove</a>
                                              <?php else: ?>
                                              <a class="btn btn-primary" href="<?php echo base_url() ?>home/approve/<?php echo $sample1['role'] ?>/<?php echo $sample1['target_id']; ?>">Approve</a>
                                              <?php endif; ?>
                                              <a class="btn btn-danger" href="<?php echo base_url() ?>home/disapprove/<?php echo $sample1['role'] ?>/<?php echo $sample1['target_id']; ?>">Disapprove</a>
                                              </center>
                                        </tr>
                                        <?php
                                        }?>
                                        
                                    </table>
                                </div>
                                <!-- /.box-body -->


                            </div>
                            <!-- /.box -->

                        
                
                          </div>  <!-- col-md-6 -->

                </div>

     
<?php endif; ?>

<?php if($school!=''): ?>


             <div class="row" id="totoo" style="margin-top:40px">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="box">

                                <div class="box-header with-border">
                                    <h3 class="box-title">School Requests</h3>
                                </div>
                                <!-- /.box-header -->

                                <div class="box-body" id="real">
                                    <table id="demonyo" class="table table-bordered">

                                        <tr>
                                            <th style="width: 200px">Name</th>
                                            <th>Email</th>

                                        </tr>


                                        <?php
                                        foreach($school->result_array() AS $sample1){
                                        ?>
                                        <tr>
                                            <td><?php echo $sample1['Name']?></td>
                                            <td><?php echo $sample1['email']?></td>
                                            <td>
                                              <center><?php if($sample1['sent_email']=='yes'):?>
                                              <a class="btn btn-success" href="<?php echo base_url() ?>home/approve/<?php echo $sample1['role'] ?>/<?php echo $sample1['target_id']; ?>">ReApprove</a>
                                              <?php else: ?>
                                              <a class="btn btn-primary" href="<?php echo base_url() ?>home/approve/<?php echo $sample1['role'] ?>/<?php echo $sample1['target_id']; ?>">Approve</a>
                                              <?php endif; ?>
                                              <a class="btn btn-danger" href="<?php echo base_url() ?>home/disapprove/<?php echo $sample1['role'] ?>/<?php echo $sample1['target_id']; ?>">Disapprove</a>
                                              </center>
                                          </center>
                                        </tr>
                                        <?php
                                        }?>
                                        
                                    </table>
                                </div>
                                <!-- /.box-body -->


                            </div>
                            <!-- /.box -->

                        
                
                          </div>  <!-- col-md-6 -->

                </div>

     
<?php endif; ?>
    </section>
  </section>
</body>