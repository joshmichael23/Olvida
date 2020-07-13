<?php
class Feedback_model extends CI_Model
{
	 function select($compID)
	 {
	   $query = $this->db->query("select * from feedback where competition_id = '$compID'");
	            return $query;
	 }
	 function count(){
	   $option1 = $this->db->query("select count(option8) from feedback where option8='1' ");
	   return $option1;
	 }


	 function insert($data, $code)
	 {

	  $this->db->where('code', $code);
	  $this->db->update('feedback', $data);
	 }	

	 function checkCodes($code){
	 	$query = $this->db->query("SELECT * FROM feedback WHERE code = '$code'");
	 	if($query->result())
	 		return true;
	 	else
	 		return false;
	 }

	 function insertFeedbackSlot($code, $compID){
	 	$this->db->query("INSERT INTO feedback (code, competition_id, rating) VALUES ('$code', '$compID', 0)");

	 }

	 function getCompIDofCode($code){
	 	$query = $this->db->query("select competition_id from feedback where code='$code' ");
	   	return $query->row()->competition_id;

	 }

	 function checkIfCodeIsUSed($code){
	 	$query = $this->db->query("SELECT rating FROM feedback WHERE code = '$code'");
	 	if($query->row()->rating!=0)
	 		return true;
	 	else
	 		return false;
	 }
}