<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->
<style>

</style>

<body>

    <section class="content-header">
        <h1>
          Competitions
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a class="active">My Competitions</a></li>
        </ol>
    </section>

    <section id="main" role="main">

        <!-- <div class="box-body">

              <div class="progress">

                <div class="progress-bar progress-bar-aqua" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                  <span class="sr-only">30% Complete</span>

                </div>
              </div>
</div> -->

        <h1 class="text-muted mt-0 font-alt" align="center"> </h1>

        <?php if($this->session->flashdata('success')){ ?>
            <div class="alert alert-success col-xs-12">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <br>
            <?php }?>

                <?php if($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger col-xs-12">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Error!</strong>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                    <br>
                    <?php }?>

                        <section class="content">

                            <!-- Default box -->
                            <div class="box">
                                <div class="box-header with-border">
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Register</a>

                                    <form class="pull-right" method="post" action="<?php echo base_url('competitions/index'); ?>">

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

                                    <?php if(!empty($sample)){ 
                          foreach($sample as $row){ ?>

                                        <div class="row-lg-3 row-xs-6">
                                            <div class="col-lg-3 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box" id="box" href="awd">

                                                    <div class="icon">
                                                        <!-- <i class="ion ion-person-add"></i> -->
                                                    </div>

                                                    <div class="inner" style="color: white; background-color: rgb(60, 141, 188); text-align: center">

                                                        <?php $aw = $row['competition_name']; ?>
                                                            <?php $compID = $row['competition_id'] ?>

                                                                <?php if(strlen($row['competition_name']) < 33){ ?>
                                                                    <h3 style="font-size: 20px;">
                                  <?php }else{ ?>
                                      <h3 style="font-size: 12px;"><br>
                                  <?php }?>
                                    <?php 
                                    echo $row['competition_name'];
                                    ?>

                                  </h3>

                                                                    <p>
                                                                        <?php echo $row['start_date']; ?>
                                                                            <?php date_default_timezone_set('Asia/Manila'); 
                                          if(date('Y-m-d') > $row['start_date']){
                                              echo '<i class="label bg-red">Done</i>';
                                          } 
                                          else{
                                              echo '<i>&nbsp;</i>';
                                          }
                                    ?>
                                                                    </p>

                                                    </div>
                                                    <span class="small-box-footer" style="background-color: rgb(53, 124, 165)">
                                    <a style="color: white" href="<?php echo base_url() ?>competitions/viewCat/<?php echo $aw;?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                          </span>

                                                </div>

                                            </div>
                                        </div>

                                        <?php } ?>

                                            <!-- div box -->
                                </div>
                                <?php   }
                        else{ ?>
                                    No data found.
                                    <?php } ?>

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

<form method="post" action="<?php echo site_url('competitions/registerSchool'); ?>">

    <!-- Modal -->
    <div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center>
                        <h2>Register</h2></center>

                </div>

                <div class="modal-body">

                    <ul class="course_nav">

                        <fieldset>
                            <!-- ======= DEFAULT INPUT BOX ========== -->
                            <div class="form-group">
                                <label class="col-form-label" for="inputDefault">Code</label>
                                <input type="text" class="form-control" id="inputDefault" name="code">
                            </div>

                        </fieldset>
                    </ul>

                </div>
                <div class="modal-footer">
                    <!-- ======= SUBMIT BUTTON ========== -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- 
<script>
  $(document).ready(function() {

    var navListItems = $('ul.setup-panel li a'),
        allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function(e)
    {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this).closest('li');

        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
    });

    $('ul.setup-panel li.active a').trigger('click');

    // DEMO ONLY //
    $('#activate-step-2').on('click', function(e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $(this).remove();
    })    
});

</script> -->