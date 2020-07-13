<body>


              <section class="content-header">
        <h1>
          Pending Requests
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url('competitions/pendingrequests'); ?>">Pending Requests</a></li>
          <li class="active"><?php echo $compname; ?></li>
       </ol>
      </section>




  <section id="main" role="main">
    <section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $compname?></h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th style="width: 250px">Category</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
               
                 <tr>
            <?php
            foreach($sample->result_array() AS $sample1){
            ?>
                      <?php $name = $sample1['category_name']; 
                      $cat_id = $sample1['category_id'];
                      $comp_id = $sample1['competition_id'];
                      // $comp_name = $sample1['competition_name'];
                      // //I NEED TO GET THE COMPETITION NAME HERE
                      ?>

                                <?php $CI =& get_instance(); ?>
                                <?php $CI->load->model('compANDcatModel'); ?>
                                <?php $result2 = $CI->compANDcatModel->countPendingInCat($cat_id); 
                                      $result3 = $CI->compANDcatModel->countPendingInCatEmailSent($cat_id); 
                                ?>


                             
                                </div>


            

                <td style="text-align: left;"><?php echo $sample1['category_name']?></td>
                <td style="text-align: left;">

                  <span class="small-box-footer">

                        <?php if($result2!=0){ ?>
                          <span class="label label-primary"><?php echo $result2 . " Pending Request"; ?></span> 
                        <?php } ?>
                        <?php if($result3!=0){ ?>
                          <span class="label label-warning"><?php echo $result3 . " Email Sent"; ?></span> 
                        <?php } ?>

                  </span></td>
                <td style="text-align: left;">
                      <a class="btn btn-primary" href="<?php echo base_url() ?>categories/PendingTeamsInCategory/<?php echo $cat_id ?>" class="btn btn primary">View</a>
                </td>
            </tr>
                        <?php
            }?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
        
       


     
    </section>
  </section>
</body>

<script>
function doconfirm()
{
    job=confirm("Are you sure to delete permanently?");
    if(job!=true)
    {
        return false;
    }
}
</script>