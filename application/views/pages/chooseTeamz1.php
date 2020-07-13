<body>

    <section class="content-header">
        <h1>
          <?php echo $compName . ": "; ?><small><?php echo $catName; ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>
                <a href="<?php echo base_url('competitions/choosecat/'.$CompID); ?>">
                    <?php echo $compName; ?>
                </a>
            </li>
            <li class="active">Teams</li>
        </ol>
    </section>

    <section id="main" role="main">
        <section class="content">

            <!-- Main content -->

        <?php if($this->session->flashdata('cancel')){ ?>
            <div class="alert alert-alert col-xs-12">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('cancel'); ?>
            </div>
        <?php }?>

        <?php if($this->session->flashdata('request')){ ?>
            <div class="alert alert-success col-xs-12">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('request'); ?>
            </div>
        <?php }?>

        <?php if($this->session->flashdata('error')){ ?>
            <div class="alert alert-danger col-xs-12">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php }?>

            <div class="row" id="totoo">
                <div class="col-md-12">
                    <div class="box">

                        <div class="box-header with-border">
                            <h3 class="box-title">Teams</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body" id="real">
                            <table id="demonyo" class="table table-bordered">

                                <tr>
                                    <th style="width: 200px">Team Name </th>
                                    <th style="width: 200px">Coach </th>
                                    <th>Team Members</th>
                                    <th style="width: 250px"></th>
                                </tr>

                                <?php $CI =& get_instance(); ?>
                                    <?php $CI->load->model('compANDcatModel'); ?>

                                        <?php $i=0; ?>

                                            <?php foreach($sample AS $sample1):?>
                                                <?php $i++; ?>

                                                    <tr id="list">
                                                        <?php $compID = $CompID; ?>
                                                            <td style="font-size:12px">
                                                                <?php echo $sample1->TeamName; ?>
                                                            </td>
                                                            <td style="font-size:12px">
                                                                <?php echo $sample1->Coach; ?>

                                                            </td>
                                                            <td style="font-size:12px">
                                                                <?php echo $sample1->Members; ?>
                                                            </td>

                                                            <td>
                                        <?php 
                                                date_default_timezone_set('Asia/Manila'); 
                                                $curdate = date('Y-m-d');
                                            if($date >= $curdate): 

                                                ?>
                                                                <?php if($CI->compANDcatModel->checkIfRequiresPayment($catID)==false):?>
                                                                    <!-- pag mayong bayad go -->

                                                                    <?php
                                                        $SchoolID = $this->session->userdata('id');
                                                        $Names = $CI->compANDcatModel->getApprovedInCat($catID, $SchoolID);
                                                        $exist = 0;
                                                        foreach($Names->result() as $a){
                                                          if(strpos($sample1->Members, $a->Name) !== false){ 
                                                            $exist++;    
                                                          }
                                                        }
                                                      ?>
                                                                        <!-- kapag nahanap na may sinalihan na ang sarong member SA CAT-->
                                                                        <?php if($exist!=0):?>
                                                                            <small class="label pull-right bg-red">A member already exists in a pending/approved team!</small>
                                                                            <!-- pag mayong sinalihan -->

                                                                            <?php else: 

                                                          $Namez = $CI->compANDcatModel->getApprovedInComp($compID, $SchoolID);
                                                          $exist1 = 0;
                                                          foreach($Namez->result() as $a){
                                                            if(strpos($sample1->Members, $a->Name) !== false){ 
                                                              $exist1++;    
                                                            }
                                                          }

                                                          if($exist1!=0){?>
                                                                                <small class="label pull-right bg-red">Team already exists in another category in this competition!</small>
                                                                                <?php 
                                                          }else{ ?>
                                                                                    <a class="btn btn-primary" href="<?php echo base_url() ?>categories/applyTeam/<?php echo $catID?>/<?php echo $sample1->TeamID?>">Request</a>

                                                                                    <?php }?>

                                                                                        <?php endif; ?>
                                                                                            <?php else: ?>
                                                                                                <?php
                                                        $SchoolID = $this->session->userdata('id');
                                                        $Names = $CI->compANDcatModel->getApprovedInCat($catID, $SchoolID);
                                                        $exist = 0;
                                                        foreach($Names->result() as $a){
                                                          if(strpos($sample1->Members, $a->Name) !== false){ 
                                                            $exist++;    
                                                          }
                                                        }
                                                      ?>
                                                                                                    <!-- kapag nahanap na may sinalihan na ang sarong member SA CAT-->
                                                                                                    <?php if($exist!=0):?>
                                                                                                        <small class="label pull-right bg-red">A member already exists in a pending/approved team!</small>
                                                                                                        <!-- pag mayong sinalihan -->

                                                                                                        <?php else: 

                                                          $Namez = $CI->compANDcatModel->getApprovedInComp($compID, $SchoolID);
                                                          $exist1 = 0;
                                                          foreach($Namez->result() as $a){
                                                            if(strpos($sample1->Members, $a->Name) !== false){ 
                                                              $exist1++;    
                                                            }
                                                          }
                                                          if($exist1>0){?>

                                                                                                            <small class="label pull-right bg-red">A member already exists in another category in this competition!</small>

                                                                                                            <?php 
                                                          }else{ ?>
                                                                                                                <a class="btn btn-primary" data-toggle="modal" data-target="#myModal-<?php echo $sample1->TeamID; ?>">Request</a>
                                                                                                                <?php }?>


                                                                                                                                                                                                                        
                                                                                                        <div class="modal fade" id="myModal-<?php echo $sample1->TeamID; ?>" role="dialog">
                                                                                                            <div class="modal-dialog">
                                                                                                                <div class="modal-content">
                                                                                                                    <div class="modal-header">
                                                                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                                    </div>

                                                                                                                    <div class="register-box">
                                            <?php echo form_open_multipart('categories/UploadPaymentAndJoin/'.$catID.'/'.$sample1->TeamID)?>
                                                <div class="register-logo">
                                                    <b>Upload Payment</b>
                                                </div>

                                                <form>
                                                    <div class="register-box-body">
                                                        <div class="form-group has-feedback">
                                                            <label>Payment</label>
                                                            <input type="file" class="form-control" placeholder="Matriculation Form" name="userfile" size="5000">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                        </div>

                                                        <div class="col-xs-4">
                                                            <button type="submit" class="btn btn-primary">Join</button>
                                                        </div>
                                                    </div>
                                                                                                                            </form>

                                                                                                                            <div class="modal-header">
                                                                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                                                            </div>

                                                                                                                    </div>

                                                                                                                </div>

                                                                                                            </div>


                                                                                                                    <?php endif; ?>

                                                                                                                        <?php endif; ?>

                                                            </td>
                                            <?php else: ?>
                                                    <td></td>
                                            <?php endif; ?>
                                                    </tr>
                                                    <?php endforeach; ?>

                            </table>
                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->

                </div>
                <!-- col-md-6 -->

            </div>

            <!-- Main content -->

            <?php 
                if($approvedANDpending!='nothing'):
                ?>
                <div class="row">

                    <div class="col-md-12">
                        <div class="box">

                            <div class="box-header with-border">
                                <h3 class="box-title">Pending / Approved</h3>
                            </div>
                            <!-- /.box-header -->

                            <div class="box-body">
                                <table class="table table-bordered">

                                    <tr>
                                        <th style="width: 160px">Team Name </th>
                                        <th>Team Members</th>

                                        <th>Status</th>
                                        <th style="width: 100px"></th>
                                    </tr>

                                    <?php $CI =& get_instance(); ?>
                                        <?php $CI->load->model('compANDcatModel'); ?>

                                            <?php $i=0; ?>

                                                <?php foreach($approvedANDpending AS $sample1):?>
                                                    <?php $i++; ?>

                                                        <tr>
                                                            <?php $compID = $CompID; ?>
                                                                <td style="font-size:12px">
                                                                    <?php echo $sample1->team_name; ?>

                                                                </td>

                                                                <td style="font-size:12px">
                                                                    <?php echo $sample1->Names; ?>

                                                                </td>

                                                                <td>

                                                                    <?php if($sample1->status=='pending'){ ?>

                                                                        <small class="label bg-yellow"><?php echo ucwords($sample1->status); ?>
                                                        </small>
                                                                        <?php
                                                        }else{
                                                        ?>
                                                                            <small class="label bg-green"><?php echo ucwords($sample1->status); ?>
                                                        </small>
                                                                    <?php }?>

                                                                </td>
                        <?php 
                                                date_default_timezone_set('Asia/Manila'); 
                                                $curdate = date('Y-m-d');
                                            if($date >= $curdate): 
?>

                                                                <td>
                                                    
                                                                      <?php if($sample1->status=='pending'){ ?>
                                                                    <a class="btn btn-danger" href="<?php echo base_url()?>categories/cancelApply/<?php echo $catID . '/' . $sample1->team_id ?>">Cancel Request</a>
                                                                    <?php }?>
                                                                    <?php if($sample1->payment!=NULL){ ?>
                                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default<?php echo $sample1->slot_id; ?>">
                                                                            Check Payment
                                                                        </button>
                                                                        <?php }?>

                                                                            <div class="modal fade" id="modal-default<?php echo $sample1->slot_id; ?>">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span></button>
                                                                                            <h4 class="modal-title">Payment</h4>
                                                                                        </div>

                                                                                            <?php
                                    $filename = $this->compANDcatModel->getFilenameOfTeamInCat($catID, $sample1->team_id);
                                   echo '<img class="img-responsive" style="height:auto;max-width: 100%;" src="' . base_url( 'uploads/payments/' . $filename) . '">';


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

                                    <?php else: ?>
                                        <td></td>
                                    <?php endif;?>
                                                                </td>

                                                        </tr>
                                                        <?php endforeach; ?>

                                </table>
                            </div>
                            <!-- /.box-body -->

                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- col-md-6 -->

                </div>
                <?php endif; ?>
        </section>
    </section>

</body>

