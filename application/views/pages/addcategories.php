<body>
  <section id="main" role="main">
    <section class="container">
      
        <br />
        <br />
        <br />

        <div class="text-center" style="margin-bottom:10px; ">
            
            <?php
            foreach($sample->result_array() AS $sample1){
            ?>

            <?php $name = $sample1['count']; ?>

        <h1 class="text-muted mt-0 font-alt"><?=$sample1['competition_name']?></h1>
        
        <table class="table table-hover" id="Tab">
            <tr>
                <th>Category</th>
                <th>Action</th>
            </tr>


            <tr>
                

                <td><?php echo $sample1['category_name']?></td>
                <td><a class="btn btn-primary" href="<?php echo base_url() ?>teams/viewTeams/<?php echo $cat_id ?>" class="btn btn primary">View</a>
                    <a class="btn btn-primary" href="<?php echo base_url() ?>teams/viewTeams/<?php echo $cat_id ?>" class="btn btn primary">Edit</a>
                    <a class="btn btn-danger" href="<?php echo base_url() ?>categories/deleteCat/<?php echo $cat_id ?>" class="btn btn primary" onClick="return doconfirm();">Delete</a></td>
            </tr>
            <?php
            }?>
        </table>
            <table class="table table-hover">
                <tr>
                   <th>
                    <a class="btn btn-primary" href="<?php echo base_url()?>categories/AddCat/<?php echo $comp_id ?>">Add Category</a>
                   </th>
                </tr>
            </table>
     </div>


     
    </section>
  </section>
</body>
<script>
function doconfirm()
{
    job=confirm("Are you sure to delete permanently?");
    if(job!=true)
    {
        return false;
    }
}
</script>