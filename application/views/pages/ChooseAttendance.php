<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>   
 -->
<body>
    <div id="container">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Check Attendance</h3>
            </div>
           <div class="box-body">
                <table id ="datatables" class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <td>Competition Name</td>
                            <td>Start Date</td>
                            <td>End Date</td>
                            <td></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


<script type="text/javascript">

        $(document).ready(

            function(){
                $('#datatables').DataTable({
                "processing":true,
                "serverSide":true,
                "lengthChange": false,
                "pageLength": 8,

                "language":{
                  "emptyTable": "No data available in table",
                  "sEmptyTable": "No data available in table",
                  "infoEmpty": "No data available in table"
                },


                "ajax":{
                "url": "<?= base_url('Competitions/get_competitions/') ?>",
                "type": "POST",
                },

                "columns": [
                    {"data": "competition_name"},
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
                    {
                        data: "end_date",
                        render: function(data){

                            var monthNames = [ "January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December" ];

                            var newDate = new Date(data)
                            var formattedDate = monthNames[newDate.getMonth()] + ' ' + newDate.getDay() + ', ' +  newDate.getFullYear();
                            
                            return formattedDate;
                        }
                    },
                    {
                     "data": "status"
                    }

                ]
                
                });
            }

    );

    </script>

</body>
