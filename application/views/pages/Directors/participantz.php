<body>


      <section class="content-header">
        <h1>
          Pending Requests
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url('competitions/pendingrequests'); ?>">Pending Requests</a></li>
          <li><a href="<?php echo base_url(); ?>categories/pendingcategories/<?php echo $compID; ?>"><?php echo $compname?> : <?php echo $catname; ?></a></li>
          <li><a href="<?php echo base_url(); ?>categories/PendingTeamsInCategory/<?php echo $catID; ?>">Teams</a></li>
          <li><a class="active"><?php echo $teamname; ?></a></li>
          
       </ol>
      </section>

      <section id="main" role="main">
    <section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $compname  . ': ' . $catname; ?><i class="fa fa-fw fa-angle-right"></i><?php echo $teamname; ?></h3>

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
               <table class="table table-hover" id="Tab" style="margin-bottom: 20px">
            <tr>
                <th>Name</th>
                <th>Matriculation Form</th>
            </tr>
            <tr>
            <?php
            foreach($sample->result_array() AS $sample1){
            ?>
                      <?php $name = $sample1['Name']; 
                      // $cat_id = $sample1['address'];
                      $comp_id = $sample1['participant_id'];
                      $file = $sample1['file_name'];
                      // $teamid = $sample1['team_id'];
                      // $comp_name = $sample1['competition_name'];
                      // //I NEED TO GET THE COMPETITION NAME HERE
                      ?>
            

                <td style="width:50%"><?php echo $name; ?></td>
                <td style="width: 50%">

                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">View Matriculation
                  </button>

                  <div class="modal fade" id="modal-default">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Matriculation Form</h4>
                              </div>

                              

                               
                                <?php $teamID = $sample1['team_id']; ?>
                                  

                                <?php
                                $filename = $this->compANDcatModel->getFilenameOfTeamInCat($catID, $teamID);
                                   echo '<img class="img-responsive" style="height:auto;max-width: 100%;" src="' . base_url( 'uploads/matriculations/' . $file) . '">';

                                ?> 

                                <div class="modal-footer">
                                
                                <center>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </center>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                </td>
                </tr>
                        <?php
            }?>
        </table>

        <center>
     <a style="margin-bottom: 20px;" class="btn btn-primary" href="<?php echo base_url()?>categories/accept/<?php echo $teamID; ?>/<?php echo $catID; ?>" class="btn btn primary" onclick="return doconfirm()">Send Code</a>   
     <!-- <a class="btn btn-danger"  onclick="return doconfirm2()"" href="<?php echo base_url() ?>" class="btn btn primary">Disapprove --></a>

    </center>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
        
       


     
    </section>
  </section>


  <section id="main" role="main">
    <section class="container">

        <div class="text-center" style="margin-bottom:10px; ">

        <h1 class="text-muted mt-0 font-alt"></h1>
       

     </div>

     
            
     
    </section>
  </section>
</body>

<script>
function doconfirm()
{
    job=confirm("Are you sure all matriculations are up to date?");
    if(job!=true)
    {
        return false;
    }
}

function doconfirm2()
{
    job=confirm("Are you sure to disapprove request?");
    if(job!=true)
    {
        return false;
    }
}
</script>