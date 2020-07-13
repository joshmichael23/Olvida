<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>


<link rel="stylesheet" href="<?php echo base_url()."assets/";?> bower_components/select2/dist/css/select2.min.css">
<script src="<?php echo base_url()."assets/";?>bower_components/select2/dist/js/select2.full.min.js"></script>


<body>




          <?php if($this->session->flashdata('message')){ ?>
            <div class="alert alert-danger">  
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Error!</strong> <?php echo $this->session->flashdata('message'); ?>
            </div>
        <?php }?>

        <?php if($this->session->flashdata('create')){ ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('create'); ?>
            </div>
        <?php }?>
        <?php $this->load->library('form_validation'); ?>
    <?php echo validation_errors('<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a>','</div>');?>
        <?php if($this->session->flashdata('edit')){ ?>
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('edit'); ?>
            </div>
        <?php }?>

        <?php if($this->session->flashdata('delete')){ ?>
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('delete'); ?>
            </div>
        <?php }?>
  
            <section class="content-header">
        <h1>
        Teams
        </h1>
        <br>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Teams</li>
        </ol>
      </section>


    <section id="content">
        <div class="box">
<!--           <div class="text-left" style="margin-bottom:10px; "> -->
<!--               <div style="padding-left:20px"> -->


                <div class="box-header">
                  <a class="btn btn-primary" data-toggle="modal" data-target="#myModal3">Create Team</a>
                  <br>
                </div>          
<!--               </div> -->
 <!--          </div> -->

           <div class="box-body">
                <table id ="datatables" style="width:100%" class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <td style="width:200px">Team Name</td>
                            <td>Members</td>
                            <td>Coach</td>
                            <td style="width:100px">Action</td>  
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
      </section>


        
    <div>
       
                  <!-- Modal -->
                  <div class="modal fade" id="myModal3" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          
                        </div>


                        <div class="register-box">
  <div class="register-logo">
    <b>Create Team</b>
  </div>

  <div class="register-box-body">
    <?php echo form_open_multipart('School_teams/createTeam/')?>
      <div class="form-group has-feedback">
        
        <input type="text" name="teamname" class="form-control" value="<?php echo set_value('teamname'); ?>" placeholder="Team Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
          
      
      <div class="form-group">
        <select class="form-control select2" id="participants" multiple name="members[]"  multiple data-placeholder="Select Member" style="width: 100%;">
            <?php
            foreach($sample as $row)
            { 
              echo '<option value="'.$row->participant_id.'">'.$row->Name.'</option>';
            }
            ?>
        </select>
      </div>
     <!--  <center><?php echo "or"; ?></center>
        <br>
      <div class="form-group">

        <input type="text" name="NewMember" class="form-control" placeholder="Create new participant/s">
      

      </div> -->


      <div class="form-group">
        <select class="form-control select2" id="josh" multiple="multiple" name="coach"  data-placeholder="Select Coach" style="width: 100%;">
            <?php
            foreach($sample2 as $row)
            { 
              echo '<option value="'.$row->coach_id.'">'.$row->Name.'</option>';
            }
            ?>
        </select>
      </div>
      



      <div class="row">
        <div class="col-xs-4">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>



     </div>
                    
                                 <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          
                        </div>
    </div>
  <script>


  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2(
    // {
    //   maximumSelectionLength: 3
    // }
    )

    $('#josh').select2(
    {
      maximumSelectionLength: 1
    }
    )

    $('#participants').select2(
    {
      maximumSelectionLength: 3
    }
    )


    })

  $(document).ready(function(){

    

        $('#datatables').DataTable({
        "processing":true,
        "serverSide":true,

        "language":{
          "emptyTable": "No data available in table",
          "sEmptyTable": "No data available in table",
          "infoEmpty": "No data available in table"
        },

        "ajax":{
        "url": "<?= base_url('School_teams/get_Schoolteams/') ?>",
        "type": "POST",
        },

        "columns": [
            {"data": "team_name"},
            {"data": "members"},
            {"data": "coach"},
            {"data": "action"}
        ]
        
        });
  

  });

  // validate if input is 1 or 3
  $('form').on('submit', function(){
     var minimum = 2;

     if($(".select").select2('data').length>=minimum){
         alert('Submited...')
         return true;
     }else {
       alert('Please shoose at least '+minimum+' item(s)')
         return false;
     }
})

</script>
</body>

