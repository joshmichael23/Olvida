<?php
class committee_model extends CI_Model{

        public function __construct() 
        {
           parent::__construct(); 
           $this->load->database();
        }
        
        function insert_data_committee($committee){
        	$this->db->insert("committee",$committee);
        }

        function insert_data_team_competition_winners($team_competition_winners){
            $this->db->insert("team_competition_winners",$team_competition_winners);
        }
        function deleteExtra(){
         $this->db->query("DELETE FROM team_competition_winners WHERE rank = '0'");
        }
        function update_data_competition_scoreboard($arrayCompWin){
            $filename = $arrayCompWin['file_name'];
            $catID = $arrayCompWin['category_id'];
            $query = $this->db->query("UPDATE competition_scoreboard SET file_name = '$filename' WHERE category_id = '$catID'");
        }

        function clear_data_team_competition_winners($catID){
            $this->db->query("DELETE FROM team_competition_winners WHERE competition_scoreboard_id = $catID");
        }

        function update_data_team_competition_winners($arrayCompWinners){
            $teamname = $arrayCompWin['file_name'];
            $rank = $arrayCompWin['category_id'];
            $ID = $arrayCompWinners['category_id'];
            $this->db->query("UPDATE competition_scoreboard SET file_name = '$filename' WHERE category_id = '$catID'");
        }


        function insert_data_competition_scoreboard($competition_scoreboard){
            $this->db->insert("competition_scoreboard",$competition_scoreboard);
        }


        public function checkScoreboardIfExisting($RanksArray){
            $filename = $RanksArray['file_name'];
            $category_id = $RanksArray['category_id'];
            $competition_id = $RanksArray['competition_id'];
            $query = $this->db->query("SELECT * FROM competition_scoreboard WHERE category_id = '$category_id' AND competition_id = '$competition_id'");
            if($query->num_rows()>0){
                return "true";
            }
            return false;
        }
    }
?>