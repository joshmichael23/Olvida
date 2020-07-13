<body>
  <section id="main" role="main">
    <section class="container">
      
        <br />
        <br />
        <br />
        <div class="left">
            <a class="btn btn-primary" href="<?php echo base_url() ?>competitions/index" class="btn btn primary">Back</a>
        </div>

        <div class="text-center" style="margin-bottom:10px; ">
            
        <h4 class="text-muted mt-0 font-alt">Teams</h4>
        
        <table class="table table-hover" id="Tab">
            <tr>
                <th>Team</th>
                <th>Code</th>
            </tr>

            <?php
            foreach($sample->result_array() AS $sample1){
            ?>

            <tr>
            	<td><?php echo $sample1['team_id']?></td>
                <td><?php echo $sample1['code']?></td>
                
            </tr>
            <?php
            }?>
        </table>

     </div>
     
    </section>
  </section>
</body>