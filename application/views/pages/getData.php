<?php
if(isset($_POST['page'])){
    //Include pagination class file
    $this->load->library('Pagination.php');
    $this->load->database();
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = 10;

    
    //set conditions for search
    $whereSQL = $orderSQL = '';
    $keywords = $_POST['keywords'];
    $sortBy = $_POST['sortBy'];
    if(!empty($keywords)){
        $whereSQL = "WHERE title LIKE '%".$keywords."%'";
    }
    if(!empty($sortBy)){
        $orderSQL = " ORDER BY id ".$sortBy;
    }else{
        $orderSQL = " ORDER BY id DESC ";
    }

     $id = $this->session->userdata('id');

    //get number of rows
    
    $this->db->query("SELECT COUNT(*) as postNum FROM competition WHERE director_id = '$id'".$whereSQL.$orderSQL);
    $resultNum = $this->db->get();
    $rowCount = $resultNum['postNum'];

    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);
    
    //get rows
    $query = $db->query("SELECT * FROM competition WHERE director_id='$id' $orderSQL LIMIT $start,$limit");
    
    if($query->num_rows > 0){ ?>
        <div class="comps_list">
        <?php
            while($row = $query->fetch_assoc()){ 
                $postID = $row['competition_id'];
        ?>
            <div class="list_item"><a href="javascript:void(0);"><h2><?php echo $row["competition_name  "]; ?></h2></a></div>
        <?php } ?>
        </div>
        <?php echo $pagination->createLinks(); ?>
<?php } } ?>