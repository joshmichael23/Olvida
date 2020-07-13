<html>
<head>
    
    
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
</head>
<body>
<section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Feedback</h3>

  <form method="post" role="form" id="import_csv" enctype="multipart/form-data">
   <!-- <div class="form-group pull-right"> -->
    <!-- <a class="btn btn-primary pull-right" style="margin-bottom:30px; margin-left: 40px">Send Feedback Form</a> -->
    


    <button type="submit" name="import_csv" class="btn btn-primary pull-right " id="import_csv_btn">Import CSV</button>

    <input type="file" class="form-control pull-right" style="width: 100px" name="csv_file" id="csv_file" required accept=".csv" />
    <!-- <label class="pull-right">Select CSV File </label>
     -->
   <!-- </div> -->


  </form>
  <br />

<!--           <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div> -->
        </div>
        <div class="box-body">
            <div id="imported_csv_data"></div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>


</body>
</html>

<script>
$(document).ready(function(){

 var compID = <?php echo $compID; ?>;
 load_data();

 function load_data()
 {
  $.ajax({
   url:"<?php echo base_url(); ?>Feedbacks/load_data/" + compID,
   method:"POST",
   success:function(data)
   {
    $('#imported_csv_data').html(data);
   }
  })
 }

 $('#import_csv').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"<?php echo base_url(); ?>Feedbacks/import/" + compID,
   method:"POST",
   data:new FormData(this),
   contentType:false,
   cache:false,
   processData:false,
   beforeSend:function(){
    $('#import_csv_btn').html('Importing...');
   },
   success:function(data)
   {
    $('#import_csv')[0].reset();
    $('#import_csv_btn').attr('disabled', false);
    $('#import_csv_btn').html('Import Done');
    load_data();
   }
  })
 });
 
});
</script>
