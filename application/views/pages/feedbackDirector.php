<?php

for($i=1; $i<8; $i++):
  $response[$i]['Very Satisfied'] = 0;
  $response[$i]['Satisfied'] = 0;
  $response[$i]['Neither'] = 0;
  $response[$i]['Dissatisfied'] = 0;
  $response[$i]['Very Dissatisfied'] = 0;



    if($i==1){
      if($resultFrom1!='false'):
          foreach($resultFrom1 as $row): 
                  if($row['response'.$i]=='Very Satisfied')
                    $response[$i]['Very Satisfied'] += $row['no'];
                  else if($row['response'.$i]=='Satisfied')
                    $response[$i]['Satisfied'] += $row['no'];
                  else if($row['response'.$i]=='Neither')
                    $response[$i]['Neither'] += $row['no'];
                  else if($row['response'.$i]=='Dissatisfied')
                    $response[$i]['Dissatisfied'] += $row['no'];
                  else if($row['response'.$i]=='Very Dissatisfied')
                    $response[$i]['Very Dissatisfied'] += $row['no'];
          endforeach; 
      endif;
    }elseif($i==2){
      if($resultFrom2!='false'):
        foreach($resultFrom2 as $row): 
                if($row['response'.$i]=='Very Satisfied')
                  $response[$i]['Very Satisfied'] += $row['no'];
                else if($row['response'.$i]=='Satisfied')
                  $response[$i]['Satisfied'] += $row['no'];
                else if($row['response'.$i]=='Neither')
                  $response[$i]['Neither'] += $row['no'];
                else if($row['response'.$i]=='Dissatisfied')
                  $response[$i]['Dissatisfied'] += $row['no'];
                else if($row['response'.$i]=='Very Dissatisfied')
                  $response[$i]['Very Dissatisfied'] += $row['no'];
        endforeach; 
      endif;
    }elseif($i==3){
      if($resultFrom3!='false'):
            foreach($resultFrom3 as $row): 
              if($row['response'.$i]=='Very Satisfied')
                $response[$i]['Very Satisfied'] += $row['no'];
              else if($row['response'.$i]=='Satisfied')
                $response[$i]['Satisfied'] += $row['no'];
              else if($row['response'.$i]=='Neither')
                $response[$i]['Neither'] += $row['no'];
              else if($row['response'.$i]=='Dissatisfied')
                $response[$i]['Dissatisfied'] += $row['no'];
              else if($row['response'.$i]=='Very Dissatisfied')
                $response[$i]['Very Dissatisfied'] += $row['no'];
      endforeach; 
      endif;
    }elseif($i==4){
      if($resultFrom4!='false'):
            foreach($resultFrom4 as $row): 
              if($row['response'.$i]=='Very Satisfied')
                $response[$i]['Very Satisfied'] += $row['no'];
              else if($row['response'.$i]=='Satisfied')
                $response[$i]['Satisfied'] += $row['no'];
              else if($row['response'.$i]=='Neither')
                $response[$i]['Neither'] += $row['no'];
              else if($row['response'.$i]=='Dissatisfied')
                $response[$i]['Dissatisfied'] += $row['no'];
              else if($row['response'.$i]=='Very Dissatisfied')
                $response[$i]['Very Dissatisfied'] += $row['no'];
      endforeach;
      endif; 
    }elseif($i==5){
      if($resultFrom5!='false'):
            foreach($resultFrom5 as $row): 
              if($row['response'.$i]=='Very Satisfied')
                $response[$i]['Very Satisfied'] += $row['no'];
              else if($row['response'.$i]=='Satisfied')
                $response[$i]['Satisfied'] += $row['no'];
              else if($row['response'.$i]=='Neither')
                $response[$i]['Neither'] += $row['no'];
              else if($row['response'.$i]=='Dissatisfied')
                $response[$i]['Dissatisfied'] += $row['no'];
              else if($row['response'.$i]=='Very Dissatisfied')
                $response[$i]['Very Dissatisfied'] += $row['no'];
      endforeach;
      endif; 
    }elseif($i==6){
      if($resultFrom6!='false'):
            foreach($resultFrom6 as $row): 
              if($row['response'.$i]=='Very Satisfied')
                $response[$i]['Very Satisfied'] += $row['no'];
              else if($row['response'.$i]=='Satisfied')
                $response[$i]['Satisfied'] += $row['no'];
              else if($row['response'.$i]=='Neither')
                $response[$i]['Neither'] += $row['no'];
              else if($row['response'.$i]=='Dissatisfied')
                $response[$i]['Dissatisfied'] += $row['no'];
              else if($row['response'.$i]=='Very Dissatisfied')
                $response[$i]['Very Dissatisfied'] += $row['no'];
      endforeach; 
    endif;
    }elseif($i==7){
      if($resultFrom7 != 'false'):
            foreach($resultFrom7 as $row): 
              if($row['response'.$i]=='Very Satisfied')
                $response[$i]['Very Satisfied'] += $row['no'];
              else if($row['response'.$i]=='Satisfied')
                $response[$i]['Satisfied'] += $row['no'];
              else if($row['response'.$i]=='Neither')
                $response[$i]['Neither'] += $row['no'];
              else if($row['response'.$i]=='Dissatisfied')
                $response[$i]['Dissatisfied'] += $row['no'];
              else if($row['response'.$i]=='Very Dissatisfied')
                $response[$i]['Very Dissatisfied'] += $row['no'];
      endforeach; 
    endif;
    }

endfor;
?> 



    <section class="content-header">
        <h1>
          Feedbacks for <?php echo $compName; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('login/index') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Feedbacks for <?php echo $compName; ?></li>
        </ol>
    </section>

   <section class="content">

    <div class="row">
        <div class="col-md-3">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-size: 20px">Event Information Dissemenation</h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body">
                <canvas id="pieChart1" style="height:10px"></canvas>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
      </div>

      <div class="col-md-3">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-size: 20px"><br>Registration Process</h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body">
                <canvas id="pieChart2" style="height:10px"></canvas>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
      </div>

      <div class="col-md-3">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
             <h3 class="box-title">Programming Competition Problems</h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body">
                <canvas id="pieChart3" style="height:10px"></canvas>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
      </div>

      <div class="col-md-3">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Time allocated for problems to be solved</h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body">
                <canvas id="pieChart4" style="height:10px"></canvas>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
      </div>

    </div>

        <div class="row">
        <div class="col-md-3">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-size: 20px">Event Facilitators</h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body">
                <canvas id="pieChart5" style="height:10px"></canvas>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
      </div>

      <div class="col-md-3">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Date and Time of the Competition  </h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body">
                <canvas id="pieChart6" style="height:10px"></canvas>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
      </div>

      <div class="col-md-3">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
             <h3 class="box-title" style="font-size: 20px"><br>Venue and Facilities</h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body">
                <canvas id="pieChart7" style="height:10px"></canvas>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
      </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner" style="margin-bottom: 100px">
            </div>
            <div class="inner">
              <h3>
                <?php 
                  if($Overall!='false'):
                    echo $Overall;
                  else:
                    echo "No Avg";
                  endif;
               ?>
               <sup style="font-size: 20px">%</sup></h3>

              <p><h4>Overall Satisfaction</h4></p>
            </div>
            <div class="icon">
              <i style="font-size: 200px" class="ion ion-stats-bars"></i>
            </div>
            <div class="small-box-footer">
            </div>
<!--             <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a> -->
          </div>
        </div>

    <div class="row">
<div class="col-md-4">
<section class="content">
                          
 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Most liked things</h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body">

          <table id="datatablesz" class="table table-striped">

                                    <thead>

                                        <tr>
                                            <th>Comments</th>
                                           
                                        </tr>
                                    </thead>

                                    <tbody>
                                      <?php if($MostLiked!='false'):
                                         foreach($MostLiked as $rows): ?>
                                            <tr>
                                              <td><?php echo $rows['comments1']; ?></td>
                                            </tr>
                                        <?php endforeach;
                                      endif;?>                
                                    </tbody>
                                </table>
                              </div>
                            </div>
          <!-- /.box -->
  
            <!-- /.box-body -->


    </section>
 </div>

 <div class="col-md-4">
<section class="content">
                          
 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Expectations</h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body">

          <table id="datatables1" class="table table-striped">

                                    <thead>

                                        <tr>
                                            <th>Comments</th>
                                           
                                        </tr>
                                    </thead>

                                    <tbody>
                                      <?php if($Expectations!='false'):
                                         foreach($Expectations as $rows): ?>
                                            <tr>
                                              <td><?php echo $rows['comments2']; ?></td>
                                            </tr>
                                        <?php endforeach;
                                      endif;?>           
                                    </tbody>
                                </table>
                              </div>
                            </div>
          <!-- /.box -->
  
            <!-- /.box-body -->



    </section>
 </div>

 <div class="col-md-4">
<section class="content">
                          
 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Suggestions</h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body">

          <table id="datatables2" class="table table-striped">

                                    <thead>

                                        <tr>
                                            <th>Comments</th>
                                           
                                        </tr>
                                    </thead>

                                    <tbody>
                                      <?php if($Suggestions!='false'):
                                         foreach($Suggestions as $rows): ?>
                                            <tr>
                                              <td><?php echo $rows['comments3']; ?></td>
                                            </tr>
                                        <?php endforeach;
                                      endif;?>                    
                                    </tbody>
                                </table>
                              </div>
                            </div>



    </section>
 </div>

 </div>




<script type="text/javascript">

$(document).ready(function() {


    $('#datatablesz').DataTable({
        "lengthChange": false,
        "pageLength": 4,
        "dom": '<"top"i>rt<"bottom"p>'
   });

    $('#datatables1').DataTable({
        "lengthChange": false,
        "pageLength": 4,
        "dom": '<"top"i>rt<"bottom"p>'
   });

        $('#datatables2').DataTable({
        "lengthChange": false,
        "pageLength": 4,
        "dom": '<"top"i>rt<"bottom"p>'
   });
  });

        
       

</script>


<script>



  $(function () {


   <?php for($i=1; $i<8; $i++){ ?>
   //-------------
    //- Event Information Dissemenation -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.



        var pieChartCanvas = $('#pieChart'+<?= $i; ?>).get(0).getContext('2d')
        var pieChart       = new Chart(pieChartCanvas)
        var PieData        = [
          {
            value    : <?php echo $response[$i]['Very Satisfied']; ?>,
            color    : '#f56954',
            highlight: '#f56954',
            label    : 'Very Satisfied'
          },
          {
            value    : <?php echo $response[$i]['Satisfied']; ?>,
            color    : '#00a65a',
            highlight: '#00a65a',
            label    : 'Satisfied'
          },
          {
            value    : <?php echo $response[$i]['Neither']; ?>,
            color    : '#f39c12',
            highlight: '#f39c12',
            label    : 'Neither'
          },
          {
            value    : <?php echo $response[$i]['Dissatisfied']; ?>,
            color    : '#00c0ef',
            highlight: '#00c0ef',
            label    : 'Dissatisfied'
          },
          {
            value    : <?php echo $response[$i]['Very Dissatisfied']; ?>,
            color    : '#3c8dbc',
            highlight: '#3c8dbc',
            label    : 'Very Dissatisfied'
          }
        ]

         
        var pieOptions     = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke    : true,
          //String - The colour of each segment stroke
          segmentStrokeColor   : '#fff',
          //Number - The width of each segment stroke
          segmentStrokeWidth   : 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 0, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps       : 100,
          //String - Animation easing effect
          animationEasing      : 'easeOutBounce',
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate        : true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale         : false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive           : true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio  : true,
          //String - A legend template
          legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
        }

        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions)

   <?php } ?>

  })
</script>

<script src="<?php echo base_url(); ?>assets/bower_components/chart.js/Chart.js"></script>