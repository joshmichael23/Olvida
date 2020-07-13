<div class="content">
<div class="box">
<div class="row r-dash">
<div class="col-md-3">
 <!-- Info Boxes Style 2 -->
 <div class="info-box bg-blue">
 <a class="a-dash" href="<?php echo base_url();?>competitions/index"><span class="info-box-icon"><i class=" center ion-ios-monitor"></i></span></a>

            <div class="info-box-content">
              <a class="a-dash" href="<?php echo base_url();?>competitions/index"><span class="info-box-text">Competitions</span></a>
              <span class="info-box-number"><?php echo $sample; ?></span>

            </div>
            <!-- /.info-box-content -->
          </div>
</div>
<div class="col-md-3">
          <!-- /.info-box -->
          <div class="info-box bg-blue">
          <a class="a-dash" href="<?php echo base_url();?>All_teams/index">  <span class="info-box-icon"><i class=" center ion-ios-people"></i></span></a>

            <div class="info-box-content">
            <a class= "a-dash" href="<?php echo base_url();?>All_teams/index"><span class="info-box-text">My Teams</span></a>
              <span class="info-box-number"><?php echo $sample4; ?></span>

             
            </div>
            <!-- /.info-box-content -->
          </div>
</div>
<div class="col-md-3">
          <!-- /.info-box -->
          <div class="info-box bg-blue">
          <a class="a-dash" href="<?php echo base_url();?>competitions/generateCertificate"> <span class="info-box-icon"><i class="center ion-ios-paper"></i></span></a>
           
            <div class="info-box-content">
            <a class="a-dash as" href="<?php echo base_url();?>competitions/generateCertificate"><span class="info-box-text">Genereate Certificate</span></a>
              
            </div>
           
            <!-- /.info-box-content -->
          </div>
</div>
<div class="col-md-3">
          <!-- /.info-box -->
          <div class="info-box bg-blue">
          <a class="a-dash" href="<?php echo base_url();?>Feedbacks/viewCompFeedback"><span class="info-box-icon"><i class="center ion-ios-chatboxes"></i></span></a>

            <div class="info-box-content">
            <a class="a-dash as" href="<?php echo base_url();?>Feedbacks/viewCompFeedback"><span class="info-box-text">Feedback</span></a>
              

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
</div>

</div>
 <!-- TABLE: LATEST ORDERS -->
 <div class="box-info">
            <div class="box-header with-border">
            <a href="<?php echo base_url();?>competitions/pendingrequests"><h3 class="box-title">Pending Requests</h3></a>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Item</th>
                    <th>Status</th>
                    <th>Popularity</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                    <td>Call of Duty IV</td>
                    <td><span class="label label-success">Shipped</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="label label-warning">Pending</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>iPhone 6 Plus</td>
                    <td><span class="label label-danger">Delivered</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="label label-info">Processing</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="label label-warning">Pending</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>iPhone 6 Plus</td>
                    <td><span class="label label-danger">Delivered</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                    <td>Call of Duty IV</td>
                    <td><span class="label label-success">Shipped</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

         
