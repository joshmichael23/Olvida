<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
</head>
<body>
        <?php if($this->session->flashdata('message')){ ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Error!</strong> <?php echo $this->session->flashdata('message'); ?>
            </div>
        <?php }?>

        <?php if($this->session->flashdata('create')){ ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('create'); ?>
            </div>
        <?php }?>
        
        <?php if($this->session->flashdata('edit')){ ?>
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('edit'); ?>
            </div>
        <?php }?>

        <?php if($this->session->flashdata('delete')){ ?>
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('delete'); ?>
            </div>
        <?php }?>

    <div id="container">
        <div class="box">
          <div style="padding-left:20px">
              <h1 class="box-title">Participants</h1>
              
          </div>
              <div class="box-body">
                <table id ="datatables" class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                          <td>Name</td>
                          <td>Contact Number</td>
                          <td>Email</td>
                          <td>Address</td>
                          <td>Matriculation Form</td>
                          <td>Action</td>
                      </tr>
                    </thead>
                </table>
            </div>
        </div>      
    </div>

<script type="text/javascript">
        var editor; // use a global for the submit and return data rendering in the examples

        $(document).ready(function(){


        $('#datatables').DataTable({
        "processing":true,
        "serverSide":true,
        "bSort" : true,

        "ajax":{
        "url": "<?= base_url() ?>categories/get_participants/",
        "type": "POST"
    },
        "columns": [
            {"data": "FullName"},
            {"data": "contact_no"},
            {"data": "email"},
            {"data": "address"},
            {"data": "edit"},
            {"data": "approve"},
            // {
            //     "data": null,
            //     "className": "center",
            //     "defaultContent": '<a href="" class="editor_edit">Edit</a> / <a href="" class="editor_remove">Delete</a>'
            // }
        ],

        "aoColumnDefs" : [ 
            {"bSortable" : false,
              "aTargets" : [4,5],
            } ],

            
        
    });
    });





      function doconfirm()
{
    job=confirm("Are you sure to delete permanently?");
    if(job!=true)
    {
        return false;
    }
}

</script>
    </body>
