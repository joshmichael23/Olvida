<head>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">

</head>
<body>
    
    <div id="container">

        <div class="box">
            
            <div class="box-header">
                <h3 class="box-title">All Competitions</h3>

            </div>

               <div class="box-body">
                    <table id ="datatables" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <td>Competition</td>
                                <td>Date</td>
                                <td></td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result->result_array() as $row){ 


                               $CI =& get_instance();
                               $CI->load->model('compANDcatModel');
                               $compID = $row['CompID'];
                               $id = $this->session->userdata('id');
                               $checker = $CI->compANDcatModel->checkIfInvited($compID, $id); 



                            ?>
                            <tr>
                                <td><?php echo $row['competition_name']; ?></td>
                                <td><?php echo $row['start_date']?></td>
                                <td>
                                    <?php 
                                        if($checker==true){?>
                                            <span class="label label-primary">Direct Invite</span>
                                    <?php }
                                        else{
                                            echo '';
                                        }
                                    ?>
                                </td>
                                <td><a class="btn btn-primary" href="chooseCat/<?php echo $row['CompID']; ?>">View</a></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

<!-- 
     <script type="text/javascript">
        
        $(document).ready(function(){
        $('#datatables').DataTable({
        "processing":true,
        "serverSide":true,

        "ajax":{
        "url": "<?= base_url() ?>competitions/get_comps",
        "type": "POST"
    },
        "columns": [
            {"data": "competition_name"
            },
            {
                data: "InviteCheck",
                render: function(data){

                    if(data > 0)
                        return '<span class="label label-primary">Direct Invite</span>'
                    else
                        return '';
                }
            },
            {
                data: "start_date",
                render: function(data){

                    var monthNames = [ "January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December" ];

                    var newDate = new Date(data)
                    var formattedDate = monthNames[newDate.getMonth()] + ' ' + newDate.getDay() + ', ' +  newDate.getFullYear();
                    
                    return formattedDate;
                }
            },
            {"data": "edit"}
        ],

        "aoColumnDefs" : [ 
            {"bSortable" : false,
              "aTargets" : [3],
            } ]
        
    });
    });
</script> -->
    </body>

    <script type="text/javascript">
        
        $(document).ready(function(){
        $('#datatables').DataTable({
        })
    });
            </script>
