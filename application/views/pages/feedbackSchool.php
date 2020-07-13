<body style="background-color: gray">

  <script>
$(document).ready(function()
{
    $(window).bind("beforeunload", function() { 
        return "Do you really want to close?"; 
    });
});
</script>

      <?php if($this->session->flashdata('error')){ ?>
        <div class="alert alert-danger col-xs-12">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Error!</strong>
            <?php echo $this->session->flashdata('error'); ?>
        </div>
        <?php }?>

 <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Survey for <?php echo $compname; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">



<form method="post" action="<?php echo base_url('Feedbacks/submitFeedback/')?><?php echo $compID .'/'; ?><?php echo $code; ?>" accept-charset="utf-8" data-parsley-validate=""> 


<label>School Name </label>
<input type="text" name="school_name" class="form-control input-lg" placeholder="Enter school name">

<h4 class="title1"> How satisfied  were you with aspects of the programming competition? </h4>

<table class="text-center" style="width:100%">
  <tr>
    <th> </th>
    <th>Very Dissatisfied</th>
    <th>Dissastisfied</th> 
    <th>Neither</th>
    <th>Satisfied</th>
    <th>Very Satisfied</th>
  </tr>
  <tr>
    <td class="feedback-go">Event Information Dissemenation</td>
    <td><input type="radio" name="option1" value="Very Dissatisfied"> </td>
    <td><input type="radio" name="option1" value="Dissatisfied"></td>
    <td><input type="radio" name="option1" value="Neither"></td>
    <td><input type="radio" name="option1" value="Satisfied"></td>
    <td><input type="radio" name="option1" value="Very Satisfied"></td>
</tr>
<tr>
    <td class="feedback-go">Registration Process</td>
    <td><input type="radio" name="option2" value="Very Dissatisfied"> </td>
    <td><input type="radio" name="option2" value="Dissatisfied"></td>
    <td><input type="radio" name="option2" value="Neither"></td>
    <td><input type="radio" name="option2" value="Satisfied"></td>
    <td><input type="radio" name="option2" value="Very Satisfied"></td>
</tr>
<tr>
    <td class="feedback-go">Programming Competition Problems</td>
    <td><input type="radio" name="option3" value="Very Dissatisfied"> </td>
    <td><input type="radio" name="option3" value="Dissatisfied"></td>
    <td><input type="radio" name="option3" value="Neither"></td>
    <td><input type="radio" name="option3" value="Satisfied"></td>
    <td><input type="radio" name="option3" value="Very Satisfied"></td>
</tr>
<tr>
    <td class="feedback-go">Time allocated for problems to be solved</td>
    <td><input type="radio" name="option4" value="Very Dissatisfied"> </td>
    <td><input type="radio" name="option4" value="Dissatisfied"></td>
    <td><input type="radio" name="option4" value="Neither"></td>
    <td><input type="radio" name="option4" value="Satisfied"></td>
    <td><input type="radio" name="option4" value="Very Satisfied"></td>
</tr>
<tr>
    <td class="feedback-go">Event Facilitators</td>
    <td><input type="radio" name="option5" value="Very Dissatisfied"> </td>
    <td><input type="radio" name="option5" value="Dissatisfied"></td>
    <td><input type="radio" name="option5" value="Neither"></td>
    <td><input type="radio" name="option5" value="Satisfied"></td>
    <td><input type="radio" name="option5" value="Very Satisfied"></td>
</tr>
<tr>
    <td class="feedback-go">Date and Time of the Competition</td>
    <td><input type="radio" name="option6" value="Very Dissatisfied"> </td>
    <td><input type="radio" name="option6" value="Dissatisfied"></td>
    <td><input type="radio" name="option6" value="Neither"></td>
    <td><input type="radio" name="option6" value="Satisfied"></td>
    <td><input type="radio" name="option6" value="Very Satisfied"></td>
</tr>
<tr>
    <td class="feedback-go">Venue and Facilities</td>
    <td><input type="radio" name="option7" value="Very Dissatisfied"> </td>
    <td><input type="radio" name="option7" value="Dissatisfied"></td>
    <td><input type="radio" name="option7" value="Neither"></td>
    <td><input type="radio" name="option7" value="Satisfied"></td>
    <td><input type="radio" name="option7" value="Very Satisfied"></td>
</tr>

</table>
<h4 class="title1"> Overall, how satisfied are you with the flow of the programming competition? </h4>
<div class="table-2 container-fluid">
    <div class="row">
        <div class="col-lg-1">   </div>
        <div class="col-lg-1"> 1 </div>
        <div class="col-lg-1"> 2 </div>
        <div class="col-lg-1"> 3 </div>
        <div class="col-lg-1"> 4 </div>
        <div class="col-lg-1"> 5 </div>
        <div class="col-lg-1">   </div>
    </div>
    <div class="row">
    <div class="col-lg-1"> Very Dissastisfied </div>
    <div class="col-lg-1"><input type="radio" name="option8" value="1"></div>
    <div class="col-lg-1"><input type="radio" name="option8" value="2"></div>
    <div class="col-lg-1"><input type="radio" name="option8" value="3"></div>
    <div class="col-lg-1"><input type="radio" name="option8" value="4"></div>
    <div class="col-lg-1"><input type="radio" name="option8" value="5"></div>
    <div class="col-lg-1"> Very Satisfied </div>
    </tr>
</div>
                   

 <h4 class="title1" for="likes">What did you like most/least about the event?:</h4>
     <input name="likes" type="text" class="form-control input-lg" placeholder="Short answer text">
 
 
                  

 <h4 class="title1" for="expectations">What is/are your expectations for the next programming competition?:</h4>
     <input name="expectations" type="text" class="form-control input-lg" placeholder="Short answer text">
    
 
  
                   

 <h4 class="title1" for="suggestions">Do you have any other suggestions of further improvements for the organizers? Programming competition flow?:</h4>
     <input name="suggestions" type="text" class="form-control input-lg" placeholder="Short answer text">

     <button type="submit" class="btn btn-block btn-primary" href="$">Submit</button>

  

</form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>

</body>
