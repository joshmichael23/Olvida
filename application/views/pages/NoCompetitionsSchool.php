<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->
<style>
  
</style>
<body>
  <section id="main" role="main">
    <section class="content">

        <!-- <a class="btn btn-primary" style="margin-left:15px;" align="left" href="insertCode">Register</a>
         -->
        <?php if($this->session->flashdata('success')){ ?>
            <div class="alert alert-success col-xs-12">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
            </div>
            <br>
        <?php }?>

        <?php if($this->session->flashdata('error')){ ?>
            <div style="margin-top: 30px" class="alert alert-danger col-xs-12">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
            </div>
            <br>
        <?php }?>
        <a class="btn btn-primary" data-toggle="modal" style="margin-top: 30px" data-target="#myModal2">Register</a>


        <h1 class="text-muted mt-0 font-alt" align="center"><?php echo $header; ?></h1>


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
    

         
    </section>
  </section>
</body>
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