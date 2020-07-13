<?php
class Csv_import_model extends CI_Model
{
 function select($compID)
 {
   $query = $this->db->query("select * from feedback where competition_id = '$compID'");
            return $query;
 }

 function insert($data)
 {
  $this->db->insert_batch('feedback', $data);
 }	
}