<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>   

<body>

    <section class="content-header">
        <h1>
          <?php echo $compname . ': '?><small><?php echo $catname; ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('competitions/index'); ?>">Competitions</a></li>
            <li><a href="<?php echo base_url()?>competitions/viewCat/<?php echo $compname; ?>"><?php echo $compname?></a></li>
            <li class="active"><?php echo $catname; ?></li>
        </ol>
    </section>



  <section id="main" role="main">


                                            <section class="content">
        <?php if($this->session->flashdata('success')){ ?>
        <div class="row">
        <div class="alert alert-success col-xs-12">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Success!</strong>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
      </div>

        <?php }?>

                <?php if($this->session->flashdata('warning')){ ?>
       <div class="row">
        <div class="alert alert-warning col-xs-12">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Warning!</strong>
            <?php echo $this->session->flashdata('warning'); ?>
        </div>
  </div>
        <?php }?>
                                            <!-- Default box -->
                                            <div class="box">

                                                <div class="box-header with-border">
                                                  <h4 class="pull-left">Invite Teams</h4>
                                                    <form class="pull-right" method="post" action="<?php echo base_url('teams/inviteTeamsIndividual/'); ?><?php echo $catID; ?>">

                                                        <input type="text" name="searchKeyword" placeholder="Search by keyword..." value="<?php echo $searchKeyword; ?>">
                                                        <!--                                                                 <span class="input-group-btn">
                                                                      <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                                                      </button>
                                                                </span> -->

                                                        <input type="submit" name="submitSearch" class="btn btn-primary pull-right" value="Search">
                                                        <input type="submit" name="submitSearchReset" class="btn btn-primarsy" value="Reset">

                                                    </form>
                                                </div>

                                                <div class="box-body">
                                                  <div class="box-body table-responsive no-padding">
                                                    <table class="table table-hover">
                                                      <tr>
                                                        <th style="width: 250px">School</th>
                                                        <th>Address</th>
                                                        <th>Email</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    <?php if(!empty($sample)){ 
                                                foreach($sample as $sample1){ ?>
                                                    <tr>
                                                          <td style="text-align: left;"><?php echo $sample1['school_name']?></td>
                                                          <td style="text-align: left;"><?php echo $sample1['address']?></td>
                                                          <td><?php echo $sample1['email']?></td>
                                                          <td style="text-align: left;">

                                                          <a class="btn btn-primary" href="<?php echo base_url(); ?>teams/sendInvites/<?php echo $sample1['school_id'] . '/' . $catID; ?>" class="btn btn primary">Invite</a>

                                                          </td>
                                                    </tr>
  
                                                <?php   }
                                                  }else{ ?>
                                                    No data found.
                                                    <?php } ?>
                                          </table>
                                        </div>
                                                        <div class="box-footer">
                                                            <?php echo $this->pagination->create_links(); ?>
                                                        </div>
                                            </div>
                                            <!-- /.box-body -->

                                            <!-- /.box-footer-->
                                            </div>
                                            <!-- /.box -->

                                        </section>
    
  </section>

</body>
