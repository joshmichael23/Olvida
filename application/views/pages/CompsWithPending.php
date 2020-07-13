
    <body>

      <section class="content-header">
        <h1>
          Pending Requests
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Pending Requests</li>
      <!--     <li><a href="<?php echo base_url()?>competitions/viewCat/<?php echo $compName; ?>">Categories</a></li>
       --></ol>
       <?php if($this->session->flashdata('approved')){ ?>
        <div class="alert alert-success col-xs-12">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Success!</strong>
            <?php echo $this->session->flashdata('approved'); ?>
        </div>
        <?php }?>

        <?php if($this->session->flashdata('disapproved')){ ?>
        <div class="alert alert-success col-xs-12">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Success!</strong>
            <?php echo $this->session->flashdata('disapproved'); ?>
        </div>
        <?php }?>
      </section>

  <section id="main" role="main">

  
  
    <section class="content">

                                    <!-- Default box -->
                                    <div class="box">
                                        <div class="box-header with-border">

                                            <form class="pull-right" method="post" action="<?php echo base_url('competitions/pendingrequests'); ?>">

                                                <input type="text" name="searchKeyword" placeholder="Search by keyword..." value="<?php echo $searchKeyword; ?>">
                                                <input type="submit" name="submitSearch" class="btn btn-primary pull-right" value="Search">
                                                <input type="submit" name="submitSearchReset" class="btn btn-primarsy" value="Reset">

                                            </form>
                                        </div>

                                    <div class="box-body">
                                        <?php if(!empty($sample)){ 
                                              foreach($sample as $row){ ?>

                                              <?php $id = $row['competition_id']; ?>
                                              <a href="<?php echo base_url('categories/pendingCategories/'); ?><?php echo $id; ?>">

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
                                                                      <h3 style="font-size: 12px;">
                                                                      
                                                                  <?php }?>
                                                                    <?php 
                                                                    echo $row['competition_name'];
                                                                    
                                                                    ?>
                                                                  </h3>


                                                                      <p>
                                                                          <?php echo $row['start_date']; ?>
                                                                          <?php date_default_timezone_set('Asia/Manila'); 
                                                                          if(date('Y-m-d') > $row['start_date']){
                                                                              echo '<i style="margin-left:10px"class="label bg-red">Done</i>';
                                                                          } 
                                                                          else{
                                                                              echo '<i>&nbsp;</i>';
                                                                          }
                                                                          ?>
                                                                      </p>
                                                          </div>


                                <?php $CI =& get_instance(); ?>
                                <?php $CI->load->model('compANDcatModel'); ?>
                                <?php $result2 = $CI->compANDcatModel->countPendingInComp($compID); ?>
                                <?php $result3 = $CI->compANDcatModel->countPendingInCompWithSentEmail($compID); ?>

                             
                                

                          <span class="small-box-footer bg-light-blue-active color-palette">
                              
                              
                                  <?php if($result2!=0){?>
                                  <span class="label label-warning" style="background-color: #3c8dbc">
                                      
                                       <?php echo $result2 . " Waiting for Approval"; ?>
                                    
                                  </span>
                                  <?php };?>

                                  
                              
                              
                                <?php if($result3!=0){?>
                                  <span class="label label-success" style="background-color: #3c8dbc">
                                        <?php echo $result3 . " Email Sent"; ?>
                                  </span>
                                <?php }?>
                              


                          </span>

                                                      </div>  <!-- small-box -->
                                                  </div><!--  col-lg-3 col-xs-6 -->                                           
                                              </div><!-- row-lg-3 row-xs-6 -->
                                            </a>

                                      <?php }
                                      }
                                      elseif($sample==FALSE){ ?>
                                        No data found.
                                      <?php } ?>
                                      </div><!-- div box -->
                                      <div class="box-footer">
                                          <?php echo $this->pagination->create_links(); ?>
                                      </div>
                                    </div><!-- /.box-body -->
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
