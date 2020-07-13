<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>   



<body>


    <div id="content">


        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Participants</h3>
            </div>
           <div class="box-body">
                    <?php if($this->session->flashdata('Success')){ ?>
        <div class="alert alert-success col-xs-12">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Success!</strong>
            <?php echo $this->session->flashdata('Success'); ?>
        </div>
        <?php }?>
                <table id ="datatables" class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <td>School Name</td>
                            <td>Team Name</td>
                            <td>Members</td>
                            <td>Part_in_comp_ID</td>
                            <td>Attended</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


<script type="text/javascript">
        var compID = "<?php echo $compID; ?>";

        $(document).ready(



            function(){
                $('#datatables').DataTable({
                "processing":true,
                "serverSide":true,
                "pageLength":6,
                "lengthChange":false,

                "language":{
                  "emptyTable": "No data available in table",
                  "sEmptyTable": "No data available in table",
                  "infoEmpty": "No data available in table"
                },

                "ajax":{
                "url": "<?php echo base_url("competitions/getparticipantingsincomp/")?>" + compID,
                "type": "POST",
                },



                "columns": [
                    {"data": "school_name"},
                    {"data": "team_name"},
                    {"data": "Name"},
                    {"data": "part_in_comp_ID",
                     "visible": false},
                    {
                    	data: "attend",
                    	render: function(data, type, full){
                        var partID = full.part_in_comp_ID;
                        if(data=='')
                            return '<a class="btn btn-primary" href="<?php echo base_url()?>competitions/participantYes/' + partID  + '/' + compID + '">Yes</a>' + '     ' + '<a class="btn btn-danger" href="<?php echo base_url()?>competitions/participantNo/' + partID + '/' + compID + '">No</a>';
                        else{
                        	if(data=='yes')
                        		return '<small class="label bg-blue">' + data.toUpperCase() + '</small>';
                        	else
                          		return '<small class="label bg-red">' + data.toUpperCase() + '</small>';                      		
                        }
                    	}
                	}

                ]
                
                });
            }

    );

    </script>

</body>
