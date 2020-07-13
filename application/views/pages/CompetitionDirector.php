<body>

    <section class="content-header">
        <?php if($this->session->userdata('status')=='Technical Committee'){?>
            <h1>
          <i class="fa fa-download"></i>  Create TSV for Competitions
        </h1>
            <?php }else{?>
                <h1>
          Competitions
        </h1>
                <?php }?>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url('login/index') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Competitions</li>
                    </ol>
    </section>

    <!-- <h1 class="text-muted mt-0 font-alt">Competitions</h1> -->
            
                            <?php if(!empty($success_msg)){ ?>
                                <div class="col-xs-12">
                                    <div class="alert alert-success">
                                        <?php echo $success_msg; ?>
                                    </div>
                                </div>
                            <?php }elseif(!empty($error_msg)){ ?>
                                <div class="col-xs-12">
                                    <div class="alert alert-danger">
                                        <?php echo $error_msg; ?>
                                    </div>
                                </div>
                                <?php } ?>
                                        <section class="content">
    
                                        <?php if($this->session->flashdata('edit')){ ?>
        <div class="alert alert-success col-xs-12">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Success!</strong>
            <?php echo $this->session->flashdata('edit'); ?>
        </div>
        <?php }?>

        <?php if($this->session->flashdata('success')){ ?>
        <div class="alert alert-success col-xs-12">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Success!</strong>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php }?>

    <?php if($this->session->flashdata('wrongdate')){ ?>
        <div class="alert alert-danger col-xs-12">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Error!</strong>
            <?php echo $this->session->flashdata('wrongdate'); ?>
        </div>
        <?php }?>


    <?php if($this->session->flashdata('Fail')){ ?>
        <center>
            <div class="alert alert-danger col-xs-12">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Fail!</strong>
                <?php echo $this->session->flashdata('Fail'); ?>
            </div>
        </center>
        <?php }?>

                                            <!-- Default box -->
                                            <div class="box">
                                                <div class="box-header with-border">
                                                    <a class="btn btn-primary pull-left" href="<?php echo base_url('competitions/createComp')?>">Add Competition</a>

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

                                                                        <?php $aw = $row['competition_name'];
                                  $directorID = $row['director_id']; ?>
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

                                                                                    <a class="btn btn-default" href="<?php echo base_url() ?>competitions/editComp/<?php echo $compID; ?>" class="btn btn primary">Edit</a>

                                                                                    <a class="btn btn-danger" href="<?php echo base_url() ?>competitions/deleteComp/<?php echo $aw; ?>" class="btn btn primary" onClick="return doconfirm();"> Delete
                                          </a>

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
                                        <!-- /.content -->

                                        <!-- /.box-body -->
                                        <!--         <div class="box-footer">
          Footer
        </div> -->

</body>

<script>
    function doconfirm() {
        job = confirm("Are you sure to delete this?");
        if (job != true) {
            return false;
        }
    }

    $(document).ready(function() {

        load_data();

        function load_data(query) {
            $.ajax({
                url: "<?php echo base_url(); ?>competitions/FetchCompetitions/",
                method: "POST",
                data: {
                    query: query,
                    compID: <?php echo $compID; ?>
                },
                success: function(data) {
                    $('#result').html(data);
                }
            })
        }

        $('#search_text').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });
    });
</script>