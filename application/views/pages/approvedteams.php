<body>

        <section class="content-header">
        <h1>
          Approved Teams
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url('competitions/index'); ?>">Competitions</a></li>
          <li><a href="<?php echo base_url(); ?>competitions/viewCat/<?php echo $catID; ?>">Categories</a></li>
          <li>Approved Teams</li>
        </ol>
      </section>


  <section id="main" role="main">
    <section class="container">
      
        <div class="text-center" style="margin-bottom:10px; ">
            
        <?php echo $header; ?>
        <h1 class="text-muted mt-0 font-alt"></h1>



        <table class="table table-hover" id="Tab">
            <tr>
                <th>School</th>
                <th>Team</th>
                <th>Members</th><!-- 
                <th>Action</th> -->
            </tr>

            <?php $i=0; ?>
            <?php if($sample): ?>
            <?php foreach($sample AS $sample1):?>
              <?php $i++; ?>
            <tr>

              <!-- <form method="post" class="btn btn-block btn-primary" action="<?php echo base_url() ?>categories/apply/<?php echo $catID?>"> -->
              <!-- <td><input type="checkbox" name="checkyes[]" value="<?=$sample1->TeamID ?>"></td> -->
              <td><?=$sample1->SchoolName; ?></td>
              <td><?=$sample1->TeamName; ?></td>
              <td><?=$sample1->Members; ?></td><!-- 
              <td><a class="btn btn-danger">Leave Category</a></td> -->
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </table>

     </div>
     
    </section>
  </section>
</body>

