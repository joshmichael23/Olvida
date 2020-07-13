<!-- KYLE -->

<body>

    <section class="content-header">
        <h1>
          Scoreboard <small></small>
        </h1>
        <ol class="breadcrumb">

            <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('Committies/viewCompScoreboard'); ?>">Upload Scoreboard</a></li>
            <li><a href="<?php echo base_url()?>Committies/viewCatScore/<?php echo $compname; ?>"><?php echo $compname; ?></a></li>
            <li class="active">View Scoreboard</li>
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
                    <div class="col-md-3 col-md-offset-4">
                        <div class="box">

                            <!-- /.box-header -->

                            <div class="box-body" id="real">

                                <table id="demonyo" class="table table-bordered">

                                    <tr>
                                        
                                        <th style="width: 10px">Rank</th>
                                        
                                        <th><center>Team</center></th>
                                    
                                    </tr>
                                    
                                        <?php foreach($sample->result_array() as $Rankers): ?>
                                        <tr>
                                            <td><?php echo $Rankers['rank']?></td>
                                            <td><?php echo $Rankers['team_name']; ?></td>
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