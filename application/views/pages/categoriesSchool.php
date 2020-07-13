



<body>



      <section class="content-header">
        <h1>
          <?php echo $name; ?>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url('competitions/index'); ?>">My Competitions</a></li>
          <li><?php echo $name; ?></li>
        </ol>
      </section>

  <section id="main" role="main">
    <section class="container">

             <div class="row" id="totoo" style="margin-top:40px">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="box">

                                <div class="box-header with-border">
                                    <h3 class="box-title">Categories</h3>
                                </div>
                                <!-- /.box-header -->

                                <div class="box-body" id="real">
                                    <table id="demonyo" class="table table-bordered">

                                        <tr>
                                            <th style="width: 200px">Category Name</th>

                                        </tr>


                                        <?php
                                        foreach($sample->result_array() AS $sample1){
                                        ?>
                                        <tr>
                                            <?php $name = $sample1['category_name']; 
                                                  $cat_id = $sample1['category_id'];
                                                  $comp_id = $sample1['competition_id'];
                                                  $id = $sample1['category_id'];
                                                  ?>
                                            <td><?php echo $sample1['category_name']?></td>
                                            <td>
                                              <center>
                                              <a class="btn btn-primary" href="<?php echo base_url() ?>categories/viewteams/<?php echo $id; ?>">View</a></center>
                                        </tr>
                                        <?php
                                        }?>
                                        

                                    </table>
                                </div>
                                <!-- /.box-body -->


                            </div>
                            <!-- /.box -->

                        
                
                          </div>  <!-- col-md-6 -->

                </div>

     
    </section>
  </section>
</body>