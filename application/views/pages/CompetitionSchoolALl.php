<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->
<style>
  
</style>
<body>
  <section id="main" role="main">
    <section class="container">
      
        <br />
        <br />
        <br />

<!-- <div class="box-body">

              <div class="progress">
                
                <div class="progress-bar progress-bar-aqua" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                  <span class="sr-only">30% Complete</span>

                </div>
              </div>
</div> -->

        <h1 class="text-muted mt-0 font-alt" align="center">Competitions</h1>
<!-- <a class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Register</a>
 -->
       
    <div class="text-center" style="margin-bottom:10px; ">
            
   

        <br >
        <table class="table table-hover" id="Tab">
        
            <?php
            foreach($sample->result_array() AS $sample){
            ?>
            <tr>
                <div class="row-lg-3 row-xs-6">
                    <div class="col-lg-3 col-xs-6">
                         <!-- small box -->
                         <div class="small-box bg-aqua">
                            <div class="inner">
                                <?php $aw = $sample['competition_name'] ?>
                                
                                 <h3 style="font-size: 20px;"><?php echo $sample['competition_name']?></h3>
                                <p><?php echo $sample['start_date']?></p>
                                </div>
                                  <a href="<?php echo base_url() ?>competitions/viewCat/<?php echo $aw;?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </tr>
            <?php
            }?>
        </table>
        
     </div>
     
    </section>
  </section>
</body>



        <form method="post" action="<?php echo site_url('competitions/registerSchool'); ?>">

          <!-- Modal -->
          <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <center><h2>Register</h2></center>
              
                </div>


                <div class="modal-body">
                 
                    <ul class="course_nav" >
                      
                        <fieldset>            
                        <!-- ======= DEFAULT INPUT BOX ========== -->
                        <div class="form-group">
                          <label class="col-form-label" for="inputDefault">Code</label>
                          <input type="text" class="form-control" id="inputDefault" name="code">
                         </div>

                        </fieldset>
                    </ul>
                  
                </div>
                <div class="modal-footer">
                                   <!-- ======= SUBMIT BUTTON ========== -->
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </form>
<!-- 
<script>
  $(document).ready(function() {
    
    var navListItems = $('ul.setup-panel li a'),
        allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function(e)
    {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this).closest('li');
        
        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
    });
    
    $('ul.setup-panel li.active a').trigger('click');
    
    // DEMO ONLY //
    $('#activate-step-2').on('click', function(e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $(this).remove();
    })    
});

</script> -->