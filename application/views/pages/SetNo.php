<body>

<br>
   <!-- </?php if($this->session->flashdata('error')){ ?>
                        <center>
                            <div class="alert alert-danger col-xs-12" style="margin-top: 20px">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <strong>Creation failed!</strong>
                                </?php echo $this->session->flashdata('error'); ?>

                            </div>
                        </center>
  </?php }?> -->
  <section id="main" role="main" style="margin-top: 30px">
    <section class="container">



        <center>
        <div class="row">
          <div class="col-md-3">

          </div>

          <div style="align-content: " class="col-md-5">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                              <div class="box-body">
                  <div class="progress-group">
                    <span class="progress-text">Step 2: Set Number of Categories</span>
<!--                     <span class="progress-number"><b>160</b>/200</span> -->

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-#3c8dbc" style="width: 60%"></div>
                    </div>
                  </div>
            </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
              <form method="post" class="form-horizontal" action="<?php echo base_url('competitions/processNo')?>" accept-charset="utf-8"> 
              <?php $this->load->library('form_validation'); ?>
              <?php echo validation_errors('<div class="alert alert-danger">','</div>');?>
              <div class="form-group">
                
                  <label># of Categories</label>
                  <input type="text" name="categorynumber" id="cat_no" class="form-control input-lg" value="<?php echo set_value('categorynumber'); ?>" style="width: 50px" maxlength="1">
                
               </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" href="$">Next</button>
                  </div>
              </form>
                
              </div>
          </div>
          <div class="col-md-5">
          </div>  
          </div>       
    </section>
  </section>
