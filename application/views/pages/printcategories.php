



<body>

      <section class="content-header">
        <h1>
          Generate Certificate
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url('competitions/generateCertificate'); ?>">Generate Certificate</a></li>
           <li><a href="<?php echo base_url('Generate/ChoosePrint/'); ?><?php echo $compID; ?>"><?php echo $compName; ?></a></li>
           <li><a class="active">Categories</a></li>
        </ol>
      </section>


  <section id="main" role="main">
    <section class="content">

             <div class="row" id="totoo" style="margin-top:40px">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="box">

                                <div class="box-header with-border">
                                    <h3 class="box-title">Categories for <?php echo $compName; ?></h3>
                                </div>
                                <!-- /.box-header -->

                                <div class="box-body" id="real">
                                    <table id="demonyo" class="table table-bordered">

                                        <tr>
                                            <th style="width: 200px">Category Name</th>

                                        </tr>


                                        <?php
                                        foreach($sample->result_array() AS $sample1){
                                        ?>
                                        <tr>
                                            <?php $name = $sample1['category_name']; 
                                                  $cat_id = $sample1['category_id'];
                                                  $comp_id = $sample1['competition_id'];
                                                  $id = $sample1['category_id'];
                                                  ?>
                                            <td><?php echo $sample1['category_name']?></td>
                                            <td>
                                              <center>
                                              <button class="btn btn-primary" data-toggle="modal" data-target="#myModal-<?php echo $cat_id; ?>">View</button>



                                             <div class="modal fade" id="myModal-<?php echo $cat_id; ?>" role="dialog">
                                                    <div class="modal-dialog">

                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h1>Teams</h1>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <div class="register-box">
                                                                <div class="register-logo">
                                                                    
                                                                </div>

                                                                <div>

                                                                  <table class="table table-bordered">
                                                                    <tr>
                                                                      <th>Team Name</th>
                                                                      <th>Members</th>
                                                                    </tr>
                                                                    
                                                                             <?php 
                                                                               $CI =& get_instance();
                                                                               $CI->load->model('compANDcatModel');
                                                                               $sample = $this->compANDcatModel->displayTeamz($cat_id);
                                                                            ?>

                                                                            <?php if($sample != 'nothing'): ?>
                                                                            <?php foreach($sample->result_array() as $row){ ?>
                                                                                <tr>
                                                                                  <td><?php echo $row['team_name']; ?></td>
                                                                                  
                                                                                  <td><?php echo $row['Members']; ?></td>
                                                                                </tr>  
                                                                            <?php }?>
                                                                          <?php else: ?>
                                                                                <?php echo "No teams registered."?>
                                                                          <?php endif; ?>
                                                                      


                                                                 
                                                                    
                                                                  </table>
                                                                </div>

                                                                <div class="row">
                                                                  <center>
                                                                    <div class="col-xs-4">
                                                                    </div>
                                                                    <!-- /.col -->
                                                                    <div class="col-xs-4">
            
                                                                    </div>
                                                                  </center>
                                                                </div>

                                                                <div class="modal-header">

                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                              <button class="btn btn-primary" onclick="window.open('<?php echo base_url() ?>Generate/printPlacersForCat/<?php echo $cat_id; ?>')" targey="_blank">Print</button></center>
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

     
    </section>
  </section>
</body>