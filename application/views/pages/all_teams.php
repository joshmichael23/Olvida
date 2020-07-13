<body>
    <div id="container">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">All Teams</h3>
            </div>
           <div class="box-body" >
                    <table id ="datatables" class="table table-striped" >
                        <thead>
                            <tr>
                                <td>School Name</td>
                                <td>Team Name</td>
                                <td>Members</td>
                                <td>Coach</td>
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
                "pageLength": 10,

                "ajax":{
                "url": "<?= base_url('All_teams/get_teams/'); ?>",
                "type": "POST",
                },

                "columns": [
                    {"data": "school_name"},
                    {"data": "team_name"},
                    {"data": "Name"},
                    {"data": "Coach"}
                ]
                
                });
            }

    );

    </script>

</body>
