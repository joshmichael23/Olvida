<!-- <style>


body{
  margin: 0;
  padding:0;

}
.login-box{
  width:280px;
}
.textbox{
  
  padding: 8px 0;
  margin: 8px 0;
  }
  .textbox input{
    width:320px;
    margin-bottom:20px;
    height:40px;
  }

.btn{
  width:320px;
  border:2px 
  padding:5px;
  font-size:18px;
  cursor:pointer;
  margin-top:10px;
}
</style> -->
<body>


    <div id="container">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Committees</h3>

          <?php if($this->session->flashdata('success')){ ?>
        <div class="alert alert-success col-xs-12">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php }
    ?>

    <!-- </?php if($this->session->flashdata('error')){ ?>
        <div class="alert alert-danger col-xs-12">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
        </div>
    </?php }
    ?> -->
    <?php $this->load->library('form_validation'); ?>
    <?php echo validation_errors('<div class="alert alert-danger" style="width:80%;">','</div>');?>
            </div>
           <div class="box-body">
                <table id ="datatablezz" class="table table-bordered table-striped" >
 

                  <a style="margin-bottom: 20px" data-toggle="modal" data-target="#myModal3" class="btn btn-primary">Create Committee</a>

                    <thead>
                        <tr>
                            <td>Username</td>
                            <td>Password</td>
                            <td>Role</td>
                            <td>Action</td>
                        </tr>
                    </thead>


                </table>


            </div>
        </div>
    </div>


     <script type="text/javascript">

        $(document).ready(

            function(){
                $('#datatablezz').DataTable({
                "processing":true,
                "serverSide":true,
                "bSort" : true,
                "pageLength": 10,
                "lengthChange":false,

                "ajax":{
                "url": "<?= base_url() ?>committies/get_committee",
                "type": "POST"
                },

                "columns": [
                    {"data": "username"},
                    {"data": "password"},
                    {"data": "role"},
                    {"data": "delete"}
                ]
                
                });
            }

    );

    </script>



<div class="modal fade" id="myModal3" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          
                        </div>


                        <div class="register-box">
  <div class="register-logo">
    <b>Create Committee</b>
  </div>

  <div class="register-box-body">
    <?php echo form_open_multipart('Committies/regCommittee')?>
      <div class="form-group has-feedback">
        
        <label>Username</label>
                  <input name="username" type="text" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>"  data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your username" data-parsley-required>
                  <span class="text-danger">
      </div>
          
      
      <div class="form-group">
        <label>Password</label>
          <input name="password" type="password" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your password" data-parsley-required>
          <span class="text-danger">
      </div>

      <div class="form-group">
<label>Confirm Password </label>
                  <input name="password1" type="password" class="form-control" placeholder="Password" value="<?php echo set_value('password1'); ?>" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your password" data-parsley-required>
                 </div>

      


      <div class="form-group">
        <label>Role: </label>
                  <select name = "role" style="margin-bottom: 20px">
          <option value="Technical Committee">Technical Committee</option>
          <option value="Secretariat Committee">Secretariat Committee</option>
        </select>
      </div>
      
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