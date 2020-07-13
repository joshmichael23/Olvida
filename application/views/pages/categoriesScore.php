<body>

    <section class="content-header">
        <h1>
<!--           <?php echo $compName . ': '?><small><?php echo $catname; ?></small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('competitions/index'); ?>">Competitions</a></li>
 <!--            <li><a href="<?php echo base_url()?>competitions/viewCat/<?php echo $compName; ?>"><?php echo $compName?></a></li>
            <li class="active"><?php echo $catname; ?></li> -->
        </ol>
    </section>

    <section id="main" role="main">
        <section class="content">
                
                                  <div class="row" id="totoo">
                                    <div class="col-md-3 col-md-offset-4">
                                        <div class="box">

                                           
                                            <div class="box-header with-border">
                                              <center>
                                                <h3 class="box-title">Winners</h3>
                                              </center>
                                            </div>

                                            <div class="box-body" id="real">

                                                <table id="demonyo" class="table table-bordered">

                                                    <tr>
                                                        
                                                        <th style="width: 10px">Rank</th>
                                                        
                                                        <th><center>Team</center></th>
                                                    
                                                    </tr>
                                                    
                                                        <?php foreach($winners->result_array() as $Rankers): ?>
                                                        <tr>
                                                            <td><?php echo $Rankers['rank']?></td>
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

                                </div>

        </section>
    </section>
</body>