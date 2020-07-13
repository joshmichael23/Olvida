<!-- <div class="container">
  <div class="left">
    <a class="btn btn-primary" href="<?php echo base_url() ?>competitions/chooseComp" class="btn btn primary">Back</a>
  </div>
</div> -->

<body>
  <section id="main" role="main">
    <section class="content">


      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Final Details</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
<!--             <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button> -->
          </div>
        </div>
        <div class="box-body">
          <form method="post" action="<?php echo base_url('competitions/publish')?>" accept-charset="utf-8"> 
          <table class="table table-bordered">
            <tr>
              <th><strong>Competition Name: </strong></th>
              <td><center><?php echo $this->session->userdata('competition_name') ?></center></td>
            </tr>
            
            <tr>
              <th><strong>Start Date: </strong></th>
              <td><center><?php echo date('F d, Y', strtotime($this->session->userdata('start_date')))?></center></td>
            </tr>
            <tr>
              <th><strong>End Date: </strong></th>
              <td><center><?php echo date('F d, Y', strtotime($this->session->userdata('end_date')))?></center></td>
            </tr>
            <th>Categories:<th>
            <?php array_map("aw", $sample, $sample2, $sample3); ?>
          </table>
          <br>

          <label>Description</label>
                <div>
                  <textarea class="form-control" placeholder="Message"
                            style="width: 90%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="description">            
                  </textarea>
                </div>        




        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" href="$">Submit</button>
        </form> 
     
        </div>
        <!-- /.box-footer-->
      </div>

        <?php echo "<td>";
         function aw($v1, $v2, $v3=NULL){
          if($v3=='No')
            $desc = 'No Payment';
          else
            $desc = 'Requires Payment';
          

          echo "<center>";
          echo $v1 . "   ";
          echo "<small>". $v2 ."</small>" . "       " .     "<small><b>" . $desc . "</b></small>" . "<br>";
          echo "</center>";
          }
          echo "</td>";
        ?>
    </section>
  </section>
</body>