

<style type="text/css">
   

form{
  margin-top: 50px;
  margin-bottom:50px;
  width: 100px;
}

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
<br>
<br>
<div class="container">
   <div class="left">
        <a class="btn btn-primary" onclick="javascript:history.go(-1)" class="btn btn primary">Back</a>
        </div> 
</div>


<!-- <br>
<br>
<ol class="track-progress" data-steps="3">
   <li class="done">
     <span>Choose Competition</span>
     <i></i>
   </li><li class="done">
     <span>Choose Category</span>
   </li><li class="done">
     <span>Choose Teams To Register</span>
     <i></i>
   </li>
 </ol>
<body> -->


 
  <section id="main" role="main">
    <section class="container">
      

      

        <!-- <div class="text-left" style="margin-bottom:10px; ">
       
        <h1 class="text-muted mt-0 font-alt">Teams</h1>
        
         <form method="post" action="<?php// echo base_url('team_registration/index')?>" accept-charset="utf-8" name="form1">
        <div class="form-group nm">
        <button type="submit"  class="btn btn-block btn-primary" href="$">Add Teams</button>
        </form>
       </div>
       
     </div>
 -->
                
        <br>
        
     <div class="text-center" style="margin-bottom:10px; ">
      <h1>Choose Team</h1>
     <div class="table-responsive">

        <table class="table table-bordered">
            <tr>
                <th>Choose</th>
                <th>Team Name </th>
                <th>Coach </th>
                <th>Team Members </th>
            </tr>

            <?php
            $i=0;
            foreach($sample AS $sample1):
            ?>
              <?php $i++; ?>
            <tr>

              <form method="post" class="btn btn-block btn-primary" action="<?php echo base_url() ?>categories/apply/<?php echo $catID?>">
              <td><input type="checkbox" name="checkyes[]" value="<?=$sample1->TeamID ?>"</td>
              <td><?=$sample1->TeamName; ?></td>
              <td><?=$sample1->Coach; ?></td>
              <td><?=$sample1->Members; ?></td>
              
            </tr>
            <?php endforeach; ?>
           

        </table>
              <input class="btn btn-primary" type="submit" value="Request">
             </form>
 
    </div>
     </div>
    </section>
  </section>
</body>