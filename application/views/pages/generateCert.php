
    <body>

              <section class="content-header">
        <h1>
          Generate Certificate
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('login/index') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Generate Certificates</li>
        </ol>
      </section>


                                <section class="content">

                                    <!-- Default box -->
                                    <div class="box">
                                        <div class="box-header with-border">

                                            <form class="pull-right" method="post" action="<?php echo base_url('competitions/generateCertificate'); ?>">

                                                <input type="text" name="searchKeyword" placeholder="Search by keyword..." value="<?php echo $searchKeyword; ?>">
                                                <input type="submit" name="submitSearch" class="btn btn-primary pull-right" value="Search">
                                                <input type="submit" name="submitSearchReset" class="btn btn-primarsy" value="Reset">

                                            </form>
                                        </div>

                                    <div class="box-body">
                                        <?php if($sample->num_rows() > 0){ 
                                              foreach($sample->result_array() as $row){ ?>

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
                                                                          if(date('Y-m-d') < $row['start_date']){
                                                                              echo '<i style="margin-left:10px"class="label bg-red">Done</i>';
                                                                          } 
                                                                          else{
                                                                              echo '<i>&nbsp;</i>';
                                                                          }
                                                                          ?>
                                                                      </p>
                                                          </div>
                                                          <span class="small-box-footer" style="background-color: rgb(53, 124, 165)">
                                                                <a style="color: white" href="<?php echo base_url() ?>Generate/ChoosePrint/<?php echo $compID;?>" class="small-box-footer">View
                                                                      <i class="fa fa-arrow-circle-right"></i>
                                                                </a>
                                                          </span>

                                                      </div>  <!-- small-box -->
                                                  </div><!--  col-lg-3 col-xs-6 -->                                           
                                              </div><!-- row-lg-3 row-xs-6 -->

                                      <?php }
                                      }
                                      else{ ?>
                                        No data found.
                                      <?php } ?>
                                      </div><!-- div box -->
                                      <div class="box-footer">
                                          <?php echo $this->pagination->create_links(); ?>
                                      </div>
                                    </div><!-- /.box-body -->
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
