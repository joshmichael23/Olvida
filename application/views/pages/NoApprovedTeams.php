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



                    <div class="col-md-12">

                    <div class="box">

                        <div class="box-header with-border">
                            <h3 class="box-title">Teams</h3>


                          





                               
<?php if($this->session->userdata('status')!='Technical Committee'): ?>


                                     <a style="margin-right: 10px;" href="<?php echo base_url('teams/inviteTeams/') ?><?php echo $catID; ?>" class="btn btn-primary pull-right" >Invite Teams</a>
            
 <?php endif;?>

                        </div>
                    
                        <!-- /.box-header -->

                        <div class="box-body" id="real">
                            <table id="demonyo" class="table table-bordered">

                                <tr>
                                    <th>School</th>
                                    <th>Team</th>
                                    <th>Members</th>
                                    <th>Status</th>

                                </tr>


                                    
                                        <tr>

                                            <td>
                                               No teams joined yet.
                                            </td>
                                            
                                        </tr>

                            </table>

                        </div>
                    </div>
                </div>

                              
            </div>

        </section>
    </section>
</body>