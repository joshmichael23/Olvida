<body>

    <section class="content-header">
        <h1>
          <?php echo $compname; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('competitions/all'); ?>">Competitions</a></li>
            <li>
                <a class="active">
                    <?php echo $compname; ?>
                </a>
            </li>
        </ol>
    </section>

    <section id="main" role="main">
        <section class="content">


            <!-- Main content -->

            <div class="row" id="totoo">
                <div class="col-md-12">
                    <div class="box">

                        <div class="box-header with-border">
                            <h3 class="box-title">Categories</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body" id="real">
                          <center>
                            <?php echo $desc; ?>
                          </center>
                                <table id="demonyo" class="table table-bordered">

                                    <tr>
                                        <th style="width:400px">Category</th>
                                        <th>Requires Payment</th>
                                        <th>Category Type</th>
                                        <th>Action
                                        
                                    </tr>

                                    <?php

                if($sample->num_rows()>0): 
                  foreach($sample->result_array() AS $sample1){
                  ?>
                                        <tr>
                                            <?php $name = $sample1['category_name']; 
                            $cat_id = $sample1['category_id'];
                            $comp_id = $sample1['competition_id'];
                            $id = $sample1['category_id'];

                            $CI =& get_instance(); 
                            $CI->load->model('compANDcatModel');

                            $countApproved = $CI->compANDcatModel->countApprovedTeams($cat_id, $this->session->userdata('id'));
                            $countPending = $CI->compANDcatModel->countPendingTeams($cat_id, $this->session->userdata('id'));
                            ?>

                                                <td>
                                                    <?php echo $sample1['category_name']?>
                                                </td>
                                                <td>
                                                    <?php echo $sample1['payment']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $sample1['category_type']; ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary" data-toggle="modal" data-target="#myModal-<?php echo $id; ?>">View</a>
                                                </td>
                                                <td style="width: 100px">

                                                    <?php if($countApproved)echo '<span class="label label-success">'.$countApproved.' Approved Team/s</span>'; ?>
                                                        <?php if($countPending)echo '<span class="label label-warning">'.$countPending.' Pending Team/s</span>'; ?>
                                                </td>

                                                <div class="modal fade" id="myModal-<?php echo $id;?>" role="dialog">
                                                    <div class="modal-dialog">

                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <div class="register-box">
                                                                <div class="register-logo">
                                                                    <b><?php echo $name; ?></b>
                                                                </div>

                                                                <div>

                                                                    <center>
                                                                        <b>Category Type: </b>
                                                                        <?php echo $sample1['category_type'];?>
                                                                        <br>

                                                                    
                                                                        <b>Requires Payment: </b>
                                                                        <?php echo $sample1['payment'];?>
                                                                    </center>
                                                                    <br>

                                                                </div>

                                                                <div class="row">
                                                                  <center>
                                                                    <div class="col-xs-4">
                                                                    </div>
                                                                    <!-- /.col -->
                                                                    <div class="col-xs-4">
                                                                        <a class="btn btn-primary" href="<?php echo base_url() ?>categories/join/<?php echo $id; ?>">View</a>
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



                                        </tr>
                                                                      
                                        <?php
                                        }
                                    else: echo "<tr><td>No data available. </td></tr>";

                                    endif;?>


  </table>

                                </div>
                                <!-- /.box-body -->

                                </div>
                                <!-- /.box -->

                        </div>
                        <!-- col-md-6 -->

                    </div>

                    <!-- Main content -->

        </section>
    </section>

</body>

<br>
<br>