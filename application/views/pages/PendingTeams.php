    <body>
  
    <section class="content-header">
        <h1>
          Pending Requests
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url('competitions/pendingrequests'); ?>">Pending Requests</a></li>
          <li><a href="<?php echo base_url(); ?>categories/pendingcategories/<?php echo $compID; ?>"><?php echo $compname . ' : ' . $catname; ?></a></li>
          <li class="active">Teams</li>
       </ol>
    </section>




          <section id="main" role="main">
              <section class="content">

                  <?php if($this->session->flashdata('NoMat')): ?>
                    <div class="alert alert-danger col-xs-12">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('NoMat'); ?>
                    </div>
                  <?php endif; ?>

                  <div class="row">
                  <div class="col-xs-12">
                    <div class="box">
                      <div class="box-header">
                        <h3 class="box-title"><?php echo $compname  . ': ' . $catname; ?></h3>

                        <div class="box-tools">
                          <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                          <tr>
                            <th style="width: 250px">School</th>
                            <th style="width: 320px">Team</th>
                            <th>Payment</th>
                            <th>Action</th>
                          </tr>
                         <?php

                         
            foreach($sample->result_array() AS $sample1){
            ?>

            <tr>
                <?php if($sample1['status']=='pending'){ ?>
                  <td><?php echo $sample1['school_name'];?></td>
                    <td><?php echo $sample1['team_name']?></td>   

                       <?php if($sample1['payment']!=NULL){ ?>
                       <td>
                         <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                          Check Payment
                        </button>
                      </td>
                        <?php }
                        else{ ?>
                          <td></td>
                        
                        <?php }
                        ?>  
                  <td>
                    
                        <?php if($sample1['email_sent']==''): ?>
                                <a class="btn btn-primary" href="<?php echo base_url()?>categories/checkTeamIfEligible/<?php echo $sample1['team_id']; ?>/<?php echo $catID; ?>">Approve</a>
                        <?php else:?>
                                <a class="btn btn-warning" href="<?php echo base_url()?>categories/checkTeamIfEligible/<?php echo $sample1['team_id']; ?>/<?php echo $catID; ?>">Resend Code</a>
                        <?php endif; ?>
                        

                        <a class="btn btn-danger" href="<?php echo base_url()?>categories/DisapproveTeam/<?php echo $sample1['team_id']; ?>/<?php echo $catID; ?>">Disapprove</a>
                    
                    
                    
                        

   
                    <?php } ?>


                        <div class="modal fade" id="modal-default">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Payment</h4>
                              </div>

                              

                               
                                <?php $teamID = $sample1['team_id']; ?>
                                  

                                <?php
                                $filename = $this->compANDcatModel->getFilenameOfTeamInCat($catID, $teamID);
                                   echo '<img class="img-responsive" style="height:auto;max-width: 100%;" src="' . base_url( 'uploads/payments/' . $filename) . '">';

                                ?> 

                                <div class="modal-footer">
                                <center>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </center>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->


                    </td>
               <?php } ?>
            </tr>
                        </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
                </div>
                  
                 


               
              </section>
            </section>

 
</body>

