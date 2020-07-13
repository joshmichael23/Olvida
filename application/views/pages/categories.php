<body>

    <section class="content-header">
        <h1>
          <?php echo $compname;?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('competitions/index'); ?>">Competitions</a></li>
            <li class="active"><?php echo $compname;?></li>
        </ol>
    </section>

    <section id="main" role="main">
        <section class="content">


          <?php if($this->session->flashdata('success')){ ?>
            
                <div class="alert alert-success col-xs-12">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                </div>
            
        <?php }?>

        <?php if($this->session->flashdata('add')){ ?>
          
                <div class="alert alert-success col-xs-12">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Success!</strong> <?php echo $this->session->flashdata('add'); ?>
                </div>
      
        <?php }?>

                <?php if($this->session->flashdata('delete')){ ?>
          
                <div class="alert alert-success col-xs-12">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Success!</strong> <?php echo $this->session->flashdata('delete'); ?>
                </div>
      
        <?php }?>


            <div class="row" id="totoo">
                <div class="col-md-12">
                    <div class="box">





                        <!-- /.box-header -->

                        <div class="box-body" id="real">

                            <?php if($sample->num_rows() > 0){?>

                                                    <div class="box-header with-border">
                            <h3 class="box-title">Categories</h3>

                            <?php 
                            $status = $this->session->userdata('status');
                            if($status=='Secretariat Committee' || $status=='director'){ ?>
                            <a class="btn btn-primary pull-right" href="<?php echo base_url()?>competitions/CheckAttendance/<?php echo $IDofComp; ?>">Check Attendance</a> 
                            <?php }

                            if($status=='director' && $date > date('F d, Y') ){?>
                            <a style="margin-right: 10px;" class="btn btn-primary pull-right" href="<?php echo base_url()?>categories/addCat/<?php echo $IDofComp; ?>">Add Category</a> <!-- categories/addcat -->
                            <?php }?>
                        </div>
                            <table id="demonyo" class="table table-bordered">

                                <tr>
                                    <th>Category</th>
                                    <th>Category Type</th>
                                    <th>Requires Payment</th>
                                    <th># of teams joined</th>
                                    <th>Action</th>
                                </tr>

                                <?php
                                    foreach($sample->result_array() AS $sample1){
                                    ?>
                                    <?php $name = $sample1['category_name']; 
                                              $cat_id = $sample1['category_id'];
                                              $comp_id = $sample1['competition_id'];
                                              $comp_name = $sample1['competition_name'];
                                              $id = $this->session->userdata('id');
                                              //I NEED TO GET THE COMPETITION NAME HERE
                                              ?>

                                        <tr id="list">

                                            <?php $CI =& get_instance(); ?>
                                                <?php $CI->load->model('compANDcatModel'); ?>
                                                    <?php $number = $CI->compANDcatModel->countApprovedTeamsDirector($cat_id, $id); ?>

                                                        <td>
                                                            <?php echo $sample1['category_name']?>
                                                        </td>
                                                        <td>
                                                            <?php echo $sample1['category_type']?>
                                                        </td>
                                                        <td>
                                                            <?php echo $sample1['payment'] ?>
                                                        </td>
                                                        <td>
                                                            <?php if($number!=0){ ?>
                                                                <small class="label bg-green"><?php echo $number; ?></small>
                                                            <?php }else{ ?>
                                                                <small class="label bg-red"><?php echo $number; ?></small>
                                                                <?php }?>
                                                        </td>
                                                        <td>

                                                            
                                                            <a class="btn btn-primary" href="<?php echo base_url() ?>teams/viewTeams/<?php echo $cat_id ?>" class="btn btn primary">View</a>
                                                            <?php if($this->session->userdata('status')=='director'){?>

                                                           
                                                            <a class="btn btn-primary" href="<?php echo base_url() ?>categories/editCategoryName/<?php echo $cat_id ?>" class="btn btn primary">Edit</a>
                                                           
                                                            <a class="btn btn-danger" href="<?php echo base_url() ?>categories/deleteCat/<?php echo $cat_id?>/<?php echo $comp_id?>" class="btn btn primary" onClick="return doconfirm();">Delete</a>
                                                            <?php }?>
                                                        </td>
                                        </tr>
                                        <?php
                                    }?>

                            </table>
                            <?php }else{ ?>
                             
                                <div class="box-header with-border">
                                <h3 class="box-title">Categories</h3>
                                <?php if($this->session->userdata('status')=='director' ){?>
                                        <a style="margin-right: 10px;" class="btn btn-primary pull-right" href="<?php echo base_url()?>categories/addCat/<?php echo $IDofComp; ?>">Add Category</a> <!-- categories/addcat -->
                                <?php }?>
                                </div>
                                <div class="box-body">
                                    No categories yet.
                                </div>
                            <?php }?>
                        
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->

                </div>
                <!-- col-md-6 -->

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