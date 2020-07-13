<link rel="stylesheet" href="<?php echo base_url()."assets/";?> bower_components/select2/dist/css/select2.min.css">
 <!-- SELECT 2 -->
<script src="<?php echo base_url()."assets/";?>bower_components/select2/dist/js/select2.full.min.js"></script>



    <body>

            <section class="content-header">
        <h1>
          Categories
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url('competitions/index'); ?>">Competitions</a></li>
          <li><a href="<?php echo base_url()?>competitions/viewCat/<?php echo $compName; ?>"><?php echo $compName; ?></a></li>
          <li><?php echo $catname; ?></li>
          <li class="active">Edit Category</li>
        </ol>
      </section>



 <section class="content">
        <div class="col-md-6 col-md-offset-3">
          <div class="box">
            <div class="box-header with-border">
              <center>
              <h1 class="box-title">Edit Category</h1>
            </center>
            </div>
            <!-- /.box-header -->
            <div class="box-body">


       <?php
            foreach($sample1->result_array() AS $sample){
            ?>
      
        

            <?php $aw = $sample['category_id']; 
              $aw2 = $sample['category_name'];
              $aw3 = $sample['category_type'];
              $aw4 = $sample['payment'];
              if($aw3=='Individual')
                $typeOption2 = 'Group';
              else
                $typeOption2 =  'Individual';

              if($aw4=='Yes')
                $Option2 = 'No';
              else
                $Option2 = 'Yes';

              
            ?>
            <?php
            }?>
     
                    <div class="register-box-body">
                        <form method="post" action="<?php echo base_url()?>categories/updateCat/<?php echo $aw?>" accept-charset="utf-8">  

                        
                      
                            
                            <label>Category Name</label>
                            <div class="form-group has-feedback">
                              <input class="form-control" value="<?php echo $aw2; ?>" name="CompetitionName" class="form-control" type="text" width="25">
                              <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                                        
                            <label>Category Type</label>
                            <div class="form-group has-feedback">
                                <select class="form-control" name="CatType" data-placeholder="Choose Type" style="width: 100%;">
                                    <option selected value="<?php echo $aw3; ?>"><?php echo $aw3; ?></option>
                                    <option value="<?php echo $typeOption2; ?>"><?php echo $typeOption2; ?></option>
                                </select>
                            </div>

                            <label>Require Payment</label>
                            <div class="form-group has-feedback">
                                <select class="form-control" name="Payment" data-placeholder="Choose Type" style="width: 100%;">
                                    <option selected value="<?php echo $aw4; ?>"><?php echo $aw4; ?></option>
                                    <option value="<?php echo $Option2; ?>"><?php echo $Option2; ?></option>
                                </select>
                            </div> 
                            <div style="margin-bottom: 20px">
                              <small style="color: red;">Warning! Changing the category's type will kick all of the approved teams!</small>
                            </div>

                            <div class="row">    
                                <div class="col-xs-4 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat" onClick="return doconfirm();">Submit</button>
                                </div>
                            </div>
                                
                                                  
                            
                        </form>
                  </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">

            </div>
          </div>
        </div>

  </section>
</body>


<script>
    function doconfirm()
    {
        job=confirm("Are you sure you want to make the changes?");
        if(job!=true)
        {
            return false;
        }
    }
</script>
