<style>
.pindutan{
	top: 50px;
	height: 500px;
	width: 400px;
	border: solid;
	border-height: 50px;
	border-width: 50px;
}

</style>


      	<?php 
	 		$CI =& get_instance();
	        $CI->load->model('compANDcatModel');
	        $compName = $this->compANDcatModel->getCompNamebyCompID($compID); 
        ?>

<body >
      <section class="content-header">
        <h1>
          Generate Certificate
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('login/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a>Generate Certificate</a></li>
          <li><a class="active"><?php echo $compName; ?></a></li>
        </ol>
      </section>



	<div class="container" align="center">


        
        <h1 style="margin-top:30px; margin-bottom: 30px">Create Certificate for <?php echo $compName; ?></h1>

	 	<a class="btn btn-primary" style="width:200px; height:200px" href="<?php echo base_url('Generate/printParticipation/')?><?php echo $compID; ?>">
	 		<i style="margin-top:50px" class="fa fa-users fa-3x"></i><div style="font-size: 20px">Print Participation</div>
	 	</a>

	 	<a class="btn btn-primary" style="margin-left:70px; width:200px; height:200px" href="<?php echo base_url('Generate/printPlacers/')?><?php echo $compID; ?>">
	 		
	 		<i style="margin-top:50px" class="fa fa-users fa-3x"></i>
	 		<div style="font-size: 20px">Print Placers</div >
	 		
	 	</a>
	 </div>
</body>