<body>

    <section class="content-header">
        <h1>
          <?php echo $compName . ': '?><small><?php echo $catname; ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('competitions/index'); ?>">Competitions</a></li>
            <li><a href="<?php echo base_url()?>competitions/viewCat/<?php echo $compName; ?>"><?php echo $compName?></a></li>
            <li class="active"><?php echo $catname; ?></li>
        </ol>
    </section>

    <section id="main" role="main">
        <section class="content">

            <div class="row" id="totoo">

                <?php if($winners!=''): ?>
                    <div class="col-md-8">
                <?php else: ?>
                    <div class="col-md-12">
                <?php endif; ?>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Teams</h3>
                                
                                    <a href="<?php echo base_url('teams/exportTSV/') ?><?php echo $catID; ?>" class="btn btn-primary pull-right">Generate Team Account for PC<i style="font-size:11px;">2</i></a>

                                <?php if($this->session->userdata('status')!='Technical Committee'): ?>
                                     <a style="margin-right: 10px;" href="<?php echo base_url('teams/inviteTeams/') ?><?php echo $catID; ?>" class="btn btn-primary pull-right" >Invite Teams</a>    
                                <?php endif;?>

                        </div>
                    
                        <!-- /.box-header -->

                        <div class="box-body" id="real">
                            <table id="demonyo" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>School</th>
                                    <th>Team</th>
                                    <th>Members</th>
                                    <?php if($start_date > date('Y-m-d')):?>
                                    <th>Status</th>
                                    <?php endif;?>

                                </tr>
                            </thead>

                              <?php
                              foreach($sample->result_array() AS $sample1){
                              ?>
                                    
                                        <tr>
                                            <td><?php echo $sample1['school_name']?></td>
                                            <td><?php echo $sample1['team_name']?></td>
                                            <td><?php echo $sample1['Members']?></td>
                                            
                                        <?php if($start_date > date('Y-m-d')):?>

                                            <td>
                                                <?php 
                                                if($sample1['status']=='approved'){ ?>
                                                  <small class="label bg-green"><?php echo ucwords($sample1['status']);?></small>
                                                <?php }
                                                else{ ?>
                                                  <small class="label bg-orange"><?php echo ucwords($sample1['status']); ?></small>
                                                <?php }?>
                                            </td>
                                        <?php endif;?>
                                        </tr>

                                    <?php
                              }
                              ?>
                            </table>
                        </div> <!-- boxbody -->
                    </div>
                </div>
          
                               <?php if($winners!=''): ?>
                                    <div class="col-md-4">
                                        <div class="box">

                                           
                                            <div class="box-header with-border">
                                              <center>
                                                <h3 class="box-title">Winners</h3>
                                              </center>
                                            </div>

                                            <div class="box-body" id="real">

                                                <table id="winners" class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        
                                                        <th style="width: 10px">Rank</th>
                                                        
                                                        <th><center>Team</center></th>
                                                    
                                                    </tr>
                                                    </thead>
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

                        
                <?php endif;?>
            </div>

        </section>
    </section>


<script type="text/javascript">

        $(document).ready(

            function(){
                $('#winners').DataTable({
                    "bLengthChange": false,
                    "searching": false,
                    "pageLength": 8
                });
                $('#demonyo').DataTable({
                    "bLengthChange": false,
                    "pageLength": 6
                });
            }

    );

</script>

</body>

          
