<style type="text/css">
   
.track-progress {
  margin: 0;
  padding: 0;
  overflow: hidden;
}

.track-progress li {
  list-style-type: none;
  display: inline-block;

  position: relative;
  margin: 0;
  padding: 0;

  text-align: center;
  line-height: 30px;
  height: 30px;

  background-color: #f0f0f0;
}
        .track-progress[data-steps="3"] li { width: 33%; }
.track-progress[data-steps="4"] li { width: 25%; }
.track-progress[data-steps="5"] li { width: 20%; }
.track-progress li > span {
  display: block;

  color: #999;
  font-weight: bold;
  text-transform: uppercase;
}

.track-progress li.done > span {
  color: #666;
  background-color: #ccc;
}
.track-progress li > span:after,
.track-progress li > span:before {
  content: "";
  display: block;
  width: 0px;
  height: 0px;

  position: absolute;
  top: 0;
  left: 0;

  border: solid transparent;
  border-left-color: #f0f0f0;
  border-width: 15px;
}

.track-progress li > span:after {
  top: -5px;
  z-index: 1;
  border-left-color: white;
  border-width: 20px;
}

.track-progress li > span:before {
  z-index: 2;
}

.track-progress li.done + li > span:before {
  border-left-color: #ccc;
}

.track-progress li:first-child > span:after,
.track-progress li:first-child > span:before {
  display: none;
}.track-progress li:first-child i,
.track-progress li:last-child i {
  display: block;
  height: 0;
  width: 0;

  position: absolute;
  top: 0;
  left: 0;

  border: solid transparent;
  border-left-color: white;
  border-width: 15px;
}

.track-progress li:last-child i {
  left: auto;
  right: -15px;

  border-left-color: transparent;
  border-top-color: white;
  border-bottom-color: white;
}
    }
</style>
<br>

<div class="container">
  <div class="left">
    <a class="btn btn-primary" href="<?php echo base_url() ?>competitions/chooseComp" class="btn btn primary">Back</a>
  </div>
</div>

<br>
<br>

 <ol class="track-progress" data-steps="3">
   <li class="done">
     <span>Choose Competition</span>
     <i></i>
   </li><!--
--><li class="done">
     <span>Choose Category</span>
   </li><!--
--><li>
     <span>Choose Teams To Register</span>
     <i></i>
   </li>
 </ol>

<body>
  <section id="main" role="main">
    <section class="container">
      
        <br />
        <br />
        <br />

        
        
        <div class="text-center" style="margin-bottom:10px; ">
            
        <h2 class="text-muted mt-0 font-alt"><?php echo "Categories for: ", $name; ?></h2>
        
        <table class="table table-hover" id="Tab">
            <tr>
                <th>Category</th>
                <th>Type</th>
                <th>Action</th>
            </tr>

            
            <?php
            foreach($sample->result_array() AS $sample1){
            ?>
            <tr>
                <?php $name = $sample1['category_name']; 
                      $cat_id = $sample1['category_id'];
                      $comp_id = $sample1['competition_id'];
                      $id = $sample1['category_id'];
                      ?>
                <td><?php echo $sample1['category_name']?></td>
                <td><?php echo $sample1['category_type']?></td>
                <td><a class="btn btn-primary" href="<?php echo base_url() ?>categories/join/<?php echo $id; ?>">Apply</a></td>
            </tr>
            <?php
            }?>
        </table>

     </div>
     
    </section>
  </section>
</body>