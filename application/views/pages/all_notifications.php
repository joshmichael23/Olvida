<body>
    <div id="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Notifications</h3>
            </div>
           <div class="box-body">
                <table id ="datatables" class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <td>Subject</td>
                            <td>Text</td>
                            <td>Date</td>
                            <td>aw</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>


<script type="text/javascript">

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
                "url": "<?php echo base_url() ?>Notifications/get_notifications/",
                "type": "POST",
                },

                "columns": [
                    {"data": "subject"},
                    {"data": "text"},
                    {
                        data: "date",

                                    render: function(data){


                                        var time_ago        = new Date(data);
                                        time_ago            = time_ago.getTime()/1000;
                                        var cur_time        = new Date();
                                        cur_time            = cur_time.getTime()/1000;
                                        var time_elapsed    = cur_time - time_ago;
                                        var seconds         = time_elapsed ;
                                        var minutes         = Math.round(time_elapsed / 60 );
                                        var hours           = Math.round(time_elapsed / 3600);
                                        var days            = Math.round(time_elapsed / 86400 );
                                        var weeks           = Math.round(time_elapsed / 604800);
                                        var months          = Math.round(time_elapsed / 2600640 );
                                        var years           = Math.round(time_elapsed / 31207680 );
                                        // Seconds
                                        if(seconds <= 60){
                                            return "just now";
                                        }
                                        //Minutes
                                        else if(minutes <=60){
                                            if(minutes==1){
                                                return "one minute ago";
                                            }
                                            else{
                                                return minutes + " minutes ago";
                                            }
                                        }
                                        //Hours
                                        else if(hours <=24){
                                            if(hours==1){
                                                return "an hour ago";
                                            }else{
                                                return hours + " hrs ago";
                                            }
                                        }
                                        //Days
                                        else if(days <= 7){
                                            if(days==1){
                                                return "yesterday";
                                            }else{
                                                return days + " days ago";
                                            }
                                        }
                                        //Weeks
                                        else if(weeks <= 4.3){
                                            if(weeks==1){
                                                return "a week ago";
                                            }else{
                                                return weeks + " weeks ago";
                                            }
                                        }
                                        //Months
                                        else if(months <=12){
                                            if(months==1){
                                                return "a month ago";
                                            }else{
                                                return months + " months ago";
                                            }
                                        }
                                        //Years
                                        else{
                                            if(years==1){
                                                return "one year ago";
                                            }else{
                                                return years + " years ago";
                                            }
                                        }
                                    }
                        
                    },
                    {"data": "notifications_id",
                     "visible": false},
                    {
                     data: "status",
                     "visible": false,
                     render: function(data, type, full){
                        var notifID = full.notifications_id;
                        if(data==1)
                            return '';
                        else
                            return '<a class="btn btn-danger" href="<?php echo base_url()?>Notifications/dismiss/' + notifID + '">Dismiss</a>' ;
                     }
                    }



                    
                    
                ],

                "order": [[ 3, "desc" ]], //or asc 


                
                });
            }

    );

    </script>