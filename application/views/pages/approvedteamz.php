<body>

    <section class="content-header">
        <h1>
          <?php echo $compname; ?><small><?php echo $catName; ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('competitions/index'); ?>">My Competitions</a></li>
            <li>
                <a href="<?php echo base_url('competitions/viewCat/'); ?><?php echo $compname; ?>">
                    <?php echo $compname; ?>
                </a>
            </li>
            <li class="active">
                <?php echo $catName;?>
            </li>

        </ol>
    </section>

    <section id="main" role="main">
        <section class="content">


                  <div class="row" id="totoo">


                            <div class="col-md-9 ">
                                <div class="box">

                                    <div class="box-header with-border">
                                        <h3 class="box-title">Participating Teams</h3>
                                    </div>
                                    <!-- /.box-header -->

                                    <div class="box-body" id="real">
                                        <table id="demonyo" class="table table-bordered">

                                            <tr>
                                                <th style="width: 200px">School Name</th>
                                                <th>Team</th>
                                                <th>Members</th>
                                                <th></th>
                                            </tr>

                                            <?php $i=0; ?>
                                                <?php if($sample!='nothing'): ?>
                                                    <?php foreach($sample AS $sample1):?>
                                                        <?php $i++; ?>
                                                            <tr>

                                                                <td>
                                                                    <?=$sample1->school_name; ?>
                                                                </td>
                                                                <td>
                                                                    <?=$sample1->team_name; ?>
                                                                </td>
                                                                <td>
                                                                    <?=$sample1->Members; ?>
                                                                </td>

                                                                <td>
<!--                                                                     <?php if($sample1->school_id==$this->session->userdata('id')) :?>
                                                                    <a class="btn btn-danger">Leave</a>
                                                                    <?php endif;?> -->
                                                                </td>

                                                            </tr>
                                                            <?php endforeach; ?>
                                                    <?php elseif($sample=='nothing'): ?>
                                                    <tr>
                                                        <td>No data available</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <?php endif; ?>
                                                

                                        </table>
                                    </div>
                                </div>
                            </div>

                                        <?php if($winners!=''): ?>
                    <div class="col-md-3">
                        <div class="box">

                           
                            <div class="box-header with-border">

                                <h3 class="box-title">Winners</h3>

                            </div>

                            <div class="box-body" id="real">

                                <table id="demonyo" class="table table-bordered">

                                    <tr>
                                        
                                        <th style="width: 10px">Rank</th>
                                        
                                        <th><center>Team</center></th>
                                    
                                    </tr>
                                    
                                        <?php foreach($winners->result_array() as $Rankers): ?>
                                        <tr>
                                            <td><center><?php echo $Rankers['rank']?></center></td>
                                            <td><center><?php echo $Rankers['team_name']; ?></center></td>
                                        </tr>
                                        <?php endforeach;?>
                                    
                                </table>
                            </div>
                            <!-- /.box-body -->

                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- col-md-6 -->


            <?php endif;?>

                                       </div>
        </section>
    </section>
</body>