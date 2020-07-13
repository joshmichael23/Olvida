

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
</head>
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
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('delete'); ?>
            </div>
        <?php }?>

                    <section class="content-header">
        <h1>
        Participants
        </h1>
        <br>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Participants</li>
        </ol>
      </section>

    <section id="content">
        <div class="box">
          <div class="box-header" style="padding-left:20px">
              <!-- <h1 class="box-title">All Participants</h1> -->
              
             <a class="btn btn-primary" data-toggle="modal" data-target="#myModal3">Create Participant</a>
              <br>          
          </div>
              <div class="box-body">
                <table id ="datatables" class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                          <td>Name</td>
                          <td>Contact Number</td>
                          <td>Email</td>
                          <td>Address</td>
                          <td>Matriculation Form</td>
                          <td>Action</td>
                      </tr>
                    </thead>
                </table>
            </div>
        </div>      
    </section>

    <!-- MODAL DAW FOR NEW EDIT -->
      <!-- END MODAL NOT QUITE SURE -->

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
    <a href="../../index2.html"><b>Create Participant</b></a>
  </div>

  <div class="register-box-body">
    <?php echo form_open_multipart('School_teams/CreateParticipant/')?>
      <div class="form-group has-feedback">
        <input type="text" name="firstname" class="form-control" value="<?php echo set_value('firstname'); ?>" placeholder="First Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="middlename" class="form-control" value="<?php echo set_value('middlename'); ?>" placeholder="Middle Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="lastname" class="form-control" value="<?php echo set_value('lastname'); ?>" placeholder="Last Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="address" class="form-control" value="<?php echo set_value('address'); ?>" placeholder="Address">
        <span class="fa fa-fw fa-map-pin form-control-feedback" style="margin-right:8px"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="contactno" class="form-control" value="<?php echo set_value('contactno'); ?>" placeholder="Contact Number">
        <span class="fa fa-fw fa-phone form-control-feedback" style="margin-right:8px"></span>
      </div>

      <div class="form-group has-feedback">
        <label>Matriculation Form</label>
        <input type="file" class="form-control" placeholder="Matriculation Form" name="userfile" size="2000">


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


<div>
       
                  <!-- Modal -->
     
<!-- 
    <div id="userModal" class="modal fade">
      <div class="model-dialog">
        <form method="post" id="user_form">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add User</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
              <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </form>
      </div>
    </div>             

 -->
     <script type="text/javascript">
        var editor; // use a global for the submit and return data rendering in the examples

        $('form').attr('autocomplete', 'off');

        $(document).ready(function(){


        var x = '<?= base_url() ?>School_teams/get_participants/' + '<?php echo $id; ?>';

        $('#datatables').DataTable({
        "processing":true,
        "serverSide":true,
        "bSort" : true,

        "ajax":{
        "url": x,
        "type": "POST",
        // "data": {
        //         "SchoolID": "<?php echo $id; ?>"
        // }
    },
        "columns": [
            {"data": "FullName"},
            {"data": "contact_no"},
            {"data": "email"},
            {"data": "address"},
            {"data": "edit"},
            {"data": "delete"},
            // {
            //     "data": null,
            //     "className": "center",
            //     "defaultContent": '<a href="" class="editor_edit">Edit</a> / <a href="" class="editor_remove">Delete</a>'
            // }
        ],

        "aoColumnDefs" : [ 
            {"bSortable" : false,
              "aTargets" : [4,5],
            } ],

            
        
    });
    });





      function doconfirm()
{
    job=confirm("Are you sure to delete permanently?");
    if(job!=true)
    {
        return false;
    }
}

</script>
    </body>
